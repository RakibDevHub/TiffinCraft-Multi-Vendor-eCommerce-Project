<?php
include_once __DIR__ . '../../init.php';
include_once __DIR__ . '../../controllers/authController.php';

$auth = new AuthController($conn);
$isLoggedIn = $auth->isUserLoggedIn();

// Determine the base URL (important for relative links)
$baseUrl = '/tiffincraft'; // Default base URL
if (strpos($_SERVER['REQUEST_URI'], '/business') !== false) {
	$baseUrl .= '/business';
}

?>

<nav class="nav-container">
	<a href="<?= $baseUrl ?>" class="nav-logo">
		<img src="/tiffincraft/assets/images/<?= (strpos($baseUrl, '/business') !== false) ? 'logo.png' : 'TiffinCraft.png'; ?>"
			alt="TiffinCraft Logo" />
		<span><?= (strpos($baseUrl, '/business') !== false) ? 'TiffinCraft Business' : ''; ?></span>
	</a>
	<ul class="nav-links">
		<?php if (strpos($baseUrl, '/business') === false): ?>
			<li><a href="<?= $baseUrl ?>">Home</a></li>
			<li><a href="<?= $baseUrl ?>#dishes">Browse Dishes</a></li>
			<li><a href="<?= $baseUrl ?>#vendors">Browse Vendors</a></li>
			<li><a href="<?= $baseUrl ?>#how">How It Works</a></li>
		<?php endif; ?>
	</ul>
	<div class="nav-buttons">
		<?php if (!$isLoggedIn): ?>
			<li class="nav-btn"><a class="outline" href="<?= $baseUrl ?>/login">Sign In</a></li>
			<?php if (strpos($baseUrl, '/business') === false): ?>
				<li class="nav-btn"><a class="fill" href="<?= $baseUrl ?>/register">Sign Up</a></li>
			<?php endif; ?>
		<?php else: ?>
			<li class="nav-btn"><a class="fill" href="<?= $baseUrl ?>/logout">Sign Out</a></li>
			<li class="logged-in"><a href="<?= $baseUrl ?>/profile"><i class="fa-solid fa-user"></i></a></li>
			<?php if (strpos($baseUrl, '/business') === false): ?>
				<li class="logged-in"><a href="<?= $baseUrl ?>/wishlist"><i class="fa-solid fa-heart"></i></a></li>
				<li class="logged-in"><a href="<?= $baseUrl ?>/cart"><i class="fa-solid fa-cart-shopping"></i></a></li>
			<?php endif; ?>
		<?php endif; ?>
		<i class="fa-solid fa-bars" id="menu-bar"></i>
	</div>
</nav>

<script>
	const userLoggedIn = <?php echo json_encode($isLoggedIn); ?>;
</script>