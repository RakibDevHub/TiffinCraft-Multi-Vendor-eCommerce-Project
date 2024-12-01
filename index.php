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
    "to" => "#vendor",
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

  <!-- Custom CSS -->
  <link rel="stylesheet" href="./assets/css/style.css" />

  <!-- Custom JS -->
  <script src="./assets/js/script.js" defer></script>

  <!-- Swiper Slider CDN  -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <!-- <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js" defer></script> -->

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
      <li class="logged-out nav-btn"><a href="./register.php">Sign In</a></li>
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
  <section class="features-section" id="what">
    <div class="features-heading">
      <h1 class="title">Discover TiffinCraft</h1>
      <h4 class="sub-title">Where Every Meal is a Masterpiece</h4>
      <p>
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
  <section class="how-section" id="how">
    <div class="how-heading">
      <h1 class="title">Discover TiffinCraft</h1>
      <p class="sub-title">Where Every Meal is a Masterpiece</p>
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
            Communicate with the vendor to design your ideal meal plan. You can tailor it to your preferences and needs.
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
  <section class="how-section partner" id="partner">
    <div class="how-heading">
      <h1 class="title">Partner with TiffinCraft</h1>
      <p class="sub-title">Share your culinary talent, reach more customers, and grow your
        business effortlessly. Signing up is quick and easy!</p>
    </div>

    <div class="steps-container">
      <!-- Step 1 -->
      <div class="step reverse">
        <div class="step-image-wrapper">
          <img src="./assets/images/step_11.png" alt="Step 1: A person holding a phone" class="step-image" />
        </div>
        <div class="step-text">
          <span class="step-number orange">01</span>
          <h1 class="step-title">Regrister as a Seller</h1>
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


  <!-- Slider  -->
  <!-- Slider main container -->
  <div class="swiper">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
      <!-- Slides -->
      <div class="swiper-slide">Slide 1</div>
      <div class="swiper-slide">Slide 2</div>
      <div class="swiper-slide">Slide 3</div>
      ...
    </div>
    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>

    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>

    <!-- If we need scrollbar -->
    <div class="swiper-scrollbar"></div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js" defer></script>

</body>

</html>