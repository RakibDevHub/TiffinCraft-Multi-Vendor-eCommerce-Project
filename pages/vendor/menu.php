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
                <button class="btn btn-blue open-modal-btn">Add Item</button>

                <div class="menu-content">
                    <div class="menu-table">
                        <h2>Menu List</h2>
                        <table>
                            <tr>
                                <th>No.</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Tags</th>
                                <th>Availability</th>
                                <th>Visibility</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td>01</td>
                                <td>N/A</td>
                                <td>Pizza</td>
                                <td>$10.99</td>
                                <td>$0.99</td>
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
                                <td>Fast food</td>
                                <td>N/A</td>
                                <td>20</td>
                                <td>Available</td>
                                <td>Private</td>
                                <td>N/A</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <?php if (isset($error)): ?>
                <div class="alert error"><?= htmlspecialchars($error); ?></div>
            <?php endif; ?>


            <div class="modal-overlay" id="modalOverlay"></div>

            <div class="modal-content" id="addItemModal">
                <div class="modal-header">Add New Item</div>
                <form id="addItemForm" action="/business/dashboard/menu/add-item" method="POST"
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
                    <div class="f-grid-3">
                        <div class="form-group">
                            <label for="itemPrice">Price</label>
                            <input type="number" id="itemPrice" name="price" placeholder="Enter item price" required>
                        </div>
                        <div class="form-group">
                            <label for="itemDiscount">Discount (%)</label>
                            <input type="number" id="itemDiscount" name="discount" min="0" max="100"
                                placeholder="Enter discount">
                        </div>
                        <div class="form-group">
                            <label for="cuisineType">Cuisine Type</label>
                            <select id="cuisineType" name="cuisine_type">
                                <option value="">Select an option</option>
                                <option value="indian">Indian</option>
                                <option value="italian">Italian</option>
                                <option value="chinese">Chinese</option>
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
                                <option value="available">Available</option>
                                <option value="unavailable">Not-Available</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="visibility">Visibility</label>
                            <select id="visibility" name="visibility">
                                <option value="public">Public</option>
                                <option value="private">Private</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="image">Outlet Image</label>
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

                    <!-- Modal Buttons -->
                    <div class="modal-buttons">
                        <button type="button" class="cancel-btn" onclick="closeModal()">Cancel</button>
                        <button type="submit" class="add-btn">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </section>


    <script>
        // Open and Close Modal Functions
        const modalOverlay = document.getElementById("modalOverlay");
        const modalContent = document.getElementById("addItemModal");
        const openModalBtn = document.querySelector(".open-modal-btn");

        // Show modal
        function openModal() {
            modalOverlay.classList.add("show");
            modalContent.classList.add("show");
        }

        // Hide modal
        function closeModal() {
            modalOverlay.classList.remove("show");
            modalContent.classList.remove("show");
        }

        // Open modal on button click
        openModalBtn.addEventListener("click", openModal);

        // Close modal when clicking outside content
        modalOverlay.addEventListener("click", closeModal);

        // Handle form submission
        document.getElementById("addItemForm").addEventListener("submit", function (event) {
            event.preventDefault();
            const formData = new FormData(this);
            console.log(Object.fromEntries(formData)); // Handle form data processing
            closeModal();
        });
    </script>
    <script src="/assets/js/main.js" type="module"></script>
</body>

</html>