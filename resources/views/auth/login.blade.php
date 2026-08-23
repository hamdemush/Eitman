<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>تسجيل الدخول | إطمئن</title>
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
      <a href="emergency.html" data-i18n="nav.emergency">حالات الطوارئ</a>
    </nav>
    <div class="header-actions">
      <a href="register.html" class="btn btn-primary btn-sm" data-i18n="nav.start">إنشاء حساب</a>
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

<!-- =========================================================
     LOGIN - split screen: brand panel (right) + form (left)
     ========================================================= -->
<div class="auth-wrap">

  <div class="auth-side" style="background-image: linear-gradient(160deg, rgba(15,105,95,.87), rgba(10,38,36,.92)), url('../assets/images/abstract-waves-bg.png'); background-size: cover; background-position: center;">
    <span class="badge" style="background:rgba(255,255,255,.12); color:#fff; border-color:rgba(255,255,255,.2);">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4"/><circle cx="12" cy="12" r="10"/></svg>
      <span data-i18n="login.welcomeBadge">أهلاً بعودتك</span>
    </span>
    <h2 data-i18n="login.sideTitle">مساحتك الآمنة للحديث بحرية لا تزال بانتظارك.</h2>
    <p data-i18n="login.sideDesc">سجّل دخولك لمتابعة جلساتك، والتواصل مع معالجك، ومتابعة تقدمك النفسي في أي وقت.</p>
    <div class="auth-badges">
      <div class="auth-badge">
        <div class="ico"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="11" width="14" height="9" rx="2"/><path d="M8 11V7a4 4 0 018 0v4"/></svg></div>
        <div><b data-i18n="home.privacyTitle">خصوصية تامة</b><span>بياناتك مشفرة ولا تُشارك مع أي طرف</span></div>
      </div>
      <div class="auth-badge">
        <div class="ico"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0116 0"/></svg></div>
        <div><b>وضع الاستخدام المجهول</b><span>تحدث باسم مستعار متى أردت</span></div>
      </div>
    </div>
  </div>

  <div class="auth-form-side">
    <div class="auth-card">
      <h1 data-i18n="login.title">تسجيل الدخول</h1>
      <p data-i18n="login.subtitle">سعداء بعودتك. أدخل بياناتك للمتابعة.</p>

      <!-- NOTE: this form is a front-end mockup. In the real project it will
           POST to the authentication endpoint of the back-end team, which
           should respond with the user's role (student/therapist/admin)
           so the front-end can redirect to the matching dashboard. -->
      <form onsubmit="event.preventDefault(); window.location.href='patient/dashboard.html';">
        <div class="field">
          <label for="email" data-i18n="login.emailLabel">البريد الإلكتروني </label>
          <input type="email" id="email" name="email" placeholder="name@university.edu" required>
        </div>
        <div class="field">
          <label for="password" data-i18n="login.passwordLabel">كلمة المرور</label>
          <input type="password" id="password" name="password" placeholder="••••••••" required>
        </div>
        <div class="checkbox-row" style="justify-content:space-between;">
          <label style="display:flex; align-items:center; gap:8px;"><input type="checkbox" style="accent-color:#1B5850;"> <span data-i18n="login.remember">تذكرني</span></label>
          <a href="forgot-password.html" style="color:var(--teal-700); font-weight:800;" data-i18n="login.forgot">نسيت كلمة المرور؟</a>
        </div>
        <button type="submit" class="btn btn-primary btn-block" data-i18n="login.submit">تسجيل الدخول</button>
      </form>

      <div class="divider-or" data-i18n="login.or">أو</div>
      <div class="field-row">
        <button class="btn btn-ghost btn-block btn-sm" type="button" data-i18n="login.asDoctor" onclick="window.location.href='doctor/dashboard.html'">حساب معالج</button>
        <button class="btn btn-ghost btn-block btn-sm" type="button" data-i18n="login.asAdmin" onclick="window.location.href='admin/dashboard.html'">حساب مدير</button>
      </div>

      <p class="form-foot"><span data-i18n="login.noAccount">ليس لديك حساب؟</span> <a href="register.html" data-i18n="login.createAccount">أنشئ حسابًا جديدًا</a></p>
    </div>
  </div>

</div>
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
