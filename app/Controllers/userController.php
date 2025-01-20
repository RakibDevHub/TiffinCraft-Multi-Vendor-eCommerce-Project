<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController
{

	public function profile($context)
	{
		$title = "User Profile";

		$isLoggedIn = $context['isLoggedIn'] ?? false;
		$userId = $context['userId'] ?? null;
		$userRole = $context['userRole'] ?? null;
		$currentPath = $context['currentPath'] ?? '/';
		$conn = $context['conn'];

		if (!$isLoggedIn || !$userId || !$userRole) {
			header("Location: /login");
			exit;
		}

		$excludeColumns = [];
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

		include ROOT_DIR . '/pages/profile.php';
	}

	public function updateProfile($context)
	{
		$userRole = $context['userRole'] ?? null;
		$conn = $context['conn'];

		// Trim and sanitize input
		$userId = trim($_POST['user_id'] ?? '');
		$name = trim($_POST['name'] ?? '');
		$email = trim($_POST['email'] ?? '');
		$phone = trim($_POST['phone'] ?? '');

		$userModel = new UserModel($conn);

		// Input validation
		if (empty($name) || empty($email) || empty($phone)) {
			$error = "Please fill in all required fields.";
		} elseif (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
			$error = "Name should only contain alphabets and spaces.";
		} elseif (!preg_match('/^01[0-9]{9}$/', $phone)) {
			$error = "Phone number must be 11 digits and start with '01'.";
		} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$error = "Invalid email format.";
		} elseif ($userModel->getUserByEmail($email, $userRole, $userId)) {
			$error = "Email already exists.";
		}

		// Handle validation errors
		if (!empty($error)) {
			$_SESSION['message'] = $error;
			$_SESSION['message_type'] = "error";

			// Redirect to the profile page to display the error
			header('Location: /profile');
			exit;
		}

		// Attempt to update profile
		$result = $userModel->updateProfile($userId, $name, $email, $phone);

		if ($result) {
			// Set a success message in the session
			$_SESSION['message'] = "Profile updated successfully!";
			$_SESSION['message_type'] = "success";
		} else {
			// Set an error message in the session
			$_SESSION['message'] = "Failed to update profile.";
			$_SESSION['message_type'] = "error";
		}

		// Redirect to profile page
		header('Location: /profile');
		exit;
	}

	public function changePassword($context)
	{
		$conn = $context['conn'];
		$userId = $_POST['user_id'] ?? null;
		$currentPassword = trim($_POST['current_password'] ?? '');
		$newPassword = trim($_POST['new_password'] ?? '');
		$confirmPassword = trim($_POST['confirm_password'] ?? '');

		$userModel = new UserModel($conn);

		// Input validation
		if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
			$_SESSION['message'] = "All fields are required.";
			$_SESSION['message_type'] = "error";
		} elseif (strlen($newPassword) < 8) {
			$_SESSION['message'] = "New password must be at least 8 characters long.";
			$_SESSION['message_type'] = "error";
		} elseif ($newPassword !== $confirmPassword) {
			$_SESSION['message'] = "New password and confirm password do not match.";
			$_SESSION['message_type'] = "error";
		} else {
			// Verify the current password
			$user = $userModel->getUserById($userId, $context['userRole'], []);
			var_dump($user);

			// if(password_verify($currentPassword, $user))

			if ($user && password_verify($currentPassword, $user['PASSWORD'])) {
				// Hash the new password
				$hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

				// Update the password
				$result = $userModel->updatePassword($userId, $hashedPassword);
				if ($result) {
					$_SESSION['message'] = "Password updated successfully!";
					$_SESSION['message_type'] = "success";
				} else {
					$_SESSION['message'] = "Failed to update password.";
					$_SESSION['message_type'] = "error";
				}
			} else {
				$_SESSION['message'] = "Current password is incorrect.";
				$_SESSION['message_type'] = "error";
			}
		}

		// Redirect to profile page
		header('Location: /profile');
		exit;
	}

	public function deleteAccount($context)
	{
		$conn = $context['conn'];
		$userId = $_POST['user_id'] ?? null;

		$userModel = new UserModel($conn);

		// Confirm deletion
		$confirm = $_POST['confirm'] ?? '';
		if ($confirm !== 'DELETE') {
			$_SESSION['message'] = "To delete your account, type 'DELETE' in the confirmation box.";
			$_SESSION['message_type'] = "error";

			// Redirect to profile page
			header('Location: /profile');
			exit;
		}

		// Delete the account
		$result = $userModel->deleteUserById($userId);
		if ($result) {
			// Clear the session and redirect to the homepage
			session_destroy();
			header('Location: /');
			exit;
		} else {
			$_SESSION['message'] = "Failed to delete account.";
			$_SESSION['message_type'] = "error";

			// Redirect to profile page
			header('Location: /profile');
			exit;
		}
	}

}

?>