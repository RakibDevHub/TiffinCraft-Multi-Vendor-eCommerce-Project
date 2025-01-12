<?php
include_once '../config/db.php';
session_start();

function userLogin($email, $password, $conn)
{
	// Validate email
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$error = "Invalid email format.";
		header("Location: /tiffincraft/login?error=" . urlencode($error));
		exit();
	}

	// Check if the email exists in the database
	$sql = "SELECT * FROM users WHERE email = :email";
	$stid = oci_parse($conn, $sql);
	oci_bind_by_name($stid, ":email", $email);

	if (!oci_execute($stid)) {
		$error = "An error occurred. Please try again later.";
		header("Location: /tiffincraft/login?error=" . urlencode($error));
		exit();
	}

	$user = oci_fetch_assoc($stid);

	if ($user && $user['PASSWORD'] === $password) {

		if ($user['ROLE'] === 'customer') {
			session_regenerate_id(true);
			$_SESSION['user'] = [
				'email' => $user['EMAIL'],
				'role' => $user['ROLE'],
			];

			$success = "login successfull";
			header("Location: /tiffincraft?success=" . urlencode($success));
			exit();
		} else {
			$error = "Unauthorized user.";
			header("Location: /tiffincraft/login?error=" . urlencode($error));
			exit();
		}

	} else {
		$error = "Invalid email or password.";
		header("Location: /tiffincraft/login?error=" . urlencode($error));
		exit();
	}
}

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$email = $_POST['email'] ?? null;
	$password = $_POST['password'] ?? null;

	// Call the login function
	userLogin($email, $password, $conn);
}
?>