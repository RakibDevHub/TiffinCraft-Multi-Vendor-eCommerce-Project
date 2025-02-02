<?php
namespace App\Models;

class AuthModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getUserByEmail($email, $userType, $excludeId = null)
    {
        try {
            $table = $this->getTableName($userType);
            $query = "SELECT * FROM $table WHERE UPPER(email) = UPPER(:email)";

            if ($excludeId) {
                $query .= " AND id != :excludeUserId";
            }

            $stmt = oci_parse($this->conn, $query);
            if (!$stmt) {
                $this->logOciError("OCI parse error (getUserByEmail)", $this->conn, $query);
                return null;
            }

            $email = trim($email);
            oci_bind_by_name($stmt, ':email', $email);

            if ($excludeId) {
                oci_bind_by_name($stmt, ':excludeUserId', $excludeId, -1, SQLT_INT);
            }

            if (!oci_execute($stmt)) {
                $this->logOciError("getUserByEmail query execution failed", $stmt, $query, [':email' => $email, ':excludeUserId' => $excludeId]);
                oci_free_statement($stmt);
                return null;
            }

            $user = oci_fetch_assoc($stmt);
            oci_free_statement($stmt);

            return $user !== false ? $user : null;
        } catch (\Exception $e) {
            $this->logOciError("getUserByEmail", "Exception caught", null, $query, [':email' => $email, ':excludeUserId' => $excludeId], $e);
            return null;
        }
    }

    public function getUserById($userId, $userType)
    {
        try {
            $table = $this->getTableName($userType);
            $query = "SELECT * FROM $table WHERE id = :id";

            $stmt = oci_parse($this->conn, $query);
            if (!$stmt) {
                $this->logOciError("OCI parse error (getUserById)", $this->conn, $query);
                return null;
            }

            oci_bind_by_name($stmt, ':id', $userId, -1, SQLT_INT);

            if (!oci_execute($stmt)) {
                $this->logOciError("getUserById query execution failed", $stmt, $query, [':id' => $userId]);
                oci_free_statement($stmt);
                return null;
            }

            $result = oci_fetch_assoc($stmt);
            oci_free_statement($stmt);

            return $result !== false ? $result : null;
        } catch (\Exception $e) {
            $this->logOciError("getUserById", "Exception caught", null, $query, [':id' => $userId], $e);
            return null;
        }
    }

    public function chekEmailForRegistration($email)
    {
        try {
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
        } catch (\Exception $e) {
            $this->logOciError("chekEmailForRegistration", "Exception caught", null, $query, [':email' => $email], $e);
            return false;
        }
    }

    public function checkPhoneNumberForRegistration($phoneNumber)
    {
        try {
            $query = "SELECT 1 FROM users WHERE phone_number = :phone_number
            UNION ALL
            SELECT 1 FROM vendors WHERE phone_number = :phone_number
            UNION ALL
            SELECT 1 FROM admins WHERE phone_number = :phone_number";

            $stmt = oci_parse($this->conn, $query);
            oci_bind_by_name($stmt, ':phone_number', $phoneNumber);
            oci_execute($stmt);

            if (oci_fetch_row($stmt)) {
                return "Phone number is already in use. Please choose a different number.";
            } else {
                return false;
            }
            oci_free_statement($stmt);
        } catch (\Exception $e) {
            $this->logOciError("checkPhoneNumberForRegistration", "Exception caught", null, $query, [':phone_number' => $phoneNumber], $e);
            return false;
        }
    }

    public function registerUser($userData, $userType)
    {
        try {
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
        } catch (\Exception $e) {
            oci_rollback($this->conn);
            $this->logOciError("registerUser", "Exception caught", null, $query, $userData, $e);
            return false;
        }
    }

    private function getTableName($userType)
    {
        return match ($userType) {
            'admin' => 'admins',
            'vendor' => 'vendors',
            default => 'users',
        };
    }

    private function logOciError($functionName, $message, $resource, $query = null, $params = null, \Exception $e = null)
    {
        $error = oci_error($resource);
        $errorMessage = "Error in $functionName: $message - ";

        if ($error) {
            $errorMessage .= $error['message'] . " (Code: " . $error['code'] . ")";
        }

        if ($query) {
            $errorMessage .= "\nQuery: " . $query;
        }

        if ($params) {
            $errorMessage .= "\nParameters: " . print_r($params, true);
        }

        if ($e) {
            $errorMessage .= "\nException: " . $e->getMessage() . "\nTrace: " . $e->getTraceAsString();
        }

        error_log($errorMessage);
    }
}

?>