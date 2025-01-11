<section class="form-section">
  <div class="form-container">
    <form class="login-form" action="./controllers/<?php echo $controller ?>" method="POST">
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
      <div class="form-footer">
        <a href="#">Forgot Password?</a>
      </div>
    </form>
  </div>
</section>