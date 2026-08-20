/* ==========================================================================
   FILE:      admin-common.js
   PROJECT:   Etma'en (إطمئن)
   PURPOSE:   Shared building blocks for every page under pages/admin/, so
              the accept/reject/delete/freeze flows, confirmation modals,
              toasts and "send email" behaviour are written once instead of
              being copy-pasted into six different HTML files.
   USAGE:     Include AFTER store.js and BEFORE the page's own <script>:
                <script src="../../assets/js/admin-common.js"></script>
   ========================================================================== */

const AdminUI = (function () {

  /* ------------------------------- toast ------------------------------- */
  // Reuses a single <div class="toast"> that must exist on the page (id
  // configurable so pages that already had one keep working unchanged).
  function toast(elId, text) {
    const el = document.getElementById(elId);
    if (!el) return;
    el.textContent = text;
    el.classList.add('show');
    clearTimeout(el._hideTimer);
    el._hideTimer = setTimeout(() => el.classList.remove('show'), 2600);
  }

  /* ------------------------- generic confirm modal ------------------------ */
  // <div class="modal-overlay" id="..."> with h3/p/2 buttons, built at runtime
  // so pages don't need bespoke markup for every single confirmation dialog.
  function ensureModalHost() {
    let host = document.getElementById('adminModalHost');
    if (host) return host;
    host = document.createElement('div');
    host.id = 'adminModalHost';
    document.body.appendChild(host);
    return host;
  }

  /**
   * Confirm-only modal (no text input). Resolves nothing — takes onConfirm.
   */
  function confirmModal({ title, text, confirmLabel, danger, onConfirm }) {
    const host = ensureModalHost();
    host.innerHTML =
      '<div class="modal-overlay open" id="acModal">' +
        '<div class="modal-box">' +
          '<h3></h3><p></p>' +
          '<div class="modal-actions">' +
            '<button class="btn btn-ghost" data-role="cancel">إلغاء</button>' +
            '<button class="btn ' + (danger ? 'btn-danger' : 'btn-primary') + '" data-role="confirm"></button>' +
          '</div>' +
        '</div>' +
      '</div>';
    host.querySelector('h3').textContent = title || 'تأكيد الإجراء';
    host.querySelector('p').textContent = text || 'هل أنت متأكد من رغبتك بإتمام هذا الإجراء؟';
    host.querySelector('[data-role="confirm"]').textContent = confirmLabel || 'تأكيد';

    const overlay = host.querySelector('#acModal');
    function close() { overlay.classList.remove('open'); setTimeout(() => { host.innerHTML = ''; }, 200); }
    host.querySelector('[data-role="cancel"]').addEventListener('click', close);
    overlay.addEventListener('click', (e) => { if (e.target === overlay) close(); });
    host.querySelector('[data-role="confirm"]').addEventListener('click', () => {
      close();
      if (onConfirm) onConfirm();
    });
  }

  /**
   * Modal with a required textarea (rejection / deletion / freeze reasons).
   * onConfirm receives the trimmed reason string; the confirm button stays
   * disabled until at least a few characters are entered so an action can
   * never be completed silently without a reason (per admin spec §12).
   */
  function reasonModal({ title, text, placeholder, confirmLabel, danger, onConfirm }) {
    const host = ensureModalHost();
    host.innerHTML =
      '<div class="modal-overlay open" id="acModal">' +
        '<div class="modal-box">' +
          '<h3></h3><p></p>' +
          '<div class="field" style="margin-bottom:14px;">' +
            '<textarea rows="3" style="width:100%; padding:12px 14px; border-radius:12px; border:1.5px solid var(--border); font-family:inherit; font-size:14px; background:var(--bg-card); color:var(--ink-900);"></textarea>' +
          '</div>' +
          '<div class="modal-actions">' +
            '<button class="btn btn-ghost" data-role="cancel">إلغاء</button>' +
            '<button class="btn ' + (danger ? 'btn-danger' : 'btn-primary') + '" data-role="confirm" disabled></button>' +
          '</div>' +
        '</div>' +
      '</div>';
    host.querySelector('h3').textContent = title || 'إدخال السبب';
    host.querySelector('p').textContent = text || 'يرجى كتابة السبب — سيتم حفظه وإرساله بالبريد الإلكتروني.';
    const textarea = host.querySelector('textarea');
    textarea.placeholder = placeholder || 'اكتب السبب هنا...';
    const confirmBtn = host.querySelector('[data-role="confirm"]');
    confirmBtn.textContent = confirmLabel || 'تأكيد';

    const overlay = host.querySelector('#acModal');
    function close() { overlay.classList.remove('open'); setTimeout(() => { host.innerHTML = ''; }, 200); }
    host.querySelector('[data-role="cancel"]').addEventListener('click', close);
    overlay.addEventListener('click', (e) => { if (e.target === overlay) close(); });
    textarea.addEventListener('input', () => { confirmBtn.disabled = textarea.value.trim().length < 3; });
    confirmBtn.addEventListener('click', () => {
      const reason = textarea.value.trim();
      if (reason.length < 3) return;
      close();
      if (onConfirm) onConfirm(reason);
    });
    setTimeout(() => textarea.focus(), 50);
  }

  /* ------------------------------ dropdown menu ------------------------------ */
  // Small "..." action menu used by admin/specialties.html (تعديل / حذف).
  // Closes on outside click / Escape; only one open at a time.
  function initActionMenus(root) {
    (root || document).addEventListener('click', (e) => {
      const trigger = e.target.closest('[data-menu-trigger]');
      document.querySelectorAll('.action-menu.open').forEach((m) => {
        if (!trigger || m !== trigger.nextElementSibling) m.classList.remove('open');
      });
      if (trigger) {
        const menu = trigger.nextElementSibling;
        if (menu && menu.classList.contains('action-menu')) menu.classList.toggle('open');
        e.stopPropagation();
      }
    });
    document.addEventListener('click', () => {
      document.querySelectorAll('.action-menu.open').forEach((m) => m.classList.remove('open'));
    });
  }

  /* --------------------------------- email --------------------------------- */
  // The project has no back-end mail service (see README §5) — the
  // established pattern (already used in complaint-details.html) is a
  // pre-filled `mailto:` link opened via the OS/browser mail handler. We
  // centralize it here instead of re-writing it per page. Returns true/false
  // so callers only update status/UI on an actual success.
  function sendMail({ to, subject, body }) {
    try {
      const href = 'mailto:' + to +
        '?subject=' + encodeURIComponent(subject || '') +
        '&body=' + encodeURIComponent(body || '');
      const a = document.createElement('a');
      a.href = href;
      a.style.display = 'none';
      document.body.appendChild(a);
      a.click();
      document.body.removeChild(a);
      return true;
    } catch (e) {
      return false;
    }
  }

  /* ------------------------------ status labels ------------------------------ */
  const patientStatusLabel = { pending: 'قيد المراجعة', accepted: 'مقبول', rejected: 'مرفوض', deleted: 'محذوف' };
  const patientStatusPill  = { pending: 'pending', accepted: 'approved', rejected: 'rejected', deleted: 'rejected' };
  const therapistStatusLabel = { pending: 'قيد المراجعة', verified: 'معتمد', rejected: 'مرفوض', frozen: 'مجمّد' };
  const therapistStatusPill  = { pending: 'pending', verified: 'approved', rejected: 'rejected', frozen: 'frozen' };

  function escapeHtml(str) {
    return String(str == null ? '' : str).replace(/[&<>"']/g, (c) => ({
      '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'
    }[c]));
  }

  return {
    toast, confirmModal, reasonModal, initActionMenus, sendMail,
    patientStatusLabel, patientStatusPill, therapistStatusLabel, therapistStatusPill,
    escapeHtml
  };
})();
