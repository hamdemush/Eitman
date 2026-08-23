@extends('layouts.admin')

@section('title', 'ملف المريض | إطمئن')

@section('content')
<div class="dash-head">
  <div>
    <a href="{{ url('/admin/users') }}" style="font-size:13px; color:var(--teal-700); text-decoration:none;">← العودة لجمهور المستخدمين</a>
    <h1 id="patientName" style="margin-top:4px;">ملف المريض</h1>
  </div>
</div>

<div class="grid-2">
  <div class="panel">
    <h3 style="margin-bottom:12px;">بيانات الحساب</h3>
    <p><b>البريد الإلكتروني:</b> <span id="patientEmail">--</span></p>
    <p><b>الجامعة:</b> <span id="patientUni">--</span></p>
    <p><b>عدد الجلسات:</b> <span id="patientSessions">0</span></p>
    <p><b>الوضع المجهول:</b> <span id="patientAnon">--</span></p>
  </div>

  <div class="panel">
    <h3 style="margin-bottom:12px;">إدارة الحالة</h3>
    <div class="field" style="margin-bottom:14px;">
      <label>حالة المريض</label>
      <select id="patientStatusSelect" style="width:100%; padding:10px; border-radius:8px; border:1px solid var(--border); background:var(--bg-card); color:var(--ink-900);">
        <option value="pending">قيد المراجعة</option>
        <option value="accepted">مقبول</option>
        <option value="rejected">مرفوض</option>
        <option value="deleted">محذوف</option>
      </select>
    </div>
    <button class="btn btn-primary" id="savePatientStatusBtn" style="width:100%;">تعديل الحالة</button>
  </div>
</div>

<div class="toast" id="patientToast"></div>
@endsection

@push('scripts')
<script>
  (function () {
    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');
    const users = Store.getPlatformUsers();
    const u = users.find(x => x.id === id) || users[0];

    if (!u) return;

    document.getElementById('patientName').textContent = u.name;
    document.getElementById('patientEmail').textContent = u.email || 'غير محدد';
    document.getElementById('patientUni').textContent = u.university || '—';
    document.getElementById('patientSessions').textContent = u.sessionsCount;
    document.getElementById('patientAnon').textContent = u.anonymousMode ? 'مفعّل' : 'غير مفعّل';
    document.getElementById('patientStatusSelect').value = u.status;

    document.getElementById('savePatientStatusBtn').addEventListener('click', () => {
      u.status = document.getElementById('patientStatusSelect').value;
      Store.savePlatformUsers(users);
      
      if (typeof AdminUI !== 'undefined' && AdminUI.showToast) {
        AdminUI.showToast('patientToast', 'تم تحديث حالة المريض بنجاح');
      } else {
        alert('تم تحديث حالة المريض بنجاح');
      }
    });
  })();
</script>
@endpush