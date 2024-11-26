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
