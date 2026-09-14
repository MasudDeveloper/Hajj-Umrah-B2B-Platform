<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Super Admin Control Center - Hajj & Umrah B2B')</title>
    
    <!-- Fonts: Outfit & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --admin-dark: #0F172A;
            --admin-sidebar: #1E293B;
            --admin-primary: #044E35;
            --admin-accent: #D4AF37;
            --admin-bg: #F8FAFC;
            --text-main: #0F172A;
            --text-muted: #64748B;
            --border-color: #E2E8F0;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--admin-bg);
            color: var(--text-main);
            display: flex;
            min-height: 100vh;
        }

        h1, h2, h3, h4, h5, h6, .font-heading { font-family: 'Outfit', sans-serif; }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background-color: var(--admin-sidebar);
            color: white;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; bottom: 0; left: 0;
            z-index: 100;
        }

        .sidebar-brand {
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            text-decoration: none;
            color: white;
        }

        .sidebar-brand-icon {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, var(--admin-accent), #B38F22);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: var(--admin-dark); font-size: 1.2rem; font-weight: 800;
        }

        .sidebar-menu {
            list-style: none;
            padding: 1.25rem 0.75rem;
            flex: 1;
        }

        .sidebar-menu li { margin-bottom: 0.35rem; }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: #CBD5E1;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .sidebar-menu a:hover, .sidebar-menu a.active {
            background-color: rgba(212, 175, 55, 0.15);
            color: var(--admin-accent);
        }

        /* Top Admin Nav */
        .admin-main {
            margin-left: 260px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .admin-header {
            background: white;
            height: 70px;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border-color);
            position: sticky; top: 0; z-index: 90;
        }

        .admin-content {
            padding: 2rem;
            flex: 1;
        }

        .badge {
            display: inline-flex; align-items: center; gap: 0.3rem;
            padding: 0.25rem 0.6rem; border-radius: 20px;
            font-size: 0.75rem; font-weight: 700; text-transform: uppercase;
        }

        .btn-gold {
            background: linear-gradient(135deg, var(--admin-accent), #C49C2C);
            color: var(--admin-dark); font-weight: 700; padding: 0.5rem 1rem;
            border-radius: 8px; text-decoration: none; border: none; cursor: pointer;
        }

        .btn-success {
            background: #059669; color: white; border: none; padding: 0.4rem 0.8rem;
            border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 0.8rem;
        }

        .btn-danger {
            background: #DC2626; color: white; border: none; padding: 0.4rem 0.8rem;
            border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 0.8rem;
        }
    </style>
</head>
<body>

    <!-- Dedicated Super Admin Sidebar -->
    <aside class="sidebar">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
            <div class="sidebar-brand-icon">
                <i class="fa-solid fa-kaaba"></i>
            </div>
            <div>
                <h3 style="font-size: 1.1rem; line-height: 1.1;">Admin Center</h3>
                <span style="font-size: 0.7rem; color: var(--admin-accent); text-transform: uppercase; letter-spacing: 0.5px;">B2B Governance</span>
            </div>
        </a>

        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="active">
                    <i class="fa-solid fa-gauge-high"></i> Dashboard & Approvals
                </a>
            </li>
            <li>
                <a href="{{ route('posts.index') }}" target="_blank">
                    <i class="fa-solid fa-globe"></i> View Live B2B Site
                </a>
            </li>
            <li>
                <a href="{{ route('home') }}">
                    <i class="fa-solid fa-house"></i> Main Platform Home
                </a>
            </li>
        </ul>

        <div style="padding: 1.25rem; border-top: 1px solid rgba(255,255,255,0.1); font-size: 0.8rem; color: #94A3B8;">
            <p><i class="fa-solid fa-user-shield text-amber-400 me-1"></i> Logged in as:</p>
            <strong style="color: white;">Super Admin</strong>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="admin-main">
        <header class="admin-header">
            <div>
                <h3 class="font-heading" style="color: var(--admin-dark);">Ministry & HAAB B2B Super Admin Panel</h3>
            </div>

            <div style="display: flex; align-items: center; gap: 1rem;">
                <a href="{{ route('quick.switch', 2) }}" style="font-size: 0.85rem; color: var(--admin-primary); text-decoration: none; font-weight: 600;">
                    <i class="fa-solid fa-rotate me-1"></i> Switch to R.B Tours User View
                </a>
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn-gold" style="padding: 0.4rem 0.85rem; font-size: 0.85rem;">
                        <i class="fa-solid fa-right-from-bracket me-1"></i> Logout
                    </button>
                </form>
            </div>
        </header>

        <main class="admin-content">
            @if(session('success'))
                <div style="background: #ECFDF5; border-left: 4px solid #10B981; color: #065F46; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem;">
                    <i class="fa-solid fa-circle-check fa-lg"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

</body>
</html>
