<?php

// Start the session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database connection
try {
    include_once 'config/connectDB.php';

    // Check Connection successful or fail
    if (!$conn) {
        $e = oci_error();
        throw new Exception("Oracle connection failed: " . $e['message']);
    }

    // Set timezone
    date_default_timezone_set('Asia/Dhaka');

} catch (Exception $e) {
    // Log the error
    error_log("Error in init.php: " . $e->getMessage());

    // Display a user-friendly message in production:
    // die("A critical error occurred. Please contact support.");

    // Display detailed message in development:
    die("A critical error occurred. Please check your PHP error log for details.");
}

// project root
define('PROJECT_ROOT', __DIR__ . '/');
?>