<?php

namespace App\Controllers;

use App\Models\UserModel;

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
		$userModel = new UserModel($conn);
		$userData = $userModel->getUserById($userId, $userRole, $excludeColumns);

		$filteredUserData = [];

		if ($userData) {
			$filteredUserData = array_map(function ($value) {
				return is_string($value) ? htmlspecialchars($value, ENT_QUOTES, 'UTF-8') : $value;
			}, $userData);
		}

		if (!$userData) {
			$error = "User not found or invalid.";
			include ROOT_DIR . '/pages/errors/404.php';
			exit;
		}

		include ROOT_DIR . '/pages/vendors/dashboard.php';
	}

}

?>