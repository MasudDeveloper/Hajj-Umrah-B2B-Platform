<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B2B Official Quotation Letter #QUOTE-{{ $inquiry->id }} - {{ $inquiry->post->agency->agency_name }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Inter:wght@400;500;600;700&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --primary: #044E35;
            --accent: #D4AF37;
            --text-dark: #1E293B;
            --border-color: #CBD5E1;
        }

        body {
            font-family: 'Hind Siliguri', 'Inter', sans-serif;
            background: #F1F5F9;
            color: var(--text-dark);
            margin: 0;
            padding: 2rem 1rem;
        }

        .quotation-container {
            max-width: 850px;
            margin: 0 auto;
            background: #FFFFFF;
            padding: 3rem;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 2px solid var(--primary);
            position: relative;
        }

        .header-letterhead {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 3px double var(--primary);
            padding-bottom: 1.5rem;
            margin-bottom: 2rem;
        }

        .seller-brand h1 {
            font-family: 'Outfit', sans-serif;
            font-size: 1.8rem;
            color: var(--primary);
            margin: 0 0 0.25rem 0;
        }

        .seller-details {
            font-size: 0.88rem;
            color: #475569;
            line-height: 1.5;
        }

        .quote-badge {
            background: #F8FAFC;
            border: 1px solid var(--border-color);
            padding: 1rem 1.25rem;
            border-radius: 8px;
            text-align: right;
        }

        .quote-title {
            text-align: center;
            margin: 1.5rem 0 2rem 0;
        }

        .quote-title h2 {
            font-size: 1.5rem;
            color: var(--primary);
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
            background: #ECFDF5;
            display: inline-block;
            padding: 0.4rem 1.5rem;
            border-radius: 20px;
            border: 1px solid #A7F3D0;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
            background: #F8FAFC;
            padding: 1.25rem;
            border-radius: 8px;
            border: 1px solid #E2E8F0;
        }

        .info-box h4 {
            font-size: 0.85rem;
            color: #64748B;
            text-transform: uppercase;
            margin: 0 0 0.5rem 0;
        }

        .info-box strong {
            font-size: 1.05rem;
            color: var(--primary);
            display: block;
        }

        .quote-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
        }

        .quote-table th {
            background: var(--primary);
            color: #FFFFFF;
            padding: 0.75rem 1rem;
            text-align: left;
            font-size: 0.9rem;
        }

        .quote-table td {
            padding: 0.85rem 1rem;
            border-bottom: 1px solid var(--border-color);
            font-size: 0.92rem;
        }

        .quote-summary-box {
            background: #FFFDF5;
            border: 2px dashed var(--accent);
            padding: 1.25rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .signature-area {
            display: flex;
            justify-content: space-between;
            margin-top: 4rem;
            padding-top: 1rem;
        }

        .signature-box {
            text-align: center;
            width: 220px;
            border-top: 1.5px dashed #94A3B8;
            padding-top: 0.5rem;
            font-size: 0.88rem;
            color: #475569;
        }

        .no-print {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: white;
                padding: 0;
            }

            .quotation-container {
                box-shadow: none;
                border: none;
                padding: 0;
            }
        }
    </style>
</head>

<body>

    <!-- No Print Action Bar -->
    <div class="no-print">
        <button onclick="window.print()" style="background: var(--primary); color: white; border: none; padding: 0.75rem 1.75rem; border-radius: 30px; font-weight: 700; font-size: 1rem; cursor: pointer; box-shadow: 0 4px 12px rgba(4,78,53,0.3); display: inline-flex; align-items: center; gap: 0.5rem;">
            <i class="fa-solid fa-print"></i> অফিসিয়াল কোটেশন লেটার প্রিন্ট / PDF ডাউনলোড
        </button>
        <a href="{{ route('dashboard.index') }}" style="margin-left: 1rem; color: #475569; text-decoration: none; font-weight: 600; font-size: 0.9rem;">
            <i class="fa-solid fa-arrow-left"></i> ড্যাশবোর্ডে ফিরে যান
        </a>
    </div>

    <div class="quotation-container">

        <!-- Top Header Letterhead -->
        <div class="header-letterhead">
            <div class="seller-brand">
                <h1>{{ $inquiry->post->agency->agency_name }}</h1>
                <div class="seller-details">
                    <div><i class="fa-solid fa-certificate text-amber-500"></i> HAAB/গভঃ লাইসেন্স নম্বর: <strong>{{ $inquiry->post->agency->license_no }}</strong></div>
                    <div><i class="fa-solid fa-id-card text-emerald-600"></i> HAAB মেম্বারশিপ নম্বর: <strong>{{ $inquiry->post->agency->haab_no ?? 'N/A' }}</strong></div>
                    <div><i class="fa-solid fa-location-dot text-red-500"></i> ঠিকানা: {{ $inquiry->post->agency->address }}</div>
                    <div><i class="fa-solid fa-phone text-blue-600"></i> ফোন: {{ $inquiry->post->agency->phone }}</div>
                </div>
            </div>

            <div class="quote-badge">
                <div style="font-size: 0.78rem; color: #64748B; font-weight: 700; text-transform: uppercase;">QUOTATION REF NO</div>
                <div style="font-size: 1.15rem; font-weight: 800; color: var(--primary);">#QUOTE-{{ str_pad($inquiry->id, 6, '0', STR_PAD_LEFT) }}</div>
                <div style="font-size: 0.8rem; color: #475569; margin-top: 0.25rem;">তারিখ: {{ $inquiry->updated_at->format('d M, Y') }}</div>
            </div>
        </div>

        <!-- Title -->
        <div class="quote-title">
            <h2>B2B রিকোয়ারমেন্ট অফিশিয়াল কোটেশন পত্র</h2>
        </div>

        <!-- Agency Info Grid -->
        <div class="info-grid">
            <div class="info-box">
                <h4>প্রাপক (বায়ার এজেন্সি):</h4>
                <strong>{{ $inquiry->inquiringAgency->agency_name }}</strong>
                <div style="font-size: 0.85rem; color: #475569; margin-top: 0.25rem;">
                    লাইসেন্স নং: {{ $inquiry->inquiringAgency->license_no }}<br>
                    মোবাইল: {{ $inquiry->inquiringAgency->phone }}<br>
                    ঠিকানা: {{ $inquiry->inquiringAgency->address }}
                </div>
            </div>

            <div class="info-box">
                <h4>প্যাকেজ ও ফ্লাইট বিবরণ:</h4>
                <strong>{{ $inquiry->post->title }}</strong>
                <div style="font-size: 0.85rem; color: #475569; margin-top: 0.25rem;">
                    ক্যাটাগরি: {{ strtoupper(str_replace('_', ' ', $inquiry->post->post_category)) }}<br>
                    ফ্লাইট তারিখ: {{ $inquiry->post->flight_date->format('d M, Y') }} ({{ $inquiry->post->airline }})<br>
                    PNR রেফারেন্স: {{ $inquiry->post->pnr_code ?? 'Group Block' }}
                </div>
            </div>
        </div>

        <!-- Particulars Quotation Table -->
        <table class="quote-table">
            <thead>
                <tr>
                    <th>বিবরণ (Particulars)</th>
                    <th style="text-align: center;">সিট সংখ্যা (Pax)</th>
                    <th style="text-align: right;">একক দর (Rate/Seat)</th>
                    <th style="text-align: right;">মোট মূল্য (Total BDT)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong>{{ $inquiry->post->title }}</strong><br>
                        <span style="font-size: 0.82rem; color: #64748B;">
                            রুট: {{ $inquiry->post->departure_city }} ➔ {{ $inquiry->post->route_sequence == 'madinah_first' ? 'Madinah (MED)' : 'Jeddah (JED)' }} | ফ্লাইট: {{ $inquiry->post->airline }}
                        </span>
                    </td>
                    <td style="text-align: center; font-weight: 700;">{{ $inquiry->requested_seats }} Pax</td>
                    <td style="text-align: right;">৳{{ number_format($inquiry->offered_price_per_seat ?: $inquiry->post->price_per_seat) }}</td>
                    <td style="text-align: right; font-weight: 700;">
                        ৳{{ number_format($inquiry->requested_seats * ($inquiry->offered_price_per_seat ?: $inquiry->post->price_per_seat)) }}
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Quotation Summary Financial Box -->
        <div class="quote-summary-box">
            <div>
                <span style="font-size: 0.8rem; color: #78350F; font-weight: 700; text-transform: uppercase; display: block;">REQUIRED ADVANCE TOKEN DEPOSIT</span>
                <strong style="font-size: 1.5rem; color: #B45309;">৳{{ number_format($inquiry->advance_amount_agreed ?: ($inquiry->post->advance_deposit * $inquiry->requested_seats)) }}</strong>
                <div style="font-size: 0.78rem; color: #92400E;">ডিল চূড়ান্ত করতে এই পরিমাণ অগ্রিম বুকিং আমানত প্রদান করতে হবে।</div>
            </div>

            <div style="text-align: right;">
                <span style="font-size: 0.8rem; color: #475569; font-weight: 700; text-transform: uppercase; display: block;">SERVICING AGENT REMARKS / TERMS</span>
                <p style="margin: 0; font-size: 0.88rem; color: var(--text-dark); font-weight: 600;">
                    "{{ $inquiry->seller_note ?? 'সকল শর্তাবলী বিটুবি পলিসি অনুযায়ী প্রযোজ্য।' }}"
                </p>
            </div>
        </div>

        <!-- Terms and Instructions -->
        <div style="background: #F8FAFC; padding: 1rem; border-radius: 8px; font-size: 0.82rem; color: #475569; margin-bottom: 2rem;">
            <strong>শর্তাবলী ও নির্দেশনা:</strong>
            <ol style="margin: 0.35rem 0 0 1.25rem; padding: 0;">
                <li>উক্ত কোটেশন অনুযায়ী বুকিং কনফার্ম করতে নিধার্রিত অগ্রিম অর্থ প্রদানপূর্বক দুই পক্ষকেই ড্যাশবোর্ডে "Deal Done" বাটনে চাপ দিয়ে চুক্তিপত্র সম্পাদন করতে হবে।</li>
                <li>পাসপোর্ট কপি এবং প্রয়োজনীয় ভ্রমণ নথি নির্ধারিত সময়ের মধ্যে হস্তান্তর করতে হবে।</li>
                <li>উভয় এজেন্সিই বাংলাদেশ সরকারের ধর্মীয় বিষয়ক মন্ত্রণালয় এবং HAAB-এর নির্ধারিত নীতিমালা মেনে চলতে বাধ্য থাকবে।</li>
            </ol>
        </div>

        <!-- Signature Lines -->
        <div class="signature-area">
            <div class="signature-box">
                <br><br>
                <strong>প্রস্তাবক এজেন্সি</strong><br>
                {{ $inquiry->inquiringAgency->agency_name }}
            </div>

            <div class="signature-box">
                <br><br>
                <strong>অনুমোদনকারী (সেলার এজেন্সি)</strong><br>
                {{ $inquiry->post->agency->agency_name }}
            </div>
        </div>

        <div style="text-align: center; margin-top: 3rem; font-size: 0.75rem; color: #94A3B8; border-top: 1px solid #E2E8F0; padding-top: 0.75rem;">
            এটি B2B Hajj Umrah Platform-এর মাধ্যমে স্বয়ংক্রিয়ভাবে তৈরি অফিশিয়াল B2B কোটেশন পত্র। &bull; জেনারেটেড সময়: {{ date('d M Y, h:i A') }}
        </div>
    </div>

</body>

</html>
