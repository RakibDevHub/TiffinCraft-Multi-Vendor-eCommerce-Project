<!-- http://localhost/tiffincraft/?message=Successfully+Logged+in. -->

<?php
// Include the AuthController
include_once '../../config/db.php';
include_once '../../controllers/authController.php';

$auth = new AuthController($conn);

// Call the logout function
$auth->logout();
