<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description"
    content="TiffinCraft connects home chefs with food lovers. Explore delicious homemade dishes, join as a vendor, or enjoy meals crafted with care by passionate chefs." />

  <?php include ROOT_DIR . '/pages/components/_fonts.php' ?>


  <!-- Custom CSS -->
  <link rel="stylesheet" href="/assets/css/style.css" />
  <title><?= ucfirst($title); ?></title>
</head>

<body>
  <header>
    <?php include_once ROOT_DIR . 'pages/components/_navbar.php' ?>
  </header>

  <section
    class="form-section <?= (strpos($currentPath, '/business') !== false) ? 'color-floral-white' : 'color-white'; ?>">
    <div class="form-container <?= (strpos($currentPath, '/business') !== false) ? 'business-form' : ''; ?>">
      <?php if (strpos($currentPath, '/business') === false): ?>
        <form class="register-form" action="/register" method="POST">
          <input type="hidden" name="csrf_token" value="<?= $csrfToken; ?>">
          <h2>Register</h2>
          <?php if (isset($error)): ?>
            <div class="alert error"><?= htmlspecialchars($error); ?></div>
          <?php endif; ?>
          <?php if (isset($success)): ?>
            <div class="alert success"><?= htmlspecialchars($success); ?></div>
          <?php endif; ?>
          <div class="form-group">
            <label for="username">Full Name</label>
            <input type="text" id="username" name="username" placeholder="Enter your full name" required>
          </div>
          <div class="form-group">
            <label for="number">Phone Number</label>
            <input type="text" id="number" name="number" placeholder="Enter your phone number" required>
          </div>
          <div class="form-group">
            <label for="uemail">Email</label>
            <input type="email" id="uemail" name="uemail" placeholder="Enter your email" required>
          </div>
          <div class="form-group">
            <label for="upassword">Password</label>
            <input type="password" id="upassword" name="upassword" placeholder="Enter your password" required>
          </div>
          <div class="form-group">
            <label for="cpassword">Confirm Password</label>
            <input type="password" id="cpassword" name="cpassword" placeholder="Confirm your password" required>
          </div>
          <div style="display: flex; justify-content: flex-end;">
            <button type="submit" class="btn">Register</button>
          </div>
        </form>
      <?php else: ?>
        <form class="register-form" action="/business/register" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="csrf_token" value="<?= $csrfToken; ?>">
          <h2>Register Now</h2>
          <?php if (isset($error)): ?>
            <div class="alert error"><?= htmlspecialchars($error); ?></div>
          <?php endif; ?>
          <?php if (isset($success)): ?>
            <div class="alert success"><?= htmlspecialchars($success); ?></div>
          <?php endif; ?>

          <fieldset>
            <legend>Vendor Information</legend>
            <div class="f-grid">
              <div class="form-group">
                <label for="username">Full Name</label>
                <input type="text" id="username" name="username" placeholder="Enter your full name" required>
              </div>
              <div class="form-group">
                <label for="uemail">Email Address</label>
                <input type="email" id="uemail" name="uemail" placeholder="Enter your email address" required>
              </div>
              <div class="form-group">
                <label for="number">Phone Number</label>
                <input type="text" id="number" name="number" placeholder="Enter your phone number" required>
              </div>
            </div>
          </fieldset>

          <fieldset>
            <legend>Kitchen Details</legend>
            <div class="f-grid">
              <div class="form-group">
                <label for="kname">Kitchen Name</label>
                <input type="text" id="kname" name="kname" placeholder="Enter your kitchen name" required>
              </div>
              <div class="form-group">
                <label for="kaddress">Kitchen Address</label>
                <input type="text" id="kaddress" name="kaddress" placeholder="Enter your kitchen address" required>
              </div>
              <div class="form-group">
                <label for="image">Kitchen Image</label>
                <div style="display: flex;">
                  <button class="btn choose-file-btn" type="button">+ Choose File</button>
                </div>
                <input type="file" id="image" name="image" class="hidden-input" accept="image/*">
              </div>
              <div class="form-group">
                <div class="preview-container hidden">
                  <img id="image-preview" alt="Preview" />
                  <button class="remove-btn" type="button">X</button>
                </div>
              </div>
            </div>
          </fieldset>
          <fieldset>
            <legend>Cuisine and Delivery</legend>
            <div class="form-group">
              <label for="cuisine">Cuisine Type</label>
              <input type="text" id="cuisine" name="cuisine" placeholder="Enter cuisine type" required>
            </div>
            <div class="form-group">
              <label for="delivery">Delivery Areas</label>
              <textarea id="delivery" name="delivery" placeholder="Enter delivery areas, e.g., zip codes or neighborhoods"
                required></textarea>
            </div>
          </fieldset>

          <fieldset>
            <legend>Account Password</legend>
            <div class="f-grid">
              <div class="form-group">
                <label for="upassword">Password</label>
                <input type="password" id="upassword" name="upassword" placeholder="Enter your password" required>
              </div>
              <div class="form-group">
                <label for="cpassword">Confirm Password</label>
                <input type="password" id="cpassword" name="cpassword" placeholder="Confirm your password" required>
              </div>
            </div>
          </fieldset>

          <div class="form-footer">
            <button type="submit" class="btn">Register</button>
          </div>
        </form>
      <?php endif; ?>
    </div>
  </section>

  <!-- Custome Shape -->
  <div
    class="custom-shape flip <?= (strpos($currentPath, '/business') !== false) ? 'color-white' : 'color-floral-white'; ?>">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
      <path
        d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
        class="<?= (strpos($currentPath, '/business') !== false) ? 'fill-floral-white' : 'fill-white'; ?>">
      </path>
    </svg>
  </div>

  <?php include ROOT_DIR . 'pages/components/_footer.php'; ?>

  <script src="/assets/js/main.js" type="module"></script>

</body>

</html>