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
$conn = oci_connect($db_username, $db_password, "//{$db_host}/{$db_service_name}");
if (!$conn) {
    $error = oci_error();
    die("Oracle connection failed: " . $error['message']);
} else {
    echo "Connected to Oracle database successfully!";
}
?>