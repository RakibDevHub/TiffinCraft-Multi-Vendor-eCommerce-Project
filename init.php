<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

date_default_timezone_set('Asia/Dhaka');
define('ROOT_DIR', __DIR__ . '/');
define('PUBLIC_DIR', __DIR__ . '/public');

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

include_once ROOT_DIR . 'app/Config/database.php';
include_once ROOT_DIR . 'app/Config/config.php';
