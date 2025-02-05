import { handleBusinessLink } from "./_businessLink.js";
import {
  initActiveNavLinks,
  initActiveFooterLinks,
  initPageLinks,
} from "./_manageLinks.js";
import { toggleMenu, toggleLinks } from "./_toggle.js";
import { initRatingSystem } from "./_interactions.js";
import { initFilePreview } from "./_imageUpload.js";
import { initSwiper } from "./_swiper-init.js";

document.addEventListener("DOMContentLoaded", async () => {
  // Initialize business link
  const businessLink = document.querySelector(".business-link");
  const closeBtn = document.querySelector(".close-btn");
  const navContainer = document.querySelector(".nav-container");
  const { closeBusinessLink } = handleBusinessLink(businessLink, navContainer);
  if (closeBtn) {
    closeBtn.addEventListener("click", closeBusinessLink);
  }

  // Initialize links
  const navLinks = document.querySelectorAll(".nav-links a");
  initActiveNavLinks(navLinks, businessLink);

  const footerLinks = document.querySelectorAll(".footer-links a");
  initActiveFooterLinks(footerLinks);

  const pageLinks = document.querySelectorAll(".hero-buttons a");
  initPageLinks(pageLinks);

  // Initialize mobile menu toggle
  const menuBar = document.getElementById("menu-bar");
  const navLinksElement = document.querySelector(".nav-links");
  toggleMenu(menuBar, navLinksElement);

  // Toggle login/logout links
  const loggedInLinks = document.querySelectorAll(".logged-in");
  const loggedOutLinks = document.querySelectorAll(".logged-out");
  toggleLinks(loggedInLinks, loggedOutLinks, App.userLoggedIn);

  // Rating & Added to Fav
  const vendorCards = document.querySelectorAll(".swiper-slide");
  vendorCards.forEach((card) => {
    initRatingSystem(card);
  });

  // Initialize file preview only on /business/register path
  if (window.location.pathname === "/business/register") {
    const fileInput = document.querySelector(".hidden-input");
    const chooseFileBtn = document.querySelector(".choose-file-btn");
    const previewContainer = document.querySelector(".preview-container");
    const imagePreview = document.getElementById("image-preview");
    const removeBtn = document.querySelector(".remove-btn");

    if (
      fileInput &&
      chooseFileBtn &&
      previewContainer &&
      imagePreview &&
      removeBtn
    ) {
      initFilePreview(
        fileInput,
        chooseFileBtn,
        previewContainer,
        imagePreview,
        removeBtn
      );
    }
  }

  if (window.location.pathname === "/") {
    try {
      const sliderConfigs = [
        {
          selector: ".vendorSlider",
          pagination: ".vendorSlider-pagination",
          next: ".vendorSlider-next",
          prev: ".vendorSlider-prev",
        },
        {
          selector: ".dishes-slider-popular",
          pagination: ".dishes-slider-popular-pagination",
          next: ".dishes-slider-popular-next",
          prev: ".dishes-slider-popular-prev",
        },
        {
          selector: ".dishes-slider-home",
          pagination: ".dishes-slider-home-pagination",
          next: ".dishes-slider-home-next",
          prev: ".dishes-slider-home-prev",
        },
        {
          selector: ".dishes-slider-restaurant",
          pagination: ".dishes-slider-restaurant-pagination",
          next: ".dishes-slider-restaurant-next",
          prev: ".dishes-slider-restaurant-prev",
        },
      ];

      for (const { selector, pagination, next, prev } of sliderConfigs) {
        const sliderElement = document.querySelector(selector);
        if (sliderElement) {
          await initSwiper(selector, pagination, next, prev);
        }
      }
    } catch (error) {
      console.error("Initialization error:", error);
    }
  }
});
