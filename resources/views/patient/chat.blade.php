@extends('layouts.app')

@section('title', 'المحادثة | إطمئن')

@section('content')
<section class="section">
  <div class="container" style="max-width: 800px;">
    <div class="question-card" style="padding: 0; overflow: hidden;">
      <div style="padding: 15px 20px; background: var(--teal-700); color: #fff; font-weight: bold;">
        المحادثة مع المعالج النفسي
      </div>
      
      <!-- منطقة الرسائل -->
      <div id="chatMessages" style="height: 380px; overflow-y: auto; padding: 20px; background: #f9f9f9; display: flex; flex-direction: column; gap: 12px;">
        <p style="text-align: center; color: #888;">جاري تحميل المحادثة...</p>
      </div>

      <!-- نموذج إرسال الرسالة -->
      <form id="chatForm" style="display: flex; gap: 10px; padding: 15px; border-top: 1px solid var(--border-color);">
        <input type="text" id="messageInput" placeholder="اكتب رسالتك هنا..." required style="flex: 1; padding: 10px; border-radius: 8px; border: 1px solid var(--border-color);">
        <button type="submit" class="btn btn-primary">إرسال</button>
      </form>
    </div>
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const sessionId = 1; // رقم الجلسة الحالية
    const token = localStorage.getItem('auth_token');
    const messagesContainer = document.getElementById('chatMessages');

    async function fetchMessages() {
        try {
            const res = await fetch(`/api/sessions/${sessionId}/messages`, {
                headers: { 'Authorization': `Bearer ${token}`, 'Accept': 'application/json' }
            });
            const data = await res.json();
            
            messagesContainer.innerHTML = '';
            const messages = Array.isArray(data) ? data : (data.messages || []);

            if (messages.length === 0) {
                messagesContainer.innerHTML = '<p style="text-align: center; color: #888;">لا توجد رسائل سابقة. ابدأ المحادثة الآن.</p>';
                return;
            }

            messages.forEach(msg => {
                const isMe = msg.sender_type === 'patient';
                const msgBubble = document.createElement('div');
                msgBubble.style.cssText = `max-width: 70%; padding: 10px 14px; border-radius: 12px; font-size: 14px; align-self: ${isMe ? 'flex-end' : 'flex-start'}; background: ${isMe ? 'var(--teal-700)' : '#fff'}; color: ${isMe ? '#fff' : '#333'}; border: ${isMe ? 'none' : '1px solid #ddd'};`;
                msgBubble.innerText = msg.message || msg.content;
                messagesContainer.appendChild(msgBubble);
            });
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        } catch (err) {
            messagesContainer.innerHTML = '<p style="text-align: center; color: var(--brand-danger);">حدث خطأ أثناء جلب الرسائل.</p>';
        }
    }

    document.getElementById('chatForm').addEventListener('submit', async function (e) {
        e.preventDefault();
        const input = document.getElementById('messageInput');
        const text = input.value.trim();
        if (!text) return;

        try {
            const res = await fetch(`/api/sessions/${sessionId}/messages`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ message: text })
            });
            if (res.ok) {
                input.value = '';
                fetchMessages();
            }
        } catch (err) {
            console.error('فشل الإرسال:', err);
        }
    });

    fetchMessages();
});
</script>
@endsection