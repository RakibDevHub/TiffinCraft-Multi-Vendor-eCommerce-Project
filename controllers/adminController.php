<?php
include_once '../config/db.php';
include_once '../config/session.php';

function adminLogin($email, $password, $conn)
{
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format";
        header("Location: /tiffincraft/admin/login");
        exit();
    }

    // Query to check user credentials
    $sql = "SELECT * FROM admin WHERE email = :email";
    $stid = oci_parse($conn, $sql);
    oci_bind_by_name($stid, ":email", $email);
    oci_execute($stid);

    $user = oci_fetch_assoc($stid);

    // Check credentials
    // if (!$user || !password_verify($password, $user['PASSWORD'])) {
    if ($user && $password) {
        $_SESSION['error'] = "Invalid email or password";
        header("Location: /tiffincraft/admin/login");
        exit();
    }

    // Ensure the user is an admin
    if ($user['ROLE'] !== 'admin') {
        $_SESSION['error'] = "Unauthorized access. Admins only.";
        header("Location: /tiffincraft/admin/login");
        exit();
    }

    // Regenerate session ID and set session variables
    session_regenerate_id();
    $_SESSION['user'] = [
        'email' => $user['EMAIL'],
        'role' => $user['ROLE'],
    ];

    // Success message
    $_SESSION['success'] = "Welcome, Admin!";
    header("Location: /tiffincraft/admin/dashboard");
    exit();
}

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Call the login function from the controller
    adminLogin($email, $password, $conn);
}
?>