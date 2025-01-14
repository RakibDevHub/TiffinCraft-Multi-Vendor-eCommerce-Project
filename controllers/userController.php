<?php

class UserController
{
	private $conn;

	public function __construct($conn)
	{
		$this->conn = $conn;
	}

	public function userRegister($data)
	{
		$username = trim($data['username']);
		$phoneNumber = trim($data['number']);
		$email = trim($data['uemail']);
		$password = trim($data['upassword']);
		$cpassword = trim($data['cpassword']);

		$errors = [];

		if (empty($username)) {
			$errors[] = "Full name is required.";
		} elseif (!preg_match('/^[a-zA-Z\s]+$/', $username)) {
			$errors[] = "Full name must contain only alphabets and spaces.";
		}

		if (empty($phoneNumber)) {
			$errors[] = "Phone number is required.";
		} elseif (!preg_match('/^01\d{9}$/', $phoneNumber)) {
			$errors[] = "Invalid phone number. Must be 11 digits and start with 01.";
		}

		if (empty($email)) {
			$errors[] = "Email is required.";
		} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors[] = "Invalid email address.";
		}

		if (empty($password)) {
			$errors[] = "Password is required.";
		} elseif (strlen($password) < 8) {
			$errors[] = "Password must be at least 8 characters long.";
		}

		if ($password !== $cpassword) {
			$errors[] = "Passwords do not match.";
		}

		if (!empty($errors)) {
			return implode("<br>", $errors);
		}

		// Check email already exists
		$sql = "SELECT * FROM users WHERE email = :email";
		$stid = oci_parse($this->conn, $sql);
		oci_bind_by_name($stid, ":email", $email);
		oci_execute($stid);

		if (oci_fetch_assoc($stid)) {
			return "Email already exists.";
		}

		// Hash Password
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

		// Insert into database
		$sql = "INSERT INTO users (user_name, email, phone_number, password, role, created_at)
                VALUES (:user_name, :email, :phone_number, :password, 'customer', SYSDATE)";
		$stid = oci_parse($this->conn, $sql);
		oci_bind_by_name($stid, ":user_name", $username);
		oci_bind_by_name($stid, ":email", $email);
		oci_bind_by_name($stid, ":phone_number", $phoneNumber);
		oci_bind_by_name($stid, ":password", $hashedPassword);

		if (oci_execute($stid)) {
			// Get the newly inserted user's ID
			$sql = "SELECT user_id FROM users WHERE email = :email";
			$stid = oci_parse($this->conn, $sql);
			oci_bind_by_name($stid, ":email", $email);
			oci_execute($stid);
			$user = oci_fetch_assoc($stid);
			return $user['USER_ID'];
		} else {
			$e = oci_error($stid);
			error_log("Error registering user: " . $e['message']);
			return "Failed to register user.";
		}
	}
}
?>