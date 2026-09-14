<!DOCTYPE html>
<html lang="{{ session('locale', 'bn') }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'হজ ও ওমরাহ B2B শেয়ারিং প্ল্যাটফর্ম - বাংলাদেশ')</title>

    <!-- Fonts: Outfit, Inter & Noto Serif Bengali / Hind Siliguri -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @php
    $lang = session('locale', 'bn'); // Default Bengali language
    @endphp

    <style>
        :root {
            --primary: #044E35;
            /* Deep Emerald Green */
            --primary-light: #0B6E4F;
            --primary-dark: #023624;
            --accent: #D4AF37;
            /* Metallic Gold */
            --accent-light: #F3E5AB;
            --bg-light: #F4F7F5;
            --surface: #FFFFFF;
            --text-dark: #1E293B;
            --text-muted: #64748B;
            --border-color: #E2E8F0;
            --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.04);
            --shadow-md: 0 10px 25px -5px rgba(4, 78, 53, 0.08);
            --shadow-lg: 0 20px 35px -10px rgba(4, 78, 53, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Hind Siliguri', 'Inter', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .font-heading {
            font-family: 'Outfit', 'Hind Siliguri', sans-serif;
        }

        /* Role Switcher Test Bar */
        .test-switcher-bar {
            background-color: #1E293B;
            color: white;
            font-size: 0.8rem;
            padding: 0.4rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--accent);
        }

        .test-switcher-bar a {
            color: #93C5FD;
            text-decoration: none;
            margin-left: 0.5rem;
            font-weight: 600;
            padding: 0.15rem 0.5rem;
            border-radius: 4px;
            background: rgba(255, 255, 255, 0.1);
        }

        .test-switcher-bar a:hover {
            background: var(--accent);
            color: var(--primary-dark);
        }

        /* Main Navigation */
        .navbar {
            background-color: var(--primary);
            color: white;
            padding: 0.85rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            color: white;
        }

        .brand-icon {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, var(--accent), #B38F22);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-dark);
            font-size: 1.4rem;
            box-shadow: 0 4px 10px rgba(212, 175, 55, 0.3);
        }

        .brand-text h1 {
            font-size: 1.25rem;
            font-weight: 700;
            line-height: 1.1;
        }

        .brand-text span {
            font-size: 0.72rem;
            color: var(--accent-light);
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            list-style: none;
        }

        .nav-link {
            color: #E2E8F0;
            text-decoration: none;
            font-size: 0.92rem;
            font-weight: 500;
            padding: 0.5rem 0.75rem;
            border-radius: 8px;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .nav-link:hover,
        .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.12);
        }

        .btn-gold {
            background: linear-gradient(135deg, var(--accent), #C49C2C);
            color: var(--primary-dark);
            font-weight: 700;
            padding: 0.6rem 1.15rem;
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 4px 12px rgba(212, 175, 55, 0.25);
            transition: transform 0.2s, box-shadow 0.2s;
            border: none;
            cursor: pointer;
        }

        .btn-gold:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(212, 175, 55, 0.35);
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            padding: 0.6rem 1.15rem;
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
        }

        .btn-primary:hover {
            background: var(--primary-light);
        }

        .container {
            max-width: 1240px;
            margin: 0 auto;
            padding: 2rem 1.5rem;
            width: 100%;
            flex: 1;
        }

        .alert-success {
            background: #ECFDF5;
            border-left: 4px solid #10B981;
            color: #065F46;
            padding: 1rem 1.25rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .alert-error {
            background: #FEF2F2;
            border-left: 4px solid #EF4444;
            color: #991B1B;
            padding: 1rem 1.25rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .card {
            background: var(--surface);
            border-radius: 14px;
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-md);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.25rem 0.6rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-verified {
            background: #D1FAE5;
            color: #065F46;
            border: 1px solid #A7F3D0;
        }

        .badge-pending {
            background: #FEF3C7;
            color: #92400E;
            border: 1px solid #FDE68A;
        }

        .badge-admin {
            background: #FCE7F3;
            color: #831843;
            border: 1px solid #FBCFE8;
        }

        .badge-seats {
            background: #E0E7FF;
            color: #3730A3;
        }

        .badge-ticket {
            background: #E0F2FE;
            color: #075985;
        }

        .badge-hotel {
            background: #FEF3C7;
            color: #78350F;
        }

        /* Language Switcher Pill */
        .lang-switcher {
            display: inline-flex;
            background: rgba(0, 0, 0, 0.25);
            padding: 0.2rem;
            border-radius: 20px;
            border: 1px solid rgba(212, 175, 55, 0.4);
        }

        .lang-btn {
            color: #CBD5E1;
            padding: 0.25rem 0.65rem;
            border-radius: 14px;
            text-decoration: none;
            font-size: 0.78rem;
            font-weight: 700;
            transition: all 0.2s;
        }

        .lang-btn.active {
            background: var(--accent);
            color: var(--primary-dark);
        }

        .footer {
            background-color: var(--primary-dark);
            color: #94A3B8;
            padding: 3rem 2rem 1.5rem;
            margin-top: 3rem;
            border-top: 2px solid var(--accent);
        }

        .footer-grid {
            max-width: 1240px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-col h4 {
            color: white;
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }

        .footer-col p {
            font-size: 0.9rem;
            line-height: 1.6;
        }

        .footer-col ul {
            list-style: none;
        }

        .footer-col ul li {
            margin-bottom: 0.5rem;
        }

        .footer-col ul li a {
            color: #CBD5E1;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .footer-col ul li a:hover {
            color: var(--accent-light);
        }

        .footer-bottom {
            max-width: 1240px;
            margin: 0 auto;
            text-align: center;
            font-size: 0.85rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 1.5rem;
        }

        /* Disclaimer Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            z-index: 2000;
            align-items: center;
            justify-content: center;
        }

        .modal.open {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 16px;
            width: 100%;
            max-width: 580px;
            padding: 2rem;
            position: relative;
        }

        .close-btn {
            position: absolute;
            top: 1.25rem;
            right: 1.25rem;
            background: none;
            border: none;
            font-size: 1.2rem;
            color: var(--text-muted);
            cursor: pointer;
        }
    </style>
</head>

<body>

    <!-- Quick Role Switcher Bar for Demonstration & Testing -->
    <div class="test-switcher-bar">
        <div>
            <i class="fa-solid fa-vial-circle-check text-amber-400"></i> {{ $lang == 'bn' ? 'টেস্ট রোল সুইচার:' : 'Role Switcher:' }}
            <a href="{{ route('quick.switch', 1) }}" title="Super Admin Account"><i class="fa-solid fa-user-shield"></i> {{ $lang == 'bn' ? 'সুপার এডমিন' : 'Super Admin' }}</a>
            <a href="{{ route('quick.switch', 2) }}" title="R.B Tours and Travels (License: 1109)"><i class="fa-solid fa-circle-check"></i> {{ $lang == 'bn' ? 'আর.বি ট্যুরস (লাইসেন্স ১১০৯)' : 'R.B Tours (License 1109)' }}</a>
            <a href="{{ route('quick.switch', 5) }}" title="Baitul Mamur Travels (Pending)"><i class="fa-solid fa-clock"></i> {{ $lang == 'bn' ? 'পেন্ডিং এজেন্সি' : 'Pending Agency' }}</a>
            <a href="{{ route('quick.switch', 0) }}" title="Unauthenticated Public Visitor"><i class="fa-solid fa-user-xmark"></i> {{ $lang == 'bn' ? 'পাবলিক মোড' : 'Public Visitor' }}</a>
        </div>

        <div style="display: flex; align-items: center; gap: 1rem;">
            <!-- Language Switcher Pill (BN / EN) -->
            <div class="lang-switcher">
                <a href="{{ route('lang.switch', 'bn') }}" class="lang-btn {{ $lang == 'bn' ? 'active' : '' }}">বাংলা (BN)</a>
                <a href="{{ route('lang.switch', 'en') }}" class="lang-btn {{ $lang == 'en' ? 'active' : '' }}">English (EN)</a>
            </div>

            <div>
                @auth
                {{ $lang == 'bn' ? 'লগইন আছেন:' : 'Logged in as:' }} <strong>{{ Auth::user()->agency_name }}</strong>
                <span class="badge badge-{{ Auth::user()->isAdmin() ? 'admin' : (Auth::user()->isApproved() ? 'verified' : 'pending') }}">
                    {{ Auth::user()->isAdmin() ? ($lang == 'bn' ? 'এডমিন' : 'Super Admin') : (Auth::user()->isApproved() ? ($lang == 'bn' ? 'ভেরিফাইড এজেন্সি' : 'Verified Agency') : ($lang == 'bn' ? 'পেন্ডিং ভেরিফিকেশন' : 'Pending Approval')) }}
                </span>
                @else
                <span style="color: #94A3B8;"><i class="fa-solid fa-lock me-1"></i> {{ $lang == 'bn' ? 'পাবলিক ভিজিটর (নম্বর লকড)' : 'Public Visitor (Contact Locked)' }}</span>
                @endauth
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <nav class="navbar">
        <a href="{{ route('home') }}" class="brand">
            <div class="brand-icon">
                <i class="fa-solid fa-kaaba"></i>
            </div>
            <div class="brand-text">
                <h1>HajjUmrah B2B</h1>
                <span>{{ $lang == 'bn' ? 'বিডি এজেন্সি শেয়ারিং নেটওয়ার্ক' : 'SaaS Collaboration Network' }}</span>
            </div>
        </a>

        <ul class="nav-links">
            <li><a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"><i class="fa-solid fa-house"></i> {{ $lang == 'bn' ? 'হোম পেজ' : 'Home' }}</a></li>
            <li><a href="{{ route('posts.index') }}" class="nav-link {{ request()->routeIs('posts.*') ? 'active' : '' }}"><i class="fa-solid fa-layer-group"></i> {{ $lang == 'bn' ? 'B2B মার্কেটপ্লেস' : 'B2B Marketplace' }}</a></li>

            @auth
            @if(Auth::user()->isAdmin())
            <li>
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.*') ? 'active' : '' }}" style="background: rgba(244, 114, 182, 0.2); color: #FBCFE8;">
                    <i class="fa-solid fa-user-shield"></i> {{ $lang == 'bn' ? 'এডমিন প্যানেল' : 'Admin Panel' }}
                </a>
            </li>
            @else
            <li>
                <a href="{{ route('dashboard.index') }}" class="nav-link {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-chart-line"></i> {{ $lang == 'bn' ? 'মাই এজেন্সি ড্যাশবোর্ড' : 'My Agency Control' }}
                </a>
            </li>
            @endif
            @endauth
        </ul>

        <div style="display: flex; align-items: center; gap: 0.75rem;">
            @auth
            <a href="{{ route('posts.create') }}" class="btn-gold">
                <i class="fa-solid fa-plus-circle"></i> {{ $lang == 'bn' ? 'পোস্ট করুন' : 'Post Requirement' }}
            </a>

            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-primary" style="background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3); font-size: 0.85rem; padding: 0.55rem 0.85rem;">
                    <i class="fa-solid fa-right-from-bracket"></i> {{ $lang == 'bn' ? 'লগআউট' : 'Logout' }}
                </button>
            </form>
            @else
            <a href="{{ route('login') }}" class="btn-primary" style="background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3);">
                <i class="fa-solid fa-right-to-bracket"></i> {{ $lang == 'bn' ? 'এজেন্সি লগইন' : 'Agency Login' }}
            </a>
            <a href="{{ route('register') }}" class="btn-gold">
                <i class="fa-solid fa-user-plus"></i> {{ $lang == 'bn' ? 'ফ্রি রেজিস্ট্রেশন' : 'Register Agency' }}
            </a>
            @endauth
        </div>
    </nav>

    <!-- Main Container -->
    <main class="container">
        @if(session('success'))
        <div class="alert-success">
            <i class="fa-solid fa-circle-check fa-lg"></i>
            <div>{{ session('success') }}</div>
        </div>
        @endif

        @if(session('error'))
        <div class="alert-error">
            <i class="fa-solid fa-triangle-exclamation fa-lg"></i>
            <div>{{ session('error') }}</div>
        </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-grid">
            <div class="footer-col">
                <div class="brand" style="margin-bottom: 1rem;">
                    <div class="brand-icon">
                        <i class="fa-solid fa-kaaba"></i>
                    </div>
                    <div class="brand-text">
                        <h1 style="color: white;">HajjUmrah B2B SaaS</h1>
                        <span>{{ $lang == 'bn' ? 'বাংলাদেশ ট্রাভেল নেটওয়ার্ক' : 'Bangladesh Travel Network' }}</span>
                    </div>
                </div>
                <p>{{ $lang == 'bn' ? 'বাংলাদেশের লাইসেন্সপ্রাপ্ত হজ ও ওমরাহ এজেন্সি সমূহের জন্য গ্রুপ সিট ভ্যাকেন্সি শেয়ারিং, উদ্বৃত্ত টিকিট লেনদেন এবং হোটেল রুম শেয়ার করার ১০০% নিরাপদ B2B পোর্টাল।' : 'Strictly verified B2B collaboration portal connecting licensed Hajj & Umrah agencies to share group seat vacancies, surplus flight tickets, and hotel accommodation.' }}</p>
            </div>

            <div class="footer-col">
                <h4>{{ $lang == 'bn' ? 'মূল ক্যাটাগরি' : 'Core Categories' }}</h4>
                <ul>
                    <li><a href="{{ route('posts.index', ['post_category' => 'group_seats']) }}"><i class="fa-solid fa-chevron-right text-xs"></i> {{ $lang == 'bn' ? 'গ্রুপ সিট (শর্টেজ ও ফাঁকা)' : 'Group Seats (Required & Available)' }}</a></li>
                    <li><a href="{{ route('posts.index', ['post_category' => 'ticket_only']) }}"><i class="fa-solid fa-chevron-right text-xs"></i> {{ $lang == 'bn' ? 'টিকিট ও ভিসা অনলি' : 'Ticket & Visa Only' }}</a></li>
                    <li><a href="{{ route('posts.index', ['post_category' => 'hotel_share']) }}"><i class="fa-solid fa-chevron-right text-xs"></i> {{ $lang == 'bn' ? 'হোটেল রুম শেয়ারিং' : 'Hotel Room Sharing' }}</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>{{ $lang == 'bn' ? 'নিরাপত্তা ও নিয়মাবলী' : 'Legal & Verification' }}</h4>
                <ul>
                    <li><a href="javascript:void(0)" onclick="openTermsModal()"><i class="fa-solid fa-shield-halved text-xs"></i> {{ $lang == 'bn' ? 'B2B ম্যাচমেকার শর্তাবলী' : 'B2B Matchmaker Terms' }}</a></li>
                    <li><a href="{{ route('register') }}"><i class="fa-solid fa-chevron-right text-xs"></i> {{ $lang == 'bn' ? 'হাব ও গভঃ লাইসেন্স ভেরিফিকেশন' : 'HAAB License Verification' }}</a></li>
                    <li><a href="{{ route('login') }}"><i class="fa-solid fa-lock text-xs"></i> {{ $lang == 'bn' ? 'নম্বর ও কন্টাক্ট প্রাইভেসি' : 'Contact Privacy Standards' }}</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>{{ $lang == 'bn' ? 'যোগাযোগ' : 'Contact Information' }}</h4>
                <!-- <p style="color: white; font-weight: 700; margin-bottom: 0.35rem;">R.B Tours and Travels ({{ $lang == 'bn' ? 'লাইসেন্স: ১১০৯' : 'License: 1109' }})</p> -->
                <p><i class="fa-solid fa-location-dot me-1 text-amber-400"></i> 53 DIT Extension Road, Naya Paltan, Dhaka</p>
                <p><i class="fa-solid fa-phone me-1 text-emerald-400"></i> 01644416378</p>
                <p><i class="fa-solid fa-envelope me-1 text-blue-400"></i> masudd.info@gmail.com</p>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Hajj & Umrah B2B SaaS Platform. {{ $lang == 'bn' ? 'পরিচালনায়' : 'Powered by' }} <strong>R.B Tours and Travels</strong> ({{ $lang == 'bn' ? 'লাইসেন্স: ১১০৯' : 'License: 1109' }}). &nbsp;|&nbsp; Design & Developed by <a href="https://mrdeveloper.xyz" target="_blank" style="color: #F3E5AB; font-weight: 700; text-decoration: none;">MR Developer</a> . {{ $lang == 'bn' ? '১০০% ফ্রি এক্সেস প্ল্যাটফর্ম।' : '100% Free Access Platform.' }} All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Terms & Disclaimer Modal -->
    <div id="termsModal" class="modal">
        <div class="modal-content">
            <button class="close-btn" onclick="closeTermsModal()"><i class="fa-solid fa-xmark"></i></button>
            <h3 class="font-heading" style="color: var(--primary-dark); margin-bottom: 0.5rem;"><i class="fa-solid fa-shield-halved text-amber-500"></i> {{ $lang == 'bn' ? 'প্ল্যাটফর্মের শর্তাবলী ও নিয়মাবলী' : 'Platform Terms & Matchmaker Disclaimer' }}</h3>
            <p style="color: var(--text-muted); font-size: 0.85rem; margin-bottom: 1rem;">Please read the operational rules of our B2B SaaS Network.</p>

            <div style="font-size: 0.88rem; color: var(--text-dark); line-height: 1.6; background: #F8FAFC; padding: 1rem; border-radius: 10px; border: 1px solid var(--border-color); max-height: 300px; overflow-y: auto;">
                <p style="margin-bottom: 0.75rem;"><strong>১. ম্যাচমেকার ভূমিকা:</strong> এই প্ল্যাটফর্মটি শুধুমাত্র বাংলাদেশ সরকারের অনুমোদিত হজ ও ওমরাহ এজেন্সিগুলোর মধ্যে কাজের সমন্বয় (Matchmaking) করার জন্য একটি সফটওয়্যার প্ল্যাটফর্ম।</p>
                <p style="margin-bottom: 0.75rem;"><strong>২. আর্থিক লেনদেন:</strong> কোনো প্রকার আর্থিক পেমেন্ট বা প্যাকেজ চুক্তি এজেন্সিরা নিজেদের মধ্যে সম্পন্ন করবে। প্ল্যাটফর্ম কোনো আর্থিক লেনদেনের দায়ভার বহন করে না।</p>
                <p style="margin-bottom: 0.75rem;"><strong>৩. কঠোর এজেন্সি ভেরিফিকেশন:</strong> শুধুমাত্র হাব (HAAB) বা ধর্ম মন্ত্রণালয়ের বৈধ লাইসেন্সধারী এজেন্সিরাই সুপার এডমিন কর্তৃক অনুমোদিত হয়ে ডিল দেখতে বা কন্টাক্ট করতে পারবে।</p>
            </div>
        </div>
    </div>

    <script>
        function openTermsModal() {
            document.getElementById('termsModal').classList.add('open');
        }

        function closeTermsModal() {
            document.getElementById('termsModal').classList.remove('open');
        }
    </script>
</body>

</html>