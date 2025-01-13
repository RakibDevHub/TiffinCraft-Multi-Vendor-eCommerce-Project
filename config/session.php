<?php
session_start();

// Set the session timeout to 30 minutes
$sessionTimeout = 30 * 60; // 30 minutes in seconds

// Check if the session is active and has a last activity time
if (isset($_SESSION['last_activity'])) {
    $inactiveTime = time() - $_SESSION['last_activity'];

    // If the session is inactive for longer than the session timeout (30 minutes)
    if ($inactiveTime > $sessionTimeout) {
        // Destroy the session and redirect to login page
        session_unset();
        session_destroy();
        $error = "Session Expired";
        header('Location: /tiffincraft/admin/login?error=' . urlencode($error));
        exit();
    }
}

// Update the last activity time
$_SESSION['last_activity'] = time();
?>