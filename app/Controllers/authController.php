<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Utils\CSRFToken;

class AuthController
{
    public function login($context)
    {
        session_start();

        $title = "Login";
        $isLoggedIn = $context['user_id'] ?? false;
        $userRole = $context['userRole'] ?? null;
        $currentPath = $context['currentPath'] ?? '/';

        $csrfToken = CSRFToken::generateToken();

        // Redirect if already logged in
        if ($isLoggedIn) {
            $this->redirectToDashboard($currentPath, $userRole);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $submittedToken = $_POST['csrf_token'] ?? '';

            // CSRF token validation
            if (!CSRFToken::validateToken($submittedToken)) {
                $error = "Invalid CSRF token.";
                include ROOT_DIR . 'pages/auth/login.php';
                return;
            }

            // Authenticate user
            $userModel = new UserModel();
            $userType = $this->getUserTypeFromPath($currentPath);

            $user = $userType === 'admin'
                ? $userModel->authenticateAdmin($email, $password)
                : $userModel->authenticateUser($email, $password, $userType);

            if ($user) {
                // Set session variables after successful authentication
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $userType;

                // Clear CSRF token after successful login
                CSRFToken::clearToken();

                // Redirect to the appropriate dashboard
                $this->redirectToDashboard($currentPath, $userType);
            } else {
                $error = "Invalid email or password.";
            }
        }

        include ROOT_DIR . 'pages/auth/login.php';
    }
    private function getUserTypeFromPath($path)
    {
        // Determine the user type based on the current path
        if (strpos($path, '/admin') !== false) {
            return 'admin';
        } elseif (strpos($path, '/business') !== false) {
            return 'vendor';
        }
        return 'customer';
    }

    private function redirectToDashboard($currentPath, $userRole = null)
    {
        // Redirect based on the current path and/or user role
        if (strpos($currentPath, '/admin') !== false || $userRole === 'admin') {
            header('Location: /admin/dashboard');
        } elseif (strpos($currentPath, '/business') !== false || $userRole === 'vendor') {
            header('Location: /business/dashboard');
        } else {
            header('Location: /');
        }
        exit;
    }
}
