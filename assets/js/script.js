// Toggle navigation links visibility based on login status
const userLoggedIn = false;

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
    console.log("remove");
  } else {
    vendorFields.classList.add("hidden");
    console.log("add");
  }
});
