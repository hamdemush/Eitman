@extends('layouts.therapist')

@section('title', 'الملف الشخصي | إطمئن')

@section('content')
<div class="dash-head">
  <div>
    <h1>الملف الشخصي</h1>
    <p>هذه المعلومات تظهر للمرضى في صفحتك العامة.</p>
  </div>
  <span class="pill approved">حساب معتمد</span>
</div>

<div class="panel" style="max-width:680px;">
  <h3>المعلومات الأساسية</h3>
  <div class="field-row">
    <div class="field"><label>الاسم</label><input type="text" id="profName" value="د. روان الأسي"></div>
    <div class="field"><label>التخصص الدقيق</label><input type="text" id="profSpecialty" value="علاج سلوكي معرفي (CBT)"></div>
  </div>
  <div class="field">
    <label>نبذة تعريفية</label>
    <textarea id="profBio" rows="4" style="width:100%; padding:13px 16px; border-radius:12px; border:1.5px solid var(--border); font-family:inherit; font-size:14px; background:var(--bg-card); color:var(--ink-900);">أعمل مع المرضى على تطوير أدوات عملية للتعامل مع القلق والتوتر الدراسي باستخدام أساليب العلاج السلوكي المعرفي.</textarea>
  </div>
  <div class="field"><label>مجالات التخصص (مفصولة بفاصلة)</label><input type="text" id="profTags" value="القلق, التوتر الدراسي, اضطرابات النوم الخفيفة, الثقة بالنفس"></div>
  <div class="field"><label>سنوات الخبرة</label><input type="number" id="profExp" min="0" value="6"></div>
</div>

<div class="panel" style="max-width:680px;">
  <h3>أساليب الجلسات المتاحة</h3>
  <div class="option-list">
    <label class="option selected"><input type="checkbox" checked> محادثة نصية</label>
    <label class="option selected"><input type="checkbox" checked> مكالمة صوتية</label>
    <label class="option selected"><input type="checkbox" checked> مكالمة فيديو</label>
  </div>
</div>

<div class="panel" style="max-width:680px; background:var(--lav-100); border-color:var(--lav-200);">
  <h4 style="margin-bottom:8px;">وثائق الاعتماد — الشهادات والخبرات</h4>
  <p style="font-size:13px; margin-bottom:14px;" id="certStatusNote">تمت الموافقة على شهادة الترخيص المهني من قِبل إدارة المنصة.</p>
  <div id="certList"></div>
  <label class="upload-box" for="addCertInput" style="margin-top:8px;">
    <div>+ إضافة شهادة أو مستند خبرة جديد</div>
    <input type="file" id="addCertInput" multiple accept=".pdf,.jpg,.jpeg,.png">
  </label>
</div>

<button class="btn btn-primary" id="saveProfileBtn" style="max-width:200px;">حفظ التغييرات</button>
<div class="toast" id="profileToast">تم حفظ التغييرات بنجاح</div>
@endsection

@push('scripts')
<script>
  (function () {
    const therapistId = Store.getCurrentTherapistId();
    let therapist = Store.getTherapist(therapistId);
    if (!therapist) therapist = Store.getTherapist('th-mariam');

    document.getElementById('profName').value = therapist.name || '';
    document.getElementById('profSpecialty').value = therapist.specialty || '';
    document.getElementById('profBio').value = therapist.bio || '';
    document.getElementById('profTags').value = therapist.tags || '';
    document.getElementById('profExp').value = therapist.experienceYears || 0;

    const statusNote = document.getElementById('certStatusNote');
    if (therapist.status === 'pending') {
      statusNote.textContent = 'شهاداتك قيد المراجعة من قِبل إدارة المنصة، ستصلك رسالة عند اعتمادها.';
    } else {
      statusNote.textContent = 'تمت الموافقة على شهادة الترخيص المهني من قِبل إدارة المنصة.';
    }

    function renderCertList() {
      const certList = document.getElementById('certList');
      certList.innerHTML = '';
      const certs = therapist.certificates || [];
      if (certs.length === 0) {
        certList.innerHTML = '<p style="font-size:13px; color:var(--ink-500);">لا توجد شهادات مرفقة بعد.</p>';
        return;
      }
      certs.forEach((cert) => {
        const row = document.createElement('div');
        row.className = 'cert-item';
        row.innerHTML =
          '<div><b>' + cert.name + '</b><span>أُرفقت بتاريخ ' + cert.uploadedAt + '</span></div>' +
          '<span class="pill ' + (cert.verified ? 'approved' : 'pending') + '">' + (cert.verified ? 'موثّقة' : 'قيد المراجعة') + '</span>';
        certList.appendChild(row);
      });
    }
    renderCertList();

    document.getElementById('addCertInput').addEventListener('change', (e) => {
      const files = Array.from(e.target.files);
      if (!therapist.certificates) therapist.certificates = [];
      files.forEach((f) => {
        therapist.certificates.push({
          id: 'cert-' + Date.now() + '-' + Math.random().toString(36).slice(2, 6),
          name: f.name, fileName: f.name,
          uploadedAt: new Date().toISOString().slice(0, 10), verified: false
        });
      });
      Store.saveTherapist(therapist);
      renderCertList();
      e.target.value = '';
    });

    document.getElementById('saveProfileBtn').addEventListener('click', () => {
      therapist.name = document.getElementById('profName').value.trim();
      therapist.specialty = document.getElementById('profSpecialty').value.trim();
      therapist.bio = document.getElementById('profBio').value.trim();
      therapist.tags = document.getElementById('profTags').value.trim();
      therapist.experienceYears = Number(document.getElementById('profExp').value) || 0;
      Store.saveTherapist(therapist);
      const toast = document.getElementById('profileToast');
      toast.classList.add('show');
      setTimeout(() => toast.classList.remove('show'), 2200);
    });
  })();
</script>
@endpush