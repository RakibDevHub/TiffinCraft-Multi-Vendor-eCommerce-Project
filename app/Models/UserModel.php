<?php

namespace App\Models;

class UserModel
{
    private $conn;

    public function __construct($dbConnection)
    {
        $this->conn = $dbConnection;

        if (!$this->conn) {
            throw new \Exception("Database connection not initialized.");
        }
    }

    public function authenticateAdmin($email, $password)
    {
        $query = "SELECT * FROM admin WHERE email = :email";
        $stmt = oci_parse($this->conn, $query);
        oci_bind_by_name($stmt, ':email', $email);

        if (!oci_execute($stmt)) {
            $e = oci_error($stmt);
            error_log("Admin authentication query failed: " . $e['message']);
            return null; // Or handle error propagation
        }

        $admin = oci_fetch_assoc($stmt);

        // Verify password and return result
        return $admin && password_verify($password, $admin['password']) ? $admin : null;
    }

    public function authenticateUser($email, $password, $role)
    {
        // Validate role
        $validRoles = ['customer', 'vendor'];
        if (!in_array($role, $validRoles)) {
            error_log("Invalid role provided: " . $role);
            return null;
        }

        $query = "SELECT * FROM users WHERE email = :email AND role = :role";
        $stmt = oci_parse($this->conn, $query);
        oci_bind_by_name($stmt, ':email', $email);
        oci_bind_by_name($stmt, ':role', $role);

        if (!oci_execute($stmt)) {
            $e = oci_error($stmt);
            error_log("User authentication query failed: " . $e['message']);
            return null; // Or handle error propagation
        }

        $user = oci_fetch_assoc($stmt);

        // Verify password and return result
        return $user && password_verify($password, $user['password']) ? $user : null;
    }
}
