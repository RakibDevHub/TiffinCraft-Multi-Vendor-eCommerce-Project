<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description"
		content="TiffinCraft connects home chefs with food lovers. Explore delicious homemade dishes, join as a vendor, or enjoy meals crafted with care by passionate chefs." />

	<!-- Font Awesome CDN  -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
		integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- Custom CSS -->
	<link rel="stylesheet" href="../tiffincraft/assets/css/style.css" />

	<title>Users Login</title>
</head>

<body>
	<!-- Header Section Start -->
	<header class="header-section">
		<?php include_once '../../components/navbar.php' ?>
	</header>
	<!-- Header Section End -->

	<?php $controller = "userController.php";
	include "../../components/loginForm.php" ?>

	<!-- Custom JS  -->
	<script src="./assets/js/main.js" type="module"></script>
	<!-- <script src="./assets/"></script> -->

</body>

</html>