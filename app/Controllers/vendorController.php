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

	public function getPopularVendors($limit = null)
	{
		try {
			return $this->vendorModel->getPopular($limit);
		} catch (Exception $e) {
			error_log("Error fetching vendors for homepage: " . $e->getMessage());
			return false;
		}
	}

	public function getNewArrivalVendors($limit = null, $timeframe = null)
	{
		try {
			return $this->vendorModel->getNewArrivals($limit, $timeframe);
		} catch (Exception $e) {
			error_log("Error fetching vendors: " . $e->getMessage());
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

	public function menu($context)
	{
		$title = "Menu";

		$isLoggedIn = $context['isLoggedIn'] ?? false;
		$userId = $context['userId'] ?? null;
		$userRole = $context['userRole'] ?? null;
		$currentPath = $context['currentPath'] ?? '/';

		if (!$isLoggedIn || !$userId || $userRole !== 'vendor') {
			header("Location: /business/login");
			exit;
		}

		$breadcrumb = [
			'Dashboard' => '/vendor/dashboard',
			'Manage Menu' => null,
		];

		$userData = $_SESSION[SESSION_USER_DATA];
		include ROOT_DIR . '/pages/vendor/menu.php';
		return;
	}

	public function addItem($context)
	{
		$isLoggedIn = $context['isLoggedIn'] ?? false;
		$userId = $context['userId'] ?? null;
		$userRole = $context['userRole'] ?? null;
		$error = null;
		$success = null;

		if (!$isLoggedIn || !$userId || $userRole !== 'vendor') {
			header("Location: /business/login");
			exit;
		}

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			// Fetch and sanitize form inputs
			$name = trim($_POST['name'] ?? '');
			$description = trim($_POST['description'] ?? '');
			$price = floatval($_POST['price'] ?? 0);
			$discount = floatval($_POST['discount'] ?? 0);
			$cuisine_type = trim($_POST['cuisine_type'] ?? '');
			$tags = trim($_POST['tags'] ?? '');
			$availability = trim($_POST['availability'] ?? '');
			$visibility = trim($_POST['visibility'] ?? '');
			$image = $_FILES['image'] ?? null;

			// Basic validations
			if (empty($name)) {
				$error = "Item name is required.";
			} elseif ($price <= 0) {
				$error = "Valid price is required.";
			} elseif ($discount < 0 || $discount > 100) {
				$error = "Discount must be between 0 and 100.";
			} elseif (!in_array($availability, ['Available', 'Not-Available', 'Discontinued'])) {
				$error = "Invalid status.";
			} elseif (!in_array($visibility, ['public', 'private'])) {
				$error = "Invalid visibility.";
			} else {

				// Image handling
				$uploadedFilePath = '';
				$fileName = null;

				if ($image && $image['error'] === UPLOAD_ERR_OK) {
					$maxFileSize = 2 * 1024 * 1024; // 2 MB limit
					if ($image['size'] > $maxFileSize) {
						$error = "Image size exceeds the limit.";
					} else {
						$targetDir = PUBLIC_DIR . "/uploads/foods/";
						$imageFileType = strtolower(pathinfo($image["name"], PATHINFO_EXTENSION));
						$allowedExtensions = ["jpg", "jpeg", "png", "gif"];
						if (!in_array($imageFileType, $allowedExtensions)) {
							$error = "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
						} else {
							$fileName = uniqid() . "." . $imageFileType;
							$targetFile = $targetDir . $fileName;

							if (!move_uploaded_file($image["tmp_name"], $targetFile)) {
								$error = "Error uploading file.";
							}
							$uploadedFilePath = $targetFile;
						}
					}
				}

				if (!$error) {
					// Prepare data for the model
					$itemData = [
						'name' => $name,
						'description' => $description,
						'price' => $price,
						'discount' => $discount,
						'cuisine_type' => $cuisine_type,
						'tags' => $tags,
						'availability' => $availability,
						'visibility' => $visibility,
						'image' => $fileName
					];

					// Call the model function
					$itemAdded = $this->vendorModel->addItems($itemData, $userId);

					if ($itemAdded) {
						$success = "Item added successfully!";
					} else {
						// Rollback image if DB operation fails
						if (!empty($uploadedFilePath) && file_exists($uploadedFilePath)) {
							unlink($uploadedFilePath);
						}
						$error = "Failed to add item.";
					}
				}
			}
		}

		// include ROOT_DIR . '/pages/vendor/menu.php';
		return;
	}


	public function category($context)
	{
		$title = "Category";

		$isLoggedIn = $context['isLoggedIn'] ?? false;
		$userId = $context['userId'] ?? null;
		$userRole = $context['userRole'] ?? null;
		$currentPath = $context['currentPath'] ?? '/';

		if (!$isLoggedIn || !$userId || $userRole !== 'vendor') {
			header("Location: /business/login");
			exit;
		}

		$breadcrumb = [
			'Dashboard' => '/vendor/dashboard',
			'Manage Category' => null,
		];

		$userData = $_SESSION[SESSION_USER_DATA];
		include ROOT_DIR . '/pages/vendor/category.php';
		return;
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