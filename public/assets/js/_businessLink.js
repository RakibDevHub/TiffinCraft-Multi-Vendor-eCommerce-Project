export function handleBusinessLink(businessLink, navContainer) {
  let isClosed = false;

  function adjustNavContainer() {
    if (businessLink && navContainer) {
      navContainer.style.top = businessLink.classList.contains("show")
        ? businessLink.offsetHeight + "px"
        : "0";
    }
  }

  window.addEventListener("load", adjustNavContainer);
  window.addEventListener("resize", adjustNavContainer);
  window.addEventListener("scroll", () => {
    if (window.location.pathname !== "/") {
      businessLink?.classList.remove("show");
      navContainer.style.top = "0";
      return;
    }

    if (!isClosed && window.scrollY > window.innerHeight - 100) {
      businessLink?.classList.add("show");
    } else {
      businessLink?.classList.remove("show");
    }
    adjustNavContainer();
  });

  return {
    closeBusinessLink: () => {
      isClosed = true;
      businessLink?.classList.remove("show");
      adjustNavContainer();
    },
  };
}
