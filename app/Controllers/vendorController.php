<?php

namespace App\Controllers;

use App\Models\AuthModel;
use App\Models\VendorModel;
use App\Service\Database;

use Exception;

class VendorController
{
	private $vendorModel;
	private $authModel;

	public function __construct()
	{
		$conn = Database::getConnection();
		$this->vendorModel = new VendorModel($conn);
		$this->authModel = new AuthModel($conn);
	}

	public function dashboard($context)
	{
		$title = "Business Dashboard";

		$isLoggedIn = $context['isLoggedIn'] ?? false;
		$userId = $context['userId'] ?? null;
		$userRole = $context['userRole'] ?? null;
		$currentPath = $context['currentPath'] ?? '/';

		if (!$isLoggedIn || !$userId || !$userRole) {
			header("Location: /business/login");
			exit;
		}

		$excludeColumns = ['PASSWORD', 'VERIFICATION_TOKEN', 'IS_VERIFIED', 'CREATED_AT', 'UPDATED_AT', 'STATUS'];


		try {
			$userData = $this->authModel->getUserById($userId, $userRole, $excludeColumns);

			if (!$userData) {
				throw new UserNotFoundException("User not found or invalid.");
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
		$limit = 10;

		try {
			return $this->vendorModel->getPopularVendors($limit);
		} catch (\Exception $e) {
			error_log("Error fetching vendors for homepage: " . $e->getMessage());
			return [];
		}
	}

	public function listAllVendors($context)
	{

		try {
			$vendors = $this->vendorModel->getAllVendors(null);

			include ROOT_DIR . '/pages/vendors/list.php';
		} catch (\Exception $e) {
			error_log("Error in listAllVendors: " . $e->getMessage());
			include ROOT_DIR . '/pages/errors/500.php';
		}
	}

	public function vendorDetails($context)
	{
		$vendorId = $_GET['id'] ?? null;

		try {
			if (!$vendorId) {
				throw new \Exception("Invalid vendor ID.");
			}

			$vendor = $this->vendorModel->getVendorById($vendorId);

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