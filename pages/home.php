<?php

$features = [
    [
        "icon" => "fa-solid fa-infinity",
        "title" => "Explore Endless Possibilities",
        "description" => "Unleash your creativity and explore a diverse range of homemade
  recipes with TiffinCraft. From traditional favorites to innovative
  creations, there's something for everyone.",
    ],
    [
        "icon" => "fa-solid fa-lightbulb",
        "title" => "Discover Homemade Delights",
        "description" => "Indulge in a world of homemade goodness with TiffinCraft. Explore,
  share, and savor delicious homemade dishes from passionate cooks
  like you.",
    ],
    [
        "icon" => "fa-solid fa-fire",
        "title" => "Share Your Passion",
        "description" => "Share your love for cooking and connect with fellow food
  enthusiasts. Showcase your culinary talents and inspire others with
  your homemade delights.",
    ],
    [
        "icon" => "fa-solid fa-handshake",
        "title" => "Join Our Community",
        "description" => "Join our welcoming community of food lovers and embark on a
  flavorful journey. Whether you're a seasoned chef or a novice,
  there's always room at our table.",
    ],
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="TiffinCraft connects home chefs with food lovers. Explore delicious homemade dishes, join as a vendor, or enjoy meals crafted with care by passionate chefs." />

    <?php include ROOT_DIR . '/pages/components/_fonts.php' ?>

    <!-- Swiper Slider CSS  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="/assets/css/swiper-init.css" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/assets/css/style.css" />

    <title><?= $title ?></title>
</head>

<body>
    <!-- Header Section Start -->
    <header class="header-section">
        <?php include ROOT_DIR . 'pages/components/_navbar.php'; ?>
        <div class="business-link">
            <p>Open a Business Account.</p>
            <a class="outline" href="/business/register">Sign Up</a>
            <button class="close-btn" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Start -->

    <?php if (strpos($currentPath, '/business') === false): ?>
        <section class="home" id="home">
            <!-- Dark Overlay  -->
            <div class="overlay"></div>
            <div class="hero">
                <div class="hero-txt">
                    <div class="hero-link">
                        <span>
                            <p>
                                Become a Seller.
                            </p>
                            <a class="outline" href="/business">
                                TiffinCraft-Business
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </span>
                    </div>
                    <h1 class="title">Hungry!</h1>
                    <p class="sub-title">What are you waiting for!</p>
                    <div class="hero-buttons">
                        <a class="fill" href="#">Order Now <i class="fa-brands fa-opencart"></i></a>
                    </div>
                </div>

            </div>
        </section>
    <?php else: ?>
        <section class="tc-business home" id="home">
            <div class="overlay"></div>
            <div class="hero">
                <div class="hero-txt">
                    <h1 class="title">Partner with TiffinCraft</h1>
                    <div class="hero-buttons business">
                        <a class="outline" href="#how" data-target="how">How It Works!<i
                                class="fa-solid fa-arrow-right"></i></a>
                        <a class="fill" href="/business/register">Register Now</a>
                    </div>
                </div>
            </div>
        </section>
    <?php endif ?>
    <!-- Hero Section End -->

    <!-- Custom Shape  -->
    <div class="spacer layer"></div>

    <?php if (strpos($currentPath, '/business') === false): ?>

        <!-- Dished Section Start  -->
        <?php include ROOT_DIR . 'pages/components/home/_dishes.php' ?>
        <!-- Dished Section End  -->

        <!-- Custome Shape -->
        <div class="custom-shape shape1-color">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path
                    d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                    class="shape1-fill"></path>
            </svg>
        </div>

        <!-- Vendor Section Start  -->
        <?php include ROOT_DIR . 'pages/components/home/_vendors.php' ?>
        <!-- Vendor Section End  -->

        <!-- Custome Shape -->
        <div class="custom-shape shape2-color">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path
                    d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                    class="shape2-fill"></path>
            </svg>
        </div>

        <!-- About TiffinCraft Features Section Start -->
        <?php include ROOT_DIR . 'pages/components/home/_about.php' ?>
        <!-- About TiffinCraft Features Sectionn End -->

        <!-- Custome Shape -->
        <div class="custom-shape shape1-color">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path
                    d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                    class="shape1-fill"></path>
            </svg>
        </div>

        <!-- How It Works Section Start  -->
        <?php include ROOT_DIR . 'pages/components/home/_how.php' ?>
        <!-- How It Works Section Start  -->

    <?php else: ?>
        <!-- Become a Seller Section Start  -->
        <?php include ROOT_DIR . 'pages/components/home/_partner.php' ?>
        <!-- Become a Seller Section End  -->
    <?php endif ?>


    <!-- Custome Shape -->
    <div class="custom-shape <?= (strpos($currentPath, '/business') !== false) ? 'shape1-color' : 'shape2-color'; ?>">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path
                d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                class="shape1-fill"></path>
        </svg>
    </div>

    <?php include ROOT_DIR . 'pages/components/_footer.php'; ?>

    <!-- Custom JS  -->
    <script src="/assets/js/main.js" type="module"></script>

    <!-- Swiper Js  -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="/assets/js/swiper-init.js"></script>
</body>

</html>