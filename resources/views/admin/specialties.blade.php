@extends('layouts.admin')

@section('title', 'التخصصات | إطمئن')

@section('content')
<div class="dash-head">
  <div>
    <h1>إدارة التخصصات</h1>
    <p>التخصصات المستخدمة في الاستبيان الأولي ونظام المطابقة الذكي.</p>
  </div>
  <button class="btn btn-primary btn-sm" id="addSpecialtyBtn">+ إضافة تخصص</button>
</div>

<div class="panel">
  <table class="data-table">
    <thead>
      <tr>
        <th>اسم التخصص</th>
        <th>عدد المعالجين</th>
        <th>عدد الحالات المرتبطة</th>
        <th>الحالة</th>
        <th>الإجراء</th>
      </tr>
    </thead>
    <tbody id="specialtiesBody"></tbody>
  </table>
</div>

{{-- النافذة المنبثقة لتعديل وإضافة التخصص --}}
<div class="modal-overlay" id="editModal">
  <div class="modal-box">
    <h3 id="modalTitle">تعديل التخصص</h3>
    <div class="field" style="margin-bottom:14px;">
      <label for="editNameInput">اسم التخصص</label>
      <input type="text" id="editNameInput" style="width:100%; padding:12px 14px; border-radius:12px; border:1.5px solid var(--border); font-family:inherit; font-size:14px; background:var(--bg-card); color:var(--ink-900);">
    </div>
    <div class="modal-actions">
      <button class="btn btn-ghost" id="editCancelBtn">إلغاء</button>
      <button class="btn btn-primary" id="editSaveBtn">حفظ التعديلات</button>
    </div>
  </div>
</div>

<div class="toast" id="specialtiesToast"></div>
@endsection

@push('scripts')
<script>
  (function () {
    const tbody = document.getElementById('specialtiesBody');
    const editModal = document.getElementById('editModal');
    const editNameInput = document.getElementById('editNameInput');
    const editSaveBtn = document.getElementById('editSaveBtn');
    const editCancelBtn = document.getElementById('editCancelBtn');
    const addSpecialtyBtn = document.getElementById('addSpecialtyBtn');
    const modalTitle = document.getElementById('modalTitle');
    let editingId = null;

    function render() {
      const specialties = Store.getSpecialties();
      tbody.innerHTML = '';
      specialties.forEach((sp) => {
        const tr = document.createElement('tr');
        tr.innerHTML =
          '<td>' + AdminUI.escapeHtml(sp.name) + (sp.active ? '' : ' (قيد المراجعة)') + '</td>' +
          '<td>' + sp.therapistsCount + '</td>' +
          '<td>' + sp.casesCount + '</td>' +
          '<td><span class="pill ' + (sp.active ? 'approved' : 'pending') + '">' + (sp.active ? 'مفعّل' : 'غير مفعّل') + '</span></td>' +
          '<td>' +
            '<div style="display:flex; gap:8px; align-items:center; justify-content:flex-end;">' +
            (sp.active ? '' : '<button class="approve" style="border:1.5px solid var(--border); border-radius:8px; padding:6px 12px; font-size:12.5px; background:none; cursor:pointer;" data-action="activate" data-id="' + sp.id + '">تفعيل</button>') +
            '<div class="action-menu-wrap">' +
              '<button class="action-menu-trigger" type="button" data-menu-trigger aria-label="خيارات">⋮</button>' +
              '<div class="action-menu">' +
                '<button data-action="edit" data-id="' + sp.id + '">✏️ تعديل</button>' +
                '<button class="danger" data-action="delete" data-id="' + sp.id + '">🗑️ حذف</button>' +
              '</div>' +
            '</div>' +
            '</div>' +
          '</td>';
        tbody.appendChild(tr);
      });
    }

    tbody.addEventListener('click', (e) => {
      const target = e.target.closest('button');
      if (!target) return;
      const action = target.getAttribute('data-action');
      const id = target.getAttribute('data-id');

      if (action === 'activate') {
        Store.updateSpecialty(id, { active: true });
        render();
      } else if (action === 'edit') {
        const specialties = Store.getSpecialties();
        const item = specialties.find(s => s.id === id);
        if (item) {
          editingId = id;
          modalTitle.textContent = 'تعديل التخصص';
          editNameInput.value = item.name;
          editModal.classList.add('active');
        }
      } else if (action === 'delete') {
        if (confirm('هل أنت تأكد من حذف هذا التخصص؟')) {
          Store.deleteSpecialty(id);
          render();
        }
      }
    });

    addSpecialtyBtn.addEventListener('click', () => {
      editingId = null;
      modalTitle.textContent = 'إضافة تخصص جديد';
      editNameInput.value = '';
      editModal.classList.add('active');
    });

    editCancelBtn.addEventListener('click', () => {
      editModal.classList.remove('active');
    });

    editSaveBtn.addEventListener('click', () => {
      const name = editNameInput.value.trim();
      if (!name) return;

      if (editingId) {
        Store.updateSpecialty(editingId, { name });
      } else {
        Store.addSpecialty({ name, therapistsCount: 0, casesCount: 0, active: true });
      }

      editModal.classList.remove('active');
      render();
    });

    render();
  })();
</script>
@endpush