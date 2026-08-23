@extends('layouts.app')

@section('title', 'إعادة تعيين كلمة المرور | إطمئن')

@section('content')
<section class="section" style="min-height:calc(100vh - 82px); display:flex; align-items:center;">
  <div class="container" style="max-width:460px;">
    <div class="question-card">
      <h1 style="font-size:24px; margin-bottom:10px;" data-i18n="reset.title">إعادة تعيين كلمة المرور</h1>
      <p style="margin-bottom:26px;" data-i18n="reset.subtitle">أدخل بريدك الإلكتروني، رمز التحقق/الرمز المميز، وكلمة المرور الجديدة.</p>

      {{-- إظهار رسالة النجاح إن وجدت --}}
      @if (session('status'))
        <div style="background-color: #d4edda; color: #155724; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 0.9rem;">
          {{ session('status') }}
        </div>
      @endif

      <form action="{{ route('password.update') }}" method="POST">
        @csrf

        {{-- حقل التوكن الخفي المطلوب في نظام لارافيل --}}
        <input type="hidden" name="token" value="{{ $request->route('token') ?? old('token') }}">

        <div class="field">
          <label for="email" data-i18n="login.emailLabel">البريد الإلكتروني</label>
          <input type="email" id="email" name="email" value="{{ old('email', $request->email) }}" placeholder="name@example.com" required autofocus autocomplete="username">
          @error('email')
            <span style="color: #dc3545; font-size: 0.85rem; margin-top: 4px; display: block;">{{ $message }}</span>
          @enderror
        </div>

        <div class="field">
          <label for="password" data-i18n="reset.newPassword">كلمة المرور الجديدة</label>
          <input type="password" id="password" name="password" placeholder="8 أحرف على الأقل" required autocomplete="new-password">
          @error('password')
            <span style="color: #dc3545; font-size: 0.85rem; margin-top: 4px; display: block;">{{ $message }}</span>
          @enderror
        </div>

        <div class="field">
          <label for="password_confirmation" data-i18n="register.confirmPassword">تأكيد كلمة المرور</label>
          <input type="password" id="password_confirmation" name="password_confirmation" placeholder="أعد كتابة كلمة المرور" required autocomplete="new-password">
        </div>

        <button type="submit" class="btn btn-primary btn-block" data-i18n="reset.submit">تحديث كلمة المرور</button>
      </form>

      <p class="form-foot">
        <a href="{{ route('login') }}" data-i18n="forgot.backToLogin">العودة إلى تسجيل الدخول</a>
      </p>
    </div>
  </div>
</section>
@endsection