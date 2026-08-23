@extends('layouts.admin')

@section('title', 'لوحة المدير | إطمئن')

@section('content')
<div class="dash-head">
  <div>
    <h1>لوحة تحكم المدير</h1>
    <p>نظرة عامة على أداء المنصة اليوم.</p>
  </div>
</div>

<div class="stat-cards">
  <div class="stat-card">
    <div class="ico">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/>
      </svg>
    </div>
    <b id="stat-patients">0</b><span>مريض مسجّل</span>
  </div>
  <div class="stat-card">
    <div class="ico">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M9 12l2 2 4-4"/><circle cx="12" cy="12" r="10"/>
      </svg>
    </div>
    <b id="stat-therapists">0</b><span>معالج معتمد</span>
  </div>
  <div class="stat-card">
    <div class="ico">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 10h18"/>
      </svg>
    </div>
    <b id="stat-sessions">0</b><span>جلسة هذا الشهر</span>
  </div>
  <div class="stat-card">
    <div class="ico">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><path d="M12 9v4M12 17h.01"/>
      </svg>
    </div>
    <b id="stat-complaints">0</b><span>شكاوى مفتوحة</span>
  </div>
</div>

<div class="dash-grid">
  <div>
    <div class="panel">
      <h3>طلبات اعتماد معالجين جدد</h3>
      <div id="pending-therapists-list">
        <p style="color:var(--text-muted); font-size:14px; padding:12px 0;">لا توجد طلبات اعتماد معلقة حالياً.</p>
      </div>
      <a href="{{ url('/admin/therapists') }}" class="link-arrow" style="margin-top:14px;">عرض جميع الطلبات
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l-6 6 6 6"/></svg>
      </a>
    </div>

    <div class="panel">
      <h3>أحدث الشكاوى</h3>
      <div id="recent-complaints-list">
        <p style="color:var(--text-muted); font-size:14px; padding:12px 0;">لا توجد شكاوى حالياً.</p>
      </div>
      <a href="{{ url('/admin/complaints') }}" class="link-arrow" style="margin-top:14px;">عرض جميع الشكاوى
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l-6 6 6 6"/></svg>
      </a>
    </div>
  </div>

  <div>
    <div class="panel">
      <h3>الجلسات — آخر 6 أسابيع</h3>
      <div class="mood-chart">
        <div class="bar-wrap"><div class="bar" style="height:0%;"></div><span>أسبوع 1</span></div>
        <div class="bar-wrap"><div class="bar" style="height:0%;"></div><span>أسبوع 2</span></div>
        <div class="bar-wrap"><div class="bar" style="height:0%;"></div><span>أسبوع 3</span></div>
        <div class="bar-wrap"><div class="bar" style="height:0%;"></div><span>أسبوع 4</span></div>
        <div class="bar-wrap"><div class="bar" style="height:0%;"></div><span>أسبوع 5</span></div>
        <div class="bar-wrap"><div class="bar" style="height:0%;"></div><span>أسبوع 6</span></div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', () => {
    if (typeof Store === 'undefined') return;

    const patients = Store.getPlatformUsers();
    const therapists = Store.getApprovedTherapists();
    const pendingTherapists = Store.getPendingTherapists();
    const complaints = Store.getComplaints();
    const openComplaints = complaints.filter(c => c.status === 'open');

    document.getElementById('stat-patients').textContent = patients.length;
    document.getElementById('stat-therapists').textContent = therapists.length;
    document.getElementById('stat-sessions').textContent = 0;
    document.getElementById('stat-complaints').textContent = openComplaints.length;

    const pendingContainer = document.getElementById('pending-therapists-list');
    if (pendingTherapists.length > 0) {
      pendingContainer.innerHTML = pendingTherapists.slice(0, 3).map(t => `
        <div class="session-item">
          <div class="avatar">${t.initials || 'م'}</div>
          <div style="flex:1;"><b>${AdminUI ? AdminUI.escapeHtml(t.name) : t.name}</b><span>${t.specialty || 'تخصص عام'}</span></div>
          <span class="pill pending">قيد المراجعة</span>
        </div>
      `).join('');
    }

    const complaintsContainer = document.getElementById('recent-complaints-list');
    if (complaints.length > 0) {
      complaintsContainer.innerHTML = complaints.slice(0, 3).map(c => `
        <div class="session-item">
          <div class="avatar">ط</div>
          <div style="flex:1;"><b>${AdminUI ? AdminUI.escapeHtml(c.title || 'بلاغ') : (c.title || 'بلاغ')}</b><span>بلاغ من ${c.userName || 'مجهول'}</span></div>
          <span class="pill ${c.status === 'resolved' ? 'resolved' : 'open'}">${c.status === 'resolved' ? 'تم الحل' : 'مفتوحة'}</span>
        </div>
      `).join('');
    }
  });
</script>
@endpush