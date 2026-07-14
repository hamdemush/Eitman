/* ==========================================================================
   FILE:      main.js
   PROJECT:   Etma'en (إطمئن)
   PURPOSE:   Shared UI behavior loaded on every page:
              - mobile navigation menu toggle
              - selectable "option" cards (assessment questionnaire)
              - selectable time-slot buttons (booking)
              - the "anonymous mode" toggle switch
   ========================================================================== */

document.addEventListener('DOMContentLoaded', () => {
  initMobileNav();
  initDashSidebar();
  initSelectableOptions();
  initTimeSlots();
  initAnonymousToggle();
});

/**
 * Toggles the mobile navigation menu when the hamburger button is clicked.
 * Only relevant below the 960px breakpoint (see layout.css).
 */
function initMobileNav() {
  const toggleButton = document.querySelector('.nav-toggle');
  const nav = document.querySelector('.main-nav');
  if (!toggleButton || !nav) return;

  toggleButton.addEventListener('click', () => {
    nav.classList.toggle('mobile-open');
  });
}

/**
 * Turns the dashboard sidebar (.dash-sidebar) into a responsive off-canvas
 * menu below the 1000px breakpoint (see layout.css). The hamburger button
 * (.dash-toggle) opens it, and it can be closed via its own close button,
 * by tapping the dimmed backdrop (.dash-overlay), by picking a nav link,
 * or by resizing back up to desktop width.
 */
function initDashSidebar() {
  const toggleButton = document.querySelector('.dash-toggle');
  const closeButton = document.querySelector('.dash-sidebar-close');
  const sidebar = document.querySelector('.dash-sidebar');
  const overlay = document.querySelector('.dash-overlay');
  if (!toggleButton || !sidebar || !overlay) return;

  const openSidebar = () => {
    sidebar.classList.add('mobile-open');
    overlay.classList.add('active');
    toggleButton.setAttribute('aria-expanded', 'true');
  };

  const closeSidebar = () => {
    sidebar.classList.remove('mobile-open');
    overlay.classList.remove('active');
    toggleButton.setAttribute('aria-expanded', 'false');
  };

  toggleButton.addEventListener('click', () => {
    sidebar.classList.contains('mobile-open') ? closeSidebar() : openSidebar();
  });

  overlay.addEventListener('click', closeSidebar);
  if (closeButton) closeButton.addEventListener('click', closeSidebar);

  sidebar.querySelectorAll('.dash-nav a').forEach((link) => {
    link.addEventListener('click', closeSidebar);
  });

  window.addEventListener('resize', () => {
    if (window.innerWidth > 1000) closeSidebar();
  });
}

/**
 * Handles single-choice "option" cards used in the assessment questionnaire.
 * Clicking a card marks it selected and checks its radio input.
 */
function initSelectableOptions() {
  document.addEventListener('click', (event) => {
    const option = event.target.closest('.option');
    if (!option) return;

    const group = option.closest('.option-list');
    group.querySelectorAll('.option').forEach((el) => el.classList.remove('selected'));
    option.classList.add('selected');

    const input = option.querySelector('input');
    if (input) input.checked = true;
  });
}

/**
 * Handles time-slot selection on the specialist profile / booking pages.
 * Slots marked "unavailable" cannot be selected.
 */
function initTimeSlots() {
  document.addEventListener('click', (event) => {
    const slot = event.target.closest('.slot');
    if (!slot || slot.classList.contains('unavailable')) return;

    const group = slot.closest('.slot-grid');
    group.querySelectorAll('.slot').forEach((el) => el.classList.remove('selected'));
    slot.classList.add('selected');
  });
}

/**
 * Shows/hides a small explanatory note when the "anonymous mode" switch
 * is toggled on the registration and booking pages.
 */
function initAnonymousToggle() {
  document.querySelectorAll('.anon-checkbox').forEach((checkbox) => {
    checkbox.addEventListener('change', () => {
      const note = document.querySelector('.anon-note');
      if (note) note.style.display = checkbox.checked ? 'block' : 'none';
    });
  });
}
