@extends('layouts.patient')

@section('title', 'جلساتي | إطمئن')

@section('content')
<div class="dash-head">
  <div>
    <h1>جلساتي</h1>
    <p>كل جلساتك القادمة والسابقة في مكان واحد.</p>
  </div>
  <a href="{{ url('/specialists') }}" class="btn btn-primary btn-sm">حجز جلسة جديدة</a>
</div>

<div class="panel" id="pendingPanel" style="display:none;">
  <h3>طلبات بانتظار موافقة المعالج</h3>
  <div id="pendingList"></div>
</div>

<div class="panel">
  <h3>الجلسات القادمة</h3>
  <div id="upcomingList">
    <div class="session-item">
      <div class="avatar">م.ع</div>
      <div style="flex:1;"><b>د. روان الأسي</b><span>الأربعاء 9 يوليو 2025 — 12:00 ظهرًا — محادثة نصية</span></div>
      <span class="pill upcoming">قادمة</span>
      <a href="{{ url('/patient/chat') }}" class="btn btn-ghost btn-sm">فتح المحادثة</a>
    </div>
  </div>
</div>

<div class="panel">
  <h3>الجلسات السابقة</h3>
  <div class="session-item">
    <div class="avatar">م.ع</div>
    <div style="flex:1;"><b>د. روان الأسي</b><span>الأربعاء 2 يوليو 2025 — محادثة نصية</span></div>
    <span class="pill done">مكتملة</span>
  </div>
  <div class="session-item">
    <div class="avatar">م.ع</div>
    <div style="flex:1;"><b>د. روان الأسي</b><span>الأربعاء 25 يونيو 2025 — محادثة نصية</span></div>
    <span class="pill done">مكتملة</span>
  </div>
  <div class="session-item">
    <div class="avatar">م.ع</div>
    <div style="flex:1;"><b>د. روان الأسي</b><span>الأربعاء 18 يونيو 2025 — الجلسة الأولى (مجانية)</span></div>
    <span class="pill done">مكتملة</span>
  </div>
</div>
@endsection

@push('scripts')
<script>
  (function () {
    const patientId = Store.getCurrentPatientId();
    const sessions = Store.getSessionsForPatient(patientId);

    const pendingPanel = document.getElementById('pendingPanel');
    const pendingList = document.getElementById('pendingList');
    const upcomingList = document.getElementById('upcomingList');

    const pending = sessions.filter((s) => s.status === 'pending');
    if (pending.length > 0) {
      pendingPanel.style.display = 'block';
      pending.forEach((s) => {
        const item = document.createElement('div');
        item.className = 'session-item';
        item.innerHTML =
          '<div class="avatar">' + (s.therapist ? s.therapist.initials : 'م') + '</div>' +
          '<div style="flex:1;"><b>' + (s.therapist ? s.therapist.name : 'معالج') + '</b>' +
          '<span>' + s.topic + ' — بانتظار قبول المعالج</span></div>' +
          '<span class="pill pending">قيد المراجعة</span>';
        pendingList.appendChild(item);
      });
    }

    const accepted = sessions.filter((s) => s.status === 'accepted' && s.id !== 's-sara-1');
    accepted.forEach((s) => {
      const item = document.createElement('div');
      item.className = 'session-item';
      item.innerHTML =
        '<div class="avatar">' + (s.therapist ? s.therapist.initials : 'م') + '</div>' +
        '<div style="flex:1;"><b>' + (s.therapist ? s.therapist.name : 'معالج') + '</b>' +
        '<span>' + s.topic + ' — ' + (s.mode || 'محادثة نصية') + '</span></div>' +
        '<span class="pill upcoming">قادمة</span>' +
        '<a href="{{ url('/patient/chat') }}" class="btn btn-ghost btn-sm">فتح المحادثة</a>';
      upcomingList.appendChild(item);
    });
  })();
</script>
@endpush