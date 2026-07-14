/* ==========================================================================
   FILE:      assessment.js
   PROJECT:   Etma'en (إطمئن)
   PURPOSE:   Controls the multi-step "initial assessment" questionnaire:
              - shows one question at a time
              - updates the progress bar and step counter
              - reveals the smart-matching result after the last question
   NOTE:      This file is only included on pages/assessment.html.
   ========================================================================== */

document.addEventListener('DOMContentLoaded', () => {
  const steps = document.querySelectorAll('.assess-step');
  if (!steps.length) return; // not on the assessment page

  const progressFill = document.querySelector('.progress-fill');
  const currentStepLabel = document.querySelector('.progress-label .current-step');
  const totalStepLabel = document.querySelector('.progress-label .total-step');
  const prevButtons = document.querySelectorAll('.btn-prev');
  const nextButtons = document.querySelectorAll('.btn-next');
  const form = document.getElementById('assess-form');
  const resultSection = document.getElementById('assess-result');

  let currentIndex = 0;

  if (totalStepLabel) totalStepLabel.textContent = steps.length;

  function renderStep() {
    steps.forEach((step, index) => {
      step.style.display = index === currentIndex ? 'block' : 'none';
    });

    if (progressFill) {
      const percentage = ((currentIndex + 1) / steps.length) * 100;
      progressFill.style.width = `${percentage}%`;
    }
    if (currentStepLabel) currentStepLabel.textContent = currentIndex + 1;

    prevButtons.forEach((btn) => {
      btn.style.visibility = currentIndex === 0 ? 'hidden' : 'visible';
    });
    updateNextButtonLabel();
  }

  /**
   * The "next" button reads "Next" on every question except the last one,
   * where it becomes "View Result" - in whichever language is active.
   * Reused both when moving between steps and when the language toggle
   * is clicked, so the label never gets stuck in the wrong language.
   */
  function updateNextButtonLabel() {
    const lang = typeof getCurrentLang === 'function' ? getCurrentLang() : 'ar';
    const dict = TRANSLATIONS[lang] || TRANSLATIONS.ar;
    const key = currentIndex === steps.length - 1 ? 'btn.viewResult' : 'btn.next';
    nextButtons.forEach((btn) => { btn.textContent = dict[key]; });
  }

  function goToNextStep() {
    if (currentIndex < steps.length - 1) {
      currentIndex += 1;
      renderStep();
      window.scrollTo({ top: 0, behavior: 'smooth' });
    } else {
      showMatchingResult();
    }
  }

  function goToPreviousStep() {
    if (currentIndex > 0) {
      currentIndex -= 1;
      renderStep();
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }
  }

  function showMatchingResult() {
    if (!form || !resultSection) return;
    form.style.display = 'none';
    resultSection.style.display = 'block';
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }

  nextButtons.forEach((btn) => btn.addEventListener('click', goToNextStep));
  prevButtons.forEach((btn) => btn.addEventListener('click', goToPreviousStep));

  // i18n.js already re-translates every [data-i18n] element on toggle; we
  // just need to also refresh this one JS-generated label to match.
  document.querySelectorAll('.lang-toggle-btn').forEach((btn) => {
    btn.addEventListener('click', updateNextButtonLabel);
  });

  renderStep();
});
