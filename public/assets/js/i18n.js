/* ==========================================================================
   FILE:      i18n.js
   PROJECT:   Etma'en (إطمئن)
   PURPOSE:   Applies Arabic/English text and page direction based on the
              dictionary in translations.js. Loaded on every page, right
              after translations.js and before the page renders, so there
              is no flash of the wrong language.
   ----------------------------------------------------------------------
   USAGE IN HTML
     <span data-i18n="nav.home">الرئيسية</span>
     <input data-i18n-placeholder="specialists.searchPlaceholder" placeholder="...">
   The Arabic text already in the HTML is the fallback / default value,
   so the page still looks correct even if this script fails to load.
   ========================================================================== */

const LANG_STORAGE_KEY = 'etmaen-lang';

/**
 * Reads the saved language from localStorage, defaulting to Arabic
 * since that's the platform's primary language.
 */
function getCurrentLang() {
  return localStorage.getItem(LANG_STORAGE_KEY) || 'ar';
}

/**
 * Applies a language across the whole document:
 *  - sets <html lang="..."> and dir="rtl|ltr"
 *  - fills every [data-i18n] element with the matching dictionary string
 *  - fills every [data-i18n-placeholder] input's placeholder text
 *  - remembers the choice for next time
 */
function applyLanguage(lang) {
  const dict = TRANSLATIONS[lang] || TRANSLATIONS.ar;

  document.documentElement.setAttribute('lang', lang);
  document.documentElement.setAttribute('dir', lang === 'ar' ? 'rtl' : 'ltr');
  localStorage.setItem(LANG_STORAGE_KEY, lang);

  document.querySelectorAll('[data-i18n]').forEach((el) => {
    const key = el.getAttribute('data-i18n');
    if (dict[key]) el.textContent = dict[key];
  });

  document.querySelectorAll('[data-i18n-placeholder]').forEach((el) => {
    const key = el.getAttribute('data-i18n-placeholder');
    if (dict[key]) el.setAttribute('placeholder', dict[key]);
  });

  // Update the language-toggle button label to show the *other* language
  // (tapping the button while reading Arabic should offer "EN", and vice versa).
  document.querySelectorAll('.lang-toggle-label').forEach((el) => {
    el.textContent = lang === 'ar' ? 'EN' : 'AR';
  });
}

// Apply the saved (or default) language as early as possible, before the
// rest of the page has a chance to render, to avoid a flash of Arabic
// text on an English visit or vice-versa.
applyLanguage(getCurrentLang());

document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.lang-toggle-btn').forEach((btn) => {
    btn.addEventListener('click', () => {
      const next = getCurrentLang() === 'ar' ? 'en' : 'ar';
      applyLanguage(next);
    });
  });
});
