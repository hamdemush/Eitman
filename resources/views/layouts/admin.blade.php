<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'لوحة التحكم | إطمئن')</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/layout.css') }}">

    <script src="{{ asset('assets/js/theme-switcher.js') }}"></script>
    <script src="{{ asset('assets/js/translations.js') }}"></script>
    <script src="{{ asset('assets/js/i18n.js') }}"></script>
    <script src="{{ asset('assets/js/store.js') }}"></script>
    @stack('styles')
</head>
<body>

<header class="site-header">
  <div class="container">
    <a href="{{ url('/') }}" class="logo">
      <img src="{{ asset('assets/images/logo-icon.png') }}" alt="إطمئن" class="logo-mark"> إطمئن
    </a>
    <nav class="main-nav">
      <span style="font-weight:800; color:var(--teal-700); font-size:14px;">بوابة الإدارة</span>
    </nav>
    <div class="header-actions">
      <div class="toggle-group">
        <button class="icon-btn theme-toggle-btn" type="button" aria-label="تبديل الوضع الليلي/النهاري">
          <svg class="icon-moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.8A9 9 0 1111.2 3 7 7 0 0021 12.8z"/></svg>
          <svg class="icon-sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/></svg>
        </button>
        <button class="icon-btn lang-toggle-btn" type="button" aria-label="Change language">
          <span class="lang-toggle-label">EN</span>
        </button>
      </div>
      <div class="avatar" id="header-admin-avatar" style="width:40px;height:40px;font-size:13px;">--</div>
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
      <div class="avatar" id="sidebar-admin-avatar">--</div>
      <div>
        <b id="sidebar-admin-name">جاري التحميل...</b>
        <span id="sidebar-admin-role">---</span>
      </div>
    </div>
    <nav class="dash-nav">
      <a href="{{ url('/admin/dashboard') }}" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9" rx="1"/><rect x="14" y="3" width="7" height="5" rx="1"/><rect x="14" y="12" width="7" height="9" rx="1"/><rect x="3" y="16" width="7" height="5" rx="1"/></svg>
        <span data-i18n="sidebar.dashboard">لوحتي</span>
      </a>
      <a href="{{ url('/admin/therapists') }}" class="{{ request()->is('admin/therapists*') ? 'active' : '' }}">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4"/><circle cx="12" cy="12" r="10"/></svg>
        <span data-i18n="sidebar.therapistApprovals">اعتماد المعالجين</span>
      </a>
      <a href="{{ url('/admin/users') }}" class="{{ request()->is('admin/users*') ? 'active' : '' }}">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
        <span data-i18n="sidebar.users">إدارة المستخدمين</span>
      </a>
      <a href="{{ url('/admin/specialties') }}" class="{{ request()->is('admin/specialties*') ? 'active' : '' }}">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2a5 5 0 00-5 5v1.1A4 4 0 003 12a4 4 0 002 3.46V17a3 3 0 003 3h1"/><path d="M12 2a5 5 0 015 5v1.1A4 4 0 0121 12a4 4 0 01-2 3.46V17a3 3 0 01-3 3h-1"/></svg>
        <span data-i18n="sidebar.specialties">التخصصات</span>
      </a>
      <a href="{{ url('/admin/complaints') }}" class="{{ request()->is('admin/complaints*') ? 'active' : '' }}">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><path d="M12 9v4M12 17h.01"/></svg>
        <span data-i18n="sidebar.complaints">الشكاوى والتقارير</span>
      </a>
      <a href="{{ url('/') }}" style="margin-top:16px; border-top:1px solid var(--border); padding-top:16px;">
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
    @yield('content')
  </main>
</div>

<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/js/admin-common.js') }}"></script>

@stack('scripts')
</body>
</html>