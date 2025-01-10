<?php
include_once '../config/db.php';
include_once '../config/session.php';

function userLogin($email, $password)
{
	global $conn;

	// SQL to check user credentials
	$sql = "SELECT * FROM users WHERE email = :email";
	$stid = oci_parse($conn, $sql);
	oci_bind_by_name($stid, ":email", $email);
	oci_execute($stid);

	// Fetch the result
	$user = oci_fetch_assoc($stid);

	// Check if we found a matching user
	if ($user && $user['PASSWORD'] === $password) {
		// Store user in session
		$_SESSION['user'] = [
			'email' => $user['EMAIL'],
			'role' => $user['ROLE'],
		];

		// Redirect based on the role
		if ($user['ROLE'] == 'vendor') {
			header("Location: /tiffincraft/business/dashboard");
		} else {
			// Default redirect if the role is not recognized
			header("Location: /tiffincraft");
		}
		exit();
	} else {
		// If incorrect, return error
		header("Location: /tiffincraft/business/login?error=Invalid+email+or+password");
		exit();
	}
}

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$email = $_POST['email'];
	$password = $_POST['password'];

	// Call the login function from the controller
	userLogin($email, $password);
}
?>