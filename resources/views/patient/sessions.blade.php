<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>جلساتي | إطمئن</title>
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
    <nav class="main-nav">
      <a href="../../index.html" data-i18n="nav.home">الرئيسية</a>
      <a href="../specialists.html" data-i18n="nav.specialists">ابحث عن معالج</a>
      <a href="../articles.html" data-i18n="nav.articles">المقالات</a>
    </nav>
    <div class="header-actions">
      <div class="toggle-group">
        <button class="icon-btn theme-toggle-btn" type="button" aria-label="تبديل الوضع الليلي/النهاري">
          <svg class="icon-moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.8A9 9 0 1111.2 3 7 7 0 0021 12.8z"/></svg>
          <svg class="icon-sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/></svg>
        </button>
        <button class="icon-btn lang-toggle-btn" type="button" aria-label="Change language"><span class="lang-toggle-label">EN</span></button>
      </div>
      <div class="avatar" style="width:40px;height:40px;font-size:13px;">س.أ</div>
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
      <div class="avatar">س.أ</div>
      <div><b>خليل أبو رمضان</b><span>الجامعة الأردنية</span></div>
    </div>
    <nav class="dash-nav">
      <a href="dashboard.html">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9" rx="1"/><rect x="14" y="3" width="7" height="5" rx="1"/><rect x="14" y="12" width="7" height="9" rx="1"/><rect x="3" y="16" width="7" height="5" rx="1"/></svg>
        <span data-i18n="sidebar.dashboard">لوحتي</span>
      </a>
      
      <a href="sessions.html" class="active">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 10h18"/></svg>
        <span data-i18n="sidebar.mySessions">جلساتي</span>
      </a>
      <a href="chat.html">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.5 8.5 0 01-12.3 7.6L3 20l1-5.6A8.5 8.5 0 1121 11.5z"/></svg>
        <span data-i18n="sidebar.chat">الدردشة</span>
      </a>
      <a href="progress.html">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18M7 15l4-5 3 3 5-6"/></svg>
        <span data-i18n="sidebar.myProgress">تقدمي النفسي</span>
      </a>
      <a href="settings.html">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="11" width="14" height="9" rx="2"/><path d="M8 11V7a4 4 0 018 0v4"/></svg>
        <span data-i18n="sidebar.privacy">الخصوصية والوضع المجهول</span>
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
      <div><h1>جلساتي</h1><p>كل جلساتك القادمة والسابقة في مكان واحد.</p></div>
      <a href="../specialists.html" class="btn btn-primary btn-sm">حجز جلسة جديدة</a>
    </div>

    <div class="panel" id="pendingPanel" style="display:none;">
      <h3>طلبات بانتظار موافقة المعالج</h3>
      <div id="pendingList"></div>
    </div>

    <div class="panel">
      <h3>الجلسات القادمة</h3>
      <div id="upcomingList">
        <div class="session-item">
          <div class="avatar">م.ع</div>
          <div style="flex:1;"><b>د. روان الأسي</b><span>الأربعاء 9 يوليو 2025 — 12:00 ظهرًا — محادثة نصية</span></div>
          <span class="pill upcoming">قادمة</span>
          <a href="chat.html" class="btn btn-ghost btn-sm">فتح المحادثة</a>
        </div>
      </div>
    </div>

    <div class="panel">
      <h3>الجلسات السابقة</h3>
      <div class="session-item">
        <div class="avatar">م.ع</div>
        <div style="flex:1;"><b>د. روان الأسي</b><span>الأربعاء 2 يوليو 2025 — محادثة نصية</span></div>
        <span class="pill done">مكتملة</span>
      </div>
      <div class="session-item">
        <div class="avatar">م.ع</div>
        <div style="flex:1;"><b>د. روان الأسي</b><span>الأربعاء 25 يونيو 2025 — محادثة نصية</span></div>
        <span class="pill done">مكتملة</span>
      </div>
      <div class="session-item">
        <div class="avatar">م.ع</div>
        <div style="flex:1;"><b>د. روان الأسي</b><span>الأربعاء 18 يونيو 2025 — الجلسة الأولى (مجانية)</span></div>
        <span class="pill done">مكتملة</span>
      </div>
    </div>
  </main>
</div>

<script src="../../assets/js/main.js"></script>
<script>
  (function () {
    const patientId = Store.getCurrentPatientId();
    const sessions = Store.getSessionsForPatient(patientId);

    const pendingPanel = document.getElementById('pendingPanel');
    const pendingList = document.getElementById('pendingList');
    const upcomingList = document.getElementById('upcomingList');

    const pending = sessions.filter((s) => s.status === 'pending');
    if (pending.length > 0) {
      pendingPanel.style.display = 'block';
      pending.forEach((s) => {
        const item = document.createElement('div');
        item.className = 'session-item';
        item.innerHTML =
          '<div class="avatar">' + (s.therapist ? s.therapist.initials : 'م') + '</div>' +
          '<div style="flex:1;"><b>' + (s.therapist ? s.therapist.name : 'معالج') + '</b>' +
          '<span>' + s.topic + ' — بانتظار قبول المعالج</span></div>' +
          '<span class="pill pending">قيد المراجعة</span>';
        pendingList.appendChild(item);
      });
    }

    // any accepted session beyond the seeded demo one (e.g. created via booking.html)
    const accepted = sessions.filter((s) => s.status === 'accepted' && s.id !== 's-sara-1');
    accepted.forEach((s) => {
      const item = document.createElement('div');
      item.className = 'session-item';
      item.innerHTML =
        '<div class="avatar">' + (s.therapist ? s.therapist.initials : 'م') + '</div>' +
        '<div style="flex:1;"><b>' + (s.therapist ? s.therapist.name : 'معالج') + '</b>' +
        '<span>' + s.topic + ' — ' + (s.mode || 'محادثة نصية') + '</span></div>' +
        '<span class="pill upcoming">قادمة</span>' +
        '<a href="chat.html" class="btn btn-ghost btn-sm">فتح المحادثة</a>';
      upcomingList.appendChild(item);
    });
  })();
</script>
</body>
</html>
