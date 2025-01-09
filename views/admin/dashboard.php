<?php
session_start();

// Check if user is logged in and has the 'admin' role
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../../tiffincraft/admin/login.php');
    exit;
}

// Proceed with the admin dashboard content
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/tiffincraft/admin/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>

<body>
    <h1>Welcome, <?= htmlspecialchars($_SESSION['user']['email']) ?>!</h1>
    <p>You are logged in as an Admin.</p>
</body>

</html>