@extends('layouts.therapist')

@section('title', 'الدردشة | إطمئن')

@section('content')
<div class="dash-head">
  <div>
    <h1>الدردشة</h1>
    <p>محادثاتك مع المرضى الذين قبلت طلباتهم — تُنشأ تلقائيًا عند القبول.</p>
  </div>
</div>

<div class="chat-layout">
  <div class="chat-conv-list" id="convList"></div>
  <div class="chat-panel" id="chatPanel">
    <div class="chat-empty">اختر محادثة من القائمة لعرض الرسائل.</div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  (function () {
    const therapistId = Store.getCurrentTherapistId();
    const convList = document.getElementById('convList');
    const chatPanel = document.getElementById('chatPanel');
    let activeSessionId = null;

    function renderConvList() {
      const sessions = Store.getAcceptedSessionsForTherapist(therapistId);
      convList.innerHTML = '';
      if (sessions.length === 0) {
        convList.innerHTML = '<div class="chat-empty">لا توجد محادثات بعد. اقبل طلب استشارة من صفحة "طلبات الاستشارة" لتبدأ محادثة تلقائيًا.</div>';
        return;
      }
      sessions.forEach((s) => {
        const messages = Store.getMessages(s.id);
        const last = messages[messages.length - 1];
        const item = document.createElement('div');
        item.className = 'chat-conv-item' + (s.id === activeSessionId ? ' active' : '');
        item.dataset.id = s.id;
        item.innerHTML =
          '<div class="avatar">' + (s.patient ? s.patient.initials : 'ط') + '</div>' +
          '<div><b>' + (s.patient ? s.patient.name : 'مستخدم') + '</b>' +
          '<span>' + (last ? last.text.slice(0, 26) + (last.text.length > 26 ? '…' : '') : 'ابدأ المحادثة الآن') + '</span></div>';
        item.addEventListener('click', () => openConversation(s));
        convList.appendChild(item);
      });
      
      if (!activeSessionId && sessions.length > 0) openConversation(sessions[0]);
    }

    function openConversation(session) {
      activeSessionId = session.id;
      convList.querySelectorAll('.chat-conv-item').forEach((el) => {
        el.classList.toggle('active', el.dataset.id === session.id);
      });
      renderChatPanel(session);
    }

    function renderChatPanel(session) {
      const patientName = session.patient ? session.patient.name : 'مستخدم';
      const initials = session.patient ? session.patient.initials : 'ط';
      chatPanel.innerHTML =
        '<div class="chat-panel-head"><div class="avatar">' + initials + '</div>' +
        '<div><b>' + patientName + '</b><span>' + session.topic + '</span></div></div>' +
        '<div class="chat-messages" id="chatMessages"></div>' +
        '<div class="chat-input-row">' +
        '<input type="text" id="chatInput" placeholder="اكتب رسالتك هنا…">' +
        '<button class="btn btn-primary" id="chatSendBtn">إرسال</button>' +
        '</div>';

      renderMessages(session.id);

      document.getElementById('chatSendBtn').addEventListener('click', () => sendCurrentMessage(session.id));
      document.getElementById('chatInput').addEventListener('keydown', (e) => {
        if (e.key === 'Enter') sendCurrentMessage(session.id);
      });
    }

    function renderMessages(sessionId) {
      const messagesEl = document.getElementById('chatMessages');
      const messages = Store.getMessages(sessionId);
      messagesEl.innerHTML = '';
      if (messages.length === 0) {
        messagesEl.innerHTML = '<div class="chat-empty">لا توجد رسائل بعد — ابدأ المحادثة!</div>';
        return;
      }
      messages.forEach((m) => {
        const bubble = document.createElement('div');
        bubble.className = 'chat-bubble ' + (m.sender === 'therapist' ? 'me' : 'them');
        bubble.innerHTML = escapeHtml(m.text) + '<time>' + m.time + '</time>';
        messagesEl.appendChild(bubble);
      });
      messagesEl.scrollTop = messagesEl.scrollHeight;
    }

    function sendCurrentMessage(sessionId) {
      const input = document.getElementById('chatInput');
      const text = input.value.trim();
      if (!text) return;
      Store.sendMessage(sessionId, 'therapist', text);
      input.value = '';
      renderMessages(sessionId);
      renderConvList();
      convList.querySelectorAll('.chat-conv-item').forEach((el) => {
        el.classList.toggle('active', el.dataset.id === sessionId);
      });
    }

    function escapeHtml(str) {
      const div = document.createElement('div');
      div.textContent = str;
      return div.innerHTML;
    }

    renderConvList();
  })();
</script>
@endpush