// Menu button toggle
function handleMenubar() {
  let menu = document.querySelector("#menu-bar");
  let navbar = document.querySelector(".nav-links");

  menu.addEventListener("click", () => {
    menu.classList.toggle("fa-times");
    navbar.classList.toggle("active");
  });
}

// Detect current path and call the appropriate function
const path = window.location.pathname;
if (path !== "/business") {
  handleMenubar();
}
