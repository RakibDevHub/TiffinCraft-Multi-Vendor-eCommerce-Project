const loggedInLinks = document.querySelectorAll(".logged-in");
const loggedOutLinks = document.querySelectorAll(".logged-out");

function toggleLinks(loggedIn) {
  loggedInLinks.forEach((link) => link.classList.toggle("hidden", !loggedIn));
  loggedOutLinks.forEach((link) => link.classList.toggle("hidden", loggedIn));
}

// Dynamically toggle links based on user login status
toggleLinks(userLoggedIn);
