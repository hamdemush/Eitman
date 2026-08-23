@extends('layouts.app')

@section('title', 'إنشاء حساب جديد | إطمئن')

@section('content')
<section class="section" style="min-height:calc(100vh - 82px); display:flex; align-items:center;">
  <div class="container" style="max-width:480px;">
    <div class="question-card">
      <h1 style="font-size:24px; margin-bottom:10px;" data-i18n="register.title">إنشاء حساب جديد</h1>
      <p style="margin-bottom:26px;" data-i18n="register.subtitle">انضم إلى منصة إطمئن للحصول على الدعم النفسي بأمان وسرية.</p>

      <div id="errorMessage" style="display:none; color:var(--brand-danger); background:#ffebee; padding:10px; border-radius:8px; margin-bottom:15px; font-size:14px; text-align:center;"></div>

      <form id="registerForm">
        @csrf
        <div class="field">
          <label for="name" data-i18n="register.nameLabel">الاسم الكامل (أو المستعار)</label>
          <input type="text" id="name" name="name" placeholder="أدخل اسمك" required autofocus>
        </div>

        <div class="field">
          <label for="email" data-i18n="register.emailLabel">البريد الإلكتروني الجامعي</label>
          <input type="email" id="email" name="email" placeholder="name@university.edu" required>
        </div>

        <div class="field">
          <label for="role" data-i18n="register.roleLabel">نوع الحساب</label>
          <select id="role" name="role" required style="width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color);">
            <option value="patient">طالب / مريض</option>
            <option value="psychologist">معالج نفسي / أخصائي</option>
          </select>
        </div>

        <div class="field">
          <label for="password" data-i18n="register.passwordLabel">كلمة المرور</label>
          <input type="password" id="password" name="password" placeholder="••••••••" required minlength="8">
        </div>

        <div class="field">
          <label for="password_confirmation" data-i18n="register.passwordConfirmLabel">تأكيد كلمة المرور</label>
          <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required minlength="8">
        </div>

        <button type="submit" id="submitBtn" class="btn btn-primary btn-block" data-i18n="register.submit">إنشاء الحساب</button>
      </form>

      <p class="form-foot" style="margin-top:20px;">
        لديك حساب بالفعل؟ <a href="{{ route('login') }}" data-i18n="register.loginLink">تسجيل الدخول</a>
      </p>
    </div>
  </div>
</section>

<script>
document.getElementById('registerForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const submitBtn = document.getElementById('submitBtn');
    const errorDiv = document.getElementById('errorMessage');
    
    errorDiv.style.display = 'none';
    submitBtn.disabled = true;
    submitBtn.innerText = 'جاري إنشاء الحساب...';

    const payload = {
        name: document.getElementById('name').value,
        email: document.getElementById('email').value,
        role: document.getElementById('role').value,
        password: document.getElementById('password').value,
        password_confirmation: document.getElementById('password_confirmation').value,
    };

    try {
        const response = await fetch('/api/register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(payload)
        });

        const data = await response.json();

        if (response.ok) {
            if (data.token) {
                localStorage.setItem('auth_token', data.token);
            }
            window.location.href = "{{ route('verification.notice') }}";
        } else {
            let msg = data.message || 'حدث خطأ أثناء إنشاء الحساب.';
            if (data.errors) {
                msg = Object.values(data.errors).flat().join('<br>');
            }
            errorDiv.innerHTML = msg;
            errorDiv.style.display = 'block';
        }
    } catch (err) {
        errorDiv.innerText = 'حدث خطأ في الاتصال بالسيرفر. حاول مرة أخرى.';
        errorDiv.style.display = 'block';
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerText = 'إنشاء الحساب';
    }
});
</script>
@endsection