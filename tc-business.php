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

  <title>TiffinCraft Business</title>
</head>

<body>
  <!-- Header Section Start -->
  <header class="header-section">
    <nav class="nav-container">
      <a href="./tc-business.php" class="nav-logo">
        <img src="./assets/images/logo.png" class="logo-mini" alt="TiffinCraft Logo" />
        <span>TiffinCraft-Business</span>
      </a>
      <div class="nav-buttons">
        <li class="logged-out nav-btn"><a class="fill" href="./tc-business.php#login">Sign In</a></li>
        <!-- <i class="fa-solid fa-bars" id="menu-bar"></i> -->
      </div>
    </nav>
  </header>
  <!-- Header Section End -->

  <!-- Hero Section Start -->
  <section class="tc-business home" id="#home">
    <!-- Dark Overlay  -->
    <div class="overlay"></div>
    <div class="hero">
      <div class="hero-txt">
        <h1 class="title">Partner with TiffinCraft</h1>
        <div class="hero-buttons">
          <a class="outline" href="./tc-business.php#how">How It Works!<i class="fa-solid fa-arrow-right"></i></a>
          <a class="fill" href="./tc-business.php#form">Regrister Now</a>
        </div>
      </div>
    </div>
  </section>
  <!-- Hero Section End -->

  <!-- Custom Shape  -->
  <div class="spacer layer"></div>

  <!-- Become a Seller Section Start  -->
  <section class="section partner" id="how">
    <div class="section-heading">
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


  <!-- Register Form Start -->
  <section class="form-container tc-business-form" id="form">
    <div class="business-form-container">
      <form class="auth-form">
        <h2>Register Now</h2>
        <div class="form-header">
          <p class="switch-auth">Fill up the form below.</a></p>
          <button type="submit" class="btn">Submit Request</button>
        </div>
        <div class="f-grid">
          <div class="form-group">
            <label for="fname">First Name</label>
            <input type="text" id="fname" name="fname" placeholder="Enter your first name" required>
          </div>
          <div class="form-group">
            <label for="lname">Last Name</label>
            <input type="text" id="lname" name="lname" placeholder="Enter your Last name" required>
          </div>
          <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="Enter your email address" required>
          </div>
          <div class="form-group">
            <label for="number">Phone Number</label>
            <input type="text" id="number" name="number" placeholder="Enter your phone number" required>
          </div>
          <div class="form-group">
            <label for="outlet">Outlet Name</label>
            <input type="text" id="outlet" name="outlet" placeholder="Enter your outlet name" required>
          </div>
          <div class="form-group">
            <label for="outlet-address">Outlet Address</label>
            <input type="text" id="outlet-address" name="outlet-address" placeholder="Enter your outlet address"
              required>
          </div>
          <div class="form-group">
            <label for="image">Outlet Image</label>
            <div style="display: flex">
              <button class="btn choose-file-btn" type="button">+ Choose File</button>
            </div>
            <input type="file" id="image" name="image" class="hidden-input" accept="image/*">
            <div class="preview-container hidden">
              <img id="image-preview" alt="Preview" />
              <button class="remove-btn" type="button">X</button>
            </div>
          </div>
        </div>
        <!-- <div style="display: flex; justify-content: center;">
          <button type="submit" class="btn">Submit Request</button>
        </div> -->
      </form>
    </div>
  </section>
  <!-- Register Form End -->

  <!-- Custom CSS  -->
  <script src="./assets/js/main.js" type="module"></script>
</body>

</html>