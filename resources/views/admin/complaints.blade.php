@extends('layouts.admin')

@section('title', 'الشكاوى والتقارير | إطمئن')

@section('content')
<div class="dash-head">
  <div>
    <h1>الشكاوى والتقارير</h1>
    <p>بلاغات المرضى والمعالجين، وحالات الطوارئ التي تحتاج متابعة إدارية.</p>
  </div>
</div>

<div class="panel" id="complaintsPanel"></div>

<div class="panel" style="background:var(--lav-100); border-color:var(--lav-200);">
  <h4 style="margin-bottom:8px;">نظام التنبيه للحالات الحرجة</h4>
  <p style="font-size:13px;">عندما يرصد نظام تحليل المحادثات النصية مؤشرات خطر حقيقي (كذكر إيذاء النفس)، تُنشأ هنا تلقائيًا حالة "قيد المتابعة" ذات أولوية قصوى، بالتوازي مع تنبيه فوري للمعالج المسؤول وفريق الطوارئ الداخلي.</p>
</div>
@endsection

@push('scripts')
<script>
  (function () {
    const statusLabels = { open: 'مفتوحة', resolved: 'تم الحل', in_progress: 'قيد المتابعة' };
    const statusPillClass = { open: 'open', resolved: 'resolved', in_progress: 'open' };
    const panel = document.getElementById('complaintsPanel');

    const complaintDetailsBaseUrl = "{{ url('/admin/complaint-details') }}";

    function render() {
      const complaints = Store.getComplaints();
      panel.innerHTML = '';
      complaints.forEach((c) => {
        const item = document.createElement('div');
        item.className = 'session-item';
        const isCritical = c.status === 'open' || c.status === 'in_progress';
        
        const detailsUrl = complaintDetailsBaseUrl + '?id=' + encodeURIComponent(c.id);

        item.innerHTML =
          '<div class="avatar" style="background:' + (isCritical ? '#FDECEC' : '#FDF3DA') + '; color:' + (isCritical ? '#B03434' : '#8A6116') + ';">' +
          '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><path d="M12 9v4M12 17h.01"/></svg>' +
          '</div>' +
          '<div style="flex:1;"><b>' + AdminUI.escapeHtml(c.title) + '</b><span>بلاغ من ' + AdminUI.escapeHtml(c.complainantName) + (c.accusedType !== 'system' ? ' بحق ' + AdminUI.escapeHtml(c.accusedName) : '') + ' — ' + AdminUI.escapeHtml(c.dateLabel) + '</span></div>' +
          '<span class="pill ' + statusPillClass[c.status] + '">' + statusLabels[c.status] + '</span>' +
          '<a href="' + detailsUrl + '" class="btn btn-ghost btn-sm" style="margin-inline-start:10px;">معاينة</a>';
        panel.appendChild(item);
      });
    }

    render();
  })();
</script>
@endpush