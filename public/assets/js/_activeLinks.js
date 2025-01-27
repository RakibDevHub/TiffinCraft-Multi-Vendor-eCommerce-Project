// export function initActiveLinks(pageLinks, businessLink) {
//   const sections = [...pageLinks].map((link) => {
//     const href = link.getAttribute("href");
//     return href.startsWith("#") || href === "/"
//       ? document.querySelector(href === "/" ? "#home" : href)
//       : null;
//   });

//   const currentPath = window.location.pathname;

//   // Set the active class for route-based links (non-fragment links)
//   pageLinks.forEach((link) => {
//     const href = link.getAttribute("href");
//     if (!href.startsWith("#") && href === currentPath) {
//       setActiveClass(link, pageLinks);
//     }
//   });

//   // Scroll-based logic to determine active links
//   window.addEventListener("scroll", () => {
//     const businessLinkHeight = businessLink?.classList.contains("show")
//       ? businessLink.offsetHeight
//       : 0;

//     const viewportMiddle = window.scrollY + window.innerHeight / 2;

//     let currentActive = null;

//     sections.forEach((section, index) => {
//       if (!section) return;

//       const sectionTop = section.offsetTop - businessLinkHeight;
//       const sectionHeight = section.offsetHeight;

//       // Check if the section is at the middle of the viewport
//       if (
//         viewportMiddle >= sectionTop &&
//         viewportMiddle < sectionTop + sectionHeight
//       ) {
//         currentActive = pageLinks[index];
//       }
//     });

//     if (currentActive) {
//       setActiveClass(currentActive, pageLinks);
//     }
//   });

//   // Handle smooth scrolling for fragment links
//   pageLinks.forEach((link) => {
//     const href = link.getAttribute("href");
//     if (href.startsWith("#") || href === "/") {
//       link.addEventListener("click", (e) => {
//         e.preventDefault(); // Prevent default anchor behavior

//         const target = document.querySelector(href === "/" ? "#home" : href);
//         if (target) {
//           const businessLinkHeight = businessLink?.classList.contains("show")
//             ? businessLink.offsetHeight
//             : 0;

//           const targetOffset = target.offsetTop - businessLinkHeight;

//           window.scrollTo({
//             top: targetOffset,
//             behavior: "smooth",
//           });
//         }
//         setActiveClass(link, pageLinks);
//       });
//     }
//   });
// }

// function setActiveClass(activeLink, pageLinks) {
//   // Clear all active classes
//   pageLinks.forEach((link) => link.classList.remove("active"));

//   // Add active class to the current link
//   if (activeLink) activeLink.classList.add("active");
// }

export function initActiveLinks(linkGroups, businessLink) {
  const allLinks = [];
  const allLinksData = [];

  linkGroups.forEach((linkGroup) => {
    linkGroup.forEach((link) => {
      allLinks.push(link);
      allLinksData.push({ href: link.getAttribute("href") });
    });
  });

  const sections = allLinksData.map((linkData) => {
    let href = linkData.href;
    href = href === "/" ? "#home" : href;
    return href?.startsWith("#") ? document.querySelector(href) : null;
  });

  //   let isScrolling = false;

  window.addEventListener("scroll", () => {
    // if (isScrolling) return;
    // isScrolling = true;

    const businessLinkHeight = businessLink?.classList.contains("show")
      ? businessLink?.offsetHeight
      : 0;
    const viewportTop = window.scrollY + businessLinkHeight;
    // const viewportBottom = viewportTop + window.innerHeight;

    let currentActive = null;
    // let closestDistance = Infinity;

    const viewportMiddle = window.scrollY + window.innerHeight / 2;

    sections.forEach((section, index) => {
      if (!section) return;

      //   const rect = section.getBoundingClientRect();

      const sectionTop = section.offsetTop - businessLinkHeight;
      const sectionHeight = section.offsetHeight;
      if (
        viewportMiddle >= sectionTop &&
        viewportMiddle < sectionTop + sectionHeight
      ) {
        currentActive = allLinks[index];
      }

      // Check if the section is visible in the viewport
      //   if (sectionTop <= viewportBottom && sectionBottom >= viewportTop) {
      //     const distanceToMiddle = Math.abs(
      //       viewportTop + window.innerHeight / 3 - (sectionTop + rect.height / 2)
      //     );
      //     if (distanceToMiddle < closestDistance) {
      //       closestDistance = distanceToMiddle;
      //       currentActive = allLinks[index];
      //     }
      //   }
    });

    if (currentActive) {
      setActiveClass(currentActive, allLinks);
    }

    // setTimeout(() => (isScrolling = false), 100);
  });

  allLinks.forEach((link, index) => {
    let href = allLinksData[index].href;
    href = href === "/" ? "#home" : href;

    link.addEventListener("click", (e) => {
      e.preventDefault();

      if (href?.startsWith("#")) {
        const target = document.querySelector(href);
        if (target) {
          const businessLinkHeight = businessLink?.offsetHeight || 0;
          window.scrollTo({
            top: target.offsetTop - businessLinkHeight,
            behavior: "smooth",
          });
        }
        history.pushState({}, document.title, window.location.pathname);
        setActiveClass(link, allLinks);
      }
    });
  });
}

function setActiveClass(activeLink, allLinks) {
  allLinks.forEach((link) => link.classList.remove("active"));
  activeLink?.classList.add("active");
}
