<?php
namespace App\Models;

class VendorModel
{
    private $conn;
    private $lastError = null;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getPopular(int $limit)
    {
        try {
            $query = "SELECT * FROM (SELECT * FROM vendors WHERE STATUS = 'accept' ORDER BY id DESC) WHERE ROWNUM <= :limit";

            $stmt = oci_parse($this->conn, $query);
            if (!$stmt) {
                $this->logOciError("getPopular", "OCI parse error", $this->conn, $query);
                return [];
            }

            oci_bind_by_name($stmt, ':limit', $limit, -1, SQLT_INT);

            if (!oci_execute($stmt)) {
                $this->logOciError("getPopular", "Query execution failed", $stmt, $query, [':limit' => $limit]);
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

    public function getNewArrivals($limit = null, $timeframe = null)
    {
        try {
            $query = "SELECT * FROM vendors WHERE STATUS = 'accept'";
            $whereClause = "";

            if ($timeframe !== null) {
                $whereClause = " AND created_at >= SYSDATE - :timeframe";
            }

            $orderByClause = " ORDER BY created_at DESC";

            $limitClause = "";
            if ($limit !== null) {
                $limitClause = " FETCH FIRST :limit ROWS ONLY";
            }

            $query = $query . $whereClause . $orderByClause . $limitClause;

            $stmt = oci_parse($this->conn, $query);

            if ($timeframe !== null) {
                oci_bind_by_name($stmt, ':timeframe', $timeframe, -1, SQLT_INT);
            }

            if ($limit !== null) {
                oci_bind_by_name($stmt, ':limit', $limit, -1, SQLT_INT);
            }

            if (!oci_execute($stmt)) {
                $this->logOciError("getNewArrivals", "Query execution failed", $stmt, $query, [':timeframe' => $timeframe, ':limit' => $limit]);
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
            $this->logOciError("getNewArrivals", "Exception caught", null, $query, [':timeframe' => $timeframe, ':limit' => $limit], $e);
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
            $this->logOciError("getAllVendors", "Exception caught", null, $query, [':status' => $status], $e);
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

    public function addCuisineTypes($vendorId, $cuisineTypes)
    {
        try {
            foreach ($cuisineTypes as $cuisineName) {
                $cuisineName = trim($cuisineName);
                $cuisineType = $this->getCuisineTypeByName($cuisineName);

                if (!$cuisineType) {
                    $cuisineTypeId = $this->createCuisineType($cuisineName);
                    if ($cuisineTypeId === false) {
                        oci_rollback($this->conn);
                        return false;
                    }
                } else {
                    $cuisineTypeId = $cuisineType['id'];
                }

                $existingAssociation = $this->checkVendorCuisineAssociation($vendorId, $cuisineTypeId);
                if (!$existingAssociation) {
                    if (!$this->insertVendorCuisine($vendorId, $cuisineTypeId)) {
                        oci_rollback($this->conn);
                        return false;
                    }
                }
            }
            return true;
        } catch (\Exception $e) {
            oci_rollback($this->conn);
            $this->logOciError("addCuisineTypes", "Exception in addCuisineTypes", null, null, $e);
            return false;
        }
    }

    private function getCuisineTypeByName($cuisineName)
    {
        try {
            $query = "SELECT id FROM Cuisine_Types WHERE LOWER(cuisine_name) = LOWER(:cuisineName)";
            $stmt = oci_parse($this->conn, $query);
            oci_bind_by_name($stmt, ":cuisineName", $cuisineName);
            oci_execute($stmt);
            $row = oci_fetch_assoc($stmt);
            oci_free_statement($stmt);
            return $row;
        } catch (\Exception $e) {
            $this->logOciError("getCuisineTypeByName", "Exception in getCuisineTypeByName", null, null, $e);
            return false; // Or throw the exception
        }
    }

    private function createCuisineType($cuisineName)
    {
        try {
            $query = "INSERT INTO Cuisine_Types (cuisine_name) VALUES (:cuisineName) RETURNING id INTO :id";
            $stmt = oci_parse($this->conn, $query);
            oci_bind_by_name($stmt, ":cuisineName", $cuisineName);
            $id = null;
            oci_bind_by_name($stmt, ":id", $id, -1, SQLT_INT);

            oci_execute($stmt, OCI_NO_AUTO_COMMIT);

            if (oci_error($stmt)) {
                $this->logOciError("createCuisineType", "Error creating cuisine type", $stmt, $query, $cuisineName);
                oci_free_statement($stmt);
                return false;
            }

            oci_free_statement($stmt);
            return $id;
        } catch (\Exception $e) {
            $this->logOciError("createCuisineType", "Exception in createCuisineType", null, null, $cuisineName, $e);
            return false;
        }
    }

    private function checkVendorCuisineAssociation($vendorId, $cuisineTypeId)
    {
        try {
            $query = "SELECT 1 FROM Vendors_Cuisine_Types WHERE vendor_id = :vendorId AND cuisine_type_id = :cuisineTypeId";
            $stmt = oci_parse($this->conn, $query);
            oci_bind_by_name($stmt, ":vendorId", $vendorId, -1, SQLT_INT);
            oci_bind_by_name($stmt, ":cuisineTypeId", $cuisineTypeId, -1, SQLT_INT);
            oci_execute($stmt);
            $row = oci_fetch_assoc($stmt);
            oci_free_statement($stmt);
            return $row;
        } catch (\Exception $e) {
            $this->logOciError("checkVendorCuisineAssociation", "Exception in checkVendorCuisineAssociation", null, null, $e);
            return false;
        }
    }

    private function insertVendorCuisine($vendorId, $cuisineTypeId)
    {
        try {
            $query = "INSERT INTO Vendors_Cuisine_Types (vendor_id, cuisine_type_id) VALUES (:vendorId, :cuisineTypeId)";
            $stmt = oci_parse($this->conn, $query);
            oci_bind_by_name($stmt, ":vendorId", $vendorId, -1, SQLT_INT);
            oci_bind_by_name($stmt, ":cuisineTypeId", $cuisineTypeId, -1, SQLT_INT);

            oci_execute($stmt, OCI_NO_AUTO_COMMIT);

            if (oci_error($stmt)) {
                $this->logOciError("insertVendorCuisine", "Error inserting into Vendors_Cuisine_Types", $stmt, $query, $vendorId . ' + ' . $cuisineTypeId);
                oci_free_statement($stmt);
                return false;
            }
            oci_free_statement($stmt);
            return true;
        } catch (\Exception $e) {
            $this->logOciError("insertVendorCuisine", "Exception in insertVendorCuisine", null, $query, $vendorId . ' + ' . $cuisineTypeId, $e);
            return false;
        }
    }

    private function logOciError($functionName, $message, $resource, $query = null, $params = null, $e = null)
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
            if ($e instanceof \Exception) {
                $errorMessage .= "\nException: " . $e->getMessage() . "\nTrace: " . $e->getTraceAsString();
            } else {
                $errorMessage .= "\nAdditional Info (Not an Exception): " . print_r($e, true);
            }
        }


        $this->lastError = $errorMessage;
        error_log($errorMessage);
    }

    public function getLastError()
    {
        return $this->lastError;
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