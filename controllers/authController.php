<?php
class AuthController
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function generateCSRFToken()
    {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    public function isUserLoggedIn()
    {
        return isset($_SESSION['user']) && isset($_SESSION['user']['id']);
    }

    public function login($email, $password, $role, $csrfToken)
    {
        if (!isset($_SESSION['csrf_token']) || $csrfToken !== $_SESSION['csrf_token']) {
            $_SESSION['error'] = 'Invalid CSRF token.';
            switch ($role) { // Redirect to the correct login page
                case 'admin':
                    header('Location: /tiffincraft/admin/login');
                    break;
                case 'vendor':
                    header('Location: /tiffincraft/business/login');
                    break;
                case 'customer':
                default:
                    header('Location: /tiffincraft/login');
                    break;
            }
            exit();
        }

        $table = '';
        $url = '';
        $idColumn = '';
        $passwordColumn = 'password';

        switch ($role) {
            case 'admin':
                $table = 'admin';
                $url = '/tiffincraft/admin/dashboard';
                $idColumn = 'admin_id';
                $passwordColumn = 'admin_password';
                break;
            case 'vendor':
                $table = 'users';
                $url = '/tiffincraft/business/dashboard';
                $idColumn = 'user_id';
                $passwordColumn = 'password';
                break;
            case 'customer':
                $table = 'users';
                $url = '/tiffincraft/';
                $idColumn = 'user_id';
                $passwordColumn = 'password';
                break;
            default:
                $_SESSION['error'] = 'Invalid role specified.';
                header('Location: /tiffincraft/login');
                exit();
        }

        $sql = "SELECT $idColumn as id, user_name, email, $passwordColumn as password FROM $table WHERE UPPER(email) = UPPER(:email)";
        $stid = oci_parse($this->conn, $sql);
        oci_bind_by_name($stid, ':email', $email);
        oci_execute($stid);

        $user = oci_fetch_assoc($stid);

        if (!$user || !password_verify($password, $user['PASSWORD'])) {
            $_SESSION['error'] = 'Invalid email or password.';
            switch ($role) {
                case 'admin':
                    header('Location: /tiffincraft/admin/login');
                    break;
                case 'vendor':
                    header('Location: /tiffincraft/business/login');
                    break;
                case 'customer':
                default:
                    header('Location: /tiffincraft/login');
                    break;
            }
            exit();
        }

        session_regenerate_id();
        $_SESSION['user'] = [
            'id' => $user['ID'],
            'email' => $user['EMAIL'],
            'name' => $user['USER_NAME'],
            'role' => $role,
        ];

        $message = "Successfully Logged in.";
        header("Location: $url?message=" . urlencode($message));
        exit();
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: /tiffincraft/');
        exit();
    }
}
?>