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
        <?php include ROOT_DIR . '/pages/components/_sidebar.php'; ?>

        <div class="main-content">
            <header class="top-header">
                <div class="top-header-left">
                    <div class="breadcrumb">
                        <?php foreach ($breadcrumb as $text => $url): ?>
                            <?php if ($url): ?> <a href="<?= $url ?>"><?= $text ?></a> >
                            <?php else: ?>
                                <span><?= $text ?></span>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <!-- <h1>Welcome, <?= htmlspecialchars($userData['NAME']); ?></h1> -->
                </div>
            </header>

            <section class="vendors-table">
                <!-- <h2>Vendors List</h2> -->

                <!-- Search and Filter Section -->
                <div class="search-filter-container">
                    <input type="text" id="searchInput" placeholder="Search by Name, Email, or Business Name">
                    <select id="statusFilter">
                        <option value="">All</option>
                        <option value="pending">Pending</option>
                        <option value="accept">Accepted</option>
                        <option value="reject">Rejected</option>
                    </select>
                </div>
                <div class="table-wrapper">
                    <table class="user-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Type</th>
                                <th>Kitchen Name</th>
                                <th>Address</th>
                                <th>Service Area</th>
                                <th>Cuisine</th>
                                <th>Request</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="vendorsTableBody">
                            <?php if (!empty($vendors)): ?>
                                <?php $serialNumber = 1; ?>
                                <?php foreach ($vendors as $vendor): ?>
                                    <tr class="vendor-row" data-id="<?= $vendor['ID']; ?>"
                                        data-image="<?= htmlspecialchars($vendor['OUTLET_IMAGE']); ?>"
                                        data-name="<?= htmlspecialchars($vendor['NAME'] ?? ''); ?>"
                                        data-email="<?= htmlspecialchars($vendor['EMAIL'] ?? ''); ?>"
                                        data-phone="<?= htmlspecialchars($vendor['PHONE_NUMBER'] ?? ''); ?>"
                                        data-business-name="<?= htmlspecialchars($vendor['BUSINESS_NAME'] ?? ''); ?>"
                                        data-business-address="<?= htmlspecialchars($vendor['BUSINESS_ADDRESS'] ?? ''); ?>"
                                        data-outlet-image="<?= htmlspecialchars($vendor['OUTLET_IMAGE'] ?? ''); ?>"
                                        data-description="<?= htmlspecialchars($vendor['DESCRIPTION'] ?? ''); ?>"
                                        data-kitchen-type="<?= htmlspecialchars($vendor['KITCHEN_TYPE'] ?? ''); ?>"
                                        data-delivery-areas="<?= htmlspecialchars($vendor['DELIVERY_AREAS'] ?? ''); ?>"
                                        data-status="<?= htmlspecialchars($vendor['STATUS']); ?>"
                                        data-created-at="<?= htmlspecialchars($vendor['CREATED_AT'] ?? ''); ?>"
                                        data-cuisine-type="<?= htmlspecialchars($vendor['CUISINE_TYPE'] ?? 'N/A'); ?>">
                                        <td><?= $serialNumber++; ?></td>

                                        <?php if (htmlspecialchars($vendor['KITCHEN_TYPE'] === 'Home-cooked')): ?>
                                            <td>Home</td>
                                        <?php elseif (htmlspecialchars($vendor['KITCHEN_TYPE'] === 'Restaurant-made')): ?>
                                            <td>Restaurant</td>
                                        <?php else: ?>
                                            <td>N/A</td>
                                        <?php endif; ?>
                                        <td><?= htmlspecialchars($vendor['BUSINESS_NAME'] ?? 'N/A'); ?></td>
                                        <td><?= htmlspecialchars($vendor['BUSINESS_ADDRESS'] ?? 'N/A'); ?></td>
                                        <td><?= htmlspecialchars($vendor['DELIVERY_AREAS'] ?? 'N/A'); ?></td>
                                        <td><?= htmlspecialchars($vendor['CUISINE_TYPE'] ?? 'N/A'); ?></td>
                                        <td><?= htmlspecialchars($vendor['STATUS'] ?? 'N/A'); ?></td>
                                        <td>
                                            <button class="btn-view-details">View Details</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8">No vendors found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </section>

    <!-- Modal -->
    <div id="vendorModal" class="modal">
        <div class="modal-content">
            <h1>Vendor Details: </h1>
            <span id="closeModal" class="close">&times;</span>
            <div class="personal-info">
                <img id="vendorImage" alt="Outlet Image">
                <p>Name: <span id="vendorName"></span></p>
                <p>Email: <span id="vendorEmail"></span></p>
                <p>Phone: <span id="vendorPhone"></span></p>
            </div>
            <div class="business-info">
                <p>Business Name: <span id="vendorBusinessName"></span></p>
                <p>Business Address: <span id="vendorBusinessAddress"></span></p>
                <p>Kitchen Type: <span id="vendorKitchenType"></span></p>
                <p>Cuisine Type: <span id="vendorCuisineType"></span></p>
                <p>Delivery Areas:</strong> <span id="vendorDeliveryAreas"></span></p>
                <p>Request: <span id="vendorStatus"></span></p>

                <p>Joined Date: <span id="vendorCreatedAt"></span></p>
            </div>
            <!-- <h3>Vendor Details</h3>
            <p><strong>Outlet Image:</strong> <img id="vendorImage" alt="Outlet Image"></p>
            <p><strong>Name:</strong> <span id="vendorName"></span></p>
            <p><strong>Email:</strong> <span id="vendorEmail"></span></p>
            <p><strong>Phone:</strong> <span id="vendorPhone"></span></p>
            <p><strong>Business Name:</strong> <span id="vendorBusinessName"></span></p>
            <p><strong>Business Address:</strong> <span id="vendorBusinessAddress"></span></p>
            <p><strong>Kitchen Type:</strong> <span id="vendorKitchenType"></span></p>
            <p><strong>Delivery Areas:</strong> <span id="vendorDeliveryAreas"></span></p>
            <p><strong>Status:</strong> <span id="vendorStatus"></span></p>
            <p><strong>Cuisine Type:</strong> <span id="vendorCuisineType"></span></p>
            <p><strong>Created At:</strong> <span id="vendorCreatedAt"></span></p> -->
        </div>
    </div>

    <script src="/assets/js/_model.js"></script>
    <script src="/assets/js/_manageUsers.js"></script>

</body>

</html>