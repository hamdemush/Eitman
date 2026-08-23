@extends('layouts.admin')

@section('title', 'إدارة المستخدمين | إطمئن')

@section('content')
<div class="dash-head">
  <div>
    <h1>إدارة المستخدمين</h1>
    <p>كل حسابات المرضى المسجّلين في المنصة.</p>
  </div>
</div>

<div class="filter-bar">
  <div class="search-input">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      <circle cx="11" cy="11" r="7"/>
      <path d="M21 21l-4-4"/>
    </svg>
    <input type="text" id="searchInput" placeholder="ابحث بالاسم أو البريد الإلكتروني...">
  </div>
  <select id="statusFilter">
    <option value="">كل الحالات</option>
    <option value="pending">قيد المراجعة</option>
    <option value="accepted">مقبول</option>
    <option value="rejected">مرفوض</option>
    <option value="deleted">محذوف</option>
  </select>
</div>

<div class="panel">
  <table class="data-table">
    <thead>
      <tr>
        <th>المريض</th>
        <th>الجامعة</th>
        <th>عدد الجلسات</th>
        <th>الوضع المجهول</th>
        <th>الحالة</th>
        <th>الإجراء</th>
      </tr>
    </thead>
    <tbody id="usersBody"></tbody>
  </table>
  <p id="emptyMsg" style="display:none; text-align:center; color:var(--ink-500); padding:24px 0;">لا يوجد مستخدمون مطابقون.</p>
</div>

<div class="toast" id="usersToast"></div>
@endsection

@push('scripts')
<script>
  (function () {
    const tbody = document.getElementById('usersBody');
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const profileBaseUrl = "{{ url('/admin/patient-profile') }}";

    function initials(name) {
      const parts = (name || '').replace('مريض مجهول ', 'م ').split(' ');
      return (parts[0] ? parts[0][0] : 'م') + (parts[1] ? '.' + parts[1][0] : '');
    }

    function render() {
      let users = Store.getPlatformUsers();
      const q = searchInput.value.trim().toLowerCase();
      const statusQ = statusFilter.value;

      if (q) {
        users = users.filter((u) => u.name.toLowerCase().includes(q) || (u.email || '').toLowerCase().includes(q));
      }
      if (statusQ) {
        users = users.filter((u) => u.status === statusQ);
      }

      tbody.innerHTML = '';
      document.getElementById('emptyMsg').style.display = users.length ? 'none' : 'block';

      users.forEach((u) => {
        const tr = document.createElement('tr');
        const label = AdminUI.patientStatusLabel[u.status] || u.status;
        const pillClass = AdminUI.patientStatusPill[u.status] || 'pending';
        
        tr.innerHTML =
          '<td><div class="table-row-user"><div class="avatar" style="width:34px;height:34px;font-size:12px;">' + initials(u.name) + '</div><span>' + AdminUI.escapeHtml(u.name) + '</span></div></td>' +
          '<td>' + AdminUI.escapeHtml(u.university || '—') + '</td>' +
          '<td>' + u.sessionsCount + '</td>' +
          '<td><span class="pill ' + (u.anonymousMode ? 'approved' : 'rejected') + '">' + (u.anonymousMode ? 'مفعّل' : 'غير مفعّل') + '</span></td>' +
          '<td><span class="pill ' + pillClass + '">' + label + '</span></td>' +
          '<td><div class="table-actions"><a href="' + profileBaseUrl + '?id=' + encodeURIComponent(u.id) + '">عرض الملف</a></div></td>';
        
        tbody.appendChild(tr);
      });
    }

    searchInput.addEventListener('input', render);
    statusFilter.addEventListener('change', render);
    render();
  })();
</script>
@endpush