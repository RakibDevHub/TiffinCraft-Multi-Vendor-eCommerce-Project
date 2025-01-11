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
  <link rel="stylesheet" href="../tiffincraft/assets/css/style.css" />

  <title>Users Regrister</title>
</head>

<body>
  <!-- Header Section Start -->
  <header class="header-section">
    <?php include '../../components/navbar.php' ?>
  </header>
  <!-- Header Section End -->

  <!-- Register Form Start -->
  <section class="form-section">
    <div class="form-container">
      <form class="register-form" action="" method="">
        <h2>Register</h2>
        <div class="form-group">
          <label for="username">Full Name</label>
          <input type="text" id="username" name="username" placeholder="Enter your full name" required>
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
          <label for="confirm-password">Confirm Password</label>
          <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password"
            required>
        </div>
        <div style="display: flex; justify-content: flex-end;">
          <button type="submit" class="btn">Register</button>
        </div>
      </form>
    </div>
  </section>
  <!-- Register Form End -->

  <!-- Custom JS  -->
  <script src="./assets/js/main.js" type="module"></script>

</body>

</html>