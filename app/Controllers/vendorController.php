<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\VendorModel;

class VendorController
{

	public function dashboard($context)
	{
		$title = "Business Dashboard";

		$isLoggedIn = $context['isLoggedIn'] ?? false;
		$userId = $context['userId'] ?? null;
		$userRole = $context['userRole'] ?? null;
		$currentPath = $context['currentPath'] ?? '/';
		$conn = $context['conn'];

		if (!$isLoggedIn || !$userId || !$userRole) {
			header("Location: /business/login");
			exit;
		}

		$excludeColumns = ['PASSWORD', 'VERIFICATION_TOKEN', 'IS_VERIFIED', 'CREATED_AT', 'UPDATED_AT', 'STATUS'];


		try {
			$userModel = new UserModel($conn);
			$userData = $userModel->getUserById($userId, $userRole, $excludeColumns);

			if (!$userData) {
				throw new UserNotFoundException("User not found or invalid."); // Custom exception
			}

			$filteredUserData = [];

			if ($userData) {
				$filteredUserData = array_map(function ($value) {
					return is_string($value) ? htmlspecialchars($value, ENT_QUOTES, 'UTF-8') : $value;
				}, $userData);
			}

			include ROOT_DIR . '/pages/vendors/dashboard.php';
			exit;

		} catch (UserNotFoundException $e) {
			error_log("User not found: " . $e->getMessage());
			$error = "User not found.";
			include ROOT_DIR . '/pages/errors/404.php';
			exit;

		} catch (\Exception $e) {
			error_log("Error in VendorController dashboard: " . $e->getMessage());
			$error = "An error occurred. Please try again later.";
			include ROOT_DIR . '/pages/errors/500.php';
			exit;
		}

	}

	public function getVendorsForHomePage($context)
	{
		$conn = $context['conn'];
		$limit = 10;

		try {
			$vendorModel = new VendorModel($conn);
			return $vendorModel->getPopularVendors($limit);
		} catch (\Exception $e) {
			error_log("Error fetching vendors for homepage: " . $e->getMessage());
			return [];
		}
	}

	public function listAllVendors($context)
	{
		$conn = $context['conn'];

		try {
			$vendorModel = new VendorModel($conn);
			$vendors = $vendorModel->getAllVendors();

			include ROOT_DIR . '/pages/vendors/list.php';
		} catch (\Exception $e) {
			error_log("Error in listAllVendors: " . $e->getMessage());
			include ROOT_DIR . '/pages/errors/500.php';
		}
	}

	public function vendorDetails($context)
	{
		$conn = $context['conn'];
		$vendorId = $_GET['id'] ?? null;

		try {
			if (!$vendorId) {
				throw new \Exception("Invalid vendor ID.");
			}

			$vendorModel = new VendorModel($conn);
			$vendor = $vendorModel->getVendorById($vendorId);

			if (!$vendor) {
				throw new \Exception("Vendor not found.");
			}

			include ROOT_DIR . '/pages/vendors/details.php';
		} catch (\Exception $e) {
			error_log("Error in vendorDetails: " . $e->getMessage());
			http_response_code(404);
			include ROOT_DIR . '/pages/errors/404.php';
		}
	}
}


?>