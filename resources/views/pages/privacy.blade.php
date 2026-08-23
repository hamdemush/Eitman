@extends('layouts.app')

@section('title', 'سياسة الخصوصية | إطمئن')

@section('content')
<section class="page-hero">
  <div class="container">
    <h1 data-i18n="footer.privacy">سياسة الخصوصية</h1>
    <p>آخر تحديث: يوليو 2026</p>
  </div>
</section>

<section class="section" style="padding-top:20px;">
  <div class="container" style="max-width:760px;">
    <div class="question-card" style="text-align:right;">
      <h4 style="margin-bottom:10px;">1. جمع البيانات</h4>
      <p style="margin-bottom:20px;">نجمع فقط البيانات الضرورية لتقديم الخدمة: بياناتك الأساسية، إجابات الاستبيان النفسي، وسجل الجلسات. عند تفعيل الوضع المجهول، لا يُعرض اسمك الحقيقي للمعالج بأي شكل.</p>
      
      <h4 style="margin-bottom:10px;">2. التشفير والتخزين</h4>
      <p style="margin-bottom:20px;">تُشفَّر جميع البيانات الحساسة أثناء النقل والتخزين، ولا يمكن لأي طرف ثالث الوصول إليها.</p>
      
      <h4 style="margin-bottom:10px;">3. مشاركة البيانات</h4>
      <p>لا تُشارك بياناتك مع أي جهة خارجية دون موافقتك الصريحة، إلا في الحالات التي يُلزم بها القانون (كحالات الخطر على الحياة).</p>
    </div>
  </div>
</section>
@endsection