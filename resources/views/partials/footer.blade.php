<footer class="site-footer">
  <div class="container footer-row">
    <div class="footer-links">
      <a href="{{ url('/privacy') }}" data-i18n="footer.privacy">سياسة الخصوصية</a>
      <a href="{{ url('/terms') }}" data-i18n="footer.terms">شروط الخدمة</a>
      <a href="{{ url('/emergency') }}" data-i18n="footer.support">تواصل مع الدعم</a>
      <a href="#" data-i18n="footer.careers" title="قريبًا" onclick="event.preventDefault();">الوظائف</a>
    </div>
    <div class="footer-brand">
      <b>Etma'en | إطمئن</b><br>
      <span data-i18n="footer.rights">© {{ date('Y') }} إطمئن. ملاذك الآمن.</span>
    </div>
  </div>
</footer>