document.addEventListener("DOMContentLoaded", () => {
  function handleHomePageBusinessLink() {
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

    // Initial check and position adjustment
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

  // function scrollToSection() {
  //   const pathParts = window.location.pathname.split("/");
  //   const section = pathParts[pathParts.length - 1];

  //   if (section && section !== "business") {
  //     // Check if section exists and is not "business"
  //     const targetElement = document.getElementById(section);
  //     if (targetElement) {
  //       targetElement.scrollIntoView({
  //         behavior: "smooth",
  //       });
  //     }
  //   }
  // }

  // Detect current path and call the appropriate function

  function scrollToSection() {
    const navLinks = document.querySelectorAll("[data-target]");

    navLinks.forEach((link) => {
      link.addEventListener("click", (e) => {
        e.preventDefault(); // Prevent default link behavior
        const targetId = link.getAttribute("data-target");
        const targetElement = document.getElementById(targetId);

        if (targetElement) {
          targetElement.scrollIntoView({ behavior: "smooth" });
        }
      });
    });
  }

  scrollToSection();

  const currentPath = window.location.pathname;
  if (currentPath === "/") {
    handleHomePageBusinessLink();
  }
  //  else if (currentPath.startsWith("/business")) {
  // }
  // scrollToSection();
});
