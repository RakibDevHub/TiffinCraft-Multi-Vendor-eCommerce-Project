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
            <div class="content-body">
                <div class="menu-content">
                    <?php if (isset($success)): ?>
                        <div class="alert alert-success"><?= $success ?></div>
                    <?php endif; ?>

                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <?php foreach ($errors as $error): ?>
                                <p><?= $error ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <div class="form-content">
                        <div class="form-header">Add New Item</div>
                        <form class="addItemForm" action="/business/dashboard/menu/add-item" method="POST"
                            enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="itemName">Name</label>
                                <input type="text" id="itemName" name="name" placeholder="Enter item name" required>
                            </div>
                            <div class="form-group">
                                <label for="itemDescription">Description</label>
                                <textarea id="itemDescription" name="description" rows="3"
                                    placeholder="Enter description"></textarea>
                            </div>
                            <div class="f-grid">
                                <div class="form-group">
                                    <label for="itemPrice">Price</label>
                                    <input type="number" id="itemPrice" name="price" placeholder="Enter item price"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="itemDiscount">Discount (%)</label>
                                    <input type="number" id="itemDiscount" name="discount" min="0" max="100"
                                        placeholder="Enter discount">
                                </div>
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select id="category" name="category_id">
                                        <option value="">Select an option</option>
                                        <?php if (!empty($categories)): ?>
                                            <?php foreach ($categories as $category): ?>
                                                <option value="<?= htmlspecialchars($category['ID']) ?>">
                                                    <?= htmlspecialchars($category['CATEGORY_NAME']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <option value="" disabled>No category found</option>
                                        <?php endif ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="cuisine">Cuisine Type</label>
                                    <select id="cuisine" name="cuisine_id">
                                        <option value="">Select an option</option>
                                        <?php if (!empty($cuisines)): ?>
                                            <?php foreach ($cuisines as $cuisine): ?>
                                                <option value="<?= htmlspecialchars($cuisine['ID']) ?>">
                                                    <?= htmlspecialchars($cuisine['CUISINE_NAME']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <option value="" disabled>No cuisines found</option>
                                        <?php endif ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tags">Tags</label>
                                <input type="text" id="tags" name="tags" placeholder="e.g., Non-Veg, spicy, Organic">
                            </div>
                            <div class="f-grid">
                                <div class="form-group">
                                    <label for="availability">Status</label>
                                    <select id="availability" name="availability">
                                        <option value="Available">Available</option>
                                        <option value="Not-Available">Not-Available</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="visibility">Visibility</label>
                                    <select id="visibility" name="visibility">
                                        <option value="Public">Public</option>
                                        <option value="Private">Private</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image">Food Image</label>
                                <div style="display: flex;">
                                    <button class="btn choose-file-btn btn-green" type="button">+ Choose File</button>
                                </div>
                                <input type="file" id="image" name="image" class="hidden-input" accept="image/*">
                            </div>
                            <div class="form-group">
                                <div class="preview-container hidden">
                                    <img id="image-preview" alt="Preview" />
                                    <button class="remove-btn" type="button">X</button>
                                </div>
                            </div>

                            <!-- form Buttons -->
                            <div class="form-buttons">
                                <button type="submit" class="add-btn">Confirm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </section>

    <script src="/assets/js/main.js" type="module"></script>
</body>

</html>