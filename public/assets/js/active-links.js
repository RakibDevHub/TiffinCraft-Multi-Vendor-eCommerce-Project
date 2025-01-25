// function updateActiveLinks() {
//   const navLinks = document.querySelectorAll(".nav-links a");
//   const sections = [...navLinks].map((link) => {
//     const href = link.getAttribute("href");
//     return href.startsWith("#") ? document.querySelector(href) : null;
//   });

//   // Handle route-based links
//   const currentPath = window.location.pathname;

//   navLinks.forEach((link) => {
//     const href = link.getAttribute("href");
//     if (!href.startsWith("#") && href === currentPath) {
//       updateActiveClass(link, navLinks);
//     }
//   });

//   // // Handle scroll-based links
//   // window.addEventListener("scroll", () => {
//   //   let currentActive = null;

//   //   // Get the middle of the viewport
//   //   const viewportMiddle = window.scrollY + window.innerHeight / 2;

//   //   // Check if the user is at the very top of the page
//   //   if (window.scrollY === 0) {
//   //     currentActive = [...navLinks].find(
//   //       (link) => link.getAttribute("href") === "/"
//   //     );
//   //   } else {
//   //     sections.forEach((section, index) => {
//   //       // Skip non-fragment links
//   //       if (!section) return;

//   //       const sectionTop = section.offsetTop - 500;
//   //       const sectionBottom = sectionTop + section.offsetHeight;

//   //       if (window.scrollY >= sectionTop && window.scrollY < sectionBottom) {
//   //         currentActive = navLinks[index];
//   //       }
//   //     });
//   //   }

//   //   if (currentActive) updateActiveClass(currentActive, navLinks);
//   // });

//   navLinks.forEach((link) => {
//     const href = link.getAttribute("href");
//     if (href.startsWith("#") || href === "/") {
//       link.addEventListener("click", (e) => {
//         e.preventDefault();

//         const target = document.querySelector(href === "/" ? "#home" : href);
//         if (target) {
//           const sectionOffset =
//             target.offsetTop - window.innerHeight / 2 + target.offsetHeight / 2;

//           window.scrollTo({
//             top: sectionOffset,
//             behavior: "smooth",
//           });
//         }
//         updateActiveClass(link, navLinks);
//       });
//     }
//   });

//   // Handle click events for smooth scrolling on fragment links
//   navLinks.forEach((link) => {
//     const href = link.getAttribute("href");
//     if (href.startsWith("#")) {
//       link.addEventListener("click", (e) => {
//         // Prevent the default anchor behavior
//         e.preventDefault();

//         const target = document.querySelector(href);
//         if (target) {
//           target.scrollIntoView({ behavior: "smooth" });
//         }
//         updateActiveClass(link, navLinks);
//       });
//     }
//   });
// }

// function updateActiveClass(activeLink, navLinks) {
//   navLinks.forEach((link) => link.classList.remove("active"));
//   activeLink.classList.add("active");
// }

// // Initialize the active link updates
// updateActiveLinks();

function updateActiveLinks() {
  const navLinks = document.querySelectorAll(".nav-links a");
  const sections = [...navLinks].map((link) => {
    const href = link.getAttribute("href");
    return href.startsWith("#") ? document.querySelector(href) : null;
  });

  const currentPath = window.location.pathname;

  // Handle route-based links (e.g., /login, /profile)
  navLinks.forEach((link) => {
    const href = link.getAttribute("href");
    if (!href.startsWith("#") && href === currentPath) {
      updateActiveClass(link, navLinks);
    }
  });

  // Handle scroll-based active links
  window.addEventListener("scroll", () => {
    let currentActive = null;
    const viewportMiddle = window.scrollY + window.innerHeight / 2;

    sections.forEach((section, index) => {
      if (!section) return; // Skip non-fragment links

      const sectionTop = section.offsetTop;
      const sectionBottom = sectionTop + section.offsetHeight;

      // Check if the viewport middle is within the section's boundaries
      if (viewportMiddle >= sectionTop && viewportMiddle < sectionBottom) {
        currentActive = navLinks[index];
      }
    });

    if (currentActive) updateActiveClass(currentActive, navLinks);
  });

  const businessLink = document.querySelector(".business-link");
  function isBusinessLink() {
    if (businessLink && businessLink.classList.contains("show")) {
      return 60;
    } else return 0;
  }

  // Handle smooth scrolling for fragment links
  navLinks.forEach((link) => {
    const href = link.getAttribute("href");
    if (href.startsWith("#") || href === "/") {
      link.addEventListener("click", (e) => {
        e.preventDefault();

        const target = document.querySelector(href === "/" ? "#home" : href);

        if (target) {
          const sectionOffset =
            target.offsetTop - window.innerHeight / 2 + target.offsetHeight / 2;

          window.scrollTo({
            top: target.offsetTop - isBusinessLink(),
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
  activeLink.classList.add("active");
}

// Initialize the active link updates
updateActiveLinks();
