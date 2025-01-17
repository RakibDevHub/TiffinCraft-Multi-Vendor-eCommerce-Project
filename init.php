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
function autoload($className)
{
    $file = ROOT_DIR . '/' . str_replace('\\', '/', $className) . '.php';

    if (file_exists($file)) {
        require_once $file;
        return;
    } else {
        // Debugging: Log missing file
        error_log("Autoloader failed to find: $file");
        die("Class {$className} not found.");
    }
}
spl_autoload_register('autoload');


// Include the database connection file (optional, if applicable)
try {
    include_once ROOT_DIR . 'app/Config/database.php';

    // Check if the connection was successful
    if (!isset($conn) || !$conn) {
        $e = oci_error();
        throw new Exception("Oracle connection failed: " . $e['message']);
    }
    return $conn;

} catch (Exception $e) {
    // Log the error
    error_log("Database connection error: " . $e->getMessage());

    // Display a user-friendly message
    die("A critical error occurred. Please contact support.");
}
