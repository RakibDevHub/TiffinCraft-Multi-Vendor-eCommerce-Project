<?php
namespace App\Models;

class AuthModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getUserByEmail($email, $userType, $excludeId)
    {
        $table = $this->getTableName($userType);
        $query = "SELECT * FROM $table WHERE email = :email";

        if ($excludeId) {
            $query .= " AND id != :excludeUserId";
        }

        $stmt = oci_parse($this->conn, $query);
        oci_bind_by_name($stmt, ':email', $email);
        if ($excludeId) {
            oci_bind_by_name($stmt, ':excludeUserId', $excludeId, -1, SQLT_INT);
        }

        oci_execute($stmt);
        $user = oci_fetch_assoc($stmt);
        oci_free_statement($stmt);
        return $user;
    }

    public function getUserById($userId, $userType, array $excludeColumns = [])
    {
        $table = $this->getTableName($userType);

        $columns = $this->getColumnsExcluding($table, $excludeColumns);
        if (!$columns) {
            $columns = "ID";
        }

        $query = "SELECT $columns FROM $table WHERE id = :id";

        $stmt = oci_parse($this->conn, $query);
        if (!$stmt) {
            $this->logOciError("OCI parse error (getUserById)", $this->conn);
            return false;
        }

        oci_bind_by_name($stmt, ':id', $userId, -1, SQLT_INT);

        if (!oci_execute($stmt)) {
            $this->logOciError("getUserById query execution failed", $stmt);
            oci_free_statement($stmt);
            return false;
        }

        $result = oci_fetch_assoc($stmt);
        oci_free_statement($stmt);

        return $result !== false ? $result : null;
    }

    public function chekEmailForRegistration($email)
    {
        $query = "SELECT 'users' AS table_name FROM users WHERE email = :email
                  UNION ALL
                  SELECT 'vendors' AS table_name FROM vendors WHERE email = :email
                  UNION ALL
                  SELECT 'admins' AS table_name FROM admins WHERE email = :email";

        $stmt = oci_parse($this->conn, $query);
        oci_bind_by_name($stmt, ':email', $email);
        oci_execute($stmt);

        if ($row = oci_fetch_assoc($stmt)) {
            switch ($row['TABLE_NAME']) {
                case 'admins':
                    return "Already have an admin account with this email";
                case 'vendors':
                    return "Already have a vendor account with this email";
                default:
                    return "Already have an account with this email";
            }
        } else {
            return false;
        }
        oci_free_statement($stmt);
    }

    public function checkPhoneNumberForRegistration($phoneNumber)
    {
        $query = "SELECT 1 FROM users WHERE phone_number = :phone_number
                  UNION ALL
                  SELECT 1 FROM vendors WHERE phone_number = :phone_number
                  UNION ALL
                  SELECT 1 FROM admins WHERE phone_number = :phone_number"; // Check ALL tables

        $stmt = oci_parse($this->conn, $query);
        oci_bind_by_name($stmt, ':phone_number', $phoneNumber);
        oci_execute($stmt);

        if (oci_fetch_row($stmt)) { // Phone number exists in ANY table
            return "Phone number is already in use. Please choose a different number.";
        } else {
            return false; // Phone number is unique
        }
        oci_free_statement($stmt);
    }

    public function registerUser($userData, $userType)
    {
        $table = $this->getTableName($userType);
        $columns = implode(", ", array_keys($userData));
        $placeholders = ":" . implode(", :", array_keys($userData));
        $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";

        $stmt = oci_parse($this->conn, $query);
        if (!$stmt) {
            $this->logOciError("OCI parse error (registerUser)", $this->conn);
            return false;
        }

        foreach ($userData as $key => &$value) {
            $dataType = SQLT_CHR;
            $length = -1;

            switch ($key) {
                case 'id':
                case 'is_verified':
                    $dataType = SQLT_INT;
                    break;
                case 'name':
                case 'email':
                case 'password':
                case 'business_name':
                case 'business_address':
                case 'outlet_image':
                case 'kitchen_type':
                case 'cuisine_type':
                case 'verification_token':
                case 'status':
                    $length = 255;
                    break;
                case 'phone_number':
                    $length = 20;
                    break;
                case 'description':
                case 'delivery_areas':
                    $dataType = SQLT_CLOB;
                    break;
                case 'created_at':
                case 'updated_at':
                    $dataType = SQLT_TIMESTAMP;
                    break;
                default:
                    break;
            }

            if (!oci_bind_by_name($stmt, ":$key", $value, $length, $dataType)) {
                $this->logOciError("OCI bind error for key $key", $stmt);
                oci_free_statement($stmt);
                oci_rollback($this->conn);
                return false;
            }
        }
        unset($value);

        if (!oci_execute($stmt, OCI_NO_AUTO_COMMIT)) {
            $this->logOciError("Registration query failed", $stmt);
            oci_free_statement($stmt);
            oci_rollback($this->conn);
            return false;
        }

        oci_free_statement($stmt);

        if (oci_commit($this->conn)) {
            $user = $this->getUserByEmail($userData['email'], $userType, null);
            return $user ? $user : false;
        } else {
            $this->logOciError("Commit failed", $this->conn);
            oci_rollback($this->conn);
            return false;

        }
    }

    private function getColumnsExcluding($tableName, array $excludeColumns = [])
    {
        $query = "SELECT COLUMN_NAME FROM USER_TAB_COLUMNS WHERE TABLE_NAME = :tableName";
        $stmt = oci_parse($this->conn, $query);

        if (!$stmt) {
            $this->logOciError("OCI parse error (getColumnsExcluding)", $this->conn);
            return false;
        }

        $upperTableName = strtoupper($tableName);
        oci_bind_by_name($stmt, ':tableName', $upperTableName);

        if (!oci_execute($stmt)) {
            $this->logOciError("getColumnsExcluding query execution failed", $stmt);
            oci_free_statement($stmt);
            return false;
        }

        $columns = [];
        $upperExcludeColumns = [];
        foreach ($excludeColumns as $excludeColumn) {
            $upperExcludeColumns[] = strtoupper($excludeColumn);
        }

        while ($row = oci_fetch_assoc($stmt)) {
            $columnName = strtoupper($row['COLUMN_NAME']);
            if (!in_array($columnName, $upperExcludeColumns)) {
                $columns[] = $row['COLUMN_NAME'];
            }
        }

        oci_free_statement($stmt);

        return $columns ? implode(", ", $columns) : false;
    }

    private function getTableName($userType)
    {
        return match ($userType) {
            'admin' => 'admins',
            'vendor' => 'vendors',
            default => 'users',
        };
    }

    private function logOciError($functionName, $message, $resource)
    {
        $error = oci_error($resource);
        error_log("Error in $functionName: $message - " . $error['message'] . " (Code: " . $error['code'] . ")");
    }
}

?>