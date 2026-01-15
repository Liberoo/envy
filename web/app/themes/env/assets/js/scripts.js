// Import utility for lazy loading
import { importObserver } from "./importObserver.js";

/**
 * Pattern Loading System - ładuje JS tylko gdy pattern pojawia się w viewport
 * 🚀 Maksymalna wydajność - zero niepotrzebnych zapytań!
 */

/**
 * Helper function for loading Interactivity API stores
 */
function loadInteractivityStore(selector, storePath, storeName) {
  document.querySelectorAll(selector).forEach((element) => {
    const observer = new IntersectionObserver(async (entries) => {
      if (entries[0].isIntersecting) {
        await import(storePath);
        observer.disconnect();
      }
    });
    observer.observe(element);
  });
}

// Random letter animation pattern
document.querySelectorAll(".random-letter").forEach((element) => {
  importObserver(element, "random-letter");
});

// Counter animation pattern
document.querySelectorAll(".counter").forEach((element) => {
  importObserver(element, "counter");
});

// FAQ pattern
document.querySelectorAll(".faq").forEach((element) => {
  importObserver(element, "faq");
});

/**
 * Mobile Menu Handler - obsługa menu mobilnego z aria-hidden
 * 🎯 Pełna dostępność i UX
 */
document.addEventListener("DOMContentLoaded", function () {
  const menuToggle = document.querySelector(".menu-toggle");
  const navigation = document.querySelector(".navigation");
  const mainMenu = document.querySelector(".navigation-content-wrapper");

  if (menuToggle && navigation) {
    // Initialize menu state
    if (mainMenu) {
      mainMenu.setAttribute("aria-hidden", "true");
    }

    // Initialize tabindex for menu items
    setMenuItemsTabIndex(-1);

    menuToggle.addEventListener("click", function () {
      const isExpanded = menuToggle.getAttribute("aria-expanded") === "true";

      // Toggle aria-expanded on button
      menuToggle.setAttribute("aria-expanded", !isExpanded);

      // Toggle aria-hidden on menu panel
      if (mainMenu) {
        mainMenu.setAttribute("aria-hidden", isExpanded);
      }

      // Toggle active class on navigation
      if (isExpanded) {
        // Zamykanie menu
        setMenuItemsTabIndex(-1); // Usuń z tab order
        navigation.classList.remove("active");
      } else {
        // Otwieranie menu
        navigation.classList.add("active");
        setTimeout(() => {
          setMenuItemsTabIndex(0); // Dodaj do tab order
        }, 100); // Małe opóźnienie żeby animacja się rozpoczęła
      }
    });

    // Close menu when clicking outside
    document.addEventListener("click", function (event) {
      if (
        !navigation.contains(event.target) &&
        navigation.classList.contains("active")
      ) {
        setMenuItemsTabIndex(-1); // Usuń z tab order
        menuToggle.setAttribute("aria-expanded", "false");
        if (mainMenu) {
          mainMenu.setAttribute("aria-hidden", "true");
        }
        navigation.classList.remove("active");
      }
    });

    // Close menu on escape key and handle keyboard navigation
    document.addEventListener("keydown", function (event) {
      if (event.key === "Escape" && navigation.classList.contains("active")) {
        setMenuItemsTabIndex(-1); // Usuń z tab order
        menuToggle.setAttribute("aria-expanded", "false");
        if (mainMenu) {
          mainMenu.setAttribute("aria-hidden", "true");
        }
        navigation.classList.remove("active");
        menuToggle.focus(); // Return focus to button
      }

      // Handle Tab navigation within menu - focus trap
      if (navigation.classList.contains("active") && event.key === "Tab") {
        const menuItems = document.querySelectorAll(".navigation-panel li a");
        const firstMenuItem = menuItems[0];
        const lastMenuItem = menuItems[menuItems.length - 1];

        if (event.shiftKey) {
          // Shift + Tab - going backwards
          if (document.activeElement === firstMenuItem) {
            event.preventDefault();
            menuToggle.focus();
          }
        } else {
          // Tab - going forwards
          if (document.activeElement === lastMenuItem) {
            event.preventDefault();
            menuToggle.focus();
          }
        }
      }
    });
  }

  // Funkcja do zarządzania tabindex elementów menu
  function setMenuItemsTabIndex(value) {
    const menuItems = document.querySelectorAll(".navigation-panel li a");
    menuItems.forEach((item) => {
      item.setAttribute("tabindex", value);
    });
  }

  /**
   * Scroll Animations - Intersection Observer for .js-animation
   */
  const animationObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("js-animation--open");
          animationObserver.unobserve(entry.target);
        }
      });
    },
    {
      threshold: 0.1, // Trigger when 10% of the element is visible
    },
  );

  document.querySelectorAll(".js-animation").forEach((element) => {
    animationObserver.observe(element);
  });
});
