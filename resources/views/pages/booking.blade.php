@extends('layouts.app')

@section('title', 'تأكيد الحجز | إطمئن')

@push('styles')
<script src="{{ asset('assets/js/store.js') }}"></script>
@endpush

@section('content')
<section class="page-hero">
  <div class="container">
    <h1>تأكيد جلستك</h1>
    <p>راجع تفاصيل الجلسة قبل التأكيد. الجلسة الأولى مجانية بالكامل.</p>
  </div>
</section>

<section class="section" style="padding-top:30px;">
  <div class="container" style="max-width:760px;">

    <div class="question-card" style="margin-bottom:24px;">
      <h3>ملخص الجلسة</h3>
      <div class="session-item">
        <div class="avatar">م.ع</div>
        <div style="flex:1;">
          <b>د. روان الأسي</b>
          <span>أخصائية علاج سلوكي معرفي</span>
        </div>
        <span class="pill upcoming">قادمة</span>
      </div>
      <div style="display:flex; gap:30px; margin-top:20px; flex-wrap:wrap;">
        <div><span style="font-size:12.5px; color:var(--ink-500); display:block;">التاريخ</span><b>الأربعاء، 9 يوليو 2025</b></div>
        <div><span style="font-size:12.5px; color:var(--ink-500); display:block;">الوقت</span><b>12:00 ظهرًا</b></div>
        <div><span style="font-size:12.5px; color:var(--ink-500); display:block;">المدة</span><b>50 دقيقة</b></div>
      </div>
    </div>

    <div class="question-card" style="margin-bottom:24px;">
      <h3>أسلوب الجلسة</h3>
      <div class="option-list">
        <label class="option selected"><input type="radio" name="mode" checked> محادثة نصية</label>
        <label class="option"><input type="radio" name="mode"> مكالمة صوتية</label>
        <label class="option"><input type="radio" name="mode"> مكالمة فيديو</label>
      </div>
    </div>

    <div class="question-card" style="margin-bottom:24px;">
      <div class="anon-toggle" style="background:var(--lav-100); margin:0;">
        <div><b>الاستخدام باسم مستعار لهذه الجلسة</b><span>لن يظهر اسمك الحقيقي للمعالج</span></div>
        <label class="switch"><input type="checkbox" class="anon-checkbox"><span class="slider"></span></label>
      </div>
    </div>

    <div class="question-card" style="margin-bottom:30px; background:var(--mint-100); border:none;">
      <div style="display:flex; justify-content:space-between; align-items:center;">
        <div>
          <b style="font-family:'Cairo',sans-serif; font-size:16px; color:var(--teal-900);">الجلسة الأولى</b>
          <p style="font-size:13.5px;">مجانية بالكامل — بدون أي رسوم</p>
        </div>
        <span style="font-family:'Cairo',sans-serif; font-size:22px; color:var(--teal-700); font-weight:800;">0.00 د.أ</span>
      </div>
    </div>

    <button type="button" class="btn btn-primary btn-block" id="confirmBookingBtn" data-i18n="btn.confirmBooking">تأكيد الحجز</button>
    <p class="form-foot">يمكنك إلغاء الجلسة أو تعديل موعدها حتى 12 ساعة قبل بدئها.</p>
  </div>
</section>
@endsection

@push('scripts')
<script>
  document.getElementById('confirmBookingBtn').addEventListener('click', () => {
    const selectedMode = document.querySelector('input[name="mode"]:checked');
    const modeLabel = selectedMode ? selectedMode.closest('.option').textContent.trim() : 'محادثة نصية';
    if (typeof Store !== 'undefined') {
      Store.createSessionRequest({
        patientId: Store.getCurrentPatientId(),
        therapistId: 'th-mariam',
        topic: 'استشارة جديدة',
        mode: modeLabel
      });
    }
    window.location.href = "{{ url('/patient/dashboard') }}";
  });
</script>
@endpush