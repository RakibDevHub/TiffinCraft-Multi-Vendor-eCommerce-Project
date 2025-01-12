<?php
$error = null;
if (isset($_GET['error'])) {
	$error = htmlspecialchars($_GET['error']);
}

$success = null;
if (isset($_GET['success'])) {
	$success = htmlspecialchars($_GET['success']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<!-- <base href="/tiffincraft/views/vendors/"> -->
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description"
		content="TiffinCraft connects home chefs with food lovers. Explore delicious homemade dishes, join as a vendor, or enjoy meals crafted with care by passionate chefs." />

	<!-- Font Awesome CDN  -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
		integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- Custom CSS -->
	<link rel="stylesheet" href="../../tiffincraft/assets/css/style.css" />

	<title>TiffinCraft Business</title>
</head>

<body>
	<!-- Header Section Start -->
	<header class="header-section">
		<?php include_once "../../components/navbarBusiness.php" ?>
	</header>
	<!-- Header Section End -->

	<!-- Hero Section Start -->
	<section class="tc-business home" id="#home">
		<!-- Dark Overlay  -->
		<div class="overlay"></div>
		<div class="hero">
			<div class="hero-txt">
				<h1 class="title">Partner with TiffinCraft</h1>
				<div class="hero-buttons">
					<a class="outline" href="/tiffincraft/business#how">How It Works!<i
							class="fa-solid fa-arrow-right"></i></a>
					<a class="fill" href="/tiffincraft/business/register">Regrister Now</a>
				</div>
			</div>
		</div>
	</section>
	<!-- Hero Section End -->

	<!-- Custom Shape  -->
	<div class="spacer layer"></div>

	<!-- Become a Seller Section Start  -->
	<section class="section partner" id="how">
		<div class="section-heading">
			<h3 class="sub-title">Share your culinary talent, reach more customers, and grow your
				business effortlessly. Signing up is quick and easy!</h3>
		</div>

		<div class="steps-container">
			<!-- Step 1 -->
			<div class="step reverse">
				<div class="step-image-wrapper">
					<img src="../../tiffincraft/assets/images/step_11.png" alt="Step 1: A person holding a phone"
						class="step-image" />
				</div>
				<div class="step-text">
					<span class="step-number orange">01</span>
					<h1 class="step-title">Register as a Seller</h1>
					<p class="step-description">
						Step into a world of endless opportunities. Become part of our
						thriving community of home chefs and turn your passion for
						cooking into a rewarding journey.
					</p>
				</div>
			</div>

			<!-- Step 2 -->
			<div class="step">
				<div class="step-text">
					<span class="step-number green">02</span>
					<h1 class="step-title">List Your Dishes</h1>
					<p class="step-description">
						Share your culinary masterpieces with the world. Create a
						personalized menu, set your prices, and make your mark with your
						signature dishes.
					</p>
				</div>
				<div class="step-image-wrapper">
					<img src="../../tiffincraft/assets/images/step_22.png"
						alt="Step 2: A person talking on the phone with the vendors" class="step-image" />
				</div>
			</div>

			<!-- Step 3 -->
			<div class="step reverse">
				<div class="step-image-wrapper">
					<img src="../../tiffincraft/assets/images/step_33.png"
						alt="Step 3: A person delivering food to the customer" class="step-image" />
				</div>
				<div class="step-text">
					<span class="step-number red">03</span>
					<h1 class="step-title">Connect with Customers</h1>
					<p class="step-description">
						Build lasting connections with food lovers who appreciate the
						magic of home-cooked meals. Inspire their taste buds with every
						bite.
					</p>
				</div>
			</div>

			<!-- Step 4 -->
			<div class="step">
				<div class="step-text">
					<span class="step-number blue">04</span>
					<h1 class="step-title">Get Paid</h1>
					<p class="step-description">
						Enjoy a seamless payment experience while you focus on
						delighting your customers with exceptional meals.
					</p>
				</div>
				<div class="step-image-wrapper">
					<img src="../../tiffincraft/assets/images/step_44.webp"
						alt="Step 2: A person talking on the phone with the vendors" class="step-image" />
				</div>
			</div>
		</div>
	</section>
	<!-- Become a Seller Section End  -->

	<!-- Custome Shape -->
	<div class="custom-shape shape1-color">
		<svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
			<path
				d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
				class="shape1-fill"></path>
		</svg>
	</div>

	<!-- Register Form Start -->
	<section class="form-section business-form" id="register">
		<div class="business-form-container">
			<form class="register-form" action="../controllers/vendorController.php" method="POST"
				enctype="multipart/form-data">
				<h2>Register Now</h2>

				<!-- Display success or error alert -->
				<?php if (isset($error)): ?>
					<div class="alert error"><?php echo $error; ?></div>
				<?php endif; ?>
				<?php if (isset($success)): ?>
					<div class="alert success"><?php echo $success; ?></div>
				<?php endif; ?>
				<input type="hidden" name="action" value="register">
				<div class="form-header">
					<p class="switch-auth">Fill up the form below.</a></p>
					<button type="submit" class="btn">Submit Request</button>
				</div>
				<div class="f-grid">
					<div class="form-group">
						<label for="fname">First Name</label>
						<input type="text" id="fname" name="fname" placeholder="Enter your first name" required>
					</div>
					<div class="form-group">
						<label for="lname">Last Name</label>
						<input type="text" id="lname" name="lname" placeholder="Enter your Last name" required>
					</div>
					<div class="form-group">
						<label for="uemail">Email Address</label>
						<input type="email" id="uemail" name="uemail" placeholder="Enter your email address" required>
					</div>
					<div class="form-group">
						<label for="number">Phone Number</label>
						<input type="text" id="number" name="number" placeholder="Enter your phone number" required>
					</div>
					<div class="form-group">
						<label for="outlet">Outlet Name</label>
						<input type="text" id="outlet" name="outlet" placeholder="Enter your outlet name" required>
					</div>
					<div class="form-group">
						<label for="outlet-address">Outlet Address</label>
						<input type="text" id="outlet-address" name="outlet-address"
							placeholder="Enter your outlet address" required>
					</div>
					<div class="form-group">
						<label for="image">Outlet Image</label>
						<div style="display: flex">
							<button class="btn choose-file-btn" type="button">+ Choose File</button>
						</div>
						<input type="file" id="image" name="image" class="hidden-input" accept="image/*">
						<div class="preview-container hidden">
							<img id="image-preview" alt="Preview" />
							<button class="remove-btn" type="button">X</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</section>
	<!-- Register Form End -->

	<!-- Custom CSS  -->
	<script src="../../tiffincraft/assets/js/main.js" type="module"></script>
	<script src="../../tiffincraft/assets/js/imageUpload.js" type="module"></script>
</body>

</html>