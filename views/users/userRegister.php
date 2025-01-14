<?php

include_once '../../init.php';
include_once '../../controllers/userController.php';

$userController = new UserController($conn);

$error = null;
$success = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'register') {
  // CSRF token validation
  if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    $error = "Invalid CSRF token.";
  } else {
    $message = $userController->userRegister($_POST);

    if (strpos($message, "successfully") !== false) {
      $success = $message;
    } else {
      $error = $message;
    }
  }
} elseif (isset($_GET['error'])) {
  $error = htmlspecialchars($_GET['error']);
} elseif (isset($_GET['success'])) {
  $success = htmlspecialchars($_GET['success']);
}

$_SESSION['csrf_token'] = bin2hex(random_bytes(32));


// $error = null;
// if (isset($_GET['error'])) {
//   $error = htmlspecialchars($_GET['error']);
// }

// $success = null;
// if (isset($_GET['success'])) {
//   $success = htmlspecialchars($_GET['success']);
// }
?>

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
  <link rel="stylesheet" href="/tiffincraft/assets/css/style.css" />

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
      <form class="register-form" action="/tiffincraft/register" method="POST">
        <input type="hidden" name="action" value="register">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

        <h2>Register</h2>

        <?php if ($error): ?>
          <div class="alert error"><?= $error ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
          <div class="alert success"><?= $success ?></div>
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
    </div>
  </section>
  <!-- Register Form End -->

  <!-- Custom JS  -->
  <script src="/tiffincraft/assets/js/main.js" type="module"></script>

</body>

</html>