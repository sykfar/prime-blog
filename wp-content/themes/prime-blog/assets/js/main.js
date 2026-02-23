/**
 * Prime Blog – Main JavaScript
 */

(function () {
  'use strict';

  /* -------------------------------------------------------------------------
     Dark / Light mode
  -------------------------------------------------------------------------- */
  const THEME_KEY = 'prime-blog-theme';
  const html      = document.documentElement;

  function getStoredTheme() {
    return localStorage.getItem(THEME_KEY);
  }

  function applyTheme(theme) {
    html.setAttribute('data-theme', theme);
    localStorage.setItem(THEME_KEY, theme);
    updateThemeToggle(theme);
  }

  function updateThemeToggle(theme) {
    const btn = document.getElementById('theme-toggle');
    if (!btn) return;
    const isDark = theme === 'dark';
    btn.setAttribute('aria-label', isDark ? 'Switch to light mode' : 'Switch to dark mode');
    btn.setAttribute('title', isDark ? 'Light mode' : 'Dark mode');
    // swap icon visibility
    const moonIcon = btn.querySelector('.icon-moon');
    const sunIcon  = btn.querySelector('.icon-sun');
    if (moonIcon) moonIcon.style.display = isDark ? 'none'  : 'block';
    if (sunIcon)  sunIcon.style.display  = isDark ? 'block' : 'none';
  }

  // Initialise theme immediately (avoid flash)
  (function initTheme() {
    const stored = getStoredTheme();
    const system = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    applyTheme(stored || system);
  })();

  document.addEventListener('DOMContentLoaded', function () {

    /* -----------------------------------------------------------------------
       Theme toggle button
    ----------------------------------------------------------------------- */
    const themeToggle = document.getElementById('theme-toggle');
    if (themeToggle) {
      themeToggle.addEventListener('click', function () {
        const current = html.getAttribute('data-theme');
        applyTheme(current === 'dark' ? 'light' : 'dark');
      });
      // Set correct initial icon state
      updateThemeToggle(html.getAttribute('data-theme'));
    }

    // Listen for OS-level changes
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function (e) {
      if (!getStoredTheme()) {
        applyTheme(e.matches ? 'dark' : 'light');
      }
    });

    /* -----------------------------------------------------------------------
       Mobile navigation
    ----------------------------------------------------------------------- */
    const hamburger  = document.querySelector('.hamburger');
    const mobileNav  = document.querySelector('.mobile-nav');
    const mobileOverlay = document.querySelector('.mobile-overlay');

    function openMobileNav() {
      hamburger.classList.add('is-open');
      mobileNav.classList.add('is-open');
      hamburger.setAttribute('aria-expanded', 'true');
      document.body.style.overflow = 'hidden';
    }

    function closeMobileNav() {
      hamburger.classList.remove('is-open');
      mobileNav.classList.remove('is-open');
      hamburger.setAttribute('aria-expanded', 'false');
      document.body.style.overflow = '';
    }

    if (hamburger && mobileNav) {
      hamburger.addEventListener('click', function () {
        const isOpen = hamburger.classList.contains('is-open');
        isOpen ? closeMobileNav() : openMobileNav();
      });

      // Close on escape
      document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeMobileNav();
      });
    }

    /* -----------------------------------------------------------------------
       Sticky header shadow
    ----------------------------------------------------------------------- */
    const header = document.querySelector('.site-header');
    if (header) {
      const onScroll = () => {
        header.classList.toggle('scrolled', window.scrollY > 10);
      };
      window.addEventListener('scroll', onScroll, { passive: true });
      onScroll();
    }

    /* -----------------------------------------------------------------------
       Reading progress bar
    ----------------------------------------------------------------------- */
    const progressBar = document.querySelector('.reading-progress');
    if (progressBar) {
      window.addEventListener('scroll', function () {
        const doc    = document.documentElement;
        const scrollTop  = window.scrollY;
        const scrollHeight = doc.scrollHeight - doc.clientHeight;
        const progress = scrollHeight > 0 ? (scrollTop / scrollHeight) * 100 : 0;
        progressBar.style.width = Math.min(progress, 100) + '%';
      }, { passive: true });
    }

    /* -----------------------------------------------------------------------
       Smooth scroll for anchor links
    ----------------------------------------------------------------------- */
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
      anchor.addEventListener('click', function (e) {
        const id = this.getAttribute('href').slice(1);
        const el = document.getElementById(id);
        if (el) {
          e.preventDefault();
          el.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      });
    });

    /* -----------------------------------------------------------------------
       Lazy image fade-in
    ----------------------------------------------------------------------- */
    if ('IntersectionObserver' in window) {
      const observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-loaded');
            observer.unobserve(entry.target);
          }
        });
      }, { rootMargin: '100px' });

      document.querySelectorAll('.post-card-image-wrap img, .single-hero img').forEach(function (img) {
        img.classList.add('lazy-fade');
        observer.observe(img);
      });
    }

    /* -----------------------------------------------------------------------
       Copy-link share button
    ----------------------------------------------------------------------- */
    document.querySelectorAll('.share-btn--copy').forEach(function (btn) {
      btn.addEventListener('click', function () {
        const url  = btn.dataset.url || window.location.href;
        const orig = btn.innerHTML;

        function showFeedback(text) {
          btn.textContent = text;
          setTimeout(function () { btn.innerHTML = orig; }, 2000);
        }

        if (navigator.clipboard && navigator.clipboard.writeText) {
          navigator.clipboard.writeText(url).then(function () {
            showFeedback('Copied!');
          }).catch(function () {
            showFeedback('Error');
          });
        } else {
          // Fallback for older browsers
          var input = document.createElement('input');
          input.value = url;
          input.style.position = 'fixed';
          input.style.opacity  = '0';
          document.body.appendChild(input);
          input.focus();
          input.select();
          try {
            document.execCommand('copy');
            showFeedback('Copied!');
          } catch (e) {
            showFeedback('Error');
          }
          document.body.removeChild(input);
        }
      });
    });

    /* -----------------------------------------------------------------------
       Copy code blocks
    ----------------------------------------------------------------------- */
    document.querySelectorAll('pre').forEach(function (pre) {
      const btn = document.createElement('button');
      btn.className = 'copy-code-btn';
      btn.textContent = 'Copy';
      btn.setAttribute('aria-label', 'Copy code');
      pre.style.position = 'relative';
      pre.appendChild(btn);

      btn.addEventListener('click', function () {
        const code = pre.querySelector('code') || pre;
        navigator.clipboard.writeText(code.innerText).then(function () {
          btn.textContent = 'Copied!';
          setTimeout(() => { btn.textContent = 'Copy'; }, 2000);
        }).catch(function () {
          btn.textContent = 'Error';
        });
      });
    });

  }); // DOMContentLoaded

})();
