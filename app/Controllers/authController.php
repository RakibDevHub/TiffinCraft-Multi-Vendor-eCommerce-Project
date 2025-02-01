<?php

namespace App\Controllers;

use App\Models\AuthModel;
use App\Service\Database;
use App\Utils\CSRFToken;

class AuthController
{

    private $authModel;

    public function __construct()
    {
        $conn = Database::getConnection();
        $this->authModel = new AuthModel($conn);
    }

    public function login($context)
    {
        $title = "Login";
        $isLoggedIn = $context['isLoggedIn'] ?? false;
        $userRole = $context['userRole'] ?? null;
        $currentPath = $context['currentPath'] ?? '/';
        $error = null;

        $csrfToken = CSRFToken::generateToken();

        if ($isLoggedIn) {
            $this->redirectTo($userRole);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $submittedToken = $_POST['csrf_token'] ?? '';

            if (!CSRFToken::validateToken($submittedToken)) {
                $error = "Invalid CSRF token.";
            } else {

                $userType = $this->getUserType($currentPath);
                $user = $this->authModel->authenticate($email, $password, $userType);

                if ($user) {
                    $_SESSION[SESSION_USER_ID] = $user['id'];
                    $_SESSION[SESSION_USER_ROLE] = $userType;
                    CSRFToken::clearToken();
                    $this->redirectTo($userType);
                } else {
                    $error = "Invalid email or password.";
                }
            }
        }

        Database::closeConnection();
        include ROOT_DIR . 'pages/auth/login.php';
    }

    public function register($context)
    {
        $title = "Register";
        $isLoggedIn = $context['isLoggedIn'] ?? false;
        $userRole = $context['userRole'] ?? null;
        $currentPath = $context['currentPath'];
        $error = null;
        $success = null;

        $csrfToken = CSRFToken::generateToken();

        if ($isLoggedIn) {
            $this->redirectTo($userRole);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!CSRFToken::validateToken($_POST['csrf_token'] ?? '')) {
                $error = "Invalid CSRF token.";
            } else {

                $userType = $this->getUserType($currentPath);
                $name = trim($_POST['username'] ?? '');
                $email = trim($_POST['uemail'] ?? '');
                $password = $_POST['upassword'] ?? '';
                $cpassword = $_POST['cpassword'] ?? '';
                $number = trim($_POST['number'] ?? '');
                $businessName = trim($_POST['bname'] ?? '');
                $businessAddress = trim($_POST['baddress'] ?? '');
                $kitchenType = trim($_POST['ktype'] ?? '');
                $cuisineType = trim($_POST['ctype'] ?? '');
                $delivery = trim($_POST['delivery'] ?? '');
                $image = $_FILES['image'] ?? null;

                // Validation
                if (empty($email) || empty($password) || empty($number) || ($userType === 'customer' && empty($name))) {
                    $error = "Please fill in all required fields.";
                } elseif ($userType === 'customer' && !preg_match('/^[a-zA-Z\s]+$/', $name)) {
                    $error = "Name should only contain alphabets and spaces.";
                } elseif (!preg_match('/^01[0-9]{9}$/', $number)) {
                    $error = "Phone number must be 11 digits and start with '01'.";
                } elseif (strlen($password) < 8) {
                    $error = "Password must be at least 8 characters long.";
                } elseif ($password !== $cpassword) {
                    $error = "Passwords do not match.";
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $error = "Invalid email format.";
                } elseif ($this->authModel->getUserByEmail($email, $userType, null)) {
                    $error = "Email already exists.";
                } elseif ($userType === 'vendor' && (empty($businessName) || empty($businessAddress) || empty($kitchenType) || empty($cuisineType) || empty($delivery))) {
                    $error = "Please provide business details for vendor registration.";
                } else {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                    $userData = [
                        'email' => $email,
                        'password' => $hashedPassword,
                        'phone_number' => $number,
                        'name' => $name
                    ];

                    if ($userType === 'vendor') {
                        $userData['business_name'] = $businessName;
                        $userData['business_address'] = $businessAddress;
                        $userData['kitchen_type'] = $kitchenType;
                        $userData['cuisine_type'] = $cuisineType;
                        $userData['delivery_areas'] = $delivery;

                        if ($image && $image['error'] === UPLOAD_ERR_OK) {
                            $targetDir = PUBLIC_DIR . "/uploads/vendors/";

                            $imageFileType = strtolower(pathinfo($image["name"], PATHINFO_EXTENSION));
                            $allowedExtensions = ["jpg", "jpeg", "png", "gif"];
                            if (!in_array($imageFileType, $allowedExtensions)) {
                                $error = "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
                            } else { // Only proceed if the extension is valid
                                $fileName = uniqid() . "." . $imageFileType;
                                $targetFile = $targetDir . $fileName;

                                if (move_uploaded_file($image["tmp_name"], $targetFile)) {
                                    $userData['outlet_image'] = $fileName;
                                } else {
                                    $error = "Error uploading file.";
                                }
                            }
                        } else if ($image['error'] !== 4) {
                            $error = "Image upload failed. Ensure the file is valid.";
                        }
                    }

                    $result = $this->authModel->registerUser($userData, $userType);
                    if (!$error && $result['status']) {
                        $success = $result['message'];
                    } else {
                        $error = $result['message'];
                    }

                }
            }
        }

        include ROOT_DIR . 'pages/auth/register.php';
    }

    public function logout($context)
    {

        $_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        session_destroy();

        $currentPath = $context['currentPath'] ?? '/';
        $redirectPath = ($currentPath === '/business/logout') ? '/business/login' : ($currentPath === '/admin/logout' ? '/admin' : '/');
        header("Location: " . $redirectPath);
        exit;
    }

    private function getUserType($path)
    {
        if (strpos($path, '/admin') !== false) {
            return 'admin';
        } elseif (strpos($path, '/business') !== false) {
            return 'vendor';
        }
        return 'customer';
    }

    private function redirectTo($role)
    {
        switch ($role) {
            case 'admin':
                header('Location: /admin/dashboard');
                break;
            case 'vendor':
                header('Location: /business/dashboard');
                break;
            default:
                header('Location: /');
        }
        exit;
    }
}