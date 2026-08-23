@extends('layouts.therapist')

@section('title', 'طلبات الاستشارة | إطمئن')

@section('content')
<div class="dash-head">
  <div>
    <h1>طلبات الاستشارة</h1>
    <p>طلبات وصلتك عبر نظام المطابقة الذكي، بانتظار قبولك.</p>
  </div>
</div>

<div class="panel" id="requestsPanel">
  <p id="noRequestsMsg" style="display:none; color:var(--ink-500); font-size:14px;">لا توجد طلبات استشارة جديدة حاليًا.</p>
</div>

<div class="toast" id="requestsToast"></div>
@endsection

@push('scripts')
<script>
  (function () {
    const therapistId = Store.getCurrentTherapistId();
    const panel = document.getElementById('requestsPanel');
    const emptyMsg = document.getElementById('noRequestsMsg');

    function showToast(text) {
      const toast = document.getElementById('requestsToast');
      toast.textContent = text;
      toast.classList.add('show');
      setTimeout(() => toast.classList.remove('show'), 2200);
    }

    function render() {
      const pending = Store.getPendingSessions(therapistId);
      panel.querySelectorAll('.session-item').forEach((el) => el.remove());
      emptyMsg.style.display = pending.length === 0 ? 'block' : 'none';

      pending.forEach((session) => {
        const item = document.createElement('div');
        item.className = 'session-item';
        const matchLabel = session.matchPct ? ' — نسبة توافق ' + session.matchPct + '٪' : '';
        item.innerHTML =
          '<div class="avatar">' + (session.patient ? session.patient.initials : 'ط') + '</div>' +
          '<div style="flex:1;"><b>' + (session.patient ? session.patient.name : 'مستخدم') + '</b>' +
          '<span>' + session.topic + ' — ' + session.requestedLabel + matchLabel + '</span></div>' +
          '<div class="table-actions">' +
          '<button class="approve" data-id="' + session.id + '" data-action="accept">قبول</button>' +
          '<button class="reject" data-id="' + session.id + '" data-action="reject">رفض</button>' +
          '</div>';
        panel.appendChild(item);
      });
    }

    panel.addEventListener('click', (e) => {
      const btn = e.target.closest('button[data-action]');
      if (!btn) return;
      const id = btn.getAttribute('data-id');
      if (btn.getAttribute('data-action') === 'accept') {
        Store.acceptSession(id);
        showToast('تم قبول الطلب، وتم إنشاء محادثة تلقائيًا مع المستخدم.');
      } else {
        Store.rejectSession(id);
        showToast('تم رفض الطلب.');
      }
      render();
    });

    render();
  })();
</script>
@endpush