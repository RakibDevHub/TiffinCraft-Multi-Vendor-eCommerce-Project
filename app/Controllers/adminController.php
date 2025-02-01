<?php

namespace App\Controllers;

use App\Models\AuthModel;

class AdminController
{

    public function dashboard($context)
    {
        $title = "Admin Dashboard";

        $isLoggedIn = $context['isLoggedIn'] ?? false;
        $userId = $context['userId'] ?? null;
        $userRole = $context['userRole'] ?? null;
        $currentPath = $context['currentPath'] ?? '/';
        $conn = $context['conn'];

        if (!$isLoggedIn || !$userId || !$userRole) {
            header("Location: /admin/login");
            exit;
        }

        $excludeColumns = [];


        try {
            $authModel = new AuthModel($conn);
            $userData = $authModel->getUserById($userId, $userRole, $excludeColumns);

            if (!$userData) {
                throw new UserNotFoundException("Admin not found or invalid.");
            }

            $filteredUserData = [];

            if ($userData) {
                $filteredUserData = array_map(function ($value) {
                    return is_string($value) ? htmlspecialchars($value, ENT_QUOTES, 'UTF-8') : $value;
                }, $userData);
            }

            include ROOT_DIR . '/pages/auth/dashboard.php';
            exit;

        } catch (UserNotFoundException $e) {
            error_log("Admin not found: " . $e->getMessage());
            $error = "Admin not found.";
            include ROOT_DIR . '/pages/errors/404.php';
            exit;

        } catch (\Exception $e) {
            error_log("Error in adminController dashboard: " . $e->getMessage());
            $error = "An error occurred. Please try again later.";
            include ROOT_DIR . '/pages/errors/500.php';
            exit;
        }

    }

    public function manageUsers($context)
    {

    }
}

?>

// // Function to accept a vendor
// function acceptVendor($vendorId, $conn)
// {
// if (!ctype_digit($vendorId)) {
// $error = "Invalid vendor ID.";
// $_SESSION['error'] = $error;
// header("Location: /tiffincraft/admin/dashboard/manage-users?error=" . urlencode($error));
// exit();
// }

// $sql = "UPDATE vendors SET status = 'accept' WHERE vendor_id = :vendor_id";
// $stid = oci_parse($conn, $sql);
// oci_bind_by_name($stid, ":vendor_id", $vendorId);

// if (oci_execute($stid)) {
// $message = "Vendor accepted.";
// $_SESSION['success'] = $message;
// } else {
// $message = "Failed to accept the vendor.";
// $_SESSION['error'] = $message;
// }

// header("Location: /tiffincraft/admin/dashboard/manage-users?message=" . urlencode($message));
// exit();
// }

// // Function to reject (delete) a vendor
// function rejectVendor($vendorId, $conn)
// {
// if (!ctype_digit($vendorId)) {
// $error = "Invalid vendor ID.";
// $_SESSION['error'] = $error;
// header("Location: /tiffincraft/admin/dashboard/manage-users?error=" . urlencode($error));
// exit();
// }

// $sql = "UPDATE vendors SET status = 'reject' WHERE vendor_id = :vendor_id";
// $stid = oci_parse($conn, $sql);
// oci_bind_by_name($stid, ":vendor_id", $vendorId);

// if (oci_execute($stid)) {
// $message = "Vendor rejected.";
// $_SESSION['success'] = $message;
// } else {
// $message = "Failed to reject the vendor.";
// $_SESSION['error'] = $message;
// }

// header("Location: /tiffincraft/admin/dashboard/manage-users?message=" . urlencode($message));
// exit();
// }

// // Handle actions
// if (isset($_GET['id']) && isset($_GET['action'])) {
// $vendorId = $_GET['id'];
// $action = $_GET['action'];

// if ($action === 'accept-vendor') {
// acceptVendor($vendorId, $conn);
// } elseif ($action === 'reject-vendor') {
// rejectVendor($vendorId, $conn);
// }
// }
?>