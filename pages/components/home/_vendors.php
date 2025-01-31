<?php ob_start(); ?>

<section class="section vendors" id="vendors">
    <div class="section-container">
        <div class="section-heading">
            <h1 class="title">Meet Our Vendors</h1>
            <h3 class="sub-title">Connecting You with Passionate Home Chefs</h3>
        </div>

        <div class="container popular">
            <!-- Swiper Slider -->
            <div class="swiper vendor-slider-popular">
                <div class="container-header">
                    <h2>Popular Vendors</h2>
                    <a href="/vendors">Browse More</a>
                </div>
                <div class="swiper-wrapper">
                    <?php foreach ($vendors as $vendor): ?>
                        <div class="swiper-slide">
                            <div class="slider-top">
                                <span class="k-type"><?= htmlspecialchars($vendor['KITCHEN_TYPE']); ?></span>
                                <div class="badge orange-b">
                                    <div class="circle"> <i class="fa-solid fa-medal"></i></div>
                                    <div class="ribbon">Top Seller</div>
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
                                    <p>Service Area:
                                        <?php
                                        $deliveryAreas = explode(',', $vendor['DELIVERY_AREAS']);
                                        foreach ($deliveryAreas as $area) {
                                            ?>
                                            <span><?= htmlspecialchars(trim($area)); ?></span>
                                            <?php
                                        }
                                        ?>
                                    </p>
                                </div>
                                <a href="/vendors?id=<?= htmlspecialchars($vendor['ID']); ?>" class="btn slider-btn">See
                                    Menu</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- Pagination -->
                <div class="swiper-buttons">
                    <!-- Navigation -->
                    <div class="swiper-button-prev vendor-slider-popular-prev"></div>
                    <div class="swiper-pagination vendor-slider-popular-pagination"></div>
                    <div class="swiper-button-next vendor-slider-popular-next"></div>
                </div>
            </div>

        </div>

        <div class="container new">
            <!-- Swiper Slider -->
            <div class="swiper vendor-slider-new">
                <div class="container-header">
                    <h2>New Arrivals</h2>
                    <a href="#">Browse More</a>
                </div>
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <div class="swiper-slide">
                        <img src="/assets/images/hero.jpeg" alt="Slide 1">
                        <div class="slide-top">
                            <span>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                            </span>
                            <span>
                                <i class="fa-solid fa-heart"></i>
                            </span>
                        </div>
                        <div class="slider-bottom">
                            <h2>Kitchen Name</h2>
                            <span>Customer Served</span>
                            <span>Location</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <img src="/assets/images/hero.jpeg" alt="Slide 1">
                        <div class="slide-top">
                            <span>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                            </span>
                            <span>
                                <i class="fa-solid fa-heart"></i>
                            </span>
                        </div>
                        <div class="slider-bottom">
                            <h2>Kitchen Name</h2>
                            <span>Customer Served</span>
                            <span>Location</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <img src="/assets/images/hero.jpeg" alt="Slide 1">
                        <div class="slide-top">
                            <span>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                            </span>
                            <span>
                                <i class="fa-solid fa-heart"></i>
                            </span>
                        </div>
                        <div class="slider-bottom">
                            <h2>Kitchen Name</h2>
                            <span>Customer Served</span>
                            <span>Location</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <img src="/assets/images/hero.jpeg" alt="Slide 1">
                        <div class="slide-top">
                            <span>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                            </span>
                            <span>
                                <i class="fa-solid fa-heart"></i>
                            </span>
                        </div>
                        <div class="slider-bottom">
                            <h2>Kitchen Name</h2>
                            <span>Customer Served</span>
                            <span>Location</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <img src="/assets/images/hero.jpeg" alt="Slide 1">
                        <div class="slide-top">
                            <span>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                            </span>
                            <span>
                                <i class="fa-solid fa-heart"></i>
                            </span>
                        </div>
                        <div class="slider-bottom">
                            <h2>Kitchen Name</h2>
                            <span>Customer Served</span>
                            <span>Location</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <img src="/assets/images/hero.jpeg" alt="Slide 1">
                        <div class="slide-top">
                            <span>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                            </span>
                            <span>
                                <i class="fa-solid fa-heart"></i>
                            </span>
                        </div>
                        <div class="slider-bottom">
                            <h2>Kitchen Name</h2>
                            <span>Customer Served</span>
                            <span>Location</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <img src="/assets/images/hero.jpeg" alt="Slide 1">
                        <div class="slide-top">
                            <span>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                            </span>
                            <span>
                                <i class="fa-solid fa-heart"></i>
                            </span>
                        </div>
                        <div class="slider-bottom">
                            <h2>Kitchen Name</h2>
                            <span>Customer Served</span>
                            <span>Location</span>
                        </div>
                    </div>
                </div>
                <!-- Pagination -->
                <div class="swiper-buttons">
                    <!-- Navigation -->
                    <div class="swiper-button-prev vendor-slider-new-prev"></div>
                    <div class="swiper-pagination vendor-slider-new-pagination"></div>
                    <div class="swiper-button-next vendor-slider-new-next"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php ob_end_flush(); ?>