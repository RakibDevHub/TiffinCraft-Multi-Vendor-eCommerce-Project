<?php

// include_once dirname(__DIR__, 3) . '/init.php';
// include_once ROOT_DIR . 'app/Controllers/userController.php';
// include_once ROOT_DIR . 'app/Controllers/authController.php';

// $userController = new UserController($conn);
// $authController = new AuthController($conn);

// $error = null;
// $success = null;

// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'register') {
//   if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
//     $error = "Invalid CSRF token.";
//   } else {
//     $userId = $userController->userRegister($_POST);

//     if (is_numeric($userId)) {

//       $loggedIn = $authController->login($_POST['uemail'], $_POST['upassword'], 'customer');
//       if ($loggedIn) {
//         header("Location: /tiffincraft/");
//         exit();
//       } else {
//         $error = "Registration successful, but login failed.";
//       }

//     } else {
//       $error = $userId;
//     }
//   }
// } elseif (isset($_GET['error'])) {
//   $error = htmlspecialchars($_GET['error']);
// } elseif (isset($_GET['success'])) {
//   $success = htmlspecialchars($_GET['success']);
// }

// $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
?>

<!DOCTYPE html>
<html>

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

  <title>Users Regrister</title>
</head>

<body>
  <header>
    <?php include_once ROOT_DIR . 'pages/components/_navbar.php' ?>
  </header>


  <section class="form-section">
    <div class="form-container">
      <?php if (strpos($currentPath, '/business') === false): ?>
        <form class="register-form" action="/register" method="POST">
          <input type="hidden" name="action" value="register">
          <input type="hidden" name="csrf_token" value="<?= $_SESSION["csrf_token"] ?>">

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
      <?php else: ?>
        <form class="register-form" action="/business/register" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="action" value="register">
          <!-- <input type="hidden" name="csrf_token" value="<?= $_SESSION["csrf_token"] ?>"> -->
          <h2>Register Now</h2>

          <?php if ($error): ?>
            <div class="alert error"><?php echo $error ?></div>
          <?php endif; ?>

          <?php if ($success): ?>
            <div class="alert success"><?php echo $success ?></div>
          <?php endif; ?>

          <div class="form-header">
            <p>Fill up the form below.</p>
            <button type="submit" class="btn">Submit Request</button>
          </div>
          <div class="f-grid">
            <div class="form-group">
              <label for="fname">First Name</label>
              <input type="text" id="fname" name="fname" placeholder="Enter your first name" required>
            </div>
            <div class="form-group">
              <label for="lname">Last Name</label>
              <input type="text" id="lname" name="lname" placeholder="Enter your Last name" required>
            </div>
            <div class="form-group">
              <label for="uemail">Email Address</label>
              <input type="email" id="uemail" name="uemail" placeholder="Enter your email address" required>
            </div>
            <div class="form-group">
              <label for="number">Phone Number</label>
              <input type="text" id="number" name="number" placeholder="Enter your phone number" required>
            </div>
            <div class="form-group">
              <label for="outlet">Outlet Name</label>
              <input type="text" id="outlet" name="outlet" placeholder="Enter your outlet name" required>
            </div>
            <div class="form-group">
              <label for="outlet-address">Outlet Address</label>
              <input type="text" id="outlet-address" name="outlet-address" placeholder="Enter your outlet address"
                required>
            </div>
            <div class="form-group">
              <label for="image">Outlet Image</label>
              <div style="display: flex">
                <button class="btn choose-file-btn" type="button">+ Choose File</button>
              </div>
              <input type="file" id="image" name="image" class="hidden-input" accept="image/*">
              <div class="preview-container hidden">
                <img id="image-preview" alt="Preview" />
                <button class="remove-btn" type="button">X</button>
              </div>
            </div>
          </div>
        </form>
      <?php endif; ?>
    </div>
  </section>

  <?php include ROOT_DIR . 'pages/components/_footer.php'; ?>

  <!-- Custom JS  -->
  <script src="/assets/js/main.js" type="module"></script>

</body>

</html>