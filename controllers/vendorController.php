<?php

class VendorController
{
	private $conn;

	public function __construct($conn)
	{
		$this->conn = $conn;
	}

	public function acceptVendor($vendorId)
	{
		if (!ctype_digit($vendorId)) {
			return "Invalid vendor ID.";
		}

		$sql = "UPDATE vendors SET status = 'accept' WHERE vendor_id = :vendor_id";
		$stid = oci_parse($this->conn, $sql);
		oci_bind_by_name($stid, ":vendor_id", $vendorId);

		if (oci_execute($stid)) {
			return "Vendor accepted.";
		} else {
			$e = oci_error($stid);
			error_log("Error accepting vendor: " . $e['message']);
			return "Failed to accept the vendor.";
		}
	}

	public function rejectVendor($vendorId)
	{
		if (!ctype_digit($vendorId)) {
			return "Invalid vendor ID.";
		}

		$sql = "UPDATE vendors SET status = 'reject' WHERE vendor_id = :vendor_id";
		$stid = oci_parse($this->conn, $sql);
		oci_bind_by_name($stid, ":vendor_id", $vendorId);

		if (oci_execute($stid)) {
			return "Vendor rejected.";
		} else {
			$e = oci_error($stid);
			error_log("Error rejecting vendor: " . $e['message']);
			return "Failed to reject the vendor.";
		}
	}

	public function vendorRegister($data, $files)
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
			return "All fields are required.";
		}

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return "Invalid email address.";
		}

		if (!$this->isValidPhoneNumber($phoneNumber)) { // Use $this->
			return "Invalid phone number.";
		}

		// Check if email already exists (using $this->conn)
		$sql = "SELECT * FROM vendors WHERE email = :email";
		$stid = oci_parse($this->conn, $sql);
		oci_bind_by_name($stid, ":email", $email);
		oci_execute($stid);

		if (oci_fetch_assoc($stid)) {
			return "Email already exists.";
		}

		// Image upload
		$imagePath = null;
		if (!empty($image['name'])) {
			$targetDir = PROJECT_ROOT . "/uploads/vendors/";

			// Ensure the directory exists (recursive creation)
			// if (!is_dir($targetDir)) {
			// 	mkdir($targetDir, 0777, true); // Create directory if it doesn't exist
			// }

			$uniqueName = uniqid() . '_' . time() . '.' . strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
			$imagePath = $targetDir . $uniqueName;

			if (!move_uploaded_file($image['tmp_name'], $imagePath)) {
				return "Failed to upload image.";
			}
		}

		// Insert into database (using $this->conn)
		$sql = "
            INSERT INTO vendors (first_name, last_name, email, phone_number, outlet_name, outlet_address, outlet_image, created_at)
            VALUES (:first_name, :last_name, :email, :phone_number, :outlet_name, :outlet_address, :outlet_image, SYSDATE)";
		$stid = oci_parse($this->conn, $sql);
		oci_bind_by_name($stid, ":first_name", $firstName);
		oci_bind_by_name($stid, ":last_name", $lastName);
		oci_bind_by_name($stid, ":email", $email);
		oci_bind_by_name($stid, ":phone_number", $phoneNumber);
		oci_bind_by_name($stid, ":outlet_name", $outletName);
		oci_bind_by_name($stid, ":outlet_address", $outletAddress);
		oci_bind_by_name($stid, ":outlet_image", $imagePath);

		if (oci_execute($stid)) {
			return "Request submitted successfully.";
		} else {
			$e = oci_error($stid);
			error_log("Error registering vendor: " . $e['message']);
			return "Failed to submit request.";
		}
	}

	private function isValidPhoneNumber($phone) // Make it private
	{
		return preg_match('/^\d{10,15}$/', $phone);
	}
}

?>