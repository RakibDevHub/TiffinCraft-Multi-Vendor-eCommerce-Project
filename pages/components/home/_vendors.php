<?php ob_start(); ?>

<section class="section vendors" id="vendors">
    <div class="section-container">
        <div class="section-heading">
            <h1 class="title">Meet Our Vendors</h1>
            <h3 class="sub-title">Connecting You with Passionate Home Chefs</h3>
        </div>
        <?php if (!$popularVendors && !$newVendors): ?>
            <div class="container">
                <h2>No Vendors to display</h2>
            </div>
        <?php else: ?>
            <?php if ($popularVendors): ?>
                <div class="container popular">
                    <!-- Swiper Slider -->
                    <div class="swiper vendorSlider">
                        <div class="container-header">
                            <h2>Popular Vendors</h2>
                        </div>
                        <div class="swiper-wrapper">
                            <?php foreach ($popularVendors as $vendor): ?>
                                <div class="swiper-slide">
                                    <div class="slider-top">

                                        <?php if (htmlspecialchars($vendor['KITCHEN_TYPE'] === 'Home-cooked')): ?>
                                            <span class="k-type" title="<?= htmlspecialchars($vendor['KITCHEN_TYPE']); ?>"><i
                                                    class="fa-solid fa-house"></i>

                                            </span>
                                        <?php elseif (htmlspecialchars($vendor['KITCHEN_TYPE'] === 'Restaurant-made')): ?>
                                            <span class="k-type" title="<?= htmlspecialchars($vendor['KITCHEN_TYPE']); ?>"><i
                                                    class="fa-solid fa-store"></i>

                                            </span>
                                        <?php endif; ?>

                                        <div class="badge orange-b">
                                            <div class="circle"> <i class="fa-solid fa-crown"></i></div>
                                            <div class="ribbon orange-r">Top Seller</div>
                                        </div>
                                        <img src="/uploads/vendors/<?php echo $vendor['OUTLET_IMAGE']; ?>"
                                            alt="<?php echo htmlspecialchars($vendor['BUSINESS_NAME']); ?>">
                                        <div class="slider-icons">
                                            <span>
                                                <i class="fa-solid fa-star" data-value="1"></i>
                                                <i class="fa-solid fa-star" data-value="2"></i>
                                                <i class="fa-solid fa-star" data-value="3"></i>
                                                <i class="fa-solid fa-star" data-value="4"></i>
                                                <i class="fa-solid fa-star" data-value="5"></i>
                                            </span>
                                            <span>
                                                <i class="fa-solid fa-heart"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="slider-bottom">
                                        <div class="slider-content">
                                            <h2><?= htmlspecialchars($vendor['BUSINESS_NAME']); ?></h2>
                                            <p>Cuisine Categories:</p>
                                            <p class="tag-container">Service Area:
                                                <?php
                                                $deliveryAreas = explode(',', $vendor['DELIVERY_AREAS']);
                                                foreach ($deliveryAreas as $area) {
                                                    ?>
                                                    <span class="area-tags"><?= htmlspecialchars(trim($area)); ?></span>
                                                    <?php
                                                }
                                                ?>
                                            </p>
                                        </div>
                                        <a href="/vendors?id=<?= htmlspecialchars($vendor['ID']); ?>" class="slider-btn">See
                                            Menu <i class="fa-solid fa-border-all"></i></a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <!-- Pagination -->
                        <div class="swiper-buttons">
                            <!-- Navigation -->
                            <div class="swiper-button-prev vendorSlider-prev"></div>
                            <div class="swiper-pagination vendorSlider-pagination"></div>
                            <div class="swiper-button-next vendorSlider-next"></div>
                        </div>
                        <div class="slider-browse">
                            <a href="/vendors">Browse More <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($newVendors): ?>
                <div class="gallery-container">
                    <div class="container-header">
                        <h2>New Arrivals</h2>
                    </div>
                    <div class="gallery-grid" id="gallery-grid">
                        <?php
                        $visibleItems = 6;
                        $totalItems = count($popularVendors);
                        $displayedCount = 0;

                        foreach ($popularVendors as $vendor):
                            $displayedCount++;
                            $displayStyle = $displayedCount > $visibleItems ? 'style="display: none;"' : '';
                            ?>
                            <div class="gallery-item" <?= $displayStyle ?>>
                                <div class="gallery-top">
                                    <?php if (htmlspecialchars($vendor['KITCHEN_TYPE'] === 'Home-cooked')): ?>
                                        <span class="k-type" title="<?= htmlspecialchars($vendor['KITCHEN_TYPE']); ?>"><i
                                                class="fa-solid fa-house"></i>

                                        </span>
                                    <?php elseif (htmlspecialchars($vendor['KITCHEN_TYPE'] === 'Restaurant-made')): ?>
                                        <span class="k-type" title="<?= htmlspecialchars($vendor['KITCHEN_TYPE']); ?>"><i
                                                class="fa-solid fa-store"></i>

                                        </span>
                                    <?php endif; ?>
                                    <div class="badge green-b">
                                        <div class="circle"> <i class="fa-solid fa-seedling"></i></div>
                                        <div class="ribbon green-r">New Seller</div>
                                    </div>
                                    <img src="/uploads/vendors/<?php echo $vendor['OUTLET_IMAGE']; ?>" class="gallery-image"
                                        alt="<?php echo htmlspecialchars($vendor['BUSINESS_NAME']); ?>">
                                    <div class="gallery-icons">
                                        <span>
                                            <i class="fa-solid fa-star" data-value="1"></i>
                                            <i class="fa-solid fa-star" data-value="2"></i>
                                            <i class="fa-solid fa-star" data-value="3"></i>
                                            <i class="fa-solid fa-star" data-value="4"></i>
                                            <i class="fa-solid fa-star" data-value="5"></i>
                                        </span>
                                        <span>
                                            <i class="fa-solid fa-heart"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="gallery-bottom">
                                    <div class="gallery-content">
                                        <h2><?= htmlspecialchars($vendor['BUSINESS_NAME']); ?></h2>
                                        <p>Cuisine Categories:</p>
                                        <p class="tag-container">Service Area:
                                            <?php
                                            $deliveryAreas = explode(',', $vendor['DELIVERY_AREAS']);
                                            foreach ($deliveryAreas as $area) {
                                                ?>
                                                <span class="area-tags"><?= htmlspecialchars(trim($area)); ?></span>
                                                <?php
                                            }
                                            ?>
                                        </p>
                                    </div>
                                    <a href="/vendors?id=<?= htmlspecialchars($vendor['ID']); ?>" class="gallery-btn">See
                                        Menu <i class="fa-solid fa-border-all"></i></a>
                                </div>

                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="gallery-browse">
                        <button id="load-more" <?php if ($totalItems <= $visibleItems)
                            echo 'disabled'; ?>>Load More <i
                                class="fa-solid fa-spinner"></i>
                        </button>
                        <a href="/vendors">Browse All <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>

    </div>
</section>
<script>
    const galleryGrid = document.getElementById('gallery-grid');
    const loadMoreButton = document.getElementById('load-more');
    const galleryItems = galleryGrid.querySelectorAll('.gallery-item');
    let visibleItems = 6; // Initial number of visible items

    loadMoreButton.addEventListener('click', () => {
        visibleItems += 6; // Show 6 more items

        galleryItems.forEach((item, index) => {
            if (index < visibleItems) {
                item.style.display = 'block'; // Show the item
            }
        });

        // Disable the button if all items are visible
        if (visibleItems >= galleryItems.length) {
            loadMoreButton.disabled = true;
        }
    });
</script>

<?php ob_end_flush(); ?>