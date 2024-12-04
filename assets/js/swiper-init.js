new Swiper(".swiper", {
  loop: true,
  // autoplay: {
  //   delay: 3000,
  //   disableOnInteraction: false,
  // },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  slidesPerView: 1, // Default for very small screens
  slidesPerGroup: 1,
  spaceBetween: 20, // Space between slides
  breakpoints: {
    640: {
      slidesPerView: 1,
      slidesPerGroup: 1,
    },
    768: {
      slidesPerView: 2,
      slidesPerGroup: 2,
    },
    1024: {
      slidesPerView: 3,
      slidesPerGroup: 3,
    },
    1280: {
      slidesPerView: 4,
      slidesPerGroup: 4,
    },
  },
});
