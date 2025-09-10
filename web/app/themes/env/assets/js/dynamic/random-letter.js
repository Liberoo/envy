/**
 * Random Letter Animation
 * Modern ES6 optimized animation for .random-letter elements
 * Uses Intersection Observer for performance
 */

class RandomLetterAnimation {
  constructor() {
    this.letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()';
    this.duration = 2000; // 2 seconds
    this.elements = new Map(); // Store original content
    this.init();
  }

  init() {
    const targets = document.querySelectorAll('.random-letter');
    if (!targets.length) return;

    // Setup intersection observer for performance
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          this.startAnimation(entry.target);
          observer.unobserve(entry.target);
        }
      });
    }, { 
      threshold: 0.1,
      rootMargin: '50px'
    });

    // Observe all targets and store original content
    targets.forEach(element => {
      const originalText = element.textContent.trim();
      this.elements.set(element, originalText);
      
      // Set initial random letter
      element.textContent = this.getRandomLetter();
      
      observer.observe(element);
    });
  }

  getRandomLetter() {
    return this.letters[Math.floor(Math.random() * this.letters.length)];
  }

  startAnimation(element) {
    const originalLetter = this.elements.get(element);
    if (!originalLetter) retrn;

    const startTime = performance.now();
    let lastUpdate = startTime;
    
    const animate = (currentTime) => {
      const elapsed = currentTime - startTime;
      const progress = Math.min(elapsed / this.duration, 1);
      
      // Easing function: start fast, end slow
      const easeOut = 1 - Math.pow(1 - progress, 3);
      
      if (progress < 1) {
        // Calculate interval based on progress (starts very fast, gets much slower)
        const baseInterval = 15; // minimum interval - very fast changes at start
        const maxInterval = 500; // maximum interval - slow finish
        const currentInterval = baseInterval + (maxInterval - baseInterval) * easeOut;
        
        // Update if enough time has passed since last update
        if (currentTime - lastUpdate >= currentInterval) {
          element.textContent = this.getRandomLetter();
          lastUpdate = currentTime;
        }
        
        requestAnimationFrame(animate);
      } else {
        // Animation complete - show original letter
        element.textContent = originalLetter;
        element.classList.add('animation-complete');
      }
    };
    
    requestAnimationFrame(animate);
  }
}

// Initialize when DOM is ready
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', () => new RandomLetterAnimation());
} else {
  new RandomLetterAnimation();
}
