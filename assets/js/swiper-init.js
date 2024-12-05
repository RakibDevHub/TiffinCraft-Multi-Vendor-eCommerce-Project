new Swiper(".vendor-slider-popular", {
  loop: true,
  pagination: {
    el: ".vendor-slider-popular-pagination",
    clickable: true,
  },
  navigation: {
    nextEl: ".vendor-slider-popular-next",
    prevEl: ".vendor-slider-popular-prev",
  },
  slidesPerView: 1,
  slidesPerGroup: 1,
  spaceBetween: 20,
  breakpoints: {
    640: {
      slidesPerView: 1,
    },
    768: {
      slidesPerView: 2,
    },
    1024: {
      slidesPerView: 3,
    },
    1280: {
      slidesPerView: 4,
    },
  },
});

new Swiper(".vendor-slider-new", {
  loop: true,
  pagination: {
    el: ".vendor-slider-new-pagination",
    clickable: true,
  },
  navigation: {
    nextEl: ".vendor-slider-new-next",
    prevEl: ".vendor-slider-new-prev",
  },
  slidesPerView: 1,
  slidesPerGroup: 1,
  spaceBetween: 20,
  breakpoints: {
    640: {
      slidesPerView: 1,
    },
    768: {
      slidesPerView: 2,
    },
    1024: {
      slidesPerView: 3,
    },
    1280: {
      slidesPerView: 4,
    },
  },
});
