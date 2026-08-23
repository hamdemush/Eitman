@extends('layouts.app')

@section('title', 'شروط الخدمة | إطمئن')

@section('content')
<section class="page-hero">
  <div class="container">
    <h1 data-i18n="footer.terms">شروط الخدمة</h1>
    <p>آخر تحديث: يوليو 2026</p>
  </div>
</section>

<section class="section" style="padding-top:20px;">
  <div class="container" style="max-width:760px;">
    <div class="question-card" style="text-align:right;">
      <h4 style="margin-bottom:10px;">1. طبيعة الخدمة</h4>
      <p style="margin-bottom:20px;">إطمئن منصة إلكترونية لتسهيل التواصل بين المرضى ومعالجين نفسيين مرخّصين، ولا تُعد بديلاً عن الرعاية الطبية الطارئة.</p>
      
      <h4 style="margin-bottom:10px;">2. مسؤوليات المستخدم</h4>
      <p style="margin-bottom:20px;">يلتزم المستخدم بتقديم معلومات صحيحة، واحترام مواعيد الجلسات، وعدم مشاركة بيانات دخوله مع الغير.</p>
      
      <h4 style="margin-bottom:10px;">3. الدفع والاسترجاع</h4>
      <p>الجلسة الأولى مجانية دائمًا. الجلسات اللاحقة مدفوعة، وتخضع سياسة الإلغاء والاسترجاع لضوابط محددة تُعرض عند الحجز.</p>
    </div>
  </div>
</section>
@endsection