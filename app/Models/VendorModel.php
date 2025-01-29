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
            $query = "SELECT * FROM vendors WHERE STATUS = 'accept' AND ROWNUM <= :limit";
            $stmt = oci_parse($this->conn, $query);
            oci_bind_by_name($stmt, ':limit', $limit);

            if (!oci_execute($stmt)) {
                throw new \Exception(oci_error($stmt)['message']);
            }

            $vendors = [];
            while ($row = oci_fetch_assoc($stmt)) {
                $vendors[] = $row;
            }

            oci_free_statement($stmt);
            return $vendors;
        } catch (\Exception $e) {
            error_log("Error fetching popular vendors: " . $e->getMessage());
            return [];
        }
    }

    public function getAllVendors()
    {
        try {
            $query = "SELECT * FROM vendors WHERE STATUS = 'accept'";
            $stmt = oci_parse($this->conn, $query);

            if (!oci_execute($stmt)) {
                throw new \Exception(oci_error($stmt)['message']);
            }

            $vendors = [];
            while ($row = oci_fetch_assoc($stmt)) {
                $vendors[] = $row;
            }

            oci_free_statement($stmt);
            return $vendors;
        } catch (\Exception $e) {
            error_log("Error fetching all vendors: " . $e->getMessage());
            return [];
        }
    }

    public function getVendorById($id)
    {
        try {
            $query = "SELECT * FROM vendors WHERE id = :id AND STATUS = 'accept'";
            $stmt = oci_parse($this->conn, $query);
            oci_bind_by_name($stmt, ':id', $id);

            if (!oci_execute($stmt)) {
                throw new \Exception(oci_error($stmt)['message']);
            }

            $vendor = oci_fetch_assoc($stmt);
            oci_free_statement($stmt);

            if (!$vendor) {
                throw new \Exception("Vendor not found.");
            }

            return $vendor;
        } catch (\Exception $e) {
            error_log("Error fetching vendor by ID: " . $e->getMessage());
            return null;
        }
    }
}


?>