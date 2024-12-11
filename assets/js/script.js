const businessLink = document.querySelector(".business-link");
const closeBtn = document.querySelector(".close-btn");

// Track the "closed" state
let isClosed = false;

// Scroll event listener
window.addEventListener("scroll", () => {
  if (!isClosed && window.scrollY > window.innerHeight - 60) {
    businessLink.classList.add("show");
  } else {
    businessLink.classList.remove("show");
  }
});

// Close button event listener
closeBtn.addEventListener("click", () => {
  isClosed = true; // Set closed state to true
  businessLink.classList.remove("show");
});

// Toggle navigation links visibility based on login status
const userLoggedIn = true;

const loggedInLinks = document.querySelectorAll(".logged-in");
const loggedOutLinks = document.querySelectorAll(".logged-out");

function toggleLinks(loggedIn) {
  loggedInLinks.forEach((link) => link.classList.toggle("hidden", !loggedIn));
  loggedOutLinks.forEach((link) => link.classList.toggle("hidden", loggedIn));
}

toggleLinks(userLoggedIn);

// Menu button toggle
let menu = document.querySelector("#menu-bar");
let navbar = document.querySelector(".nav-links");

menu.addEventListener("click", () => {
  menu.classList.toggle("fa-times");
  navbar.classList.toggle("active");
});

// Show/Hide Vendor-Specific Fields
const userType = document.querySelector("#user-type");
const vendorFields = document.querySelector("#vendor-fields");

userType.addEventListener("change", () => {
  if (userType.value === "vendor") {
    vendorFields.classList.remove("hidden");
  } else {
    vendorFields.classList.add("hidden");
  }
});
