@extends('layouts.admin')

@section('title', 'Platform Settings Management')

@section('content')
    <!-- Top Header Banner -->
    <div style="background: white; border-radius: 16px; padding: 2rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); margin-bottom: 2rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
            <div>
                <span class="badge" style="background: #EFF6FF; color: #1E40AF; margin-bottom: 0.5rem;"><i class="fa-solid fa-sliders me-1"></i> System Configuration</span>
                <h1 class="font-heading" style="font-size: 2rem; color: var(--admin-dark);">Platform Site Settings Management</h1>
                <p style="color: var(--text-muted); font-size: 0.95rem;">Configure global platform contact details, official WhatsApp number, support email, office address, and live announcement notices.</p>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div style="background: #D1FAE5; color: #065F46; padding: 1rem 1.25rem; border-radius: 12px; margin-bottom: 1.5rem; border: 1px solid #34D399; font-weight: 600;">
            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
        </div>
    @endif

    <!-- System Settings Form Card -->
    <div style="background: white; border-radius: 16px; padding: 2rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); max-width: 900px;">
        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf

            <h3 class="font-heading" style="font-size: 1.15rem; color: var(--admin-dark); margin-bottom: 1.25rem; border-bottom: 1px solid var(--border-color); padding-bottom: 0.5rem;">
                <i class="fa-solid fa-headset text-emerald-600 me-1"></i> Contact & Support Details
            </h3>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.25rem; margin-bottom: 1.5rem;">
                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.88rem; margin-bottom: 0.35rem; color: var(--text-dark);">
                        Support Phone Number *
                    </label>
                    <input type="text" name="site_phone" value="{{ old('site_phone', $settings['site_phone']) }}" required style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.92rem;">
                </div>

                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.88rem; margin-bottom: 0.35rem; color: var(--text-dark);">
                        Official WhatsApp Number *
                    </label>
                    <input type="text" name="site_whatsapp" value="{{ old('site_whatsapp', $settings['site_whatsapp']) }}" required style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.92rem;">
                </div>

                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.88rem; margin-bottom: 0.35rem; color: var(--text-dark);">
                        Support Email Address *
                    </label>
                    <input type="email" name="site_email" value="{{ old('site_email', $settings['site_email']) }}" required style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.92rem;">
                </div>
            </div>

            <h3 class="font-heading" style="font-size: 1.15rem; color: var(--admin-dark); margin-bottom: 1.25rem; border-bottom: 1px solid var(--border-color); padding-bottom: 0.5rem; margin-top: 2rem;">
                <i class="fa-solid fa-bullhorn text-amber-500 me-1"></i> Office Address & Global Notice
            </h3>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 2rem;">
                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.88rem; margin-bottom: 0.35rem; color: var(--text-dark);">
                        Platform Head Office Address *
                    </label>
                    <input type="text" name="site_address" value="{{ old('site_address', $settings['site_address']) }}" required style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.92rem;">
                </div>

                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.88rem; margin-bottom: 0.35rem; color: var(--text-dark);">
                        Platform Announcement Notice Text
                    </label>
                    <input type="text" name="site_notice" value="{{ old('site_notice', $settings['site_notice']) }}" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.92rem;">
                </div>
            </div>

            <h3 class="font-heading" style="font-size: 1.15rem; color: var(--admin-dark); margin-bottom: 1.25rem; border-bottom: 1px solid var(--border-color); padding-bottom: 0.5rem; margin-top: 2rem;">
                <i class="fa-solid fa-coins text-amber-500 me-1"></i> Platform Monetization & Access Mode (ফ্রি বনাম পেইড মোড)
            </h3>

            <div style="background: #F8FAFC; border: 1px solid var(--border-color); border-radius: 12px; padding: 1.25rem; margin-bottom: 2rem;">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
                    <label style="display: flex; align-items: flex-start; gap: 0.85rem; padding: 1rem; border: 2px solid {{ ($settings['platform_monetization_mode'] ?? 'free') === 'free' ? '#10B981' : '#E2E8F0' }}; background: {{ ($settings['platform_monetization_mode'] ?? 'free') === 'free' ? '#ECFDF5' : 'white' }}; border-radius: 10px; cursor: pointer;">
                        <input type="radio" name="platform_monetization_mode" value="free" {{ ($settings['platform_monetization_mode'] ?? 'free') === 'free' ? 'checked' : '' }} style="margin-top: 0.2rem; accent-color: #059669; width: 17px; height: 17px;">
                        <div>
                            <strong style="color: #065F46; font-size: 0.95rem; display: block;">🟢 সম্পূর্ণ ফ্রি মোড (100% Free Mode)</strong>
                            <span style="font-size: 0.8rem; color: #047857; display: block; margin-top: 0.25rem;">
                                কোনো সাবস্ক্রিপশন ফি নেই। সকল ভেরিফাইড এজেন্সির জন্য পোস্ট ও লেনদেন উন্মুক্ত।
                            </span>
                        </div>
                    </label>

                    <label style="display: flex; align-items: flex-start; gap: 0.85rem; padding: 1rem; border: 2px solid {{ ($settings['platform_monetization_mode'] ?? 'free') === 'paid' ? '#F59E0B' : '#E2E8F0' }}; background: {{ ($settings['platform_monetization_mode'] ?? 'free') === 'paid' ? '#FFFBEB' : 'white' }}; border-radius: 10px; cursor: pointer;">
                        <input type="radio" name="platform_monetization_mode" value="paid" {{ ($settings['platform_monetization_mode'] ?? 'free') === 'paid' ? 'checked' : '' }} style="margin-top: 0.2rem; accent-color: #D97706; width: 17px; height: 17px;">
                        <div>
                            <strong style="color: #92400E; font-size: 0.95rem; display: block;">🟡 পেইড সাবস্ক্রিপশন মোড (Paid VIP Mode)</strong>
                            <span style="font-size: 0.8rem; color: #78350F; display: block; margin-top: 0.25rem;">
                                বিকাশ/নগদে সাবস্ক্রিপশন ফি নেওয়ার সিস্টেম চালু থাকবে এবং VIP প্ল্যান সক্রিয় হবে।
                            </span>
                        </div>
                    </label>
                </div>
            </div>

            <button type="submit" class="btn-gold" style="font-size: 1.05rem; padding: 0.85rem 1.75rem; box-shadow: 0 4px 12px rgba(212, 175, 55, 0.3);">
                <i class="fa-solid fa-floppy-disk me-2"></i> Save Site Settings Changes
            </button>
        </form>
    </div>
@endsection
