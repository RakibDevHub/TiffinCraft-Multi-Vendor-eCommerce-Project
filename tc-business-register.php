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
  <link rel="stylesheet" href="./assets/css/style.css" />

  <!-- Custom JS -->
  <!-- <script src="./assets/js/script.js" defer></script> -->

  <title>Regrister</title>
</head>

<body>
  <!-- Header Section Start -->
  <header class="header-section">
    <nav class="nav-container">
      <a href="./index.php" class="nav-logo">
        <img src="./assets/images/TiffinCraft.png" alt="TiffinCraft Logo" /> Business
      </a>
      <!-- <ul class="nav-links">
        <li><a href="./index.php">Home</a></li>
        <li><a href="./dishes.php">Browse Dishes</a></li>
        <li><a href="./vendors.php">Browse Vendors</a></li>
      </ul> -->
      <div class="nav-buttons">
        <li class="logged-out nav-btn"><a class="outline" href="./login.php">Sign In</a></li>
        <li class="logged-out nav-btn"><a class="fill" href="./register.php">Sign Up</a></li>
        <li class="logged-in"><i class="fa-solid fa-heart"></i></li>
        <li class="logged-in"><i class="fa-solid fa-cart-shopping"></i></li>
        <li class="logged-in"><i class="fa-solid fa-user"></i></li>
        <i class="fa-solid fa-bars" id="menu-bar"></i>
      </div>
    </nav>
  </header>
  <!-- Header Section End -->

  <!-- Register Form Start -->
  <section class="form-container">
    <div class="auth-container">
      <form class="auth-form">
        <h2>Register</h2>
        <!-- User Type Selection -->
        <!-- <div class="form-group">
          <label for="user-type">Register as:</label>
          <select id="user-type" name="user-type" required>
            <option value="customer">Customer</option>
            <option value="vendor">Vendor</option>
          </select>
        </div> -->
        <!-- Common Fields -->
        <div class="form-group">
          <label for="username">Full Name</label>
          <input type="text" id="username" name="username" placeholder="Enter your full name" required>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="Enter your email" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Enter your password" required>
        </div>
        <div class="form-group">
          <label for="confirm-password">Confirm Password</label>
          <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password"
            required>
        </div>
        <!-- Vendor-Only Fields -->
        <!-- <div class="form-group hidden" id="vendor-fields">
          <h3>Business Information</h3>
          <label for="business-name">Business Name</label>
          <input type="text" id="business-name" name="business-name" placeholder="Enter your business name">
          <label for="vendor-category">Category</label>
          <input type="text" id="vendor-category" name="vendor-category" placeholder="e.g., Bakery, Meals, Beverages">
        </div> -->
        <button type="submit" class="btn">Register</button>
        <p class="switch-auth">Already have an account? <a href="login.php">Login</a></p>
      </form>
    </div>
  </section>
  <!-- Register Form End -->
</body>
<script src="./assets/js/main.js" type="module"></script>

</html>