/* ==========================================================================
   FILE:      theme-switcher.js
   PROJECT:   Etma'en (إطمئن)
   PURPOSE:   Dark / light mode toggle. Reads/writes data-theme="dark" on
              the <html> element - every color in the CSS is defined as a
              variable in variables.css, so this single attribute re-themes
              the entire site (see the comment block in variables.css).
   ========================================================================== */

const THEME_STORAGE_KEY = 'etmaen-theme';

/**
 * Decides which theme to start with:
 * 1) whatever the user picked last time (saved in localStorage), otherwise
 * 2) the operating system's preference (prefers-color-scheme).
 */
function getPreferredTheme() {
  const saved = localStorage.getItem(THEME_STORAGE_KEY);
  if (saved) return saved;
  return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
}

function applyTheme(theme) {
  document.documentElement.setAttribute('data-theme', theme);
  localStorage.setItem(THEME_STORAGE_KEY, theme);

  document.querySelectorAll('.theme-toggle-btn').forEach((btn) => {
    btn.setAttribute('aria-pressed', theme === 'dark' ? 'true' : 'false');
  });
}

// Apply immediately (this script is loaded in <head>, before <body> is
// parsed) so there is no flash of the wrong theme on page load.
applyTheme(getPreferredTheme());

document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.theme-toggle-btn').forEach((btn) => {
    btn.addEventListener('click', () => {
      const current = document.documentElement.getAttribute('data-theme');
      applyTheme(current === 'dark' ? 'light' : 'dark');
    });
  });
});
