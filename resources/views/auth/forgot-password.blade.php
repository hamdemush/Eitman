@extends('layouts.app')

@section('title', 'نسيت كلمة المرور | إطمئن')

@section('content')
<section class="section" style="min-height:calc(100vh - 82px); display:flex; align-items:center;">
  <div class="container" style="max-width:460px;">
    <div class="question-card">
      <h1 style="font-size:24px; margin-bottom:10px;" data-i18n="forgot.title">نسيت كلمة المرور؟</h1>
      <p style="margin-bottom:26px;" data-i18n="forgot.subtitle">أدخل بريدك الإلكتروني الجامعي وسنرسل لك رابطاً/رمز تحقق لإعادة تعيين كلمة المرور.</p>

      <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="field">
          <label for="email" data-i18n="login.emailLabel">البريد الإلكتروني الجامعي</label>
          <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="name@university.edu" required autofocus>
          @error('email')
            <span style="color:var(--brand-danger); font-size:12px; margin-top:5px; display:block;">{{ $message }}</span>
          @enderror
        </div>
        
        @if (session('status'))
            <div style="color:var(--teal-700); background:var(--mint-100); padding:10px; border-radius:8px; margin-bottom:15px; font-size:14px;">
                {{ session('status') }}
            </div>
        @endif

        <button type="submit" class="btn btn-primary btn-block" data-i18n="forgot.submit">إرسال رابط التحقق</button>
      </form>

      <p class="form-foot"><a href="{{ route('login') }}" data-i18n="forgot.backToLogin">العودة إلى تسجيل الدخول</a></p>
    </div>
  </div>
</section>
@endsection