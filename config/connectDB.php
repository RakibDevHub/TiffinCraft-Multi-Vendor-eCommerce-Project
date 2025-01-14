<?php
// Load environment variables
$envFile = dirname(__DIR__) . '/.env';
if (file_exists($envFile)) {
    $env = parse_ini_file($envFile);
} else {
    die("Environment file (.env) not found.");
}

// Get DB credentials from .env
$db_username = $env['DB_USERNAME'] ?? '';
$db_password = $env['DB_PASSWORD'] ?? '';
$db_host = $env['DB_HOST'] ?? '';
$db_service_name = $env['DB_SERVICE_NAME'] ?? '';

// Establish Oracle connection
try {
    $conn = oci_connect($db_username, $db_password, "//{$db_host}/{$db_service_name}");
    if (!$conn) {
        $e = oci_error();
        throw new Exception("Oracle connection failed: " . $e['message']);
    }
} catch (Exception $e) {
    $connectionString = "//{$db_host}/{$db_service_name}";
    error_log("Oracle connection failed: " . $e->getMessage() . " (Connection string: " . $connectionString . ")");
    die("A database error occurred. Please check your PHP error log.");
}
?>