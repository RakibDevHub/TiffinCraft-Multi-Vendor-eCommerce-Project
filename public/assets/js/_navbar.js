document.addEventListener("DOMContentLoaded", () => {
  const businessLink = document.querySelector(".business-link");
  const closeBtn = document.querySelector(".close-btn");
  const navContainer = document.querySelector(".nav-container");
  let isClosed = false;

  // Adjust navigation container top padding based on business link visibility
  function adjustNavContainer() {
    if (businessLink && navContainer) {
      navContainer.style.top = businessLink.classList.contains("show")
        ? businessLink.offsetHeight + "px"
        : "0";
    }
  }

  // Adjust on initial load and resize
  window.addEventListener("load", adjustNavContainer);
  window.addEventListener("resize", adjustNavContainer);

  // Show/hide business link on scroll
  window.addEventListener("scroll", () => {
    if (!isClosed && window.scrollY > window.innerHeight - 100) {
      businessLink?.classList.add("show");
    } else {
      businessLink?.classList.remove("show");
    }
    adjustNavContainer(); // Important: Adjust on every scroll event
  });

  // Close business link on button click
  if (closeBtn) {
    closeBtn.addEventListener("click", () => {
      isClosed = true;
      businessLink?.classList.remove("show");
      adjustNavContainer();
    });
  }

  // Update active navigation links based on scroll position
  function updateActiveLinks() {
    const navLinks = document.querySelectorAll(".nav-links a");
    const sections = [...navLinks].map((link) => {
      const href = link.getAttribute("href");
      return href.startsWith("#") || href === "/"
        ? document.querySelector(href === "/" ? "#home" : href)
        : null;
    });

    const currentPath = window.location.pathname;

    // Set active link based on current path (for non-hash links)
    navLinks.forEach((link) => {
      const href = link.getAttribute("href");
      if (!href.startsWith("#") && href === currentPath) {
        updateActiveClass(link, navLinks);
      }
    });

    // Set active link based on scroll position
    window.addEventListener("scroll", () => {
      let currentActive = null;
      const businessLink = document.querySelector(".business-link");
      const businessLinkHeight = businessLink?.classList.contains("show")
        ? businessLink.offsetHeight
        : 0;
      const scrollOffset = businessLinkHeight;

      sections.forEach((section, index) => {
        if (!section) return;

        const sectionTop = section.offsetTop - scrollOffset;
        const sectionHeight = section.offsetHeight;
        const scrollPosition = window.scrollY;
        const windowHeight = window.innerHeight;

        // Check if the middle of the viewport is within the section
        if (
          sectionTop <= scrollPosition + windowHeight / 2 &&
          sectionTop + sectionHeight > scrollPosition + windowHeight / 2
        ) {
          currentActive = navLinks[index];
        }
      });

      if (currentActive) {
        updateActiveClass(currentActive, navLinks);
      }
    });

    // Smooth scrolling for hash links
    navLinks.forEach((link) => {
      const href = link.getAttribute("href");
      if (href.startsWith("#") || href === "/") {
        link.addEventListener("click", (e) => {
          e.preventDefault();
          const target = document.querySelector(href === "/" ? "#home" : href);
          if (target) {
            const businessLink = document.querySelector(".business-link");
            const businessLinkHeight = businessLink?.classList.contains("show")
              ? businessLink.offsetHeight
              : 0;
            const targetOffset = target.offsetTop - businessLinkHeight;

            window.scrollTo({
              top: targetOffset,
              behavior: "smooth",
            });
          }
          updateActiveClass(link, navLinks);
        });
      }
    });
  }

  function updateActiveClass(activeLink, navLinks) {
    navLinks.forEach((link) => link.classList.remove("active"));
    if (activeLink) activeLink.classList.add("active");
  }

  // Mobile Menu Toggle
  const menuBar = document.getElementById("menu-bar");
  const navLinksElement = document.querySelector(".nav-links");

  if (menuBar && navLinksElement) {
    menuBar.addEventListener("click", () => {
      menuBar.classList.toggle("fa-times");
      navLinksElement.classList.toggle("active");
    });
  }

  // Login/Logout Link Toggle
  const loggedInLinks = document.querySelectorAll(".logged-in");
  const loggedOutLinks = document.querySelectorAll(".logged-out");

  function toggleLinks(loggedIn) {
    loggedInLinks.forEach((link) => link.classList.toggle("hidden", !loggedIn));
    loggedOutLinks.forEach((link) => link.classList.toggle("hidden", loggedIn));
  }

  // Initialize after DOM is ready
  toggleLinks(userLoggedIn);
  updateActiveLinks();
});
