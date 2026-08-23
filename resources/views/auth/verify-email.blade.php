@extends('layouts.app')

@section('title', 'تحقق من بريدك الإلكتروني | إطمئن')

@section('content')
<section class="section" style="min-height:calc(100vh - 82px); display:flex; align-items:center;">
  <div class="container" style="max-width:460px;">
    <div class="question-card center">
      <div style="width:64px;height:64px;border-radius:50%;background:var(--teal-100);color:var(--teal-700);display:flex;align-items:center;justify-content:center;margin:0 auto 22px;">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg>
      </div>
      <h1 style="font-size:24px; margin-bottom:10px;" data-i18n="verify.title">تحقق من بريدك الإلكتروني</h1>
      <p style="margin-bottom:30px;" data-i18n="verify.subtitle">أرسلنا رمز تحقق مكوّن من 6 أرقام إلى بريدك الجامعي. أدخله بالأسفل لتفعيل حسابك.</p>

      @if (session('status') == 'verification-link-sent')
        <div style="color:var(--teal-700); background:var(--mint-100); padding:10px; border-radius:8px; margin-bottom:15px; font-size:14px; text-align:center;">
          تم إرسال رمز/رابط جديد إلى بريدك الإلكتروني.
        </div>
      @endif

      <form method="POST" action="{{ route('verification.verify') }}" style="text-align:right;">
        @csrf
        <div class="field">
          <label for="code" data-i18n="reset.codeLabel">رمز التحقق</label>
          <input type="text" id="code" name="code" maxlength="6" inputmode="numeric" placeholder="000000" required autofocus style="text-align:center; letter-spacing:10px; font-size:20px; font-weight:800;">
          @error('code')
            <span style="color:var(--brand-danger); font-size:12px; margin-top:5px; display:block;">{{ $message }}</span>
          @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-block" data-i18n="verify.submit">تأكيد الحساب</button>
      </form>

      <form method="POST" action="{{ route('verification.send') }}" id="resendForm" style="margin-top:15px;">
        @csrf
        <p class="form-foot">
          <button type="submit" style="background:none; border:none; color:var(--teal-700); cursor:pointer; text-decoration:underline; font-family:inherit; font-size:inherit;" data-i18n="verify.resend">
            لم يصلك الرمز؟ إعادة الإرسال
          </button>
        </p>
      </form>
    </div>
  </div>
</section>
@endsection