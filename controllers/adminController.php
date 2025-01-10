<?php
include_once '../config/db.php';
include_once '../config/session.php';

function adminLogin($email, $password)
{
    global $conn;

    // SQL to check user credentials
    $sql = "SELECT * FROM admin WHERE email = :email";
    $stid = oci_parse($conn, $sql);
    oci_bind_by_name($stid, ":email", $email);
    oci_execute($stid);

    // Fetch the result
    $user = oci_fetch_assoc($stid);

    // Check if we found a matching user
    if ($user && $user['PASSWORD'] === $password) {
        // Store user in session
        $_SESSION['user'] = [
            'email' => $user['EMAIL'],
            'role' => $user['ROLE'],
        ];

        // Redirect based on the role
        if ($user['ROLE'] == 'admin') {
            header("Location: /tiffincraft/admin/dashboard");
        } else {
            // Default redirect if the role is not recognized
            header("Location: /tiffincraft/admin/login?error=Unauthorized");
        }
        exit();
    } else {
        // If incorrect, return error
        header("Location: /tiffincraft/admin/login?error=Invalid+email+or+password");
        exit();
    }
}

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Call the login function from the controller
    adminLogin($email, $password);
}
?>