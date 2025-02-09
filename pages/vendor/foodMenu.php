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
                </div>
            </header>
            <div class="content-body">
                <a href="/business/dashboard/food-menu/add-item" class="btn btn-blue open-modal-btn">Add Item</a>
                <div class="menu-content">
                    <?php if (isset($success)): ?>
                        <div class="alert alert-success"><?= $success ?></div>
                    <?php endif; ?>

                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <p><?= $error ?></p>
                        </div>
                    <?php endif; ?>
                    <div class="menu-table">
                        <h2>Menu List</h2>
                        <table>
                            <tr>
                                <th>No.</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Cuisine</th>
                                <th>Description</th>
                                <th>Tags</th>
                                <th>Availability</th>
                                <th>Visibility</th>
                                <th>Action</th>
                            </tr>
                            <?php if (!empty($foodItems)): ?>
                                <?php $serialNumber = 1; ?>
                                <?php foreach ($foodItems as $item): ?>
                                    <tr data-id="<?= $item['ID']; ?>">
                                        <td><?= $serialNumber++; ?></td>
                                        <td class="food-img">
                                            <img src="/uploads/foods/<?= htmlspecialchars($item['IMAGE_URL']) ?>"
                                                alt="<?= htmlspecialchars($item['NAME'] ?? 'N/A') ?>" width="80" height="auto"
                                                onmouseover="showPreview(event, this)" onmouseout="hidePreview()">
                                        </td>
                                        <td><?= htmlspecialchars($item['NAME'] ?? 'N/A') ?></td>
                                        <td><?= htmlspecialchars($item['PRICE'] ?? 'N/A') ?></td>
                                        <td><?= htmlspecialchars($item['DISCOUNT'] ?? 'N/A') ?></td>
                                        <td><?= htmlspecialchars($item['DESCRIPTION'] ?? 'N/A') ?></td>
                                        <td><?= htmlspecialchars($item['CATEGORY_NAME'] ?? 'N/A') ?></td>
                                        <td><?= htmlspecialchars($item['CUISINE_NAME'] ?? 'N/A') ?></td>
                                        <td><?= htmlspecialchars($item['TAGS'] ?? 'N/A') ?></td>
                                        <td><?= htmlspecialchars($item['AVAILABILITY'] ?? 'N/A') ?></td>
                                        <td><?= htmlspecialchars($item['VISIBILITY'] ?? 'N/A') ?></td>
                                        <td>ACTION</td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8">No Food items found.</td>
                                </tr>
                            <?php endif; ?>
                        </table>
                        <img id="floating-preview" class="preview-img" alt="Food Preview">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="/assets/js/main.js" type="module"></script>
    <script>
        // Show the preview on hover
        function showPreview(event, img) {
            const preview = document.getElementById('floating-preview');
            preview.src = img.src;
            preview.style.display = 'block';
            preview.style.left = event.pageX + 20 + 'px';
            preview.style.top = event.pageY + 20 + 'px';
        }

        // Hide the preview
        function hidePreview() {
            const preview = document.getElementById('floating-preview');
            preview.style.display = 'none';
        }

        // Update position as the mouse moves
        document.addEventListener('mousemove', function (event) {
            const preview = document.getElementById('floating-preview');
            if (preview.style.display === 'block') {
                preview.style.left = event.pageX + 20 + 'px';
                preview.style.top = event.pageY + 20 + 'px';
            }
        });
    </script>
</body>

</html>