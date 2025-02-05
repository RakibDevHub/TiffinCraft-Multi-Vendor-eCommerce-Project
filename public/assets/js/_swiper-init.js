function showLoading(selector) {
  const sliderContainer = document.querySelector(selector);
  if (sliderContainer) {
    sliderContainer.classList.add("loading");
    const spinner = document.createElement("div");
    spinner.classList.add("spinner");
    sliderContainer.appendChild(spinner);
  }
}

function hideLoading(selector) {
  const sliderContainer = document.querySelector(selector);
  if (sliderContainer) {
    sliderContainer.classList.remove("loading");
    const spinner = sliderContainer.querySelector(".spinner");
    if (spinner) spinner.remove();
  }
}

async function loadSwiperScript() {
  return new Promise((resolve, reject) => {
    if (typeof Swiper !== "undefined") {
      resolve();
      return;
    }

    const script = document.createElement("script");
    script.src = "https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js";
    script.onload = resolve;
    script.onerror = reject;
    document.head.appendChild(script);
  });
}

export async function initSwiper(selector, paginationEl, nextEl, prevEl) {
  showLoading(selector);

  try {
    await loadSwiperScript();
    if (typeof Swiper === "undefined") {
      throw new Error("Swiper is not available.");
    }

    new Swiper(selector, {
      loop: true,
      pagination: {
        el: paginationEl,
        clickable: true,
      },
      navigation: {
        nextEl: nextEl,
        prevEl: prevEl,
      },
      slidesPerView: 1,
      slidesPerGroup: 1,
      spaceBetween: 20,
      breakpoints: {
        640: {
          slidesPerView: 2,
          slidesPerGroup: 2,
        },
        768: {
          slidesPerView: 2,
          slidesPerGroup: 2,
        },
        1024: {
          slidesPerView: 3,
          slidesPerGroup: 3,
        },
      },
    });
  } catch (error) {
    console.error("Failed to load Swiper:", error);
  } finally {
    hideLoading(selector);
  }
}
