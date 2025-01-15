document.addEventListener("DOMContentLoaded", () => {
  // Functionality for the home page (localhost/tiffincraft/)
  // function handleHomePage() {
  //   const businessLink = document.querySelector(".business-link");
  //   const closeBtn = document.querySelector(".close-btn");
  //   const navContainer = document.querySelector(".nav-container");

  //   // Track the "closed" state
  //   let isClosed = false;

  //   // Scroll event listener
  //   window.addEventListener("scroll", () => {
  //     if (!isClosed && window.scrollY > window.innerHeight - 60) {
  //       businessLink?.classList.add("show");
  //       navContainer?.classList.add("addTop");
  //     } else {
  //       businessLink?.classList.remove("show");
  //       navContainer?.classList.remove("addTop");
  //     }
  //   });

  //   // Close button event listener
  //   if (closeBtn) {
  //     closeBtn.addEventListener("click", () => {
  //       isClosed = true;
  //       businessLink?.classList.remove("show");
  //       navContainer?.classList.remove("addTop");
  //     });
  //   }
  // }

  function handleHomePage() {
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
          navContainer.style.top = "0"; // Crucial: Reset top immediately on close
        }
      });
    }
  }

  // Functionality for the business page (localhost/tiffincraft/business)
  function scrollToSection() {
    const pathParts = window.location.pathname.split("/");
    const section = pathParts[pathParts.length - 1]; // Get the last part of the path

    if (section && section !== "business") {
      // Check if section exists and is not "business"
      const targetElement = document.getElementById(section);
      if (targetElement) {
        targetElement.scrollIntoView({
          behavior: "smooth",
        });
      }
    }
  }

  // Detect current path and call the appropriate function
  const currentPath = window.location.pathname;
  if (currentPath === "/tiffincraft/") {
    handleHomePage();
  } else if (currentPath.startsWith("/tiffincraft/business")) {
    scrollToSection();
  }
});
