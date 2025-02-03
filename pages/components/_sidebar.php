<div class="sidebar">
    <div class="sidebar-logo">
        <a href="/business" title="TiffinCraft Business">
            <img src="/assets/images/logo.png" alt="">
            <span class="logo-name"><?= (strpos($currentPath, '/business') !== false) ? 'TCB' : 'TCA'; ?></span>
        </a>
        <!-- <i class="fa-solid fa-chart-simple"></i> -->
        <i class="fa-solid fa-angles-right"></i>
    </div>
    <ul class="sidebar-links-container">
        <div class="dt">
            <li>
                <a href="<?= (strpos($currentPath, '/business') !== false) ? '/business/dashboard' : '/admin/dashboard'; ?>"
                    class="sidebar-link">
                    <i class="fa-solid fa-chart-pie"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <?php if (strpos($currentPath, '/admin') === false): ?>
                <li>
                    <a href="/business/menus" class="sidebar-link">
                        <i class="fa-solid fa-shrimp"></i>
                        <span>Manage Menu</span>
                    </a>
                </li>
                <li>
                    <a href="/business/orders" class="sidebar-link">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <span>Manage Orders</span>
                    </a>
                </li>
                <li>
                    <a href="/business/customers" class="sidebar-link">
                        <i class="fa-solid fa-user-group"></i>
                        <span>Customers</span>
                    </a>
                </li>
                <li>
                    <a href="/Business/reviews" class="sidebar-link">
                        <i class="fa-regular fa-star-half-stroke"></i>
                        <span>Reviews</span>
                    </a>
                </li>
            <?php else: ?>
                <li>
                    <a href="/admin/dashboard/manage-users" class="sidebar-link">
                        <i class="fa-solid fa-inbox"></i>
                        <span>Manage Users</span>
                    </a>
                </li>
                <li>
                    <a href="/business/inbox" class="sidebar-link">
                        <i class="fa-solid fa-inbox"></i>
                        <span>Inbox</span>
                    </a>
                </li>
            <?php endif; ?>
        </div>
        <div class="db">
            <!-- <span style="
                    width: 100%;
                    height: 1px;
                    background: #ccc;
                "></span> -->
            <li>
                <a href="/business/profile" class="sidebar-link">
                    <i class="fa-solid fa-user"></i>
                    <span>Manage Profile</span>
                </a>
            </li>
            <li>
                <a href="/business/settings" class="sidebar-link">
                    <i class="fa-solid fa-gear"></i>
                    <span>Settings</span>
                </a>
            </li>
            <li>
                <a href="<?= (strpos($currentPath, '/business') !== false) ? '/business/logout' : '/admin/logout'; ?>"
                    class="sidebar-link">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Sign Out</span>
                </a>
            </li>
        </div>
    </ul>
</div>