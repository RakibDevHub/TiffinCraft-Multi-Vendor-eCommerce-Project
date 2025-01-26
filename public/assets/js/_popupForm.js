function handlePopup() {
  const editButton = document.getElementById("editButton");
  const editPopup = document.getElementById("editPopup");
  const closeEdit = document.getElementById("closeEdit");
  const passwordButton = document.getElementById("changePasswordButton");
  const passwordPopup = document.getElementById("passwordPopup");
  const closePassword = document.getElementById("closePassword");
  const deleteButton = document.getElementById("deleteButton");
  const deletePopup = document.getElementById("deletePopup");
  const cancelDelete = document.getElementById("cancelDelete");

  editButton.addEventListener("click", () => {
    editPopup.style.display = "flex";
  });

  closeEdit.addEventListener("click", () => {
    editPopup.style.display = "none";
  });

  passwordButton.addEventListener("click", () => {
    passwordPopup.style.display = "flex";
  });

  closePassword.addEventListener("click", () => {
    passwordPopup.style.display = "none";
  });

  deleteButton.addEventListener("click", () => {
    deletePopup.style.display = "flex";
  });

  cancelDelete.addEventListener("click", () => {
    deletePopup.style.display = "none";
  });

  window.addEventListener("click", (event) => {
    if (event.target == editPopup) {
      editPopup.style.display = "none";
    }
    if (event.target == passwordPopup) {
      passwordPopup.style.display = "none";
    }
    if (event.target == deletePopup) {
      deletePopup.style.display = "none";
    }
  });
}

const path = window.location.pathname;
if (path === "/profile") {
  handlePopup();
}
