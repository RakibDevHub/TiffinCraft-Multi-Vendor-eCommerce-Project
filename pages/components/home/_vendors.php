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
                            <img src="/uploads/vendors/<?php echo $vendor['KITCHEN_IMAGE']; ?>"
                                alt="<?php echo htmlspecialchars($vendor['KITCHEN_NAME']); ?>">
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
                                <h2><?= htmlspecialchars($vendor['KITCHEN_NAME']); ?></h2>
                                <span>Location: <?= htmlspecialchars($vendor['KITCHEN_ADDRESS']); ?></span>
                                <span>Service area: <?= htmlspecialchars($vendor['DELIVERY_AREAS']); ?></span>
                            </div>
                            <a href="/vendors?id=<?= htmlspecialchars($vendor['ID']); ?>" class="btn card-btn">See Menu</a>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- Pagination -->
                <div class="swiper-buttons">
                    <!-- Navigation -->
                    <div class="swiper-button-prev vendor-slider-popular-prev"></div>
                    <div class="swiper-pagination vendor-slider-popular-pagination"></div>
                    <div class="swiper-button-next vendor-slider-popular-next"></div>

                    <!-- <div class="swiper-button-next"></div> -->
                </div>
            </div>

        </div>

        <div class="container new">
            <!-- Swiper Slider -->
            <div class="swiper vendor-slider-new">
                <div class="container-header">
                    <h2>New Vendors</h2>
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