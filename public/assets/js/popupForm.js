const openLoginBtn = document.querySelector(".open-login-btn");
const loginPopup = document.querySelector(".login-popup");
const closePopupBtn = document.querySelector(".close-popup-btn");

// Open login popup
openLoginBtn.addEventListener("click", () => {
  loginPopup.classList.remove("hidden");
});

// Close login popup
closePopupBtn.addEventListener("click", () => {
  loginPopup.classList.add("hidden");
});

// Close popup when clicking outside the form
loginPopup.addEventListener("click", (event) => {
  if (event.target === loginPopup) {
    loginPopup.classList.add("hidden");
  }
});
