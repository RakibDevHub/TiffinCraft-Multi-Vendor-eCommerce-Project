<?php
// Include session and authentication check
include_once '../../config/session.php';
include_once '../../controllers/auth.php';
include_once '../../config/db.php';

// Redirect if the user is not an admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    $message = "Unauthorized user.";
    header('Location: /tiffincraft/admin/login?=' . urlencode($message));
    exit();
}

// Check for the 'logout' action in the URL
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    logout();
}

// Get the logged-in user's information
$user = $_SESSION['user'];

// Fetch all vendors from the database
$sql = "SELECT * FROM vendors";
$stid = oci_parse($conn, $sql);
oci_execute($stid);

// Store vendor data in an array
$vendors = [];
while ($row = oci_fetch_assoc($stid)) {
    $vendors[] = $row;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/admin-dashboard.css">
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
            <li><a href="?action=logout">Logout</a></li>
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

        <!-- Dashboard body -->
        <section class="vendors-table">
            <h2>Vendors List</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Outlet Name</th>
                        <th>Outlet Address</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($vendors) > 0): ?>
                        <?php foreach ($vendors as $vendor): ?>
                            <tr>
                                <td><?= htmlspecialchars($vendor['VENDOR_ID']); ?></td>
                                <td><?= htmlspecialchars($vendor['FIRST_NAME'] . ' ' . $vendor['LAST_NAME']); ?></td>
                                <td><?= htmlspecialchars($vendor['EMAIL']); ?></td>
                                <td><?= htmlspecialchars($vendor['PHONE_NUMBER']); ?></td>
                                <td><?= htmlspecialchars($vendor['OUTLET_NAME']); ?></td>
                                <td><?= htmlspecialchars($vendor['OUTLET_ADDRESS']); ?></td>
                                <td><?= htmlspecialchars($vendor['IS_ACTIVE']); ?></td>
                                <td style="display:flex">
                                    <a href="/tiffincraft/admin/dashboard/manage-users/accept-vendor?id=<?= urlencode($vendor['VENDOR_ID']); ?>"
                                        class="btn-edit">Accept</a>
                                    <a href="/tiffincraft/admin/dashboard/manage-users/reject-vendor?id=<?= urlencode($vendor['VENDOR_ID']); ?>"
                                        class="btn-delete">Reject</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">No vendors found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </div>
</body>

</html>