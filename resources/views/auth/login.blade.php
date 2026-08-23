@extends('layouts.app')

@section('title', 'تسجيل الدخول | إطمئن')

@section('content')
<section class="section" style="min-height:calc(100vh - 82px); display:flex; align-items:center;">
  <div class="container" style="max-width:440px;">
    <div class="question-card">
      <h1 style="font-size:24px; margin-bottom:10px;" data-i18n="login.title">مرحبًا بك مجددًا</h1>
      <p style="margin-bottom:26px;" data-i18n="login.subtitle">أدخل بياناتك للمتابعة إلى حسابك في إطمئن.</p>

      <div id="errorMessage" style="display:none; color:var(--brand-danger); background:#ffebee; padding:10px; border-radius:8px; margin-bottom:15px; font-size:14px; text-align:center;"></div>

      <form id="loginForm">
        @csrf
        <div class="field">
          <label for="email" data-i18n="login.emailLabel">البريد الإلكتروني الجامعي</label>
          <input type="email" id="email" name="email" placeholder="name@university.edu" required autofocus>
        </div>

        <div class="field">
          <label for="password" data-i18n="login.passwordLabel">كلمة المرور</label>
          <input type="password" id="password" name="password" placeholder="••••••••" required>
        </div>

        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; font-size:13px;">
          <label style="display:flex; align-items:center; gap:6px; cursor:pointer;">
            <input type="checkbox" id="remember" name="remember"> تذكرني
          </label>
          <a href="{{ route('password.request') }}" style="color:var(--teal-700);" data-i18n="login.forgot">نسيت كلمة المرور؟</a>
        </div>

        <button type="submit" id="submitBtn" class="btn btn-primary btn-block" data-i18n="login.submit">تسجيل الدخول</button>
      </form>

      <p class="form-foot" style="margin-top:20px;">
        ليس لديك حساب؟ <a href="{{ route('register') }}" data-i18n="login.registerLink">إنشاء حساب جديد</a>
      </p>
    </div>
  </div>
</section>

<script>
document.getElementById('loginForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const submitBtn = document.getElementById('submitBtn');
    const errorDiv = document.getElementById('errorMessage');
    
    errorDiv.style.display = 'none';
    submitBtn.disabled = true;
    submitBtn.innerText = 'جاري التحقق...';

    const payload = {
        email: document.getElementById('email').value,
        password: document.getElementById('password').value,
    };

    try {
        const response = await fetch('/api/login', {
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
            // حفظ الـ Token والبيانات في localStorage
            localStorage.setItem('auth_token', data.token || data.access_token);
            if (data.user) {
                localStorage.setItem('user_info', JSON.stringify(data.user));
            }

            // التوجيه للوحة المناسبة حسب نوع المستخدم (role)
            const role = data.user?.role || data.role;
            if (role === 'admin') {
                window.location.href = "{{ route('admin.dashboard') }}";
            } else if (role === 'doctor' || role === 'psychologist') {
                window.location.href = "{{ route('doctor.dashboard') }}";
            } else {
                window.location.href = "{{ route('patient.dashboard') }}";
            }
        } else {
            errorDiv.innerText = data.message || 'بيانات الدخول غير صحيحة، يرجى المحاولة مجددًا.';
            errorDiv.style.display = 'block';
        }
    } catch (err) {
        errorDiv.innerText = 'حدث خطأ في الاتصال بالسيرفر. حاول مرة أخرى.';
        errorDiv.style.display = 'block';
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerText = 'تسجيل الدخول';
    }
});
</script>
@endsection