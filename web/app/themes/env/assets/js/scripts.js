import { importObserver } from "./importObserver.js";
import "./mobile-menu.js";
import "./scroll-animations.js";
import "./portfolio-rows.js";

// Lazy-load each pattern's JS only when it enters the viewport.
const lazyPatterns = [
  [".random-letter", "random-letter"],
  [".counter", "counter"],
  [".faq", "faq"],
  [".js-decode", "decode-text"],
  [".env-newsletter__form", "newsletter"],
  [".env-archive__filters", "archive-filter"],
];

lazyPatterns.forEach(([selector, module]) => {
  document.querySelectorAll(selector).forEach((element) => {
    importObserver(element, module);
  });
});
