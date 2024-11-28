<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assets/css/style.css" />
  <script src="./assets/js/script.js" defer></script>
  <title>Login</title>
</head>

<body>
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
</body>

</html>