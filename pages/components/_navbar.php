<?php

$baseUrl = $currentPath;

?>

<nav class="nav-container">
	<a href="/" class="nav-logo">
		<img src="/assets/images/<?= (strpos($baseUrl, '/business') !== false) ? 'logo.png' : 'TiffinCraft.png'; ?>"
			alt="TiffinCraft Logo" />
		<span><?= (strpos($baseUrl, '/business') !== false) ? 'TiffinCraft Business' : ''; ?></span>
	</a>
	<!-- <ul class="nav-links">
		<?php if (strpos($baseUrl, '/business') === false): ?>
			<li class="<?= ($currentPath === '/' || $currentPath === '/index.php') ? 'active' : ''; ?>">
				<a href="/">Home</a>
			</li>
			<li class="<?= strpos($currentPath, '#dishes') !== false ? 'active' : ''; ?>"><a href="/#dishes">Browse
					Dishes</a></li>
			<li class="<?= strpos($currentPath, '#vendors') !== false ? 'active' : ''; ?>"><a href="/#vendors">Browse
					Vendors</a></li>
			<li class="<?= strpos($currentPath, '#how') !== false ? 'active' : ''; ?>"><a href="/#how">How It
					Works</a></li>

		<?php endif; ?>
	</ul> -->
	<ul class="nav-links">
		<?php if (strpos($baseUrl, '/business') === false): ?>
			<li class="<?= ($currentPath === '/' || $currentPath === '/index.php') ? 'active' : ''; ?>">
				<a href="/">Home</a>
			</li>
			<li class="<?= strpos($currentPath, '#dishes') !== false ? 'active' : ''; ?>"><a href="#dishes"
					data-target="dishes">Browse
					Dishes</a></li>
			<li class="<?= strpos($currentPath, '#vendors') !== false ? 'active' : ''; ?>"><a href="#vendors"
					data-target="vendors">Browse
					Vendors</a></li>
			<li class="<?= strpos($currentPath, '#how') !== false ? 'active' : ''; ?>"><a href="#how" data-target="how">How
					It
					Works</a></li>

		<?php endif; ?>
	</ul>
	<div class="nav-buttons">
		<?php if (!$isLoggedIn): ?>
			<li class="nav-btn <?= strpos($currentPath, '/login') !== false ? 'active' : ''; ?>">
				<a class="outline" href="/login">Sign In</a>
			</li>
			<?php if (strpos($baseUrl, '/business') === false): ?>
				<li class="nav-btn <?= strpos($currentPath, '/register') !== false ? 'active' : ''; ?>">
					<a class="fill" href="/register">Sign Up</a>
				</li>
			<?php endif; ?>
		<?php else: ?>
			<li class="nav-btn"><a class="fill" href="/logout">Sign Out</a></li>
			<li class="logged-in <?= strpos($currentPath, '/profile') !== false ? 'active' : ''; ?>">
				<a class="nav-icon" href="/profile"><i class="fa-solid fa-user"></i></a>
			</li>
			<?php if (strpos($baseUrl, '/business') === false): ?>
				<li class="logged-in <?= strpos($currentPath, '/wishlist') !== false ? 'active' : ''; ?>">
					<a class="nav-icon" href="/wishlist"><i class="fa-solid fa-heart"></i></a>
				</li>
				<li class="logged-in <?= strpos($currentPath, '/cart') !== false ? 'active' : ''; ?>">
					<a class="nav-icon" href="/cart"><i class="fa-solid fa-cart-shopping"></i></a>
				</li>
			<?php endif; ?>
		<?php endif; ?>
		<?php if (strpos($baseUrl, '/business') === false): ?>
			<i class="fa-solid fa-bars" id="menu-bar"></i>
		<?php endif ?>
	</div>
</nav>

<script>

	function scrollToSection(sectionId) {
		const element = document.getElementById(sectionId);
		if (element) {
			element.scrollIntoView({
				behavior: 'smooth'
			});
		}
	}


	const userLoggedIn = <?php echo json_encode($isLoggedIn); ?>;
</script>