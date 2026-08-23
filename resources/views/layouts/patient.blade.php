<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'بوابة المريض | إطمئن')</title>

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
      <a href="{{ url('/') }}" data-i18n="nav.home">الرئيسية</a>
      <a href="{{ url('/specialists') }}" data-i18n="nav.specialists">ابحث عن معالج</a>
      <a href="{{ url('/articles') }}" data-i18n="nav.articles">المقالات</a>
      <a href="{{ url('/about') }}" data-i18n="nav.about">معلومات عنا</a>
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
      <div>
        <b>خليل أبو رمضان</b>
        <span>الجامعة الأردنية</span>
      </div>
    </div>
    <nav class="dash-nav">
      <a href="{{ url('/patient/dashboard') }}" class="{{ request()->is('patient/dashboard') ? 'active' : '' }}">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9" rx="1"/><rect x="14" y="3" width="7" height="5" rx="1"/><rect x="14" y="12" width="7" height="9" rx="1"/><rect x="3" y="16" width="7" height="5" rx="1"/></svg>
        <span data-i18n="sidebar.dashboard">لوحتي</span>
      </a>
      <a href="{{ url('/patient/sessions') }}" class="{{ request()->is('patient/sessions*') ? 'active' : '' }}">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 10h18"/></svg>
        <span data-i18n="sidebar.mySessions">جلساتي</span>
      </a>
      <a href="{{ url('/patient/chat') }}" class="{{ request()->is('patient/chat*') ? 'active' : '' }}">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.5 8.5 0 01-12.3 7.6L3 20l1-5.6A8.5 8.5 0 1121 11.5z"/></svg>
        <span data-i18n="sidebar.chat">الدردشة</span>
      </a>
      <a href="{{ url('/patient/progress') }}" class="{{ request()->is('patient/progress*') ? 'active' : '' }}">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18M7 15l4-5 3 3 5-6"/></svg>
        <span data-i18n="sidebar.myProgress">تقدمي النفسي</span>
      </a>
      <a href="{{ url('/patient/settings') }}" class="{{ request()->is('patient/settings*') ? 'active' : '' }}">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="11" width="14" height="9" rx="2"/><path d="M8 11V7a4 4 0 018 0v4"/></svg>
        <span data-i18n="sidebar.privacy">الخصوصية والوضع المجهول</span>
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
@stack('scripts')
</body>
</html>