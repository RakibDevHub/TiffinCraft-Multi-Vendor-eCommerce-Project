<?php
// Include database configuration
include_once '../config/db.php';

// Function to handle vendor registration
function vendorRegister($data, $files)
{
    global $conn;

    // Extract form data
    $firstName = trim($data['fname']);
    $lastName = trim($data['lname']);
    $email = trim($data['uemail']);
    $phoneNumber = trim($data['number']);
    $outletName = trim($data['outlet']);
    $outletAddress = trim($data['outlet-address']);
    $image = $files['image'];

    // Validate required fields
    if (
        empty($firstName) || empty($lastName) || empty($email) || empty($phoneNumber) ||
        empty($outletName) || empty($outletAddress)
    ) {
        header("Location: /tiffincraft/views/vendor/register.php?error=All+fields+are+required");
        exit();
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: /tiffincraft/views/vendor/register.php?error=Invalid+email+address");
        exit();
    }

    // Check if email already exists
    $sql = "SELECT * FROM vendors WHERE email = :email";
    $stid = oci_parse($conn, $sql);
    oci_bind_by_name($stid, ":email", $email);
    oci_execute($stid);

    if (oci_fetch_assoc($stid)) {
        header("Location: /tiffincraft/views/vendor/register.php?error=Email+already+exists");
        exit();
    }

    // Handle image upload
    $imagePath = null;
    if (!empty($image['name'])) {
        $targetDir = "../../uploads/vendors/";
        $imagePath = $targetDir . basename($image['name']);
        $imageFileType = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));

        // Check file type
        if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            header("Location: /tiffincraft/views/vendor/register.php?error=Invalid+image+format");
            exit();
        }

        // Move uploaded file
        if (!move_uploaded_file($image['tmp_name'], $imagePath)) {
            header("Location: /tiffincraft/views/vendor/register.php?error=Failed+to+upload+image");
            exit();
        }
    }

    // Insert vendor data into the database
    $insertSql = "
        INSERT INTO vendors (
            first_name, last_name, email, phone_number, outlet_name, outlet_address, outlet_image, created_at
        ) VALUES (
            :first_name, :last_name, :email, :phone_number, :outlet_name, :outlet_address, :outlet_image, SYSDATE
        )
    ";
    $insertStid = oci_parse($conn, $insertSql);

    oci_bind_by_name($insertStid, ":first_name", $firstName);
    oci_bind_by_name($insertStid, ":last_name", $lastName);
    oci_bind_by_name($insertStid, ":email", $email);
    oci_bind_by_name($insertStid, ":phone_number", $phoneNumber);
    oci_bind_by_name($insertStid, ":outlet_name", $outletName);
    oci_bind_by_name($insertStid, ":outlet_address", $outletAddress);
    oci_bind_by_name($insertStid, ":outlet_image", $imagePath);

    $result = oci_execute($insertStid);

    if ($result) {
        // Redirect to a success page
        header("Location: /tiffincraft/views/vendor/register.php?success=Registration+successful");
        exit();
    } else {
        // If insertion fails
        header("Location: /tiffincraft/views/vendor/register.php?error=Failed+to+register");
        exit();
    }
}

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    vendorRegister($_POST, $_FILES);
}
?>