// Robust animated counters with suffix support (B, M, etc.)
document.addEventListener('DOMContentLoaded', () => {
    const counters = document.querySelectorAll('.counter');
    let started = false;
  
    function formatValue(value, suffix) {
      // value is a number like 2.3 (for B) or 500 (for M)
      if (!suffix) return value.toString();
      // Show one decimal for billions, no decimals for millions > 100
      if (suffix === 'B') {
        return value.toFixed(1) + suffix;
      }
      if (suffix === 'M') {
        // If target is >= 1000 (thousands of millions), show shorthand; otherwise integer
        return Math.round(value) + suffix;
      }
      return value + suffix;
    }
  
    function animateCounter(counter, target, suffix, duration = 1500) {
      const start = performance.now();
      const initial = 0;
  
      function step(now) {
        const elapsed = now - start;
        const progress = Math.min(elapsed / duration, 1); // 0..1
        const current = initial + (target - initial) * progress;
  
        counter.innerText = formatValue(current, suffix);
  
        if (progress < 1) {
          requestAnimationFrame(step);
        } else {
          // Ensure final value is exactly the target formatted
          counter.innerText = formatValue(target, suffix);
        }
      }
  
      requestAnimationFrame(step);
    }
  
    function isElementInViewport(el) {
      const rect = el.getBoundingClientRect();
      return rect.top < window.innerHeight && rect.bottom >= 0;
    }
  
    function tryStartCounters() {
      if (started) return;
      const statsSection = document.querySelector('.stats-section');
      if (!statsSection) return;
  
      if (isElementInViewport(statsSection)) {
        started = true;
        counters.forEach(counter => {
          const rawTarget = counter.getAttribute('data-target');
          const suffix = counter.getAttribute('data-suffix') || '';
          // Parse numeric target depending on suffix convention:
          // If suffix is B or M the data-target is the display number (e.g., 2.3 for 2.3B, 500 for 500M)
          const target = parseFloat(rawTarget);
          // Duration can be customized per-counter with data-duration (ms)
          const duration = parseInt(counter.getAttribute('data-duration')) || 1500;
          animateCounter(counter, target, suffix, duration);
        });
      }
    }
  
    // Try on load (in case it's already visible) and on scroll/resize.
    tryStartCounters();
    window.addEventListener('scroll', tryStartCounters, { passive: true });
    window.addEventListener('resize', tryStartCounters);
  });
  