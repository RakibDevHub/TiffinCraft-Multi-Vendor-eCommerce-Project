// Exported function to initialize the rating system
export function initRatingSystem(container) {
  const stars = container.querySelectorAll(".slider-icons span:first-child i");
  const heart = container.querySelector(".slider-icons span:last-child i");

  // Handle star click for ratings
  stars.forEach((star) => {
    star.addEventListener("click", () => {
      const rating = star.dataset.value;

      // Clear previous selection
      stars.forEach((s) => s.classList.remove("selected"));

      // Highlight the selected stars
      stars.forEach((s) => {
        if (s.dataset.value <= rating) {
          s.classList.add("selected");
        }
      });

      console.log(
        `${
          container.querySelector(".slider-bottom h2").textContent
        } rated ${rating} stars`
      );
    });
  });

  // Handle heart click for like/favorite action
  if (heart) {
    heart.addEventListener("click", () => {
      heart.classList.toggle("liked");
      console.log(
        heart.classList.contains("liked")
          ? "Added to favorites"
          : "Removed from favorites"
      );
    });
  }
}
