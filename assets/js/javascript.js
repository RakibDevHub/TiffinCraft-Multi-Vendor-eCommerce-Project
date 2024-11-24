// navigation links toggle start

const userLoggedIn = false;

const loggedInLinks = document.querySelectorAll(".logged-in");
const loggedOutLinks = document.querySelectorAll(".logged-out");

function toggleLinks(loggedIn) {
  loggedInLinks.forEach((link) => link.classList.toggle("hidden", !loggedIn));
  loggedOutLinks.forEach((link) => link.classList.toggle("hidden", loggedIn));
}

toggleLinks(userLoggedIn);

// navigation links toggle end
