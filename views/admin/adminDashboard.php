<?php
// Include session and authentication check
include_once '../../controllers/authController.php';

session_start();

// Redirect if the user is not an admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    $message = "Unauthorized user.";
    header('Location: /tiffincraft/admin/login?=' . urlencode($message));
    exit();
}

$user = $_SESSION['user'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../../tiffincraft/assets/css/style.css">
    <link rel="stylesheet" href="../../tiffincraft/assets/css/admin-dashboard.css">
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>TiffinCraft Admin</h2>
        </div>
        <ul class="sidebar-menu">
            <li><a href="/tiffincraft/admin/dashboard">Dashboard</a></li>
            <li><a href="/tiffincraft/admin/dashboard/manage-users">Manage Users</a></li>
            <li><a href="/tiffincraft/admin/dashboard/settings">Settings</a></li>
            <li><a href="/tiffincraft/admin/logout">Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Header -->
        <header class="top-header">
            <div class="top-header-left">
                <h1>Welcome, <?= htmlspecialchars($user['email']); ?></h1>
            </div>
            <div class="top-header-right">
                <a href="?action=logout" class="logout-btn">Logout</a>
            </div>
        </header>

        <!-- Dashboard Stats -->
        <div class="dashboard-stats">
            <div class="stats-card">
                <h3>Total Orders</h3>
                <p>1500</p>
            </div>
            <div class="stats-card">
                <h3>Active Vendors</h3>
                <p>320</p>
            </div>
            <div class="stats-card">
                <h3>Total Revenue</h3>
                <p>$50,000</p>
            </div>
        </div>

        <!-- Quick Links or Content -->
        <div class="quick-links">
            <div class="quick-link">
                <a href="/tiffincraft/admin/dashboard/manage-users">
                    <h3>Manage Users</h3>
                    <p>View and manage users (Admins, Vendors, Customers)</p>
                </a>
            </div>
            <div class="quick-link">
                <a href="/tiffincraft/admin/orders">
                    <h3>Orders</h3>
                    <p>View and manage customer orders</p>
                </a>
            </div>
            <div class="quick-link">
                <a href="/tiffincraft/admin/dashboard/settings">
                    <h3>Settings</h3>
                    <p>Update platform settings and preferences</p>
                </a>
            </div>
        </div>
    </div>
</body>

</html>