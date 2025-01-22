function handleMenubar() {
  let menu = document.querySelector("#menu-bar");
  let navbar = document.querySelector(".nav-links");

  if (menu && navbar) {
    // Check if both elements exist
    menu.addEventListener("click", () => {
      menu.classList.toggle("fa-times");
      navbar.classList.toggle("active");
    });
  }
}

const path = window.location.pathname;
if (path !== "/business") {
  handleMenubar();
}
