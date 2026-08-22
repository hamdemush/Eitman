<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>إطمئن | منصة الاستشارات النفسية  </title>
  <link rel="icon" type="image/png" href="assets/images/favicon.png">
  <meta name="description" content="منصة إطمئن تقدم استشارات نفسية عن بُعد مع نظام مطابقة ذكي ووضع استخدام مجهول.">

  <!-- Stylesheets: loaded in order - tokens, then base reset, then components, then page layout -->
  <link rel="stylesheet" href="assets/css/variables.css">
  <link rel="stylesheet" href="assets/css/base.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <link rel="stylesheet" href="assets/css/layout.css">

  <!-- Loaded in <head> (not deferred) on purpose: these two scripts set the
       data-theme and lang/dir attributes on <html> BEFORE the page paints,
       so there is no flash of the wrong theme/language on load. -->
  <script src="assets/js/theme-switcher.js"></script>
  <script src="assets/js/translations.js"></script>
  <script src="assets/js/i18n.js"></script>
</head>
<body>

<!-- =========================================================
     HEADER / PRIMARY NAVIGATION
     ========================================================= -->
<header class="site-header">
  <div class="container">
    <a href="/" class="logo"><img src="assets/images/logo-icon.png" alt="إطمئن" class="logo-mark"> إطمئن</a>

    <nav class="main-nav">
      <a href="/" class="active" data-i18n="nav.home">الرئيسية</a>
      <a href="/pages/specialists.html" data-i18n="nav.specialists">ابحث عن معالج</a>
      <a href="/pages/articles.html" data-i18n="nav.articles">المقالات</a>
      <a href="/pages/about.html" data-i18n="nav.about">معلومات عنا</a>
      <a href="/pages/emergency.html" data-i18n="nav.emergency">حالات الطوارئ</a>
    </nav>

    <div class="header-actions">
      <a href="/pages/login.html" class="link-muted" data-i18n="nav.login">تسجيل الدخول</a>
      <a href="/pages/register.html" class="btn btn-primary btn-sm" data-i18n="nav.start">ابدأ الآن</a>
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

<!-- =========================================================
     HERO SECTION
     ========================================================= -->
<section class="hero">
  <div class="container">

    <!-- Illustration: calm meditation-in-the-forest artwork. -->
    <div class="hero-visual">
      <img src="assets/images/meditation-river.jpg" alt="شخص يتأمل بهدوء وسط أشجار الغابة" style="width:100%; height:100%; object-fit:cover; display:block;">
    </div>

    <div class="hero-copy">
      <span class="badge">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4"/><circle cx="12" cy="12" r="10"/></svg>
        <span data-i18n="home.badge">شريكك الموثوق في الصحة النفسية</span>
      </span>
      <h1><span data-i18n="home.heroTitle">رحلة الهدوء تبدأ</span> <span data-i18n="home.heroTitleHighlight">من هنا.</span></h1>
      <p data-i18n="home.heroDesc">منصة "إطمئن" توفر لك مساحة آمنة وخصوصية تامة للتواصل مع نخبة من المعالجين النفسيين المختصين لمساعدتك في تخطي تحدياتك النفسية وتحقيق السلام الداخلي.</p>
      <div class="hero-actions">
        <a href="/pages/assessment.html" class="btn btn-primary">
          <span data-i18n="btn.bookSession">احجز جلستك الأولى</span>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 6l-6 6 6 6"/></svg>
        </a>
        <a href="#how" class="btn btn-ghost" data-i18n="btn.howItWorks">كيف نعمل؟</a>
      </div>
    </div>

  </div>
</section>

<!-- =========================================================
     FEATURES SECTION
     ========================================================= -->
<section class="section">
  <div class="container">
    <div class="section-head">
      <h2 data-i18n="home.featuresTitle">ميزات تجعل تجربتك فريدة</h2>
      <p data-i18n="home.featuresDesc">نحن نؤمن بأن الصحة النفسية يجب أن تكون متاحة، سرية، ومدعومة بأحدث التقنيات.</p>
    </div>

    <div class="feature-grid">

      <!-- Privacy feature (tall card, left column) -->
      <div class="feature-card light">
        <div>
          <div class="ico">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3l18 18M10.6 10.6a2 2 0 002.8 2.8M9.5 5.4A10.6 10.6 0 0112 5c6 0 10 6 10 6a17.7 17.7 0 01-3.2 3.9M6.6 6.6C4 8.4 2 11 2 11s4 7 10 7c1.2 0 2.3-.2 3.4-.6"/></svg>
          </div>
          <h3 data-i18n="home.privacyTitle">خصوصية تامة</h3>
          <p data-i18n="home.privacyDesc">يمكنك التحدث بهوية مجهولة تماماً. بياناتك مشفرة ولا يتم مشاركتها مع أي جهة خارجية.</p>
        </div>
        <div class="privacy-shot">
          <svg width="46" height="46" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="5" y="11" width="14" height="9" rx="2"/><path d="M8 11V7a4 4 0 018 0v4"/></svg>
        </div>
      </div>

      <!-- Smart matching + progress tracking (stacked, right column) -->
      <div class="feature-stack">
        <div class="feature-card dark">
          <div class="ico">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2a5 5 0 00-5 5v1.1A4 4 0 003 12a4 4 0 002 3.46V17a3 3 0 003 3h1"/><path d="M12 2a5 5 0 015 5v1.1A4 4 0 0121 12a4 4 0 01-2 3.46V17a3 3 0 01-3 3h-1"/><path d="M12 22v-6M9 13h6"/></svg>
          </div>
          <h3 data-i18n="home.matchingTitle">مطابقة ذكية للخبراء</h3>
          <p data-i18n="home.matchingDesc">نستخدم خوارزميات متطورة لربطك بالمعالج الأنسب لحالتك بناءً على اهتماماتك واحتياجاتك الخاصة.</p>
        </div>
        <div class="feature-card mint">
          <div class="ico">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18M7 15l4-5 3 3 5-6"/></svg>
          </div>
          <h3 data-i18n="home.progressTitle">تتبع التقدم</h3>
          <p data-i18n="home.progressDesc">راقب تطور حالتك النفسية من خلال أدوات تتبع الحالة المزاجية والتقارير الدورية التي يقدمها المعالج.</p>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- =========================================================
     HOW IT WORKS SECTION
     ========================================================= -->
<section class="section" id="how" style="background:#fff; border-top:1px solid var(--border); border-bottom:1px solid var(--border);">
  <div class="container">
    <div class="section-head">
      <h2 data-i18n="home.howTitle">كيف تبدأ رحلتك؟</h2>
    </div>
    <div class="steps">
      <div class="step">
        <div class="num-ico"><svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="8" r="4"/><path d="M2 21a7 7 0 0114 0M18 8l2 2 4-4"/></svg></div>
        <h4 data-i18n="home.step1Title">1. إنشاء حساب</h4>
        <p data-i18n="home.step1Desc">سجّل بياناتك الأساسية واهتماماتك النفسية في أقل من دقيقتين.</p>
      </div>
      <div class="step">
        <div class="num-ico"><svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12h6M9 16h6M9 8h6M5 3h11l3 3v15H5z"/></svg></div>
        <h4 data-i18n="home.step2Title">2. ملء الاستبيان</h4>
        <p data-i18n="home.step2Desc">أجب على بعض الأسئلة لنفهم حالتك ونرشح لك المعالج المثالي.</p>
      </div>
      <div class="step">
        <div class="num-ico"><svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 10h18"/></svg></div>
        <h4 data-i18n="home.step3Title">3. حجز الجلسة</h4>
        <p data-i18n="home.step3Desc">اختر الموعد الذي يناسبك من بين المواعيد المتاحة.</p>
      </div>
      <div class="step">
        <div class="num-ico"><svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.5 8.5 0 01-12.3 7.6L3 20l1-5.6A8.5 8.5 0 1121 11.5z"/></svg></div>
        <h4 data-i18n="home.step4Title">4. ابدأ التحدث</h4>
        <p data-i18n="home.step4Desc">تواصل مع معالجك عبر الفيديو، الصوت أو المحادثة النصية.</p>
      </div>
    </div>
  </div>
</section>

<!-- =========================================================
     FEATURED SPECIALISTS SECTION
     ========================================================= -->
<section class="section">
  <div class="container">
    <div class="section-head-row">
      <div>
        <h2 data-i18n="home.specialistsTitle">خبراء مستعدون لمساعدتك</h2>
        <p data-i18n="home.specialistsDesc">نخبة من الأطباء والمعالجين النفسيين المرخصين.</p>
      </div>
      <a href="pages/specialists.html" class="link-arrow">
        <span data-i18n="btn.viewAll">عرض جميع المعالجين</span>
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l-6 6 6 6"/></svg>
      </a>
    </div>

    <div class="specialist-grid">

      <div class="specialist-card">
        <div class="specialist-top">
          <div class="specialist-id">
            <h4>د. نوة السعد</h4>
            <span class="role">أخصائية علاقات أسرية</span>
          </div>
          <div class="avatar">ن.س</div>
        </div>
        <div class="rating"><span class="stars">★★★★★</span> (210) 4.8</div>
        <p>تساعد في تحسين جودة العلاقات الاجتماعية وبناء المهارات الحياتية للشباب.</p>
        <a href="pages/specialist-profile.html" class="btn btn-ghost btn-block btn-sm" data-i18n="btn.viewProfile">عرض الملف الشخصي</a>
      </div>

      <div class="specialist-card">
        <div class="specialist-top">
          <div class="specialist-id">
            <h4>د. خميس الأسي</h4>
            <span class="role">استشاري الطب النفسي</span>
          </div>
          <div class="avatar">خ.ه</div>
        </div>
        <div class="rating"><span class="stars">★★★★★</span> (85) 5.0</div>
        <p>خبير في اضطرابات النوم والاكتئاب الموسمي، مع خبرة تزيد عن 15 عاماً.</p>
        <a href="pages/specialist-profile.html" class="btn btn-ghost btn-block btn-sm" data-i18n="btn.viewProfile">عرض الملف الشخصي</a>
      </div>

      <div class="specialist-card">
        <div class="specialist-top">
          <div class="specialist-id">
            <h4>د. روان الأسي</h4>
            <span class="role">أخصائية علاج سلوكي معرفي</span>
          </div>
          <div class="avatar">م.ع</div>
        </div>
        <div class="rating"><span class="stars">★★★★★</span> (120) 4.9</div>
        <p>متخصصة في علاج القلق والتوتر الدراسي لدى المرضى بأساليب حديثة ومبتكرة.</p>
        <a href="pages/specialist-profile.html" class="btn btn-ghost btn-block btn-sm" data-i18n="btn.viewProfile">عرض الملف الشخصي</a>
      </div>

    </div>
  </div>
</section>

<!-- =========================================================
     CALL TO ACTION BANNER
     ========================================================= -->
<section class="container" style="padding-bottom:80px;">
  <div class="cta-banner">
    <h2 data-i18n="home.ctaTitle">هل أنت مستعد لتغيير حياتك؟</h2>
    <p data-i18n="home.ctaDesc">انضم إلى آلاف المرضى الذين وجدوا راحتهم النفسية معنا. الجلسة الأولى مجانية  %.</p>
    <div class="cta-actions">
      <a href="pages/emergency.html" class="btn btn-outline-white" data-i18n="home.ctaTalk">تحدث الآن حالة طارئة</a>
      <a href="pages/register.html" class="btn btn-light" data-i18n="home.ctaRegister">سجل الآن</a>
    </div>
  </div>
</section>

<!-- =========================================================
     FOOTER
     ========================================================= -->
<footer class="site-footer">
  <div class="container footer-row">
  
    <div class="footer-links">
      <a href="pages/privacy.html" data-i18n="footer.privacy">سياسة الخصوصية</a>
      <a href="pages/terms.html" data-i18n="footer.terms">شروط الخدمة</a>
      <a href="pages/emergency.html" data-i18n="footer.support">تواصل مع الدعم</a>
      <a href="#" data-i18n="footer.careers" title="قريبًا" onclick="event.preventDefault();">الوظائف</a>
    </div>
    <div class="footer-brand">
      <b>Etma'en | إطمئن</b><br>
      <span data-i18n="footer.rights">© 2024 إطمئن. ملاذك الآمن.</span>
    </div>
  </div>
</footer>

<script src="assets/js/main.js"></script>
</body>
</html>
