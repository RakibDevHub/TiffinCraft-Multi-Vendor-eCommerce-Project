<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include ROOT_DIR . '/pages/components/_fonts.php' ?>

    <link rel="stylesheet" href="/assets/css/main.css">
    <title><?= htmlspecialchars($title) ?></title>
</head>

<body>
    <section class="main">
        <!-- Sidebar -->
        <?php include ROOT_DIR . '/pages/components/_sidebar.php' ?>

        <!-- Main Content -->
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
            <div class="menu-content">
                <!-- <div class="menu-table">
                    <h2>Menu List</h2>
                    <table>
                        <tr>
                            <th>No.</th>
                            <th>Image</th>
                            <th>Dish</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Type</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Visibility</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <td>01</td>
                            <td>N/A</td>
                            <td>Pizza</td>
                            <td>$10.99</td>
                            <td>$0.99</td>
                            <td>Veg</td>
                            <td>Fast food</td>
                            <td>N/A</td>
                            <td>20</td>
                            <td>Available</td>
                            <td>Private</td>
                            <td>N/A</td>
                        </tr>
                        <tr>
                            <td>01</td>
                            <td>N/A</td>
                            <td>Barger</td>
                            <td>$8.99</td>
                            <td>$0.99</td>
                            <td>Non-Veg</td>
                            <td>Fast food</td>
                            <td>N/A</td>
                            <td>20</td>
                            <td>Available</td>
                            <td>Private</td>
                            <td>N/A</td>
                        </tr>
                    </table>
                </div> -->

                <div class="menu-category">
                    <h2>Menu Categories</h2>
                    <ul>
                        <?php if ($categories): ?>
                            <?php foreach ($categories as $category): ?>
                                <li><?= htmlspecialchars($categories['CATEGORY_NAME']) ?></li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li>No category found</li>
                        <?php endif ?>
                    </ul>
                </div>
            </div>

        </div>
    </section>
</body>

</html>