<?php
// Include database configuration
include_once '../config/db.php';
session_start();

// Vendor registration function
function vendorRegister($data, $files, $conn)
{
	$firstName = trim($data['fname']);
	$lastName = trim($data['lname']);
	$email = trim($data['uemail']);
	$phoneNumber = trim($data['number']);
	$outletName = trim($data['outlet']);
	$outletAddress = trim($data['outlet-address']);
	$image = $files['image'];

	// Validate input
	if (
		empty($firstName) || empty($lastName) || empty($email) ||
		empty($phoneNumber) || empty($outletName) || empty($outletAddress)
	) {
		$_SESSION['error'] = "All fields are required";
		header("Location: /tiffincraft/business/register");
		exit();
	}

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$_SESSION['error'] = "Invalid email address";
		header("Location: /tiffincraft/business/register");
		exit();
	}

	// Check if email already exists
	$sql = "SELECT * FROM vendors WHERE email = :email";
	$stid = oci_parse($conn, $sql);
	oci_bind_by_name($stid, ":email", $email);
	oci_execute($stid);

	if (oci_fetch_assoc($stid)) {
		$_SESSION['error'] = "Email already exists";
		header("Location: /tiffincraft/business/register");
		exit();
	}

	// Image upload
	$imagePath = null;
	if (!empty($image['name'])) {
		$targetDir = "../uploads/vendors/";
		$uniqueName = uniqid() . '_' . time() . '.' . strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
		$imagePath = $targetDir . $uniqueName;

		if (!move_uploaded_file($image['tmp_name'], $imagePath)) {
			$_SESSION['error'] = "Failed to upload image";
			header("Location: /tiffincraft/business/register");
			exit();
		}
	}

	// Insert into database
	$sql = "
        INSERT INTO vendors (first_name, last_name, email, phone_number, outlet_name, outlet_address, outlet_image, created_at)
        VALUES (:first_name, :last_name, :email, :phone_number, :outlet_name, :outlet_address, :outlet_image, SYSDATE)";
	$stid = oci_parse($conn, $sql);
	oci_bind_by_name($stid, ":first_name", $firstName);
	oci_bind_by_name($stid, ":last_name", $lastName);
	oci_bind_by_name($stid, ":email", $email);
	oci_bind_by_name($stid, ":phone_number", $phoneNumber);
	oci_bind_by_name($stid, ":outlet_name", $outletName);
	oci_bind_by_name($stid, ":outlet_address", $outletAddress);
	oci_bind_by_name($stid, ":outlet_image", $imagePath);

	if (oci_execute($stid)) {
		$_SESSION['success'] = "Vendor registered successfully";
		header("Location: /tiffincraft/business/register");
		exit();
	} else {
		$_SESSION['error'] = "Failed to register vendor";
		header("Location: /tiffincraft/business/register");
		exit();
	}
}

// Vendor login function
function vendorLogin($email, $password, $conn)
{
	// Validate email
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$_SESSION['error'] = "Invalid email format";
		header("Location: /tiffincraft/business/login");
		exit();
	}

	// SQL to check user credentials
	$sql = "SELECT * FROM users WHERE email = :email";
	$stid = oci_parse($conn, $sql);
	oci_bind_by_name($stid, ":email", $email);
	oci_execute($stid);

	// Fetch the result
	$user = oci_fetch_assoc($stid);

	// Check if we found a matching user and verify password
	// if ($user && password_verify($password, $user['PASSWORD'])) {
	if ($user && $password) {
		session_regenerate_id();
		$_SESSION['user'] = [
			'email' => $user['EMAIL'],
			'role' => $user['ROLE'],
		];
		header($user['ROLE'] === 'vendor' ? "Location: /tiffincraft/business/dashboard" : "Location: /tiffincraft");
		exit();
	} else {
		$_SESSION['error'] = "Invalid email or password";
		header("Location: /tiffincraft/business/login");
		exit();
	}
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_POST['action']) && $_POST['action'] === 'register') {
		vendorRegister($_POST, $_FILES, $conn);
	} elseif (isset($_POST['action']) && $_POST['action'] === 'login') {
		vendorLogin($_POST['email'], $_POST['password'], $conn);
	} else {
		$_SESSION['error'] = "Invalid action";
		header("Location: /tiffincraft");
		exit();
	}
}
?>