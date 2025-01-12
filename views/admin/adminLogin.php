<?php
include_once '../../config/session.php';

// Redirect logged-in admins to the dashboard
if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {
    header('Location: /tiffincraft/admin/dashboard');
    exit();
}

// Display sanitized error if login fails
$error = null;
if (isset($_GET['error'])) {
    $error = htmlspecialchars($_GET['error']);
}

// Generate CSRF token if not already set
// if (empty($_SESSION['csrf_token'])) {
//     $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
// }
// ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="/tiffincraft/assets/css/admin-login.css">
</head>

<body>
    <div class="login-container">
        <h2>Admin Login</h2>

        <!-- Display error if login fails -->
        <?php if ($error): ?>
            <div class="alert error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form class="login-form" action="../../tiffincraft/controllers/adminController.php" method="POST">
            <!-- <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>"> -->

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn">Login</button>
            <div class="form-footer">
                <a href="/tiffincraft/admin/forgot-password">Forgot Password?</a>
            </div>
        </form>
    </div>
</body>

</html>