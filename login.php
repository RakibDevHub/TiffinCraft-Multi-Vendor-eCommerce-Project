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
  <script src="./assets/js/script.js" defer></script>

  <title>Login</title>
</head>

<body>
  <!-- Header Section Start -->
  <header>
    <img class="logo" src="./assets/images/TiffinCraft.png" alt="TiffinCraft Logo" />
    <nav class="navbar">
      <ul class="nav-links">
        <li><a href="./index.php">Home</a></li>
        <li><a href="./vendors.php">Browse Vendors</a></li>
        <li><a href="./dishes.php">Browse Dishes</a></li>
      </ul>
    </nav>
    <div class="nav-buttons">
      <li class="logged-out nav-btn"><a href="./login.php">Sign In</a></li>
      <li class="logged-in"><i class="fa-solid fa-heart"></i></li>
      <li class="logged-in"><i class="fa-solid fa-cart-shopping"></i></li>
      <li class="logged-in"><i class="fa-solid fa-user"></i></li>
      <i class="fa-solid fa-bars" id="menu-bar"></i>
    </div>
  </header>
  <!-- Header Section End -->

  <!-- Login Form Start -->
  <section class="form-container">
    <div class="auth-container">
      <form class="auth-form">
        <h2>Login</h2>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="Enter your email" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Enter your password" required>
        </div>
        <button type="submit" class="btn">Login</button>
        <p class="switch-auth">Don't have an account? <a href="register.php">Register</a></p>
      </form>
    </div>
  </section>
  <!-- Login Form End -->
</body>

</html>