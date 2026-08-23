@extends('layouts.admin')

@section('title', 'تفاصيل الشكوى | إطمئن')

@section('content')
<div class="dash-head">
  <div>
    <a href="{{ url('/admin/complaints') }}" style="font-size:13px; color:var(--teal-700); text-decoration:none;">← العودة للبلاغات</a>
    <h1 id="complaintTitle" style="margin-top:4px;">تفاصيل الشكوى</h1>
  </div>
  <div id="statusBadgeWrap"></div>
</div>

<div class="grid-2">
  <div class="panel">
    <h3 style="margin-bottom:12px;">معلومات البلاغ</h3>
    <p><b>المُشتكي:</b> <span id="complainant">--</span></p>
    <p><b>المشتكى عليه:</b> <span id="accused">--</span></p>
    <p><b>التاريخ:</b> <span id="dateLabel">--</span></p>
    <hr style="margin:16px 0; border:0; border-top:1px solid var(--border);">
    <p><b>وصف المشكلة:</b></p>
    <p id="descriptionText" style="margin-top:8px; line-height:1.6; color:var(--ink-700);"></p>
  </div>

  <div class="panel">
    <h3 style="margin-bottom:12px;">تحديث حالة البلاغ</h3>
    <div class="field" style="margin-bottom:14px;">
      <label>الحالة الحالية</label>
      <select id="statusSelect" style="width:100%; padding:10px; border-radius:8px; border:1px solid var(--border); background:var(--bg-card); color:var(--ink-900);">
        <option value="open">مفتوحة</option>
        <option value="in_progress">قيد المتابعة</option>
        <option value="resolved">تم الحل</option>
      </select>
    </div>
    <button class="btn btn-primary" id="saveStatusBtn" style="width:100%;">حفظ التعديل</button>
  </div>
</div>

<div class="toast" id="complaintToast"></div>
@endsection

@push('scripts')
<script>
  (function () {
    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');
    const complaints = Store.getComplaints();
    const item = complaints.find(c => c.id === id) || complaints[0];

    if (!item) return;

    document.getElementById('complaintTitle').textContent = item.title;
    document.getElementById('complainant').textContent = item.complainantName;
    document.getElementById('accused').textContent = item.accusedName;
    document.getElementById('dateLabel').textContent = item.dateLabel;
    document.getElementById('descriptionText').textContent = item.description || 'لا يوجد وصف تفصيلي للمشكلة.';
    document.getElementById('statusSelect').value = item.status;

    document.getElementById('saveStatusBtn').addEventListener('click', () => {
      const newStatus = document.getElementById('statusSelect').value;
      item.status = newStatus;
      Store.saveComplaints(complaints);
      
      // استخدام Toast المنصة إن وُجد، أو fallback بسيط
      if (typeof AdminUI !== 'undefined' && AdminUI.showToast) {
        AdminUI.showToast('complaintToast', 'تم تحديث حالة البلاغ بنجاح');
      } else {
        alert('تم تحديث حالة البلاغ بنجاح');
      }
    });
  })();
</script>
@endpush