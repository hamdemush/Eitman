@extends('layouts.patient')

@section('title', 'لوحتي | إطمئن')

@section('content')
<div class="dash-head">
  <div>
    <h1>أهلاً، سارة 👋</h1>
    <p>هذا ملخص رحلتك النفسية هذا الأسبوع.</p>
  </div>
  <a href="{{ url('/specialists') }}" class="btn btn-primary btn-sm">حجز جلسة جديدة</a>
</div>

<div class="stat-cards">
  <div class="stat-card">
    <div class="ico"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 10h18"/></svg></div>
    <b>6</b><span>جلسات مكتملة</span>
  </div>
  <div class="stat-card">
    <div class="ico"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg></div>
    <b>الأربعاء 12:00</b><span>موعد جلستك القادمة</span>
  </div>
  <div class="stat-card">
    <div class="ico"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18M7 15l4-5 3 3 5-6"/></svg></div>
    <b>+18٪</b><span>تحسّن في مؤشر الاطمئنان</span>
  </div>
  <div class="stat-card">
    <div class="ico"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="11" width="14" height="9" rx="2"/><path d="M8 11V7a4 4 0 018 0v4"/></svg></div>
    <b>مفعّل</b><span>الوضع المجهول</span>
  </div>
</div>

<div class="dash-grid">
  <div>
    <div class="panel">
      <h3>مؤشر حالتك المزاجية — آخر 6 أسابيع</h3>
      <div class="mood-chart">
        <div class="bar-wrap"><div class="bar" style="height:38%;"></div><span>أسبوع 1</span></div>
        <div class="bar-wrap"><div class="bar" style="height:45%;"></div><span>أسبوع 2</span></div>
        <div class="bar-wrap"><div class="bar" style="height:40%;"></div><span>أسبوع 3</span></div>
        <div class="bar-wrap"><div class="bar" style="height:60%;"></div><span>أسبوع 4</span></div>
        <div class="bar-wrap"><div class="bar" style="height:72%;"></div><span>أسبوع 5</span></div>
        <div class="bar-wrap"><div class="bar" style="height:80%;"></div><span>أسبوع 6</span></div>
      </div>
    </div>

    <div class="panel">
      <h3>سجل الجلسات</h3>
      <div class="session-item">
        <div class="avatar">م.ع</div>
        <div style="flex:1;"><b>د. روان الأسي</b><span>الأربعاء 9 يوليو — 12:00 ظهرًا</span></div>
        <span class="pill upcoming">قادمة</span>
      </div>
      <div class="session-item">
        <div class="avatar">م.ع</div>
        <div style="flex:1;"><b>د. روان الأسي</b><span>الأربعاء 2 يوليو — محادثة نصية</span></div>
        <span class="pill done">مكتملة</span>
      </div>
      <div class="session-item">
        <div class="avatar">م.ع</div>
        <div style="flex:1;"><b>د. روان الأسي</b><span>الأربعاء 25 يونيو — محادثة نصية</span></div>
        <span class="pill done">مكتملة</span>
      </div>
      <a href="{{ url('/patient/sessions') }}" class="link-arrow" style="margin-top:14px;">عرض كل الجلسات
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l-6 6 6 6"/></svg>
      </a>
    </div>
  </div>

  <div>
    <div class="panel">
      <h3>معالجتك الحالية</h3>
      <div class="session-item">
        <div class="avatar">م.ع</div>
        <div style="flex:1;"><b>د. روان الأسي</b><span>علاج سلوكي معرفي</span></div>
      </div>
      <a href="{{ url('/specialists/1') }}" class="btn btn-ghost btn-block btn-sm" style="margin-top:14px;">عرض الملف الشخصي</a>
    </div>

    <div class="panel" style="background:var(--lav-100); border-color:var(--lav-200);">
      <h3 style="display:flex; align-items:center; gap:8px;">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><path d="M12 9v4M12 17h.01"/></svg>
        هل تمر بحالة طارئة؟
      </h3>
      <p style="font-size:13.5px; margin-bottom:16px;">فريق الطوارئ متاح للتواصل الفوري على مدار الساعة.</p>
      <a href="{{ url('/emergency') }}" class="btn btn-primary btn-block btn-sm">التواصل مع خط الطوارئ</a>
    </div>
  </div>
</div>
@endsection