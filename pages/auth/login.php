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
    <link rel="stylesheet" href="/assets/css/style.css" />

    <title><?= ucfirst($title); ?></title>
</head>

<body>
    <header class="header-section">
        <?php include_once ROOT_DIR . 'pages/components/_navbar.php' ?>
    </header>

    <section class="form-section">
        <div class="form-container">
            <form class="login-form" action="<?= htmlspecialchars($currentURL); ?>" method="POST">
                <input type="hidden" name="csrf_token" value="<?= $csrfToken; ?>">

                <h2>Login</h2>

                <!-- Error Alert -->
                <?php if (isset($error)): ?>
                    <div class="alert error"><?= htmlspecialchars($error); ?></div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email"
                        value="<?= htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES); ?>" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    <button type="button" class="toggle-password">Show</button>
                </div>

                <button type="submit" class="btn">Login</button>
                <div class="form-footer">
                    <a href="/forgot-password">Forgot Password?</a>
                </div>
            </form>
        </div>
    </section>

    <?php include_once ROOT_DIR . 'pages/components/_footer.php' ?>
    <script>
        document.querySelector('.toggle-password').addEventListener('click', function () {
            const passwordField = document.getElementById('password');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                this.textContent = 'Hide';
            } else {
                passwordField.type = 'password';
                this.textContent = 'Show';
            }
        });
    </script>
    <script src="/assets/js/main.js" type="module"></script>
</body>

</html>