<?php
include_once '../config/connectDB.php';
session_start();

function userRegister($data, $conn)
{
	$username = trim($data['username']);
	$phoneNumber = trim($data['number']);
	$email = trim($data['uemail']);
	$upassword = trim($data['upassword']);
	$cpassword = trim($data['cpassword']);

	// Validate input
	if (
		empty($username) || empty($email) || empty($phoneNumber) ||
		empty($upassword) || empty($cpassword)
	) {
		$error = "All fields are required.";
		header("Location: /tiffincraft/register?error=" . urlencode($error));
		exit();
	}

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$error = "Invalid email address";
		header("Location: /tiffincraft/register?error=" . urlencode($error));
		exit();
	}

	if (!isValidPhoneNumber($phoneNumber)) {
		$error = "Invalid phone number.";
		header("Location: /tiffincraft/register?error=" . urlencode($error));
		exit();
	}

	if ($upassword !== $cpassword) {
		$error = "Passwords do not match.";
		header("Location: /tiffincraft/register?error=" . urlencode($error));
		exit();
	}

	// Check if email already exists
	$sql = "SELECT * FROM users WHERE email = :email";
	$stid = oci_parse($conn, $sql);
	oci_bind_by_name($stid, ":email", $email);
	oci_execute($stid);

	if (oci_fetch_assoc($stid)) {
		$error = "Email already exists";
		header("Location: /tiffincraft/register?error=" . urlencode($error));
		exit();
	}

	// Insert into database
	$sql = "
        INSERT INTO users (user_name, email, phone_number, password, role, created_at)
        VALUES (:user_name, :phone_number, :email, :password, 'customer', SYSDATE)";
	$stid = oci_parse($conn, $sql);
	oci_bind_by_name($stid, ":user_name", $username);
	oci_bind_by_name($stid, ":email", $email);
	oci_bind_by_name($stid, ":phone_number", $phoneNumber);
	oci_bind_by_name($stid, ":password", $upassword);

	if (oci_execute($stid)) {
		$success = "User registered successfully";
		header("Location: /tiffincraft/register?success=" . urlencode($success));
		exit();
	} else {
		$error = "Failed to register";
		header("Location: /tiffincraft/register?error=" . urlencode($error));
		exit();
	}
}

function isValidPhoneNumber($phone)
{
	return preg_match('/^\d{10,15}$/', $phone);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// Check if 'action' key exists in the POST request
	$action = isset($_POST['action']) ? $_POST['action'] : null;

	if ($action === 'register') {
		userRegister($_POST, $conn);
	}
}
?>