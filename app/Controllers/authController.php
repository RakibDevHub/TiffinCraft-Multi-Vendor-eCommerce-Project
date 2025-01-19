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
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $submittedToken = $_POST['csrf_token'] ?? '';

            if (!CSRFToken::validateToken($submittedToken)) {
                $error = "Invalid CSRF token.";
            } else {
                $userModel = new UserModel($conn);
                $userType = $this->getUserTypeFromPath($currentPath);
                $user = $userModel->authenticate($email, $password, $userType);

                if ($user) {
                    $_SESSION[SESSION_USER_ID] = $user['user_id'];
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
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!CSRFToken::validateToken($_POST['csrf_token'] ?? '')) {
                $error = "Invalid CSRF token.";
            } else {
                $userModel = new UserModel($conn);
                $userType = $this->getUserTypeFromPath($currentPath);

                $username = $_POST['username'] ?? ($_POST['fname'] ?? '') . ' ' . ($_POST['lname'] ?? '');
                $email = $_POST['uemail'] ?? '';
                $password = $_POST['upassword'] ?? '';
                $cpassword = $_POST['cpassword'] ?? '';
                $number = $_POST['number'] ?? '';
                $outlet = $_POST['outlet'] ?? null;
                $outletAddress = $_POST['outlet-address'] ?? null;
                $image = $_FILES['image'] ?? null;

                if (empty($email) || empty($password) || empty($username) || empty($number) || ($userType == 'vendor' && (empty($outlet) || empty($outletAddress)))) {
                    $error = "Please fill in all required fields.";
                } elseif ($password !== $cpassword) {
                    $error = "Passwords do not match.";
                } elseif ($userModel->getUserByEmail($email, $userType)) {
                    $error = "Email already exists.";
                } else {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $userData = [
                        'name' => $username, // Use 'name' consistently
                        'email' => $email,
                        'password' => $hashedPassword,
                        'phone_number' => $number,
                    ];

                    if ($userType === 'vendor') {
                        $userData['outlet_name'] = $outlet;
                        $userData['outlet_address'] = $outletAddress;
                        if ($image && $image['error'] === UPLOAD_ERR_OK) {
                            $targetDir = "uploads/";
                            $targetFile = $targetDir . basename($image["name"]);
                            if (move_uploaded_file($image["tmp_name"], $targetFile)) {
                                $userData['outlet_image'] = $targetFile;
                            } else {
                                $error = "Error uploading image.";
                            }
                        }
                    }
                    if ($userModel->registerUser($userData, $userType)) {
                        $success = "Registration successful!";
                    } else {
                        $error = "Registration failed. Please try again.";
                    }
                }
            }
        }

        include ROOT_DIR . 'pages/auth/register.php';
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
        if ($role === 'admin') {
            header('Location: /admin/dashboard');
        } elseif ($role === 'vendor') {
            header('Location: /business/dashboard');
        } else {
            header('Location: /');
        }
        exit;
    }
}