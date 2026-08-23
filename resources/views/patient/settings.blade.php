@extends('layouts.patient')

@section('title', 'الإعدادات والخصوصية | إطمئن')

@section('content')
<div class="dash-head">
  <div>
    <h1>الإعدادات والخصوصية</h1>
    <p>تحكّم في بياناتك الشخصية وطريقة ظهورك أمام المعالج.</p>
  </div>
</div>

<div class="panel" style="max-width:640px;">
  <h3>المعلومات الشخصية</h3>
  <div class="field-row">
    <div class="field"><label>الاسم الأول</label><input type="text" value="سارة"></div>
    <div class="field"><label>اسم العائلة</label><input type="text" value="أحمد"></div>
  </div>
  <div class="field"><label>البريد الإلكتروني </label><input type="email" value="sara.ahmad@ju.edu.jo" disabled></div>
</div>

<div class="panel" style="max-width:640px;">
  <h3>الخصوصية</h3>
  <div class="anon-toggle" style="margin-bottom:14px;">
    <div><b>وضع الاستخدام المجهول</b><span>إخفاء اسمك الحقيقي عن المعالج أثناء الجلسات</span></div>
    <label class="switch"><input type="checkbox" class="anon-checkbox" checked><span class="slider"></span></label>
  </div>
</div>

<div class="panel" style="max-width:640px; background:#FDECEC; border-color:#F3C9C9;">
  <h3 style="color:#9A2B2B;">منطقة الخطر</h3>
  <p style="font-size:13.5px; margin-bottom:16px;">حذف حسابك سيؤدي إلى إزالة جميع بياناتك وسجل جلساتك بشكل نهائي.</p>
  <button class="btn btn-block" style="background:#C23B3B; color:#fff;" id="deleteAccountBtn">حذف الحساب</button>
</div>

<button class="btn btn-primary" style="max-width:200px;" id="saveSettingsBtn">حفظ التغييرات</button>

<div class="modal-overlay" id="deleteAccountModal">
  <div class="modal-box">
    <h3>تأكيد حذف الحساب</h3>
    <p>سيتم حذف حسابك وجميع بياناتك وسجل جلساتك بشكل نهائي ولا يمكن التراجع عن هذا الإجراء. هل تريد المتابعة؟</p>
    <div class="modal-actions">
      <button class="btn btn-ghost" id="cancelDeleteBtn">إلغاء</button>
      <button class="btn btn-danger" id="confirmDeleteBtn">حذف نهائيًا</button>
    </div>
  </div>
</div>
<div class="toast" id="settingsToast"></div>
@endsection

@push('scripts')
<script>
  (function () {
    function showToast(text) {
      const toast = document.getElementById('settingsToast');
      toast.textContent = text;
      toast.classList.add('show');
      setTimeout(() => toast.classList.remove('show'), 2200);
    }

    document.getElementById('saveSettingsBtn').addEventListener('click', () => {
      showToast('تم حفظ إعدادات الخصوصية بنجاح.');
    });

    const modal = document.getElementById('deleteAccountModal');
    document.getElementById('deleteAccountBtn').addEventListener('click', () => modal.classList.add('open'));
    document.getElementById('cancelDeleteBtn').addEventListener('click', () => modal.classList.remove('open'));
    modal.addEventListener('click', (e) => { if (e.target === modal) modal.classList.remove('open'); });
    document.getElementById('confirmDeleteBtn').addEventListener('click', () => {
      modal.classList.remove('open');
      showToast('تم حذف الحساب. سيتم تحويلك للصفحة الرئيسية...');
      setTimeout(() => { window.location.href = "{{ url('/') }}"; }, 1800);
    });
  })();
</script>
@endpush