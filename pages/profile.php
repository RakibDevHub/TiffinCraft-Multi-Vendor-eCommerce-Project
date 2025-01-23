<?php
// Assuming you have $userData available (fetched from the database)
$name = htmlspecialchars($filteredUserData['NAME'], ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars($filteredUserData['EMAIL'], ENT_QUOTES, 'UTF-8');
$phone = htmlspecialchars($filteredUserData['PHONE_NUMBER'], ENT_QUOTES, 'UTF-8');
$account = (int) htmlspecialchars($filteredUserData['IS_ACTIVE'], ENT_QUOTES, 'UTF-8');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="TiffinCraft connects home chefs with food lovers. Explore delicious homemade dishes, join as a vendor, or enjoy meals crafted with care by passionate chefs." />

    <?php include ROOT_DIR . '/pages/components/_fonts.php' ?>


    <!-- Custom CSS -->
    <link rel="stylesheet" href="/assets/css/style.css" />

    <title><?= ucfirst($title); ?></title>
</head>

<body>
    <header class="header-section">
        <?php include ROOT_DIR . 'pages/components/_navbar.php'; ?>
    </header>
    <section class="section profile">
        <div class="profile-content">
            <div class="section-heading">
                <h1 class="title">
                    Profile
                </h1>
            </div>
            <?php
            if (isset($_SESSION['message'])) {
                $messageType = $_SESSION['message_type'] ?? 'info';
                echo "<div class='alert {$messageType}'>{$_SESSION['message']}</div>";

                unset($_SESSION['message'], $_SESSION['message_type']);
            }
            ?>
            <div class="section-body">
                <p><strong>Name:</strong> <?= $name ?></p>
                <p><strong>Email:</strong> <?= $email ?></p>
                <p><strong>Phone:</strong> <?= $phone ?></p>
                <p><strong>Account Status:</strong> <?= ($account === 1) ? 'Active' : 'Deactive'; ?></p>
            </div>
            <div class="section-footer">
                <button class="btn btn-blue" id="editButton">Edit Profile</button>
                <button class="btn btn-blue" id="changePasswordButton">Change Password</button>
                <button class="btn btn-red" id="deleteButton">Delete Account</button>
            </div>
        </div>
    </section>

    <div id="editPopup" class="popup">
        <div class="popup-content">
            <h2>Edit Profile</h2>
            <form class="popup-form" id="editForm" action="/profile/update" method="post">
                <input type="hidden" name="user_id" value="<?= $userData['ID'] ?>">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?= $name ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?= $email ?>" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="tel" id="phone" name="phone" value="<?= $phone ?>" required>
                </div>
                <div class="form-footer">
                    <button class="btn btn-gray" type="button" id="closeEdit">Cancel</button>
                    <button class="btn btn-green" type="submit">Update Profile</button>
                </div>
            </form>
        </div>
    </div>

    <div id="passwordPopup" class="popup">
        <div class="popup-content">
            <h2>Change Password</h2>
            <form class="popup-form" id="passwordForm" action="/profile/change-password" method="post">
                <input type="hidden" name="user_id" value="<?= $userData['ID'] ?>">
                <div class="form-group">
                    <label for="current_password">Current Password:</label>
                    <input type="password" id="current_password" name="current_password" required>
                </div>
                <div class="form-group">
                    <label for="new_password">New Password:</label>
                    <input type="password" id="new_password" name="new_password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm New Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                <div class="form-footer">
                    <button class="btn btn-gray" type="button" id="closePassword">Cancel</button>
                    <button class="btn btn-green" type="submit">Change Password</button>
                </div>
            </form>
        </div>
    </div>

    <div id="deletePopup" class="popup">
        <div class="popup-content">
            <h2>Confirm Delete Account</h2>
            <form class="popup-form" id="deleteForm" action="/profile/delete" method="post">
                <input type="hidden" name="user_id" value="<?= $userData['ID'] ?>">
                <div class="form-group">
                    <label for="confirm">Type 'DELETE' to confirm:</label>
                    <input type="text" id="confirm" name="confirm" required>
                </div>
                <div class="form-footer">
                    <button class="btn btn-gray" type="button" id="cancelDelete">Cancel</button>
                    <button class="btn" type="submit">Confirm Delete</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Custom JS  -->
    <script src="/assets/js/main.js" type="module"></script>

    <script>
        // JavaScript to handle popups

    </script>

</body>

</html>