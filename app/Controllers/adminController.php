<?php
include_once '../config/connectDB.php';
session_start();

// Function to accept a vendor
function acceptVendor($vendorId, $conn)
{
    if (!ctype_digit($vendorId)) {
        $error = "Invalid vendor ID.";
        $_SESSION['error'] = $error;
        header("Location: /tiffincraft/admin/dashboard/manage-users?error=" . urlencode($error));
        exit();
    }

    $sql = "UPDATE vendors SET status = 'accept' WHERE vendor_id = :vendor_id";
    $stid = oci_parse($conn, $sql);
    oci_bind_by_name($stid, ":vendor_id", $vendorId);

    if (oci_execute($stid)) {
        $message = "Vendor accepted.";
        $_SESSION['success'] = $message;
    } else {
        $message = "Failed to accept the vendor.";
        $_SESSION['error'] = $message;
    }

    header("Location: /tiffincraft/admin/dashboard/manage-users?message=" . urlencode($message));
    exit();
}

// Function to reject (delete) a vendor
function rejectVendor($vendorId, $conn)
{
    if (!ctype_digit($vendorId)) {
        $error = "Invalid vendor ID.";
        $_SESSION['error'] = $error;
        header("Location: /tiffincraft/admin/dashboard/manage-users?error=" . urlencode($error));
        exit();
    }

    $sql = "UPDATE vendors SET status = 'reject' WHERE vendor_id = :vendor_id";
    $stid = oci_parse($conn, $sql);
    oci_bind_by_name($stid, ":vendor_id", $vendorId);

    if (oci_execute($stid)) {
        $message = "Vendor rejected.";
        $_SESSION['success'] = $message;
    } else {
        $message = "Failed to reject the vendor.";
        $_SESSION['error'] = $message;
    }

    header("Location: /tiffincraft/admin/dashboard/manage-users?message=" . urlencode($message));
    exit();
}

// Handle actions
if (isset($_GET['id']) && isset($_GET['action'])) {
    $vendorId = $_GET['id'];
    $action = $_GET['action'];

    if ($action === 'accept-vendor') {
        acceptVendor($vendorId, $conn);
    } elseif ($action === 'reject-vendor') {
        rejectVendor($vendorId, $conn);
    }
}
?>