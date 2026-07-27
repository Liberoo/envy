// Mobile menu: toggle, aria state, focus trap, close on outside click / Escape.

function setMenuItemsTabIndex(value) {
  document.querySelectorAll(".navigation-panel li a").forEach((item) => {
    item.setAttribute("tabindex", value);
  });
}

document.addEventListener("DOMContentLoaded", () => {
  // Blog links independent of the install subdir (window.ENV_SITE from functions.php).
  if (window.ENV_SITE?.blog) {
    document.querySelectorAll("a[data-env-blog]").forEach((link) => {
      link.href = window.ENV_SITE.blog;
    });
  }

  const menuToggle = document.querySelector(".menu-toggle");
  const navigation = document.querySelector(".navigation");
  const mainMenu = document.querySelector(".navigation-content-wrapper");
  if (!menuToggle || !navigation) return;

  if (mainMenu) mainMenu.setAttribute("aria-hidden", "true");
  setMenuItemsTabIndex(-1);

  const closeMenu = () => {
    setMenuItemsTabIndex(-1);
    menuToggle.setAttribute("aria-expanded", "false");
    if (mainMenu) mainMenu.setAttribute("aria-hidden", "true");
    navigation.classList.remove("active");
  };

  menuToggle.addEventListener("click", () => {
    const isExpanded = menuToggle.getAttribute("aria-expanded") === "true";
    menuToggle.setAttribute("aria-expanded", String(!isExpanded));
    if (mainMenu) mainMenu.setAttribute("aria-hidden", String(isExpanded));

    if (isExpanded) {
      setMenuItemsTabIndex(-1);
      navigation.classList.remove("active");
    } else {
      navigation.classList.add("active");
      setTimeout(() => setMenuItemsTabIndex(0), 100);
    }
  });

  document.addEventListener("click", (event) => {
    if (
      !navigation.contains(event.target) &&
      navigation.classList.contains("active")
    ) {
      closeMenu();
    }
  });

  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape" && navigation.classList.contains("active")) {
      closeMenu();
      menuToggle.focus();
      return;
    }

    if (navigation.classList.contains("active") && event.key === "Tab") {
      const menuItems = document.querySelectorAll(".navigation-panel li a");
      const first = menuItems[0];
      const last = menuItems[menuItems.length - 1];

      if (event.shiftKey && document.activeElement === first) {
        event.preventDefault();
        menuToggle.focus();
      } else if (!event.shiftKey && document.activeElement === last) {
        event.preventDefault();
        menuToggle.focus();
      }
    }
  });
});
