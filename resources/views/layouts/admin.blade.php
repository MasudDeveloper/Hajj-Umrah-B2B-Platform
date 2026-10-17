<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Super Admin Governance Panel - B2B Hajj Umrah')</title>
    
    <!-- Fonts: Outfit & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&family=Hind+Siliguri:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Chart.js for Advanced Visual Analytics -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --admin-dark: #0B1325;
            --admin-sidebar: #0A1120;
            --admin-sidebar-hover: #132038;
            --admin-primary: #044E35;
            --admin-accent: #D4AF37;
            --admin-accent-glow: rgba(212, 175, 55, 0.25);
            --admin-bg: #F8FAFC;
            --text-main: #0F172A;
            --text-muted: #64748B;
            --border-color: #E2E8F0;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', 'Hind Siliguri', sans-serif;
            background-color: var(--admin-bg);
            color: var(--text-main);
            display: flex;
            min-height: 100vh;
        }

        h1, h2, h3, h4, h5, h6, .font-heading { font-family: 'Outfit', 'Hind Siliguri', sans-serif; }

        /* Sidebar Styling */
        .sidebar {
            width: 275px;
            background: linear-gradient(180deg, #070D18 0%, #0B1527 100%);
            color: white;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; bottom: 0; left: 0;
            z-index: 100;
            border-right: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 4px 0 25px rgba(0, 0, 0, 0.3);
        }

        .sidebar-brand {
            padding: 1.5rem 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.85rem;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            text-decoration: none;
            color: white;
            background: rgba(255, 255, 255, 0.02);
        }

        .sidebar-brand-icon {
            width: 44px; height: 44px;
            background: linear-gradient(135deg, var(--admin-accent), #B38F22);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            color: var(--admin-dark); font-size: 1.3rem; font-weight: 800;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
        }

        .sidebar-menu {
            list-style: none;
            padding: 1.25rem 0.85rem;
            flex: 1;
            overflow-y: auto;
        }

        .sidebar-menu-category {
            font-size: 0.68rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #64748B;
            padding: 0.75rem 0.85rem 0.35rem 0.85rem;
        }

        .sidebar-menu li { margin-bottom: 0.35rem; }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem 1rem;
            color: #94A3B8;
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.2s ease;
            position: relative;
        }

        .sidebar-menu a .link-content {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .sidebar-menu a:hover {
            background-color: var(--admin-sidebar-hover);
            color: #F1F5F9;
            transform: translateX(3px);
        }

        .sidebar-menu a.active {
            background: linear-gradient(90deg, rgba(212, 175, 55, 0.18), rgba(212, 175, 55, 0.05));
            color: var(--admin-accent);
            border-left: 3px solid var(--admin-accent);
            font-weight: 700;
        }

        /* Top Admin Nav */
        .admin-main {
            margin-left: 275px;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .admin-header {
            background: white;
            min-height: 72px;
            padding: 0.75rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border-color);
            position: sticky; top: 0; z-index: 90;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
            flex-wrap: wrap;
            gap: 1rem;
        }

        .admin-content {
            padding: 2rem;
            flex: 1;
        }

        .badge {
            display: inline-flex; align-items: center; gap: 0.35rem;
            padding: 0.25rem 0.65rem; border-radius: 20px;
            font-size: 0.75rem; font-weight: 700; text-transform: uppercase;
        }

        .btn-gold {
            background: linear-gradient(135deg, var(--admin-accent), #C49C2C);
            color: var(--admin-dark); font-weight: 700; padding: 0.55rem 1.15rem;
            border-radius: 8px; text-decoration: none; border: none; cursor: pointer;
            box-shadow: 0 2px 8px rgba(212, 175, 55, 0.25);
            transition: all 0.2s;
        }

        .btn-gold:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(212, 175, 55, 0.4);
        }

        .btn-primary {
            background: var(--admin-primary);
            color: white; padding: 0.55rem 1.15rem; border-radius: 8px;
            text-decoration: none; border: none; cursor: pointer; font-weight: 600;
            display: inline-flex; align-items: center; gap: 0.4rem;
            transition: all 0.2s;
        }

        .btn-primary:hover {
            background: #065F46;
        }

        .btn-success {
            background: #059669; color: white; border: none; padding: 0.45rem 0.9rem;
            border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 0.82rem;
        }

        .btn-danger {
            background: #DC2626; color: white; border: none; padding: 0.45rem 0.9rem;
            border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 0.82rem;
        }

        /* Modal Overlay System */
        .modal {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100vw; height: 100vh;
            background: rgba(11, 19, 37, 0.75);
            backdrop-filter: blur(8px);
            z-index: 9999;
            align-items: center; justify-content: center;
            padding: 1.5rem;
        }

        .modal.open { display: flex; }

        .modal-content {
            background: white;
            border-radius: 20px;
            width: 100%; max-width: 650px;
            max-height: 90vh;
            overflow-y: auto;
            padding: 2.25rem;
            position: relative;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35);
            border: 1px solid var(--border-color);
            animation: modalSlideUp 0.25s ease-out;
        }

        @keyframes modalSlideUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .close-btn {
            position: absolute;
            top: 1.25rem; right: 1.25rem;
            background: #F1F5F9; border: none;
            width: 36px; height: 36px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem; color: var(--text-muted);
            cursor: pointer; transition: all 0.2s ease;
        }

        .close-btn:hover { background: #E2E8F0; color: #0F172A; }
    </style>
</head>
<body>

    @php
        $pendingVerificationsCount = \App\Models\Agency::where('verification_status', 'pending')->where('is_admin', false)->count();
        $pendingTransactionsCount = \App\Models\Transaction::where('status', 'pending')->count();
        $isFreeMode = \App\Models\SiteSetting::isFreeMode();
    @endphp

    <!-- Dedicated Executive Super Admin Sidebar -->
    <aside class="sidebar">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
            <div class="sidebar-brand-icon">
                <i class="fa-solid fa-kaaba"></i>
            </div>
            <div>
                <h3 style="font-size: 1.15rem; font-weight: 800; line-height: 1.1;">Admin Center</h3>
                <span style="font-size: 0.68rem; color: var(--admin-accent); text-transform: uppercase; letter-spacing: 0.6px; font-weight: 700;">HAAB & Ministry B2B SaaS</span>
            </div>
        </a>

        <ul class="sidebar-menu">
            <li class="sidebar-menu-category">Main Governance</li>
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="link-content"><i class="fa-solid fa-chart-pie text-amber-400"></i> Analytics Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.verifications') }}" class="{{ request()->routeIs('admin.verifications') ? 'active' : '' }}">
                    <span class="link-content"><i class="fa-solid fa-user-clock text-amber-400"></i> Verification Queue</span>
                    @if($pendingVerificationsCount > 0)
                        <span style="background: #D97706; color: white; font-size: 0.72rem; font-weight: 800; padding: 2px 7px; border-radius: 10px;">{{ $pendingVerificationsCount }}</span>
                    @endif
                </a>
            </li>
            <li>
                <a href="{{ route('admin.agencies') }}" class="{{ request()->routeIs('admin.agencies') ? 'active' : '' }}">
                    <span class="link-content"><i class="fa-solid fa-building-circle-check text-emerald-400"></i> Agency Directory</span>
                </a>
            </li>

            <li class="sidebar-menu-category">Finance & Monetization</li>
            <li>
                <a href="{{ route('admin.transactions') }}" class="{{ request()->routeIs('admin.transactions') ? 'active' : '' }}">
                    <span class="link-content"><i class="fa-solid fa-receipt text-indigo-400"></i> Payments & Gateway</span>
                    @if($pendingTransactionsCount > 0)
                        <span style="background: #6366F1; color: white; font-size: 0.72rem; font-weight: 800; padding: 2px 7px; border-radius: 10px;">{{ $pendingTransactionsCount }}</span>
                    @endif
                </a>
            </li>
            <li>
                <a href="{{ route('admin.settings') }}" class="{{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                    <span class="link-content"><i class="fa-solid fa-sliders text-blue-400"></i> Platform Settings</span>
                </a>
            </li>

            <li class="sidebar-menu-category">Quick Navigation</li>
            <li>
                <a href="{{ route('posts.index') }}" target="_blank">
                    <span class="link-content"><i class="fa-solid fa-store text-cyan-400"></i> Live Marketplace</span>
                    <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 0.7rem; color: #64748B;"></i>
                </a>
            </li>
            <li>
                <a href="{{ route('home') }}">
                    <span class="link-content"><i class="fa-solid fa-house text-slate-400"></i> Platform Homepage</span>
                </a>
            </li>
        </ul>

        <!-- Platform Mode Indicator in Sidebar Footer -->
        <div style="padding: 1.25rem; border-top: 1px solid rgba(255,255,255,0.08); background: rgba(0,0,0,0.25);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                <span style="font-size: 0.7rem; color: #94A3B8; text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px;">Monetization Mode</span>
                <span style="width: 8px; height: 8px; border-radius: 50%; background: {{ $isFreeMode ? '#10B981' : '#F59E0B' }}; box-shadow: 0 0 8px {{ $isFreeMode ? '#10B981' : '#F59E0B' }};"></span>
            </div>
            
            <div style="background: rgba(255,255,255,0.06); padding: 0.5rem 0.75rem; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <strong style="color: {{ $isFreeMode ? '#34D399' : '#FBBF24' }}; font-size: 0.82rem; display: block;">
                        {{ $isFreeMode ? '🟢 100% Free Mode' : '🟡 Paid VIP Mode' }}
                    </strong>
                    <span style="color: #94A3B8; font-size: 0.7rem;">{{ $isFreeMode ? 'Free B2B Access' : 'Subscriptions Required' }}</span>
                </div>
                <button type="button" onclick="document.getElementById('platformModeModal').style.display='flex'" style="background: none; border: none; color: #CBD5E1; cursor: pointer; font-size: 0.85rem;" title="Change Platform Mode">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="admin-main">
        <header class="admin-header">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div>
                    <h3 class="font-heading" style="color: var(--admin-dark); font-size: 1.25rem; font-weight: 800; margin: 0;">
                        Super Admin Control Panel
                    </h3>
                    <span style="font-size: 0.78rem; color: var(--text-muted);">Hajj & Umrah Ministry Compliance & B2B Settlement</span>
                </div>
            </div>

            <!-- Top Header Actions -->
            <div style="display: flex; align-items: center; gap: 0.75rem; flex-wrap: wrap;">
                <!-- Platform Mode Quick Pill -->
                <button type="button" onclick="document.getElementById('platformModeModal').style.display='flex'" style="background: {{ $isFreeMode ? '#ECFDF5' : '#FFFBEB' }}; border: 1px solid {{ $isFreeMode ? '#A7F3D0' : '#FDE68A' }}; color: {{ $isFreeMode ? '#065F46' : '#92400E' }}; padding: 0.45rem 0.85rem; border-radius: 20px; font-size: 0.8rem; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; gap: 0.4rem;">
                    <i class="fa-solid fa-toggle-on text-emerald-600"></i> Mode: {{ $isFreeMode ? '100% Free (ফ্রি)' : 'Paid VIP (পেইড)' }}
                </button>

                <!-- Maintenance Cleanup Button -->
                <form action="{{ route('admin.cleanup') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn-primary" style="background: #044E35; font-size: 0.82rem; padding: 0.45rem 0.85rem;" title="Auto-archive expired posts and stale inquiries">
                        <i class="fa-solid fa-broom"></i> Clean Expired
                    </button>
                </form>

                <a href="{{ route('quick.switch', 2) }}" class="btn-gold" style="font-size: 0.82rem; padding: 0.45rem 0.85rem;">
                    <i class="fa-solid fa-rotate me-1"></i> Switch to R.B Tours
                </a>

                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" style="background: #FEE2E2; border: 1px solid #FCA5A5; color: #991B1B; padding: 0.45rem 0.85rem; border-radius: 8px; font-size: 0.82rem; font-weight: 700; cursor: pointer;">
                        <i class="fa-solid fa-right-from-bracket me-1"></i> Logout
                    </button>
                </form>
            </div>
        </header>

        <main class="admin-content">
            @if(session('success'))
                <div style="background: #ECFDF5; border-left: 4px solid #10B981; color: #065F46; padding: 1rem 1.25rem; border-radius: 10px; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem; box-shadow: 0 2px 10px rgba(16,185,129,0.1);">
                    <i class="fa-solid fa-circle-check fa-lg text-emerald-600"></i>
                    <div style="font-weight: 600;">{{ session('success') }}</div>
                </div>
            @endif

            @if(session('error'))
                <div style="background: #FEF2F2; border-left: 4px solid #EF4444; color: #991B1B; padding: 1rem 1.25rem; border-radius: 10px; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem;">
                    <i class="fa-solid fa-triangle-exclamation fa-lg text-red-600"></i>
                    <div style="font-weight: 600;">{{ session('error') }}</div>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Platform Monetization Mode Switcher Modal -->
    <div id="platformModeModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.65); z-index: 10000; align-items: center; justify-content: center; padding: 1rem;">
        <div style="background: white; border-radius: 20px; max-width: 520px; width: 100%; border: 1px solid var(--border-color); box-shadow: 0 25px 50px rgba(0,0,0,0.3); overflow: hidden;">
            <div style="background: linear-gradient(135deg, #070D18, #0B1527); color: white; padding: 1.5rem; display: flex; justify-content: space-between; align-items: center;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 40px; height: 40px; background: rgba(212,175,55,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: var(--admin-accent); font-size: 1.2rem;">
                        <i class="fa-solid fa-sliders"></i>
                    </div>
                    <div>
                        <h4 style="font-size: 1.2rem; font-weight: 800; margin: 0; color: white;">প্ল্যাটফর্ম অ্যাক্সেস মোড কন্ট্রোলার</h4>
                        <span style="font-size: 0.78rem; color: #94A3B8;">Free Promotional vs Paid Subscription</span>
                    </div>
                </div>
                <button type="button" onclick="document.getElementById('platformModeModal').style.display='none'" style="background: none; border: none; color: white; font-size: 1.4rem; cursor: pointer;">&times;</button>
            </div>

            <form action="{{ route('admin.platform.mode') }}" method="POST" style="padding: 1.75rem;">
                @csrf
                <p style="color: var(--text-dark); font-size: 0.92rem; margin-bottom: 1.25rem; line-height: 1.5;">
                    প্ল্যাটফর্মটি বর্তমান অবস্থায় কীভাবে পরিচালিত হবে তা নির্ধারণ করুন:
                </p>

                <div style="display: flex; flex-direction: column; gap: 1rem; margin-bottom: 1.5rem;">
                    <label style="display: flex; align-items: flex-start; gap: 1rem; padding: 1rem; border: 2px solid {{ $isFreeMode ? '#10B981' : '#E2E8F0' }}; background: {{ $isFreeMode ? '#ECFDF5' : '#FFFFFF' }}; border-radius: 12px; cursor: pointer;">
                        <input type="radio" name="mode" value="free" {{ $isFreeMode ? 'checked' : '' }} style="margin-top: 0.25rem; accent-color: #059669; width: 18px; height: 18px;">
                        <div>
                            <strong style="color: #065F46; font-size: 1rem; display: block;">🟢 সম্পূর্ণ ফ্রি মোড (100% Free Promotional Mode)</strong>
                            <p style="color: #047857; font-size: 0.82rem; margin: 0.25rem 0 0 0; line-height: 1.4;">
                                সকল ভেরিফাইড এজেন্সির জন্য পোস্ট করা, যোগাযোগ দেখা এবং লেনদেন সম্পূর্ণ ফ্রি। কোনো সাবস্ক্রিপশন ফি বা পেমেন্ট গেটওয়ের সীমাবদ্ধতা থাকবে না।
                            </p>
                        </div>
                    </label>

                    <label style="display: flex; align-items: flex-start; gap: 1rem; padding: 1rem; border: 2px solid {{ !$isFreeMode ? '#F59E0B' : '#E2E8F0' }}; background: {{ !$isFreeMode ? '#FFFBEB' : '#FFFFFF' }}; border-radius: 12px; cursor: pointer;">
                        <input type="radio" name="mode" value="paid" {{ !$isFreeMode ? 'checked' : '' }} style="margin-top: 0.25rem; accent-color: #D97706; width: 18px; height: 18px;">
                        <div>
                            <strong style="color: #92400E; font-size: 1rem; display: block;">🟡 পেইড সাবস্ক্রিপশন মোড (Paid B2B Subscription Mode)</strong>
                            <p style="color: #78350F; font-size: 0.82rem; margin: 0.25rem 0 0 0; line-height: 1.4;">
                                এজেন্সিদের প্ল্যাটফর্মের প্রিমিয়াম সুবিধা ব্যবহারের জন্য বিকাশ, নগদ, রকেটে সাবস্ক্রিপশন ফি পরিশোধ করতে হবে এবং পেমেন্ট হিস্ট্রি সক্রিয় থাকবে।
                            </p>
                        </div>
                    </label>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 0.75rem;">
                    <button type="button" onclick="document.getElementById('platformModeModal').style.display='none'" class="btn-danger" style="background: #94A3B8; padding: 0.6rem 1.25rem;">
                        বাতিল
                    </button>
                    <button type="submit" class="btn-primary" style="padding: 0.6rem 1.5rem; font-weight: 700;">
                        <i class="fa-solid fa-floppy-disk me-1"></i> মোড সেভ করুন
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
