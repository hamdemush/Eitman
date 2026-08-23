<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>الدردشة | إطمئن</title>
  <link rel="icon" type="image/png" href="../../assets/images/favicon.png">

  <link rel="stylesheet" href="../../assets/css/variables.css">
  <link rel="stylesheet" href="../../assets/css/base.css">
  <link rel="stylesheet" href="../../assets/css/components.css">
  <link rel="stylesheet" href="../../assets/css/layout.css">

  <script src="../../assets/js/theme-switcher.js"></script>
  <script src="../../assets/js/translations.js"></script>
  <script src="../../assets/js/i18n.js"></script>
  <script src="../../assets/js/store.js"></script>
</head>
<body>

<header class="site-header">
  <div class="container">
    <a href="../../index.html" class="logo"><img src="../../assets/images/logo-icon.png" alt="إطمئن" class="logo-mark"> إطمئن</a>
    <nav class="main-nav"><span style="font-weight:800; color:var(--teal-700); font-size:14px;">بوابة المعالج</span></nav>
    <div class="header-actions">
      <div class="toggle-group">
        <button class="icon-btn theme-toggle-btn" type="button" aria-label="تبديل الوضع الليلي/النهاري">
          <svg class="icon-moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.8A9 9 0 1111.2 3 7 7 0 0021 12.8z"/></svg>
          <svg class="icon-sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/></svg>
        </button>
        <button class="icon-btn lang-toggle-btn" type="button" aria-label="Change language"><span class="lang-toggle-label">EN</span></button>
      </div>
      <div class="avatar" style="width:40px;height:40px;font-size:13px;">م.ع</div>
    </div>
  </div>
</header>

<div class="dash-layout">
  <div class="dash-overlay"></div>
  <aside class="dash-sidebar" id="dashSidebar">
    <button class="dash-sidebar-close" type="button" aria-label="إغلاق القائمة">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
    </button>
    <div class="dash-user">
      <div class="avatar">م.ع</div>
      <div><b>د. روان الأسي</b><span>علاج سلوكي معرفي</span></div>
    </div>
    <nav class="dash-nav">
      <a href="dashboard.html">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9" rx="1"/><rect x="14" y="3" width="7" height="5" rx="1"/><rect x="14" y="12" width="7" height="9" rx="1"/><rect x="3" y="16" width="7" height="5" rx="1"/></svg>
        <span data-i18n="sidebar.dashboard">لوحتي</span>
      </a>
      <a href="requests.html">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.8 19.8 0 01-8.63-3.07 19.5 19.5 0 01-6-6A19.8 19.8 0 012.12 4.18 2 2 0 014.11 2h3a2 2 0 012 1.72c.13.99.36 1.96.68 2.9a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.18-1.18a2 2 0 012.11-.45c.94.32 1.91.55 2.9.68A2 2 0 0122 16.92z"/></svg>
        <span data-i18n="sidebar.requests">طلبات الاستشارة</span>
      </a>
      <a href="schedule.html">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 10h18"/></svg>
        <span data-i18n="sidebar.schedule">أوقات العمل</span>
      </a>
      <a href="patient-notes.html">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12h6M9 16h6M9 8h6M5 3h11l3 3v15H5z"/></svg>
        <span data-i18n="sidebar.patients">المرضي</span>
      </a>
      <a href="chat.html" class="active">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.5 8.5 0 01-12.3 7.6L3 20l1-5.6A8.5 8.5 0 1121 11.5z"/></svg>
        <span data-i18n="sidebar.chat">الدردشة</span>
      </a>
      <a href="profile.html">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0116 0"/></svg>
        <span data-i18n="sidebar.profile">الملف الشخصي</span>
      </a>
      <a href="../../index.html" style="margin-top:16px; border-top:1px solid var(--border); padding-top:16px;">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4M16 17l5-5-5-5M21 12H9"/></svg>
        <span data-i18n="sidebar.logout">تسجيل الخروج</span>
      </a>
    </nav>
  </aside>

  <main class="dash-main">
    <button class="dash-toggle" type="button" aria-expanded="false" aria-controls="dashSidebar">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M3 12h18M3 18h18"/></svg>
      <span data-i18n="sidebar.menu">القائمة</span>
    </button>
    <div class="dash-head">
      <div><h1>الدردشة</h1><p>محادثاتك مع المرضى الذين قبلت طلباتهم — تُنشأ تلقائيًا عند القبول.</p></div>
    </div>

    <div class="chat-layout">
      <div class="chat-conv-list" id="convList"></div>
      <div class="chat-panel" id="chatPanel">
        <div class="chat-empty">اختر محادثة من القائمة لعرض الرسائل.</div>
      </div>
    </div>
  </main>
</div>

<script src="../../assets/js/main.js"></script>
<script>
  (function () {
    const therapistId = Store.getCurrentTherapistId();
    const convList = document.getElementById('convList');
    const chatPanel = document.getElementById('chatPanel');
    let activeSessionId = null;

    function renderConvList() {
      const sessions = Store.getAcceptedSessionsForTherapist(therapistId);
      convList.innerHTML = '';
      if (sessions.length === 0) {
        convList.innerHTML = '<div class="chat-empty">لا توجد محادثات بعد. اقبل طلب استشارة من صفحة "طلبات الاستشارة" لتبدأ محادثة تلقائيًا.</div>';
        return;
      }
      sessions.forEach((s) => {
        const messages = Store.getMessages(s.id);
        const last = messages[messages.length - 1];
        const item = document.createElement('div');
        item.className = 'chat-conv-item' + (s.id === activeSessionId ? ' active' : '');
        item.dataset.id = s.id;
        item.innerHTML =
          '<div class="avatar">' + (s.patient ? s.patient.initials : 'ط') + '</div>' +
          '<div><b>' + (s.patient ? s.patient.name : 'مستخدم') + '</b>' +
          '<span>' + (last ? last.text.slice(0, 26) + (last.text.length > 26 ? '…' : '') : 'ابدأ المحادثة الآن') + '</span></div>';
        item.addEventListener('click', () => openConversation(s));
        convList.appendChild(item);
      });
      // auto-open the first conversation if none selected yet
      if (!activeSessionId && sessions.length > 0) openConversation(sessions[0]);
    }

    function openConversation(session) {
      activeSessionId = session.id;
      convList.querySelectorAll('.chat-conv-item').forEach((el) => {
        el.classList.toggle('active', el.dataset.id === session.id);
      });
      renderChatPanel(session);
    }

    function renderChatPanel(session) {
      const patientName = session.patient ? session.patient.name : 'مستخدم';
      const initials = session.patient ? session.patient.initials : 'ط';
      chatPanel.innerHTML =
        '<div class="chat-panel-head"><div class="avatar">' + initials + '</div>' +
        '<div><b>' + patientName + '</b><span>' + session.topic + '</span></div></div>' +
        '<div class="chat-messages" id="chatMessages"></div>' +
        '<div class="chat-input-row">' +
        '<input type="text" id="chatInput" placeholder="اكتب رسالتك هنا…">' +
        '<button class="btn btn-primary" id="chatSendBtn">إرسال</button>' +
        '</div>';

      renderMessages(session.id);

      document.getElementById('chatSendBtn').addEventListener('click', () => sendCurrentMessage(session.id));
      document.getElementById('chatInput').addEventListener('keydown', (e) => {
        if (e.key === 'Enter') sendCurrentMessage(session.id);
      });
    }

    function renderMessages(sessionId) {
      const messagesEl = document.getElementById('chatMessages');
      const messages = Store.getMessages(sessionId);
      messagesEl.innerHTML = '';
      if (messages.length === 0) {
        messagesEl.innerHTML = '<div class="chat-empty">لا توجد رسائل بعد — ابدأ المحادثة!</div>';
        return;
      }
      messages.forEach((m) => {
        const bubble = document.createElement('div');
        bubble.className = 'chat-bubble ' + (m.sender === 'therapist' ? 'me' : 'them');
        bubble.innerHTML = escapeHtml(m.text) + '<time>' + m.time + '</time>';
        messagesEl.appendChild(bubble);
      });
      messagesEl.scrollTop = messagesEl.scrollHeight;
    }

    function sendCurrentMessage(sessionId) {
      const input = document.getElementById('chatInput');
      const text = input.value.trim();
      if (!text) return;
      Store.sendMessage(sessionId, 'therapist', text);
      input.value = '';
      renderMessages(sessionId);
      renderConvList();
      convList.querySelectorAll('.chat-conv-item').forEach((el) => {
        el.classList.toggle('active', el.dataset.id === sessionId);
      });
    }

    function escapeHtml(str) {
      const div = document.createElement('div');
      div.textContent = str;
      return div.innerHTML;
    }

    renderConvList();
  })();
</script>
</body>
</html>
