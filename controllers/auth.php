<?php

// Ensure the session starts only once
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
function isUserLoggedIn()
{
    return isset($_SESSION['user']);
}

// Logout function
function logout()
{
    // Check if the user is logged in
    if (isset($_SESSION['user'])) {
        $role = $_SESSION['user']['role']; // Get the user's role
    } else {
        $role = null; // No user is logged in
    }

    // Destroy the session
    session_unset();
    session_destroy();

    // Redirect based on role
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
            header('Location: /tiffincraft/'); // Default redirect for logged-out users
    }

    exit(); // Ensure no further code executes after redirection
}
