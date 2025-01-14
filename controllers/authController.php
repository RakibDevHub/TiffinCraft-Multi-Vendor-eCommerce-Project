<?php
class AuthController
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;

        // Ensure the session starts only once
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Check if the user is logged in
    public function isUserLoggedIn()
    {
        return isset($_SESSION['user']);
    }

    // Handle login functionality
    public function login($email, $password, $role)
    {
        $table = '';
        $url = '';

        // Determine the table and redirection based on role
        switch ($role) {
            case 'admin':
                $table = 'admin';
                $url = '/tiffincraft/admin/dashboard';
                break;
            case 'vendor':
                $table = 'vendors';
                $url = '/tiffincraft/business/dashboard';
                break;
            case 'customer':
                $table = 'users';
                $url = '/tiffincraft/';
                break;
            default:
                $_SESSION['error'] = 'Invalid role specified.';
                $error = "An unexpected error occurred.";
                header('Location: /tiffincraft/login?message=' . urlencode($error));
                exit();
        }

        // Query to fetch user by email
        $sql = "SELECT * FROM $table WHERE email = :email";
        $stid = oci_parse($this->conn, $sql);
        oci_bind_by_name($stid, ':email', $email);
        oci_execute($stid);

        $user = oci_fetch_assoc($stid);

        // Validate user and password
        if (!$user || $user['PASSWORD'] !== $password) {
            $_SESSION['error'] = 'Invalid email or password.';

            // Redirect the user back to their respective login page based on role
            switch ($role) {
                case 'admin':
                    header('Location: /tiffincraft/admin/login');
                    break;
                case 'vendor':
                    header('Location: /tiffincraft/business/login');
                    break;
                case 'customer':
                    header('Location: /tiffincraft/login');
                    break;
                default:
                    header('Location: /tiffincraft/');
            }
            exit();
        }


        // Set session variables
        session_regenerate_id();
        $_SESSION['user'] = [
            'email' => $user['EMAIL'],
            'role' => $role,
        ];

        // Redirect based on role
        $message = "Successfully Logged in.";
        header("Location: $url?message=" . urlencode($message));
        exit();
    }

    // Handle logout functionality
    public function logout()
    {
        $role = isset($_SESSION['user']['role']) ? $_SESSION['user']['role'] : null;

        // Destroy session
        session_unset();
        session_destroy();
        $message = "Successfully logged out.";
        // Redirect based on role
        switch ($role) {
            case 'admin':
                header('Location: /tiffincraft/admin/login?message=' . urlencode($message));
                break;
            case 'vendor':
                header('Location: /tiffincraft/business/login?message=' . urlencode($message));
                break;
            case 'customer':
                header('Location: /tiffincraft/login?message=' . urlencode($message));
                break;
            default:
                header('Location: /tiffincraft/');
        }

        exit();
    }
}

?>