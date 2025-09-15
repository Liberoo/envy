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

// 1. Vanilla JS Pattern (z konfetti i animacjami)
document.querySelectorAll(".kamil-pattern").forEach((element) => {
	importObserver(element, "kamil-pattern");
});

// Random letter animation pattern
document.querySelectorAll(".random-letter").forEach((element) => {
	importObserver(element, "random-letter");
});

// 2. Interactivity API Patterns - ładują się lazy gdy są widoczne
// Nie ładują się wcześniej = lepsza performance!

// Load all interactive patterns efficiently
loadInteractivityStore(
	".kamil-interactive-pattern",
	"./interactivity/kamil-pattern.js",
	"Kamil Interactive Pattern"
);

loadInteractivityStore(
	".kamil-mega-interactive",
	"./interactivity/kamil-mega-pattern.js",
	"Kamil MEGA Interactive Pattern (TODO List)"
);


// 3. Można łatwo dodać nowe pattern-y:
// loadInteractivityStore(
//     ".my-new-pattern",
//     "./interactivity/my-new-store.js",
//     "My New Pattern"
// );

// Counter animation pattern
document.querySelectorAll(".counter").forEach((element) => {
	importObserver(element, "counter");
});
