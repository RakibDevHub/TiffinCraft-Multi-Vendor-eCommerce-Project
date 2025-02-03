class Modal {
  constructor(modalId) {
    this.modal = document.getElementById(modalId);
    this.closeButton = this.modal.querySelector(".close");
    this.init();
  }

  init() {
    this.closeButton.addEventListener("click", () => this.hide());
    window.addEventListener("click", (e) => {
      if (e.target === this.modal) {
        this.hide();
      }
    });
  }

  show() {
    this.modal.style.display = "flex";
  }

  hide() {
    this.modal.style.display = "none";
  }
}
