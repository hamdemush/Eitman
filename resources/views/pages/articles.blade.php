@extends('layouts.app')

@section('title', 'المقالات | إطمئن')

@section('content')
<section class="page-hero page-hero-photo" style="background-image: linear-gradient(160deg, rgba(15,53,50,.88), rgba(10,38,36,.86)), url('{{ asset('assets/images/journaling-night.webp') }}');">
  <div class="container">
    <h1 data-i18n="articles.title">المقالات</h1>
    <p data-i18n="articles.subtitle">محتوى توعوي في الصحة النفسية يكتبه فريقنا من المختصين.</p>
  </div>
</section>

<section class="section" style="padding-top:30px;">
  <div class="container">
    <div class="specialist-grid">

      <a href="{{ url('/article-details') }}" class="specialist-card" style="text-decoration:none;">
        <span class="tag" style="align-self:flex-start;">القلق والتوتر</span>
        <h4 style="font-size:17px;">خمس طرق علمية للتعامل مع قلق الامتحانات</h4>
        <p>نصائح عملية مبنية على أساليب العلاج السلوكي المعرفي يمكن تطبيقها قبل وأثناء فترة الامتحانات.</p>
        <span style="font-size:12.5px; color:var(--ink-500);">د. روان الأسي — 5 دقائق قراءة</span>
      </a>

      <a href="{{ url('/article-details') }}" class="specialist-card" style="text-decoration:none;">
        <span class="tag" style="align-self:flex-start;">النوم</span>
        <h4 style="font-size:17px;">لماذا ينام المرضى متأخرًا وكيف تُصلح ساعتك البيولوجية</h4>
        <p>دليل مبسّط لفهم اضطرابات النوم الشائعة لدى المرضى وخطوات عملية لتحسين جودة النوم.</p>
        <span style="font-size:12.5px; color:var(--ink-500);">د. خميس الأسي — 7 دقائق قراءة</span>
      </a>

      <a href="{{ url('/article-details') }}" class="specialist-card" style="text-decoration:none;">
        <span class="tag" style="align-self:flex-start;">العلاقات</span>
        <h4 style="font-size:17px;">كيف تتحدث مع أهلك عن صحتك النفسية دون خوف من الحكم</h4>
        <p>خطوات تدريجية لفتح حوار صحي مع العائلة حول ما تمر به دون الشعور بالحرج.</p>
        <span style="font-size:12.5px; color:var(--ink-500);">د. نوة السعد — 6 دقائق قراءة</span>
      </a>

      <a href="{{ url('/article-details') }}" class="specialist-card" style="text-decoration:none;">
        <span class="tag" style="align-self:flex-start;">الاحتراق الأكاديمي</span>
        <h4 style="font-size:17px;">علامات الاحتراق الدراسي وكيف تكتشفها مبكرًا</h4>
        <p>الفرق بين التعب الطبيعي والاحتراق الفعلي، وأدوات بسيطة لاستعادة التوازن.</p>
        <span style="font-size:12.5px; color:var(--ink-500);">د. عمر الشريف — 4 دقائق قراءة</span>
      </a>

      <a href="{{ url('/article-details') }}" class="specialist-card" style="text-decoration:none;">
        <span class="tag" style="align-self:flex-start;">الخصوصية</span>
        <h4 style="font-size:17px;">وضع الاستخدام المجهول: كيف يحمي خصوصيتك فعليًا</h4>
        <p>شرح تقني مبسّط لآلية عمل الوضع المجهول داخل منصة إطمئن.</p>
        <span style="font-size:12.5px; color:var(--ink-500);">فريق إطمئن — 3 دقائق قراءة</span>
      </a>

      <a href="{{ url('/article-details') }}" class="specialist-card" style="text-decoration:none;">
        <span class="tag" style="align-self:flex-start;">الثقة بالنفس</span>
        <h4 style="font-size:17px;">بناء الثقة بالنفس في السنة الجامعية الأولى</h4>
        <p>تمارين يومية بسيطة لتعزيز الثقة بالنفس عند الانتقال لحياة جامعية جديدة.</p>
        <span style="font-size:12.5px; color:var(--ink-500);">د. ريما دباس — 5 دقائق قراءة</span>
      </a>

    </div>
  </div>
</section>
@endsection