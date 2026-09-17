@extends('layouts.app')

@section('title', 'Step 1: Agency Account Registration')

@section('content')
<div style="max-width: 580px; margin: 2rem auto; background: white; border-radius: 16px; padding: 2.5rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-md);">
    <!-- Step Indicator Header -->
    <div style="margin-bottom: 2rem; border-bottom: 2px solid var(--accent); padding-bottom: 1.25rem; text-align: center;">
        <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: #ECFDF5; color: #047857; font-size: 0.8rem; font-weight: 700; padding: 0.3rem 0.85rem; border-radius: 20px; margin-bottom: 0.75rem; border: 1px solid #A7F3D0;">
            <i class="fa-solid fa-user-plus"></i> Step 1 of 2: Basic Account Creation
        </div>
        <h1 class="font-heading" style="font-size: 1.8rem; color: var(--primary-dark); margin-bottom: 0.35rem;">B2B Hajj Umrah Registration</h1>
        <p style="color: var(--text-muted); font-size: 0.9rem;">Register your agency account and verify mobile number via OTP.</p>
    </div>

    @if ($errors->any())
    <div class="alert-error" style="margin-bottom: 1.5rem;">
        <ul style="margin-left: 1rem; margin-top: 0.25rem;">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <div style="margin-bottom: 1.25rem;">
            <label style="display: block; font-weight: 600; font-size: 0.88rem; margin-bottom: 0.35rem; color: var(--text-dark);">
                <i class="fa-solid fa-building text-emerald-700 me-1"></i> Agency Name *
            </label>
            <input type="text" name="agency_name" value="{{ old('agency_name') }}" required placeholder="e.g. Al Haramain Hajj & Umrah Travels" style="width: 100%; padding: 0.8rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.95rem;">
        </div>

        <div style="margin-bottom: 1.25rem;">
            <label style="display: block; font-weight: 600; font-size: 0.88rem; margin-bottom: 0.35rem; color: var(--text-dark);">
                <i class="fa-solid fa-phone text-emerald-700 me-1"></i> Mobile Phone Number (For OTP Verification) *
            </label>
            <input type="text" name="phone" value="{{ old('phone') }}" required placeholder="e.g. 01711223344" style="width: 100%; padding: 0.8rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.95rem;">
            <small style="color: var(--text-muted); font-size: 0.78rem;">An OTP code will be sent to this mobile number for immediate verification.</small>
        </div>

        <div style="margin-bottom: 1.25rem;">
            <label style="display: block; font-weight: 600; font-size: 0.88rem; margin-bottom: 0.35rem; color: var(--text-dark);">
                <i class="fa-solid fa-envelope text-emerald-700 me-1"></i> Official Email Address *
            </label>
            <input type="email" name="email" value="{{ old('email') }}" required placeholder="e.g. info@alharamaintravels.com" style="width: 100%; padding: 0.8rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.95rem;">
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
            <div>
                <label style="display: block; font-weight: 600; font-size: 0.88rem; margin-bottom: 0.35rem; color: var(--text-dark);">
                    <i class="fa-solid fa-lock text-emerald-700 me-1"></i> Account Password *
                </label>
                <input type="password" name="password" required placeholder="Min 6 characters" style="width: 100%; padding: 0.8rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.95rem;">
            </div>

            <div>
                <label style="display: block; font-weight: 600; font-size: 0.88rem; margin-bottom: 0.35rem; color: var(--text-dark);">
                    <i class="fa-solid fa-shield me-1"></i> Confirm Password *
                </label>
                <input type="password" name="password_confirmation" required placeholder="Re-enter password" style="width: 100%; padding: 0.8rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.95rem;">
            </div>
        </div>

        <button type="submit" class="btn-gold" style="width: 100%; justify-content: center; font-size: 1.05rem; padding: 0.9rem; box-shadow: 0 4px 12px rgba(212, 175, 55, 0.3);">
            Proceed to Mobile OTP Verification <i class="fa-solid fa-arrow-right ms-2"></i>
        </button>
    </form>

    <div style="margin-top: 1.75rem; padding-top: 1.25rem; border-top: 1px solid var(--border-color); text-align: center; font-size: 0.88rem; color: var(--text-muted);">
        Already have a registered agency account? <a href="{{ route('login') }}" style="color: var(--primary); font-weight: 700; text-decoration: none;">Login Here</a>
    </div>
</div>
@endsection