// Lenis smooth scroll initialization
import Lenis from "lenis";

/**
 * Initialize Lenis smooth scroll for the entire page
 * Provides smooth scrolling experience across the whole website
 */
function initSmoothScroll() {
  // Create Lenis instance with configuration
  const lenis = new Lenis({
    duration: 1.2,
    easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
    orientation: "vertical",
    gestureOrientation: "vertical",
    smoothWheel: true,
    wheelMultiplier: 1,
    syncTouch: false,
    touchMultiplier: 2,
    infinite: false,
  });

  // Request animation frame function for smooth updates
  function raf(time) {
    lenis.raf(time);
    requestAnimationFrame(raf);
  }

  // Start the animation loop
  requestAnimationFrame(raf);

  // Handle anchor links with smooth scroll
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      const href = this.getAttribute("href");

      // Skip empty hash links
      if (href === "#" || href === "") {
        return;
      }

      const target = document.querySelector(href);

      if (target) {
        e.preventDefault();
        lenis.scrollTo(target, {
          offset: 0, // Offset from top
          duration: 1.5, // Scroll duration
        });
      }
    });
  });

  // Expose lenis instance globally for potential external use
  window.lenis = lenis;
}

// Initialize when DOM is ready
if (document.readyState === "loading") {
  document.addEventListener("DOMContentLoaded", initSmoothScroll);
} else {
  initSmoothScroll();
}
