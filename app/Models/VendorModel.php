<?php
namespace App\Models;

class VendorModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getPopularVendors(int $limit)
    {
        try {
            $query = "SELECT * FROM (SELECT * FROM vendors WHERE STATUS = 'accept' ORDER BY id DESC) WHERE ROWNUM <= :limit";

            $stmt = oci_parse($this->conn, $query);
            if (!$stmt) {
                $this->logOciError("getPopularVendors", "OCI parse error", $this->conn, $query);
                return [];
            }

            oci_bind_by_name($stmt, ':limit', $limit, -1, SQLT_INT);

            if (!oci_execute($stmt)) {
                $this->logOciError("getPopularVendors", "Query execution failed", $stmt, $query, [':limit' => $limit]);
                oci_free_statement($stmt);
                return [];
            }

            $vendors = [];
            while ($row = oci_fetch_assoc($stmt)) {
                $clobColumns = ['DESCRIPTION', 'DELIVERY_AREAS'];

                foreach ($clobColumns as $column) {
                    if (isset($row[$column])) {
                        $clob = $row[$column];
                        if (is_object($clob)) {
                            $data = $clob->load();
                            $row[$column] = $data;
                        } else {
                            $row[$column] = null;
                        }
                    }
                }
                unset($vendors['PASSWORD']);
                $vendors[] = $row;
            }

            oci_free_statement($stmt);
            return $vendors;

        } catch (\Exception $e) {
            $this->logOciError("getPopularVendors", "Exception caught", null, $query, [':limit' => $limit], $e);
            return [];
        }
    }

    public function getAllVendors($status = null)
    {
        try {
            $query = "SELECT * FROM vendors";
            if ($status !== null) {
                $query .= " WHERE STATUS = :status";
            }

            $stmt = oci_parse($this->conn, $query);
            if (!$stmt) {
                $this->logOciError("getAllVendors", "OCI parse error", $this->conn, $query);
                return [];
            }

            if ($status !== null) {
                oci_bind_by_name($stmt, ':status', $status);
            }

            if (!oci_execute($stmt)) {
                $this->logOciError("getAllVendors", "Query execution failed", $stmt, $query, [':status' => $status]);
                oci_free_statement($stmt);
                return [];
            }

            $vendors = [];
            while ($row = oci_fetch_assoc($stmt)) {
                $clobColumns = ['DESCRIPTION', 'DELIVERY_AREAS'];

                foreach ($clobColumns as $column) {
                    if (isset($row[$column])) {
                        $clob = $row[$column];
                        if (is_object($clob)) {
                            $data = $clob->load();
                            $row[$column] = $data;
                        } else {
                            $row[$column] = null;
                        }
                    }
                }
                unset($row['PASSWORD']);
                $vendors[] = $row;
            }

            oci_free_statement($stmt);
            return $vendors;

        } catch (\Exception $e) {
            $this->logOciError("getAllVendors", "Exception caught", null, $query, [':status' => $status], $e); // Log with exception details
            return [];
        }
    }

    public function getVendorById($id)
    {
        try {
            $query = "SELECT * FROM vendors WHERE id = :id AND STATUS = 'accept'";
            $stmt = oci_parse($this->conn, $query);
            if (!$stmt) {
                $this->logOciError("getVendorById", "OCI parse error", $this->conn, $query);
                return null;
            }

            oci_bind_by_name($stmt, ':id', $id, -1, SQLT_INT);

            if (!oci_execute($stmt)) {
                $this->logOciError("getVendorById", "Query execution failed", $stmt, $query, [':id' => $id]);
                oci_free_statement($stmt);
                return null;
            }

            $vendor = oci_fetch_assoc($stmt);
            oci_free_statement($stmt);

            if (!$vendor) {
                return null;
            }

            $clobColumns = ['DESCRIPTION', 'DELIVERY_AREAS'];
            foreach ($clobColumns as $column) {
                if (isset($vendor[$column])) {
                    $clob = $vendor[$column];
                    if (is_object($clob)) {
                        $vendor[$column] = $clob->load();
                    } else {
                        $vendor[$column] = null;
                    }
                }
            }

            return $vendor;

        } catch (\Exception $e) {
            $this->logOciError("getVendorById", "Exception caught", null, $query, [':id' => $id], $e);
            return null;
        }
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



    // private function getColumnsExcluding(array $excludeColumns = [])
    // {
    //     $query = "SELECT COLUMN_NAME FROM USER_TAB_COLUMNS WHERE TABLE_NAME = :vendors";
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

    //     return $columns ? implode(", ", $columns) : false;
    // }

    // private function logOciError($functionName, $message, $resource)
    // {
    //     $error = oci_error($resource);
    //     error_log("Error in $functionName: $message - " . $error['message'] . " (Code: " . $error['code'] . ")");
    // }
}


?>