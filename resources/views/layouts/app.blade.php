<!DOCTYPE html>
@php
    $lang = session('locale', 'bn');
@endphp
<html lang="{{ $lang }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'B2B Hajj Umrah - ' . ($lang == 'bn' ? 'হজ ও ওমরাহ B2B শেয়ারিং প্ল্যাটফর্ম' : 'Agency SaaS Network'))</title>

    <!-- Fonts: Outfit, Inter & Noto Serif Bengali / Hind Siliguri -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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
        }

        /* Mobile Android App Navigation Bar Styles */
        .mobile-bottom-nav {
            display: none;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            height: 64px;
            background: rgba(2, 54, 36, 0.96);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-top: 1px solid rgba(212, 175, 55, 0.4);
            z-index: 9999;
            justify-content: space-around;
            align-items: center;
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.2);
        }

        .mobile-nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #94A3B8;
            text-decoration: none;
            font-size: 0.72rem;
            font-weight: 600;
            flex: 1;
            height: 100%;
            transition: all 0.2s ease;
        }

        .mobile-nav-item i {
            font-size: 1.25rem;
            margin-bottom: 2px;
        }

        .mobile-nav-item.active {
            color: #F3E5AB;
        }

        .mobile-nav-item.active i {
            color: #D4AF37;
            transform: translateY(-2px);
        }

        .mobile-nav-item.post-btn {
            position: relative;
            top: -14px;
        }

        .post-icon-circle {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #D4AF37, #B38F22);
            color: #023624;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.5);
            border: 3px solid #023624;
        }

        /* Mobile Slide Drawer Sidebar */
        .mobile-drawer {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            z-index: 99999;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .mobile-drawer.open {
            display: flex !important;
            opacity: 1 !important;
            visibility: visible !important;
        }

        .drawer-content {
            width: 300px;
            max-width: 85%;
            height: 100%;
            background: #023624;
            color: white;
            padding: 1.5rem;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow-y: auto;
        }

        .mobile-drawer.open .drawer-content {
            transform: translateX(0);
        }

        .hamburger-btn {
            display: none;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            font-size: 1.2rem;
            padding: 0.5rem 0.75rem;
            border-radius: 8px;
            cursor: pointer;
        }

        /* Desktop Grids (Default > 768px) */
        .spotlight-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }

        .why-choose-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.75rem;
        }

        .hero-stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }

        .show-details-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
        }

        .key-metrics-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
        }

        .flight-itinerary-grid {
            display: grid;
            grid-template-columns: 140px 1fr 140px;
            align-items: center;
            gap: 1.5rem;
        }

        .dashboard-stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }

        .form-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .form-grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }

        .filter-form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(170px, 1fr)) 110px;
            gap: 1rem;
        }

        .posts-cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 1.5rem;
        }

        .hotel-input-subgrid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 0.5rem;
        }

        /* Mobile View Rules (Strictly <= 768px) */
        @media (max-width: 768px) {
            body {
                padding-bottom: 64px !important;
                background-color: var(--primary-dark) !important;
            }

            .test-switcher-bar {
                display: none !important;
            }

            .navbar {
                padding: 0.75rem 1rem !important;
            }

            .nav-links, .lang-switcher, .desktop-actions {
                display: none !important;
            }

            .hamburger-btn {
                display: block !important;
            }

            .mobile-bottom-nav {
                display: flex !important;
            }

            .container {
                padding: 1rem 0.75rem !important;
                background-color: var(--bg-light) !important;
            }

            .footer {
                margin-top: 2rem !important;
                padding: 2rem 1.25rem 80px !important;
            }

            .footer-grid {
                grid-template-columns: 1fr !important;
                gap: 1.5rem !important;
            }

            .hero-banner-container {
                padding: 2rem 1.25rem !important;
                border-radius: 16px !important;
                margin-bottom: 2rem !important;
            }
            .hero-banner-container h1 {
                font-size: 1.8rem !important;
            }
            .hero-banner-container p {
                font-size: 0.95rem !important;
            }

            .hero-stats-grid,
            .spotlight-grid,
            .why-choose-grid,
            .show-details-grid,
            .dashboard-stats-grid,
            .form-grid-2,
            .form-grid-3,
            .filter-form-grid,
            .posts-cards-grid,
            .hotel-input-subgrid {
                grid-template-columns: 1fr !important;
                gap: 0.75rem !important;
            }

            .key-metrics-grid {
                grid-template-columns: 1fr 1fr !important;
                gap: 0.75rem !important;
                padding: 1rem !important;
            }

            .flight-itinerary-grid {
                grid-template-columns: 1fr !important;
                gap: 0.85rem !important;
                text-align: center !important;
            }

            .responsive-card-padding {
                padding: 1.25rem 1rem !important;
                border-radius: 14px !important;
            }

            .responsive-header-flex {
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 1rem !important;
            }

            .responsive-category-tabs {
                overflow-x: auto !important;
                flex-wrap: nowrap !important;
                padding-bottom: 0.5rem !important;
                scrollbar-width: none;
            }

            .modal-content {
                margin: 0 1rem;
                padding: 1.5rem;
            }

            table {
                min-width: 650px;
            }

            /* Responsive Touch Buttons */
            .btn-primary, .btn-gold {
                padding: 0.65rem 1rem;
                font-size: 0.85rem;
            }
        }
    </style>
</head>

<body>

    @if(session('impersonated_by_admin'))
    <div style="background: linear-gradient(90deg, #7F1D1D, #991B1B); color: white; padding: 0.65rem 2rem; font-size: 0.88rem; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 4px 10px rgba(0,0,0,0.2); position: sticky; top: 0; z-index: 2000;">
        <div>
            <i class="fa-solid fa-user-secret me-2 text-amber-300"></i>
            <strong>ADMIN IMPERSONATION MODE:</strong> Logged in as <u>{{ Auth::user()->agency_name }}</u>
        </div>
        <a href="{{ route('admin.stop.impersonation') }}" style="background: #FEF3C7; color: #92400E; font-weight: 800; padding: 0.35rem 0.85rem; border-radius: 6px; text-decoration: none; font-size: 0.82rem; border: 1px solid #FCD34D;">
            <i class="fa-solid fa-right-from-bracket me-1"></i> Exit & Return to Super Admin Panel
        </a>
    </div>
    @endif

    <!-- Main Navigation Bar -->
    <nav class="navbar">
        <a href="{{ route('home') }}" class="brand">
            <div class="brand-icon">
                <i class="fa-solid fa-kaaba"></i>
            </div>
            <div class="brand-text">
                <h1>B2B Hajj Umrah</h1>
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
            @if(!Auth::user()->isApproved())
            <li>
                <a href="{{ route('verification.portal') }}" class="nav-link {{ request()->routeIs('verification.*') ? 'active' : '' }}" style="background: rgba(251, 191, 36, 0.25); color: #FDE68A; font-weight: 700;">
                    <i class="fa-solid fa-shield-halved"></i> {{ $lang == 'bn' ? 'লাইসেন্স ভেরিফিকেশন' : 'Verification Portal' }}
                </a>
            </li>
            @endif
            @endif
            @endauth
        </ul>

        <div class="desktop-actions" style="display: flex; align-items: center; gap: 0.85rem;">
            <!-- Language Switcher Pill (BN / EN) -->
            <div class="lang-switcher">
                <a href="{{ route('lang.switch', 'bn') }}" class="lang-btn {{ $lang == 'bn' ? 'active' : '' }}">বাংলা</a>
                <a href="{{ route('lang.switch', 'en') }}" class="lang-btn {{ $lang == 'en' ? 'active' : '' }}">EN</a>
            </div>

            @auth
            <a href="{{ route('posts.create') }}" class="btn-gold" style="display: inline-flex;">
                <i class="fa-solid fa-plus-circle"></i> {{ $lang == 'bn' ? 'পোস্ট করুন' : 'Post Requirement' }}
            </a>

            <form action="{{ route('logout') }}" method="POST" style="margin: 0; display: inline-block;">
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

        <!-- Mobile Hamburger Menu Button -->
        <button type="button" class="hamburger-btn" onclick="toggleMobileDrawer()" aria-label="Open Navigation Menu">
            <i class="fa-solid fa-bars"></i>
        </button>
    </nav>

    <!-- Admin Site Announcement Marquee Ticker Bar -->
    @php
        $noticeText = \App\Models\SiteSetting::get('notice_ticker_text');
        $noticeActive = \App\Models\SiteSetting::get('notice_ticker_active', '1') === '1';
    @endphp

    @if($noticeActive && !empty($noticeText))
        <div style="background: linear-gradient(90deg, #023624 0%, #044E35 50%, #023624 100%); color: #F3E5AB; border-bottom: 2px solid var(--accent); padding: 0.45rem 1.5rem; font-size: 0.88rem; font-weight: 600; display: flex; align-items: center; gap: 1rem; box-shadow: 0 4px 10px rgba(0,0,0,0.15); z-index: 990; position: relative;">
            <div style="background: rgba(212, 175, 55, 0.25); color: #F3E5AB; border: 1px solid rgba(212, 175, 55, 0.6); padding: 0.2rem 0.75rem; border-radius: 20px; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; white-space: nowrap; display: flex; align-items: center; gap: 0.35rem; flex-shrink: 0;">
                <i class="fa-solid fa-bullhorn text-amber-300"></i> {{ $lang == 'bn' ? 'জরুরী নোটিশ' : 'ANNOUNCEMENT' }}
            </div>
            <marquee behavior="scroll" direction="left" scrollamount="6" onmouseover="this.stop()" onmouseout="this.start()" style="color: #FFFFFF; font-family: 'Hind Siliguri', 'Inter', sans-serif;">
                {{ $noticeText }}
            </marquee>
        </div>
    @endif

    <!-- Mobile Slide Drawer Sidebar -->
    <div id="mobileDrawer" class="mobile-drawer" onclick="if(event.target === this) toggleMobileDrawer()">
        <div class="drawer-content">
            <div>
                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid rgba(255,255,255,0.15); padding-bottom: 1rem; margin-bottom: 1.25rem;">
                    <div class="brand">
                        <div class="brand-icon">
                            <i class="fa-solid fa-kaaba"></i>
                        </div>
                        <div class="brand-text">
                            <h1 style="color: white; font-size: 1.15rem;">B2B Hajj Umrah</h1>
                            <span>{{ $lang == 'bn' ? 'বিডি এজেন্সি শেয়ারিং' : 'Agency SaaS Network' }}</span>
                        </div>
                    </div>
                    <button type="button" onclick="toggleMobileDrawer()" style="background: none; border: none; color: white; font-size: 1.3rem; cursor: pointer;">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                @auth
                    <div style="background: rgba(255,255,255,0.08); padding: 0.85rem; border-radius: 10px; margin-bottom: 1.25rem; border: 1px solid rgba(212,175,55,0.3);">
                        <div style="font-weight: 700; color: #F3E5AB; font-size: 0.95rem;">{{ Auth::user()->agency_name }}</div>
                        <div style="font-size: 0.78rem; color: #CBD5E1; margin-top: 0.15rem;"><i class="fa-solid fa-certificate text-amber-400 me-1"></i> License: {{ Auth::user()->license_no }}</div>
                    </div>
                @endauth

                <ul style="list-style: none; display: flex; flex-direction: column; gap: 0.85rem; font-size: 0.95rem; padding: 0;">
                    <li>
                        <a href="{{ route('home') }}" style="color: white; text-decoration: none; display: flex; align-items: center; gap: 0.75rem; padding: 0.65rem 0.85rem; border-radius: 8px; background: {{ request()->routeIs('home') ? 'rgba(212,175,55,0.2)' : 'transparent' }};">
                            <i class="fa-solid fa-house text-amber-400"></i> {{ $lang == 'bn' ? 'হোম পেজ' : 'Home' }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('posts.index') }}" style="color: white; text-decoration: none; display: flex; align-items: center; gap: 0.75rem; padding: 0.65rem 0.85rem; border-radius: 8px; background: {{ request()->routeIs('posts.*') ? 'rgba(212,175,55,0.2)' : 'transparent' }};">
                            <i class="fa-solid fa-store text-sky-400"></i> {{ $lang == 'bn' ? 'B2B মার্কেটপ্লেস' : 'B2B Marketplace' }}
                        </a>
                    </li>
                    @auth
                        @if(Auth::user()->isAdmin())
                            <li>
                                <a href="{{ route('admin.dashboard') }}" style="color: #FBCFE8; text-decoration: none; display: flex; align-items: center; gap: 0.75rem; padding: 0.65rem 0.85rem; border-radius: 8px; background: rgba(244, 114, 182, 0.2);">
                                    <i class="fa-solid fa-user-shield"></i> {{ $lang == 'bn' ? 'এডমিন প্যানেল' : 'Admin Panel' }}
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('dashboard.index') }}" style="color: white; text-decoration: none; display: flex; align-items: center; gap: 0.75rem; padding: 0.65rem 0.85rem; border-radius: 8px; background: {{ request()->routeIs('dashboard.*') ? 'rgba(212,175,55,0.2)' : 'transparent' }};">
                                    <i class="fa-solid fa-chart-line text-emerald-400"></i> {{ $lang == 'bn' ? 'মাই এজেন্সি ড্যাশবোর্ড' : 'My Agency Control' }}
                                </a>
                            </li>
                        @endif
                    @endauth
                    <li>
                        <a href="{{ route('posts.create') }}" style="color: #F3E5AB; font-weight: 700; text-decoration: none; display: flex; align-items: center; gap: 0.75rem; padding: 0.65rem 0.85rem; border-radius: 8px; background: rgba(212,175,55,0.15); border: 1px solid rgba(212,175,55,0.3);">
                            <i class="fa-solid fa-plus-circle text-amber-400"></i> {{ $lang == 'bn' ? 'পোস্ট তৈরি করুন' : 'Post Requirement' }}
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <div style="display: flex; gap: 0.5rem; margin-bottom: 1rem;">
                    <a href="{{ route('lang.switch', 'bn') }}" style="flex: 1; text-align: center; padding: 0.5rem; border-radius: 6px; text-decoration: none; font-size: 0.85rem; font-weight: 700; background: {{ $lang == 'bn' ? 'var(--accent)' : 'rgba(255,255,255,0.1)' }}; color: {{ $lang == 'bn' ? 'var(--primary-dark)' : 'white' }};">বাংলা</a>
                    <a href="{{ route('lang.switch', 'en') }}" style="flex: 1; text-align: center; padding: 0.5rem; border-radius: 6px; text-decoration: none; font-size: 0.85rem; font-weight: 700; background: {{ $lang == 'en' ? 'var(--accent)' : 'rgba(255,255,255,0.1)' }}; color: {{ $lang == 'en' ? 'var(--primary-dark)' : 'white' }};">English</a>
                </div>

                @auth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" style="width: 100%; padding: 0.65rem; background: #DC2626; color: white; border: none; border-radius: 8px; font-weight: 700; font-size: 0.9rem; cursor: pointer;">
                            <i class="fa-solid fa-right-from-bracket me-1"></i> {{ $lang == 'bn' ? 'লগআউট' : 'Logout' }}
                        </button>
                    </form>
                @else
                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                        <a href="{{ route('login') }}" class="btn-primary" style="justify-content: center; background: rgba(255,255,255,0.15);">
                            <i class="fa-solid fa-right-to-bracket me-1"></i> {{ $lang == 'bn' ? 'এজেন্সি লগইন' : 'Agency Login' }}
                        </a>
                        <a href="{{ route('register') }}" class="btn-gold" style="justify-content: center;">
                            <i class="fa-solid fa-user-plus me-1"></i> {{ $lang == 'bn' ? 'ফ্রি রেজিস্ট্রেশন' : 'Register Agency' }}
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>

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
                        <h1 style="color: white;">B2B Hajj Umrah SaaS</h1>
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
            <p>&copy; {{ date('Y') }} B2B Hajj Umrah. &nbsp;|&nbsp; Design & Developed by <a href="https://mrdeveloper.xyz" target="_blank" style="color: #F3E5AB; font-weight: 700; text-decoration: none;">MR Developer</a> . {{ $lang == 'bn' ? '১০০% ফ্রি এক্সেস প্ল্যাটফর্ম।' : '100% Free Access Platform.' }} All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Terms & Disclaimer Modal -->
    <div id="termsModal" class="modal" onclick="if(event.target === this) closeTermsModal()">
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

    <!-- Restricted Access Modal for Unverified / Guest Users -->
    <div id="restrictedAccessModal" class="modal" onclick="if(event.target === this) closeRestrictedModal()">
        <div class="modal-content" style="max-width: 540px; text-align: center; padding: 2.25rem;">
            <button class="close-btn" onclick="closeRestrictedModal()"><i class="fa-solid fa-xmark"></i></button>
            
            <div style="width: 64px; height: 64px; background: #FEF3C7; border: 2px solid #FDE68A; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; color: #D97706; font-size: 1.8rem; margin: 0 auto 1.25rem;">
                <i class="fa-solid fa-shield-halved"></i>
            </div>

            <h3 class="font-heading" style="color: var(--primary-dark); font-size: 1.4rem; margin-bottom: 0.75rem;">
                {{ $lang == 'bn' ? 'এজেন্সি বিবরণী ও কন্টাক্ট নম্বর সুরক্ষিত!' : 'Confidential Agency Details Protected!' }}
            </h3>

            <div style="background: #F8FAFC; border: 1px solid var(--border-color); border-radius: 12px; padding: 1.25rem; font-size: 0.9rem; color: var(--text-dark); line-height: 1.6; margin-bottom: 1.5rem; text-align: left;">
                <p style="margin-bottom: 0.75rem;">
                    {{ $lang == 'bn' 
                        ? 'এই B2B ডিলটির পূর্ণাঙ্গ এজেন্সির নাম, মালিকের তথ্য, ফোন নম্বর ও ১-ক্লিক হোয়াটসঅ্যাপ লিঙ্ক শুধুমাত্র বাংলাদেশ সরকারের হাব (HAAB) / ধর্ম মন্ত্রণালয় কর্তৃক অনুমোদিত ভেরিফাইড এজেন্সিরাই দেখতে পারেন।' 
                        : 'Full agency name, phone contact, office address, and WhatsApp links are strictly restricted to approved HAAB verified agencies in Bangladesh.' 
                    }}
                </p>
                <p style="margin: 0; color: #B45309; font-size: 0.85rem; font-weight: 600;">
                    <i class="fa-solid fa-circle-info me-1"></i> {{ $lang == 'bn' ? 'আপনি যদি একজন লাইসেন্সধারী এজেন্সির মালিক হয়ে থাকেন, তবে বিনামূল্যে রেজিস্ট্রেশন করে তাৎক্ষণিক এক্সেস পান।' : 'If you own a licensed travel agency, register for free to instant unlock all B2B leads.' }}
                </p>
            </div>

            <div style="display: flex; gap: 0.75rem; justify-content: center; flex-wrap: wrap;">
                <a href="{{ route('register') }}" class="btn-gold" style="padding: 0.75rem 1.5rem; font-size: 0.95rem;">
                    <i class="fa-solid fa-user-plus me-1"></i> {{ $lang == 'bn' ? 'এজেন্সি রেজিস্ট্রেশন করুন (ফ্রি)' : 'Register Agency (Free)' }}
                </a>
                <a href="{{ route('login') }}" class="btn-primary" style="padding: 0.75rem 1.5rem; font-size: 0.95rem;">
                    <i class="fa-solid fa-right-to-bracket me-1"></i> {{ $lang == 'bn' ? 'এজেন্সি লগইন' : 'Agency Login' }}
                </a>
            </div>
        </div>
    </div>

    <!-- Mobile Android App Style Persistent Bottom Bar -->
    <nav class="mobile-bottom-nav">
        <a href="{{ route('home') }}" class="mobile-nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
            <i class="fa-solid fa-house"></i>
            <span>{{ $lang == 'bn' ? 'হোম' : 'Home' }}</span>
        </a>
        <a href="{{ route('posts.index') }}" class="mobile-nav-item {{ request()->routeIs('posts.*') ? 'active' : '' }}">
            <i class="fa-solid fa-store"></i>
            <span>{{ $lang == 'bn' ? 'মার্কেটপ্লেস' : 'Market' }}</span>
        </a>
        <a href="{{ route('posts.create') }}" class="mobile-nav-item {{ request()->routeIs('posts.create') ? 'active' : '' }}">
            <i class="fa-solid fa-square-plus"></i>
            <span>{{ $lang == 'bn' ? 'পোস্ট' : 'Post' }}</span>
        </a>
        @auth
            <a href="{{ route('dashboard.index') }}" class="mobile-nav-item {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
                <i class="fa-solid fa-user-gear"></i>
                <span>{{ $lang == 'bn' ? 'ড্যাশবোর্ড' : 'Account' }}</span>
            </a>
        @else
            <a href="{{ route('login') }}" class="mobile-nav-item {{ request()->routeIs('login') ? 'active' : '' }}">
                <i class="fa-solid fa-right-to-bracket"></i>
                <span>{{ $lang == 'bn' ? 'লগইন' : 'Login' }}</span>
            </a>
        @endauth
    </nav>

    <script>
        function toggleMobileDrawer() {
            const drawer = document.getElementById('mobileDrawer');
            drawer.classList.toggle('open');
        }

        function openTermsModal() {
            document.getElementById('termsModal').classList.add('open');
        }

        function closeTermsModal() {
            document.getElementById('termsModal').classList.remove('open');
        }

        function openRestrictedModal() {
            document.getElementById('restrictedAccessModal').classList.add('open');
        }

        function closeRestrictedModal() {
            document.getElementById('restrictedAccessModal').classList.remove('open');
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const drawer = document.getElementById('mobileDrawer');
                if (drawer && drawer.classList.contains('open')) {
                    drawer.classList.remove('open');
                }
                closeTermsModal();
                closeRestrictedModal();
            }
        });
    </script>
</body>

</html>