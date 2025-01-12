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
