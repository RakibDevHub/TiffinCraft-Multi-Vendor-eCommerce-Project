<?php if (strpos($currentPath, '/admin') === false): ?>
	<nav class="nav-container">
		<a href="<?= (strpos($currentPath, '/business') !== false) ? '/business' : '/'; ?>" class="nav-logo">
			<img src="/assets/images/<?= (strpos($currentPath, '/business') !== false) ? 'logo.png' : 'TiffinCraft.png'; ?>"
				alt="TiffinCraft Logo" />
			<span><?= (strpos($currentPath, '/business') !== false) ? 'TiffinCraft Business' : ''; ?></span>
		</a>

		<ul class="nav-links">
			<?php if (strpos($currentPath, '/business') === false): ?>
				<li><a href="/" data-target="home">Home</a></li>
				<li><a href="#dishes" data-target="dishes">Browse Dishes</a></li>
				<li><a href="#vendors" data-target="vendors">Browse Vendors</a></li>
				<li><a href="#how" data-target="how">How It Works</a></li>
			<?php endif; ?>
		</ul>
		<div class="nav-buttons">
			<?php if (!$isLoggedIn): ?>
				<li class="nav-btn">
					<a class="outline"
						href="<?= (strpos($currentPath, '/business') !== false) ? '/business/login' : '/login'; ?>">Sign
						In</a>
				</li>
				<li class="nav-btn">
					<a class="fill"
						href="<?= (strpos($currentPath, '/business') !== false) ? '/business/register' : '/register'; ?>">Sign
						Up</a>
				</li>
			<?php else: ?>
				<li class="nav-btn"><a class="fill"
						href="<?= (strpos($currentPath, '/business') !== false) ? '/business/logout' : '/logout'; ?>">Sign
						Out</a>
				</li>
				<li class="logged-in">
					<a class="nav-icon"
						href="<?= (strpos($currentPath, '/business') !== false) ? '/business/profile' : '/profile'; ?>"
						title="Profile">
						<i class="fa-solid fa-user"></i>
					</a>
				</li>
				<?php if ($userRole === 'vendor'): ?>
					<li class="logged-in">
						<a class="nav-icon" href="/business/dashboard" title="Dashboard">
							<i class="fa-solid fa-briefcase"></i>
						</a>
					</li>
				<?php endif; ?>
				<?php if (strpos($currentPath, '/business') === false && $userRole === 'customer'): ?>
					<li class="logged-in">
						<a class="nav-icon" href="/wishlist"><i class="fa-solid fa-heart"></i></a>
					</li>
					<li class="logged-in">
						<a class="nav-icon" href="/cart"><i class="fa-solid fa-cart-shopping"></i></a>
					</li>
				<?php endif; ?>
			<?php endif; ?>
			<?php if (strpos($currentPath, '/business') === false): ?>
				<i class="fa-solid fa-bars" id="menu-bar"></i>
			<?php endif ?>
		</div>
	</nav>
<?php endif ?>

<script>
	const userLoggedIn = <?php echo json_encode($isLoggedIn); ?>;
</script>