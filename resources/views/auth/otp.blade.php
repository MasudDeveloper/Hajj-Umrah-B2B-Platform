@extends('layouts.app')

@section('title', 'OTP Phone Verification')

@section('content')
<div style="max-width: 480px; margin: 3rem auto; background: white; border-radius: 16px; padding: 2.5rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-md); text-align: center;">
    <div style="width: 64px; height: 64px; background: #ECFDF5; color: #047857; border-radius: 20px; display: inline-flex; align-items: center; justify-content: center; font-size: 2rem; margin-bottom: 1.25rem; border: 1px solid #A7F3D0;">
        <i class="fa-solid fa-mobile-screen-button"></i>
    </div>

    <h1 class="font-heading" style="font-size: 1.75rem; color: var(--primary-dark); margin-bottom: 0.5rem;">Verify Mobile Phone</h1>
    <p style="color: var(--text-muted); font-size: 0.92rem; margin-bottom: 1.5rem;">
        An OTP code has been sent to your registered mobile number:<br>
        <strong style="color: var(--primary-dark); font-size: 1.05rem;">{{ $agency->phone }}</strong>
    </p>

    <!-- Demo Mode Banner -->
    <div style="background: #FEF3C7; border: 1px solid #FCD34D; border-radius: 12px; padding: 0.85rem; margin-bottom: 1.75rem; color: #92400E; font-size: 0.88rem; font-weight: 600;">
        <i class="fa-solid fa-bolt text-amber-600 me-1"></i> DEMO OTP CODE: <span style="background: white; padding: 0.2rem 0.6rem; border-radius: 6px; letter-spacing: 2px; font-family: monospace; font-size: 1.1rem; color: #B45309; border: 1px dashed #F59E0B;">123456</span>
    </div>

    @if ($errors->any())
    <div class="alert-error" style="margin-bottom: 1.5rem; text-align: left;">
        <div>{{ $errors->first() }}</div>
    </div>
    @endif

    <form action="{{ route('verification.otp.submit') }}" method="POST">
        @csrf

        <div style="margin-bottom: 1.75rem;">
            <label style="display: block; font-weight: 600; font-size: 0.88rem; margin-bottom: 0.5rem; color: var(--text-dark);">
                Enter 6-Digit OTP Code
            </label>
            <input type="text" name="otp_code" required autofocus maxlength="6" value="123456" style="width: 100%; max-width: 280px; text-align: center; letter-spacing: 12px; font-size: 1.75rem; font-weight: 800; font-family: monospace; padding: 0.75rem; border: 2px solid var(--accent); border-radius: 12px; background: #FFFDF5; color: var(--primary-dark);">
        </div>

        <button type="submit" class="btn-gold" style="width: 100%; justify-content: center; font-size: 1.05rem; padding: 0.85rem;">
            Verify & Proceed <i class="fa-solid fa-check-circle ms-2"></i>
        </button>
    </form>

    <div style="margin-top: 2rem; padding-top: 1.25rem; border-top: 1px solid var(--border-color); font-size: 0.85rem; color: var(--text-muted); display: flex; justify-content: space-between; align-items: center;">
        <span>Didn't receive the SMS code?</span>
        <form action="{{ route('verification.otp.resend') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" style="background: none; border: none; color: var(--primary); font-weight: 700; cursor: pointer; text-decoration: underline;">
                Resend OTP
            </button>
        </form>
    </div>
</div>
@endsection
