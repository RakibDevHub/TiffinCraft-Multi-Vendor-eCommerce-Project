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

  <title>TiffinCraft</title>
</head>

<body>
  <!-- Header Section Start -->
  <header>
    <img class="logo" src="./assets/images/TiffinCraft.png" alt="TiffinCraft Logo" />
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
  </section>
  <!-- Hero Section End -->

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
</body>

</html>