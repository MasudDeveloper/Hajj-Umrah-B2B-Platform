@extends('layouts.app')

@section('title', 'About Us - UMRAH B2B')

@section('content')
<style>
    .about-hero {
        background: url('{{ asset("images/makkah_kaaba_hero.jpg") }}') center/cover no-repeat;
        position: relative;
        padding: 6rem 2rem;
        border-radius: 16px;
        color: white;
        text-align: center;
        margin-bottom: 4rem;
        overflow: hidden;
    }
    .about-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(11,21,33,0.8) 0%, rgba(4,78,53,0.9) 100%);
        z-index: 1;
    }
    .about-hero-content {
        position: relative;
        z-index: 2;
    }
    .value-card {
        background: white;
        border-radius: 12px;
        padding: 2.5rem 2rem;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        border: 1px solid #E2E8F0;
        transition: transform 0.3s;
    }
    .value-card:hover {
        transform: translateY(-5px);
        border-color: #044E35;
    }
    .value-icon {
        font-size: 2.5rem;
        color: #D4AF37;
        margin-bottom: 1.5rem;
    }
</style>

<div class="about-hero">
    <div class="about-hero-content">
        <h1 style="font-size: 3.2rem; font-weight: 800; margin-bottom: 1rem; font-family: 'Outfit', sans-serif;">Pioneering the Umrah B2B Space</h1>
        <p style="font-size: 1.15rem; color: #E2E8F0; max-width: 700px; margin: 0 auto; line-height: 1.6;">We are Bangladesh's first exclusive B2B seat exchange and collaboration platform, empowering licensed travel agencies to optimize their Umrah operations.</p>
    </div>
</div>

<div class="container">
    <div style="display: flex; flex-wrap: wrap; gap: 4rem; align-items: center; margin-bottom: 5rem;">
        <div style="flex: 1; min-width: 300px;">
            <h2 style="font-size: 2.2rem; font-weight: 800; color: #1E293B; margin-bottom: 1.5rem; font-family: 'Outfit', sans-serif;">Our Story & Mission</h2>
            <p style="color: #64748B; font-size: 1.05rem; line-height: 1.8; margin-bottom: 1.5rem;">
                The Umrah travel industry in Bangladesh is vast, yet it has traditionally suffered from fragmentation. Agencies often face the challenge of having unsold blocked seats, while other agencies struggle to find available seats to fulfill their clients' needs.
            </p>
            <p style="color: #64748B; font-size: 1.05rem; line-height: 1.8;">
                <strong>UMRAH B2B</strong> was founded to bridge this gap. Our mission is to provide a unified, highly secure, and transparent digital marketplace where HAAB-verified agencies can seamlessly collaborate, share group seats, trade tickets, and share hotel allocations. By doing so, we ensure zero wastage of resources and maximize profitability for every agency.
            </p>
        </div>
        <div style="flex: 1; min-width: 300px; position: relative;">
            <div style="background: #FDF9E6; border-radius: 16px; padding: 3rem 2rem; border: 1px solid #D4AF37; text-align: center;">
                <h3 style="font-size: 1.5rem; font-weight: 800; color: #044E35; margin-bottom: 1rem;">The Solution We Provide</h3>
                <ul style="text-align: left; color: #1E293B; font-size: 1.05rem; line-height: 1.8; list-style-type: none; padding: 0;">
                    <li style="margin-bottom: 0.5rem;"><i class="fa-solid fa-check-circle" style="color: #D4AF37; margin-right: 10px;"></i> Eliminate the stress of unsold seats</li>
                    <li style="margin-bottom: 0.5rem;"><i class="fa-solid fa-check-circle" style="color: #D4AF37; margin-right: 10px;"></i> Find quick solutions for client demands</li>
                    <li style="margin-bottom: 0.5rem;"><i class="fa-solid fa-check-circle" style="color: #D4AF37; margin-right: 10px;"></i> Automated B2B quotation generation</li>
                    <li style="margin-bottom: 0.5rem;"><i class="fa-solid fa-check-circle" style="color: #D4AF37; margin-right: 10px;"></i> Secure environment with verified peers</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Core Values -->
    <div style="text-align: center; margin-bottom: 4rem;">
        <h2 style="font-size: 2.2rem; font-weight: 800; color: #1E293B; margin-bottom: 3rem; font-family: 'Outfit', sans-serif;">Our Core Values</h2>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
            <div class="value-card">
                <i class="fa-solid fa-handshake value-icon"></i>
                <h3 style="font-size: 1.3rem; font-weight: 800; color: #1E293B; margin-bottom: 1rem;">Trust & Verification</h3>
                <p style="color: #64748B; line-height: 1.6;">We maintain a 100% verified ecosystem. Only authorized agencies can participate, ensuring your business deals are safe and reliable.</p>
            </div>
            <div class="value-card">
                <i class="fa-solid fa-bolt value-icon"></i>
                <h3 style="font-size: 1.3rem; font-weight: 800; color: #1E293B; margin-bottom: 1rem;">Efficiency</h3>
                <p style="color: #64748B; line-height: 1.6;">We digitize the traditional phone-call negotiation process. Find what you need or sell what you have in minutes, not days.</p>
            </div>
            <div class="value-card">
                <i class="fa-solid fa-chart-line value-icon"></i>
                <h3 style="font-size: 1.3rem; font-weight: 800; color: #1E293B; margin-bottom: 1rem;">Mutual Growth</h3>
                <p style="color: #64748B; line-height: 1.6;">We believe in collaboration over competition. When agencies work together, the entire Umrah industry in Bangladesh grows stronger.</p>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div style="background: #0B1521; color: white; border-radius: 16px; padding: 4rem 2rem; text-align: center; margin-bottom: 4rem;">
        <h2 style="font-size: 2rem; font-weight: 800; margin-bottom: 1rem; font-family: 'Outfit', sans-serif;">Ready to transform your Umrah business?</h2>
        <p style="font-size: 1.1rem; color: #94A3B8; margin-bottom: 2rem;">Join hundreds of verified travel agencies across Bangladesh.</p>
        <a href="{{ route('register') }}" class="btn-gold" style="padding: 1rem 2.5rem; font-size: 1.1rem; border-radius: 8px;">Create Agency Account</a>
    </div>
</div>
@endsection
