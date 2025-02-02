<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include ROOT_DIR . '/pages/components/_fonts.php' ?>

    <link rel="stylesheet" href="/assets/css/dashboard.css">
    <title><?= htmlspecialchars($title) ?></title>
</head>

<body>
    <section class="main">
        <!-- Sidebar -->
        <?php include ROOT_DIR . '/pages/components/_sidebar.php' ?>

        <!-- Main Content -->
        <?php if ($userRole !== 'admin'): ?>
            <div class="main-content">
                <!-- Top Header -->
                <header class="top-header">
                    <div class="top-header-left">
                        <h1>Welcome, <?= $userData['NAME']; ?></h1>
                    </div>
                </header>

                <!-- Dashboard Stats -->
                <div class="dashboard-stats">
                    <div class="stats-card">
                        <h3>Total Orders</h3>
                        <p>1500</p>
                    </div>
                    <!-- <div class="stats-card">
                    <h3>Active Vendors</h3>
                    <p>320</p>
                </div> -->
                    <div class="stats-card">
                        <h3>Total Revenue</h3>
                        <p>$50,000</p>
                    </div>
                </div>

                <!-- Dashboard Stats -->
                <div class="dashboard-stats">
                    <div class="stats-card">
                        <h3>Today Orders</h3>
                        <p>1500</p>
                    </div>
                    <div class="stats-card">
                        <h3>Panding Orders</h3>
                        <p>320</p>
                    </div>
                    <div class="stats-card">
                        <h3>Order Complect</h3>
                        <p>$50,000</p>
                    </div>
                </div>

                <!-- Quick Links or Content -->
                <div class="quick-links">
                    <div class="quick-link">
                        <a href="/business/manage-users">
                            <h3>Manage Users</h3>
                            <p>View and manage users (Admins, Vendors, Customers)</p>
                        </a>
                    </div>
                    <div class="quick-link">
                        <a href="/business/orders">
                            <h3>Orders</h3>
                            <p>View and manage customer orders</p>
                        </a>
                    </div>
                    <div class="quick-link">
                        <a href="/business/settings">
                            <h3>Settings</h3>
                            <p>Update platform settings and preferences</p>
                        </a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="main-content">
                <!-- Top Header -->
                <header class="top-header">
                    <div class="top-header-left">
                        <h1>Welcome, <?= $userData['NAME']; ?></h1>
                    </div>
                </header>

                <!-- Dashboard Stats -->
                <div class="dashboard-stats">
                    <div class="stats-card">
                        <h3>Total Users</h3>
                        <p><?= htmlspecialchars($userCount['total']) ?></p>
                    </div>
                    <!-- <div class="stats-card">
                    <h3>Active Vendors</h3>
                    <p>320</p>
                </div> -->
                    <div class="stats-card">
                        <h3>Total Revenue</h3>
                        <p>$50,000</p>
                    </div>
                </div>

                <!-- Dashboard Stats -->
                <div class="dashboard-stats">
                    <div class="stats-card">
                        <h3>Today Orders</h3>
                        <p>1500</p>
                    </div>
                    <div class="stats-card">
                        <h3>Panding Orders</h3>
                        <p>320</p>
                    </div>
                    <div class="stats-card">
                        <h3>Order Complect</h3>
                        <p>$50,000</p>
                    </div>
                </div>

                <!-- Quick Links or Content -->
                <div class="quick-links">
                    <div class="quick-link">
                        <a href="/business/manage-users">
                            <h3>Manage Users</h3>
                            <p>View and manage users (Admins, Vendors, Customers)</p>
                        </a>
                    </div>
                    <div class="quick-link">
                        <a href="/business/orders">
                            <h3>Orders</h3>
                            <p>View and manage customer orders</p>
                        </a>
                    </div>
                    <div class="quick-link">
                        <a href="/business/settings">
                            <h3>Settings</h3>
                            <p>Update platform settings and preferences</p>
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </section>
</body>

</html>