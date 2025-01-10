<?php
// include_once '../config/session.php';

// Check if the user is logged in
if (isset($_SESSION['user'])) {
  if ($_SESSION['user']['role'] === 'vendor') {
    header('Location: /tiffincraft/business/dashboard');
    exit();
  } else {
    header('Location: /tiffincraft/');
    exit();
  }
}

// Display error if login fails
if (isset($_GET['error'])) {
  $error = $_GET['error'];
}
?>

<section class="login-popup hidden">
  <div class="popup-content">
    <button class="close-popup-btn">X</button>
    <form class="login-form" action="./controllers/userController.php" method="POST">
      <h2>Login</h2>
      <?php if (isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
      <?php endif; ?>
      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>
      </div>
      <button type="submit" class="btn">Login</button>
    </form>
  </div>
</section>