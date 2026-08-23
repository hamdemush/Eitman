@extends('layouts.admin')

@section('title', 'اعتماد المعالجين | إطمئن')

@section('content')
<div class="dash-head">
  <div>
    <h1>اعتماد المعالجين</h1>
    <p>راجع طلبات انضمام المعالجين الجدد ووثائقهم قبل الموافقة.</p>
  </div>
</div>

<div class="panel">
  <table class="data-table">
    <thead>
      <tr>
        <th>المعالج</th>
        <th>التخصص</th>
        <th>تاريخ التقديم</th>
        <th>الحالة</th>
        <th>الإجراء</th>
      </tr>
    </thead>
    <tbody id="approvalsBody"></tbody>
  </table>
</div>

<div class="toast" id="therapistsToast"></div>
@endsection

@push('scripts')
<script>
  (function () {
    const tbody = document.getElementById('approvalsBody');
    const profileBaseUrl = "{{ url('/admin/therapist-profile') }}";

    function initials(name) {
      const parts = (name || '').replace('د. ', '').split(' ');
      return (parts[0] ? parts[0][0] : '') + '.' + (parts[1] ? parts[1][0] : '');
    }

    function render() {
      const pending = Store.getPendingTherapists();
      const approved = Store.getApprovedTherapists();
      const frozen = Store.getFrozenTherapists();
      const rejected = Store.getRejectedTherapists();

      tbody.innerHTML = '';

      pending.forEach((a) => {
        const tr = document.createElement('tr');
        tr.innerHTML =
          '<td><div class="table-row-user"><div class="avatar" style="width:34px;height:34px;font-size:12px;">' + initials(a.name) + '</div><span>' + AdminUI.escapeHtml(a.name) + '</span></div></td>' +
          '<td>' + AdminUI.escapeHtml(a.specialty || '—') + '</td><td>' + AdminUI.escapeHtml(a.submittedLabel || '—') + '</td>' +
          '<td><span class="pill pending">قيد المراجعة</span></td>' +
          '<td><div class="table-actions"><a href="' + profileBaseUrl + '?id=' + encodeURIComponent(a.id) + '&source=' + (a.source || '') + '">عرض الملف</a></div></td>';
        tbody.appendChild(tr);
      });

      approved.forEach((t) => {
        const tr = document.createElement('tr');
        tr.innerHTML =
          '<td><div class="table-row-user"><div class="avatar" style="width:34px;height:34px;font-size:12px;">' + (t.initials || initials(t.name)) + '</div><span>' + AdminUI.escapeHtml(t.name) + '</span></div></td>' +
          '<td>' + AdminUI.escapeHtml(t.specialty || '—') + '</td><td>—</td>' +
          '<td><span class="pill approved">معتمد</span></td>' +
          '<td><div class="table-actions"><a href="' + profileBaseUrl + '?id=' + encodeURIComponent(t.id) + '&source=approved">عرض الملف</a></div></td>';
        tbody.appendChild(tr);
      });

      frozen.forEach((t) => {
        const tr = document.createElement('tr');
        tr.innerHTML =
          '<td><div class="table-row-user"><div class="avatar" style="width:34px;height:34px;font-size:12px;">' + (t.initials || initials(t.name)) + '</div><span>' + AdminUI.escapeHtml(t.name) + '</span></div></td>' +
          '<td>' + AdminUI.escapeHtml(t.specialty || '—') + '</td><td>—</td>' +
          '<td><span class="pill frozen">مجمّد</span></td>' +
          '<td><div class="table-actions"><a href="' + profileBaseUrl + '?id=' + encodeURIComponent(t.id) + '&source=approved">عرض الملف</a></div></td>';
        tbody.appendChild(tr);
      });

      rejected.forEach((r) => {
        const tr = document.createElement('tr');
        tr.innerHTML =
          '<td><div class="table-row-user"><div class="avatar" style="width:34px;height:34px;font-size:12px;">' + initials(r.name) + '</div><span>' + AdminUI.escapeHtml(r.name) + '</span></div></td>' +
          '<td>' + AdminUI.escapeHtml(r.specialty || '—') + '</td><td>—</td>' +
          '<td><span class="pill rejected">مرفوض</span></td>' +
          '<td><div class="table-actions"><a href="' + profileBaseUrl + '?id=' + encodeURIComponent(r.id) + '&source=rejected">عرض السبب</a></div></td>';
        tbody.appendChild(tr);
      });
    }

    render();
  })();
</script>
@endpush