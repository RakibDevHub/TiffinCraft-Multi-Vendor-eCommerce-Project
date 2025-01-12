<?php
// Include database configuration
include_once '../config/db.php';
session_start();

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

	// Check PASSWORD 
	if ($user && $user['PASSWORD'] === $password) {
		if ($user['ROLE'] === 'vendor') {
			session_regenerate_id(true);
			$_SESSION['user'] = [
				'email' => $user['EMAIL'],
				'role' => $user['ROLE'],
			];

			$success = "login successfull";
			header("Location: /tiffincraft/business/dashboard?success=" . urlencode($success));
			exit();
		} else {
			$error = "Unauthorized user.";
			header("Location: /tiffincraft/business/login?error=" . urlencode($error));
			exit();
		}
	} else {
		$error = "Invalid email or password";
		header("Location: /tiffincraft/business/login?error=" . urlencode($error));
		exit();
	}
}

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
		$error = "All fields are required";
		header("Location: /tiffincraft/business/register?error=" . urlencode($error));
		exit();
	}

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$error = "Invalid email address";
		header("Location: /tiffincraft/business/register?error=" . urlencode($error));
		exit();
	}

	if (!isValidPhoneNumber($phoneNumber)) {
		$error = "Invalid phone number.";
		header("Location: /tiffincraft/register?error=" . urlencode($error));
		exit();
	}

	// Check if email already exists
	$sql = "SELECT * FROM vendors WHERE email = :email";
	$stid = oci_parse($conn, $sql);
	oci_bind_by_name($stid, ":email", $email);
	oci_execute($stid);

	if (oci_fetch_assoc($stid)) {
		$error = "Email already exists";
		header("Location: /tiffincraft/business/register?error=" . urlencode($error));
		exit();
	}

	// Image upload
	$imagePath = null;
	if (!empty($image['name'])) {
		$targetDir = "../uploads/vendors/";
		$uniqueName = uniqid() . '_' . time() . '.' . strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
		$imagePath = $targetDir . $uniqueName;

		if (!move_uploaded_file($image['tmp_name'], $imagePath)) {
			$error = "Failed to upload image";
			header("Location: /tiffincraft/business/register?error=" . urlencode($error));
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
		$success = "Requst submited successfully";
		header("Location: /tiffincraft/business/register?success=" . urlencode($success));
		exit();
	} else {
		$error = "Failed to submit request";
		header("Location: /tiffincraft/business/register?error=" . urlencode($error));
		exit();
	}
}

function isValidPhoneNumber($phone)
{
	return preg_match('/^\d{10,15}$/', $phone); // Adjust range as needed
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// Check if 'action' key exists in the POST request
	$action = isset($_POST['action']) ? $_POST['action'] : null;

	if ($action === 'register') {
		vendorRegister($_POST, $_FILES, $conn);
	} elseif ($action === 'login') {
		vendorLogin($_POST['email'], $_POST['password'], $conn);
	} else {
		// Handle invalid or missing 'action'
		$error = "Invalid action.";
		header("Location: /tiffincraft/business/login?error=" . urlencode($error));
		exit();
	}
}

?>