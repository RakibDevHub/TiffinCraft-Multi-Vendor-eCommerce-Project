<?php

namespace App\Controllers;

use App\Models\AuthModel;
use App\Models\VendorModel;
use App\Service\Database;

use Exception;

class VendorController
{
	private $vendorModel;

	public function __construct()
	{
		$conn = Database::getConnection();
		$this->vendorModel = new VendorModel($conn);
	}

	public function dashboard($context)
	{
		$title = "Business Dashboard";

		$isLoggedIn = $context['isLoggedIn'] ?? false;
		$userId = $context['userId'] ?? null;
		$userRole = $context['userRole'] ?? null;
		$currentPath = $context['currentPath'] ?? '/';

		if (!$isLoggedIn || !$userId || $userRole !== 'vendor') {
			header("Location: /business/login");
			exit;
		}
		$userData = $_SESSION[SESSION_USER_DATA];
		include ROOT_DIR . '/pages/vendor/dashboard.php';
		return;
	}

	public function getVendorsPopular($limit)
	{
		try {
			return $this->vendorModel->getPopularVendors($limit);
		} catch (Exception $e) {
			error_log("Error fetching vendors for homepage: " . $e->getMessage());
			return false;
		}
	}

	public function listAllVendors($status = null, $for = null)
	{
		try {
			$vendors = $this->vendorModel->getAllVendors($status);

			if ($vendors === false) {
				error_log("Error fetching vendors in listAllVendors.");
				return false;
			}

			if ($for !== 'admin') {
				include ROOT_DIR . '/pages/vendors.php';
				return $vendors;
			}

			return $vendors;

		} catch (Exception $e) {
			error_log("Exception in listAllVendors: " . $e->getMessage());
			return false;
		}
	}

	// public function vendorDetails($context)
	// {
	// 	$vendorId = $_GET['id'] ?? null;

	// 	try {
	// 		if (!$vendorId) {
	// 			throw new Exception("Invalid vendor ID.");
	// 		}

	// 		$vendor = $this->vendorModel->getVendorById($vendorId);

	// 		if (!$vendor) {
	// 			throw new Exception("Vendor not found.");
	// 		}

	// 		include ROOT_DIR . '/pages/vendors/details.php';
	// 	} catch (Exception $e) {
	// 		error_log("Error in vendorDetails: " . $e->getMessage());
	// 		http_response_code(404);
	// 		include ROOT_DIR . '/pages/errors/404.php';
	// 	}
	// }
}
?>