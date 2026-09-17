<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B2B Package Quotation - B2B Hajj Umrah - {{ $post->title }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            color: #1E293B;
            background: #F8FAFC;
            padding: 2rem;
        }
        .quotation-card {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 2.5rem;
            border-radius: 16px;
            border: 1px solid #CBD5E1;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px solid #D4AF37;
            padding-bottom: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .brand h2 { color: #044E35; margin: 0; font-size: 1.6rem; }
        .brand p { color: #64748B; font-size: 0.85rem; margin: 0.2rem 0 0; }
        .badge { background: #ECFDF5; color: #047857; font-weight: 700; padding: 0.35rem 0.75rem; border-radius: 20px; font-size: 0.8rem; border: 1px solid #A7F3D0; }
        .grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; margin-bottom: 1.5rem; }
        .box { background: #F1F5F9; padding: 1rem; border-radius: 10px; }
        .box span { font-size: 0.78rem; color: #64748B; display: block; }
        .box strong { font-size: 1rem; color: #023624; }
        .price-box { background: #044E35; color: white; padding: 1.25rem; border-radius: 12px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
        .price-box h3 { margin: 0; font-size: 1.8rem; color: #F3E5AB; }
        .btn-print { background: #D4AF37; color: #023624; font-weight: 700; border: none; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-size: 1rem; float: right; margin-top: 1rem; }
        @media print { .btn-print { display: none; } body { background: white; padding: 0; } }
    </style>
</head>
<body>
    <div class="quotation-card">
        <div class="header">
            <div class="brand">
                <h2>{{ $post->agency->agency_name }}</h2>
                <p>Govt License No. {{ $post->agency->license_no }} | HAAB Reg: {{ $post->agency->haab_no ?? 'N/A' }}</p>
                <p>{{ $post->agency->address }} | Phone: {{ $post->agency->phone }}</p>
            </div>
            <div>
                <span class="badge">OFFICIAL B2B QUOTATION</span>
                <p style="font-size: 0.78rem; color: #64748B; margin-top: 0.5rem; text-align: right;">Date: {{ date('d M, Y') }}</p>
            </div>
        </div>

        <h3 style="color: #044E35; font-size: 1.3rem; margin-bottom: 1rem;">{{ $post->title }}</h3>

        <div class="price-box">
            <div>
                <span style="font-size: 0.85rem; color: #F3E5AB;">Confirmed Rate per Pax / Seat</span>
                <h3 style="margin-top: 0.2rem;">৳{{ number_format($post->price_per_seat) }} BDT</h3>
            </div>
            <div style="text-align: right;">
                <span style="font-size: 0.85rem; color: #F3E5AB;">Available Pax Quota</span>
                <h4 style="margin: 0; font-size: 1.3rem; color: white;">{{ $post->available_seats }} Seats</h4>
            </div>
        </div>

        <div class="grid">
            <div class="box">
                <span>Flight Departure Date</span>
                <strong>{{ $post->flight_date->format('F d, Y (l)') }}</strong>
            </div>
            <div class="box">
                <span>Airline & Departure Hub</span>
                <strong>{{ $post->airline }} ({{ $post->departure_city }} Hub - {{ strtoupper($post->flight_transit) }})</strong>
            </div>
            <div class="box">
                <span>Makkah Hotel & Haram Distance</span>
                <strong>{{ $post->makkah_hotel ?? 'N/A' }} ({{ $post->makkah_hotel_distance }} Meters)</strong>
            </div>
            <div class="box">
                <span>Madinah Hotel & Distance</span>
                <strong>{{ $post->madinah_hotel ?? 'N/A' }} ({{ $post->madinah_hotel_distance }} Meters)</strong>
            </div>
        </div>

        <div style="background: #FFFDF5; border: 1px solid rgba(212, 175, 55, 0.4); padding: 1.25rem; border-radius: 12px; margin-bottom: 1.5rem;">
            <h4 style="margin: 0 0 0.5rem; color: #044E35;">B2B Trading & Commission Terms:</h4>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.75rem; font-size: 0.85rem; color: #334155;">
                <div><strong>Allowed Gender:</strong> {{ ucfirst($post->allowed_gender) }}</div>
                <div><strong>Route Sequence:</strong> {{ strtoupper(str_replace('_', ' ', $post->route_sequence)) }}</div>
                <div><strong>Catering Style:</strong> {{ strtoupper(str_replace('_', ' ', $post->catering_type)) }}</div>
                <div><strong>Agent Commission:</strong> ৳{{ number_format($post->agent_commission ?? 0) }} / Seat</div>
                <div><strong>Name Change Policy:</strong> {{ ucfirst(str_replace('_', ' ', $post->name_change_policy)) }}</div>
                <div><strong>Visa Type:</strong> {{ strtoupper(str_replace('_', ' ', $post->visa_type)) }}</div>
            </div>
        </div>

        <div style="background: #F8FAFC; border: 1px solid #E2E8F0; padding: 1.25rem; border-radius: 12px; margin-bottom: 1.5rem;">
            <h4 style="margin-bottom: 0.5rem; color: #044E35;">Package Services Included:</h4>
            <p style="font-size: 0.9rem; margin: 0;">
                ✔️ Meals Catering &nbsp;|&nbsp; ✔️ Visa Processing &nbsp;|&nbsp; ✔️ AC Bus Transport &nbsp;|&nbsp; ✔️ Haramain Bullet Train ({{ $post->haramain_train ? 'Included' : 'Optional' }}) &nbsp;|&nbsp; ✔️ 5L Zamzam Water
            </p>
        </div>

        @if($post->details)
            <div style="margin-bottom: 1.5rem;">
                <h4 style="color: #044E35; margin-bottom: 0.35rem;">Additional B2B Terms & Notes:</h4>
                <p style="font-size: 0.9rem; color: #475569; line-height: 1.5;">{{ $post->details }}</p>
            </div>
        @endif

        <div style="border-top: 1px solid #E2E8F0; padding-top: 1rem; font-size: 0.8rem; color: #94A3B8; display: flex; justify-content: space-between; align-items: center;">
            <p>Generated via B2B Hajj Umrah SaaS Platform. Facilitated by {{ $post->agency->agency_name }}.</p>
            <button onclick="window.print()" class="btn-print">🖨️ Print B2B Quotation</button>
        </div>
    </div>
</body>
</html>
