<?php
include_once '../config/db.php';
include_once '../config/session.php';

function adminLogin($email, $password, $conn)
{
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
        header("Location: /tiffincraft/admin/login?error=" . urlencode($error));
        exit();
    }

    // Query to fetch admin user
    $sql = "SELECT * FROM admin WHERE email = :email";
    $stid = oci_parse($conn, $sql);
    oci_bind_by_name($stid, ":email", $email);
    oci_execute($stid);

    // Fetch user details
    $user = oci_fetch_assoc($stid);

    // Check PASSWORD 
    if (!$user || $user['PASSWORD'] !== $password) {
        $error = "Invalid email or password";
        header("Location: /tiffincraft/admin/login?error=" . urlencode($error));
        exit();
    }

    // Check ROLE
    if ($user['ROLE'] !== 'admin') {
        $error = "Unauthorized access. Admins only.";
        header("Location: /tiffincraft/admin/login?error=" . urlencode($error));
        exit();
    }

    // Regenerate session ID and store session variables
    session_regenerate_id();
    $_SESSION['user'] = [
        'email' => $user['EMAIL'],
        'role' => $user['ROLE'],
    ];

    // Redirect to the admin dashboard with a success message
    $_SESSION['success'] = "Welcome, Admin!";
    header("Location: /tiffincraft/admin/dashboard");
    exit();
}

// Handle the login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Call the admin login function
    adminLogin($email, $password, $conn);
}
?>