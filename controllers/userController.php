<?php
include_once '../config/db.php';
session_start();

function userLogin($email, $password, $conn)
{
	$sql = "SELECT * FROM users WHERE email = :email";
	$stid = oci_parse($conn, $sql);
	oci_bind_by_name($stid, ":email", $email);
	oci_execute($stid);

	$user = oci_fetch_assoc($stid);

	if ($user && $user['PASSWORD'] === $password) {
		$_SESSION['user'] = [
			'email' => $user['EMAIL'],
			'role' => $user['ROLE'],
		];
		header("Location: /tiffincraft");
		exit();
	} else {
		$_SESSION['error'] = "Invalid email or password";
		header("Location: /tiffincraft/login");
		exit();
	}
}

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$email = $_POST['email'];
	$password = $_POST['password'];

	// Call the login function from the controller
	userLogin($email, $password, $conn);
}
?>