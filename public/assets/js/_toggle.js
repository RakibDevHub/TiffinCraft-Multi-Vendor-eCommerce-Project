export function toggleMenu(menuBar, navLinksElement) {
  if (menuBar && navLinksElement) {
    menuBar.addEventListener("click", () => {
      menuBar.classList.toggle("fa-times");
      navLinksElement.classList.toggle("active");
    });
  }
}

export function toggleLinks(loggedInLinks, loggedOutLinks, userLoggedIn) {
  loggedInLinks.forEach((link) =>
    link.classList.toggle("hidden", !userLoggedIn)
  );
  loggedOutLinks.forEach((link) =>
    link.classList.toggle("hidden", userLoggedIn)
  );
}
