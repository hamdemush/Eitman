@extends('layouts.app')

@section('title', 'جدول المواعيد | الطبيب')

@section('content')
<section class="section">
  <div class="container">
    <h2 style="margin-bottom: 20px;">طلبات الحجز والمواعيد القادمة</h2>

    <div class="question-card" style="padding: 0; overflow-x: auto;">
      <table style="width: 100%; border-collapse: collapse; text-align: right;">
        <thead>
          <tr style="background: #f4f6f8; border-bottom: 2px solid var(--border-color);">
            <th style="padding: 12px;">اسم الطالب/المريض</th>
            <th style="padding: 12px;">التاريخ والوقت</th>
            <th style="padding: 12px;">الحالة</th>
            <th style="padding: 12px;">الإجراء</th>
          </tr>
        </thead>
        <tbody id="appointmentsTable">
          <tr><td colspan="4" style="text-align: center; padding: 20px;">جاري تحميل المواعيد...</td></tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', async function () {
    const token = localStorage.getItem('auth_token');
    const tableBody = document.getElementById('appointmentsTable');

    try {
        const res = await fetch('/api/psychologist/appointments', {
            headers: { 'Authorization': `Bearer ${token}`, 'Accept': 'application/json' }
        });
        const data = await res.json();
        const appointments = Array.isArray(data) ? data : (data.data || []);

        if (appointments.length === 0) {
            tableBody.innerHTML = '<tr><td colspan="4" style="text-align: center; padding: 20px;">لا توجد مواعيد مسجلة حالياً.</td></tr>';
            return;
        }

        tableBody.innerHTML = '';
        appointments.forEach(app => {
            const tr = document.createElement('tr');
            tr.style.borderBottom = '1px solid var(--border-color)';
            tr.innerHTML = `
                <td style="padding: 12px;">${app.patient_name || app.user?.name || 'مريض'}</td>
                <td style="padding: 12px;">${app.date || app.scheduled_at || 'غير محدد'}</td>
                <td style="padding: 12px;"><span style="padding: 4px 8px; border-radius: 4px; font-size: 12px; background: #e0f2f1; color: var(--teal-700);">${app.status || 'معلق'}</span></td>
                <td style="padding: 12px;">
                    <button onclick="updateStatus(${app.id}, 'approved')" class="btn btn-sm btn-primary">قبول</button>
                    <button onclick="updateStatus(${app.id}, 'rejected')" class="btn btn-sm" style="background:#ffebee; color:red;">رفض</button>
                </td>
            `;
            tableBody.appendChild(tr);
        });
    } catch (err) {
        tableBody.innerHTML = '<tr><td colspan="4" style="text-align: center; color: red; padding: 20px;">حدث خطأ أثناء جلب المواعيد.</td></tr>';
    }
});

async function updateStatus(id, status) {
    const token = localStorage.getItem('auth_token');
    await fetch(`/api/psychologist/appointments/${id}/status`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json'
        },
        body: JSON.stringify({ status })
    });
    location.reload();
}
</script>
@endsection