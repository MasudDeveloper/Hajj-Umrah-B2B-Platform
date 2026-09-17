<!DOCTYPE html>
@php
    $lang = session('locale', 'bn');
    $seller = $inquiry->post->agency;
    $buyer = $inquiry->inquiringAgency;
    $post = $inquiry->post;
    $rate = $inquiry->offered_price_per_seat ?: $post->price_per_seat;
    $totalVal = $inquiry->requested_seats * $rate;
    $advance = $inquiry->advance_amount_agreed ?: $post->advance_deposit;
    $due = max(0, $totalVal - $advance);
@endphp
<html lang="{{ $lang }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B2B Official Contract Agreement #{{ $inquiry->contract_number ?? 'DRAFT' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Inter:wght@400;500;600;700&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --primary: #044E35;
            --primary-dark: #023624;
            --accent: #D4AF37;
            --border: #CBD5E1;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Hind Siliguri', 'Inter', sans-serif;
            background: #F8FAFC;
            color: #0F172A;
            padding: 2rem 1rem;
        }

        .contract-container {
            max-width: 920px;
            margin: 0 auto;
            background: white;
            border-radius: 16px;
            border: 2px solid var(--primary);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 2.5rem;
            position: relative;
        }

        .header-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid var(--accent);
            padding-bottom: 1.5rem;
            margin-bottom: 1.75rem;
        }

        .brand-box {
            display: flex;
            align-items: center;
            gap: 0.85rem;
        }

        .brand-logo {
            width: 52px;
            height: 52px;
            background: linear-gradient(135deg, var(--accent), #B38F22);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-dark);
            font-size: 1.6rem;
        }

        .party-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .party-card {
            background: #F8FAFC;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1.25rem;
        }

        .party-title {
            font-size: 0.82rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.75rem;
            padding-bottom: 0.35rem;
            border-bottom: 1px solid #E2E8F0;
        }

        .seller-title { color: #047857; }
        .buyer-title { color: #0284C7; }

        .specs-table, .financial-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
            font-size: 0.92rem;
        }

        .specs-table th, .financial-table th {
            background: #023624;
            color: white;
            padding: 0.75rem 1rem;
            text-align: left;
            font-size: 0.82rem;
            text-transform: uppercase;
        }

        .specs-table td, .financial-table td {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #E2E8F0;
        }

        .terms-section {
            background: #FFFDF5;
            border: 1px solid #FDE68A;
            border-radius: 12px;
            padding: 1.25rem;
            margin-bottom: 2rem;
        }

        .terms-section h4 {
            color: #78350F;
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            border-bottom: 1px solid #FCD34D;
            padding-bottom: 0.35rem;
        }

        .terms-list {
            margin: 0;
            padding-left: 1.25rem;
            font-size: 0.85rem;
            color: #451A03;
            line-height: 1.6;
        }

        .terms-list li {
            margin-bottom: 0.5rem;
        }

        .signature-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            margin-top: 3.5rem;
            padding-top: 1.5rem;
        }

        .signature-line {
            border-top: 2px dashed #94A3B8;
            text-align: center;
            padding-top: 0.5rem;
            font-size: 0.88rem;
            font-weight: 700;
            color: #334155;
        }

        .no-print {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 920px;
            margin: 0 auto 1.5rem;
        }

        @media print {
            body { background: white; padding: 0; }
            .contract-container { border: none; box-shadow: none; padding: 0; }
            .no-print { display: none !important; }
        }
    </style>
</head>

<body>

    <div class="no-print">
        <a href="{{ route('dashboard.index') }}" style="color: var(--primary); text-decoration: none; font-weight: 700;">
            <i class="fa-solid fa-arrow-left me-1"></i> {{ $lang == 'bn' ? 'মাই ড্যাশবোর্ডে ফিরুন' : 'Back to Agency Dashboard' }}
        </a>

        <button onclick="window.print()" style="background: linear-gradient(135deg, var(--accent), #B38F22); color: var(--primary-dark); font-weight: 800; padding: 0.65rem 1.5rem; border-radius: 8px; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 0.5rem;">
            <i class="fa-solid fa-print"></i> {{ $lang == 'bn' ? 'অফিশিয়াল চুক্তিপত্র প্রিন্ট করুন (PDF)' : 'Print Official Agreement' }}
        </button>
    </div>

    <div class="contract-container">
        <!-- Header -->
        <div class="header-bar">
            <div class="brand-box">
                <div class="brand-logo">
                    <i class="fa-solid fa-kaaba"></i>
                </div>
                <div>
                    <h1 style="font-size: 1.6rem; color: var(--primary-dark); font-weight: 800; line-height: 1.1;">B2B HAJJ UMRAH NETWORK</h1>
                    <span style="font-size: 0.8rem; color: #64748B; font-weight: 600;">BANGLADESH LICENSED AGENCY DEALS & CONTRACTING</span>
                </div>
            </div>

            <div style="text-align: right;">
                <span style="background: #ECFDF5; color: #047857; border: 1px solid #A7F3D0; font-weight: 800; padding: 0.35rem 0.85rem; border-radius: 20px; font-size: 0.8rem; display: inline-block; margin-bottom: 0.35rem;">
                    <i class="fa-solid fa-shield-check me-1"></i> OFFICIAL B2B CONTRACT
                </span>
                <div style="font-weight: 800; font-size: 0.95rem; color: var(--primary-dark);">REF: {{ $inquiry->contract_number ?? 'B2B-CONTRACT-DRAFT' }}</div>
                <div style="font-size: 0.78rem; color: #64748B;">Date: {{ $inquiry->deal_completed_at ? $inquiry->deal_completed_at->format('d M, Y h:i A') : date('d M, Y') }}</div>
            </div>
        </div>

        <div style="text-align: center; margin-bottom: 2rem; background: #FFFDF5; border: 1px solid #FDE68A; padding: 0.85rem; border-radius: 10px;">
            <h2 style="font-size: 1.35rem; color: #78350F; font-weight: 800; text-transform: uppercase;">
                {{ $lang == 'bn' ? 'দ্বিপাক্ষিক হজ ও ওমরাহ B2B গ্রুপ সিট চুক্তিপত্র' : 'OFFICIAL B2B HAJJ & UMRAH ALLOCATION CONTRACT' }}
            </h2>
            <p style="font-size: 0.82rem; color: #92400E; margin-top: 0.2rem;">
                This contract represents a legally recognized allocation agreement between two HAAB-licensed travel agencies in Bangladesh.
            </p>
        </div>

        <!-- 2 Parties Grid -->
        <div class="party-grid">
            <!-- Seller Agency -->
            <div class="party-card">
                <div class="party-title seller-title">
                    <i class="fa-solid fa-building-circle-check me-1"></i> SELLER AGENCY (সরবরাহকারী)
                </div>
                <h3 style="font-size: 1.15rem; color: var(--primary-dark); font-weight: 800; margin-bottom: 0.35rem;">{{ $seller->agency_name }}</h3>
                <p style="font-size: 0.88rem; color: #475569; margin-bottom: 0.25rem;"><strong>HAAB License:</strong> {{ $seller->haab_no ?? $seller->license_no }} | <strong>Govt Lic:</strong> {{ $seller->license_no }}</p>
                <p style="font-size: 0.88rem; color: #475569; margin-bottom: 0.25rem;"><strong>Managing Director:</strong> {{ $seller->owner_name }}</p>
                <p style="font-size: 0.88rem; color: #475569; margin-bottom: 0.25rem;"><strong>Phone/WhatsApp:</strong> {{ $seller->phone }}</p>
                <p style="font-size: 0.88rem; color: #475569; margin-bottom: 0.25rem;"><strong>Email:</strong> {{ $seller->email }}</p>
                <p style="font-size: 0.82rem; color: #64748B;"><strong>Office:</strong> {{ $seller->address ?? $seller->city }}</p>
            </div>

            <!-- Buyer Agency -->
            <div class="party-card">
                <div class="party-title buyer-title">
                    <i class="fa-solid fa-handshake me-1"></i> BUYER AGENCY (গ্রহীতা)
                </div>
                <h3 style="font-size: 1.15rem; color: var(--primary-dark); font-weight: 800; margin-bottom: 0.35rem;">{{ $buyer->agency_name }}</h3>
                <p style="font-size: 0.88rem; color: #475569; margin-bottom: 0.25rem;"><strong>HAAB License:</strong> {{ $buyer->haab_no ?? $buyer->license_no }} | <strong>Govt Lic:</strong> {{ $buyer->license_no }}</p>
                <p style="font-size: 0.88rem; color: #475569; margin-bottom: 0.25rem;"><strong>Managing Director:</strong> {{ $buyer->owner_name }}</p>
                <p style="font-size: 0.88rem; color: #475569; margin-bottom: 0.25rem;"><strong>Phone/WhatsApp:</strong> {{ $buyer->phone }}</p>
                <p style="font-size: 0.88rem; color: #475569; margin-bottom: 0.25rem;"><strong>Email:</strong> {{ $buyer->email }}</p>
                <p style="font-size: 0.82rem; color: #64748B;"><strong>Office:</strong> {{ $buyer->address ?? $buyer->city }}</p>
            </div>
        </div>

        <!-- Deal Specs Table -->
        <h4 style="font-size: 1.05rem; color: var(--primary-dark); font-weight: 700; margin-bottom: 0.75rem;">
            <i class="fa-solid fa-plane-circle-check text-amber-600 me-1"></i> Package & Flight Deal Specifications
        </h4>
        <table class="specs-table">
            <thead>
                <tr>
                    <th>Package & Category</th>
                    <th>Airline & PNR</th>
                    <th>Flight Date & Hub</th>
                    <th>Hotels & Room</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong style="color: var(--primary-dark);">{{ strtoupper($post->hajj_or_umrah ?? 'umrah') }} DEAL</strong><br>
                        <span style="font-size: 0.8rem; color: #64748B;">Category: {{ strtoupper(str_replace('_', ' ', $post->post_category)) }}</span>
                    </td>
                    <td>
                        <strong>{{ $post->airline }}</strong><br>
                        <span style="font-size: 0.8rem; color: #0284C7;">PNR: {{ $post->pnr_code ?? 'Group Block' }}</span>
                    </td>
                    <td>
                        <strong>{{ $post->flight_date->format('d M, Y') }}</strong><br>
                        <span style="font-size: 0.8rem; color: #64748B;">Hub: {{ $post->departure_city }} ({{ strtoupper($post->flight_transit ?? 'Direct') }})</span>
                    </td>
                    <td>
                        <strong>Makkah: {{ $post->makkah_hotel ?? 'N/A' }} ({{ $post->makkah_hotel_distance }}m)</strong><br>
                        <span style="font-size: 0.8rem; color: #64748B;">Madinah: {{ $post->madinah_hotel ?? 'N/A' }} | Room: {{ strtoupper($post->room_type) }}</span>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Financial Breakdown Table -->
        <h4 style="font-size: 1.05rem; color: var(--primary-dark); font-weight: 700; margin-bottom: 0.75rem;">
            <i class="fa-solid fa-calculator text-emerald-600 me-1"></i> Financial Settlement Breakdown (BDT)
        </h4>
        <table class="financial-table">
            <thead>
                <tr>
                    <th>Agreed Seat Pax Count</th>
                    <th>Rate Per Seat (BDT)</th>
                    <th>Total Deal Amount</th>
                    <th>Advance Token Deposit</th>
                    <th>Remaining Payable Due</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight: 700; font-size: 1.1rem; color: #DC2626;">{{ $inquiry->requested_seats }} Pax Seats</td>
                    <td style="font-weight: 700;">৳{{ number_format($rate) }}</td>
                    <td style="font-weight: 800; font-size: 1.1rem; color: var(--primary-dark);">৳{{ number_format($totalVal) }}</td>
                    <td style="font-weight: 700; color: #047857;">৳{{ number_format($advance) }} (CONFIRMED)</td>
                    <td style="font-weight: 800; color: #B45309;">৳{{ number_format($due) }}</td>
                </tr>
            </tbody>
        </table>

        @if($inquiry->seller_note || $inquiry->message)
            <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 10px; padding: 1rem; margin-bottom: 1.5rem; font-size: 0.88rem;">
                <strong style="color: var(--primary-dark); display: block; margin-bottom: 0.35rem;"><i class="fa-solid fa-comment-dots me-1"></i> Agreed Custom Notes:</strong>
                @if($inquiry->message)
                    <p style="margin-bottom: 0.35rem;"><strong>Buyer Note:</strong> {{ $inquiry->message }}</p>
                @endif
                @if($inquiry->seller_note)
                    <p style="margin: 0;"><strong>Seller Confirmation:</strong> {{ $inquiry->seller_note }}</p>
                @endif
            </div>
        @endif

        <!-- Standard Legal B2B Terms & Conditions Clause Box -->
        <div class="terms-section">
            <h4><i class="fa-solid fa-gavel me-1"></i> দ্বিপাক্ষিক চুক্তির আবশ্যকীয় শর্তাবলী ও আইনগত নিয়মাবলী (Terms & Conditions):</h4>
            <ol class="terms-list">
                <li><strong>পাসপোর্ট ও যাত্রী তথ্য জমা:</strong> বায়ার এজেন্সিকে নির্ধারিত ফ্লাইটের ন্যূনতম ১৫ দিন পূর্বে (অথবা নেম ডেডলাইনের পূর্বে) সকল যাত্রীর সঠিক নাম, পাসপোর্ট কপি ও প্রয়োজনীয় ভিসা নথিপত্র সেলার এজেন্সির নিকট জমা প্রদান করতে হবে।</li>
                <li><strong>বকেয়া অর্থ নিষ্পত্তি:</strong> বায়ার এজেন্সিকে ফ্লাইট বা সেবার ৭ দিন পূর্বে বকেয়া সমস্ত অর্থ (৳{{ number_format($due) }}) সেলার এজেন্সির ব্যাংক অ্যাকাউন্ট বা অনুমোদিত মাধ্যমে সম্পূর্ণ পরিশোধ করতে হবে। সময়মতো বকেয়া পরিশোধে ব্যর্থ হলে অগ্রিম বুকিং আমানত বাজেয়াপ্ত হতে পারে।</li>
                <li><strong>নাম পরিবর্তন ও ক্যান্সেলেশন পলিসি:</strong> এয়ারলাইন্সের টিকিটের নাম পরিবর্তন (Name Change) বা সিট বাতিলের ক্ষেত্রে সংশ্লিষ্ট এয়ারলাইন্স এবং সেলার এজেন্সির ক্যান্সেলেশন পলিসি ও ফি প্রযোজ্য হবে। নির্ধারিত নাম ডেডলাইন পার হওয়ার পর নাম পরিবর্তন গ্রহণযোগ্য হবে না।</li>
                <li><strong>ভিসা ও ইমিগ্রেশন নিয়মাবলী:</strong> সৌদি হজ ও ওমরাহ মন্ত্রণালয়ের (MOHU) নিয়ম অনুযায়ী সকল যাত্রীর ওমরাহ ভিসা নিশ্চিতকরণ এবং ফিটনেস দেখা বায়ারের দায়িত্ব। কোনো যাত্রীর নো-শো (No-Show) বা ইমিগ্রেশন জটিলতার জন্য সেলার এজেন্সি দায়ী থাকবে না।</li>
                <li><strong>ফ্লাইট পুনঃতফসিলে দায়বদ্ধতা:</strong> এয়ারলাইন্স কর্তৃক ফ্লাইট সময় পরিবর্তন, ডিল বা বাতিলের ক্ষেত্রে সরাসরি এয়ারলাইন্সের নিজস্ব সার্ভিস পলিসি প্রযোজ্য হবে। প্রাকৃতিক দুর্যোগ বা বাধ্যবাধকতার (Force Majeure) ক্ষেত্রে আন্তর্জাতিক এভিয়েশন আইন বলবৎ থাকবে।</li>
                <li><strong>বিরোধ নিষ্পত্তি ও আইনগত এখতিয়ার:</strong> এই চুক্তির যেকোনো শর্তাবলী নিয়ে অসন্তোষ দেখা দিলে উভয় পক্ষ পারস্পরিক আলোচনার মাধ্যমে অথবা হাব (HAAB) এবং বাংলাদেশ সরকারের ধর্ম বিষয়ক মন্ত্রণালয়ের মধ্যস্থতায় তা নিষ্পত্তিতে বাধ্য থাকবে।</li>
            </ol>
        </div>

        <!-- Legal Disclaimer & Signatures -->
        <div style="font-size: 0.78rem; color: #64748B; line-height: 1.5; background: #F8FAFC; padding: 0.85rem; border-radius: 8px; border: 1px solid #E2E8F0;">
            <strong>Declaration:</strong> Both agencies hereby declare that the passenger seat allocation details stated above are verified and agreed upon. The advance token money has been received and confirmed by the Seller Agency. The B2B Hajj Umrah Platform acts strictly as an automated software matchmaker and is not liable for financial defaults.
        </div>

        <div class="signature-grid">
            <div class="signature-line">
                <div>Authorized Signature & Seal</div>
                <div style="font-size: 0.8rem; color: #64748B; margin-top: 0.2rem;">{{ $seller->agency_name }}</div>
            </div>

            <div class="signature-line">
                <div>Authorized Signature & Seal</div>
                <div style="font-size: 0.8rem; color: #64748B; margin-top: 0.2rem;">{{ $buyer->agency_name }}</div>
            </div>
        </div>
    </div>

</body>
</html>
