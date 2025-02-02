<?php
namespace App\Models;

class AdminModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function userCount()
    {
        try {
            $userCount = 0;
            $vendorCount = 0;

            $userCount = $this->getCount('users');
            if ($userCount === false) {
                return false;
            }

            // Count vendors
            $vendorCount = $this->getCount('vendors');
            if ($vendorCount === false) {
                return false;
            }


            return [
                'users' => $userCount,
                'vendors' => $vendorCount,
                'total' => $userCount + $vendorCount,
            ];

        } catch (\Exception $e) {
            $this->logOciError("userCount", "Exception caught", null, null, null, $e);
            return false;
        }
    }

    private function getCount($table)
    {
        $query = "SELECT COUNT(*) AS count FROM $table";
        $stmt = oci_parse($this->conn, $query);
        if (!$stmt) {
            $this->logOciError("getCount", "OCI parse error ($table)", $this->conn, $query);
            return false;
        }
        if (!oci_execute($stmt)) {
            $this->logOciError("getCount", "Query execution failed ($table)", $stmt, $query);
            oci_free_statement($stmt);
            return false;
        }

        if ($row = oci_fetch_assoc($stmt)) {
            $count = (int) $row['COUNT'];
        } else {
            $count = 0;
        }
        oci_free_statement($stmt);
        return $count;
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