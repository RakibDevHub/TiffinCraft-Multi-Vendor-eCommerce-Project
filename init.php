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

include_once ROOT_DIR . 'app/Service/Database.php';
include_once ROOT_DIR . 'app/Service/Config.php';

use App\Service\Database;

Database::initialize();

register_shutdown_function(function () {
    Database::closeConnection();
});


