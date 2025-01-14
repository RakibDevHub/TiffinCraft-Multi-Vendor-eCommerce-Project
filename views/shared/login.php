<?php

include_once "../../config/connectDB.php";
include_once "../../controllers/authController.php";

$auth = new AuthController($conn);

// Infer the role based on the requested URL
$currentURL = $_SERVER['REQUEST_URI'];
$role = 'customer'; // Default
if (strpos($currentURL, '/business') !== false) {
    $role = 'vendor';
} elseif (strpos($currentURL, '/admin') !== false) {
    $role = 'admin';
}



if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'login') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $auth->login($email, $password, $role);
}

// Generate dynamic form action based on current URL
$currentURL = $_SERVER['REQUEST_URI'];

$error = null;
if (isset($_GET['error'])) {
    $error = htmlspecialchars($_GET['error']);
}

switch ($role) {
    case 'customer':
        $formTitle = 'Tiffincraft';
        break;
    case 'vendor':
        $formTitle = 'Tiffincraft Business';
        break;
    case 'admin':
        $formTitle = 'Tiffincraft Admin';
        break;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="TiffinCraft connects home chefs with food lovers. Explore delicious homemade dishes, join as a vendor, or enjoy meals crafted with care by passionate chefs." />

    <!-- Font Awesome CDN  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/tiffincraft/assets/css/style.css" />

    <title><?= ucfirst($formTitle); ?> Login</title>
</head>

<body>
    <header class="header-section">
        <?php if ($role == 'customer'): ?>
            <?php include_once '../../components/navbar.php' ?>
        <?php elseif ($role == 'vendor'): ?>
            <?php include_once '../../components/NavbarBusiness.php' ?>
        <?php endif; ?>
    </header>

    <section class="form-section">
        <div class="form-container">
            <form class="login-form" action="<?= htmlspecialchars($currentURL); ?>" method="POST">
                <input type="hidden" name="role" value="<?= htmlspecialchars($role); ?>">
                <input type="hidden" name="action" value="login">
                <h2><?= ucfirst($role); ?> Login</h2>
                <?php if (isset($error)): ?>
                    <div class="alert error"><?php echo $error; ?></div>
                <?php endif; ?>
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
                    <a href="#">Forgot Password?</a>
                </div>
            </form>
        </div>
    </section>


    <script src="/tiffincraft/assets/js/main.js" type="module"></script>
</body>

</html>