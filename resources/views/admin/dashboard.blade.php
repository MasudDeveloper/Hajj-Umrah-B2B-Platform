@extends('layouts.admin')

@section('title', 'Super Admin Governance Dashboard & Real-Time Analytics')

@section('content')
    <!-- Top Header Banner -->
    <div style="background: white; border-radius: 18px; padding: 2rem; border: 1px solid var(--border-color); box-shadow: 0 4px 20px rgba(0,0,0,0.04); margin-bottom: 2rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem;">
            <div>
                <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
                    <span class="badge" style="background: #FCE7F3; color: #831843; font-weight: 800;">
                        <i class="fa-solid fa-chart-pie me-1"></i> GOVERNANCE & ANALYTICS
                    </span>
                    <span class="badge" style="background: {{ \App\Models\SiteSetting::isFreeMode() ? '#D1FAE5' : '#FEF3C7' }}; color: {{ \App\Models\SiteSetting::isFreeMode() ? '#065F46' : '#92400E' }}; font-weight: 800;">
                        {{ \App\Models\SiteSetting::isFreeMode() ? '🟢 100% FREE MODE ACTIVE' : '🟡 PAID SUBSCRIPTION ACTIVE' }}
                    </span>
                </div>
                <h1 class="font-heading" style="font-size: 2.1rem; color: var(--admin-dark); margin: 0; line-height: 1.2;">
                    Super Admin Control Center
                </h1>
                <p style="color: var(--text-muted); font-size: 0.95rem; margin-top: 0.35rem;">
                    বাংলাদেশ হজ ও ওমরাহ B2B নেটওয়ার্কের রিয়েল-টাইম অডিট, লাইসেন্স ভেরিফিকেশন, ক্যাটাগরি শেয়ার এবং সার্বিক নিয়ন্ত্রণ ড্যাশবোর্ড।
                </p>
            </div>
            
            <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
                <button type="button" onclick="document.getElementById('platformModeModal').style.display='flex'" class="btn-primary" style="background: #0F172A; font-size: 0.88rem; padding: 0.65rem 1.25rem;">
                    <i class="fa-solid fa-sliders me-1"></i> মোড পরিবর্তন করুন
                </button>
                <a href="{{ route('admin.verifications') }}" class="btn-gold" style="font-size: 0.88rem; padding: 0.65rem 1.25rem;">
                    <i class="fa-solid fa-user-clock me-1"></i> ভেরিফিকেশন কিউ ({{ $totalPendingCount }})
                </a>
                <a href="{{ route('admin.agencies') }}" class="btn-primary" style="background: #0284C7; font-size: 0.88rem; padding: 0.65rem 1.25rem;">
                    <i class="fa-solid fa-building me-1"></i> এজেন্সি ডিরেক্টরি
                </a>
            </div>
        </div>
    </div>

    <!-- Quick Control Bar: Notice Ticker & Platform Monetization Mode -->
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
        <!-- 1. Notice Ticker Manager -->
        <div style="background: white; border-radius: 16px; padding: 1.5rem 1.75rem; border: 1px solid #FCD34D; box-shadow: 0 4px 15px rgba(212, 175, 55, 0.1);">
            <form action="{{ route('admin.notice.ticker') }}" method="POST">
                @csrf
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem; flex-wrap: wrap; gap: 0.5rem;">
                    <h3 style="font-size: 1.1rem; color: #78350F; font-weight: 800; display: flex; align-items: center; gap: 0.5rem; margin: 0;">
                        <i class="fa-solid fa-bullhorn text-amber-600"></i> হোমপেজ জরুরী নোটিশ বার (Notice Ticker)
                    </h3>
                    <label style="display: inline-flex; align-items: center; gap: 0.45rem; font-size: 0.85rem; font-weight: 700; color: #92400E; cursor: pointer;">
                        <input type="checkbox" name="notice_ticker_active" value="1" {{ \App\Models\SiteSetting::get('notice_ticker_active', '1') === '1' ? 'checked' : '' }} style="width: 17px; height: 17px; accent-color: #D97706;">
                        স্ক্রলিং নোটিশ চালু রাখুন
                    </label>
                </div>

                <div style="display: flex; gap: 0.75rem; align-items: center;">
                    <input type="text" name="notice_ticker_text" value="{{ \App\Models\SiteSetting::get('notice_ticker_text', '📢 জরুরী বিজ্ঞপ্তি: হজ ও ওমরাহ ২০২৬ নীতিমালার আওতায় সকল এজেন্সিকে ট্রেড লাইসেন্স ও হাব সনদ আপডেট করার বিনীত অনুরোধ করা হচ্ছে।') }}" placeholder="বিজ্ঞপ্তি লিখুন..." style="flex: 1; padding: 0.65rem 1rem; border: 1px solid #FDE68A; border-radius: 8px; font-size: 0.9rem; background: #FFFDF5; outline: none;">
                    <button type="submit" class="btn-gold" style="padding: 0.65rem 1.25rem; font-size: 0.88rem; flex-shrink: 0;">
                        <i class="fa-solid fa-floppy-disk me-1"></i> আপডেট করুন
                    </button>
                </div>
            </form>
        </div>

        <!-- 2. Platform Mode Card -->
        <div style="background: white; border-radius: 16px; padding: 1.5rem 1.75rem; border: 1px solid var(--border-color); box-shadow: 0 4px 15px rgba(0,0,0,0.03); display: flex; flex-direction: column; justify-content: space-between;">
            <div>
                <span style="font-size: 0.75rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase;">PLATFORM ACCESS STATE</span>
                <div style="display: flex; align-items: center; gap: 0.6rem; margin-top: 0.25rem;">
                    <h3 style="font-size: 1.2rem; font-weight: 800; color: {{ \App\Models\SiteSetting::isFreeMode() ? '#059669' : '#D97706' }}; margin: 0;">
                        {{ \App\Models\SiteSetting::isFreeMode() ? '🟢 100% Free Mode' : '🟡 Paid VIP Mode' }}
                    </h3>
                </div>
                <p style="font-size: 0.8rem; color: var(--text-muted); margin: 0.35rem 0 0 0;">
                    {{ \App\Models\SiteSetting::isFreeMode() ? 'সকল এজেন্সির জন্য পোস্ট ও যোগাযোগ সম্পূর্ণ ফ্রি।' : 'এজেন্সিদের সাবস্ক্রিপশন ফি দিয়ে ব্যবহার করতে হবে।' }}
                </p>
            </div>

            <div style="margin-top: 1rem;">
                <button type="button" onclick="document.getElementById('platformModeModal').style.display='flex'" class="btn-primary" style="width: 100%; justify-content: center; font-size: 0.82rem; padding: 0.5rem;">
                    <i class="fa-solid fa-rotate me-1"></i> মোড পরিবর্তন করুন
                </button>
            </div>
        </div>
    </div>

    @if($pendingReportsCount > 0)
        <div style="background: #FFF1F2; border: 1.5px solid #FDA4AF; border-radius: 14px; padding: 1.15rem 1.5rem; margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="width: 44px; height: 44px; border-radius: 50%; background: #FFE4E6; color: #E11D48; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <div>
                    <h4 style="margin: 0; font-size: 1.05rem; color: #9F1239; font-weight: 800;">
                        {{ $pendingReportsCount }} টি ডুপ্লিকেট বা ফেক সিটের অভিযোগ পর্যালোচনার অপেক্ষায় রয়েছে!
                    </h4>
                    <p style="margin: 0.15rem 0 0 0; font-size: 0.85rem; color: #BE123C;">
                        এজেন্সিগুলোর রিপোর্টের সত্যতা যাচাই করে অননুমোদিত পোস্ট বাতিল ও অভিযুক্ত এজেন্সিকে স্ট্রাইক দিন।
                    </p>
                </div>
            </div>
            <a href="{{ route('admin.reports') }}" class="btn-primary" style="background: #E11D48; border-radius: 8px; font-size: 0.88rem; font-weight: 700; text-decoration: none; padding: 0.6rem 1.25rem;">
                রিপোর্ট পর্যালোচনা করুন &rarr;
            </a>
        </div>
    @endif

    <!-- 6 Executive KPI Cards Grid -->
    <div style="display: grid; grid-template-columns: repeat(6, 1fr); gap: 1rem; margin-bottom: 2.25rem;" class="admin-kpi-grid">
        <!-- 1 -->
        <div style="background: white; padding: 1.25rem; border-radius: 16px; border: 1px solid var(--border-color); box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                <span style="font-size: 0.78rem; color: var(--text-muted); font-weight: 700;">TOTAL AGENCIES</span>
                <div style="width: 36px; height: 36px; background: #F1F5F9; color: var(--admin-dark); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1rem;">
                    <i class="fa-solid fa-building"></i>
                </div>
            </div>
            <strong style="font-size: 1.85rem; color: var(--admin-dark); display: block; line-height: 1.1;">{{ $totalAgencies }}</strong>
            <span style="font-size: 0.72rem; color: #059669; font-weight: 600;"><i class="fa-solid fa-users"></i> Registered</span>
        </div>

        <!-- 2 -->
        <div style="background: white; padding: 1.25rem; border-radius: 16px; border: 1px solid var(--border-color); box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                <span style="font-size: 0.78rem; color: #B45309; font-weight: 700;">PENDING QUEUE</span>
                <div style="width: 36px; height: 36px; background: #FEF3C7; color: #D97706; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1rem;">
                    <i class="fa-solid fa-user-clock"></i>
                </div>
            </div>
            <strong style="font-size: 1.85rem; color: #D97706; display: block; line-height: 1.1;">{{ $totalPendingCount }}</strong>
            <span style="font-size: 0.72rem; color: #B45309; font-weight: 600;">Needs Verification</span>
        </div>

        <!-- 3 -->
        <div style="background: white; padding: 1.25rem; border-radius: 16px; border: 1px solid var(--border-color); box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                <span style="font-size: 0.78rem; color: #065F46; font-weight: 700;">VERIFIED MEMBERS</span>
                <div style="width: 36px; height: 36px; background: #ECFDF5; color: #047857; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1rem;">
                    <i class="fa-solid fa-shield-check"></i>
                </div>
            </div>
            <strong style="font-size: 1.85rem; color: #047857; display: block; line-height: 1.1;">{{ $totalVerifiedCount }}</strong>
            <span style="font-size: 0.72rem; color: #059669; font-weight: 600;">Gov & HAAB Verified</span>
        </div>

        <!-- 4 -->
        <div style="background: white; padding: 1.25rem; border-radius: 16px; border: 1px solid var(--border-color); box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                <span style="font-size: 0.78rem; color: #075985; font-weight: 700;">ACTIVE B2B POSTS</span>
                <div style="width: 36px; height: 36px; background: #E0F2FE; color: #0284C7; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1rem;">
                    <i class="fa-solid fa-layer-group"></i>
                </div>
            </div>
            <strong style="font-size: 1.85rem; color: #0284C7; display: block; line-height: 1.1;">{{ $totalPostsCount }}</strong>
            <span style="font-size: 0.72rem; color: #0284C7; font-weight: 600;">Live Marketplace</span>
        </div>

        <!-- 5 -->
        <div style="background: white; padding: 1.25rem; border-radius: 16px; border: 1px solid var(--border-color); box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                <span style="font-size: 0.78rem; color: #5B21B6; font-weight: 700;">COMPLETED DEALS</span>
                <div style="width: 36px; height: 36px; background: #F3E8FF; color: #7C3AED; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1rem;">
                    <i class="fa-solid fa-handshake"></i>
                </div>
            </div>
            <strong style="font-size: 1.85rem; color: #7C3AED; display: block; line-height: 1.1;">{{ $totalCompletedDeals }}</strong>
            <span style="font-size: 0.72rem; color: #7C3AED; font-weight: 600;">Signed Contracts</span>
        </div>

        <!-- 6 -->
        <div style="background: white; padding: 1.25rem; border-radius: 16px; border: 1px solid var(--border-color); box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                <span style="font-size: 0.78rem; color: #1E3A8A; font-weight: 700;">TOTAL REVENUE</span>
                <div style="width: 36px; height: 36px; background: #EEF2FF; color: #4F46E5; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1rem;">
                    <i class="fa-solid fa-coins"></i>
                </div>
            </div>
            <strong style="font-size: 1.55rem; color: #4F46E5; display: block; line-height: 1.2;">৳{{ number_format($totalRevenue) }}</strong>
            <span style="font-size: 0.72rem; color: #4F46E5; font-weight: 600;">Approved Subscriptions</span>
        </div>
    </div>

    <!-- Chart.js Advanced Visual Analytics Grid -->
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; margin-bottom: 2.5rem;">
        
        <!-- Chart 1: Verification Status Doughnut -->
        <div style="background: white; border-radius: 18px; padding: 1.75rem; border: 1px solid var(--border-color); box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
            <h3 class="font-heading" style="font-size: 1.15rem; color: var(--admin-dark); margin-bottom: 1rem; display: flex; justify-content: space-between; align-items: center;">
                <span><i class="fa-solid fa-shield-halved text-emerald-600 me-2"></i> ভেরিফিকেশন অনুপাত</span>
                <span style="font-size: 0.75rem; color: var(--text-muted); font-weight: 600;">Status Ratio</span>
            </h3>
            <div style="position: relative; height: 210px; display: flex; align-items: center; justify-content: center;">
                <canvas id="verificationDoughnutChart"></canvas>
            </div>
            <div style="display: flex; justify-content: space-around; margin-top: 1rem; font-size: 0.8rem; border-top: 1px solid #F1F5F9; padding-top: 0.75rem;">
                <span style="color: #059669; font-weight: 700;">● Approved: {{ $verificationChart['approved'] }}</span>
                <span style="color: #D97706; font-weight: 700;">● Pending: {{ $verificationChart['pending'] }}</span>
                <span style="color: #DC2626; font-weight: 700;">● Rejected: {{ $verificationChart['rejected'] }}</span>
            </div>
        </div>

        <!-- Chart 2: Post Category Distribution -->
        <div style="background: white; border-radius: 18px; padding: 1.75rem; border: 1px solid var(--border-color); box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
            <h3 class="font-heading" style="font-size: 1.15rem; color: var(--admin-dark); margin-bottom: 1rem; display: flex; justify-content: space-between; align-items: center;">
                <span><i class="fa-solid fa-chart-pie text-indigo-600 me-2"></i> ক্যাটাগরি শেয়ারিং</span>
                <span style="font-size: 0.75rem; color: var(--text-muted); font-weight: 600;">Inventory Share</span>
            </h3>
            <div style="position: relative; height: 210px; display: flex; align-items: center; justify-content: center;">
                <canvas id="categoryPieChart"></canvas>
            </div>
            <div style="display: flex; justify-content: space-around; margin-top: 1rem; font-size: 0.8rem; border-top: 1px solid #F1F5F9; padding-top: 0.75rem;">
                <span style="color: #4F46E5; font-weight: 700;">● Seats: {{ $categoryChart['group_seats'] }}</span>
                <span style="color: #0284C7; font-weight: 700;">● Tickets: {{ $categoryChart['ticket_only'] }}</span>
                <span style="color: #D97706; font-weight: 700;">● Hotels: {{ $categoryChart['hotel_share'] }}</span>
            </div>
        </div>

        <!-- Chart 3: Division & District Agency Distribution -->
        <div style="background: white; border-radius: 18px; padding: 1.75rem; border: 1px solid var(--border-color); box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
            <h3 class="font-heading" style="font-size: 1.15rem; color: var(--admin-dark); margin-bottom: 1rem; display: flex; justify-content: space-between; align-items: center;">
                <span><i class="fa-solid fa-map-location-dot text-emerald-600 me-2"></i> বিভাগ ও জেলা ভিত্তিক এজেন্সি</span>
                <span style="font-size: 0.75rem; color: var(--text-muted); font-weight: 600;">Divisions / Districts</span>
            </h3>
            <div style="position: relative; height: 210px; display: flex; align-items: center; justify-content: center;">
                <canvas id="cityBarChart"></canvas>
            </div>
            <div style="display: flex; justify-content: space-between; flex-wrap: wrap; gap: 0.5rem; margin-top: 1rem; font-size: 0.78rem; border-top: 1px solid #F1F5F9; padding-top: 0.75rem;">
                <span style="color: #044E35; font-weight: 700;">ঢাকা: {{ $cityChart['Dhaka'] ?? 0 }}</span>
                <span style="color: #0284C7; font-weight: 700;">চট্টগ্রাম: {{ $cityChart['Chittagong'] ?? 0 }}</span>
                <span style="color: #7C3AED; font-weight: 700;">সিলেট: {{ $cityChart['Sylhet'] ?? 0 }}</span>
                <span style="color: #D97706; font-weight: 700;">রাজশাহী: {{ $cityChart['Rajshahi'] ?? 0 }}</span>
                <span style="color: #059669; font-weight: 700;">অন্যান্য: {{ ($cityChart['Khulna'] ?? 0) + ($cityChart['Barisal'] ?? 0) + ($cityChart['Rangpur'] ?? 0) + ($cityChart['Mymensingh'] ?? 0) }}</span>
            </div>
        </div>
    </div>

    <!-- Recent Registrations & Active Posts Split Tables -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
        <!-- Recent Agency Registrations -->
        <div style="background: white; border-radius: 18px; padding: 1.75rem; border: 1px solid var(--border-color); box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
                <h3 class="font-heading" style="font-size: 1.2rem; color: var(--admin-dark); margin: 0;">
                    <i class="fa-solid fa-building me-2 text-emerald-600"></i> সাম্প্রতিক এজেন্সিসমূহ
                </h3>
                <a href="{{ route('admin.agencies') }}" style="font-size: 0.82rem; color: var(--admin-primary); font-weight: 700; text-decoration: none;">
                    সবগুলো দেখুন &rarr;
                </a>
            </div>

            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; font-size: 0.88rem;">
                    <thead>
                        <tr style="border-bottom: 2px solid #F1F5F9; color: var(--text-muted); text-align: left;">
                            <th style="padding: 0.65rem 0.5rem;">Agency</th>
                            <th style="padding: 0.65rem 0.5rem;">License</th>
                            <th style="padding: 0.65rem 0.5rem;">Status</th>
                            <th style="padding: 0.65rem 0.5rem; text-align: right;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentRegistrations as $ag)
                            <tr style="border-bottom: 1px solid #F8FAFC;">
                                <td style="padding: 0.75rem 0.5rem;">
                                    <strong style="color: var(--admin-dark); display: block;">{{ $ag->agency_name }}</strong>
                                    <span style="font-size: 0.75rem; color: var(--text-muted);">{{ $ag->city }}</span>
                                </td>
                                <td style="padding: 0.75rem 0.5rem; font-size: 0.82rem; color: #475569;">
                                    {{ $ag->license_no }}
                                </td>
                                <td style="padding: 0.75rem 0.5rem;">
                                    <span class="badge" style="background: {{ $ag->verification_status === 'approved' ? '#D1FAE5' : ($ag->verification_status === 'pending' ? '#FEF3C7' : '#FEE2E2') }}; color: {{ $ag->verification_status === 'approved' ? '#065F46' : ($ag->verification_status === 'pending' ? '#92400E' : '#991B1B') }}; font-size: 0.7rem;">
                                        {{ strtoupper($ag->verification_status) }}
                                    </span>
                                </td>
                                <td style="padding: 0.75rem 0.5rem; text-align: right;">
                                    <a href="{{ route('agencies.show', $ag->id) }}" target="_blank" class="btn-primary" style="padding: 0.35rem 0.7rem; font-size: 0.75rem; background: #0284C7;">
                                        প্রোফাইল
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent B2B Posts -->
        <div style="background: white; border-radius: 18px; padding: 1.75rem; border: 1px solid var(--border-color); box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
                <h3 class="font-heading" style="font-size: 1.2rem; color: var(--admin-dark); margin: 0;">
                    <i class="fa-solid fa-ticket me-2 text-indigo-600"></i> সাম্প্রতিক মার্কেটপ্লেস পোস্ট
                </h3>
                <a href="{{ route('posts.index') }}" target="_blank" style="font-size: 0.82rem; color: var(--admin-primary); font-weight: 700; text-decoration: none;">
                    মার্কেটপ্লেস খুলুন &rarr;
                </a>
            </div>

            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; font-size: 0.88rem;">
                    <thead>
                        <tr style="border-bottom: 2px solid #F1F5F9; color: var(--text-muted); text-align: left;">
                            <th style="padding: 0.65rem 0.5rem;">Title</th>
                            <th style="padding: 0.65rem 0.5rem;">Seats / Rate</th>
                            <th style="padding: 0.65rem 0.5rem;">Posting Agency</th>
                            <th style="padding: 0.65rem 0.5rem; text-align: right;">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentPosts as $p)
                            <tr style="border-bottom: 1px solid #F8FAFC;">
                                <td style="padding: 0.75rem 0.5rem;">
                                    <strong style="color: var(--admin-dark); display: block; max-width: 180px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                        {{ $p->title }}
                                    </strong>
                                    <span style="font-size: 0.72rem; color: #059669; font-weight: 700;">{{ strtoupper($p->hajj_or_umrah ?? 'UMRAH') }}</span>
                                </td>
                                <td style="padding: 0.75rem 0.5rem; font-size: 0.82rem;">
                                    <strong style="color: #DC2626;">{{ $p->available_seats }} Pax</strong><br>
                                    <span style="color: var(--text-muted);">৳{{ number_format($p->price_per_seat) }}</span>
                                </td>
                                <td style="padding: 0.75rem 0.5rem; font-size: 0.82rem; color: #475569;">
                                    {{ $p->agency->agency_name ?? 'N/A' }}
                                </td>
                                <td style="padding: 0.75rem 0.5rem; text-align: right;">
                                    <a href="{{ route('posts.show', $p->id) }}" target="_blank" class="btn-primary" style="padding: 0.35rem 0.7rem; font-size: 0.75rem; background: #044E35;">
                                        দেখুন
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Chart.js Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Chart 1: Verification Doughnut
            const ctxVerif = document.getElementById('verificationDoughnutChart').getContext('2d');
            new Chart(ctxVerif, {
                type: 'doughnut',
                data: {
                    labels: ['Approved', 'Pending', 'Rejected'],
                    datasets: [{
                        data: [{{ $verificationChart['approved'] }}, {{ $verificationChart['pending'] }}, {{ $verificationChart['rejected'] }}],
                        backgroundColor: ['#059669', '#F59E0B', '#DC2626'],
                        borderWidth: 0,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    cutout: '72%'
                }
            });

            // Chart 2: Category Pie
            const ctxCat = document.getElementById('categoryPieChart').getContext('2d');
            new Chart(ctxCat, {
                type: 'doughnut',
                data: {
                    labels: ['Group Seats', 'Ticket Only', 'Hotel Share'],
                    datasets: [{
                        data: [{{ $categoryChart['group_seats'] }}, {{ $categoryChart['ticket_only'] }}, {{ $categoryChart['hotel_share'] }}],
                        backgroundColor: ['#4F46E5', '#0284C7', '#D97706'],
                        borderWidth: 0,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    cutout: '72%'
                }
            });

            // Chart 3: Division & District Agency Bar
            const ctxCity = document.getElementById('cityBarChart').getContext('2d');
            new Chart(ctxCity, {
                type: 'bar',
                data: {
                    labels: ['ঢাকা', 'চট্টগ্রাম', 'সিলেট', 'রাজশাহী', 'খুলনা', 'বরিশাল', 'রংপুর', 'ময়মনসিংহ'],
                    datasets: [{
                        label: 'এজেন্সি সংখ্যা',
                        data: [
                            {{ $cityChart['Dhaka'] ?? 0 }},
                            {{ $cityChart['Chittagong'] ?? 0 }},
                            {{ $cityChart['Sylhet'] ?? 0 }},
                            {{ $cityChart['Rajshahi'] ?? 0 }},
                            {{ $cityChart['Khulna'] ?? 0 }},
                            {{ $cityChart['Barisal'] ?? 0 }},
                            {{ $cityChart['Rangpur'] ?? 0 }},
                            {{ $cityChart['Mymensingh'] ?? 0 }}
                        ],
                        backgroundColor: [
                            '#044E35', '#0284C7', '#7C3AED', '#D97706',
                            '#059669', '#E11D48', '#2563EB', '#475569'
                        ],
                        borderRadius: 6,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: { beginAtZero: true, ticks: { precision: 0 }, grid: { color: '#F1F5F9' } },
                        x: { grid: { display: false } }
                    }
                }
            });
        });
    </script>
@endsection
