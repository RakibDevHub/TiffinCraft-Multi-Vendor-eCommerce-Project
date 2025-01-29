<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Utils\CSRFToken;

class AuthController
{
    public function login($context)
    {
        $title = "Login";
        $isLoggedIn = $context['isLoggedIn'] ?? false;
        $userRole = $context['userRole'] ?? null;
        $currentPath = $context['currentPath'] ?? '/';
        $conn = $context['conn'];
        $error = null;

        $csrfToken = CSRFToken::generateToken();

        if ($isLoggedIn) {
            $this->redirectToDashboard($userRole);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $submittedToken = $_POST['csrf_token'] ?? '';

            if (!CSRFToken::validateToken($submittedToken)) {
                $error = "Invalid CSRF token.";
            } else {
                $userModel = new UserModel($conn);
                $userType = $this->getUserTypeFromPath($currentPath);

                $user = $userModel->authenticate($email, $password, $userType);

                if ($user) {
                    $_SESSION[SESSION_USER_ID] = $user['id'];
                    $_SESSION[SESSION_USER_ROLE] = $userType;
                    CSRFToken::clearToken();
                    $this->redirectToDashboard($userType);
                } else {
                    $error = "Invalid email or password.";
                }
            }
        }

        include ROOT_DIR . 'pages/auth/login.php';
    }

    public function register($context)
    {
        $title = "Register";
        $isLoggedIn = $context['isLoggedIn'] ?? false;
        $userRole = $context['userRole'] ?? null;
        $currentPath = $context['currentPath'];
        $conn = $context['conn'];
        $error = null;
        $success = null;

        $csrfToken = CSRFToken::generateToken();

        if ($isLoggedIn) {
            $this->redirectToDashboard($userRole);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!CSRFToken::validateToken($_POST['csrf_token'] ?? '')) {
                $error = "Invalid CSRF token.";
            } else {
                $userModel = new UserModel($conn);
                $userType = $this->getUserTypeFromPath($currentPath);
                $name = trim($_POST['username'] ?? '');
                $email = trim($_POST['uemail'] ?? '');
                $password = $_POST['upassword'] ?? '';
                $cpassword = $_POST['cpassword'] ?? '';
                $number = trim($_POST['number'] ?? '');
                $kitchenName = trim($_POST['kname'] ?? '');
                $kitchenAddress = trim($_POST['kaddress'] ?? '');
                $kitchenType = trim($_POST['ktype'] ?? '');
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
                } elseif ($userModel->getUserByEmail($email, $userType)) {
                    $error = "Email already exists.";
                } elseif ($userType === 'vendor' && (empty($kitchenName) || empty($kitchenAddress) || empty($kitchenType) || empty($delivery))) {
                    $error = "Please provide kitchen details for vendor registration.";
                } else {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                    $userData = [
                        'email' => $email,
                        'password' => $hashedPassword,
                        'phone_number' => $number,
                        'name' => $name
                    ];

                    if ($userType === 'vendor') {
                        $userData['kitchen_name'] = $kitchenName;
                        $userData['kitchen_address'] = $kitchenAddress;
                        $userData['kitchen_type'] = $kitchenType;
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
                                    $userData['kitchen_image'] = $fileName;
                                } else {
                                    $error = "Error uploading file.";
                                }
                            }
                        } else if ($image['error'] !== 4) {
                            $error = "Image upload failed. Ensure the file is valid.";
                        }
                    }

                    if (!$error && $userModel->registerUser($userData, $userType)) {
                        $success = "Registration successful!";
                    } else {
                        $error = $error ?? "Registration failed. Please try again.";
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

    private function getUserTypeFromPath($path)
    {
        if (strpos($path, '/admin') !== false) {
            return 'admin';
        } elseif (strpos($path, '/business') !== false) {
            return 'vendor';
        }
        return 'customer';
    }

    private function redirectToDashboard($role)
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
