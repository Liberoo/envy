// assets/js/dynamic/counter.js

/**
 * Counter Animation
 * Counts from 0 to target value over 3s with ease-out, triggered on viewport.
 * Target is taken from element textContent or data-target.
 */

function easeOutCubic(t) {
  return 1 - Math.pow(1 - t, 3);
}

function parseTarget(el) {
  const raw = el.dataset.target ?? el.textContent;
  const normalized = (raw || '').toString().replace(/[^\d-]/g, '');
  const n = parseInt(normalized, 10);
  return Number.isFinite(n) ? n : 0;
}

function animateCount(el, target, duration = 3000) {
  const start = performance.now();
  const from = 0;
  const isNegative = target < 0;
  const absTarget = Math.abs(target);

  function frame(now) {
    const t = Math.min((now - start) / duration, 1);
    const eased = easeOutCubic(t);
    const value = Math.round(from + (absTarget - from) * eased);
    el.textContent = isNegative ? ('-' + value) : String(value);

    if (t < 1) {
      requestAnimationFrame(frame);
    } else {
      el.textContent = isNegative ? ('-' + absTarget) : String(absTarget);
      el.classList.add('counter-complete');
    }
  }

  requestAnimationFrame(frame);
}

function initCounters() {
  const targets = document.querySelectorAll('.counter');

  const io = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const el = entry.target;
        const target = parseTarget(el);
        animateCount(el, target, 3000);
        io.unobserve(el);
      }
    });
  }, { threshold: 0.1, rootMargin: '50px' });

  targets.forEach((el) => io.observe(el));
}

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initCounters);
} else {
  initCounters();
}
