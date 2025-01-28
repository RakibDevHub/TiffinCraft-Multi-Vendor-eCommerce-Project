export function initActiveNavLinks(navLinks, businessLink) {
  const sections = [...navLinks].map((link) => {
    const href = link.getAttribute("href");
    return href.startsWith("#") || href === "/"
      ? document.querySelector(href === "/" ? "#home" : href)
      : null;
  });

  let isScrolling = false;

  window.addEventListener("scroll", () => {
    if (isScrolling) return;
    isScrolling = true;

    setActiveLinkOnScroll();

    setTimeout(() => {
      isScrolling = false;
    }, 100);
  });

  // Initial call to set active link based on initial scroll position
  setActiveLinkOnScroll();

  navLinks.forEach((link) => {
    const href = link.getAttribute("href");
    if (href.startsWith("#") || href === "/") {
      link.addEventListener("click", (e) => {
        e.preventDefault();

        const target = document.querySelector(href === "/" ? "#home" : href);
        if (target) {
          const businessLinkHeight = businessLink?.classList.contains("show")
            ? businessLink.offsetHeight
            : 0;
          window.scrollTo({
            top: target.offsetTop - businessLinkHeight,
            behavior: "smooth",
          });
        }
        setActiveClass(link, navLinks);
      });
    }
  });

  function setActiveClass(activeLink, navLinks) {
    navLinks.forEach((link) => link.classList.remove("active"));
    if (activeLink) activeLink.classList.add("active");
  }

  function setActiveLinkOnScroll() {
    const businessLinkHeight = businessLink?.offsetHeight || 0;
    const viewportMiddle = window.scrollY + window.innerHeight / 2;

    let currentActive = null;

    sections.forEach((section, index) => {
      if (!section) return;

      const sectionTop = section.offsetTop - businessLinkHeight;
      const sectionBottom = sectionTop + section.offsetHeight + 100; // 100 is for shape height between each section.

      // Determine if section are within the viewport
      if (viewportMiddle >= sectionTop && viewportMiddle < sectionBottom) {
        currentActive = navLinks[index];
      }
    });

    setActiveClass(currentActive, navLinks);
  }
}

export function initActiveFooterLinks(footerLinks) {
  // Get the current URL path
  const currentPath = window.location.pathname;

  // Loop through all footer links
  footerLinks.forEach((link) => {
    const href = link.getAttribute("href");

    // Compare link href with current path
    if (href === currentPath) {
      link.classList.add("active");
    } else {
      link.classList.remove("active");
    }
  });
}

export function initPageLinks(pageLinks) {
  pageLinks.forEach((link) => {
    const href = link.getAttribute("href");

    // Handle internal hash links without updating the browser URL
    if (href.startsWith("#")) {
      link.addEventListener("click", (e) => {
        e.preventDefault();

        const target = document.querySelector(href);
        if (target) {
          window.scrollTo({
            top: target.offsetTop,
            behavior: "smooth",
          });
        }
      });
    }
  });
}
