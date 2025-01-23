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

    <section class="form-section">
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

                </div>
            </form>
        </div>
    </section>

    <?php include_once ROOT_DIR . 'pages/components/_footer.php' ?>
    <!-- <script>
        const formContainer = document.querySelector('.form-container');

        formContainer.addEventListener('click', function (event) {
            if (event.target.classList.contains('toggle-password')) {
                const passwordField = event.target.previousElementSibling;
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    event.target.textContent = 'Hide';
                } else {
                    passwordField.type = 'password';
                    event.target.textContent = 'Show';
                }
            }
        });
    </script> -->
    <script src="/assets/js/main.js" type="module"></script>
</body>

</html>