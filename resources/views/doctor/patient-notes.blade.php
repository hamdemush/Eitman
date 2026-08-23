@extends('layouts.therapist')

@section('title', 'المرضى | إطمئن')

@section('content')
<div class="dash-head">
  <div>
    <h1>المرضى</h1>
    <p>السجل العلاجي وملاحظات الجلسات لكل مريض.</p>
  </div>
</div>

<div class="dash-grid">
  <div>
    <div class="panel" id="patientListPanel">
      <h3>قائمة المرضى النشطين</h3>
      <div id="patientList"></div>
    </div>
  </div>

  <div>
    <div class="panel">
      <h3 id="notesHeading">السجل العلاجي</h3>
      <div id="noPatientSelected" style="display:none; color:var(--ink-500); font-size:14px;">اختر مريضًا من القائمة لعرض سجله وكتابة ملاحظة جديدة.</div>
      <div id="notesForm">
        <div class="field">
          <label>ملاحظة جلسة جديدة</label>
          <textarea id="newNoteText" rows="4" style="width:100%; padding:13px 16px; border-radius:12px; border:1.5px solid var(--border); font-family:inherit; font-size:14px; background:var(--bg-card); color:var(--ink-900);" placeholder="اكتب ملاحظاتك عن الجلسة هنا..."></textarea>
        </div>
        <div class="field">
          <label>الخطة العلاجية</label>
          <select id="newNotePlan" style="width:100%;">
            <option>علاج سلوكي معرفي — مرحلة إعادة الهيكلة المعرفية</option>
            <option>علاج سلوكي معرفي — مرحلة التعرض التدريجي</option>
            <option>متابعة ومراقبة فقط</option>
          </select>
        </div>
        <button class="btn btn-primary btn-block" id="saveNoteBtn">حفظ الملاحظات</button>
      </div>

      <h3 style="margin-top:26px;">سجل الملاحظات السابقة</h3>
      <div id="notesHistory"></div>
    </div>
  </div>
</div>

<div class="toast" id="notesToast"></div>
@endsection

@push('scripts')
<script>
  (function () {
    const therapistId = Store.getCurrentTherapistId();
    const patientListEl = document.getElementById('patientList');
    const notesHeading = document.getElementById('notesHeading');
    const notesForm = document.getElementById('notesForm');
    const noPatientSelected = document.getElementById('noPatientSelected');
    const notesHistory = document.getElementById('notesHistory');
    let activePatientId = null;

    function showToast(text) {
      const toast = document.getElementById('notesToast');
      toast.textContent = text;
      toast.classList.add('show');
      setTimeout(() => toast.classList.remove('show'), 2200);
    }

    function renderPatientList() {
      const sessions = Store.getAcceptedSessionsForTherapist(therapistId);
      patientListEl.innerHTML = '';
      if (sessions.length === 0) {
        patientListEl.innerHTML = '<p style="font-size:13px; color:var(--ink-500);">لا يوجد مرضى نشطون حاليًا. اقبل طلب استشارة أولًا.</p>';
        return;
      }
      sessions.forEach((s) => {
        const p = s.patient;
        const item = document.createElement('div');
        item.className = 'session-item' + (s.patientId === activePatientId ? ' selected-row' : '');
        item.style.cursor = 'pointer';
        item.dataset.patientId = s.patientId;
        item.innerHTML =
          '<div class="avatar">' + (p ? p.initials : 'ط') + '</div>' +
          '<div style="flex:1;"><b>' + (p ? p.name : 'مريض') + '</b><span>' + (s.sessionsCount || 1) + ' جلسات — ' + s.topic + '</span></div>' +
          '<span class="pill upcoming">نشط</span>';
        item.addEventListener('click', () => selectPatient(s.patientId, p ? p.name : 'مريض'));
        patientListEl.appendChild(item);
      });

      if (!activePatientId && sessions.length > 0) {
        selectPatient(sessions[0].patientId, sessions[0].patient ? sessions[0].patient.name : 'مريض');
      }
    }

    function selectPatient(patientId, patientName) {
      activePatientId = patientId;
      patientListEl.querySelectorAll('.session-item').forEach((el) => {
        el.style.outline = el.dataset.patientId === patientId ? '2px solid var(--teal-500)' : 'none';
      });
      notesHeading.textContent = 'السجل العلاجي — ' + patientName;
      notesForm.style.display = 'block';
      noPatientSelected.style.display = 'none';
      renderNotesHistory();
    }

    function renderNotesHistory() {
      const notes = Store.getPatientNotes(activePatientId);
      notesHistory.innerHTML = '';
      if (notes.length === 0) {
        notesHistory.innerHTML = '<p style="font-size:13px; color:var(--ink-500);">لا توجد ملاحظات محفوظة بعد لهذا المريض.</p>';
        return;
      }
      notes.forEach((n) => {
        const row = document.createElement('div');
        row.style.cssText = 'border:1px solid var(--border); border-radius:10px; padding:12px 14px; margin-bottom:10px;';
        row.innerHTML =
          '<span style="font-size:12px; color:var(--ink-500); display:block; margin-bottom:6px;">' + n.date + ' — ' + n.plan + '</span>' +
          '<p style="font-size:13.5px; color:var(--ink-700);">' + n.text + '</p>';
        notesHistory.appendChild(row);
      });
    }

    document.getElementById('saveNoteBtn').addEventListener('click', () => {
      if (!activePatientId) return;
      const text = document.getElementById('newNoteText').value.trim();
      const plan = document.getElementById('newNotePlan').value;
      if (!text) { showToast('يرجى كتابة الملاحظة أولًا.'); return; }
      Store.savePatientNote(activePatientId, { text, plan });
      document.getElementById('newNoteText').value = '';
      renderNotesHistory();
      showToast('تم حفظ الملاحظات بنجاح.');
    });

    renderPatientList();
  })();
</script>
@endpush