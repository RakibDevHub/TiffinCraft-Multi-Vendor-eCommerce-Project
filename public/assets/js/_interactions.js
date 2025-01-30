// export function initRatingSystem(stars, heart) {
export function initRatingSystem() {
  const stars = document.querySelectorAll(".slider-icons span:first-child i");
  const heart = document.querySelectorAll(".slider-icons span:last-child i");
  // Handle star click for ratings
  stars.forEach((star, index) => {
    star.addEventListener("click", () => {
      // Clear previous selection
      stars.forEach((s) => s.classList.remove("selected"));

      // Highlight the selected stars
      for (let i = 0; i <= index; i++) {
        stars[i].classList.add("selected");
      }

      console.log(`You rated this ${index + 1} stars`);
    });
  });

  // Handle heart click for like/favorite action
  //   if (heart) {
  heart.addEventListener("click", () => {
    heart.classList.toggle("liked");
    console.log(
      heart.classList.contains("liked")
        ? "Added to favorites"
        : "Removed from favorites"
    );
  });
  //   }
}
