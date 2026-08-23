<header class="site-header">
  <div class="container">
    <a href="{{ url('/') }}" class="logo">
      <img src="{{ asset('assets/images/logo-icon.png') }}" alt="إطمئن" class="logo-mark"> إطمئن
    </a>

    <nav class="main-nav">
      <a href="{{ url('/') }}" class="active" data-i18n="nav.home">الرئيسية</a>
      <a href="{{ url('/specialists') }}" data-i18n="nav.specialists">ابحث عن معالج</a>
      <a href="{{ url('/articles') }}" data-i18n="nav.articles">المقالات</a>
      <a href="{{ url('/about') }}" data-i18n="nav.about">معلومات عنا</a>
      <a href="{{ url('/emergency') }}" data-i18n="nav.emergency">حالات الطوارئ</a>
    </nav>

    <div class="header-actions">
      <a href="{{ url('/login') }}" class="link-muted" data-i18n="nav.login">تسجيل الدخول</a>
      <a href="{{ url('/register') }}" class="btn btn-primary btn-sm" data-i18n="nav.start">ابدأ الآن</a>

      <div class="toggle-group">
        <button class="icon-btn theme-toggle-btn" type="button" aria-label="تبديل الوضع الليلي/النهاري">
          <svg class="icon-moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.8A9 9 0 1111.2 3 7 7 0 0021 12.8z"/></svg>
          <svg class="icon-sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/></svg>
        </button>
        <button class="icon-btn lang-toggle-btn" type="button" aria-label="Change language">
          <span class="lang-toggle-label">EN</span>
        </button>
      </div>

      <button class="nav-toggle" aria-label="فتح القائمة">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M3 12h18M3 18h18"/></svg>
      </button>
    </div>
  </div>
</header>