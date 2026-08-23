@extends('layouts.admin')

@section('title', 'ملف المعالج | إطمئن')

@section('content')
<div class="dash-head">
  <div>
    <a href="{{ url('/admin/therapists') }}" style="font-size:13px; color:var(--teal-700); text-decoration:none;">← العودة لقائمة المعالجين</a>
    <h1 id="therapistName" style="margin-top:4px;">تفاصيل المعالج</h1>
  </div>
</div>

<div class="grid-2">
  <div class="panel">
    <h3 style="margin-bottom:12px;">المعلومات المهنية</h3>
    <p><b>التخصص:</b> <span id="therapistSpec">--</span></p>
    <p><b>رقم الترخيص:</b> <span id="therapistLic">--</span></p>
    <p><b>الخبرة:</b> <span id="therapistExp">--</span></p>
  </div>

  <div class="panel">
    <h3 style="margin-bottom:12px;">الإجراءات الإدارية</h3>
    <button class="btn btn-primary" id="approveBtn" style="width:100%; margin-bottom:8px;">قبول واعتمد</button>
    <button class="btn btn-outline" id="rejectBtn" style="width:100%; color:var(--rose-700); border-color:var(--rose-200);">رفض الطلب</button>
  </div>
</div>
@endsection

@push('scripts')
<script>
  (function () {
    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');
    const pending = Store.getPendingTherapists();
    const t = pending.find(x => x.id === id) || pending[0] || {};

    document.getElementById('therapistName').textContent = t.name || 'معالج';
    document.getElementById('therapistSpec').textContent = t.specialty || '—';
    document.getElementById('therapistLic').textContent = t.licenseNumber || '—';
    document.getElementById('therapistExp').textContent = t.experience || '—';

    document.getElementById('approveBtn').addEventListener('click', () => {
      Store.approveTherapist(t.id);
      alert('تمت الموافقة على المعالج ونقله إلى قائمة المعتمدين');
      window.location.href = "{{ url('/admin/therapists') }}";
    });

    document.getElementById('rejectBtn').addEventListener('click', () => {
      const reason = prompt('يرجى ذكر سبب الرفض:');
      if (reason) {
        Store.rejectTherapist(t.id, reason);
        alert('تم رفض الطلب');
        window.location.href = "{{ url('/admin/therapists') }}";
      }
    });
  })();
</script>
@endpush