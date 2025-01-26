const fileInput = document.querySelector(".hidden-input");
const chooseFileBtn = document.querySelector(".choose-file-btn");
const previewContainer = document.querySelector(".preview-container");
const imagePreview = document.getElementById("image-preview");
const removeBtn = document.querySelector(".remove-btn");

// Show file dialog when "Choose File" button is clicked
chooseFileBtn.addEventListener("click", () => {
  fileInput.click();
});

// Display image preview when file is selected
fileInput.addEventListener("change", () => {
  const file = fileInput.files[0];
  if (file) {
    const reader = new FileReader();

    reader.onload = () => {
      imagePreview.src = reader.result;
      previewContainer.classList.remove("hidden");
    };

    reader.readAsDataURL(file);
  }
});

// Remove image preview and clear input when "X" button is clicked
removeBtn.addEventListener("click", () => {
  fileInput.value = ""; // Clear the file input
  previewContainer.classList.add("hidden");
  imagePreview.src = ""; // Remove the preview image
});
