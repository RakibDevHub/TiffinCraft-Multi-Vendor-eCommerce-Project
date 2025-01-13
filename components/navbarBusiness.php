<?php
include_once __DIR__ . '../../controllers/auth.php'; // Adjust the path as needed
$isLoggedIn = isUserLoggedIn();

// Check for the 'logout' action in the URL
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    logout();
}

?>

<nav class="nav-container">
    <a href="/tiffincraft/business" class="nav-logo">
        <img src="../../tiffincraft/assets/images/logo.png" class="logo-mini" alt="Logo" />
        <span>TiffinCraft-Business</span>
    </a>
    <div class="nav-buttons">
        <li class="logged-out nav-btn"><a class="fill" href="/tiffincraft/business/login">Sign In</a></li>
        <li class="logged-in nav-btn"><a class="fill" href="?action=logout">Sign Out</a></li>
        <i class="fa-solid fa-bars hidden" id="menu-bar"></i>
    </div>
</nav>

<script>
    const userLoggedIn = <?php echo json_encode($isLoggedIn); ?>;
</script>