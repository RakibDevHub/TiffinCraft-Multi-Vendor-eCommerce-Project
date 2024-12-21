// Menu button toggle
let menu = document.querySelector("#menu-bar");
let navbar = document.querySelector(".nav-links");

menu.addEventListener("click", () => {
  menu.classList.toggle("fa-times");
  navbar.classList.toggle("active");
});
