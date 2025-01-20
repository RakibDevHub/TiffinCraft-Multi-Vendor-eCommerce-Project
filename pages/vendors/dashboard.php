<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome CDN  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/admin-dashboard.css">
    <title>Vendor Dashboard</title>
</head>

<body>
    <?php include_once ROOT_DIR . "pages/components/_navbar.php" ?>
    <!-- Sidebar -->
    <section class="main">
        <div class="sidebar">
            <div class="sidebar-header">
                <h2><?= strtoupper($filteredUserData['KITCHEN_NAME']) ?></h2>
            </div>
            <ul class="sidebar-menu">
                <li><a href="/business/dashboard">Dashboard</a></li>
                <li><a href="/business/manage-users">Manage Customers</a></li>
                <li><a href="/business/settings">Settings</a></li>
                <li><a href="/business/logout">Logout</a></li>
            </ul>
        </div>
        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Header -->
            <header class="top-header">
                <div class="top-header-left">
                    <h1>Welcome, <?= $filteredUserData['NAME']; ?></h1>
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
    </section>
</body>

</html>