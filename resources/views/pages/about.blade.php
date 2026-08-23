@extends('layouts.app')

@section('title', 'معلومات عنا | إطمئن')

@section('content')
<section class="page-hero">
  <div class="container">
    <span class="badge">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4"/><circle cx="12" cy="12" r="10"/></svg>
      قصتنا
    </span>
    <h1 data-i18n="about.title">من نحن</h1>
    <p data-i18n="about.subtitle">منصة إطمئن هي مبادرة رقمية لدعم الصحة النفسية للمرضى والشباب.</p>
  </div>
</section>

<section class="section" style="padding-top:30px;">
  <div class="container" style="max-width:820px;">

    <div class="question-card" style="margin-bottom:24px;">
      <h3 style="margin-bottom:14px;">رسالتنا</h3>
      <p>نؤمن أن الصحة النفسية لا تقل أهمية عن الصحة الجسدية، وأن كثيرًا من المرضى يترددون في طلب المساعدة بسبب الحرج أو الخوف من الوصمة الاجتماعية أو صعوبة الوصول لأخصائي مناسب. إطمئن أُنشئت لإزالة هذه الحواجز، عبر مساحة إلكترونية آمنة وسرية تربط المريض بالمعالج الأنسب لحالته خلال دقائق.</p>
    </div>

    <img src="{{ asset('assets/images/calm-plants-corner.webp') }}" alt="ركن هادئ مليء بالنباتات يعكس روح الهدوء التي تقدمها إطمئن" style="width:100%; border-radius:var(--r-xl); margin-bottom:24px; display:block; box-shadow:var(--shadow-lg);">

    <div class="stat-cards" style="margin-bottom:24px;">
      <div class="stat-card">
        <div class="ico"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="11" width="14" height="9" rx="2"/><path d="M8 11V7a4 4 0 018 0v4"/></svg></div>
        <b>100٪</b><span>خصوصية وسرية</span>
      </div>
      <div class="stat-card">
        <div class="ico"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2a5 5 0 00-5 5v1.1A4 4 0 003 12a4 4 0 002 3.46V17a3 3 0 003 3h1"/><path d="M12 2a5 5 0 015 5v1.1A4 4 0 0121 12a4 4 0 01-2 3.46V17a3 3 0 01-3 3h-1"/></svg></div>
        <b>ذكاء اصطناعي</b><span>لمطابقة المعالج المناسب</span>
      </div>
      <div class="stat-card">
        <div class="ico"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0116 0"/></svg></div>
        <b>وضع مجهول</b><span>لتشجيع طلب المساعدة</span>
      </div>
      <div class="stat-card">
        <div class="ico"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18M7 15l4-5 3 3 5-6"/></svg></div>
        <b>متابعة دورية</b><span>لقياس التحسن النفسي</span>
      </div>
    </div>

    <div class="question-card" style="margin-bottom:24px;">
      <h3 style="margin-bottom:14px;">كيف نعمل</h3>
      <p>يجيب المريض على استبيان أولي قصير حول طبيعة ما يمر به، فيقوم نظام المطابقة الذكي بترشيح المعالج الأنسب من حيث التخصص والخبرة. تكون الجلسة الأولى مجانية دائمًا، وبعدها تصبح الجلسات مدفوعة عبر المنصة مع اقتطاع نسبة بسيطة لتغطية تكاليف التشغيل والصيانة، بينما تذهب النسبة الأكبر للمعالج مباشرة.</p>
    </div>

    <div class="question-card" style="background:var(--lav-100); border-color:var(--lav-200);">
      <h3 style="margin-bottom:10px;">مشروع تخرج</h3>
      <p style="font-size:13.5px;">هذا الموقع هو الواجهة الأمامية (Front-end) لمشروع تخرج جامعي، ومصمم ليكون جاهزًا للربط مع أي خلفية (Back-end) توفّر واجهات برمجية (APIs) للمصادقة، إدارة الحجوزات، والمحادثات.</p>
    </div>

  </div>
</section>
@endsection