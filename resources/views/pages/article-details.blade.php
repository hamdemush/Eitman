@extends('layouts.app')

@section('title', 'خمس طرق علمية للتعامل مع قلق الامتحانات | إطمئن')

@section('content')
<section class="section" style="padding-top:44px;">
  <div class="container" style="max-width:760px;">
    <a href="{{ url('/articles') }}" class="link-arrow" style="margin-bottom:20px;">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l-6 6 6 6"/></svg>
      العودة إلى المقالات
    </a>

    <span class="tag" style="margin-bottom:16px; display:inline-block;">القلق والتوتر</span>
    <h1 style="font-size:30px; margin-bottom:14px;">خمس طرق علمية للتعامل مع قلق الامتحانات</h1>
    <div style="display:flex; align-items:center; gap:12px; margin-bottom:30px;">
      <div class="avatar" style="width:38px; height:38px; font-size:13px;">م.ع</div>
      <div>
        <b style="font-size:13.5px; display:block;">د. روان الأسي</b>
        <span style="font-size:12px; color:var(--ink-500);">5 دقائق قراءة</span>
      </div>
    </div>

    <div class="question-card" style="text-align:right;">
      <p style="margin-bottom:18px;">قلق الامتحانات شعور طبيعي يمر به معظم المرضى، لكنه يتحول إلى عائق حقيقي عندما يمنعك من التركيز أو النوم أو حتى الحضور للامتحان نفسه. المقال التالي يقدّم خمس أدوات عملية مبنية على أساليب العلاج السلوكي المعرفي (CBT).</p>

      <h4 style="margin:22px 0 10px;">1. تحدَّ الأفكار الكارثية</h4>
      <p style="margin-bottom:18px;">لاحظ الأفكار من نوع "سأفشل حتمًا" واستبدلها بأفكار أكثر واقعية مثل "درست جيدًا وسأبذل قصارى جهدي".</p>

      <h4 style="margin:22px 0 10px;">2. تنفّس بعمق قبل الامتحان بخمس دقائق</h4>
      <p style="margin-bottom:18px;">تمارين التنفس البطيء تُهدئ الجهاز العصبي وتقلل أعراض القلق الجسدية كتسارع النبض.</p>

      <h4 style="margin:22px 0 10px;">3. قسّم المذاكرة إلى جلسات قصيرة</h4>
      <p style="margin-bottom:18px;">المذاكرة المكثفة قبل الامتحان بساعات تزيد التوتر؛ جلسات قصيرة موزّعة على أيام أكثر فاعلية وأقل إرهاقًا.</p>

      <h4 style="margin:22px 0 10px;">4. لا تقارن نفسك بزملائك</h4>
      <p style="margin-bottom:18px;">كل مريض له وتيرته الخاصة في الفهم والمذاكرة، والمقارنة المستمرة تزيد الضغط النفسي دون فائدة حقيقية.</p>

      <h4 style="margin:22px 0 10px;">5. اطلب الدعم عند الحاجة</h4>
      <p>إذا شعرت أن القلق يفوق قدرتك على التعامل معه بمفردك، التحدث مع أخصائي نفسي مختص خطوة فعّالة ولا تدل على الضعف.</p>
    </div>

    <div class="cta-banner" style="margin-top:34px; padding:40px;">
      <h2 style="font-size:22px;">هل يزعجك القلق الدراسي أكثر من اللازم؟</h2>
      <p style="font-size:14px;">احجز جلستك الأولى المجانية مع أحد المعالجين المختصين في القلق والتوتر الدراسي.</p>
      <div class="cta-actions">
        <a href="{{ url('/assessment') }}" class="btn btn-light">ابدأ الاستبيان</a>
      </div>
    </div>
  </div>
</section>
@endsection