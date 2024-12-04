<!-- <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
  </head>
  <body></body>
</html> -->


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
  <title>Swiper Slider</title>
  <style>
    .container {
      width: 80%;
      margin: auto;
      padding: 2rem 0;
    }

    /* .swiper-slide {
      display: flex;
      align-items: center;
      justify-content: center;
      background: #eee;
      border-radius: 8px;
      text-align: center;
      font-size: 1.2rem;
    } */

    .swiper {
      width: 100%;
      /* Full width */
      max-width: 1200px;
      /* Optional: limit the width */
      margin: 0 auto;
      /* Center the slider */
    }

    .swiper-slide {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      width: 250px;
    }

    .swiper-slide img {
      width: inherit;
    }
  </style>
</head>

<body>
  <section class="vendors-section">
    <div class="container">
      <!-- Swiper Slider -->
      <div class="swiper">
        <div class="swiper-wrapper">
          <!-- Slides -->
          <div class="swiper-slide">
            <img src="./assets/images/hero.jpeg" alt="Slide 1">
            <p class="card-title">This is slider title 1</p>
          </div>
          <div class="swiper-slide">
            <img src="./assets/images/hero.jpeg" alt="Slide 2">
            <p class="card-title">This is slider title 2</p>
          </div>
          <div class="swiper-slide">
            <img src="./assets/images/hero.jpeg" alt="Slide 3">
            <p class="card-title">This is slider title 3</p>
          </div>
          <div class="swiper-slide">
            <img src="./assets/images/hero.jpeg" alt="Slide 3">
            <p class="card-title">This is slider title 3</p>
          </div>
          <div class="swiper-slide">
            <img src="./assets/images/hero.jpeg" alt="Slide 3">
            <p class="card-title">This is slider title 3</p>
          </div>
          <div class="swiper-slide">
            <img src="./assets/images/hero.jpeg" alt="Slide 3">
            <p class="card-title">This is slider title 3</p>
          </div>
        </div>

      </div>
      <!-- Pagination -->
      <div class="swiper-pagination"></div>
      <!-- Navigation -->
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <!-- <script>
    const swiper = new Swiper('.swiper', {
      loop: true,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
  </script> -->
  <script src="./assets/js/script.js"></script>
  <script src="./assets/js/swiper-init.js"></script>

</body>

</html>