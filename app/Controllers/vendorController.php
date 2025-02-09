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

	public function listVendorFood($context)
	{
		$title = "Food Menu";

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
			'Food Menu' => null,
		];

		$userData = $_SESSION[SESSION_USER_DATA];

		$success = null;
		$errors = [];

		$foodItems = $this->vendorModel->getAllFoodItems($userId);
		if (!$foodItems) {
			$errors = "No data Found";
		}

		include ROOT_DIR . '/pages/vendor/foodMenu.php';
		return;
	}

	public function addFoodItem($context)
	{
		$title = "Add Food";
		$isLoggedIn = $context['isLoggedIn'] ?? false;
		$userId = $context['userId'] ?? null;
		$userRole = $context['userRole'] ?? null;
		$currentPath = $context['currentPath'] ?? '/';

		if (!$isLoggedIn || !$userId || $userRole !== 'vendor') {
			header("Location: /business/login");
			exit;
		}

		$breadcrumb = [
			'Dashboard' => '/business/dashboard',
			'Food Menu' => '/business/dashboard/food-menu',
			'Add Item' => null,
		];

		$userData = $_SESSION[SESSION_USER_DATA];

		$success = null;
		$errors = [];

		$cuisines = $this->vendorModel->getAllCuisine($userId);
		$categories = $this->vendorModel->getAllCategories($userId);

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$name = trim($_POST['name'] ?? '');
			$description = trim($_POST['description'] ?? '');
			$price = floatval($_POST['price'] ?? 0);
			$discount = floatval($_POST['discount'] ?? 0);
			$cuisine_id = trim($_POST['cuisine_id'] ?? '');
			$category_id = trim($_POST['category_id'] ?? '');
			$tags = trim($_POST['tags'] ?? '');
			$availability = trim($_POST['availability'] ?? '');
			$visibility = trim($_POST['visibility'] ?? '');
			$image = $_FILES['image'] ?? null;

			if (empty($name)) {
				$errors[] = "Item name is required.";
			} elseif ($price <= 0) {
				$errors[] = "Valid price is required.";
			} elseif ($discount < 0 || $discount > 100) {
				$errors[] = "Discount must be between 0 and 100.";
			} elseif (!in_array($availability, ['Available', 'Not-Available', 'Discontinued'])) {
				$errors[] = "Invalid availability status.";
			} elseif (!in_array($visibility, ['Public', 'Private'])) {
				$errors[] = "Invalid visibility.";
			}

			$fileName = null;
			if ($image && $image['error'] === UPLOAD_ERR_OK) {
				$maxFileSize = 2 * 1024 * 1024;
				if ($image['size'] > $maxFileSize) {
					$errors[] = "Image size exceeds the limit.";
				} else {
					$allowedExtensions = ["jpg", "jpeg", "png", "gif"];
					$imageFileType = strtolower(pathinfo($image["name"], PATHINFO_EXTENSION));
					if (!in_array($imageFileType, $allowedExtensions)) {
						$errors[] = "Invalid file type. Allowed types: jpg, jpeg, png, gif";
					} else {
						$targetDir = PUBLIC_DIR . "/uploads/foods/";
						if (!is_dir($targetDir)) {
							mkdir($targetDir, 0777, true);
						}
						$fileName = uniqid(rand(), true) . "." . $imageFileType;
						$targetFile = $targetDir . $fileName;
						if (!move_uploaded_file($image["tmp_name"], $targetFile)) {
							$errors[] = "Error uploading file.";
						}
					}
				}
			} elseif ($image && $image['error'] !== UPLOAD_ERR_NO_FILE) {
				$errors[] = "Image upload error: " . $image['error'];
			}

			if (empty($errors)) {
				$itemData = [
					'name' => $name,
					'description' => $description,
					'price' => $price,
					'discount' => $discount,
					'cuisine_id' => $cuisine_id,
					'category_id' => $category_id,
					'tags' => $tags,
					'availability' => $availability,
					'visibility' => $visibility,
					'image' => $fileName,
				];

				$itemAdded = $this->vendorModel->addItems($itemData, $userId);

				if ($itemAdded) {
					$success = "Item added successfully!";
				} else {
					error_log("Database Error: Failed to add item. Check logs.");
					$cuisineError = strpos($_SESSION['error'] ?? '', "Cuisine type not found");
					if ($cuisineError !== false) {
						$errors[] = "Invalid cuisine type. Please select a valid cuisine.";
					} else {
						$errors[] = "Failed to add item to the database. Please check the logs for more details.";
					}
					if ($fileName && file_exists($targetFile)) {
						unlink($targetFile);
					}
				}
			}

			include ROOT_DIR . '/pages/vendor/add-item.php';
			return;
		}

		include ROOT_DIR . '/pages/vendor/add-item.php';
		return;
	}

	public function category($context)
	{
		$title = "Categories";

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
			'Categories' => null,
		];

		$userData = $_SESSION[SESSION_USER_DATA];

		$success = null;
		$errors = [];

		$categories = $this->vendorModel->getAllCategories($userId);

		include ROOT_DIR . '/pages/vendor/category.php';
		return;
	}
}
?>