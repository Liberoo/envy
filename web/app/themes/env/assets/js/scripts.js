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
        console.log(`🔄 Ładowanie ${storeName} store...`);
        await import(storePath);
        console.log(`✅ ${storeName} załadowany!`);
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
