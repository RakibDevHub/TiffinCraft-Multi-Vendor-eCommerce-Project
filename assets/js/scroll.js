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
if (closeBtn) {
  closeBtn.addEventListener("click", () => {
    isClosed = true; // Set closed state to true
    businessLink.classList.remove("show");
  });
}
