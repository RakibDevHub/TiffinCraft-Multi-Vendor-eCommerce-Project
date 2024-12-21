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

  <title>Regrister</title>
</head>

<body>
  <!-- Header Section Start -->
  <header class="header-section">
    <nav class="nav-container">
      <a href="./tc-business-register.php" class="nav-logo">
        <img src="./assets/images/TiffinCraft.png" alt="TiffinCraft Logo" /> <span>Business</span>
      </a>
      <div class="nav-buttons">
        <li class="logged-out nav-btn"><a class="outline" href="./login.php">Sign In</a></li>
        <li class="logged-out nav-btn"><a class="fill" href="./register.php">Sign Up</a></li>
        <!-- <li class="logged-in"><i class="fa-solid fa-heart"></i></li>
        <li class="logged-in"><i class="fa-solid fa-cart-shopping"></i></li>
        <li class="logged-in"><i class="fa-solid fa-user"></i></li> -->
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
        <button type="submit" class="btn">Register</button>
        <!-- <p class="switch-auth">Already have an account? <a href="login.php">Login</a></p> -->
      </form>
    </div>
  </section>
  <!-- Register Form End -->

  <!-- Custom CSS  -->
  <script src="./assets/js/main.js" type="module"></script>
</body>

</html>