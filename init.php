<?php

// Start the session if it's not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Set the default timezone
date_default_timezone_set('Asia/Dhaka');

// Define the project root directory
define('ROOT_DIR', __DIR__ . '/');

// Autoload function
spl_autoload_register(function ($className) {
    $file = ROOT_DIR . str_replace('\\', '/', $className) . '.php';

    if (file_exists($file)) {
        require_once $file;
    } else {
        error_log("Class {$className} not found at {$file}");
        die("A critical error occurred. Please contact support.");
    }
});

// Secure database connection
try {
    include_once ROOT_DIR . 'app/Config/database.php';
    if (!isset($conn) || !$conn) {
        $e = oci_error();
        throw new Exception("Oracle connection failed: " . $e['message']);
    }
} catch (Exception $e) {
    error_log("Database connection error: " . $e->getMessage());
    die("A critical error occurred. Please contact support.");
}
