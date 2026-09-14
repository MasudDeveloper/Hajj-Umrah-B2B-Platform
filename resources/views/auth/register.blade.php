@extends('layouts.app')

@section('title', 'Register Agency - Strict Verification')

@section('content')
<div style="max-width: 760px; margin: 0 auto; background: white; border-radius: 16px; padding: 2.5rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-md);">
    <div style="margin-bottom: 2rem; border-bottom: 2px solid var(--accent); padding-bottom: 1rem;">
        <div style="display: inline-flex; align-items: center; gap: 0.4rem; background: #FEF3C7; color: #92400E; font-size: 0.78rem; font-weight: 700; padding: 0.25rem 0.65rem; border-radius: 20px; margin-bottom: 0.5rem;">
            <i class="fa-solid fa-shield-halved"></i> Strict HAAB & Govt License Verification
        </div>
        <h1 class="font-heading" style="font-size: 1.8rem; color: var(--primary-dark);">Agency B2B Account Registration</h1>
        <p style="color: var(--text-muted); font-size: 0.95rem;">Join Bangladesh's exclusive network of verified Hajj & Umrah agencies. Admin verification is required prior to deal access.</p>
    </div>

    @if ($errors->any())
    <div class="alert-error">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <h3 class="font-heading" style="font-size: 1.1rem; color: var(--primary-dark); margin-bottom: 1rem;">
            <i class="fa-solid fa-building me-1"></i> Agency & License Credentials
        </h3>

        <!-- Grid 1: Agency Name & Legal Name -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.25rem;">
            <div>
                <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">Agency Name *</label>
                <input type="text" name="agency_name" value="{{ old('agency_name') }}" required placeholder="e.g. R.B Tours & Travels" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
            </div>

            <div>
                <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">Registered Company Name *</label>
                <input type="text" name="company_name" value="{{ old('company_name') }}" required placeholder="e.g. R.B Tours & Travels Ltd." style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
            </div>
        </div>

        <!-- Grid 2: License Numbers -->
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
            <div>
                <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">Hajj / Umrah License No *</label>
                <input type="text" name="license_no" value="{{ old('license_no') }}" required placeholder="e.g. HAJJ-LIC-0482" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
            </div>

            <div>
                <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">HAAB Reg. No (Optional)</label>
                <input type="text" name="haab_no" value="{{ old('haab_no') }}" placeholder="e.g. HAAB-882" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
            </div>

            <div>
                <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">Trade License No</label>
                <input type="text" name="trade_license_no" value="{{ old('trade_license_no') }}" placeholder="e.g. TRAD/22/1526" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
            </div>
        </div>

        <h3 class="font-heading" style="font-size: 1.1rem; color: var(--primary-dark); margin-bottom: 1rem;">
            <i class="fa-solid fa-user-shield me-1"></i> Owner Identity & Contact Details
        </h3>

        <!-- Grid 3: Owner Name & NID -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.25rem;">
            <div>
                <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">Agency Owner Name *</label>
                <input type="text" name="owner_name" value="{{ old('owner_name') }}" required placeholder="e.g. Masud Rana" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
            </div>

            <div>
                <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">Owner NID Number</label>
                <input type="text" name="nid_number" value="{{ old('nid_number') }}" placeholder="e.g. 1982269988776" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
            </div>
        </div>

        <!-- Grid 4: Phone, WhatsApp, City -->
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
            <div>
                <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">Phone Number *</label>
                <input type="text" name="phone" value="{{ old('phone') }}" required placeholder="+880 1711-000000" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
            </div>

            <div>
                <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">WhatsApp Number</label>
                <input type="text" name="whatsapp" value="{{ old('whatsapp') }}" placeholder="+880 1711-000000" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
            </div>

            <div>
                <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">Departure Hub City *</label>
                <select name="city" required style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                    <option value="Dhaka">Dhaka</option>
                    <option value="Chittagong">Chittagong</option>
                    <option value="Sylhet">Sylhet</option>
                </select>
            </div>
        </div>

        <h3 class="font-heading" style="font-size: 1.1rem; color: var(--primary-dark); margin-bottom: 1rem;">
            <i class="fa-solid fa-key me-1"></i> Account Security & Login Credentials
        </h3>

        <!-- Email & Passwords -->
        <div style="margin-bottom: 1.25rem;">
            <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">Official Agency Email Address *</label>
            <input type="email" name="email" value="{{ old('email') }}" required placeholder="e.g. b2b@alharamain.com.bd" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 2rem;">
            <div>
                <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">Password *</label>
                <input type="password" name="password" required placeholder="Minimum 6 characters" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
            </div>

            <div>
                <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">Confirm Password *</label>
                <input type="password" name="password_confirmation" required placeholder="Repeat password" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
            </div>
        </div>

        <button type="submit" class="btn-gold" style="width: 100%; justify-content: center; font-size: 1.05rem; padding: 0.9rem;">
            <i class="fa-solid fa-paper-plane"></i> Submit Agency Registration for Verification
        </button>
    </form>
</div>
@endsection