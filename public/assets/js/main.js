import { handleBusinessLink } from "./_businessLink.js";
import {
  initActiveNavLinks,
  initActiveFooterLinks,
  initPageLinks,
} from "./_manageLinks.js";
import { toggleMenu, toggleLinks } from "./_toggle.js";
import { initRatingSystem } from "./_interactions.js";
import { initFilePreview } from "./_imageUpload.js";

document.addEventListener("DOMContentLoaded", () => {
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
  const stars = document.querySelectorAll(".slider-icons span:first-child i");
  const heart = document.querySelectorAll(".slider-icons span:last-child i");
  // initRatingSystem(stars, heart);
  initRatingSystem();

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
});
