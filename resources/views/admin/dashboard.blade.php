@extends('layouts.admin')

@section('title', 'Super Admin Overview & Analytics Dashboard')

@section('content')
    <!-- Top Header Banner -->
    <div style="background: white; border-radius: 16px; padding: 2rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); margin-bottom: 2rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
            <div>
                <span class="badge" style="background: #FCE7F3; color: #831843; margin-bottom: 0.5rem;"><i class="fa-solid fa-chart-pie me-1"></i> Governance Analytics</span>
                <h1 class="font-heading" style="font-size: 2rem; color: var(--admin-dark);">Super Admin Control Dashboard</h1>
                <p style="color: var(--text-muted); font-size: 0.95rem;">Real-time platform metrics, agency verification breakdowns, category share analytics, and recent network activity.</p>
            </div>
            
            <div style="display: flex; gap: 0.75rem;">
                <a href="{{ route('admin.verifications') }}" class="btn-gold" style="font-size: 0.9rem; padding: 0.65rem 1.25rem;">
                    <i class="fa-solid fa-user-clock me-1"></i> Verification Queue ({{ $totalPendingCount }})
                </a>
                <a href="{{ route('admin.agencies') }}" class="btn-primary" style="background: #0284C7; font-size: 0.9rem; padding: 0.65rem 1.25rem;">
                    <i class="fa-solid fa-building me-1"></i> Agency Directory
                </a>
            </div>
        </div>
    </div>

    <!-- Admin Site Announcement Marquee Control Box -->
    <div style="background: white; border-radius: 16px; padding: 1.5rem 2rem; border: 1px solid #FCD34D; box-shadow: 0 4px 15px rgba(212, 175, 55, 0.12); margin-bottom: 2rem;">
        <form action="{{ route('admin.notice.ticker') }}" method="POST">
            @csrf
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; flex-wrap: wrap; gap: 0.5rem;">
                <h3 style="font-size: 1.15rem; color: #78350F; font-weight: 800; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-bullhorn text-amber-600"></i> Homepage Notice Ticker Manager (জরুরী নোটিশ বার)
                </h3>
                <label style="display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.88rem; font-weight: 700; color: #92400E; cursor: pointer;">
                    <input type="checkbox" name="notice_ticker_active" value="1" {{ \App\Models\SiteSetting::get('notice_ticker_active', '1') === '1' ? 'checked' : '' }} style="width: 18px; height: 18px; accent-color: #D97706;">
                    Enable Scrolling Notice Bar
                </label>
            </div>

            <div style="display: flex; gap: 1rem; align-items: center;">
                <input type="text" name="notice_ticker_text" value="{{ \App\Models\SiteSetting::get('notice_ticker_text', '📢 জরুরী বিজ্ঞপ্তি: হজ ও ওমরাহ ২০২৬ নীতিমালার আওতায় সকল এজেন্সিকে ট্রেড লাইসেন্স ও হাব সনদ আপডেট করার বিনীত অনুরোধ করা হচ্ছে।') }}" placeholder="Enter announcement text to scroll on top header..." style="flex: 1; padding: 0.75rem 1rem; border: 1px solid #FDE68A; border-radius: 8px; font-size: 0.92rem; background: #FFFDF5;">
                <button type="submit" class="btn-gold" style="padding: 0.75rem 1.5rem; font-size: 0.9rem; flex-shrink: 0;">
                    <i class="fa-solid fa-floppy-disk me-1"></i> Update Notice Ticker
                </button>
            </div>
        </form>
    </div>

    <!-- KPI Metric Cards -->
    <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 1rem; margin-bottom: 2.5rem;">
        <div style="background: white; padding: 1.25rem; border-radius: 14px; border: 1px solid var(--border-color); display: flex; align-items: center; justify-content: space-between; box-shadow: var(--shadow-sm);">
            <div>
                <span style="font-size: 0.78rem; color: var(--text-muted); display: block;">Total Registered</span>
                <strong style="font-size: 1.85rem; color: var(--admin-dark);">{{ $totalAgencies }}</strong>
            </div>
            <div style="width: 46px; height: 46px; background: #F1F5F9; color: var(--admin-dark); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.35rem;">
                <i class="fa-solid fa-building"></i>
            </div>
        </div>

        <div style="background: white; padding: 1.25rem; border-radius: 14px; border: 1px solid var(--border-color); display: flex; align-items: center; justify-content: space-between; box-shadow: var(--shadow-sm);">
            <div>
                <span style="font-size: 0.78rem; color: var(--text-muted); display: block;">Pending Review</span>
                <strong style="font-size: 1.85rem; color: #D97706;">{{ $totalPendingCount }}</strong>
            </div>
            <div style="width: 46px; height: 46px; background: #FEF3C7; color: #D97706; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.35rem;">
                <i class="fa-solid fa-clock-rotate-left"></i>
            </div>
        </div>

        <div style="background: white; padding: 1.25rem; border-radius: 14px; border: 1px solid var(--border-color); display: flex; align-items: center; justify-content: space-between; box-shadow: var(--shadow-sm);">
            <div>
                <span style="font-size: 0.78rem; color: var(--text-muted); display: block;">Approved Verified</span>
                <strong style="font-size: 1.85rem; color: #047857;">{{ $totalVerifiedCount }}</strong>
            </div>
            <div style="width: 46px; height: 46px; background: #ECFDF5; color: #047857; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.35rem;">
                <i class="fa-solid fa-shield-check"></i>
            </div>
        </div>

        <div style="background: white; padding: 1.25rem; border-radius: 14px; border: 1px solid var(--border-color); display: flex; align-items: center; justify-content: space-between; box-shadow: var(--shadow-sm);">
            <div>
                <span style="font-size: 0.78rem; color: var(--text-muted); display: block;">Active B2B Posts</span>
                <strong style="font-size: 1.85rem; color: #0284C7;">{{ $totalPostsCount }}</strong>
            </div>
            <div style="width: 46px; height: 46px; background: #E0F2FE; color: #0284C7; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.35rem;">
                <i class="fa-solid fa-layer-group"></i>
            </div>
        </div>

        <div style="background: white; padding: 1.25rem; border-radius: 14px; border: 1px solid var(--border-color); display: flex; align-items: center; justify-content: space-between; box-shadow: var(--shadow-sm);">
            <div>
                <span style="font-size: 0.78rem; color: var(--text-muted); display: block;">Total B2B Leads</span>
                <strong style="font-size: 1.85rem; color: #7C3AED;">{{ $totalInquiriesCount }}</strong>
            </div>
            <div style="width: 46px; height: 46px; background: #F3E8FF; color: #7C3AED; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.35rem;">
                <i class="fa-solid fa-handshake"></i>
            </div>
        </div>
    </div>

    <!-- Visual Analytics Distribution Charts Grid -->
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; margin-bottom: 2.5rem;">
        
        <!-- Chart 1: Verification Status Distribution -->
        <div style="background: white; border-radius: 16px; padding: 1.5rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm);">
            <h3 class="font-heading" style="font-size: 1.15rem; color: var(--admin-dark); margin-bottom: 1.25rem; display: flex; justify-content: space-between; align-items: center;">
                <span><i class="fa-solid fa-shield-halved text-emerald-600 me-2"></i> Verification Ratio</span>
                <span style="font-size: 0.78rem; color: var(--text-muted); font-weight: normal;">Status Shares</span>
            </h3>

            @php
                $totalAg = max($totalAgencies, 1);
                $approvedPct = round(($verificationChart['approved'] / $totalAg) * 100);
                $pendingPct = round(($verificationChart['pending'] / $totalAg) * 100);
                $rejectedPct = round(($verificationChart['rejected'] / $totalAg) * 100);
            @endphp

            <!-- Progress Bar Visualization -->
            <div style="height: 14px; background: #E2E8F0; border-radius: 10px; overflow: hidden; display: flex; margin-bottom: 1.5rem;">
                <div style="width: {{ $approvedPct }}%; background: #059669;" title="Approved: {{ $verificationChart['approved'] }}"></div>
                <div style="width: {{ $pendingPct }}%; background: #D97706;" title="Pending: {{ $verificationChart['pending'] }}"></div>
                <div style="width: {{ $rejectedPct }}%; background: #DC2626;" title="Rejected: {{ $verificationChart['rejected'] }}"></div>
            </div>

            <div style="display: flex; flex-direction: column; gap: 0.75rem; font-size: 0.88rem;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="display: flex; align-items: center; gap: 0.5rem;"><span style="width: 10px; height: 10px; border-radius: 50%; background: #059669;"></span> Approved Agencies</span>
                    <strong style="color: #059669;">{{ $verificationChart['approved'] }} ({{ $approvedPct }}%)</strong>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="display: flex; align-items: center; gap: 0.5rem;"><span style="width: 10px; height: 10px; border-radius: 50%; background: #D97706;"></span> Pending Queue</span>
                    <strong style="color: #D97706;">{{ $verificationChart['pending'] }} ({{ $pendingPct }}%)</strong>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="display: flex; align-items: center; gap: 0.5rem;"><span style="width: 10px; height: 10px; border-radius: 50%; background: #DC2626;"></span> Rejected Applications</span>
                    <strong style="color: #DC2626;">{{ $verificationChart['rejected'] }} ({{ $rejectedPct }}%)</strong>
                </div>
            </div>
        </div>

        <!-- Chart 2: Category Breakdown -->
        <div style="background: white; border-radius: 16px; padding: 1.5rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm);">
            <h3 class="font-heading" style="font-size: 1.15rem; color: var(--admin-dark); margin-bottom: 1.25rem; display: flex; justify-content: space-between; align-items: center;">
                <span><i class="fa-solid fa-layer-group text-blue-600 me-2"></i> B2B Category Share</span>
                <span style="font-size: 0.78rem; color: var(--text-muted); font-weight: normal;">Post Shares</span>
            </h3>

            @php
                $totalP = max($totalPostsCount, 1);
                $groupPct = round(($categoryChart['group_seats'] / $totalP) * 100);
                $ticketPct = round(($categoryChart['ticket_only'] / $totalP) * 100);
                $hotelPct = round(($categoryChart['hotel_share'] / $totalP) * 100);
            @endphp

            <div style="height: 14px; background: #E2E8F0; border-radius: 10px; overflow: hidden; display: flex; margin-bottom: 1.5rem;">
                <div style="width: {{ $groupPct }}%; background: #044E35;" title="Group Seats"></div>
                <div style="width: {{ $ticketPct }}%; background: #0284C7;" title="Ticket Only"></div>
                <div style="width: {{ $hotelPct }}%; background: #D4AF37;" title="Hotel Share"></div>
            </div>

            <div style="display: flex; flex-direction: column; gap: 0.75rem; font-size: 0.88rem;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="display: flex; align-items: center; gap: 0.5rem;"><span style="width: 10px; height: 10px; border-radius: 50%; background: #044E35;"></span> Group Seats</span>
                    <strong style="color: #044E35;">{{ $categoryChart['group_seats'] }} ({{ $groupPct }}%)</strong>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="display: flex; align-items: center; gap: 0.5rem;"><span style="width: 10px; height: 10px; border-radius: 50%; background: #0284C7;"></span> Flight Tickets</span>
                    <strong style="color: #0284C7;">{{ $categoryChart['ticket_only'] }} ({{ $ticketPct }}%)</strong>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="display: flex; align-items: center; gap: 0.5rem;"><span style="width: 10px; height: 10px; border-radius: 50%; background: #D4AF37;"></span> Hotel Sharing</span>
                    <strong style="color: #B45309;">{{ $categoryChart['hotel_share'] }} ({{ $hotelPct }}%)</strong>
                </div>
            </div>
        </div>

        <!-- Chart 3: City Hub Distribution -->
        <div style="background: white; border-radius: 16px; padding: 1.5rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm);">
            <h3 class="font-heading" style="font-size: 1.15rem; color: var(--admin-dark); margin-bottom: 1.25rem; display: flex; justify-content: space-between; align-items: center;">
                <span><i class="fa-solid fa-city text-amber-600 me-2"></i> Regional City Hubs</span>
                <span style="font-size: 0.78rem; color: var(--text-muted); font-weight: normal;">Agency Locations</span>
            </h3>

            <div style="display: flex; flex-direction: column; gap: 0.85rem; font-size: 0.88rem;">
                <div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.25rem;">
                        <span>Dhaka Hub</span>
                        <strong>{{ $cityChart['Dhaka'] }} Agencies</strong>
                    </div>
                    <div style="height: 6px; background: #E2E8F0; border-radius: 4px; overflow: hidden;">
                        <div style="width: {{ round(($cityChart['Dhaka'] / $totalAg) * 100) }}%; height: 100%; background: #047857;"></div>
                    </div>
                </div>

                <div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.25rem;">
                        <span>Chittagong Hub</span>
                        <strong>{{ $cityChart['Chittagong'] }} Agencies</strong>
                    </div>
                    <div style="height: 6px; background: #E2E8F0; border-radius: 4px; overflow: hidden;">
                        <div style="width: {{ round(($cityChart['Chittagong'] / $totalAg) * 100) }}%; height: 100%; background: #0284C7;"></div>
                    </div>
                </div>

                <div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.25rem;">
                        <span>Sylhet Hub</span>
                        <strong>{{ $cityChart['Sylhet'] }} Agencies</strong>
                    </div>
                    <div style="height: 6px; background: #E2E8F0; border-radius: 4px; overflow: hidden;">
                        <div style="width: {{ round(($cityChart['Sylhet'] / $totalAg) * 100) }}%; height: 100%; background: #D97706;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Grids: Recent Registrations & Marketplace Feed -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
        
        <!-- Widget 1: Recent Agency Registrations -->
        <div style="background: white; border-radius: 16px; padding: 1.5rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
                <h3 class="font-heading" style="font-size: 1.15rem; color: var(--admin-dark);">
                    <i class="fa-solid fa-user-plus text-emerald-600 me-2"></i> Recent Agency Registrations
                </h3>
                <a href="{{ route('admin.agencies') }}" style="font-size: 0.8rem; color: var(--admin-primary); font-weight: 700; text-decoration: none;">View All Directory &rarr;</a>
            </div>

            <div style="display: flex; flex-direction: column; gap: 0.85rem;">
                @foreach($recentRegistrations as $reg)
                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem; background: #F8FAFC; border-radius: 10px; border: 1px solid var(--border-color);">
                        <div>
                            <strong style="display: block; font-size: 0.9rem; color: var(--admin-dark);">{{ $reg->agency_name }}</strong>
                            <span style="font-size: 0.78rem; color: var(--text-muted);">{{ $reg->formatted_license_display }} | {{ $reg->city }}</span>
                        </div>
                        <span class="badge" style="background: {{ $reg->isApproved() ? '#D1FAE5' : '#FEF3C7' }}; color: {{ $reg->isApproved() ? '#065F46' : '#92400E' }}; font-size: 0.75rem;">
                            {{ ucfirst($reg->verification_status) }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Widget 2: Recent B2B Posts Feed -->
        <div style="background: white; border-radius: 16px; padding: 1.5rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
                <h3 class="font-heading" style="font-size: 1.15rem; color: var(--admin-dark);">
                    <i class="fa-solid fa-list-check text-blue-600 me-2"></i> Recent B2B Listings Feed
                </h3>
                <a href="{{ route('posts.index') }}" target="_blank" style="font-size: 0.8rem; color: var(--admin-primary); font-weight: 700; text-decoration: none;">Explore Live Site &rarr;</a>
            </div>

            <div style="display: flex; flex-direction: column; gap: 0.85rem;">
                @foreach($recentPosts as $p)
                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem; background: #F8FAFC; border-radius: 10px; border: 1px solid var(--border-color);">
                        <div>
                            <strong style="display: block; font-size: 0.88rem; color: var(--admin-dark);">{{ $p->title }}</strong>
                            <span style="font-size: 0.78rem; color: var(--text-muted);">By {{ $p->agency->agency_name }} • {{ $p->created_at->diffForHumans() }}</span>
                        </div>
                        <span class="badge" style="background: #E0F2FE; color: #0369A1; font-size: 0.75rem;">
                            {{ strtoupper(str_replace('_', ' ', $p->post_category)) }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
