document.addEventListener("DOMContentLoaded", () => {
  function handleBusinessSignupLink() {
    const businessLink = document.querySelector(".business-link");
    const closeBtn = document.querySelector(".close-btn");
    const navContainer = document.querySelector(".nav-container");

    let isClosed = false;

    function adjustPosition() {
      if (businessLink && navContainer) {
        const businessLinkHeight = businessLink.offsetHeight;
        navContainer.style.top = businessLinkHeight + "px";
      }
    }

    if (businessLink && businessLink.classList.contains("show")) {
      adjustPosition();
    } else if (navContainer) {
      navContainer.style.top = "0";
    }

    window.addEventListener("resize", () => {
      if (businessLink && businessLink.classList.contains("show")) {
        adjustPosition();
      }
    });

    window.addEventListener("scroll", () => {
      if (!isClosed && window.scrollY > window.innerHeight - 60) {
        businessLink?.classList.add("show");
        adjustPosition();
      } else {
        businessLink?.classList.remove("show");
        if (navContainer) {
          navContainer.style.top = "0";
        }
      }
    });

    if (closeBtn) {
      closeBtn.addEventListener("click", () => {
        isClosed = true;
        businessLink?.classList.remove("show");
        if (navContainer) {
          navContainer.style.top = "0";
        }
      });
    }
  }

  const currentPath = window.location.pathname;
  if (currentPath === "/") {
    handleBusinessSignupLink();
  }
});
