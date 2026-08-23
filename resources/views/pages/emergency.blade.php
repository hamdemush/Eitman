@extends('layouts.app')

@section('title', 'حالات الطوارئ | إطمئن')

@section('content')
<section class="page-hero page-hero-photo" style="background-image: linear-gradient(160deg, rgba(15,53,50,.90), rgba(10,38,36,.88)), url('{{ asset('assets/images/lonely-under-tree.jpg') }}');">
  <div class="container">
    <span class="badge" style="background:var(--brand-danger-bg, #FDECEC); color:#B03434; border-color:#F3C9C9;">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><path d="M12 9v4M12 17h.01"/></svg>
      دعم فوري على مدار الساعة
    </span>
    <h1 data-i18n="emergency.title">هل تمر بحالة طارئة؟</h1>
    <p data-i18n="emergency.subtitle">إذا كنت تفكر بإيذاء نفسك أو غيرك، الرجاء التواصل فورًا مع أحد خطوط المساندة أدناه أو التوجه لأقرب غرفة طوارئ.</p>
  </div>
</section>

<section class="section" style="padding-top:30px;">
  <div class="container" style="max-width:820px;">

    <div class="question-card" style="background:#FDECEC; border-color:#F3C9C9; margin-bottom:24px;">
      <h3 style="color:#9A2B2B;">إذا كانت حياتك أو حياة شخص آخر في خطر الآن</h3>
      <p style="margin-bottom:20px;">اتصل فورًا بالدفاع المدني / الإسعاف في بلدك، أو توجّه إلى أقرب قسم طوارئ في أقرب مستشفى. لا تنتظر حجز موعد على المنصة.</p>
      <a href="tel:911" class="btn btn-block" style="background:#C23B3B; color:#fff;">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.8 19.8 0 01-8.63-3.07 19.5 19.5 0 01-6-6A19.8 19.8 0 012.12 4.18 2 2 0 014.11 2h3a2 2 0 012 1.72c.13.99.36 1.96.68 2.9a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.18-1.18a2 2 0 012.11-.45c.94.32 1.91.55 2.9.68A2 2 0 0122 16.92z"/></svg>
        اتصال بخط الطوارئ الوطني
      </a>
    </div>

    <div class="question-card" style="margin-bottom:24px;">
      <h3 style="margin-bottom:18px;">خطوط الدعم النفسي</h3>

      <div class="session-item">
        <div class="avatar" style="background:var(--mint-100); color:var(--teal-700);">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.8 19.8 0 01-8.63-3.07 19.5 19.5 0 01-6-6A19.8 19.8 0 012.12 4.18 2 2 0 014.11 2h3a2 2 0 012 1.72c.13.99.36 1.96.68 2.9a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.18-1.18a2 2 0 012.11-.45c.94.32 1.91.55 2.9.68A2 2 0 0122 16.92z"/></svg>
        </div>
        <div style="flex:1;">
          <b>خط الإسناد النفسي للمرضى</b>
          <span>متاح 24/7 — رقم تجريبي يُستبدل برقم الجهة الرسمية عند الإطلاق</span>
        </div>
        <span class="pill upcoming">24/7</span>
      </div>

      <div class="session-item">
        <div class="avatar" style="background:var(--mint-100); color:var(--teal-700);">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg>
        </div>
        <div style="flex:1;">
          <b>الدردشة النصية الطارئة عبر إطمئن</b>
          <span>تواصل فوري مع أخصائي مناوب داخل المنصة</span>
        </div>
        <a href="{{ url('/patient/chat') }}" class="btn btn-primary btn-sm">ابدأ الدردشة</a>
      </div>

      <div class="session-item">
        <div class="avatar" style="background:var(--mint-100); color:var(--teal-700);">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4.5 8-11.8A8 8 0 004 10.2C4 17.5 12 22 12 22z"/></svg>
        </div>
        <div style="flex:1;">
          <b>عيادة الإرشاد النفسي بالجامعة</b>
          <span>للمرضى المسجّلين — تنسيق موعد حضوري سريع</span>
        </div>
      </div>
    </div>

    <div class="question-card" style="background:var(--lav-100); border-color:var(--lav-200);">
      <h4 style="margin-bottom:10px;">ملاحظة لفريق التطوير (Back-end)</h4>
      <p style="font-size:13.5px;">أرقام الطوارئ أعلاه نائبة (placeholder) لأغراض العرض فقط. عند الربط مع الخلفية، يجب استبدالها بأرقام رسمية معتمدة حسب الدولة/الجامعة، ويفضّل جلبها من إعدادات النظام لا كتابتها مباشرة في HTML.</p>
    </div>

  </div>
</section>
@endsection