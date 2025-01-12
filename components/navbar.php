<?php
include_once __DIR__ . '../../controllers/auth.php'; // Adjust the path as needed
$isLoggedIn = isUserLoggedIn();
?>


<nav class="nav-container">
	<a href="/tiffincraft" class="nav-logo">
		<img src="../tiffincraft/assets/images/TiffinCraft.png" alt="TiffinCraft Logo" />
	</a>
	<ul class="nav-links">
		<li><a href="/tiffincraft">Home</a></li>
		<li><a href="/tiffincraft#dishes">Browse Dishes</a></li>
		<li><a href="/tiffincraft#vendors">Browse Vendors</a></li>
		<li><a href="/tiffincraft#how">How It Works</a></li>
	</ul>
	<div class="nav-buttons">
		<!-- <button class="logged-out nav-btn open-login-btn">Sign In</button> -->
		<li class="logged-out nav-btn"><a class="outline" href="/tiffincraft/login">Sign In</a></li>
		<li class="logged-out nav-btn"><a class="fill" href="/tiffincraft/register">Sign Up</a></li>
		<li class="logged-in"><i class="fa-solid fa-heart"></i></li>
		<li class="logged-in"><i class="fa-solid fa-cart-shopping"></i></li>
		<li class="logged-in"><i class="fa-solid fa-user"></i></li>
		<i class="fa-solid fa-bars" id="menu-bar"></i>
	</div>
</nav>

<script>
	const userLoggedIn = <?php echo json_encode($isLoggedIn); ?>;
</script>