<?php

namespace App\Models;

class UserModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // // private function getTableName($userType)
    // // {
    // //     return match ($userType) {
    // //         'admin' => 'admins',
    // //         'vendor' => 'vendors',
    // //         default => 'users',
    // //     };
    // // }

    // // public function authenticate($email, $password, $userType)
    // // {
    // //     $table = $this->getTableName($userType);
    // //     $query = "SELECT id, password FROM $table WHERE email = :email";

    // //     $stmt = oci_parse($this->conn, $query);
    // //     if (!$stmt) {
    // //         $this->logOciError("OCI parse error (authenticate)", $this->conn);
    // //         return false;
    // //     }

    // //     oci_bind_by_name($stmt, ':email', $email);

    // //     if (!oci_execute($stmt)) {
    // //         $this->logOciError("Authentication query failed", $stmt);
    // //         return false;
    // //     }

    // //     $user = oci_fetch_assoc($stmt);

    // //     if ($user && password_verify($password, $user['PASSWORD'])) {
    // //         return ['id' => $user['ID'], 'role' => $userType];
    // //     }

    // //     return false;
    // // }


    // // public function registerUser($userData, $userType)
    // // {
    // //     $table = $this->getTableName($userType);
    // //     $columns = implode(", ", array_keys($userData));
    // //     $placeholders = ":" . implode(", :", array_keys($userData));
    // //     $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";

    // //     $stmt = oci_parse($this->conn, $query);
    // //     if (!$stmt) {
    // //         $this->logOciError("OCI parse error (registerUser)", $this->conn);
    // //         return ['status' => false, 'message' => "Database error occurred"];
    // //     }

    // //     foreach ($userData as $key => &$value) {
    // //         $dataType = SQLT_CHR;
    // //         $length = -1;

    // //         if ($key === 'password') {
    // //             $length = 255;
    // //         }

    // //         if (!oci_bind_by_name($stmt, ":$key", $value, $length, $dataType)) {
    // //             $this->logOciError("OCI bind error for key $key", $stmt);
    // //             oci_free_statement($stmt);
    // //             oci_rollback($this->conn);
    // //             return ['status' => false, 'message' => "Error binding data"];
    // //         }
    // //     }

    // //     // Check for unique phone and email
    // //     $checkPhoneQuery = "SELECT COUNT(*) FROM $table WHERE phone_number = :phone_number";
    // //     $checkPhoneStmt = oci_parse($this->conn, $checkPhoneQuery);
    // //     oci_bind_by_name($checkPhoneStmt, ':phone_number', $userData['phone_number']);
    // //     oci_execute($checkPhoneStmt);
    // //     $phoneCount = oci_fetch_row($checkPhoneStmt)[0];
    // //     oci_free_statement($checkPhoneStmt);

    // //     $checkEmailQuery = "SELECT COUNT(*) FROM $table WHERE email = :email";
    // //     $checkEmailStmt = oci_parse($this->conn, $checkEmailQuery);
    // //     oci_bind_by_name($checkEmailStmt, ':email', $userData['email']);
    // //     oci_execute($checkEmailStmt);
    // //     $emailCount = oci_fetch_row($checkEmailStmt)[0];
    // //     oci_free_statement($checkEmailStmt);

    // //     if ($phoneCount > 0 && $emailCount > 0) {
    // //         return ['status' => false, 'message' => "Phone number and email already exist."];
    // //     } elseif ($phoneCount > 0) {
    // //         return ['status' => false, 'message' => "Phone number already exists."];
    // //     } else {
    // //         return ['status' => false, 'message' => "Email already exists."];
    // //     }

    // //     if (!oci_execute($stmt, OCI_NO_AUTO_COMMIT)) {
    // //         $this->logOciError("Registration query failed", $stmt);
    // //         oci_free_statement($stmt);
    // //         oci_rollback($this->conn);
    // //         return ['status' => false, 'message' => "Registration failed"];
    // //     }

    // //     oci_free_statement($stmt);

    // //     if (!oci_commit($this->conn)) {
    // //         $this->logOciError("Commit failed", $this->conn);
    // //         oci_rollback($this->conn);
    // //         return ['status' => false, 'message' => "Commit failed"];
    // //     }

    // //     return ['status' => true, 'message' => "Registration successful!"];
    // // }


    // // public function getUserByEmail($email, $userType, $excludeUserId = null)
    // // {
    // //     if ($userType === 'admin') {
    // //         $table = 'admin';
    // //     } elseif ($userType === 'vendor') {
    // //         $table = 'vendors';
    // //     } else {
    // //         $table = 'users';
    // //     }

    // //     $query = "SELECT * FROM $table WHERE email = :email";

    // //     // Exclude the current user's ID from the check
    // //     if ($excludeUserId) {
    // //         $query .= " AND id != :excludeUserId";
    // //     }

    // //     $stmt = oci_parse($this->conn, $query);
    // //     oci_bind_by_name($stmt, ':email', $email);
    // //     if ($excludeUserId) {
    // //         oci_bind_by_name($stmt, ':excludeUserId', $excludeUserId, -1, SQLT_INT);
    // //     }

    // //     oci_execute($stmt);
    // //     $result = oci_fetch_assoc($stmt);
    // //     oci_free_statement($stmt);

    // //     return $result !== false ? $result : null;
    // // }

    // // public function getUserById($userId, $userType, array $excludeColumns = [])
    // // {
    // //     $table = $this->getTableName($userType);

    // //     $columns = $this->getColumnsExcluding($table, $excludeColumns);
    // //     if (!$columns) {
    // //         return false;
    // //     }

    // //     $query = "SELECT $columns FROM $table WHERE id = :id";

    // //     $stmt = oci_parse($this->conn, $query);
    // //     if (!$stmt) {
    // //         $this->logOciError("OCI parse error (getUserById)", $this->conn);
    // //         return false;
    // //     }

    // //     oci_bind_by_name($stmt, ':id', $userId, -1, SQLT_INT);

    // //     if (!oci_execute($stmt)) {
    // //         $this->logOciError("getUserById query execution failed", $stmt);
    // //         oci_free_statement($stmt);
    // //         return false;
    // //     }

    // //     $result = oci_fetch_assoc($stmt);
    // //     oci_free_statement($stmt);

    // //     return $result !== false ? $result : null;
    // // }

    // // public function updateProfile($userId, $name, $email, $phone)
    // // {
    // //     $query = "UPDATE users SET name = :name, email = :email, phone_number = :phone WHERE id = :id";
    // //     $stmt = oci_parse($this->conn, $query);

    // //     oci_bind_by_name($stmt, ':name', $name);
    // //     oci_bind_by_name($stmt, ':email', $email);
    // //     oci_bind_by_name($stmt, ':phone', $phone);
    // //     oci_bind_by_name($stmt, ':id', $userId, -1, SQLT_INT);

    // //     $result = oci_execute($stmt);
    // //     oci_free_statement($stmt);

    // //     return $result;
    // // }

    // // public function updatePassword($userId, $hashedPassword)
    // // {
    // //     $query = "UPDATE users SET password = :password WHERE id = :id";
    // //     $stmt = oci_parse($this->conn, $query);

    // //     oci_bind_by_name($stmt, ':password', $hashedPassword);
    // //     oci_bind_by_name($stmt, ':id', $userId, -1, SQLT_INT);

    // //     $result = oci_execute($stmt);
    // //     oci_free_statement($stmt);

    // //     return $result;
    // // }

    // // public function deleteUserById($userId)
    // // {
    // //     $query = "DELETE FROM users WHERE id = :id";
    // //     $stmt = oci_parse($this->conn, $query);

    // //     oci_bind_by_name($stmt, ':id', $userId, -1, SQLT_INT);

    // //     $result = oci_execute($stmt);
    // //     oci_free_statement($stmt);

    // //     return $result;
    // // }

    // private function getColumnsExcluding($tableName, array $excludeColumns = [])
    // {
    //     $query = "SELECT COLUMN_NAME FROM USER_TAB_COLUMNS WHERE TABLE_NAME = :tableName";
    //     $stmt = oci_parse($this->conn, $query);

    //     if (!$stmt) {
    //         $this->logOciError("OCI parse error (getColumnsExcluding)", $this->conn);
    //         return false;
    //     }

    //     $upperTableName = strtoupper($tableName);
    //     oci_bind_by_name($stmt, ':tableName', $upperTableName);

    //     if (!oci_execute($stmt)) {
    //         $this->logOciError("getColumnsExcluding query execution failed", $stmt);
    //         oci_free_statement($stmt);
    //         return false;
    //     }

    //     $columns = [];
    //     $upperExcludeColumns = [];
    //     foreach ($excludeColumns as $excludeColumn) {
    //         $upperExcludeColumns[] = strtoupper($excludeColumn);
    //     }

    //     while ($row = oci_fetch_assoc($stmt)) {
    //         $columnName = strtoupper($row['COLUMN_NAME']);
    //         if (!in_array($columnName, $upperExcludeColumns)) {
    //             $columns[] = $row['COLUMN_NAME'];
    //         }
    //     }

    //     oci_free_statement($stmt);

    //     return $columns ? implode(", ", $columns) : 'ID';
    // }

    // private function logOciError($message, $resource)
    // {
    //     $error = oci_error($resource);
    //     error_log("$message: " . $error['message'] . " (Code: " . $error['code'] . ")");
    // }

}