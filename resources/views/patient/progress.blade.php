@extends('layouts.patient')

@section('title', 'تقدمي النفسي | إطمئن')

@section('content')
<div class="dash-head">
  <div>
    <h1>تقدمي النفسي</h1>
    <p>متابعة دورية لمؤشر حالتك المزاجية وملاحظات معالجتك.</p>
  </div>
</div>

<div class="stat-cards">
  <div class="stat-card">
    <div class="ico">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18M7 15l4-5 3 3 5-6"/></svg>
    </div>
    <b>+18٪</b>
    <span>تحسّن آخر شهر</span>
  </div>
  <div class="stat-card">
    <div class="ico">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 10h18"/></svg>
    </div>
    <b>6</b>
    <span>استبيانات مكتملة</span>
  </div>
  <div class="stat-card">
    <div class="ico">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
    </div>
    <b>6 أسابيع</b>
    <span>مدة المتابعة</span>
  </div>
</div>

<div class="panel">
  <h3>مؤشر الحالة المزاجية — آخر 6 أسابيع</h3>
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
  <h3>ملاحظات المعالجة</h3>
  <div class="session-item">
    <div class="avatar">م.ع</div>
    <div style="flex:1;">
      <b>بعد جلسة 2 يوليو</b>
      <span>تحسّن ملحوظ في التعامل مع أفكار القلق قبل الامتحانات. الاستمرار في تمارين التنفس اليومية.</span>
    </div>
  </div>
  <div class="session-item">
    <div class="avatar">م.ع</div>
    <div style="flex:1;">
      <b>بعد جلسة 25 يونيو</b>
      <span>بداية جيدة في تحديد الأفكار السلبية التلقائية. نستمر بنفس الخطة العلاجية.</span>
    </div>
  </div>
</div>
@endsection