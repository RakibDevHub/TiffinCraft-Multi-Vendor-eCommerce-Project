<?php

namespace App\Models;

class UserModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function authenticate($email, $password, $userType)
    {
        $table = $this->getTableName($userType);
        $query = "SELECT id, password FROM " . $table . " WHERE email = :email";

        $stmt = oci_parse($this->conn, $query);
        if (!$stmt) {
            $e = oci_error($this->conn);
            error_log("OCI parse error (authenticate): " . $e['message']);
            return false;
        }

        oci_bind_by_name($stmt, ':email', $email);

        if (!oci_execute($stmt)) {
            $e = oci_error($stmt);
            error_log("Authentication query failed: " . $e['message']);
            return false;
        }

        $user = oci_fetch_assoc($stmt);

        if ($user && password_verify($password, $user['PASSWORD'])) {
            return [
                'id' => $user['ID'],
                'role' => $userType,
            ];
        }

        return false;
    }

    public function registerUser($userData, $userType)
    {
        $table = $this->getTableName($userType);
        $columns = implode(", ", array_keys($userData));
        $placeholders = ":" . implode(", :", array_keys($userData));
        $query = "INSERT INTO " . $table . " ($columns) VALUES ($placeholders)";

        $stmt = oci_parse($this->conn, $query);
        if (!$stmt) {
            $e = oci_error($this->conn);
            error_log("OCI parse error (registerUser): " . $e['message']);
            return false;
        }

        foreach ($userData as $key => $value) {
            oci_bind_by_name($stmt, ":" . $key, $value);
        }

        if (!oci_execute($stmt)) {
            $e = oci_error($stmt);
            error_log("Registration query failed: " . $e['message']);
            return false;
        }
        return true;
    }

    public function getUserByEmail($email, $userType)
    {
        $table = $this->getTableName($userType);
        $query = "SELECT id FROM " . $table . " WHERE email = :email";

        $stmt = oci_parse($this->conn, $query);
        if (!$stmt) {
            $e = oci_error($this->conn);
            error_log("OCI parse error (getUserByEmail): " . $e['message']);
            return false;
        }

        oci_bind_by_name($stmt, ':email', $email);
        if (!oci_execute($stmt)) {
            $e = oci_error($stmt);
            error_log("getUserByEmail query failed: " . $e['message']);
            return false;
        }
        return oci_fetch_assoc($stmt);
    }

    public function getUserById($userId, $userType)
    {
        $table = $this->getTableName($userType);
        $query = "SELECT * FROM " . $table . " WHERE id = :id"; // Select all columns here

        $stmt = oci_parse($this->conn, $query);
        if (!$stmt) {
            $e = oci_error($this->conn);
            error_log("OCI parse error (getUserById): " . $e['message']);
            return false;
        }
        oci_bind_by_name($stmt, ':id', $userId);
        if (!oci_execute($stmt)) {
            $e = oci_error($stmt);
            error_log("getUserById query failed: " . $e['message']);
            return false;
        }

        return oci_fetch_assoc($stmt);
    }

    private function getTableName($userType)
    {
        return ($userType === 'admin') ? 'admins' : ($userType === 'vendor' ? 'vendors' : 'users');
    }
}