<?php $features = [
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

$herolinks = [
  [
    "name" => "About TiffinCraft",
    "to" => "#what",
  ],
  [
    "name" => "How It Works",
    "to" => "#how",
  ],
  [
    "name" => "Meet The Vendors",
    "to" => "#vendors",
  ],
  [
    "name" => "Delicious Dishes",
    "to" => "#dishes",
  ],
  [
    "name" => "Become a Seller",
    "to" => "#partner",
  ],
];

$itemSlider = [
  [
    "itemImage" => "./assets/images/hero.jpeg",
    "itemName" => "Bhuna Khichuri",
    "itemDetails" => "You may combine any of the options above.",
    "itemPrice" => "80",
    "itemOffer" => "20",
    "itemRating" => "No Rating Yet",
    "itemVendor" => "Kamal Kitchen",
  ],
  [
    "itemImage" => "./assets/images/hero.jpeg",
    "itemName" => "Bhuna Khichuri",
    "itemDetails" => "You may combine any of the options above.",
    "itemPrice" => "80",
    "itemOffer" => "20",
    "itemRating" => "No Rating Yet",
    "itemVendor" => "Kamal Kitchen",
  ],
  [
    "itemImage" => "./assets/images/hero.jpeg",
    "itemName" => "Bhuna Khichuri",
    "itemDetails" => "You may combine any of the options above.",
    "itemPrice" => "80",
    "itemOffer" => "20",
    "itemRating" => "No Rating Yet",
    "itemVendor" => "Kamal Kitchen",
  ],
  [
    "itemImage" => "./assets/images/hero.jpeg",
    "itemName" => "Bhuna Khichuri",
    "itemDetails" => "You may combine any of the options above.",
    "itemPrice" => "80",
    "itemOffer" => "20",
    "itemRating" => "No Rating Yet",
    "itemVendor" => "Kamal Kitchen",
  ],
  [
    "itemImage" => "./assets/images/hero.jpeg",
    "itemName" => "Bhuna Khichuri",
    "itemDetails" => "You may combine any of the options above.",
    "itemPrice" => "80",
    "itemOffer" => "20",
    "itemRating" => "No Rating Yet",
    "itemVendor" => "Kamal Kitchen",
  ],
  [
    "itemImage" => "./assets/images/hero.jpeg",
    "itemName" => "Bhuna Khichuri",
    "itemDetails" => "You may combine any of the options above.",
    "itemPrice" => "80",
    "itemOffer" => "20",
    "itemRating" => "No Rating Yet",
    "itemVendor" => "Kamal Kitchen",
  ],
  [
    "itemImage" => "./assets/images/hero.jpeg",
    "itemName" => "Bhuna Khichuri",
    "itemDetails" => "You may combine any of the options above.",
    "itemPrice" => "80",
    "itemOffer" => "20",
    "itemRating" => "No Rating Yet",
    "itemVendor" => "Kamal Kitchen",
  ],
  [
    "itemImage" => "./assets/images/hero.jpeg",
    "itemName" => "Bhuna Khichuri",
    "itemDetails" => "You may combine any of the options above.",
    "itemPrice" => "80",
    "itemOffer" => "20",
    "itemRating" => "No Rating Yet",
    "itemVendor" => "Kamal Kitchen",
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

  <!-- Font Awesome CDN  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
    integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Swiper Slider CSS  -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
  <link rel="stylesheet" href="./assets/css/swiper-init.css" />


  <!-- Custom CSS -->
  <link rel="stylesheet" href="./assets/css/style.css" />

  <title>TiffinCraft</title>
</head>

<body>
  <!-- Header Section Start -->
  <header class="header-section">
    <a href="./index.php" class="logo-link">
      <img class="logo" src="./assets/images/TiffinCraft.png" alt="TiffinCraft Logo" />
    </a>
    <nav class="navbar">
      <ul class="nav-links">
        <li><a href="./index.php">Home</a></li>
        <li><a href="./vendors.php">Browse Vendors</a></li>
        <li><a href="./dishes.php">Browse Dishes</a></li>
      </ul>
    </nav>
    <div class="nav-buttons">
      <li class="logged-out nav-btn"><a href="./login.php">Sign In</a></li>
      <li class="logged-in"><i class="fa-solid fa-heart"></i></li>
      <li class="logged-in"><i class="fa-solid fa-cart-shopping"></i></li>
      <li class="logged-in"><i class="fa-solid fa-user"></i></li>
      <i class="fa-solid fa-bars" id="menu-bar"></i>
    </div>
  </header>
  <!-- Header Section End -->

  <!-- Hero Section Start -->
  <section class="home" id="#home">
    <!-- Dark Overlay  -->
    <div class="overlay"></div>
    <div class="hero">
      <div class="hero-txt">
        <h1>Hungry!</h1>
        <p>What are you waiting for!</p>
        <a href="#">Order Now <i class="fa-brands fa-opencart"></i></a>
      </div>
      <nav class="hero-nav" aria-label="Hero Nav">
        <ul>
          <?php
          foreach ($herolinks as $link) {
            echo '<li><a href="' . htmlspecialchars($link['to']) . '">' . htmlspecialchars($link['name']) . '</a></li>';
          }
          ?>
        </ul>
      </nav>
    </div>
    <div class="spacer layer top"></div>
    <div class="spacer layer"></div>
  </section>
  <!-- Hero Section End -->

  <!-- About TiffinCraft Features Section Start -->
  <section class="section features" id="what">
    <div class="section-heading">
      <h1 class="title">Discover TiffinCraft</h1>
      <h3 class="sub-title">Where Every Meal is a Masterpiece</h3>
      <p class="text">
        Welcome to <span>TiffinCraft</span>, the ultimate destination for
        homemade food enthusiasts and culinary experts alike. Whether you’re a
        passionate home cook eager to share your creations or someone seeking
        the comfort of authentic home-cooked meals,
        <span>TiffinCraft</span> brings together food lovers from all walks of
        life to celebrate the art of cooking and sharing
      </p>
    </div>
    <div class="features-container">
      <?php
      foreach ($features as $feature) {
        echo '<div class="features-content">';
        echo '<i class="' . htmlspecialchars($feature['icon']) . '"></i>';
        echo '<h2>' . htmlspecialchars($feature['title']) . '</h2>';
        echo '<p>' . htmlspecialchars($feature['description']) . '</i>';
        echo '</div>';
      }
      ?>
    </div>
  </section>
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
  <section class="section how" id="how">
    <div class="section-heading">
      <h1 class="title">Discover TiffinCraft</h1>
      <h3 class="sub-title">Where Every Meal is a Masterpiece</h3>
    </div>

    <div class="steps-container">
      <!-- Step 1 -->
      <div class="step">
        <div class="step-text">
          <span class="step-number orange">01</span>
          <h1 class="step-title">Find Your Vendor</h1>
          <p class="step-description">
            Browse through our trusted vendors and pick the one that matches your requirements. It's easy to
            <a href="/register" class="link">sign up</a> and create your account.
          </p>
        </div>
        <div class="step-image-wrapper">
          <div class="circle orange large"></div>
          <div class="circle orange small"></div>
          <img src="./assets/images/step_1.png" alt="Step 1: A person holding a phone" class="step-image" />
        </div>
      </div>

      <!-- Step 2 -->
      <div class="step reverse">
        <div class="step-image-wrapper">
          <div class="rotated-box green large"></div>
          <div class="rotated-box green small"></div>
          <img src="./assets/images/step_2.png" alt="Step 2: A person talking on the phone with the vendors"
            class="step-image" />
        </div>
        <div class="step-text">
          <span class="step-number green">02</span>
          <h1 class="step-title">Customize Your Plan</h1>
          <p class="step-description">
            Communicate with the vendor to design your ideal meal plan. You can tailor it to your preferences and
            needs.
          </p>
        </div>
      </div>

      <!-- Step 3 -->
      <div class="step">
        <div class="step-text">
          <span class="step-number blue">03</span>
          <h1 class="step-title">Enjoy Hassle-Free Meals</h1>
          <p class="step-description">
            Sit back and enjoy your meal deliveries—freshly prepared and delivered right to your doorstep.
          </p>
        </div>
        <div class="step-image-wrapper">
          <!-- <div class="skewed-box green large"></div>
          <div class="skewed-box green small"></div> -->
          <img src="./assets/images/step3.png" alt="Step 3: A person delivering food to the customer"
            class="step-image" />
        </div>
      </div>
    </div>

  </section>
  <!-- How It Works Section End  -->

  <!-- Custome Shape -->
  <div class="custom-shape shape2-color">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
      <path
        d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
        class="shape2-fill"></path>
    </svg>
  </div>

  <!-- Become a Seller Section Start  -->
  <section class="section partner" id="partner">
    <div class="section-heading">
      <h1 class="title">Partner with TiffinCraft</h1>
      <h3 class="sub-title">Share your culinary talent, reach more customers, and grow your
        business effortlessly. Signing up is quick and easy!</h3>
    </div>

    <div class="steps-container">
      <!-- Step 1 -->
      <div class="step reverse">
        <div class="step-image-wrapper">
          <img src="./assets/images/step_11.png" alt="Step 1: A person holding a phone" class="step-image" />
        </div>
        <div class="step-text">
          <span class="step-number orange">01</span>
          <h1 class="step-title">Register as a Seller</h1>
          <p class="step-description">
            Step into a world of endless opportunities. Become part of our
            thriving community of home chefs and turn your passion for
            cooking into a rewarding journey.
          </p>
        </div>
      </div>

      <!-- Step 2 -->
      <div class="step">
        <div class="step-text">
          <span class="step-number green">02</span>
          <h1 class="step-title">List Your Dishes</h1>
          <p class="step-description">
            Share your culinary masterpieces with the world. Create a
            personalized menu, set your prices, and make your mark with your
            signature dishes.
          </p>
        </div>
        <div class="step-image-wrapper">
          <img src="./assets/images/step_22.png" alt="Step 2: A person talking on the phone with the vendors"
            class="step-image" />
        </div>
      </div>

      <!-- Step 3 -->
      <div class="step reverse">
        <div class="step-image-wrapper">
          <img src="./assets/images/step_33.png" alt="Step 3: A person delivering food to the customer"
            class="step-image" />
        </div>
        <div class="step-text">
          <span class="step-number red">03</span>
          <h1 class="step-title">Connect with Customers</h1>
          <p class="step-description">
            Build lasting connections with food lovers who appreciate the
            magic of home-cooked meals. Inspire their taste buds with every
            bite.
          </p>
        </div>
      </div>

      <!-- Step 4 -->
      <div class="step">
        <div class="step-text">
          <span class="step-number blue">04</span>
          <h1 class="step-title">Get Paid</h1>
          <p class="step-description">
            Enjoy a seamless payment experience while you focus on
            delighting your customers with exceptional meals.
          </p>
        </div>
        <div class="step-image-wrapper">
          <img src="./assets/images/step_44.webp" alt="Step 2: A person talking on the phone with the vendors"
            class="step-image" />
        </div>
      </div>
    </div>
  </section>
  <!-- Become a Seller Section End  -->

  <!-- <?php
  // foreach ($itemSlider as $slider) {
  //   echo '<li class="card-item">';
  //   echo '<a class="' . htmlspecialchars($slider['icon']) . '"></i>';
  //   echo '<h2>' . htmlspecialchars($slider['title']) . '</h2>';
  //   echo '<p>' . htmlspecialchars($slider['description']) . '</i>';
  //   echo '</li>';
  // }
  ?> -->

  <!-- Custome Shape -->
  <div class="custom-shape shape1-color">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
      <path
        d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
        class="shape1-fill"></path>
    </svg>
  </div>

  <section class="section vendors" id="vendors">
    <div class="section-heading">
      <h1 class="title">Meet Our Vendors</h1>
      <h3 class="sub-title">Connecting You with Passionate Home Chefs</h3>
    </div>

    <div class="container popular">
      <div class="container-header">
        <h2>Popular Vendors</h2>
        <a href="#">Browse More</a>
      </div>
      <!-- Swiper Slider -->
      <div class="swiper vendor-slider-popular">
        <div class="swiper-wrapper">
          <!-- Slides -->
          <div class="swiper-slide">
            <img src="./assets/images/hero.jpeg" alt="Slide 1">
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
            <img src="./assets/images/hero.jpeg" alt="Slide 1">
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
            <img src="./assets/images/hero.jpeg" alt="Slide 1">
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
            <img src="./assets/images/hero.jpeg" alt="Slide 1">
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
            <img src="./assets/images/hero.jpeg" alt="Slide 1">
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
            <img src="./assets/images/hero.jpeg" alt="Slide 1">
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
            <img src="./assets/images/hero.jpeg" alt="Slide 1">
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

    <div class="container new">
      <div class="container-header">
        <h2>New Vendors</h2>
        <a href="#">Browse More</a>
      </div>
      <!-- Swiper Slider -->
      <div class="swiper vendor-slider-new">
        <div class="swiper-wrapper">
          <!-- Slides -->
          <div class="swiper-slide">
            <img src="./assets/images/hero.jpeg" alt="Slide 1">
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
            <img src="./assets/images/hero.jpeg" alt="Slide 1">
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
            <img src="./assets/images/hero.jpeg" alt="Slide 1">
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
            <img src="./assets/images/hero.jpeg" alt="Slide 1">
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
            <img src="./assets/images/hero.jpeg" alt="Slide 1">
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
            <img src="./assets/images/hero.jpeg" alt="Slide 1">
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
            <img src="./assets/images/hero.jpeg" alt="Slide 1">
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
      </div>
      <!-- Pagination -->
      <div class="swiper-buttons">
        <!-- Navigation -->
        <div class="swiper-button-prev vendor-slider-new-prev"></div>
        <div class="swiper-pagination vendor-slider-new-pagination"></div>
        <div class="swiper-button-next vendor-slider-new-next"></div>
      </div>
    </div>
  </section>

  <!-- Custome Shape -->
  <div class="custom-shape shape2-color">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
      <path
        d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
        class="shape2-fill"></path>
    </svg>
  </div>

  <section class="section dishes" id="dishes">
    <div class="section-heading">
      <h1 class="title">Discover Delicious Creations</h1>
      <h3 class="sub-title">Every Dish Tells a Story</h3>
    </div>

    <div class="container popular">
      <div class="container-header">
        <h2>Popular Dishes</h2>
        <a href="#">Browse More</a>
      </div>
      <!-- Swiper Slider -->
      <div class="swiper dishes-slider-popular">
        <div class="swiper-wrapper">
          <!-- Slides -->
          <div class="swiper-slide">
            <img src="./assets/images/hero.jpeg" alt="Slide 1">
            <div class="slide-top">
              <span class="discount"> 20% OFF
                <!-- <i class="fa-regular fa-star"></i>
                <i class="fa-regular fa-star"></i>
                <i class="fa-regular fa-star"></i>
                <i class="fa-regular fa-star"></i>
                <i class="fa-regular fa-star"></i> -->
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
            <img src="./assets/images/hero.jpeg" alt="Slide 1">
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
            <img src="./assets/images/hero.jpeg" alt="Slide 1">
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
            <img src="./assets/images/hero.jpeg" alt="Slide 1">
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
            <img src="./assets/images/hero.jpeg" alt="Slide 1">
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
            <img src="./assets/images/hero.jpeg" alt="Slide 1">
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
            <img src="./assets/images/hero.jpeg" alt="Slide 1">
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
      </div>
      <!-- Pagination -->
      <div class="swiper-buttons">
        <!-- Navigation -->
        <div class="swiper-button-prev dishes-slider-popular-prev"></div>
        <div class="swiper-pagination dishes-slider-popular-pagination"></div>
        <div class="swiper-button-next dishes-slider-popular-next"></div>

        <!-- <div class="swiper-button-next"></div> -->
      </div>
    </div>

    <div class="container home-made">
      <div class="container-header">
        <h2>Home-Made Dishes</h2>
        <a href="#">Browse More</a>
      </div>
      <!-- Swiper Slider -->
      <div class="swiper dishes-slider-home">
        <div class="swiper-wrapper">
          <!-- Slides -->
          <div class="swiper-slide">
            <img src="./assets/images/hero.jpeg" alt="Slide 1">
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
            <img src="./assets/images/hero.jpeg" alt="Slide 1">
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
            <img src="./assets/images/hero.jpeg" alt="Slide 1">
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
            <img src="./assets/images/hero.jpeg" alt="Slide 1">
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
            <img src="./assets/images/hero.jpeg" alt="Slide 1">
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
            <img src="./assets/images/hero.jpeg" alt="Slide 1">
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
            <img src="./assets/images/hero.jpeg" alt="Slide 1">
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
      </div>
      <!-- Pagination -->
      <div class="swiper-buttons">
        <!-- Navigation -->
        <div class="swiper-button-prev dishes-slider-home-prev"></div>
        <div class="swiper-pagination dishes-slider-home-pagination"></div>
        <div class="swiper-button-next dishes-slider-home-next"></div>
      </div>
    </div>

    <div class="container restaurant">
      <div class="container-header">
        <h2>Restaurant Dishes</h2>
        <a href="#">Browse More</a>
      </div>
      <!-- Swiper Slider -->
      <div class="swiper dishes-slider-restaurant">
        <div class="swiper-wrapper">
          <!-- Slides -->
          <div class="swiper-slide">
            <img src="./assets/images/hero.jpeg" alt="Slide 1">
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
            <img src="./assets/images/hero.jpeg" alt="Slide 1">
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
            <img src="./assets/images/hero.jpeg" alt="Slide 1">
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
            <img src="./assets/images/hero.jpeg" alt="Slide 1">
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
            <img src="./assets/images/hero.jpeg" alt="Slide 1">
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
            <img src="./assets/images/hero.jpeg" alt="Slide 1">
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
            <img src="./assets/images/hero.jpeg" alt="Slide 1">
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
      </div>
      <!-- Pagination -->
      <div class="swiper-buttons">
        <!-- Navigation -->
        <div class="swiper-button-prev dishes-slider-restaurant-prev"></div>
        <div class="swiper-pagination dishes-slider-restaurant-pagination"></div>
        <div class="swiper-button-next dishes-slider-restaurant-next"></div>
      </div>
    </div>
  </section>

  <!-- Custom JS  -->
  <script src="./assets/js/script.js"></script>

  <!-- Swiper Js  -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="./assets/js/swiper-init.js"></script>
</body>

</html>