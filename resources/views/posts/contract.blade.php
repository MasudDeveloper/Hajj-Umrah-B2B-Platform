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
    $contractRef = $inquiry->contract_number ?? ('B2B-CON-' . date('Y') . '-' . str_pad($inquiry->id, 5, '0', STR_PAD_LEFT));
    $dealDate = $inquiry->deal_completed_at ? $inquiry->deal_completed_at->format('d F, Y - h:i A') : ($inquiry->updated_at ? $inquiry->updated_at->format('d F, Y') : date('d F, Y'));
@endphp
<html lang="{{ $lang }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>দ্বিপাক্ষিক বি২বি চুক্তিপত্র #{{ $contractRef }} | B2B Hajj Umrah Network</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --primary: #044E35;
            --primary-dark: #023624;
            --primary-light: #06724E;
            --accent-gold: #C59A27;
            --gold-light: #FBF6E9;
            --gold-border: #E8D399;
            --slate-800: #1E293B;
            --slate-600: #475569;
            --slate-500: #64748B;
            --slate-100: #F1F5F9;
            --slate-50: #F8FAFC;
            --danger: #DC2626;
            --success: #059669;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Hind Siliguri', 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #E2E8F0;
            color: #0F172A;
            padding: 2rem 1rem;
            line-height: 1.6;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        /* Top Action Bar (hidden in print) */
        .top-action-bar {
            max-width: 960px;
            margin: 0 auto 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #FFFFFF;
            color: var(--primary);
            text-decoration: none;
            font-weight: 700;
            font-size: 0.95rem;
            padding: 0.65rem 1.25rem;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.06);
            transition: all 0.2s ease;
            border: 1px solid #CBD5E1;
        }

        .back-link:hover {
            background: #F8FAFC;
            color: var(--primary-dark);
            transform: translateY(-1px);
        }

        .btn-print {
            background: linear-gradient(135deg, #C59A27 0%, #9E7412 100%);
            color: #FFFFFF;
            font-weight: 800;
            font-size: 0.95rem;
            padding: 0.75rem 1.75rem;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            box-shadow: 0 4px 12px rgba(197, 154, 39, 0.35);
            transition: all 0.2s ease;
        }

        .btn-print:hover {
            background: linear-gradient(135deg, #D4AF37 0%, #B38F22 100%);
            box-shadow: 0 6px 16px rgba(197, 154, 39, 0.45);
            transform: translateY(-1px);
        }

        /* Legal Deed Document Styling */
        .contract-wrapper {
            max-width: 960px;
            margin: 0 auto;
            background: #FFFFFF;
            border-radius: 12px;
            border: 3px solid var(--primary-dark);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
            padding: 2.75rem 3rem;
            position: relative;
            overflow: hidden;
        }

        /* Inner Decorative Border like real Deed Papers */
        .contract-inner-border {
            position: absolute;
            top: 10px;
            bottom: 10px;
            left: 10px;
            right: 10px;
            border: 1px solid var(--gold-border);
            pointer-events: none;
            border-radius: 8px;
        }

        /* Subtle Security Watermark */
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            font-size: 5rem;
            font-weight: 900;
            color: rgba(4, 78, 53, 0.03);
            text-transform: uppercase;
            white-space: nowrap;
            letter-spacing: 10px;
            pointer-events: none;
            user-select: none;
            z-index: 0;
            font-family: 'Inter', sans-serif;
        }

        .contract-content {
            position: relative;
            z-index: 1;
        }

        /* Top Government / HAAB Accreditation Bar */
        .gov-banner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px dashed #CBD5E1;
            padding-bottom: 0.75rem;
            margin-bottom: 1.25rem;
            font-size: 0.8rem;
            color: var(--slate-600);
        }

        .gov-banner-left {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
        }

        .gov-banner-badge {
            background: #EFF6FF;
            color: #1D4ED8;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 0.2rem 0.55rem;
            border-radius: 4px;
            border: 1px solid #BFDBFE;
            text-transform: uppercase;
        }

        /* Header Branding */
        .header-bar {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2px solid var(--accent-gold);
            padding-bottom: 1.25rem;
            margin-bottom: 1.5rem;
        }

        .brand-box {
            display: flex;
            align-items: center;
            gap: 1.15rem;
        }

        .brand-logo-emblem {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border: 2px solid var(--accent-gold);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent-gold);
            font-size: 1.85rem;
            box-shadow: 0 4px 10px rgba(4, 78, 53, 0.2);
        }

        .brand-text h1 {
            font-size: 1.65rem;
            color: var(--primary-dark);
            font-weight: 800;
            letter-spacing: -0.5px;
            line-height: 1.15;
            font-family: 'Inter', 'Hind Siliguri', sans-serif;
        }

        .brand-text p {
            font-size: 0.78rem;
            color: #64748B;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.75px;
            margin-top: 0.2rem;
        }

        .header-meta {
            text-align: right;
        }

        .status-badge-verified {
            background: #ECFDF5;
            color: #047857;
            border: 1.5px solid #10B981;
            font-weight: 800;
            padding: 0.35rem 0.85rem;
            border-radius: 20px;
            font-size: 0.78rem;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            margin-bottom: 0.35rem;
            letter-spacing: 0.5px;
        }

        .ref-code {
            font-family: 'Inter', monospace;
            font-weight: 800;
            font-size: 1rem;
            color: var(--primary-dark);
            letter-spacing: 0.5px;
        }

        .date-text {
            font-size: 0.8rem;
            color: var(--slate-500);
            font-weight: 500;
            margin-top: 0.15rem;
        }

        /* Document Title Section */
        .contract-title-box {
            text-align: center;
            background: linear-gradient(180deg, #FFFDF5 0%, #FEF9E7 100%);
            border: 1.5px solid var(--gold-border);
            border-radius: 10px;
            padding: 1.15rem 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 8px rgba(197, 154, 39, 0.08);
            position: relative;
        }

        .contract-title-box h2 {
            font-size: 1.45rem;
            color: #78350F;
            font-weight: 800;
            letter-spacing: -0.3px;
            margin-bottom: 0.2rem;
        }

        .contract-title-box .sub-title {
            font-size: 0.82rem;
            color: #92400E;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .contract-preamble {
            font-size: 0.88rem;
            color: #334155;
            background: #F8FAFC;
            border-left: 4px solid var(--primary);
            padding: 0.85rem 1.15rem;
            border-radius: 0 8px 8px 0;
            margin-bottom: 1.75rem;
            line-height: 1.7;
        }

        /* Parties Grid */
        .section-heading {
            font-size: 1.02rem;
            color: var(--primary-dark);
            font-weight: 800;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            border-bottom: 2px solid #E2E8F0;
            padding-bottom: 0.4rem;
        }

        .party-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
            margin-bottom: 1.75rem;
        }

        .party-card {
            background: #FFFFFF;
            border: 1.5px solid #E2E8F0;
            border-radius: 10px;
            padding: 1.2rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
        }

        .party-card.seller-card {
            border-top: 4px solid #047857;
            background: linear-gradient(180deg, #F0FDF4 0%, #FFFFFF 22%);
        }

        .party-card.buyer-card {
            border-top: 4px solid #0284C7;
            background: linear-gradient(180deg, #F0F9FF 0%, #FFFFFF 22%);
        }

        .party-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.74rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 0.2rem 0.6rem;
            border-radius: 5px;
            margin-bottom: 0.65rem;
        }

        .seller-badge {
            background: #DCFCE7;
            color: #15803D;
            border: 1px solid #BBF7D0;
        }

        .buyer-badge {
            background: #E0F2FE;
            color: #0369A1;
            border: 1px solid #BAE6FD;
        }

        .agency-name-title {
            font-size: 1.18rem;
            color: var(--primary-dark);
            font-weight: 800;
            line-height: 1.25;
            margin-bottom: 0.5rem;
        }

        .party-info-list {
            list-style: none;
            font-size: 0.85rem;
            color: #334155;
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
        }

        .party-info-list li {
            display: flex;
            justify-content: space-between;
            border-bottom: 1px dashed #F1F5F9;
            padding-bottom: 0.2rem;
        }

        .party-info-list li span.label {
            color: #64748B;
            font-weight: 600;
            font-size: 0.82rem;
        }

        .party-info-list li span.val {
            font-weight: 700;
            color: #0F172A;
            text-align: right;
        }

        /* Specifications Grid */
        .specs-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0.75rem;
            margin-bottom: 1.75rem;
        }

        .spec-item {
            background: #F8FAFC;
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            padding: 0.75rem;
        }

        .spec-item .label {
            font-size: 0.72rem;
            color: #64748B;
            font-weight: 700;
            text-transform: uppercase;
            display: block;
            margin-bottom: 0.2rem;
        }

        .spec-item .val {
            font-size: 0.88rem;
            font-weight: 800;
            color: var(--primary-dark);
            line-height: 1.3;
        }

        .spec-item .sub-val {
            font-size: 0.74rem;
            color: #475569;
            margin-top: 0.15rem;
            display: block;
        }

        /* Financial Ledger Table */
        .financial-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 1.75rem;
            border-radius: 8px;
            overflow: hidden;
            border: 1.5px solid #CBD5E1;
            font-size: 0.9rem;
        }

        .financial-table th {
            background: #023624;
            color: #FFFFFF;
            padding: 0.8rem 1rem;
            text-align: left;
            font-size: 0.8rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .financial-table td {
            padding: 0.85rem 1rem;
            border-bottom: 1px solid #E2E8F0;
            background: #FFFFFF;
        }

        .financial-table tr:last-child td {
            border-bottom: none;
        }

        .financial-table .highlight-seat {
            font-size: 1.1rem;
            font-weight: 800;
            color: #DC2626;
        }

        .financial-table .highlight-total {
            font-size: 1.15rem;
            font-weight: 800;
            color: var(--primary-dark);
        }

        .financial-table .highlight-advance {
            font-size: 1.05rem;
            font-weight: 800;
            color: #047857;
        }

        .financial-table .highlight-due {
            font-size: 1.1rem;
            font-weight: 800;
            color: #B45309;
        }

        /* Custom Agreement Notes */
        .custom-notes-box {
            background: #FFFBEB;
            border: 1.5px solid #FDE68A;
            border-radius: 8px;
            padding: 1rem 1.15rem;
            margin-bottom: 1.75rem;
            font-size: 0.86rem;
        }

        .custom-notes-box h5 {
            color: #92400E;
            font-weight: 800;
            margin-bottom: 0.4rem;
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.92rem;
        }

        /* Terms and Conditions Section (10 Clauses) */
        .terms-container {
            background: #FCFDFE;
            border: 1.5px solid #CBD5E1;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.75rem;
        }

        .terms-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid var(--accent-gold);
            padding-bottom: 0.65rem;
            margin-bottom: 1.1rem;
        }

        .terms-header h3 {
            font-size: 1.1rem;
            color: var(--primary-dark);
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .terms-header .law-note {
            font-size: 0.74rem;
            color: #64748B;
            font-weight: 700;
            background: #F1F5F9;
            padding: 0.2rem 0.55rem;
            border-radius: 4px;
        }

        .terms-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 0.75rem;
        }

        .clause-item {
            display: flex;
            gap: 0.8rem;
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 7px;
            padding: 0.75rem 0.95rem;
            line-height: 1.6;
            font-size: 0.85rem;
            color: #1E293B;
            page-break-inside: avoid;
        }

        .clause-number {
            flex-shrink: 0;
            width: 26px;
            height: 26px;
            background: var(--primary-dark);
            color: var(--accent-gold);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 0.78rem;
            margin-top: 0.1rem;
        }

        .clause-body {
            flex: 1;
        }

        .clause-title {
            font-weight: 800;
            color: var(--primary-dark);
            margin-bottom: 0.15rem;
            font-size: 0.9rem;
        }

        .clause-desc {
            color: #334155;
            font-size: 0.84rem;
        }

        /* Audit Box */
        .audit-box {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #F8FAFC;
            border: 1.5px solid #E2E8F0;
            border-radius: 8px;
            padding: 0.95rem 1.15rem;
            margin-bottom: 2rem;
            gap: 1.25rem;
            page-break-inside: avoid;
        }

        .audit-text {
            font-size: 0.78rem;
            color: #475569;
            line-height: 1.55;
            flex: 1;
        }

        .qr-seal-box {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            border-left: 2px dashed #CBD5E1;
            padding-left: 1.15rem;
            flex-shrink: 0;
        }

        .qr-placeholder {
            width: 70px;
            height: 70px;
            background: #FFFFFF;
            border: 1.5px solid var(--accent-gold);
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4px;
        }

        .qr-placeholder svg {
            width: 100%;
            height: 100%;
        }

        .qr-details {
            font-size: 0.7rem;
            color: #64748B;
            line-height: 1.35;
        }

        .qr-details strong {
            color: var(--primary-dark);
            display: block;
            font-size: 0.76rem;
            font-weight: 800;
        }

        /* Signatures Section */
        .signatures-wrapper {
            margin-top: 1.75rem;
            page-break-inside: avoid;
        }

        .signatures-grid {
            display: grid;
            grid-template-columns: 1fr 130px 1fr;
            align-items: center;
            gap: 1.25rem;
        }

        .signature-card {
            border: 1.5px dashed #94A3B8;
            border-radius: 8px;
            padding: 1.15rem;
            text-align: center;
            background: #F8FAFC;
            position: relative;
        }

        .signature-card .seal-space {
            height: 65px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #94A3B8;
            font-size: 0.76rem;
            font-style: italic;
        }

        .signature-card .sign-line {
            border-top: 1.5px solid #0F172A;
            padding-top: 0.45rem;
            font-size: 0.88rem;
            font-weight: 800;
            color: #0F172A;
        }

        .signature-card .agency-sign-meta {
            font-size: 0.76rem;
            color: #64748B;
            margin-top: 0.15rem;
            font-weight: 600;
        }

        /* Center Verification Seal */
        .center-seal-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .official-seal-stamp {
            width: 95px;
            height: 95px;
            border-radius: 50%;
            border: 2px dashed #059669;
            background: #ECFDF5;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 0.45rem;
            color: #047857;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15);
            transform: rotate(-5deg);
        }

        .official-seal-stamp i {
            font-size: 1.35rem;
            margin-bottom: 0.15rem;
            color: #059669;
        }

        .official-seal-stamp span {
            font-size: 0.58rem;
            font-weight: 900;
            text-transform: uppercase;
            line-height: 1.1;
            letter-spacing: 0.25px;
        }

        /* Footer Note */
        .contract-footer {
            margin-top: 1.75rem;
            text-align: center;
            border-top: 1px solid #E2E8F0;
            padding-top: 0.85rem;
            font-size: 0.74rem;
            color: #94A3B8;
        }

        /* Print Media Styles */
        @media print {
            body {
                background: #FFFFFF !important;
                padding: 0 !important;
                color: #000000 !important;
            }

            .top-action-bar,
            .no-print {
                display: none !important;
            }

            .contract-wrapper {
                max-width: 100% !important;
                margin: 0 !important;
                border: 2px solid #000000 !important;
                box-shadow: none !important;
                padding: 1.5rem !important;
                border-radius: 0 !important;
            }

            .contract-inner-border {
                border-color: #999999 !important;
            }

            .financial-table th {
                background: #111827 !important;
                color: #FFFFFF !important;
                -webkit-print-color-adjust: exact !important;
            }

            .clause-number {
                background: #111827 !important;
                color: #FFFFFF !important;
                -webkit-print-color-adjust: exact !important;
            }

            .clause-item {
                border-color: #CBD5E1 !important;
                page-break-inside: avoid !important;
            }

            .signatures-wrapper {
                page-break-inside: avoid !important;
            }
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem 0.5rem;
            }

            .contract-wrapper {
                padding: 1.25rem 0.85rem;
            }

            .header-bar {
                flex-direction: column;
                gap: 1rem;
            }

            .header-meta {
                text-align: left;
            }

            .party-grid {
                grid-template-columns: 1fr;
            }

            .specs-grid {
                grid-template-columns: 1fr 1fr;
            }

            .signatures-grid {
                grid-template-columns: 1fr;
                gap: 1.25rem;
            }

            .center-seal-wrapper {
                order: -1;
            }

            .audit-box {
                flex-direction: column;
                align-items: flex-start;
            }

            .qr-seal-box {
                border-left: none;
                border-top: 2px dashed #CBD5E1;
                padding-left: 0;
                padding-top: 0.85rem;
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <!-- Top Action Bar (Hidden on Print) -->
    <div class="top-action-bar no-print">
        <a href="{{ route('dashboard.index') }}" class="back-link">
            <i class="fa-solid fa-arrow-left"></i>
            <span>{{ $lang == 'bn' ? 'মাই ড্যাশবোর্ডে ফিরুন' : 'Back to Agency Dashboard' }}</span>
        </a>

        <div style="display: flex; gap: 0.75rem; align-items: center;">
            <span style="font-size: 0.85rem; color: #475569; font-weight: 600;">
                <i class="fa-solid fa-file-contract text-emerald-700 me-1"></i>
                {{ $lang == 'bn' ? 'অফিশিয়াল চুক্তিপত্র' : 'Official Agreement' }}
            </span>
            <button onclick="window.print()" class="btn-print">
                <i class="fa-solid fa-print"></i>
                <span>{{ $lang == 'bn' ? 'চুক্তিপত্র প্রিন্ট / PDF সংরক্ষণ করুন' : 'Print Agreement (PDF)' }}</span>
            </button>
        </div>
    </div>

    <!-- Main Legal Contract Document -->
    <div class="contract-wrapper">
        <div class="contract-inner-border"></div>
        <div class="watermark">B2B HAJJ UMRAH</div>

        <div class="contract-content">
            
            <!-- Top Govt & Association Accreditation Bar -->
            <div class="gov-banner">
                <div class="gov-banner-left">
                    <span class="gov-banner-badge"><i class="fa-solid fa-landmark me-1"></i> HAAB & MORA B2B</span>
                    <span>গণপ্রজাতন্ত্রী বাংলাদেশ সরকার অনুমোদিত হজ ও ওমরাহ এজেন্সি দ্বিপাক্ষিক সমঝোতা স্মারক</span>
                </div>
                <div style="font-size: 0.76rem; font-weight: 700; color: var(--primary);">
                    <i class="fa-solid fa-shield-halved me-1"></i> আইসিটি আইন ২০০৬ ও চুক্তি আইন ১৮৭২ আওতাভুক্ত
                </div>
            </div>

            <!-- Header Branding & Reference -->
            <div class="header-bar">
                <div class="brand-box">
                    <div class="brand-logo-emblem">
                        <i class="fa-solid fa-kaaba"></i>
                    </div>
                    <div class="brand-text">
                        <h1>B2B HAJJ UMRAH NETWORK</h1>
                        <p>BANGLADESH LICENSED AGENCY DEALS & CONTRACTING PLATFORM</p>
                    </div>
                </div>

                <div class="header-meta">
                    <div class="status-badge-verified">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>VERIFIED & LEGALLY EXECUTED</span>
                    </div>
                    <div class="ref-code">REF: {{ $contractRef }}</div>
                    <div class="date-text">
                        <i class="fa-regular fa-calendar-check me-1"></i> চুক্তি সম্পাদনের তারিখ: {{ $dealDate }}
                    </div>
                </div>
            </div>

            <!-- Document Title -->
            <div class="contract-title-box">
                <h2>দ্বিপাক্ষিক হজ ও ওমরাহ গ্রুপ সিট বরাদ্দ চুক্তিপত্র</h2>
                <div class="sub-title">OFFICIAL BILATERAL B2B ALLOCATION & SERVICE LEVEL AGREEMENT</div>
            </div>

            <!-- Legal Preamble -->
            <div class="contract-preamble">
                <strong>চুক্তির ভূমিকা ও প্রস্তাবনা:</strong> অত্র চুক্তিপত্রটি বাংলাদেশ সরকারের ধর্ম বিষয়ক মন্ত্রণালয় ও হাব (HAAB)-এর লাইসেন্সপ্রাপ্ত নিম্নবর্ণিত <strong>১ম পক্ষ (সরবরাহকারী/বিক্রেতা এজেন্সি)</strong> এবং <strong>২য় পক্ষ (বরাদ্দ গ্রহীতা/ক্রেতা এজেন্সি)</strong>-এর মধ্যে উভয় পক্ষের স্বেচ্ছায় ও পারস্পরিক সম্মতিক্রমে সম্পাদিত হলো। এই চুক্তির অধীনে ১ম পক্ষ কর্তৃক প্রতিশ্রুত ফ্লাইট, গ্রুপ সিট ও ওমরাহ/হজ সেবা ২য় পক্ষ নির্ধারিত মূল্য ও শর্তসাপেক্ষে গ্রহণ করতে সম্মত হয়েছেন।
            </div>

            <!-- Parties Grid -->
            <div class="section-heading">
                <i class="fa-solid fa-handshake-angle text-emerald-700"></i>
                <span>চুক্তিভুক্ত উভয় পক্ষের পরিচিতি ও বিবরণ (Parties to the Agreement)</span>
            </div>

            <div class="party-grid">
                <!-- First Party (Seller) -->
                <div class="party-card seller-card">
                    <div class="party-badge seller-badge">
                        <i class="fa-solid fa-building-circle-check"></i>
                        <span>১ম পক্ষ: সরবরাহকারী এজেন্সি (SELLER / ALLOCATOR)</span>
                    </div>
                    <div class="agency-name-title">{{ $seller->agency_name }}</div>

                    <ul class="party-info-list">
                        <li>
                            <span class="label">হাব লাইসেন্স নং (HAAB No):</span>
                            <span class="val">{{ $seller->haab_no ?? ($seller->license_no ?? 'N/A') }}</span>
                        </li>
                        <li>
                            <span class="label">সরকারি লাইসেন্স নং (Govt Lic):</span>
                            <span class="val">{{ $seller->license_no ?? 'N/A' }}</span>
                        </li>
                        <li>
                            <span class="label">ব্যবস্থাপনা পরিচালক / স্বত্বাধিকারী:</span>
                            <span class="val">{{ $seller->owner_name ?? 'N/A' }}</span>
                        </li>
                        <li>
                            <span class="label">যোগাযোগ / মোবাইল:</span>
                            <span class="val">{{ $seller->phone ?? 'N/A' }}</span>
                        </li>
                        <li>
                            <span class="label">ইমেইল ঠিকানা:</span>
                            <span class="val">{{ $seller->email ?? 'N/A' }}</span>
                        </li>
                        <li>
                            <span class="label">অফিসের ঠিকানা:</span>
                            <span class="val">{{ $seller->address ?? ($seller->city ?? 'Dhaka, Bangladesh') }}</span>
                        </li>
                    </ul>
                </div>

                <!-- Second Party (Buyer) -->
                <div class="party-card buyer-card">
                    <div class="party-badge buyer-badge">
                        <i class="fa-solid fa-handshake"></i>
                        <span>২য় পক্ষ: বরাদ্দ গ্রহীতা এজেন্সি (BUYER / RECIPIENT)</span>
                    </div>
                    <div class="agency-name-title">{{ $buyer->agency_name }}</div>

                    <ul class="party-info-list">
                        <li>
                            <span class="label">হাব লাইসেন্স নং (HAAB No):</span>
                            <span class="val">{{ $buyer->haab_no ?? ($buyer->license_no ?? 'N/A') }}</span>
                        </li>
                        <li>
                            <span class="label">সরকারি লাইসেন্স নং (Govt Lic):</span>
                            <span class="val">{{ $buyer->license_no ?? 'N/A' }}</span>
                        </li>
                        <li>
                            <span class="label">ব্যবস্থাপনা পরিচালক / স্বত্বাধিকারী:</span>
                            <span class="val">{{ $buyer->owner_name ?? 'N/A' }}</span>
                        </li>
                        <li>
                            <span class="label">যোগাযোগ / মোবাইল:</span>
                            <span class="val">{{ $buyer->phone ?? 'N/A' }}</span>
                        </li>
                        <li>
                            <span class="label">ইমেইল ঠিকানা:</span>
                            <span class="val">{{ $buyer->email ?? 'N/A' }}</span>
                        </li>
                        <li>
                            <span class="label">অফিসের ঠিকানা:</span>
                            <span class="val">{{ $buyer->address ?? ($buyer->city ?? 'Dhaka, Bangladesh') }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Package & Flight Deal Specifications -->
            <div class="section-heading">
                <i class="fa-solid fa-plane-circle-check text-amber-600"></i>
                <span>বরাদ্দকৃত প্যাকেজ ও ফ্লাইটের প্রযুক্তিগত তফসিল (Flight & Package Specifications)</span>
            </div>

            <div class="specs-grid">
                <div class="spec-item">
                    <span class="label">প্যাকেজের ধরন ও ক্যাটাগরি</span>
                    <span class="val">{{ strtoupper($post->hajj_or_umrah ?? 'UMRAH') }} PACKAGE</span>
                    <span class="sub-val"><i class="fa-solid fa-tag me-1"></i>{{ ucwords(str_replace('_', ' ', $post->post_category ?? 'Group Flight')) }}</span>
                </div>

                <div class="spec-item">
                    <span class="label">নির্ধারিত এয়ারলাইন্স ও পিএনআর</span>
                    <span class="val">{{ $post->airline ?? 'Biman / Saudia' }}</span>
                    <span class="sub-val" style="color: #0284C7; font-weight: 700;"><i class="fa-solid fa-barcode me-1"></i>PNR: {{ $post->pnr_code ?? 'GROUP ALLOCATION' }}</span>
                </div>

                <div class="spec-item">
                    <span class="label">ফ্লাইট তারিখ ও ডিপার্চার হাব</span>
                    <span class="val">{{ optional($post->flight_date)->format('d M, Y') ?? 'Confirmed Schedule' }}</span>
                    <span class="sub-val"><i class="fa-solid fa-location-dot me-1"></i>{{ $post->departure_city ?? 'Dhaka (DAC)' }} ({{ strtoupper($post->flight_transit ?? 'Direct') }})</span>
                </div>

                <div class="spec-item">
                    <span class="label">ভ্রমণ স্থায়িত্বকাল ও রিটার্ন</span>
                    <span class="val">{{ $post->duration_days ? $post->duration_days . ' Days' : '14 Days Standard' }}</span>
                    <span class="sub-val"><i class="fa-regular fa-calendar me-1"></i>{{ optional($post->return_date)->format('d M, Y') ?? 'Scheduled Return' }}</span>
                </div>

                <div class="spec-item">
                    <span class="label">মক্কার আবাসন (Makkah Hotel)</span>
                    <span class="val">{{ $post->makkah_hotel ?? 'Standard Hotel' }}</span>
                    <span class="sub-val"><i class="fa-solid fa-person-walking me-1"></i>দূরত্ব: {{ $post->makkah_hotel_distance ? $post->makkah_hotel_distance . ' মিটার' : 'কাছাকাছি দূরত্ব' }}</span>
                </div>

                <div class="spec-item">
                    <span class="label">মদিনার আবাসন (Madinah Hotel)</span>
                    <span class="val">{{ $post->madinah_hotel ?? 'Standard Hotel' }}</span>
                    <span class="sub-val"><i class="fa-solid fa-person-walking me-1"></i>দূরত্ব: {{ $post->madinah_hotel_distance ? $post->madinah_hotel_distance . ' মিটার' : 'কাছাকাছি দূরত্ব' }}</span>
                </div>

                <div class="spec-item">
                    <span class="label">রুম শেয়ারিং ও মিলস</span>
                    <span class="val">{{ strtoupper($post->room_type ?? 'Quad / 4 Sharing') }}</span>
                    <span class="sub-val"><i class="fa-solid fa-utensils me-1"></i>{{ $post->meals_included ? 'খাবার অন্তর্ভুক্ত' : 'খাবার নিজস্ব ব্যবস্থাপনায়' }}</span>
                </div>

                <div class="spec-item">
                    <span class="label">ভিসা, ট্রান্সপোর্ট ও সার্ভিসেস</span>
                    <span class="val">{{ $post->visa_included ? 'ভিসা অন্তর্ভুক্ত' : 'অনলি এয়ার টিকিট' }}</span>
                    <span class="sub-val"><i class="fa-solid fa-bus me-1"></i>{{ $post->transport_included ? 'সৌদি ইন্টারসিটি পরিবহন সহ' : 'পরিবহন আলোচনা সাপেক্ষ' }}</span>
                </div>
            </div>

            <!-- Financial Settlement Schedule -->
            <div class="section-heading">
                <i class="fa-solid fa-calculator text-emerald-600"></i>
                <span>আর্থিক লেনদেন ও মূল্য নিষ্পত্তির তফসিল (Financial Settlement Schedule)</span>
            </div>

            <table class="financial-table">
                <thead>
                    <tr>
                        <th style="width: 22%;">বরাদ্দকৃত সিট সংখ্যা (Pax)</th>
                        <th style="width: 20%;">প্রতি সিট মূল্য (BDT)</th>
                        <th style="width: 20%;">সর্বমোট চুক্তি মূল্য</th>
                        <th style="width: 20%;">জমা অগ্রিম টোকেন (Deposit)</th>
                        <th style="width: 18%;">বকেয়া পরিশোধযোগ্য অবশিষ্ট</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <span class="highlight-seat"><i class="fa-solid fa-users me-1"></i>{{ $inquiry->requested_seats }} সিট</span>
                            <div style="font-size: 0.76rem; color: #64748B;">Confirmed Group Block</div>
                        </td>
                        <td>
                            <span style="font-weight: 800; font-size: 1.05rem;">৳{{ number_format($rate) }}</span>
                            <div style="font-size: 0.76rem; color: #64748B;">প্রতি যাত্রী নেট B2B রেট</div>
                        </td>
                        <td>
                            <span class="highlight-total">৳{{ number_format($totalVal) }}</span>
                            <div style="font-size: 0.76rem; color: #64748B;">সর্বমোট প্রদেয় চুক্তিমূল্য</div>
                        </td>
                        <td>
                            <span class="highlight-advance"><i class="fa-solid fa-circle-check me-1"></i>৳{{ number_format($advance) }}</span>
                            <div style="font-size: 0.76rem; color: #047857; font-weight: 700;">পরিশোধিত ও কনফার্মড</div>
                        </td>
                        <td>
                            <span class="highlight-due">৳{{ number_format($due) }}</span>
                            <div style="font-size: 0.76rem; color: #B45309; font-weight: 700;">ফ্লাইটের পূর্বে প্রদেয়</div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Special Negotiated Terms (If Any) -->
            @if($inquiry->seller_note || $inquiry->message)
                <div class="custom-notes-box">
                    <h5><i class="fa-solid fa-comments me-1"></i> উভয় পক্ষের বিশেষ সমঝোতামূলক নোট ও বিশেষ শর্ত (Negotiated Custom Notes):</h5>
                    @if($inquiry->message)
                        <div style="margin-bottom: 0.4rem; color: #1E293B;">
                            <strong><i class="fa-solid fa-pen-nib me-1 text-sky-600"></i> ক্রেতা এজেন্সির বিশেষ নোট:</strong> {{ $inquiry->message }}
                        </div>
                    @endif
                    @if($inquiry->seller_note)
                        <div style="color: #1E293B;">
                            <strong><i class="fa-solid fa-check-double me-1 text-emerald-600"></i> বিক্রেতা এজেন্সির অনুমোদন নোট:</strong> {{ $inquiry->seller_note }}
                        </div>
                    @endif
                </div>
            @endif

            <!-- Comprehensive 10-Clause Terms & Conditions -->
            <div class="terms-container">
                <div class="terms-header">
                    <h3>
                        <i class="fa-solid fa-scale-balanced text-amber-600"></i>
                        <span>দ্বিপাক্ষিক চুক্তির বিস্তারিত আইনগত নিয়মাবলী ও শর্তাবলী (Terms & Legal Clauses)</span>
                    </h3>
                    <span class="law-note"><i class="fa-solid fa-gavel me-1"></i> B2B STANDARD HAAB BY-LAWS</span>
                </div>

                <div class="terms-grid">
                    <!-- Clause 1 -->
                    <div class="clause-item">
                        <div class="clause-number">১</div>
                        <div class="clause-body">
                            <div class="clause-title">আসন বরাদ্দ ও অগ্রিম বুকিং নিশ্চিতকরণ (Seat Allocation & Confirmation)</div>
                            <div class="clause-desc">
                                এই চুক্তিপত্রে উভয় পক্ষের সম্মতি ও নির্ধারিত অগ্রিম বুকিং আমানত (৳{{ number_format($advance) }}) প্রাপ্তির মাধ্যমে ১ম পক্ষ (সেলার) ২য় পক্ষ (বায়ার)-এর জন্য সুনির্দিষ্ট <strong>{{ $inquiry->requested_seats }}টি সিট</strong> সুরক্ষিত ও নিশ্চিত হিসেবে ব্লক করতে বাধ্য থাকবেন। কোনো অবস্থাতেই সেলার এজেন্সি উক্ত সিট অন্য কোনো তৃতীয় পক্ষের নিকট হস্তান্তর বা পুনঃবরাদ্দ করতে পারবেন না।
                            </div>
                        </div>
                    </div>

                    <!-- Clause 2 -->
                    <div class="clause-item">
                        <div class="clause-number">২</div>
                        <div class="clause-body">
                            <div class="clause-title">যাত্রী তালিকা, পাসপোর্ট ও নেম ডেডলাইন (Passenger Manifest & Passport Deadline)</div>
                            <div class="clause-desc">
                                বায়ার এজেন্সিকে সংশ্লিষ্ট এয়ারলাইন্স ও সেলার এজেন্সির নির্ধারিত 'নেম ডেডলাইন' (Name Deadline) অথবা ফ্লাইটের ন্যূনতম <strong>১৫ (পনের) দিন পূর্বে</strong> সকল যাত্রীর পূর্ণাঙ্গ সঠিক নাম, পাসপোর্ট কপি, বায়োমেট্রিক ও প্রয়োজনীয় ভিসা সংশ্লিষ্ট কাগজপত্র সেলার এজেন্সির নিকট লিখিত বা ইলেকট্রনিক মাধ্যমে জমা দিতে হবে। নির্ধারিত সময়ের মধ্যে তথ্য প্রদানে ব্যর্থ হলে আসন বাতিলের ঝুঁকি সম্পূর্ণ বায়ারের ওপর বর্তাবে।
                            </div>
                        </div>
                    </div>

                    <!-- Clause 3 -->
                    <div class="clause-item">
                        <div class="clause-number">৩</div>
                        <div class="clause-body">
                            <div class="clause-title">বকেয়া অর্থ নিষ্পত্তি ও পরিশোধের সময়সীমা (Financial Settlement & Final Payment)</div>
                            <div class="clause-desc">
                                চুক্তি অনুযায়ী সর্বমোট বকেয়া অর্থ (<strong>৳{{ number_format($due) }}</strong>) বায়ার এজেন্সিকে নির্ধারিত ফ্লাইটের ন্যূনতম <strong>৭ (সাত) কার্যদিবস পূর্বে</strong> সেলার এজেন্সির ব্যাংক অ্যাকাউন্ট, পে-অর্ডার বা অনুমোদিত বৈধ চ্যানেলের মাধ্যমে সম্পূর্ণ পরিশোধ করতে হবে। নির্দিষ্ট ডেডলাইনের মধ্যে বকেয়া পরিশোধে ব্যর্থ হলে সেলার এজেন্সি বুকিং বাতিল ও অগ্রিম বাজেয়াপ্ত করার আইনগত অধিকার সংরক্ষণ করবে।
                            </div>
                        </div>
                    </div>

                    <!-- Clause 4 -->
                    <div class="clause-item">
                        <div class="clause-number">৪</div>
                        <div class="clause-body">
                            <div class="clause-title">টিকিট ইস্যু, নাম পরিবর্তন ও ক্যান্সেলেশন পলিসি (Ticketing & Cancellation Policy)</div>
                            <div class="clause-desc">
                                গ্রুপ টিকিটের ক্ষেত্রে সংশ্লিষ্ট এয়ারলাইন্সের গ্রুপ পিএনআর শর্তাবলী প্রযোজ্য হবে। নাম পরিবর্তন (Name Change)-এর ক্ষেত্রে এয়ারলাইন্সের নিয়মমাফিক স্ট্যান্ডার্ড চার্জ বায়ার এজেন্সি বহন করবে। টিকিট ইস্যু করার পর কোনো সিট আংশিক বা সম্পূর্ণ বাতিল করতে চাইলে এয়ারলাইন্সের পেনাল্টি ও ক্যান্সেলেশন ফি কর্তন সাপেক্ষে অবশিষ্ট অর্থ সমন্বয় করা হবে।
                            </div>
                        </div>
                    </div>

                    <!-- Clause 5 -->
                    <div class="clause-item">
                        <div class="clause-number">৫</div>
                        <div class="clause-body">
                            <div class="clause-title">সৌদি আবাসন, গ্রাউন্ড হ্যান্ডলিং ও নুসুক কমপ্লায়েন্স (Hotels & Ground Services)</div>
                            <div class="clause-desc">
                                চুক্তিতে প্রতিশ্রুত মক্কা ও মদিনার হোটেল, দূরত্ব ও রুম ক্যাটাগরি ১ম পক্ষকে হুবহু বজায় রাখতে হবে। কোনো অনিবার্য কারণে নির্দিষ্ট হোটেল পরিবর্তন করতে হলে একই দূরত্ব ও মানের বা তার চেয়ে উন্নত মানের হোটেল সরবরাহ করতে হবে। সৌদি হজ ও ওমরাহ মন্ত্রণালয়ের 'নুসুক' (Nusuk) এবং অন্যান্য আইনগত বিধিবিধান উভয় পক্ষ যথাযথভাবে অনুসরণ করবে।
                            </div>
                        </div>
                    </div>

                    <!-- Clause 6 -->
                    <div class="clause-item">
                        <div class="clause-number">৬</div>
                        <div class="clause-body">
                            <div class="clause-title">এয়ারলাইন্স ফ্লাইট শিডিউল পরিবর্তন ও নো-শো দায়ভার (Flight Schedule & No-Show)</div>
                            <div class="clause-desc">
                                এয়ারলাইন্স কর্তৃপক্ষ কর্তৃক যান্ত্রিক গোলযোগ, এয়ারস্পেস সীমাবদ্ধতা বা ফ্লাইট সময়সূচি পরিবর্তনের ক্ষেত্রে সংশ্লিষ্ট এয়ারলাইন্সের নিজস্ব নীতিমালা বলবৎ থাকবে। কোনো যাত্রীর ব্যক্তিগত বিলম্ব, ভিসা প্রত্যাখ্যান, ইমিগ্রেশন সমস্যা বা এয়ারপোর্টে সময়মতো উপস্থিত না হওয়ার (No-Show) কারণে ভ্রমণ ব্যাহত হলে তার জন্য ১ম পক্ষ (সেলার) কোনোভাবেই দায়ী থাকবে না।
                            </div>
                        </div>
                    </div>

                    <!-- Clause 7 -->
                    <div class="clause-item">
                        <div class="clause-number">৭</div>
                        <div class="clause-body">
                            <div class="clause-title">অপ্রত্যাশিত পরিস্থিতি ও ফোর্স মেজার (Force Majeure Clause)</div>
                            <div class="clause-desc">
                                মহামারী, যুদ্ধাবস্থা, প্রাকৃতিক দুর্যোগ, সৌদি সরকার বা বাংলাদেশ সরকার কর্তৃক আকস্মিক ভ্রমণ নিষেধাজ্ঞা ইত্যাদি অনাকাঙ্ক্ষিত পরিস্থিতিতে কোনো পক্ষই চুক্তি লঙ্ঘনের দায়ে অভিযুক্ত হবে না। এয়ারলাইন্স ও সৌদি সেবা সরবরাহকারীদের কাছ থেকে প্রাপ্ত রিফান্ড বা সমন্বয় অনুপাতে উভয় পক্ষ পারস্পরিক আলোচনার মাধ্যমে আর্থিক ক্ষতি সমতার ভিত্তিতে লাঘব করবে।
                            </div>
                        </div>
                    </div>

                    <!-- Clause 8 -->
                    <div class="clause-item">
                        <div class="clause-number">৮</div>
                        <div class="clause-body">
                            <div class="clause-title">পেশাগত সততা ও নন-সোলিসিটেশন বিধান (Non-Solicitation & Professional Ethics)</div>
                            <div class="clause-desc">
                                উভয় এজেন্সি একে অপরের সরাসরি সাব-এজেন্ট বা ক্লায়েন্ট যাত্রীদের তথ্য অনৈতিকভাবে ব্যবহার বা নিজেদের বাণিজ্যিক স্বার্থে সরাসরি আকৃষ্ট (Solicit) করতে পারবে না। বি২বি প্ল্যাটফর্মের পবিত্রতা ও ব্যবসায়িক নীতি বজায় রাখতে উভয় পক্ষ অঙ্গীকারাবদ্ধ।
                            </div>
                        </div>
                    </div>

                    <!-- Clause 9 -->
                    <div class="clause-item">
                        <div class="clause-number">৯</div>
                        <div class="clause-body">
                            <div class="clause-title">বিরোধ নিষ্পত্তি ও হাব সালিশি এখতিয়ার (Dispute Resolution & HAAB Arbitration)</div>
                            <div class="clause-desc">
                                এই চুক্তির ব্যাখ্যা, বাস্তবায়ন বা আর্থিক দাবি নিয়ে কোনো বিরোধ দেখা দিলে তা প্রথমে প্ল্যাটফর্মের মধ্যস্থতায় এবং পরবর্তীতে <strong>হজ এজেন্সিস এসোসিয়েশন অব বাংলাদেশ (HAAB)</strong>-এর সালিশি বোর্ড অথবা ধর্ম বিষয়ক মন্ত্রণালয়ের নির্বাহী ফোরামের মাধ্যমে পারস্পরিক সমঝোতায় নিষ্পত্তি হবে।
                            </div>
                        </div>
                    </div>

                    <!-- Clause 10 -->
                    <div class="clause-item">
                        <div class="clause-number">১০</div>
                        <div class="clause-body">
                            <div class="clause-title">ডিজিটাল চুক্তিপত্রের আইনি স্বীকৃতি ও কার্যকরতা (Digital Validity under ICT Act 2006)</div>
                            <div class="clause-desc">
                                বাংলাদেশ তথ্য ও যোগাযোগ প্রযুক্তি আইন (ICT Act 2006) এবং চুক্তি আইন (Contract Act 1872)-এর অধীনে প্ল্যাটফর্মে অনুমোদিত এই ইলেকট্রনিক চুক্তিপত্র ও ওটিপি/ডিজিটাল কনফার্মেশন সম্পূর্ণ বৈধ, কার্যকর ও উভয় পক্ষের ওপর আইনত বাধ্যতামূলক দলিল হিসেবে গণ্য হবে।
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Audit Trail & Security Verification Box -->
            <div class="audit-box">
                <div class="audit-text">
                    <strong style="color: var(--primary-dark); font-size: 0.85rem; display: block; margin-bottom: 0.25rem;">
                        <i class="fa-solid fa-fingerprint me-1 text-emerald-700"></i> ডিজিটাল ঘোষণাপত্র ও সিস্টেম অডিট ট্রেইল (System Audit Declaration):
                    </strong>
                    উভয় পক্ষ অঙ্গীকার করছে যে চুক্তিপত্রে প্রদত্ত সমস্ত লাইসেন্স তথ্য, আসন বরাদ্দ ও আর্থিক হিসাব সম্পূর্ণ নির্ভুল। বি২বি হজ ও ওমরাহ নেটওয়ার্ক প্ল্যাটফর্মটি উভয় এজেন্সির মধ্যে সংযোগ স্থাপনকারী নিরাপদ ডিজিটাল মাধ্যম হিসেবে কাজ করে।
                </div>

                <div class="qr-seal-box">
                    <div class="qr-placeholder">
                        <svg viewBox="0 0 100 100" fill="#044E35" xmlns="http://www.w3.org/2000/svg">
                            <rect x="5" y="5" width="28" height="28" fill="#044E35" rx="3"/>
                            <rect x="9" y="9" width="20" height="20" fill="#FFFFFF" rx="2"/>
                            <rect x="13" y="13" width="12" height="12" fill="#044E35"/>
                            <rect x="67" y="5" width="28" height="28" fill="#044E35" rx="3"/>
                            <rect x="71" y="9" width="20" height="20" fill="#FFFFFF" rx="2"/>
                            <rect x="75" y="13" width="12" height="12" fill="#044E35"/>
                            <rect x="5" y="67" width="28" height="28" fill="#044E35" rx="3"/>
                            <rect x="9" y="71" width="20" height="20" fill="#FFFFFF" rx="2"/>
                            <rect x="13" y="75" width="12" height="12" fill="#044E35"/>
                            <rect x="42" y="8" width="16" height="6"/>
                            <rect x="48" y="20" width="10" height="10"/>
                            <rect x="8" y="44" width="8" height="12"/>
                            <rect x="22" y="42" width="16" height="8"/>
                            <rect x="42" y="42" width="16" height="16" fill="#C59A27"/>
                            <rect x="68" y="44" width="8" height="14"/>
                            <rect x="82" y="42" width="10" height="10"/>
                            <rect x="42" y="68" width="10" height="12"/>
                            <rect x="58" y="74" width="14" height="6"/>
                            <rect x="80" y="68" width="12" height="24"/>
                            <rect x="44" y="86" width="26" height="6"/>
                        </svg>
                    </div>
                    <div class="qr-details">
                        <strong>DIGITAL QR SECURITY</strong>
                        <span>Ref: {{ substr($contractRef, 0, 18) }}</span><br>
                        <span>Verified B2B Agreement</span><br>
                        <span style="color: #059669; font-weight: 700;"><i class="fa-solid fa-check-circle"></i> Authenticated Deal</span>
                    </div>
                </div>
            </div>

            <!-- Signatures Section with Center Official Seal -->
            <div class="signatures-wrapper">
                <div class="signatures-grid">
                    
                    <!-- First Party Signature -->
                    <div class="signature-card">
                        <div class="seal-space">
                            <span>[ ১ম পক্ষ এজেন্সির অফিসিয়াল সিল ও স্বাক্ষর ]</span>
                        </div>
                        <div class="sign-line">
                            {{ $seller->owner_name ?? 'স্বত্বাধিকারী / ব্যবস্থাপনা পরিচালক' }}
                        </div>
                        <div class="agency-sign-meta">
                            <strong>{{ $seller->agency_name }}</strong><br>
                            <span>১ম পক্ষ (সরবরাহকারী এজেন্সি)</span>
                        </div>
                    </div>

                    <!-- Center Platform Verification Seal -->
                    <div class="center-seal-wrapper">
                        <div class="official-seal-stamp">
                            <i class="fa-solid fa-award"></i>
                            <span>B2B HAJJ UMRAH</span>
                            <span style="font-size: 0.58rem; color: #023624;">CERTIFIED DEAL</span>
                            <span style="font-size: 0.52rem; letter-spacing: 0;">2026 VERIFIED</span>
                        </div>
                    </div>

                    <!-- Second Party Signature -->
                    <div class="signature-card">
                        <div class="seal-space">
                            <span>[ ২য় পক্ষ এজেন্সির অফিসিয়াল সিল ও স্বাক্ষর ]</span>
                        </div>
                        <div class="sign-line">
                            {{ $buyer->owner_name ?? 'স্বত্বাধিকারী / ব্যবস্থাপনা পরিচালক' }}
                        </div>
                        <div class="agency-sign-meta">
                            <strong>{{ $buyer->agency_name }}</strong><br>
                            <span>২য় পক্ষ (বরাদ্দ গ্রহীতা এজেন্সি)</span>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Bottom Legal Footnote -->
            <div class="contract-footer">
                <div>© {{ date('Y') }} B2B Hajj Umrah Network Bangladesh. All Rights Reserved. HAAB & Govt Ministry Recognized Agency Platform.</div>
                <div style="font-size: 0.7rem; margin-top: 0.2rem;">Generated electronically via authenticated B2B session on {{ date('d M, Y - h:i A') }}. Page 1 of 1.</div>
            </div>

        </div>
    </div>

</body>
</html>