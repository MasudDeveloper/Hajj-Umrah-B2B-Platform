@extends('layouts.app')

@section('title', 'Agency Login')

@section('content')
    <div style="max-width: 480px; margin: 2rem auto; background: white; border-radius: 16px; padding: 2.5rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-md);">
        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="width: 56px; height: 56px; background: linear-gradient(135deg, var(--accent), #B38F22); border-radius: 14px; display: inline-flex; align-items: center; justify-content: center; color: var(--primary-dark); font-size: 1.8rem; margin-bottom: 1rem;">
                <i class="fa-solid fa-kaaba"></i>
            </div>
            <h1 class="font-heading" style="font-size: 1.8rem; color: var(--primary-dark); margin-bottom: 0.25rem;">Verified Agency Login</h1>
            <p style="color: var(--text-muted); font-size: 0.9rem;">Access exclusive B2B Hajj Umrah deals, group shortages, and partner contacts.</p>
        </div>

        @if ($errors->any())
            <div class="alert-error" style="margin-bottom: 1.5rem;">
                <div>{{ $errors->first() }}</div>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div style="margin-bottom: 1.25rem;">
                <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">Agency Registered Email *</label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="e.g. alharamain@agency.com" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.95rem;">
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">Password *</label>
                <input type="password" name="password" required placeholder="Enter password" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.95rem;">
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; font-size: 0.85rem;">
                <label style="display: flex; align-items: center; gap: 0.4rem; cursor: pointer; color: var(--text-muted);">
                    <input type="checkbox" name="remember"> Remember Me
                </label>
                <a href="{{ route('register') }}" style="color: var(--primary); font-weight: 600; text-decoration: none;">Register New Agency</a>
            </div>

            <button type="submit" class="btn-gold" style="width: 100%; justify-content: center; font-size: 1rem; padding: 0.85rem;">
                <i class="fa-solid fa-right-to-bracket"></i> Login to B2B Network
            </button>
        </form>

        <div style="margin-top: 2rem; padding-top: 1.25rem; border-top: 1px solid var(--border-color); text-align: center; font-size: 0.82rem; color: var(--text-muted);">
            <p><i class="fa-solid fa-lightbulb text-amber-500"></i> Demo Credentials: <code>alharamain@agency.com</code> / <code>password123</code></p>
            <p>Admin Login: <code>admin@b2bhajjumrah.com</code> / <code>admin123456</code></p>
        </div>
    </div>
@endsection
