<?php

namespace App\Controllers;

use App\Models\AuthModel;
use App\Models\VendorModel;
use App\Service\Database;
use App\Utils\CSRFToken;

class AuthController
{

    private $authModel;
    private $vendorModel;

    public function __construct()
    {
        $conn = Database::getConnection();
        $this->authModel = new AuthModel($conn);
        $this->vendorModel = new VendorModel($conn);
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
                if (empty($email)) {
                    $error = "Email is required.";
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $error = "Invalid email format.";
                } elseif (empty($password)) {
                    $error = "Password is required.";
                } else {
                    $userType = $this->getUserType($currentPath);

                    $maxAttempts = 5;
                    $lockoutTime = 60;

                    if (isset($_SESSION['login_attempts']) && isset($_SESSION['login_attempts'][$email]) && $_SESSION['login_attempts'][$email]['count'] >= $maxAttempts && (time() - $_SESSION['login_attempts'][$email]['last_attempt'] < $lockoutTime)) {
                        $error = "Too many login attempts. Please try again later.";
                    } else {

                        $user = $this->authModel->getUserByEmail($email, $userType, null);

                        if (!$user) {
                            $error = "Email not found.";
                        } elseif (!password_verify($password, $user['PASSWORD'])) {
                            $error = "Incorrect password.";
                        } else {
                            unset($user['PASSWORD']);
                            $_SESSION[SESSION_USER_ID] = $user['ID'];
                            $_SESSION[SESSION_USER_ROLE] = $userType;
                            $_SESSION[SESSION_USER_DATA] = $user;
                            CSRFToken::clearToken();
                            unset($_SESSION['login_attempts'][$email]);
                            $this->redirectTo($userType);
                        }

                        if (!$user) {
                            if (!isset($_SESSION['login_attempts'][$email])) {
                                $_SESSION['login_attempts'][$email] = ['count' => 0, 'last_attempt' => 0];
                            }
                            $_SESSION['login_attempts'][$email]['count']++;
                            $_SESSION['login_attempts'][$email]['last_attempt'] = time();
                            error_log("Authentication failed for email: " . $email . " (User Type: " . $userType . ")");
                        }
                    }
                }
            }
        }

        include ROOT_DIR . 'pages/auth/login.php';
        return;
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
                if (empty($email) || empty($password) || empty($number) || empty($name)) {
                    $error = "Please fill in all required fields.";
                } elseif (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
                    $error = "Name should only contain alphabets and spaces.";
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $error = "Invalid email format.";
                } elseif (!preg_match('/^01[0-9]{9}$/', $number)) {
                    $error = "Phone number must be 11 digits and start with '01'.";
                } elseif ($response = $this->authModel->checkPhoneNumberForRegistration($number)) {
                    $error = $response;
                } elseif (strlen($password) < 8 || !preg_match('/[a-z]/', $password) || !preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password)) {
                    $error = "Password must be at least 8 characters long and contain lowercase, uppercase, and numbers.";
                } elseif ($password !== $cpassword) {
                    $error = "Passwords do not match.";
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $error = "Invalid email format.";
                } elseif ($response = $this->authModel->chekEmailForRegistration($email)) {
                    $error = $response;
                } elseif ($userType === 'vendor' && (empty($businessName) || empty($businessAddress) || empty($kitchenType) || empty($cuisineType) || empty($delivery))) {
                    $error = "Please provide business details for vendor registration.";
                } elseif ($userType === 'vendor' && !preg_match('/^[a-zA-Z0-9\s\-\_\.]+$/', $businessName)) {
                    $error = "Invalid business name format. Only letters, numbers, spaces, hyphens, underscores, and periods are allowed.";
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
                            $maxFileSize = 2 * 1024 * 1024;
                            if ($image['size'] > $maxFileSize) {
                                $error = "Image size exceeds the limit.";
                            } else {
                                $targetDir = PUBLIC_DIR . "/uploads/vendors/";
                                $imageFileType = strtolower(pathinfo($image["name"], PATHINFO_EXTENSION));
                                $allowedExtensions = ["jpg", "jpeg", "png", "gif"];
                                if (!in_array($imageFileType, $allowedExtensions)) {
                                    $error = "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
                                } else {
                                    $fileName = uniqid() . "." . $imageFileType;
                                    $targetFile = $targetDir . $fileName;

                                    if (move_uploaded_file($image["tmp_name"], $targetFile)) {
                                        $userData['outlet_image'] = $fileName;
                                    } else {
                                        $error = "Error uploading file.";
                                    }
                                }
                            }

                        } else if ($image['error'] !== 4) {
                            $error = "Image upload failed. Ensure the file is valid.";
                        }
                    }

                    $conn = $this->authModel->getConnection();

                    $user = $this->authModel->registerUser($userData, $userType);

                    if ($user) {
                        unset($user['PASSWORD']);
                        $_SESSION[SESSION_USER_ID] = $user['ID'];
                        $_SESSION[SESSION_USER_ROLE] = $userType;
                        $_SESSION[SESSION_USER_DATA] = $user;
                        CSRFToken::clearToken();

                        if ($userType === 'vendor' && isset($_POST['ctype'])) {
                            $vendorId = $user['ID'];
                            $cuisineTypes = explode(",", $_POST['ctype']);

                            if (!$this->vendorModel->addCuisineTypes($vendorId, $cuisineTypes)) {
                                oci_rollback($conn);

                                $error = "Registration failed. Error adding cuisine types.";
                                $this->logOciError("register", "Error adding cuisine types", null, null, $this->vendorModel->getLastError());
                                include ROOT_DIR . 'pages/auth/register.php';
                                return;
                            }

                        }

                        oci_commit($conn);
                        $this->redirectTo($userType);

                    } else {
                        oci_rollback($conn);

                        if (!empty($uploadedFilePath) && file_exists($uploadedFilePath)) {
                            unlink($uploadedFilePath);
                        }

                        $error = "Registration failed. Please check the form and try again.";
                        include ROOT_DIR . 'pages/auth/register.php';
                        return;
                    }
                }
            }
        }

        include ROOT_DIR . 'pages/auth/register.php';
        return;
    }

    public function logout($context)
    {
        $_SESSION = [];

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
        $redirectPath = match ($currentPath) {
            '/business/logout' => '/business/login',
            '/admin/logout' => '/admin/login',
            default => '/login',
        };

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