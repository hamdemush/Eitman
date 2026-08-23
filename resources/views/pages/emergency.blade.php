<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>حالات الطوارئ | إطمئن</title>
  <link rel="icon" type="image/png" href="../assets/images/favicon.png">

  <link rel="stylesheet" href="../assets/css/variables.css">
  <link rel="stylesheet" href="../assets/css/base.css">
  <link rel="stylesheet" href="../assets/css/components.css">
  <link rel="stylesheet" href="../assets/css/layout.css">

  <script src="../assets/js/theme-switcher.js"></script>
  <script src="../assets/js/translations.js"></script>
  <script src="../assets/js/i18n.js"></script>
</head>
<body>

<header class="site-header">
  <div class="container">
    <a href="../index.html" class="logo"><img src="../assets/images/logo-icon.png" alt="إطمئن" class="logo-mark"> إطمئن</a>
    <nav class="main-nav">
      <a href="../index.html" data-i18n="nav.home">الرئيسية</a>
      <a href="specialists.html" data-i18n="nav.specialists">ابحث عن معالج</a>
      <a href="articles.html" data-i18n="nav.articles">المقالات</a>
      <a href="about.html" data-i18n="nav.about">معلومات عنا</a>
      <a href="emergency.html" class="active" data-i18n="nav.emergency">حالات الطوارئ</a>
    </nav>
    <div class="header-actions">
      <a href="login.html" class="link-muted" data-i18n="nav.login">تسجيل الدخول</a>
      <div class="toggle-group">
        <button class="icon-btn theme-toggle-btn" type="button" aria-label="تبديل الوضع الليلي/النهاري">
          <svg class="icon-moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.8A9 9 0 1111.2 3 7 7 0 0021 12.8z"/></svg>
          <svg class="icon-sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/></svg>
        </button>
        <button class="icon-btn lang-toggle-btn" type="button" aria-label="Change language">
          <span class="lang-toggle-label">EN</span>
        </button>
      </div>
    </div>
  </div>
</header>

<section class="page-hero page-hero-photo" style="background-image: linear-gradient(160deg, rgba(15,53,50,.90), rgba(10,38,36,.88)), url('../assets/images/lonely-under-tree.jpg');">
  <div class="container">
    <span class="badge" style="background:var(--brand-danger-bg, #FDECEC); color:#B03434; border-color:#F3C9C9;">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><path d="M12 9v4M12 17h.01"/></svg>
      دعم فوري على مدار الساعة
    </span>
    <h1 data-i18n="emergency.title">هل تمر بحالة طارئة؟</h1>
    <p data-i18n="emergency.subtitle">إذا كنت تفكر بإيذاء نفسك أو غيرك، الرجاء التواصل فورًا مع أحد خطوط المساندة أدناه أو التوجه لأقرب غرفة طوارئ.</p>
  </div>
</section>

<section class="section" style="padding-top:30px;">
  <div class="container" style="max-width:820px;">

    <!-- Immediate action card -->
    <div class="question-card" style="background:#FDECEC; border-color:#F3C9C9; margin-bottom:24px;">
      <h3 style="color:#9A2B2B;">إذا كانت حياتك أو حياة شخص آخر في خطر الآن</h3>
      <p style="margin-bottom:20px;">اتصل فورًا بالدفاع المدني / الإسعاف في بلدك، أو توجّه إلى أقرب قسم طوارئ في أقرب مستشفى. لا تنتظر حجز موعد على المنصة.</p>
      <a href="tel:911" class="btn btn-block" style="background:#C23B3B; color:#fff;">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.8 19.8 0 01-8.63-3.07 19.5 19.5 0 01-6-6A19.8 19.8 0 012.12 4.18 2 2 0 014.11 2h3a2 2 0 012 1.72c.13.99.36 1.96.68 2.9a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.18-1.18a2 2 0 012.11-.45c.94.32 1.91.55 2.9.68A2 2 0 0122 16.92z"/></svg>
        اتصال بخط الطوارئ الوطني
      </a>
    </div>

    <!-- Support hotlines -->
    <div class="question-card" style="margin-bottom:24px;">
      <h3 style="margin-bottom:18px;">خطوط الدعم النفسي</h3>

      <div class="session-item">
        <div class="avatar" style="background:var(--mint-100); color:var(--teal-700);">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.8 19.8 0 01-8.63-3.07 19.5 19.5 0 01-6-6A19.8 19.8 0 012.12 4.18 2 2 0 014.11 2h3a2 2 0 012 1.72c.13.99.36 1.96.68 2.9a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.18-1.18a2 2 0 012.11-.45c.94.32 1.91.55 2.9.68A2 2 0 0122 16.92z"/></svg>
        </div>
        <div style="flex:1;">
          <b>خط الإسناد النفسي للمرضى</b>
          <span>متاح 24/7 — رقم تجريبي يُستبدل برقم الجهة الرسمية عند الإطلاق</span>
        </div>
        <span class="pill upcoming">24/7</span>
      </div>

      <div class="session-item">
        <div class="avatar" style="background:var(--mint-100); color:var(--teal-700);">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg>
        </div>
        <div style="flex:1;">
          <b>الدردشة النصية الطارئة عبر إطمئن</b>
          <span>تواصل فوري مع أخصائي مناوب داخل المنصة</span>
        </div>
        <a href="patient/chat.html" class="btn btn-primary btn-sm">ابدأ الدردشة</a>
      </div>

      <div class="session-item">
        <div class="avatar" style="background:var(--mint-100); color:var(--teal-700);">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4.5 8-11.8A8 8 0 004 10.2C4 17.5 12 22 12 22z"/></svg>
        </div>
        <div style="flex:1;">
          <b>عيادة الإرشاد النفسي بالجامعة</b>
          <span>للمرضى المسجّلين — تنسيق موعد حضوري سريع</span>
        </div>
      </div>
    </div>

    <div class="question-card" style="background:var(--lav-100); border-color:var(--lav-200);">
      <h4 style="margin-bottom:10px;">ملاحظة لفريق التطوير (Back-end)</h4>
      <p style="font-size:13.5px;">أرقام الطوارئ أعلاه نائبة (placeholder) لأغراض العرض فقط. عند الربط مع الخلفية، يجب استبدالها بأرقام رسمية معتمدة حسب الدولة/الجامعة، ويفضّل جلبها من إعدادات النظام لا كتابتها مباشرة في HTML.</p>
    </div>

  </div>
</section>
<footer class="site-footer">
  <div class="container footer-row">
  
    <div class="footer-links">
      <a href="privacy.html" data-i18n="footer.privacy">سياسة الخصوصية</a>
      <a href="terms.html" data-i18n="footer.terms">شروط الخدمة</a>
      <a href="emergency.html" data-i18n="footer.support">تواصل مع الدعم</a>
      <a href="#" data-i18n="footer.careers" title="قريبًا" onclick="event.preventDefault();">الوظائف</a>
    </div>
    <div class="footer-brand">
      <b>Etma'en | إطمئن</b><br>
      <span data-i18n="footer.rights">© 2024 إطمئن. ملاذك الآمن.</span>
    </div>
  </div>
</footer>


<script src="../assets/js/main.js"></script>
</body>
</html>
