<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="TiffinCraft connects home chefs with food lovers. Explore delicious homemade dishes, join as a vendor, or enjoy meals crafted with care by passionate chefs." />

    <?php include ROOT_DIR . '/pages/components/_fonts.php' ?>


    <!-- Custom CSS -->
    <link rel="stylesheet" href="/assets/css/style.css" />

    <title>
        <?php
        if (strpos($currentPath, '/business') !== false) {
            echo 'Business ' . ucfirst($title);
        } elseif (strpos($currentPath, '/admin') !== false) {
            echo 'Admin ' . ucfirst($title);
        } else {
            echo ucfirst($title);
        }
        ?>
    </title>
</head>

<body>
    <header class="header-section">
        <?php include_once ROOT_DIR . 'pages/components/_navbar.php' ?>
    </header>

    <section
        class="form-section <?= (strpos($currentPath, '/business') !== false) ? 'color-floral-white' : 'color-white'; ?>">
        <div class="form-container">
            <form class="login-form" action="<?= htmlspecialchars($currentPath); ?>" method="POST" novalidate>
                <input type="hidden" name="csrf_token" value="<?= $csrfToken; ?>">

                <h2>Login</h2>
                <?php if (isset($error)): ?>
                    <div class="alert error"><?= htmlspecialchars($error); ?></div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    <!-- <button type="button" class="toggle-password">Show</button> -->
                </div>
                <div class="form-footer">
                    <!-- <a href="/forgot-password">Forgot Password?</a> -->
                    <button type="submit" class="btn">Login</button>
                    <?php if ($currentPath !== '/login'): ?>
                        <div class="form-links">
                            <a href="/">
                                <i class="fa-solid fa-circle-arrow-left"></i>
                                Go back to TiffinCraft.</a>
                        </div>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </section>

    <!-- Custome Shape -->
    <?php if (strpos($currentPath, '/admin') === false): ?>
        <div
            class="custom-shape flip <?= (strpos($currentPath, '/business') !== false) ? 'color-white' : 'color-floral-white'; ?>">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path
                    d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                    class="<?= (strpos($currentPath, '/business') !== false) ? 'fill-floral-white' : 'fill-white'; ?>">
                </path>
            </svg>
        </div>
        <?php include_once ROOT_DIR . 'pages/components/_footer.php' ?>
    <?php endif; ?>

    <script src="/assets/js/main.js" type="module"></script>
</body>

</html>