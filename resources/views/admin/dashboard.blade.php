<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>لوحة المدير | إطمئن</title>
  <link rel="icon" type="image/png" href="../../assets/images/favicon.png">

  <link rel="stylesheet" href="../../assets/css/variables.css">
  <link rel="stylesheet" href="../../assets/css/base.css">
  <link rel="stylesheet" href="../../assets/css/components.css">
  <link rel="stylesheet" href="../../assets/css/layout.css">

  <script src="../../assets/js/theme-switcher.js"></script>
  <script src="../../assets/js/translations.js"></script>
  <script src="../../assets/js/i18n.js"></script>
</head>
<body>

<header class="site-header">
  <div class="container">
    <a href="../../index.html" class="logo"><img src="../../assets/images/logo-icon.png" alt="إطمئن" class="logo-mark"> إطمئن</a>
    <nav class="main-nav"><span style="font-weight:800; color:var(--teal-700); font-size:14px;">بوابة الإدارة</span></nav>
    <div class="header-actions">
      <div class="toggle-group">
        <button class="icon-btn theme-toggle-btn" type="button" aria-label="تبديل الوضع الليلي/النهاري">
          <svg class="icon-moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.8A9 9 0 1111.2 3 7 7 0 0021 12.8z"/></svg>
          <svg class="icon-sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/></svg>
        </button>
        <button class="icon-btn lang-toggle-btn" type="button" aria-label="Change language"><span class="lang-toggle-label">EN</span></button>
      </div>
      <div class="avatar" style="width:40px;height:40px;font-size:13px;">أد</div>
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
      <div class="avatar">أد</div>
      <div><b>مدير المنصة</b><span>صلاحيات كاملة</span></div>
    </div>
    <nav class="dash-nav">
      <a href="dashboard.html" class="active">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9" rx="1"/><rect x="14" y="3" width="7" height="5" rx="1"/><rect x="14" y="12" width="7" height="9" rx="1"/><rect x="3" y="16" width="7" height="5" rx="1"/></svg>
        <span data-i18n="sidebar.dashboard">لوحتي</span>
      </a>
      <a href="therapists.html">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4"/><circle cx="12" cy="12" r="10"/></svg>
        <span data-i18n="sidebar.therapistApprovals">اعتماد المعالجين</span>
      </a>
      <a href="users.html">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
        <span data-i18n="sidebar.users">إدارة المستخدمين</span>
      </a>
      <a href="specialties.html">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2a5 5 0 00-5 5v1.1A4 4 0 003 12a4 4 0 002 3.46V17a3 3 0 003 3h1"/><path d="M12 2a5 5 0 015 5v1.1A4 4 0 0121 12a4 4 0 01-2 3.46V17a3 3 0 01-3 3h-1"/></svg>
        <span data-i18n="sidebar.specialties">التخصصات</span>
      </a>
      <a href="complaints.html">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><path d="M12 9v4M12 17h.01"/></svg>
        <span data-i18n="sidebar.complaints">الشكاوى والتقارير</span>
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
      <div>
        <h1>لوحة تحكم المدير</h1>
        <p>نظرة عامة على أداء المنصة اليوم.</p>
      </div>
    </div>

    <div class="stat-cards">
      <div class="stat-card">
        <div class="ico"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></svg></div>
        <b>1,248</b><span>مريض مسجّل</span>
      </div>
      <div class="stat-card">
        <div class="ico"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4"/><circle cx="12" cy="12" r="10"/></svg></div>
        <b>42</b><span>معالج معتمد</span>
      </div>
      <div class="stat-card">
        <div class="ico"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 10h18"/></svg></div>
        <b>326</b><span>جلسة هذا الشهر</span>
      </div>
      <div class="stat-card">
        <div class="ico"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><path d="M12 9v4M12 17h.01"/></svg></div>
        <b>3</b><span>شكاوى مفتوحة</span>
      </div>
    </div>

    <div class="dash-grid">
      <div>
        <div class="panel">
          <h3>طلبات اعتماد معالجين جدد</h3>
          <div class="session-item">
            <div class="avatar">ع.ر</div>
            <div style="flex:1;"><b>د. أحمد صقر</b><span>إرشاد أسري — قدّمت طلبها منذ يومين</span></div>
            <span class="pill pending">قيد المراجعة</span>
          </div>
          <div class="session-item">
            <div class="avatar">ف.ن</div>
            <div style="flex:1;"><b>د. خالد الجرجاوي</b><span>طب نفسي عام — قدّم طلبه منذ 4 أيام</span></div>
            <span class="pill pending">قيد المراجعة</span>
          </div>
          <a href="therapists.html" class="link-arrow" style="margin-top:14px;">عرض جميع الطلبات
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l-6 6 6 6"/></svg>
          </a>
        </div>

        <div class="panel">
          <h3>أحدث الشكاوى</h3>
          <div class="session-item">
            <div class="avatar">ط</div>
            <div style="flex:1;"><b>تأخر المعالج عن الموعد</b><span>بلاغ من مريض مجهول — منذ يوم</span></div>
            <span class="pill open">مفتوحة</span>
          </div>
          <div class="session-item">
            <div class="avatar">ط</div>
            <div style="flex:1;"><b>مشكلة تقنية في الدفع</b><span>بلاغ من خليل أبو رمضان — منذ 3 أيام</span></div>
            <span class="pill resolved">تم الحل</span>
          </div>
          <a href="complaints.html" class="link-arrow" style="margin-top:14px;">عرض جميع الشكاوى
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l-6 6 6 6"/></svg>
          </a>
        </div>
      </div>

      <div>
        <div class="panel">
          <h3>الجلسات — آخر 6 أسابيع</h3>
          <div class="mood-chart">
            <div class="bar-wrap"><div class="bar" style="height:40%;"></div><span>أسبوع 1</span></div>
            <div class="bar-wrap"><div class="bar" style="height:55%;"></div><span>أسبوع 2</span></div>
            <div class="bar-wrap"><div class="bar" style="height:48%;"></div><span>أسبوع 3</span></div>
            <div class="bar-wrap"><div class="bar" style="height:70%;"></div><span>أسبوع 4</span></div>
            <div class="bar-wrap"><div class="bar" style="height:82%;"></div><span>أسبوع 5</span></div>
            <div class="bar-wrap"><div class="bar" style="height:90%;"></div><span>أسبوع 6</span></div>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>

<script src="../../assets/js/main.js"></script>
</body>
</html>
