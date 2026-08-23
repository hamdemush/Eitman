@extends('layouts.app')

@section('title', 'لوحة التحكم الرئيسيّة | الأدمن')

@section('content')
<section class="section" style="padding-top: 30px;">
  <div class="container">
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
      <div>
        <h1 style="font-size: 26px; font-weight: bold;">لوحة تحكم النظام</h1>
        <p style="color: var(--text-muted); font-size: 14px;">متابعة إحصائيات منصة إطمئن والحسابات النشطة</p>
      </div>
      <button onclick="fetchAdminStats()" class="btn btn-sm btn-primary" style="display: flex; align-items: center; gap: 5px;">
       تحديث البيانات
      </button>
    </div>

    <!-- بطاقات الإحصائيات (Stats Cards) -->
    <div class="grid grid-4" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 35px;">
      
      <!-- إجمالي الطلاب -->
      <div class="question-card" style="padding: 20px; border-right: 4px solid var(--teal-700);">
        <p style="color: var(--text-muted); font-size: 13px; margin-bottom: 8px;">إجمالي الطلاب / المرضى</p>
        <h2 id="totalPatients" style="font-size: 28px; font-weight: bold;">--</h2>
      </div>

      <!-- إجمالي المعالجين -->
      <div class="question-card" style="padding: 20px; border-right: 4px solid #2196F3;">
        <p style="color: var(--text-muted); font-size: 13px; margin-bottom: 8px;">المعالجين المعتمدين</p>
        <h2 id="totalDoctors" style="font-size: 28px; font-weight: bold;">--</h2>
      </div>

      <!-- الطلبات المعلقة -->
      <div class="question-card" style="padding: 20px; border-right: 4px solid #FF9800;">
        <p style="color: var(--text-muted); font-size: 13px; margin-bottom: 8px;">طلبات معالجين معلقة</p>
        <h2 id="pendingDoctors" style="font-size: 28px; font-weight: bold;">--</h2>
      </div>

      <!-- الجلسات المنفذة -->
      <div class="question-card" style="padding: 20px; border-right: 4px solid #4CAF50;">
        <p style="color: var(--text-muted); font-size: 13px; margin-bottom: 8px;">إجمالي الجلسات</p>
        <h2 id="totalSessions" style="font-size: 28px; font-weight: bold;">--</h2>
      </div>

    </div>

    <!-- جدول المعالجين بانتظار الموافقة -->
    <div class="question-card" style="padding: 0; overflow: hidden;">
      <div style="padding: 18px 20px; background: #f8f9fa; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center;">
        <h3 style="font-size: 16px; font-weight: bold; margin: 0;">طلبات انضمام الأخصائيين الجدد</h3>
        <a href="{{ route('admin.therapists') }}" style="font-size: 13px; color: var(--teal-700); text-decoration: underline;">عرض الكل</a>
      </div>

      <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; text-align: right; font-size: 14px;">
          <thead>
            <tr style="background: #ffffff; border-bottom: 2px solid var(--border-color); color: var(--text-muted);">
              <th style="padding: 12px 20px;">الاسم</th>
              <th style="padding: 12px 20px;">البريد الإلكتروني</th>
              <th style="padding: 12px 20px;">التاريخ</th>
              <th style="padding: 12px 20px; text-align: center;">التحكم</th>
            </tr>
          </thead>
          <tbody id="pendingPsychologistsTable">
            <tr><td colspan="4" style="text-align: center; padding: 25px; color: var(--text-muted);">جاري تحميل الطلبات...</td></tr>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    fetchAdminStats();
    fetchPendingPsychologists();
});

// 1. جلب الإحصائيات العامة
async function fetchAdminStats() {
    const token = localStorage.getItem('auth_token');
    try {
        const res = await fetch('/api/admin/stats', {
            headers: { 
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json' 
            }
        });
        const data = await res.json();

        if (res.ok) {
            document.getElementById('totalPatients').innerText = data.total_patients || data.patients_count || 0;
            document.getElementById('totalDoctors').innerText = data.total_doctors || data.psychologists_count || 0;
            document.getElementById('pendingDoctors').innerText = data.pending_doctors || data.pending_count || 0;
            document.getElementById('totalSessions').innerText = data.total_sessions || data.sessions_count || 0;
        }
    } catch (err) {
        console.error('فشل جلب إحصائيات الأدمن:', err);
    }
}

// 2. جلب الطلبات المعلقة للمعالجين
async function fetchPendingPsychologists() {
    const token = localStorage.getItem('auth_token');
    const tableBody = document.getElementById('pendingPsychologistsTable');

    try {
        const res = await fetch('/api/admin/pending-psychologists', {
            headers: { 
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json' 
            }
        });
        const data = await res.json();
        const pendingList = Array.isArray(data) ? data : (data.data || []);

        if (pendingList.length === 0) {
            tableBody.innerHTML = '<tr><td colspan="4" style="text-align: center; padding: 25px; color: var(--text-muted);">لا توجد طلبات انضمام معلقة حالياً.</td></tr>';
            return;
        }

        tableBody.innerHTML = '';
        pendingList.forEach(doc => {
            const tr = document.createElement('tr');
            tr.style.borderBottom = '1px solid var(--border-color)';
            tr.innerHTML = `
                <td style="padding: 12px 20px; font-weight: bold;">${doc.name}</td>
                <td style="padding: 12px 20px;">${doc.email}</td>
                <td style="padding: 12px 20px; color: var(--text-muted);">${new Date(doc.created_at || Date.now()).toLocaleDateString('ar-EG')}</td>
                <td style="padding: 12px 20px; text-align: center;">
                    <button onclick="approvePsychologist(${doc.id})" class="btn btn-sm btn-primary" style="padding: 4px 12px; font-size: 12px; margin-left: 5px;">قبول</button>
                    <button onclick="rejectPsychologist(${doc.id})" class="btn btn-sm" style="padding: 4px 12px; font-size: 12px; background: #ffebee; color: #c62828;">رفض</button>
                </td>
            `;
            tableBody.appendChild(tr);
        });
    } catch (err) {
        tableBody.innerHTML = '<tr><td colspan="4" style="text-align: center; padding: 25px; color: #c62828;">تعذر تحميل بيانات الطلبات.</td></tr>';
    }
}

// 3. قبول معالج
async function approvePsychologist(id) {
    const token = localStorage.getItem('auth_token');
    if (!confirm('هل أنت تأكد من قبول طلب هذا المعالج؟')) return;

    try {
        const res = await fetch(`/api/admin/psychologists/${id}/approve`, {
            method: 'PUT',
            headers: { 
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json' 
            }
        });
        if (res.ok) {
            fetchAdminStats();
            fetchPendingPsychologists();
        }
    } catch (err) {
        alert('حدث خطأ أثناء تنفيذ الطلب.');
    }
}

// 4. رفض معالج
async function rejectPsychologist(id) {
    const token = localStorage.getItem('auth_token');
    if (!confirm('هل أنت تأكد من رفض هذا الطلب؟')) return;

    try {
        const res = await fetch(`/api/admin/psychologists/${id}/reject`, {
            method: 'DELETE',
            headers: { 
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json' 
            }
        });
        if (res.ok) {
            fetchAdminStats();
            fetchPendingPsychologists();
        }
    } catch (err) {
        alert('حدث خطأ أثناء تنفيذ الطلب.');
    }
}
</script>
@endsection