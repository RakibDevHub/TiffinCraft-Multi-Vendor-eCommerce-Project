<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/tiffincraft/views/admin/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../../assets/css/admin-login.css">
</head>

<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <form class="login-form" action="/admin/dashboard" method="POST">
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
</body>

</html>