<?php

namespace App\Service;

use Exception;

class Database
{
    private static $conn;
    private static $dbUsername;
    private static $dbPassword;
    private static $dbHost;
    private static $dbServiceName;

    private function __construct()
    {
    }

    public static function initialize()
    { // Initialize configuration (e.g., in bootstrap)
        $envFile = dirname(__DIR__, 2) . '/.env';
        if (!file_exists($envFile)) {
            error_log("Environment file (.env) not found.");
            throw new Exception("Environment file (.env) missing");
        }

        $env = parse_ini_file($envFile);
        self::$dbUsername = $env['DB_USERNAME'] ?? '';
        self::$dbPassword = $env['DB_PASSWORD'] ?? '';
        self::$dbHost = $env['DB_HOST'] ?? '';
        self::$dbServiceName = $env['DB_SERVICE_NAME'] ?? '';
    }

    public static function getConnection()
    {
        if (!self::$conn) {
            try {
                self::$conn = oci_connect(self::$dbUsername, self::$dbPassword, "//" . self::$dbHost . "/" . self::$dbServiceName);
                if (!self::$conn) {
                    $error = oci_error();
                    throw new Exception("Oracle connection failed: " . $error['message']);
                }
            } catch (Exception $e) {
                $connectionString = "//" . self::$dbHost . "/" . self::$dbServiceName;
                error_log("Oracle connection failed: " . $e->getMessage() . " (Connection string: " . $connectionString . ")");
                throw new Exception("A database error occurred. Please contact the administrator.");
            }
        }
        return self::$conn;
    }

    public static function closeConnection()
    {
        if (self::$conn) {
            oci_close(self::$conn);
            self::$conn = null; // Reset the connection after closing
        }
    }
}