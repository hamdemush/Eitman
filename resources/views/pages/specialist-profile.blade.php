@extends('layouts.app')

@section('title', ($therapist->name ?? 'د. روان الأسي') . ' | إطمئن')

@section('content')
<section class="section" style="padding-top:44px;">
  <div class="container">
    <a href="{{ route('specialists.index') }}" class="link-arrow" style="margin-bottom:24px;">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l-6 6 6 6"/></svg>
      العودة إلى نتائج البحث
    </a>

    <div class="profile-grid" style="margin-top:20px;">
      <div>
        <div class="profile-card">
          <div class="profile-header">
            <div class="avatar">{{ $therapist->avatar_letters ?? 'م.ع' }}</div>
            <div>
              <h1>{{ $therapist->name ?? 'د. روان الأسي' }}</h1>
              <p>{{ $therapist->title ?? 'أخصائية علاج سلوكي معرفي (CBT) — مرخصة من نقابة الأخصائيين النفسيين' }}</p>
              <div class="tag-row">
                <span class="tag">القلق والتوتر الدراسي</span>
                <span class="tag">الاحتراق الأكاديمي</span>
                <span class="tag">تدعم الوضع المجهول</span>
              </div>
            </div>
          </div>

          <div class="stat-row">
            <div class="stat"><b>{{ $therapist->rating ?? '4.9' }} ★</b><span>({{ $therapist->reviews_count ?? '120' }}) تقييم</span></div>
            <div class="stat"><b>+{{ $therapist->experience_years ?? '8' }} سنوات</b><span>خبرة مهنية</span></div>
            <div class="stat"><b>{{ $therapist->sessions_count ?? '500+' }}</b><span>جلسة مكتملة</span></div>
            <div class="stat"><b>{{ $therapist->match_rate ?? '96٪' }}</b><span>نسبة توافق محتملة</span></div>
          </div>

          <h4 style="margin-bottom:12px;">نبذة</h4>
          <p style="margin-bottom:24px;">{{ $therapist->bio ?? 'أعمل مع المرضى على تطوير أدوات عملية للتعامل مع القلق والتوتر الدراسي باستخدام أساليب العلاج السلوكي المعرفي. أؤمن بأن كل حالة تستحق خطة علاجية مخصصة، وأحرص على توفير بيئة آمنة وسرية تمامًا لكل جلسة.' }}</p>

          <h4 style="margin-bottom:12px;">مجالات التخصص</h4>
          <div class="tag-row" style="margin-bottom:24px;">
            <span class="tag">القلق</span>
            <span class="tag">التوتر الدراسي</span>
            <span class="tag">اضطرابات النوم الخفيفة</span>
            <span class="tag">الثقة بالنفس</span>
          </div>

          <h4 style="margin-bottom:12px;">آراء المرضى</h4>
          <div class="session-item">
            <div class="avatar">ط</div>
            <div style="flex:1;">
              <b>مريض مجهول <span style="color:var(--gold); font-weight:400;">★★★★★</span></b>
              <span>ساعدتني كثيرًا في التعامل مع قلق الامتحانات، أسلوبها هادئ ومريح جدًا.</span>
            </div>
          </div>
          <div class="session-item">
            <div class="avatar">ط</div>
            <div style="flex:1;">
              <b>مريضة <span style="color:var(--gold); font-weight:400;">★★★★★</span></b>
              <span>محترفة جدًا وتستمع دون حكم مسبق، أنصح بها بشدة.</span>
            </div>
          </div>
        </div>
      </div>

      <div>
        <div class="side-card">
          <h4>احجز جلستك</h4>
          <p style="font-size:13.5px; margin-bottom:14px;">الجلسة الأولى مجانية بالكامل.</p>
          <p style="font-size:13px; font-weight:800; color:var(--ink-700); margin-bottom:10px;">اختر الموعد المناسب</p>
          <div class="slot-grid" style="margin-bottom:20px;">
            <div class="slot">10:00 ص</div>
            <div class="slot unavailable">11:00 ص</div>
            <div class="slot selected">12:00 م</div>
            <div class="slot">1:00 م</div>
            <div class="slot">4:00 م</div>
            <div class="slot unavailable">5:00 م</div>
          </div>
          <a href="{{ route('booking.create') }}" class="btn btn-primary btn-block btn-sm" data-i18n="btn.continueBooking">متابعة الحجز</a>
        </div>

        <div class="side-card">
          <h4>أسلوب الجلسات المتاح</h4>
          <div class="tag-row">
            <span class="tag">محادثة نصية</span>
            <span class="tag">مكالمة صوتية</span>
            <span class="tag">مكالمة فيديو</span>
          </div>
        </div>

        <div class="side-card" style="background:var(--lav-100); border-color:var(--lav-200);">
          <h4 style="display:flex; align-items:center; gap:8px;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="11" width="14" height="9" rx="2"/><path d="M8 11V7a4 4 0 018 0v4"/></svg>
            هويتك محمية
          </h4>
          <p style="font-size:13px;">يمكنك تفعيل وضع الاستخدام المجهول قبل بدء الجلسة من إعدادات حسابك.</p>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection