@extends('layouts.app')

@section('title', 'How It Works - UMRAH B2B')

@section('content')
<style>
    .page-hero {
        background: linear-gradient(135deg, #0b1521 0%, #044E35 100%);
        color: white;
        padding: 4rem 2rem;
        border-radius: 16px;
        margin-bottom: 3rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .page-hero::after {
        content: '';
        position: absolute;
        top: 0; right: 0; bottom: 0; left: 0;
        background: url('{{ asset("images/pattern.svg") }}') center/cover;
        opacity: 0.1;
        pointer-events: none;
    }
    .step-card {
        background: white;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
        transition: transform 0.3s, box-shadow 0.3s;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .step-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        border-color: #D4AF37;
    }
    .step-icon {
        width: 64px;
        height: 64px;
        background: #FDF9E6;
        color: #D4AF37;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
    }
    .section-title {
        font-size: 2rem;
        font-weight: 800;
        color: #1E293B;
        text-align: center;
        margin-bottom: 3rem;
        font-family: 'Outfit', sans-serif;
    }
    .badge-role {
        display: inline-block;
        padding: 0.5rem 1.5rem;
        background: #044E35;
        color: white;
        border-radius: 30px;
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 2rem;
    }
</style>

<div class="page-hero">
    <h1 style="font-size: 2.8rem; font-weight: 800; margin-bottom: 1rem; font-family: 'Outfit', sans-serif;">How UMRAH B2B Works</h1>
    <p style="font-size: 1.1rem; color: #CBD5E1; max-width: 600px; margin: 0 auto;">A seamless, secure, and exclusive platform designed specifically for HAAB-verified travel agencies in Bangladesh to exchange group seats and flight tickets.</p>
</div>

<!-- For Agencies Looking for Seats (Buyers) -->
<div style="margin-bottom: 5rem;">
    <div style="text-align: center;">
        <span class="badge-role"><i class="fa-solid fa-magnifying-glass me-2"></i> For Agencies Looking for Seats</span>
    </div>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem;">
        <!-- Step 1 -->
        <div class="step-card">
            <div class="step-icon">1</div>
            <h3 style="font-size: 1.3rem; font-weight: 800; color: #1E293B; margin-bottom: 0.75rem;">Browse & Search</h3>
            <p style="color: #64748B; line-height: 1.6;">Use our powerful search to find available Umrah group seats or tickets from verified agencies matching your required dates, airlines, and destinations.</p>
        </div>
        
        <!-- Step 2 -->
        <div class="step-card">
            <div class="step-icon">2</div>
            <h3 style="font-size: 1.3rem; font-weight: 800; color: #1E293B; margin-bottom: 0.75rem;">Send an Inquiry</h3>
            <p style="color: #64748B; line-height: 1.6;">Found the perfect match? Submit an inquiry directly through the platform. State how many seats you need and start the negotiation process.</p>
        </div>
        
        <!-- Step 3 -->
        <div class="step-card">
            <div class="step-icon">3</div>
            <h3 style="font-size: 1.3rem; font-weight: 800; color: #1E293B; margin-bottom: 0.75rem;">Confirm & Secure</h3>
            <p style="color: #64748B; line-height: 1.6;">Once the providing agency accepts your inquiry, finalize the deal, generate automated B2B quotations, and secure your passengers' travel.</p>
        </div>
    </div>
</div>

<hr style="border: 0; border-top: 1px dashed #CBD5E1; margin: 3rem 0;">

<!-- For Agencies with Extra Seats (Sellers) -->
<div style="margin-bottom: 5rem;">
    <div style="text-align: center;">
        <span class="badge-role" style="background: #D4AF37; color: #0b1521;"><i class="fa-solid fa-layer-group me-2"></i> For Agencies with Extra Seats</span>
    </div>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem;">
        <!-- Step 1 -->
        <div class="step-card">
            <div class="step-icon" style="background: #ECFDF5; color: #047857;">1</div>
            <h3 style="font-size: 1.3rem; font-weight: 800; color: #1E293B; margin-bottom: 0.75rem;">Post Your Seats</h3>
            <p style="color: #64748B; line-height: 1.6;">Have unsold group seats or blocked tickets? Create a post detailing the route, date, airline, hotel category, and available seat count.</p>
        </div>
        
        <!-- Step 2 -->
        <div class="step-card">
            <div class="step-icon" style="background: #ECFDF5; color: #047857;">2</div>
            <h3 style="font-size: 1.3rem; font-weight: 800; color: #1E293B; margin-bottom: 0.75rem;">Receive Inquiries</h3>
            <p style="color: #64748B; line-height: 1.6;">Other verified agencies will see your post and send you inquiries. Review their profiles and the number of seats they are requesting.</p>
        </div>
        
        <!-- Step 3 -->
        <div class="step-card">
            <div class="step-icon" style="background: #ECFDF5; color: #047857;">3</div>
            <h3 style="font-size: 1.3rem; font-weight: 800; color: #1E293B; margin-bottom: 0.75rem;">Close the Deal</h3>
            <p style="color: #64748B; line-height: 1.6;">Accept the best inquiries, confirm the seat transfer, and ensure you don't lose money on unsold blocked tickets.</p>
        </div>
    </div>
</div>

<!-- Trust Banner -->
<div style="background: #FDF9E6; border: 1px solid #D4AF37; border-radius: 12px; padding: 2.5rem; display: flex; align-items: center; gap: 2rem; flex-wrap: wrap;">
    <div style="font-size: 4rem; color: #044E35;">
        <i class="fa-solid fa-shield-halved"></i>
    </div>
    <div style="flex: 1; min-width: 300px;">
        <h3 style="font-size: 1.5rem; font-weight: 800; color: #044E35; margin-bottom: 0.5rem;">100% Verified Ecosystem</h3>
        <p style="color: #1E293B; line-height: 1.6; margin-bottom: 0;">We take trust seriously. Every single agency on our platform is strictly vetted using their HAAB license, Trade License, and NID. Unauthorized users cannot view agency details or perform B2B transactions. You only do business with verified peers.</p>
    </div>
    <div>
        <a href="{{ route('register') }}" class="btn-gold" style="padding: 0.8rem 2rem; font-size: 1.1rem; border-radius: 8px;">Join the Network</a>
    </div>
</div>

@endsection
