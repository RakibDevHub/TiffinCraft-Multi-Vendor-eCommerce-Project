import { handleBusinessLink } from "./_businessLink.js";
import { initActiveLinks } from "./_activeLinks.js";
import { toggleMenu, toggleLinks } from "./_toggle.js";

document.addEventListener("DOMContentLoaded", () => {
  const businessLink = document.querySelector(".business-link");
  const closeBtn = document.querySelector(".close-btn");
  const navContainer = document.querySelector(".nav-container");
  const menuBar = document.getElementById("menu-bar");
  const navLinksElement = document.querySelector(".nav-links");
  const loggedInLinks = document.querySelectorAll(".logged-in");
  const loggedOutLinks = document.querySelectorAll(".logged-out");

  const linkGroup = [
    document.querySelectorAll(".nav-links li a"),
    document.querySelectorAll(".quick-links a"),
    document.querySelectorAll(".business a"),
  ];

  // Initialize business link
  const { closeBusinessLink } = handleBusinessLink(businessLink, navContainer);
  if (closeBtn) {
    closeBtn.addEventListener("click", closeBusinessLink);
  }

  // Initialize active links
  initActiveLinks(linkGroup, businessLink);

  // Initialize mobile menu toggle
  toggleMenu(menuBar, navLinksElement);

  // Toggle login/logout links
  toggleLinks(loggedInLinks, loggedOutLinks, App.userLoggedIn);
});
