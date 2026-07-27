// Decode text animation: multi-character scramble for values like portfolio
// meta (client / year / scope / stack). Glyphs resolve to the target text
// left-to-right. Targets: .js-decode (lazy-loaded by importObserver).

class DecodeTextAnimation {
  constructor() {
    this.glyphs = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()<>/\\|=+-_";
    this.duration = 1200;
    this.elements = new Map();
    this.reducedMotion = window.matchMedia(
      "(prefers-reduced-motion: reduce)",
    ).matches;
    this.init();
  }

  init() {
    const targets = document.querySelectorAll(".js-decode");
    if (!targets.length) return;

    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            this.startAnimation(entry.target);
            observer.unobserve(entry.target);
          }
        });
      },
      {
        threshold: 0.1,
        rootMargin: "50px",
      },
    );

    targets.forEach((element) => {
      const originalText = element.textContent.trim();
      this.elements.set(element, originalText);

      if (this.reducedMotion) {
        element.classList.add("animation-complete");
        return;
      }

      // Lock dimensions to the final text so wider scramble glyphs are
      // clipped by overflow instead of reflowing the layout. The final
      // text has the same width, so releasing the lock shifts nothing.
      const rect = element.getBoundingClientRect();
      element.style.width = `${rect.width}px`;
      element.style.height = `${rect.height}px`;
      element.style.whiteSpace = "nowrap";
      element.style.overflow = "hidden";

      element.textContent = this.scramble(originalText, 0);
      observer.observe(element);
    });
  }

  getRandomGlyph() {
    return this.glyphs[Math.floor(Math.random() * this.glyphs.length)];
  }

  // Resolve text up to `progress` (0-1): chars before it are final, chars
  // after are random glyphs. Spaces stay so the width never jumps.
  scramble(text, progress) {
    const solved = Math.floor(text.length * progress);
    let out = "";
    for (let i = 0; i < text.length; i++) {
      if (text[i] === " " || i < solved) {
        out += text[i];
      } else {
        out += this.getRandomGlyph();
      }
    }
    return out;
  }

  startAnimation(element) {
    const originalText = this.elements.get(element);
    if (!originalText) return;

    const startTime = performance.now();
    let lastUpdate = startTime;

    const animate = (currentTime) => {
      const elapsed = currentTime - startTime;
      const progress = Math.min(elapsed / this.duration, 1);
      const easeOut = 1 - Math.pow(1 - progress, 3);

      if (progress < 1) {
        // Swap glyphs every ~40ms, resolving chars along the easing curve.
        if (currentTime - lastUpdate >= 40) {
          element.textContent = this.scramble(originalText, easeOut);
          lastUpdate = currentTime;
        }
        requestAnimationFrame(animate);
      } else {
        element.textContent = originalText;
        element.style.width = "";
        element.style.height = "";
        element.style.whiteSpace = "";
        element.style.overflow = "";
        element.classList.add("animation-complete");
      }
    };

    requestAnimationFrame(animate);
  }
}

if (document.readyState === "loading") {
  document.addEventListener(
    "DOMContentLoaded",
    () => new DecodeTextAnimation(),
  );
} else {
  new DecodeTextAnimation();
}
