@extends('layouts.app')

@section('title', 'Agency Dashboard & B2B Deal Contracting')

@section('content')
    <!-- Verification Status Alert Banners -->
    <!-- Verification Status Alert Banners (Compact & Modern) -->
    @if(Auth::user()->verification_status === 'rejected')
        <div style="background: linear-gradient(135deg, #FFF1F2, #FEF2F2); border: 1.5px solid #FCA5A5; border-left: 6px solid #DC2626; border-radius: 12px; padding: 1rem 1.25rem; margin-bottom: 1.5rem; box-shadow: 0 4px 15px rgba(220, 38, 38, 0.08); display: flex; align-items: center; justify-content: space-between; gap: 1rem; flex-wrap: wrap;">
            <div style="display: flex; align-items: center; gap: 0.85rem; flex: 1; min-width: 280px;">
                <div style="width: 42px; height: 42px; border-radius: 10px; background: #DC2626; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0; box-shadow: 0 3px 8px rgba(220, 38, 38, 0.3);">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <div style="flex: 1;">
                    <div style="display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap; margin-bottom: 0.15rem;">
                        <span style="background: #DC2626; color: white; font-weight: 800; font-size: 0.72rem; padding: 0.2rem 0.55rem; border-radius: 12px; text-transform: uppercase; letter-spacing: 0.4px;">
                            <i class="fa-solid fa-ban me-1"></i> ভেরিফিকেশন প্রত্যাখ্যাত
                        </span>
                        <strong style="font-size: 0.95rem; color: #991B1B;">পুনরায় যাচাইকরণ প্রয়োজন</strong>
                    </div>
                    <p style="margin: 0; font-size: 0.86rem; color: #7F1D1D; line-height: 1.4;">
                        <strong style="color: #991B1B;">এডমিন নোট:</strong> "{{ Str::limit(Auth::user()->rejection_reason ?: 'আপনার আপলোডকৃত ট্রেড লাইসেন্স বা HAAB সনদের কপি অস্পষ্ট বা ত্রুটিপূর্ণ ছিল। অনুগ্রহ করে সঠিক ডকুমেন্ট পুনরায় আপলোড করুন।', 110) }}"
                    </p>
                </div>
            </div>
            <div style="display: flex; gap: 0.6rem; align-items: center; flex-wrap: wrap;">
                <a href="{{ route('verification.portal') }}" style="background: #DC2626; color: white; padding: 0.55rem 1.15rem; font-size: 0.82rem; font-weight: 700; border-radius: 8px; text-decoration: none; display: inline-flex; align-items: center; gap: 0.4rem; box-shadow: 0 2px 6px rgba(220, 38, 38, 0.25); transition: 0.2s;" onmouseover="this.style.background='#B91C1C'" onmouseout="this.style.background='#DC2626'">
                    <i class="fa-solid fa-file-arrow-up"></i> ডকুমেন্ট পুনরায় আপলোড
                </a>
                <a href="{{ route('agency.profile.edit') }}" style="background: white; border: 1px solid #FCA5A5; color: #991B1B; font-size: 0.82rem; font-weight: 700; padding: 0.55rem 0.85rem; border-radius: 8px; text-decoration: none;">
                    <i class="fa-solid fa-pen-to-square"></i> তথ্য সংশোধন
                </a>
            </div>
        </div>
    @elseif(Auth::user()->verification_status === 'pending')
        <div style="background: linear-gradient(135deg, #FFFBEB, #FEF3C7); border: 1.5px solid #FCD34D; border-left: 6px solid #D97706; border-radius: 12px; padding: 0.85rem 1.25rem; margin-bottom: 1.5rem; box-shadow: 0 4px 12px rgba(217, 119, 6, 0.08); display: flex; align-items: center; justify-content: space-between; gap: 1rem; flex-wrap: wrap;">
            <div style="display: flex; align-items: center; gap: 0.85rem;">
                <div style="width: 38px; height: 38px; border-radius: 10px; background: #D97706; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0;">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </div>
                <div>
                    <h4 style="font-size: 0.95rem; font-weight: 800; color: #92400E; margin: 0 0 0.1rem 0;">
                        ভেরিফিকেশন প্রক্রিয়াধীন রয়েছে (Pending Approval)
                    </h4>
                    <p style="margin: 0; font-size: 0.82rem; color: #B45309;">
                        এডমিন টিম আপনার লাইসেন্স পর্যালোচনা করছে। দ্রুত অনুমোদনের জন্য অপেক্ষা করুন।
                    </p>
                </div>
            </div>
            <div>
                <a href="{{ route('verification.portal') }}" style="background: white; color: #92400E; border: 1px solid #FCD34D; font-weight: 700; padding: 0.45rem 0.9rem; border-radius: 8px; font-size: 0.82rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.35rem;">
                    <i class="fa-solid fa-shield-halved text-amber-600"></i> স্ট্যাটাস দেখুন
                </a>
            </div>
        </div>
    @endif

    <!-- Control Header -->
    <div class="responsive-card-padding" style="background: white; border-radius: 16px; padding: 1.75rem 2rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); margin-bottom: 1.5rem;">
        <div class="responsive-header-flex" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem;">
            <div>
                <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.4rem; flex-wrap: wrap;">
                    <span class="badge badge-verified"><i class="fa-solid fa-building me-1"></i> {{ Auth::user()->agency_name }}</span>
                    @if(\App\Models\SiteSetting::isFreeMode())
                        <span style="background: #ECFDF5; color: #047857; font-weight: 800; font-size: 0.75rem; padding: 0.25rem 0.65rem; border-radius: 20px; border: 1px solid #A7F3D0; display: inline-flex; align-items: center; gap: 0.3rem;">
                            <i class="fa-solid fa-gift"></i> ১০০% ফ্রি প্রোমোশনাল মোড
                        </span>
                    @endif
                </div>
                <h1 class="font-heading" style="font-size: 1.85rem; color: var(--primary-dark); margin: 0 0 0.35rem 0;">Agency B2B Control Panel</h1>
                <p style="color: var(--text-muted); font-size: 0.92rem; margin: 0;">Manage your active post requirements, status tracking, and 2-way B2B deal contract agreements.</p>
            </div>

            <div style="display: flex; gap: 0.75rem; align-items: center; flex-wrap: wrap;">
                <a href="{{ route('posts.create') }}" class="btn-gold" style="padding: 0.65rem 1.35rem; font-weight: 700; box-shadow: 0 4px 12px rgba(212, 175, 55, 0.25);">
                    <i class="fa-solid fa-plus-circle me-1"></i> Post New Requirement
                </a>
            </div>
        </div>
    </div>

    <!-- Agency Profile Header Banner -->
    <div class="responsive-card-padding" style="background: linear-gradient(135deg, var(--primary-dark), #033624); color: white; border-radius: 16px; padding: 1.5rem 1.75rem; margin-bottom: 1.75rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem; border: 1px solid var(--accent); box-shadow: 0 8px 24px rgba(4, 78, 53, 0.15);">
        <div style="display: flex; align-items: center; gap: 1.25rem; flex-wrap: wrap;">
            <div style="width: 56px; height: 56px; background: linear-gradient(135deg, #D4AF37, #F3E5AB); color: var(--primary-dark); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; font-weight: 800; box-shadow: 0 4px 12px rgba(0,0,0,0.2);">
                {{ strtoupper(substr(Auth::user()->agency_name, 0, 1)) }}
            </div>
            <div>
                <h2 class="font-heading" style="font-size: 1.45rem; color: white; margin: 0 0 0.25rem 0;">{{ Auth::user()->agency_name }}</h2>
                <p style="color: var(--accent-light); font-size: 0.85rem; margin: 0; display: flex; gap: 0.85rem; flex-wrap: wrap;">
                    <span><i class="fa-solid fa-certificate text-emerald-400"></i> সরকারি লাইসেন্স: <strong>{{ Auth::user()->license_no }}</strong></span>
                    @if(Auth::user()->haab_no)
                        <span><i class="fa-solid fa-id-card"></i> HAAB: <strong>{{ Auth::user()->haab_no }} (ঐচ্ছিক)</strong></span>
                    @endif
                    <span><i class="fa-solid fa-location-dot"></i> {{ Auth::user()->city ?? 'Bangladesh' }}</span>
                </p>
            </div>
        </div>

        <div style="display: flex; gap: 0.75rem; align-items: center; flex-wrap: wrap;">
            @if(Auth::user()->verification_status === 'verified')
                <span class="badge badge-verified" style="font-size: 0.8rem; padding: 0.45rem 0.9rem;">
                    <i class="fa-solid fa-shield-check me-1"></i> VERIFIED AGENCY
                </span>
            @elseif(Auth::user()->verification_status === 'rejected')
                <span style="background: #EF4444; color: white; font-weight: 800; font-size: 0.8rem; padding: 0.45rem 0.9rem; border-radius: 20px; display: inline-flex; align-items: center; gap: 0.35rem;">
                    <i class="fa-solid fa-triangle-exclamation"></i> REJECTED
                </span>
            @else
                <span class="badge badge-pending" style="font-size: 0.8rem; padding: 0.45rem 0.9rem;">
                    <i class="fa-solid fa-clock me-1"></i> PENDING VERIFICATION
                </span>
            @endif

            @if(\App\Models\SiteSetting::isFreeMode())
                <span style="background: rgba(16, 185, 129, 0.2); border: 1px solid rgba(52, 211, 153, 0.4); color: #A7F3D0; font-weight: 700; font-size: 0.8rem; padding: 0.45rem 0.9rem; border-radius: 20px; display: inline-flex; align-items: center; gap: 0.35rem;">
                    <i class="fa-solid fa-gift text-emerald-300"></i> ১০০% ফ্রি মোড (সকল সার্ভিস উন্মুক্ত)
                </span>
            @else
                <span style="background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3); color: var(--accent-light); font-weight: 700; font-size: 0.8rem; padding: 0.45rem 0.9rem; border-radius: 20px;">
                    <i class="fa-solid fa-crown me-1 text-amber-400"></i> Plan: {{ strtoupper(str_replace('_', ' ', Auth::user()->subscription_plan)) }}
                </span>
            @endif
        </div>
    </div>

    <!-- 6 Executive Agency KPI Cards Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
        <!-- KPI 1: Active Listings -->
        <div style="background: white; padding: 1.25rem; border-radius: 16px; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                <span style="font-size: 0.76rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase;">ACTIVE B2B POSTS</span>
                <div style="width: 36px; height: 36px; background: #ECFDF5; color: #047857; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1rem;">
                    <i class="fa-solid fa-layer-group"></i>
                </div>
            </div>
            <strong style="font-size: 1.75rem; color: var(--primary-dark); font-family: var(--font-heading); display: block; line-height: 1.1;">{{ $myPosts->count() }}</strong>
            <span style="font-size: 0.72rem; color: #047857; font-weight: 600;"><i class="fa-solid fa-circle-check"></i> Live in Marketplace</span>
        </div>

        <!-- KPI 2: Available Seats -->
        <div style="background: white; padding: 1.25rem; border-radius: 16px; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                <span style="font-size: 0.76rem; color: #075985; font-weight: 700; text-transform: uppercase;">REMAINING SEATS</span>
                <div style="width: 36px; height: 36px; background: #E0F2FE; color: #0284C7; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1rem;">
                    <i class="fa-solid fa-chair"></i>
                </div>
            </div>
            <strong style="font-size: 1.75rem; color: #0284C7; font-family: var(--font-heading); display: block; line-height: 1.1;">{{ $totalSeatsAvailable }}</strong>
            <span style="font-size: 0.72rem; color: #0284C7; font-weight: 600;">{{ $totalSeatsOffered }} Total Block Pax</span>
        </div>

        <!-- KPI 3: Received Proposals -->
        <div style="background: white; padding: 1.25rem; border-radius: 16px; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                <span style="font-size: 0.76rem; color: #B45309; font-weight: 700; text-transform: uppercase;">INCOMING INQUIRIES</span>
                <div style="width: 36px; height: 36px; background: #FEF3C7; color: #D97706; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1rem;">
                    <i class="fa-solid fa-inbox"></i>
                </div>
            </div>
            <strong style="font-size: 1.75rem; color: #D97706; font-family: var(--font-heading); display: block; line-height: 1.1;">{{ $myInquiries->count() }}</strong>
            <span style="font-size: 0.72rem; color: #B45309; font-weight: 600;">Buyer Proposals</span>
        </div>

        <!-- KPI 4: Sent Proposals -->
        <div style="background: white; padding: 1.25rem; border-radius: 16px; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                <span style="font-size: 0.76rem; color: #5B21B6; font-weight: 700; text-transform: uppercase;">MY SENT PROPOSALS</span>
                <div style="width: 36px; height: 36px; background: #F3E8FF; color: #7C3AED; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1rem;">
                    <i class="fa-solid fa-paper-plane"></i>
                </div>
            </div>
            <strong style="font-size: 1.75rem; color: #7C3AED; font-family: var(--font-heading); display: block; line-height: 1.1;">{{ $sentInquiries->count() }}</strong>
            <span style="font-size: 0.72rem; color: #7C3AED; font-weight: 600;">Active Outgoing</span>
        </div>

        <!-- KPI 5: Completed Contracts -->
        <div style="background: white; padding: 1.25rem; border-radius: 16px; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                <span style="font-size: 0.76rem; color: #065F46; font-weight: 700; text-transform: uppercase;">CLOSED DEALS</span>
                <div style="width: 36px; height: 36px; background: #D1FAE5; color: #059669; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1rem;">
                    <i class="fa-solid fa-handshake"></i>
                </div>
            </div>
            <strong style="font-size: 1.75rem; color: #059669; font-family: var(--font-heading); display: block; line-height: 1.1;">{{ $completedDealsCount }}</strong>
            <span style="font-size: 0.72rem; color: #059669; font-weight: 600;"><i class="fa-solid fa-file-contract"></i> Signed Agreements</span>
        </div>

        <!-- KPI 6: Estimated Volume -->
        <div style="background: white; padding: 1.25rem; border-radius: 16px; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                <span style="font-size: 0.76rem; color: #1E3A8A; font-weight: 700; text-transform: uppercase;">DEAL VOLUME</span>
                <div style="width: 36px; height: 36px; background: #EEF2FF; color: #4F46E5; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1rem;">
                    <i class="fa-solid fa-coins"></i>
                </div>
            </div>
            <strong style="font-size: 1.45rem; color: #4F46E5; font-family: var(--font-heading); display: block; line-height: 1.2;">৳{{ number_format($totalDealVolume) }}</strong>
            <span style="font-size: 0.72rem; color: #4F46E5; font-weight: 600;">Contract Turnover</span>
        </div>
    </div>

    <!-- Agency Interactive Visual Analytics (Chart.js Section) -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.5rem; margin-bottom: 2.25rem;">
        <!-- Chart 1: Seat Utilization Ratio -->
        <div style="background: white; border-radius: 18px; padding: 1.5rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                <h4 class="font-heading" style="font-size: 1.1rem; color: var(--primary-dark); margin: 0; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-chart-pie text-emerald-600"></i> সিট বুকিং ও ফিল-রেট অনুপাত
                </h4>
                <span style="font-size: 0.75rem; background: #ECFDF5; color: #047857; padding: 0.25rem 0.55rem; border-radius: 12px; font-weight: 700;">Seat Ratio</span>
            </div>
            <div style="position: relative; height: 200px; display: flex; align-items: center; justify-content: center;">
                <canvas id="agencySeatChart"></canvas>
            </div>
            <div style="display: flex; justify-content: space-around; margin-top: 1rem; font-size: 0.8rem; border-top: 1px solid #F1F5F9; padding-top: 0.75rem;">
                <span style="color: #0284C7; font-weight: 700;">● ফাঁকা সিট: {{ $totalSeatsAvailable }}</span>
                <span style="color: #059669; font-weight: 700;">● বিক্রিত/বুকড: {{ $totalSeatsSold }}</span>
            </div>
        </div>

        <!-- Chart 2: Inventory Categories -->
        <div style="background: white; border-radius: 18px; padding: 1.5rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                <h4 class="font-heading" style="font-size: 1.1rem; color: var(--primary-dark); margin: 0; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-shapes text-indigo-600"></i> প্যাকেজ ও সার্ভিসের বিভাজন
                </h4>
                <span style="font-size: 0.75rem; background: #EEF2FF; color: #4F46E5; padding: 0.25rem 0.55rem; border-radius: 12px; font-weight: 700;">Categories</span>
            </div>
            <div style="position: relative; height: 200px; display: flex; align-items: center; justify-content: center;">
                <canvas id="agencyCategoryChart"></canvas>
            </div>
            <div style="display: flex; justify-content: space-around; margin-top: 1rem; font-size: 0.8rem; border-top: 1px solid #F1F5F9; padding-top: 0.75rem;">
                <span style="color: #044E35; font-weight: 700;">● গ্রুপ সিট: {{ $categoryBreakdown['group_seats'] ?? 0 }}</span>
                <span style="color: #0284C7; font-weight: 700;">● টিকিট: {{ $categoryBreakdown['ticket_only'] ?? 0 }}</span>
                <span style="color: #D97706; font-weight: 700;">● হোটেল: {{ $categoryBreakdown['hotel_share'] ?? 0 }}</span>
            </div>
        </div>

        <!-- Chart 3: Proposal Pipeline -->
        <div style="background: white; border-radius: 18px; padding: 1.5rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                <h4 class="font-heading" style="font-size: 1.1rem; color: var(--primary-dark); margin: 0; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-handshake-simple text-amber-600"></i> ইনকোয়ারি ও কন্ট্রাক্ট অগ্রগতি
                </h4>
                <span style="font-size: 0.75rem; background: #FEF3C7; color: #B45309; padding: 0.25rem 0.55rem; border-radius: 12px; font-weight: 700;">Pipeline</span>
            </div>
            <div style="position: relative; height: 200px; display: flex; align-items: center; justify-content: center;">
                <canvas id="agencyPipelineChart"></canvas>
            </div>
            <div style="display: flex; justify-content: space-around; margin-top: 1rem; font-size: 0.8rem; border-top: 1px solid #F1F5F9; padding-top: 0.75rem;">
                <span style="color: #D97706; font-weight: 700;">● আলোচনাধীন: {{ $inNegotiationCount }}</span>
                <span style="color: #059669; font-weight: 700;">● চুক্তি সম্পন্ন: {{ $completedDealsCount }}</span>
            </div>
        </div>
    </div>

    <!-- Quick Section Navigation Pills -->
    <div style="background: white; border-radius: 14px; padding: 0.65rem 0.85rem; border: 1px solid var(--border-color); display: flex; gap: 0.6rem; margin-bottom: 2rem; overflow-x: auto; box-shadow: var(--shadow-sm);">
        <a href="#my-posts-section" style="padding: 0.65rem 1.15rem; border-radius: 10px; font-size: 0.88rem; font-weight: 700; color: #044E35; text-decoration: none; background: #ECFDF5; border: 1px solid #A7F3D0; display: inline-flex; align-items: center; gap: 0.5rem; white-space: nowrap; transition: 0.2s;" onmouseover="this.style.background='#D1FAE5'" onmouseout="this.style.background='#ECFDF5'">
            <i class="fa-solid fa-layer-group text-emerald-600"></i> আমার পোস্ট সমূহ 
            <span style="background: #047857; color: white; padding: 2px 7px; border-radius: 12px; font-size: 0.75rem;">{{ $myPosts->count() }}</span>
        </a>
        <a href="#received-proposals-section" style="padding: 0.65rem 1.15rem; border-radius: 10px; font-size: 0.88rem; font-weight: 700; color: #0369A1; text-decoration: none; background: #F0F9FF; border: 1px solid #BAE6FD; display: inline-flex; align-items: center; gap: 0.5rem; white-space: nowrap; transition: 0.2s;" onmouseover="this.style.background='#E0F2FE'" onmouseout="this.style.background='#F0F9FF'">
            <i class="fa-solid fa-inbox text-sky-600"></i> প্রাপ্ত প্রস্তাব ও কোটেশন 
            <span style="background: #0284C7; color: white; padding: 2px 7px; border-radius: 12px; font-size: 0.75rem;">{{ $myInquiries->count() }}</span>
        </a>
        <a href="#sent-proposals-section" style="padding: 0.65rem 1.15rem; border-radius: 10px; font-size: 0.88rem; font-weight: 700; color: #B45309; text-decoration: none; background: #FFFBEB; border: 1px solid #FDE68A; display: inline-flex; align-items: center; gap: 0.5rem; white-space: nowrap; transition: 0.2s;" onmouseover="this.style.background='#FEF3C7'" onmouseout="this.style.background='#FFFBEB'">
            <i class="fa-solid fa-paper-plane text-amber-600"></i> প্রেরিত প্রস্তাব ট্র্যাকিং 
            <span style="background: #D97706; color: white; padding: 2px 7px; border-radius: 12px; font-size: 0.75rem;">{{ $sentInquiries->count() }}</span>
        </a>
        <a href="#billing-section" style="padding: 0.65rem 1.15rem; border-radius: 10px; font-size: 0.88rem; font-weight: 700; color: #4338CA; text-decoration: none; background: #EEF2FF; border: 1px solid #C7D2FE; display: inline-flex; align-items: center; gap: 0.5rem; white-space: nowrap; transition: 0.2s;" onmouseover="this.style.background='#E0E7FF'" onmouseout="this.style.background='#EEF2FF'">
            <i class="fa-solid fa-receipt text-indigo-600"></i> সাবস্ক্রিপশন ও বিলিং হিস্ট্রি
        </a>
    </div>

    <!-- Section 1: My B2B Posts & Status Tracking Table -->
    <div id="my-posts-section" class="responsive-card-padding" style="background: white; border-radius: 18px; padding: 1.75rem; border: 1px solid var(--border-color); margin-bottom: 2.5rem; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem; border-bottom: 1px solid #F1F5F9; padding-bottom: 1rem;">
            <div>
                <h3 class="font-heading" style="font-size: 1.35rem; color: var(--primary-dark); margin: 0; display: flex; align-items: center; gap: 0.6rem;">
                    <span style="width: 38px; height: 38px; background: #ECFDF5; color: #047857; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; font-size: 1.1rem;">
                        <i class="fa-solid fa-list-check"></i>
                    </span>
                    My Active B2B Requirement Listings
                </h3>
                <p style="margin: 0.35rem 0 0; font-size: 0.85rem; color: var(--text-muted);">
                    মার্কেটপ্লেসে আপনার লাইভ অফারসমূহ, সিট বুকিং অগ্রগতি ও দ্রুত স্ট্যাটাস পরিবর্তন করুন
                </p>
            </div>
            <div>
                <a href="{{ route('posts.create') }}" class="btn-gold" style="padding: 0.55rem 1.25rem; font-size: 0.85rem; font-weight: 700; box-shadow: 0 4px 12px rgba(212, 175, 55, 0.25);">
                    <i class="fa-solid fa-plus-circle me-1"></i> নতুন পোস্ট করুন
                </a>
            </div>
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: separate; border-spacing: 0; text-align: left; font-size: 0.88rem;">
                <thead>
                    <tr style="background: #F8FAFC; color: var(--text-muted); font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.5px;">
                        <th style="padding: 1rem 1.1rem; border-top: 1px solid var(--border-color); border-bottom: 2px solid var(--border-color); border-top-left-radius: 10px;">প্যাকেজ ও বিবরণ</th>
                        <th style="padding: 1rem 0.85rem; border-top: 1px solid var(--border-color); border-bottom: 2px solid var(--border-color);">ফ্লাইট ও ডিপার্চার</th>
                        <th style="padding: 1rem 0.85rem; border-top: 1px solid var(--border-color); border-bottom: 2px solid var(--border-color); min-width: 170px;">সিট কোটা ও অগ্রগতি</th>
                        <th style="padding: 1rem 0.85rem; border-top: 1px solid var(--border-color); border-bottom: 2px solid var(--border-color);">দর ও অগ্রিম</th>
                        <th style="padding: 1rem 0.85rem; border-top: 1px solid var(--border-color); border-bottom: 2px solid var(--border-color);">মার্কেট স্ট্যাটাস</th>
                        <th style="padding: 1rem 1.1rem; border-top: 1px solid var(--border-color); border-bottom: 2px solid var(--border-color); border-top-right-radius: 10px; text-align: right;">অ্যাকশন ও সিট এডজাস্ট</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($myPosts as $post)
                        @php
                            $bookedSeats = max(0, $post->total_group_size - $post->available_seats);
                            $fillRate = $post->total_group_size > 0 ? round(($bookedSeats / $post->total_group_size) * 100) : 0;
                        @endphp
                        <tr style="border-bottom: 1px solid #F1F5F9; transition: background 0.2s;" onmouseover="this.style.background='#FBFDFF'" onmouseout="this.style.background='white'">
                            <td style="padding: 1.1rem 1.1rem; vertical-align: middle;">
                                <div style="display: flex; align-items: center; gap: 0.4rem; margin-bottom: 0.3rem;">
                                    <span style="font-size: 0.7rem; font-weight: 800; padding: 0.15rem 0.5rem; border-radius: 8px; text-transform: uppercase; background: #ECFDF5; color: #047857; border: 1px solid #A7F3D0;">
                                        {{ strtoupper(str_replace('_', ' ', $post->post_category)) }}
                                    </span>
                                    <span style="font-size: 0.72rem; color: #94A3B8; font-weight: 600;">#{{ $post->id }}</span>
                                </div>
                                <strong style="font-size: 0.96rem;">
                                    <a href="{{ route('posts.show', $post->id) }}" style="color: var(--primary-dark); text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='var(--primary-dark)'">
                                        {{ $post->title }}
                                    </a>
                                </strong>
                                <div style="font-size: 0.78rem; color: var(--text-muted); margin-top: 0.2rem; display: flex; gap: 0.6rem; align-items: center;">
                                    <span><i class="fa-solid fa-location-dot text-rose-500"></i> {{ $post->departure_city ?? 'Dhaka' }}</span>
                                    <span>•</span>
                                    <span>পোস্ট: {{ $post->created_at->format('d M, Y') }}</span>
                                </div>
                            </td>
                            <td style="padding: 1.1rem 0.85rem; vertical-align: middle;">
                                <div style="font-weight: 700; color: #1E293B; display: flex; align-items: center; gap: 0.35rem;">
                                    <i class="fa-solid fa-plane-departure text-sky-600"></i> {{ $post->airline ?? 'Biman / Saudia' }}
                                </div>
                                <div style="font-size: 0.82rem; color: var(--text-muted); margin-top: 0.15rem;">
                                    {{ $post->flight_date->format('d M, Y') }}
                                </div>
                                <div style="font-size: 0.72rem; color: #0284C7; font-weight: 600; margin-top: 0.15rem;">
                                    {{ strtoupper($post->flight_transit ?? 'Direct Flight') }}
                                </div>
                            </td>
                            <td style="padding: 1.1rem 0.85rem; vertical-align: middle;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.35rem; font-size: 0.82rem;">
                                    <strong style="color: #047857; font-size: 0.95rem;">{{ $post->available_seats }} Pax</strong>
                                    <span style="color: var(--text-muted); font-size: 0.78rem;">মোট: {{ $post->total_group_size }}</span>
                                </div>
                                <!-- Clean Visual Progress Bar -->
                                <div style="width: 100%; height: 7px; background: #E2E8F0; border-radius: 10px; overflow: hidden; position: relative;">
                                    <div style="width: {{ $fillRate }}%; height: 100%; background: linear-gradient(90deg, #10B981, #047857); border-radius: 10px;"></div>
                                </div>
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 0.25rem;">
                                    <span style="font-size: 0.72rem; color: var(--text-muted);">{{ $fillRate }}% বুকড</span>
                                    @if($post->pendingSeats() > 0)
                                        <span style="font-size: 0.72rem; color: #D97706; font-weight: 700;">
                                            <i class="fa-solid fa-clock"></i> {{ $post->pendingSeats() }} পেন্ডিং
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td style="padding: 1.1rem 0.85rem; vertical-align: middle;">
                                <strong style="font-size: 1.05rem; color: var(--primary-dark); display: block;">৳{{ number_format($post->price_per_seat) }}</strong>
                                <span style="font-size: 0.75rem; color: var(--text-muted);">
                                    টোকেন: <strong>৳{{ number_format($post->advance_deposit) }}</strong>
                                </span>
                            </td>
                            <td style="padding: 1.1rem 0.85rem; vertical-align: middle;">
                                @if($post->status === 'open')
                                    <span style="background: #ECFDF5; color: #047857; border: 1px solid #A7F3D0; font-weight: 700; font-size: 0.76rem; padding: 0.3rem 0.7rem; border-radius: 20px; display: inline-flex; align-items: center; gap: 0.35rem;">
                                        <span style="width: 7px; height: 7px; border-radius: 50%; background: #10B981; display: inline-block;"></span> উন্মুক্ত (OPEN)
                                    </span>
                                @elseif($post->status === 'partially_filled')
                                    <span style="background: #FFFBEB; color: #B45309; border: 1px solid #FCD34D; font-weight: 700; font-size: 0.76rem; padding: 0.3rem 0.7rem; border-radius: 20px; display: inline-flex; align-items: center; gap: 0.35rem;">
                                        <span style="width: 7px; height: 7px; border-radius: 50%; background: #F59E0B; display: inline-block;"></span> আংশিক বুকড
                                    </span>
                                @else
                                    <span style="background: #F1F5F9; color: #475569; border: 1px solid #CBD5E1; font-weight: 700; font-size: 0.76rem; padding: 0.3rem 0.7rem; border-radius: 20px; display: inline-flex; align-items: center; gap: 0.35rem;">
                                        <span style="width: 7px; height: 7px; border-radius: 50%; background: #64748B; display: inline-block;"></span> বন্ধ (CLOSED)
                                    </span>
                                @endif
                            </td>
                            <td style="padding: 1.1rem 1.1rem; vertical-align: middle; text-align: right;">
                                <div style="display: flex; gap: 0.45rem; align-items: center; justify-content: flex-end; flex-wrap: wrap;">
                                    <button type="button" onclick="document.getElementById('adjust-seats-modal-{{ $post->id }}').style.display='flex'" style="background: #047857; color: white; border: none; padding: 0.4rem 0.75rem; font-size: 0.78rem; font-weight: 700; border-radius: 8px; cursor: pointer; display: inline-flex; align-items: center; gap: 0.35rem; box-shadow: 0 2px 5px rgba(4,120,87,0.25); transition: 0.2s;" onmouseover="this.style.background='#065F46'" onmouseout="this.style.background='#047857'">
                                        <i class="fa-solid fa-calculator"></i> সিট এডজাস্ট
                                    </button>

                                    <form action="{{ route('posts.status', $post->id) }}" method="POST" style="display: inline-flex; align-items: center;">
                                        @csrf
                                        <select name="status" onchange="this.form.submit()" style="padding: 0.38rem 0.65rem; border-radius: 8px; border: 1.5px solid var(--border-color); font-size: 0.8rem; background: white; font-weight: 700; color: var(--text-dark); cursor: pointer; outline: none;">
                                            <option value="open" {{ $post->status == 'open' ? 'selected' : '' }}>🟢 Open</option>
                                            <option value="partially_filled" {{ $post->status == 'partially_filled' ? 'selected' : '' }}>🟡 Partially Filled</option>
                                            <option value="closed" {{ $post->status == 'closed' ? 'selected' : '' }}>🔴 Closed</option>
                                        </select>
                                    </form>
                                </div>

                                <!-- Modal for Quick Manual Seat Adjustment -->
                                <div id="adjust-seats-modal-{{ $post->id }}" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.6); z-index: 9999; align-items: center; justify-content: center; text-align: left; padding: 1rem;">
                                    <div style="background: white; border-radius: 16px; padding: 1.75rem; max-width: 440px; width: 100%; border: 1px solid var(--border-color); box-shadow: 0 15px 35px rgba(0,0,0,0.25);">
                                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem; border-bottom: 1px solid #F1F5F9; padding-bottom: 0.75rem;">
                                            <h4 style="font-size: 1.05rem; font-weight: 800; color: var(--primary-dark); margin: 0; display: flex; align-items: center; gap: 0.45rem;">
                                                <i class="fa-solid fa-calculator text-emerald-600"></i> সিট সংখ্যা ম্যানুয়াল এডজাস্টমেন্ট
                                            </h4>
                                            <button type="button" onclick="document.getElementById('adjust-seats-modal-{{ $post->id }}').style.display='none'" style="border: none; background: #F1F5F9; width: 32px; height: 32px; border-radius: 50%; font-size: 1.2rem; cursor: pointer; color: var(--text-muted); display: flex; align-items: center; justify-content: center;">&times;</button>
                                        </div>
                                        
                                        <div style="background: #F8FAFC; border: 1px solid var(--border-color); padding: 0.85rem 1rem; border-radius: 10px; margin-bottom: 1.25rem; font-size: 0.85rem;">
                                            <div style="font-weight: 700; color: var(--primary-dark); margin-bottom: 0.2rem;">{{ $post->title }}</div>
                                            <div style="display: flex; justify-content: space-between; margin-top: 0.4rem; padding-top: 0.4rem; border-top: 1px dashed #CBD5E1;">
                                                <span style="color: var(--text-muted);">বর্তমান অবশিষ্ট সিট:</span>
                                                <strong style="color: #DC2626; font-size: 1rem;">{{ $post->available_seats }} Pax</strong>
                                            </div>
                                        </div>

                                        <form action="{{ route('posts.adjust_seats', $post->id) }}" method="POST">
                                            @csrf
                                            <div style="margin-bottom: 1rem;">
                                                <label style="display: block; font-size: 0.82rem; font-weight: 700; margin-bottom: 0.4rem; color: var(--text-dark);">এডজাস্টমেন্ট প্রক্রিয়া *</label>
                                                <select name="adjustment_type" required style="width: 100%; padding: 0.6rem; border-radius: 8px; border: 1.5px solid var(--border-color); font-size: 0.88rem; outline: none;">
                                                    <option value="reduce">🔴 অফলাইনে বিক্রিত সিট বিয়োগ করুন (Reduce)</option>
                                                    <option value="set">⚙️ সরাসরি অবশিষ্ট সিট সেট করুন (Set Exact)</option>
                                                </select>
                                            </div>

                                            <div style="margin-bottom: 1.5rem;">
                                                <label style="display: block; font-size: 0.82rem; font-weight: 700; margin-bottom: 0.4rem; color: var(--text-dark);">সিট সংখ্যা *</label>
                                                <input type="number" name="seats_count" min="0" required placeholder="উদাহরণ: 2" style="width: 100%; padding: 0.6rem; border-radius: 8px; border: 1.5px solid var(--border-color); font-size: 0.95rem; outline: none;">
                                            </div>

                                            <button type="submit" class="btn-gold" style="width: 100%; justify-content: center; font-size: 0.92rem; padding: 0.7rem; border-radius: 8px; font-weight: 800;">
                                                <i class="fa-solid fa-check me-1"></i> সিট আপডেট সেভ করুন
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 3rem 1rem; color: var(--text-muted);">
                                <i class="fa-solid fa-layer-group" style="font-size: 2.5rem; color: #CBD5E1; margin-bottom: 0.75rem; display: block;"></i>
                                <p style="font-size: 0.95rem; margin-bottom: 0.75rem;">আপনার কোনো সক্রিয় B2B পোস্ট বা রিকোয়ারমেন্ট তালিকাভুক্ত নেই।</p>
                                <a href="{{ route('posts.create') }}" class="btn-primary" style="display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.6rem 1.4rem;">
                                    <i class="fa-solid fa-plus-circle"></i> প্রথম পোস্ট তৈরি করুন
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Section 2: Received Inquiries & Leads Inbox -->
    <div id="received-proposals-section" class="responsive-card-padding" style="background: white; border-radius: 18px; padding: 1.75rem; border: 1px solid var(--border-color); box-shadow: 0 4px 15px rgba(0,0,0,0.03); margin-bottom: 2.5rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem; border-bottom: 1px solid #F1F5F9; padding-bottom: 1rem;">
            <div>
                <h3 class="font-heading" style="font-size: 1.35rem; color: var(--primary-dark); margin: 0; display: flex; align-items: center; gap: 0.6rem;">
                    <span style="width: 38px; height: 38px; background: #F0F9FF; color: #0284C7; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; font-size: 1.1rem;">
                        <i class="fa-solid fa-inbox"></i>
                    </span>
                    Received B2B Proposals & Quotation Responses
                </h3>
                <p style="margin: 0.35rem 0 0; font-size: 0.85rem; color: var(--text-muted);">
                    অন্যান্য এজেন্সি থেকে প্রাপ্ত ইনকোয়ারি, কোটেশন নেগোসিয়েশন এবং ২-ওয়ে চুক্তি ব্যবস্থাপনা
                </p>
            </div>
            <div>
                <span style="background: #F0F9FF; color: #0369A1; font-weight: 700; font-size: 0.82rem; padding: 0.4rem 0.85rem; border-radius: 20px; border: 1px solid #BAE6FD;">
                    মোট প্রাপ্ত প্রস্তাব: <strong>{{ $myInquiries->count() }}</strong> টি
                </span>
            </div>
        </div>

        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            @forelse($myInquiries as $inq)
                @php
                    $isCompleted = $inq->status === 'completed';
                    $isAccepted = $inq->status === 'accepted';
                    $borderColor = $isCompleted ? '#059669' : ($isAccepted ? '#D97706' : '#0284C7');
                    $bgColor = $isCompleted ? '#FAFCFA' : ($isAccepted ? '#FFFCF5' : '#F8FAFC');
                @endphp
                <div style="background: {{ $bgColor }}; border: 1px solid var(--border-color); border-left: 6px solid {{ $borderColor }}; border-radius: 16px; padding: 1.5rem; display: flex; flex-direction: column; gap: 1.25rem; box-shadow: 0 3px 12px rgba(0,0,0,0.03); transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                    <!-- Card Top: Partner Profile & Deal Status -->
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 1rem;">
                        <div style="display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;">
                            <div style="width: 48px; height: 48px; border-radius: 14px; background: linear-gradient(135deg, #044E35, #0B6E4F); color: #F3E5AB; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.25rem; flex-shrink: 0; box-shadow: 0 4px 10px rgba(4,78,53,0.2);">
                                {{ strtoupper(substr($inq->inquiringAgency->agency_name, 0, 1)) }}
                            </div>
                            <div>
                                <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.25rem; flex-wrap: wrap;">
                                    <h4 style="font-size: 1.1rem; color: var(--primary-dark); font-weight: 800; margin: 0;">
                                        {{ $inq->inquiringAgency->agency_name }}
                                    </h4>
                                    <span class="badge badge-verified" style="font-size: 0.72rem; padding: 0.2rem 0.55rem;">
                                        <i class="fa-solid fa-certificate"></i> লাইসেন্স: {{ $inq->inquiringAgency->license_no }}
                                    </span>
                                </div>
                                <div style="font-size: 0.82rem; color: var(--text-muted); display: flex; gap: 0.6rem; flex-wrap: wrap; align-items: center;">
                                    <span><i class="fa-solid fa-user-tie"></i> {{ $inq->inquiringAgency->owner_name }}</span>
                                    <span>•</span>
                                    <span><i class="fa-solid fa-location-dot"></i> {{ $inq->inquiringAgency->city ?? 'Bangladesh' }}</span>
                                    <span>•</span>
                                    <span><i class="fa-solid fa-clock"></i> {{ $inq->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            @if($isCompleted)
                                <span style="background: #ECFDF5; color: #047857; border: 1.5px solid #A7F3D0; font-weight: 800; font-size: 0.82rem; padding: 0.4rem 0.9rem; border-radius: 20px; display: inline-flex; align-items: center; gap: 0.4rem;">
                                    <i class="fa-solid fa-check-double text-emerald-600"></i> ডিল সম্পন্ন (DEAL COMPLETED)
                                </span>
                            @elseif($isAccepted)
                                <span style="background: #FFFBEB; color: #B45309; border: 1.5px solid #FCD34D; font-weight: 800; font-size: 0.82rem; padding: 0.4rem 0.9rem; border-radius: 20px; display: inline-flex; align-items: center; gap: 0.4rem;">
                                    <i class="fa-solid fa-handshake text-amber-600"></i> কোটেশন পাঠানো হয়েছে (IN NEGOTIATION)
                                </span>
                            @else
                                <span style="background: #F0F9FF; color: #0369A1; border: 1.5px solid #BAE6FD; font-weight: 800; font-size: 0.82rem; padding: 0.4rem 0.9rem; border-radius: 20px; display: inline-flex; align-items: center; gap: 0.4rem;">
                                    <i class="fa-solid fa-paper-plane text-sky-600"></i> নতুন প্রস্তাব (PENDING REVIEW)
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Post Context Tag -->
                    <div style="background: rgba(255,255,255,0.7); border: 1px solid var(--border-color); border-radius: 10px; padding: 0.65rem 0.9rem; font-size: 0.85rem; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.5rem;">
                        <div>
                            <span style="color: var(--text-muted); font-size: 0.8rem;">সম্পর্কিত পোস্ট:</span>
                            <strong style="color: var(--primary-dark); margin-left: 0.35rem;">
                                <a href="{{ route('posts.show', $inq->post_id) }}" target="_blank" style="color: inherit; text-decoration: none;">
                                    {{ $inq->post->title }} <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 0.75rem;"></i>
                                </a>
                            </strong>
                        </div>
                        <div style="font-size: 0.8rem; color: var(--text-muted);">
                            ফ্লাইট: <strong>{{ $inq->post->flight_date->format('d M, Y') }}</strong> ({{ $inq->post->airline ?? 'Biman / Saudia' }})
                        </div>
                    </div>

                    <!-- Financial & Pax Metrics Grid -->
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(130px, 1fr)); gap: 0.75rem;">
                        <div style="background: white; border: 1px solid var(--border-color); border-radius: 12px; padding: 0.85rem; text-align: center;">
                            <div style="font-size: 0.74rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase;">অনুরোধকৃত সিট</div>
                            <div style="font-size: 1.35rem; font-weight: 800; color: #DC2626; margin-top: 0.15rem;">{{ $inq->requested_seats }} Pax</div>
                        </div>
                        <div style="background: white; border: 1px solid var(--border-color); border-radius: 12px; padding: 0.85rem; text-align: center;">
                            <div style="font-size: 0.74rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase;">জনপ্রতি অফার দর</div>
                            <div style="font-size: 1.15rem; font-weight: 800; color: var(--primary-dark); margin-top: 0.15rem;">
                                ৳{{ number_format($inq->offered_price_per_seat ?: $inq->post->price_per_seat) }}
                            </div>
                        </div>
                        <div style="background: white; border: 1px solid var(--border-color); border-radius: 12px; padding: 0.85rem; text-align: center;">
                            <div style="font-size: 0.74rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase;">মোট ডিল মান</div>
                            <div style="font-size: 1.15rem; font-weight: 800; color: #047857; margin-top: 0.15rem;">
                                ৳{{ number_format($inq->requested_seats * ($inq->offered_price_per_seat ?: $inq->post->price_per_seat)) }}
                            </div>
                        </div>
                        <div style="background: white; border: 1px solid var(--border-color); border-radius: 12px; padding: 0.85rem; text-align: center;">
                            <div style="font-size: 0.74rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase;">অগ্রিম টোকেন মানি</div>
                            <div style="font-size: 1.15rem; font-weight: 800; color: #D97706; margin-top: 0.15rem;">
                                ৳{{ number_format($inq->advance_amount_agreed ?: ($inq->post->advance_deposit * $inq->requested_seats)) }}
                            </div>
                        </div>
                    </div>

                    <!-- Negotiation Conversation & Quotation Notes Box -->
                    <div style="display: flex; flex-direction: column; gap: 0.6rem;">
                        <div style="background: white; border: 1px solid #E2E8F0; padding: 0.85rem 1.1rem; border-radius: 10px; font-size: 0.88rem;">
                            <div style="font-size: 0.75rem; font-weight: 800; color: #0284C7; text-transform: uppercase; margin-bottom: 0.25rem;">
                                <i class="fa-solid fa-quote-left me-1"></i> বায়ার এজেন্সির বার্তা (Buyer Requirement Note):
                            </div>
                            <p style="margin: 0; color: var(--text-dark); line-height: 1.45;">"{{ $inq->message }}"</p>
                        </div>

                        @if($inq->seller_note)
                            <div style="background: #F0FDF4; border: 1px solid #BBF7D0; padding: 0.85rem 1.1rem; border-radius: 10px; font-size: 0.88rem;">
                                <div style="font-size: 0.75rem; font-weight: 800; color: #047857; text-transform: uppercase; margin-bottom: 0.25rem; display: flex; justify-content: space-between;">
                                    <span><i class="fa-solid fa-circle-check me-1"></i> আপনার প্রেরিত কোটেশন শর্তাবলী:</span>
                                    @if($inq->advance_amount_agreed)
                                        <span style="color: #065F46;">নির্ধারিত টোকেন মানি: <strong>৳{{ number_format($inq->advance_amount_agreed) }}</strong></span>
                                    @endif
                                </div>
                                <p style="margin: 0; color: #166534; line-height: 1.45;">"{{ $inq->seller_note }}"</p>
                            </div>
                        @endif
                    </div>

                    <!-- Comprehensive Action Controls Toolbar -->
                    <div style="display: flex; gap: 0.6rem; align-items: center; justify-content: space-between; flex-wrap: wrap; border-top: 1px solid rgba(0,0,0,0.06); padding-top: 1rem;">
                        <!-- Direct Communication Buttons -->
                        <div style="display: flex; gap: 0.45rem; align-items: center; flex-wrap: wrap;">
                            <button type="button" onclick="openChatModal({{ $inq->id }}, '{{ addslashes($inq->inquiringAgency->agency_name) }}')" style="background: #4F46E5; color: white; border: none; padding: 0.45rem 0.85rem; font-size: 0.82rem; font-weight: 700; border-radius: 8px; cursor: pointer; display: inline-flex; align-items: center; gap: 0.35rem; box-shadow: 0 2px 6px rgba(79,70,229,0.3); transition: 0.2s;" onmouseover="this.style.background='#4338CA'" onmouseout="this.style.background='#4F46E5'">
                                <i class="fa-solid fa-comments"></i> লাইভ চ্যাট
                            </button>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $inq->inquiringAgency->whatsapp ?? $inq->inquiringAgency->phone) }}?text=Salam%20agency,%20responding%20to%20your%20B2B%20inquiry%20regarding%20{{ urlencode($inq->post->title) }}" target="_blank" style="background: #25D366; color: white; text-decoration: none; padding: 0.45rem 0.85rem; font-size: 0.82rem; font-weight: 700; border-radius: 8px; display: inline-flex; align-items: center; gap: 0.35rem; box-shadow: 0 2px 6px rgba(37,211,102,0.25);">
                                <i class="fa-brands fa-whatsapp"></i> WhatsApp
                            </a>
                            <a href="tel:{{ $inq->inquiringAgency->phone }}" style="background: #0284C7; color: white; text-decoration: none; padding: 0.45rem 0.85rem; font-size: 0.82rem; font-weight: 700; border-radius: 8px; display: inline-flex; align-items: center; gap: 0.35rem;">
                                <i class="fa-solid fa-phone"></i> কল করুন
                            </a>
                            <button type="button" onclick="document.getElementById('dealDetailsModal_{{ $inq->id }}').style.display='flex'" style="background: #64748B; color: white; border: none; padding: 0.45rem 0.85rem; font-size: 0.82rem; font-weight: 700; border-radius: 8px; cursor: pointer; display: inline-flex; align-items: center; gap: 0.35rem;">
                                <i class="fa-solid fa-file-lines"></i> স্পেসিফিকেশন
                            </button>
                        </div>

                        <!-- Deal Progression & PDF Generation Buttons -->
                        <div style="display: flex; gap: 0.5rem; align-items: center; flex-wrap: wrap;">
                            @if($inq->status === 'accepted' || $inq->status === 'completed')
                                <a href="{{ route('posts.inquiry.quotation_letter', $inq->id) }}" target="_blank" style="background: white; border: 1.5px solid #0284C7; color: #0284C7; padding: 0.45rem 0.85rem; font-size: 0.82rem; font-weight: 700; border-radius: 8px; text-decoration: none; display: inline-flex; align-items: center; gap: 0.35rem;">
                                    <i class="fa-solid fa-file-invoice"></i> কোটেশন লেটার
                                </a>
                            @endif

                            @if($isCompleted)
                                <a href="{{ route('posts.inquiry.contract', $inq->id) }}" target="_blank" style="background: #047857; color: white; padding: 0.48rem 1rem; font-size: 0.85rem; font-weight: 800; border-radius: 8px; text-decoration: none; display: inline-flex; align-items: center; gap: 0.4rem; box-shadow: 0 2px 8px rgba(4,120,87,0.3);">
                                    <i class="fa-solid fa-file-contract"></i> বিটুবি চুক্তিপত্র (PDF)
                                </a>

                                @if(!$inq->hasReviewedBy(Auth::id()))
                                    <button type="button" onclick="openReviewModal({{ $inq->id }}, {{ $inq->inquiring_agency_id }}, '{{ addslashes($inq->inquiringAgency->agency_name) }}')" style="background: #FEF3C7; border: 1.5px solid #FCD34D; color: #92400E; padding: 0.45rem 0.85rem; font-size: 0.82rem; font-weight: 800; border-radius: 8px; cursor: pointer; display: inline-flex; align-items: center; gap: 0.35rem;">
                                        <i class="fa-solid fa-star text-amber-500"></i> বায়ারকে রিভিউ দিন
                                    </button>
                                @else
                                    <span style="background: #ECFDF5; color: #047857; font-size: 0.78rem; font-weight: 800; padding: 0.4rem 0.75rem; border-radius: 8px; border: 1px solid #A7F3D0; display: inline-flex; align-items: center; gap: 0.3rem;">
                                        <i class="fa-solid fa-circle-check"></i> রিভিউ সম্পন্ন
                                    </span>
                                @endif
                            @else
                                <!-- Seller Respond Form Button -->
                                <button type="button" onclick="document.getElementById('respondModal_{{ $inq->id }}').style.display='block'" style="background: #0284C7; color: white; border: none; padding: 0.45rem 0.85rem; font-size: 0.82rem; font-weight: 700; border-radius: 8px; cursor: pointer; display: inline-flex; align-items: center; gap: 0.35rem;">
                                    <i class="fa-solid fa-reply"></i> কোটেশন পাঠান
                                </button>

                                <!-- 2-Way Deal Done Button for Seller -->
                                @if($inq->status === 'pending')
                                    <button type="button" disabled style="padding: 0.45rem 0.85rem; font-size: 0.82rem; background: #E2E8F0; color: #94A3B8; cursor: not-allowed; border: 1px solid #CBD5E1; border-radius: 8px; font-weight: 700;" title="আগে কোটেশন পাঠান">
                                        <i class="fa-solid fa-lock"></i> ডিল কনফার্ম
                                    </button>
                                @else
                                    <form action="{{ route('posts.inquiry.confirm_deal', $inq->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @if($inq->seller_deal_done)
                                            <span style="background: #ECFDF5; color: #047857; font-size: 0.78rem; font-weight: 800; padding: 0.45rem 0.75rem; border-radius: 8px; border: 1px solid #A7F3D0; display: inline-flex; align-items: center; gap: 0.35rem;">
                                                <i class="fa-solid fa-check-double text-emerald-600"></i> এডভান্স গ্রহণ নিশ্চিত করেছেন
                                            </span>
                                        @else
                                            <button type="submit" style="background: #D97706; color: white; border: none; padding: 0.48rem 0.95rem; font-size: 0.82rem; font-weight: 800; border-radius: 8px; cursor: pointer; display: inline-flex; align-items: center; gap: 0.35rem; box-shadow: 0 2px 6px rgba(217,119,6,0.3);">
                                                <i class="fa-solid fa-handshake"></i> এডভান্স প্রাপ্তি ও ডিল কনফার্ম
                                            </button>
                                        @endif
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>

                    <!-- Full Deal Specifications Modal for Seller -->
                    <div id="dealDetailsModal_{{ $inq->id }}" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.65); z-index: 9999; align-items: center; justify-content: center; padding: 1rem; text-align: left;">
                        <div style="background: white; border-radius: 18px; padding: 1.75rem; max-width: 650px; width: 100%; max-height: 90vh; overflow-y: auto; border: 1px solid var(--border-color); box-shadow: 0 15px 35px rgba(0,0,0,0.25);">
                            <!-- Header -->
                            <div style="display: flex; justify-content: space-between; align-items: flex-start; border-bottom: 2px solid var(--accent); padding-bottom: 0.75rem; margin-bottom: 1.25rem;">
                                <div>
                                    <span class="badge" style="background: #ECFDF5; color: #047857; font-weight: 800; font-size: 0.75rem; padding: 0.2rem 0.6rem; border-radius: 12px; margin-bottom: 0.35rem; display: inline-block;">
                                        <i class="fa-solid fa-kaaba me-1"></i> {{ strtoupper($inq->post->hajj_or_umrah ?? 'UMRAH') }} B2B DEAL SPECIFICATIONS
                                    </span>
                                    <h3 style="font-size: 1.2rem; color: var(--primary-dark); font-weight: 800; margin: 0;">
                                        {{ $inq->post->title }}
                                    </h3>
                                </div>
                                <button type="button" onclick="document.getElementById('dealDetailsModal_{{ $inq->id }}').style.display='none'" style="border: none; background: #F1F5F9; width: 32px; height: 32px; border-radius: 50%; font-size: 1.2rem; cursor: pointer; color: #475569; display: flex; align-items: center; justify-content: center;">&times;</button>
                            </div>

                            <!-- 1. Flight Specs -->
                            <div style="background: #F8FAFC; border: 1px solid #E2E8F0; padding: 1rem; border-radius: 10px; margin-bottom: 1rem;">
                                <h4 style="font-size: 0.88rem; color: var(--primary-dark); font-weight: 700; margin-bottom: 0.5rem; text-transform: uppercase; border-bottom: 1px dashed #CBD5E1; padding-bottom: 0.25rem;">
                                    ✈️ ফ্লাইট ও টিকিট স্পেসিফিকেশন
                                </h4>
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; font-size: 0.85rem; color: var(--text-dark);">
                                    <div><strong>এয়ারলাইন্স:</strong> {{ $inq->post->airline }}</div>
                                    <div><strong>ফ্লাইটের তারিখ:</strong> {{ $inq->post->flight_date->format('d M, Y') }} ({{ $inq->post->departure_time ?? '16:00' }})</div>
                                    <div><strong>PNR রেফারেন্স:</strong> {{ $inq->post->pnr_code ?? 'Group Block Reserved' }}</div>
                                    <div><strong>রুট ও ডিপার্চার:</strong> {{ $inq->post->departure_city }} ➔ {{ $inq->post->route_sequence == 'madinah_first' ? 'Madinah (MED)' : 'Jeddah (JED)' }}</div>
                                    <div><strong>ট্রানজিট:</strong> {{ strtoupper($inq->post->flight_transit ?? 'Direct') }}</div>
                                    <div><strong>ব্যাগেজ অ্যালাউন্স:</strong> {{ $inq->post->baggage_allowance ?? '40 KG + 7 KG Hand' }}</div>
                                </div>
                            </div>

                            <!-- 2. Accommodation -->
                            @if($inq->post->makkah_hotel || $inq->post->madinah_hotel)
                                <div style="background: #FFFDF5; border: 1px solid #FDE68A; padding: 1rem; border-radius: 10px; margin-bottom: 1rem;">
                                    <h4 style="font-size: 0.88rem; color: #78350F; font-weight: 700; margin-bottom: 0.5rem; text-transform: uppercase; border-bottom: 1px dashed #FCD34D; padding-bottom: 0.25rem;">
                                        🏨 হোটেল আবাসন ও কাবার দূরত্ব
                                    </h4>
                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; font-size: 0.85rem;">
                                        @if($inq->post->makkah_hotel)
                                            <div>
                                                <strong>মক্কা হোটেল:</strong> {{ $inq->post->makkah_hotel }}<br>
                                                <span style="color: #047857; font-weight: 700;"><i class="fa-solid fa-person-walking"></i> {{ $inq->post->makkah_hotel_distance }} মি. (হাঁটা দূরত্ব {{ ceil($inq->post->makkah_hotel_distance / 80) }} মিনিট)</span>
                                            </div>
                                        @endif
                                        @if($inq->post->madinah_hotel)
                                            <div>
                                                <strong>মদিনা হোটেল:</strong> {{ $inq->post->madinah_hotel }}<br>
                                                <span style="color: #0284C7; font-weight: 700;"><i class="fa-solid fa-person-walking"></i> {{ $inq->post->madinah_hotel_distance }} মি. (মসজিদে নববী)</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <!-- 3. Financial & Proposal -->
                            <div style="background: #F0FDF4; border: 1px solid #BBF7D0; padding: 1rem; border-radius: 10px; margin-bottom: 1rem;">
                                <h4 style="font-size: 0.88rem; color: #166534; font-weight: 700; margin-bottom: 0.5rem; text-transform: uppercase; border-bottom: 1px dashed #86EFAC; padding-bottom: 0.25rem;">
                                    💰 ডিল লেনদেন ও প্রস্তাবের বিবরণ
                                </h4>
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; font-size: 0.85rem; color: #14532D;">
                                    <div><strong>অনুরোধকৃত সিট:</strong> {{ $inq->requested_seats }} Pax Seats</div>
                                    <div><strong>জনপ্রতি অফার দর:</strong> ৳{{ number_format($inq->offered_price_per_seat ?: $inq->post->price_per_seat) }}</div>
                                    <div><strong>মোট ডিল মান:</strong> ৳{{ number_format($inq->requested_seats * ($inq->offered_price_per_seat ?: $inq->post->price_per_seat)) }}</div>
                                    <div><strong>অগ্রিম টোকেন মানি:</strong> ৳{{ number_format($inq->advance_amount_agreed ?: ($inq->post->advance_deposit * $inq->requested_seats)) }}</div>
                                </div>
                                <div style="margin-top: 0.5rem; padding-top: 0.5rem; border-top: 1px solid #BBF7D0; font-size: 0.83rem;">
                                    <div><strong>বায়ারের নোট:</strong> "{{ $inq->message }}"</div>
                                    @if($inq->seller_note)
                                        <div style="margin-top: 0.25rem; color: #047857;"><strong>আপনার কোটেশন নোট:</strong> "{{ $inq->seller_note }}"</div>
                                    @endif
                                </div>
                            </div>

                            <!-- 4. Partner Agency Contact -->
                            <div style="background: #F8FAFC; border: 1px solid #E2E8F0; padding: 1rem; border-radius: 10px; font-size: 0.85rem;">
                                <h4 style="font-size: 0.88rem; color: var(--primary-dark); font-weight: 700; margin-bottom: 0.5rem; text-transform: uppercase;">
                                    🏢 বায়ার এজেন্সি তথ্য
                                </h4>
                                <div><strong>বায়ার এজেন্সি:</strong> {{ $inq->inquiringAgency->agency_name }} ({{ $inq->inquiringAgency->owner_name }})</div>
                                <div><strong>HAAB / লাইসেন্স:</strong> {{ $inq->inquiringAgency->haab_no ?? $inq->inquiringAgency->license_no }}</div>
                                <div><strong>মোবাইল:</strong> {{ $inq->inquiringAgency->phone }} | <strong>ঠিকানা:</strong> {{ $inq->inquiringAgency->address }}</div>
                            </div>

                            <div style="margin-top: 1.25rem; text-align: right;">
                                <button type="button" onclick="document.getElementById('dealDetailsModal_{{ $inq->id }}').style.display='none'" class="btn-primary" style="background: var(--primary); padding: 0.5rem 1.25rem; border-radius: 8px;">
                                    ঠিক আছে / বন্ধ করুন
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Inline Seller Quotation Respond Form Modal -->
                    <div id="respondModal_{{ $inq->id }}" style="display: none; background: #FFFDF5; border: 2px solid #FDE68A; border-radius: 14px; padding: 1.25rem; margin-top: 0.5rem;">
                        <h5 style="font-size: 0.95rem; color: #78350F; font-weight: 800; margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.4rem;">
                            <i class="fa-solid fa-reply"></i> Respond Quotation Terms to {{ $inq->inquiringAgency->agency_name }}
                        </h5>
                        <form action="{{ route('posts.inquiry.respond', $inq->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="accepted">
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; margin-bottom: 0.75rem;">
                                <div>
                                    <label style="display: block; font-size: 0.78rem; font-weight: 700; color: #78350F; margin-bottom: 0.25rem;">জনপ্রতি দর (Rate Per Seat BDT) *</label>
                                    <input type="number" name="offered_price_per_seat" value="{{ $inq->offered_price_per_seat ?: $inq->post->price_per_seat }}" style="width: 100%; padding: 0.55rem; border: 1.5px solid #FCD34D; border-radius: 8px; font-size: 0.88rem; outline: none;">
                                </div>
                                <div>
                                    <label style="display: block; font-size: 0.78rem; font-weight: 700; color: #78350F; margin-bottom: 0.25rem;">প্রয়োজনীয় অগ্রিম টোকেন (Advance Token BDT) *</label>
                                    <input type="number" name="advance_amount_agreed" value="{{ $inq->post->advance_deposit }}" placeholder="e.g. 15000" style="width: 100%; padding: 0.55rem; border: 1.5px solid #FCD34D; border-radius: 8px; font-size: 0.88rem; outline: none;">
                                </div>
                            </div>
                            <div style="margin-bottom: 0.75rem;">
                                <label style="display: block; font-size: 0.78rem; font-weight: 700; color: #78350F; margin-bottom: 0.25rem;">আপনার কোটেশন নোট ও পেমেন্ট শর্তাবলী</label>
                                <textarea name="seller_note" rows="2" placeholder="e.g. ৫টি সিট নিশ্চিত করা যাবে। অগ্রিম টোকেন মানি দ্রুত ব্যাংকে জমা দিন..." style="width: 100%; padding: 0.55rem; border: 1.5px solid #FCD34D; border-radius: 8px; font-size: 0.85rem; font-family: inherit; outline: none;">{{ $inq->seller_note }}</textarea>
                            </div>
                            <div style="display: flex; gap: 0.5rem; justify-content: flex-end;">
                                <button type="button" onclick="document.getElementById('respondModal_{{ $inq->id }}').style.display='none'" style="background: #94A3B8; color: white; border: none; padding: 0.45rem 0.9rem; font-size: 0.82rem; font-weight: 700; border-radius: 6px; cursor: pointer;">বাতিল</button>
                                <button type="submit" class="btn-gold" style="padding: 0.45rem 1rem; font-size: 0.82rem; font-weight: 800; border-radius: 6px;">
                                    <i class="fa-solid fa-paper-plane me-1"></i> কোটেশন রেসপন্স পাঠান
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @empty
                <div style="text-align: center; padding: 3rem 1.5rem; background: #F8FAFC; border-radius: 14px; border: 1px dashed var(--border-color); color: var(--text-muted);">
                    <i class="fa-solid fa-inbox" style="font-size: 2.8rem; color: #CBD5E1; margin-bottom: 0.75rem; display: block;"></i>
                    <p style="font-size: 0.95rem; margin: 0;">আপনার পোস্টে কোনো ইনকামিং B2B প্রস্তাব বা ইনকোয়ারি জমা পড়েনি।</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Section 3: My Sent B2B Deal Proposals -->
    <div id="sent-proposals-section" class="responsive-card-padding" style="background: white; border-radius: 18px; padding: 1.75rem; border: 1px solid var(--border-color); box-shadow: 0 4px 15px rgba(0,0,0,0.03); margin-bottom: 2.5rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem; border-bottom: 1px solid #F1F5F9; padding-bottom: 1rem;">
            <div>
                <h3 class="font-heading" style="font-size: 1.35rem; color: var(--primary-dark); margin: 0; display: flex; align-items: center; gap: 0.6rem;">
                    <span style="width: 38px; height: 38px; background: #FFFBEB; color: #D97706; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; font-size: 1.1rem;">
                        <i class="fa-solid fa-paper-plane"></i>
                    </span>
                    My Sent B2B Proposals & Deal Tracking
                </h3>
                <p style="margin: 0.35rem 0 0; font-size: 0.85rem; color: var(--text-muted);">
                    অন্যান্য এজেন্সির অফারে আপনার পাঠানো রিকোয়ারমেন্ট, সেলার কোটেশন অগ্রগতি ও চুক্তি ট্র্যাকিং
                </p>
            </div>
            <div>
                <span style="background: #FFFBEB; color: #B45309; font-weight: 700; font-size: 0.82rem; padding: 0.4rem 0.85rem; border-radius: 20px; border: 1px solid #FDE68A;">
                    মোট প্রেরিত প্রস্তাব: <strong>{{ $sentInquiries->count() }}</strong> টি
                </span>
            </div>
        </div>

        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            @forelse($sentInquiries as $sInq)
                @php
                    $isCompleted = $sInq->status === 'completed';
                    $isAccepted = $sInq->status === 'accepted';
                    $borderColor = $isCompleted ? '#059669' : ($isAccepted ? '#D97706' : '#6366F1');
                    $bgColor = $isCompleted ? '#FAFCFA' : ($isAccepted ? '#FFFCF5' : '#F8FAFC');
                @endphp
                <div style="background: {{ $bgColor }}; border: 1px solid var(--border-color); border-left: 6px solid {{ $borderColor }}; border-radius: 16px; padding: 1.5rem; display: flex; flex-direction: column; gap: 1.25rem; box-shadow: 0 3px 12px rgba(0,0,0,0.03); transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                    <!-- Card Top: Seller Profile & Deal Status -->
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 1rem;">
                        <div style="display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;">
                            <div style="width: 48px; height: 48px; border-radius: 14px; background: linear-gradient(135deg, #1E293B, #0F172A); color: #F8FAFC; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.25rem; flex-shrink: 0; box-shadow: 0 4px 10px rgba(15,23,42,0.2);">
                                {{ strtoupper(substr($sInq->post->agency->agency_name, 0, 1)) }}
                            </div>
                            <div>
                                <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.25rem; flex-wrap: wrap;">
                                    <h4 style="font-size: 1.1rem; color: var(--primary-dark); font-weight: 800; margin: 0;">
                                        সেলার: {{ $sInq->post->agency->agency_name }}
                                    </h4>
                                    <span class="badge badge-verified" style="font-size: 0.72rem; padding: 0.2rem 0.55rem;">
                                        <i class="fa-solid fa-certificate"></i> লাইসেন্স: {{ $sInq->post->agency->license_no }}
                                    </span>
                                </div>
                                <div style="font-size: 0.82rem; color: var(--text-muted); display: flex; gap: 0.6rem; flex-wrap: wrap; align-items: center;">
                                    <span><i class="fa-solid fa-user-tie"></i> {{ $sInq->post->agency->owner_name }}</span>
                                    <span>•</span>
                                    <span><i class="fa-solid fa-location-dot"></i> {{ $sInq->post->agency->city ?? 'Bangladesh' }}</span>
                                    <span>•</span>
                                    <span><i class="fa-solid fa-clock"></i> প্রেরিত: {{ $sInq->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            @if($isCompleted)
                                <span style="background: #ECFDF5; color: #047857; border: 1.5px solid #A7F3D0; font-weight: 800; font-size: 0.82rem; padding: 0.4rem 0.9rem; border-radius: 20px; display: inline-flex; align-items: center; gap: 0.4rem;">
                                    <i class="fa-solid fa-check-double text-emerald-600"></i> ডিল সম্পন্ন (DEAL COMPLETED)
                                </span>
                            @elseif($isAccepted)
                                <span style="background: #FFFBEB; color: #B45309; border: 1.5px solid #FCD34D; font-weight: 800; font-size: 0.82rem; padding: 0.4rem 0.9rem; border-radius: 20px; display: inline-flex; align-items: center; gap: 0.4rem;">
                                    <i class="fa-solid fa-file-invoice text-amber-600"></i> সেলার কোটেশন দিয়েছেন (QUOTED)
                                </span>
                            @else
                                <span style="background: #EEF2FF; color: #4338CA; border: 1.5px solid #C7D2FE; font-weight: 800; font-size: 0.82rem; padding: 0.4rem 0.9rem; border-radius: 20px; display: inline-flex; align-items: center; gap: 0.4rem;">
                                    <i class="fa-solid fa-hourglass-half text-indigo-600"></i> উত্তরের অপেক্ষায় (WAITING SELLER)
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Post Context Tag -->
                    <div style="background: rgba(255,255,255,0.7); border: 1px solid var(--border-color); border-radius: 10px; padding: 0.65rem 0.9rem; font-size: 0.85rem; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.5rem;">
                        <div>
                            <span style="color: var(--text-muted); font-size: 0.8rem;">অফারকৃত পোস্ট:</span>
                            <strong style="color: var(--primary-dark); margin-left: 0.35rem;">
                                <a href="{{ route('posts.show', $sInq->post_id) }}" target="_blank" style="color: inherit; text-decoration: none;">
                                    {{ $sInq->post->title }} <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 0.75rem;"></i>
                                </a>
                            </strong>
                        </div>
                        <div style="font-size: 0.8rem; color: var(--text-muted);">
                            ফ্লাইট: <strong>{{ $sInq->post->flight_date->format('d M, Y') }}</strong> ({{ $sInq->post->airline ?? 'Biman / Saudia' }})
                        </div>
                    </div>

                    <!-- Financial & Pax Metrics Grid -->
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(130px, 1fr)); gap: 0.75rem;">
                        <div style="background: white; border: 1px solid var(--border-color); border-radius: 12px; padding: 0.85rem; text-align: center;">
                            <div style="font-size: 0.74rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase;">অনুরোধকৃত সিট</div>
                            <div style="font-size: 1.35rem; font-weight: 800; color: #DC2626; margin-top: 0.15rem;">{{ $sInq->requested_seats }} Pax</div>
                        </div>
                        <div style="background: white; border: 1px solid var(--border-color); border-radius: 12px; padding: 0.85rem; text-align: center;">
                            <div style="font-size: 0.74rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase;">জনপ্রতি অফার দর</div>
                            <div style="font-size: 1.15rem; font-weight: 800; color: var(--primary-dark); margin-top: 0.15rem;">
                                ৳{{ number_format($sInq->offered_price_per_seat ?: $sInq->post->price_per_seat) }}
                            </div>
                        </div>
                        <div style="background: white; border: 1px solid var(--border-color); border-radius: 12px; padding: 0.85rem; text-align: center;">
                            <div style="font-size: 0.74rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase;">মোট ডিল মান</div>
                            <div style="font-size: 1.15rem; font-weight: 800; color: #047857; margin-top: 0.15rem;">
                                ৳{{ number_format($sInq->requested_seats * ($sInq->offered_price_per_seat ?: $sInq->post->price_per_seat)) }}
                            </div>
                        </div>
                        <div style="background: white; border: 1px solid var(--border-color); border-radius: 12px; padding: 0.85rem; text-align: center;">
                            <div style="font-size: 0.74rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase;">অগ্রিম টোকেন মানি</div>
                            <div style="font-size: 1.15rem; font-weight: 800; color: #D97706; margin-top: 0.15rem;">
                                ৳{{ number_format($sInq->advance_amount_agreed ?: ($sInq->post->advance_deposit * $sInq->requested_seats)) }}
                            </div>
                        </div>
                    </div>

                    <!-- Notes -->
                    <div style="display: flex; flex-direction: column; gap: 0.6rem;">
                        <div style="background: white; border: 1px solid #E2E8F0; padding: 0.85rem 1.1rem; border-radius: 10px; font-size: 0.88rem;">
                            <div style="font-size: 0.75rem; font-weight: 800; color: #6366F1; text-transform: uppercase; margin-bottom: 0.25rem;">
                                <i class="fa-solid fa-quote-left me-1"></i> আপনার প্রেরিত প্রপোজাল বার্তা:
                            </div>
                            <p style="margin: 0; color: var(--text-dark); line-height: 1.45;">"{{ $sInq->message }}"</p>
                        </div>

                        @if($sInq->seller_note)
                            <div style="background: #F0FDF4; border: 1px solid #BBF7D0; padding: 0.85rem 1.1rem; border-radius: 10px; font-size: 0.88rem;">
                                <div style="font-size: 0.75rem; font-weight: 800; color: #047857; text-transform: uppercase; margin-bottom: 0.25rem; display: flex; justify-content: space-between;">
                                    <span><i class="fa-solid fa-circle-check me-1"></i> সেলারের কোটেশন উত্তর:</span>
                                    @if($sInq->advance_amount_agreed)
                                        <span style="color: #065F46;">প্রয়োজনীয় টোকেন মানি: <strong>৳{{ number_format($sInq->advance_amount_agreed) }}</strong></span>
                                    @endif
                                </div>
                                <p style="margin: 0; color: #166534; line-height: 1.45;">"{{ $sInq->seller_note }}"</p>
                            </div>
                        @endif
                    </div>

                    <!-- Actions for Buyer -->
                    <div style="display: flex; gap: 0.6rem; align-items: center; justify-content: space-between; flex-wrap: wrap; border-top: 1px solid rgba(0,0,0,0.06); padding-top: 1rem;">
                        <div style="display: flex; gap: 0.45rem; align-items: center; flex-wrap: wrap;">
                            <button type="button" onclick="openChatModal({{ $sInq->id }}, '{{ addslashes($sInq->post->agency->agency_name) }}')" style="background: #4F46E5; color: white; border: none; padding: 0.45rem 0.85rem; font-size: 0.82rem; font-weight: 700; border-radius: 8px; cursor: pointer; display: inline-flex; align-items: center; gap: 0.35rem; box-shadow: 0 2px 6px rgba(79,70,229,0.3); transition: 0.2s;" onmouseover="this.style.background='#4338CA'" onmouseout="this.style.background='#4F46E5'">
                                <i class="fa-solid fa-comments"></i> লাইভ চ্যাট
                            </button>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $sInq->post->agency->whatsapp ?? $sInq->post->agency->phone) }}?text=Salam%20agency,%20following%20up%20on%20my%20B2B%20proposal%20for%20{{ urlencode($sInq->post->title) }}" target="_blank" style="background: #25D366; color: white; text-decoration: none; padding: 0.45rem 0.85rem; font-size: 0.82rem; font-weight: 700; border-radius: 8px; display: inline-flex; align-items: center; gap: 0.35rem; box-shadow: 0 2px 6px rgba(37,211,102,0.25);">
                                <i class="fa-brands fa-whatsapp"></i> WhatsApp
                            </a>
                            <a href="tel:{{ $sInq->post->agency->phone }}" style="background: #0284C7; color: white; text-decoration: none; padding: 0.45rem 0.85rem; font-size: 0.82rem; font-weight: 700; border-radius: 8px; display: inline-flex; align-items: center; gap: 0.35rem;">
                                <i class="fa-solid fa-phone"></i> কল করুন
                            </a>
                            <button type="button" onclick="document.getElementById('sentDealDetailsModal_{{ $sInq->id }}').style.display='flex'" style="background: #64748B; color: white; border: none; padding: 0.45rem 0.85rem; font-size: 0.82rem; font-weight: 700; border-radius: 8px; cursor: pointer; display: inline-flex; align-items: center; gap: 0.35rem;">
                                <i class="fa-solid fa-file-lines"></i> স্পেসিফিকেশন
                            </button>
                        </div>

                        <div style="display: flex; gap: 0.5rem; align-items: center; flex-wrap: wrap;">
                            @if($sInq->status === 'accepted' || $sInq->status === 'completed')
                                <a href="{{ route('posts.inquiry.quotation_letter', $sInq->id) }}" target="_blank" style="background: white; border: 1.5px solid #0284C7; color: #0284C7; padding: 0.45rem 0.85rem; font-size: 0.82rem; font-weight: 700; border-radius: 8px; text-decoration: none; display: inline-flex; align-items: center; gap: 0.35rem;">
                                    <i class="fa-solid fa-file-invoice"></i> কোটেশন লেটার
                                </a>
                            @endif

                            @if($isCompleted)
                                <a href="{{ route('posts.inquiry.contract', $sInq->id) }}" target="_blank" style="background: #047857; color: white; padding: 0.48rem 1rem; font-size: 0.85rem; font-weight: 800; border-radius: 8px; text-decoration: none; display: inline-flex; align-items: center; gap: 0.4rem; box-shadow: 0 2px 8px rgba(4,120,87,0.3);">
                                    <i class="fa-solid fa-file-contract"></i> বিটুবি চুক্তিপত্র (PDF)
                                </a>

                                @if(!$sInq->hasReviewedBy(Auth::id()))
                                    <button type="button" onclick="openReviewModal({{ $sInq->id }}, {{ $sInq->post->agency_id }}, '{{ addslashes($sInq->post->agency->agency_name) }}')" style="background: #FEF3C7; border: 1.5px solid #FCD34D; color: #92400E; padding: 0.45rem 0.85rem; font-size: 0.82rem; font-weight: 800; border-radius: 8px; cursor: pointer; display: inline-flex; align-items: center; gap: 0.35rem;">
                                        <i class="fa-solid fa-star text-amber-500"></i> সেলারকে রিভিউ দিন
                                    </button>
                                @else
                                    <span style="background: #ECFDF5; color: #047857; font-size: 0.78rem; font-weight: 800; padding: 0.4rem 0.75rem; border-radius: 8px; border: 1px solid #A7F3D0; display: inline-flex; align-items: center; gap: 0.3rem;">
                                        <i class="fa-solid fa-circle-check"></i> রিভিউ সম্পন্ন
                                    </span>
                                @endif
                            @else
                                @if($sInq->status === 'pending')
                                    <button type="button" disabled style="padding: 0.45rem 0.85rem; font-size: 0.82rem; background: #E2E8F0; color: #94A3B8; cursor: not-allowed; border: 1px solid #CBD5E1; border-radius: 8px; font-weight: 700;" title="সেলার এজেন্সির কোটেশন উত্তরের অপেক্ষায়">
                                        <i class="fa-solid fa-clock"></i> কোটেশন অপেক্ষমান
                                    </button>
                                @else
                                    <!-- 2-Way Deal Done Button for Buyer -->
                                    <form action="{{ route('posts.inquiry.confirm_deal', $sInq->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @if($sInq->buyer_deal_done)
                                            <span style="background: #ECFDF5; color: #047857; font-size: 0.78rem; font-weight: 800; padding: 0.45rem 0.75rem; border-radius: 8px; border: 1px solid #A7F3D0; display: inline-flex; align-items: center; gap: 0.35rem;">
                                                <i class="fa-solid fa-check-double text-emerald-600"></i> এডভান্স পেমেন্ট নিশ্চিত করেছেন
                                            </span>
                                        @else
                                            <button type="submit" style="background: #D97706; color: white; border: none; padding: 0.48rem 0.95rem; font-size: 0.82rem; font-weight: 800; border-radius: 8px; cursor: pointer; display: inline-flex; align-items: center; gap: 0.35rem; box-shadow: 0 2px 6px rgba(217,119,6,0.3);">
                                                <i class="fa-solid fa-handshake"></i> এডভান্স প্রদান ও ডিল কনফার্ম
                                            </button>
                                        @endif
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>

                    <!-- Full Deal Specifications Modal for Buyer -->
                    <div id="sentDealDetailsModal_{{ $sInq->id }}" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.65); z-index: 9999; align-items: center; justify-content: center; padding: 1rem; text-align: left;">
                        <div style="background: white; border-radius: 18px; padding: 1.75rem; max-width: 650px; width: 100%; max-height: 90vh; overflow-y: auto; border: 1px solid var(--border-color); box-shadow: 0 15px 35px rgba(0,0,0,0.25);">
                            <!-- Header -->
                            <div style="display: flex; justify-content: space-between; align-items: flex-start; border-bottom: 2px solid var(--accent); padding-bottom: 0.75rem; margin-bottom: 1.25rem;">
                                <div>
                                    <span class="badge" style="background: #ECFDF5; color: #047857; font-weight: 800; font-size: 0.75rem; padding: 0.2rem 0.6rem; border-radius: 12px; margin-bottom: 0.35rem; display: inline-block;">
                                        <i class="fa-solid fa-kaaba me-1"></i> {{ strtoupper($sInq->post->hajj_or_umrah ?? 'UMRAH') }} B2B DEAL SPECIFICATIONS
                                    </span>
                                    <h3 style="font-size: 1.2rem; color: var(--primary-dark); font-weight: 800; margin: 0;">
                                        {{ $sInq->post->title }}
                                    </h3>
                                </div>
                                <button type="button" onclick="document.getElementById('sentDealDetailsModal_{{ $sInq->id }}').style.display='none'" style="border: none; background: #F1F5F9; width: 32px; height: 32px; border-radius: 50%; font-size: 1.2rem; cursor: pointer; color: #475569; display: flex; align-items: center; justify-content: center;">&times;</button>
                            </div>

                            <!-- 1. Flight Specs -->
                            <div style="background: #F8FAFC; border: 1px solid #E2E8F0; padding: 1rem; border-radius: 10px; margin-bottom: 1rem;">
                                <h4 style="font-size: 0.88rem; color: var(--primary-dark); font-weight: 700; margin-bottom: 0.5rem; text-transform: uppercase; border-bottom: 1px dashed #CBD5E1; padding-bottom: 0.25rem;">
                                    ✈️ ফ্লাইট ও টিকিট স্পেসিফিকেশন
                                </h4>
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; font-size: 0.85rem; color: var(--text-dark);">
                                    <div><strong>এয়ারলাইন্স:</strong> {{ $sInq->post->airline }}</div>
                                    <div><strong>ফ্লাইটের তারিখ:</strong> {{ $sInq->post->flight_date->format('d M, Y') }} ({{ $sInq->post->departure_time ?? '16:00' }})</div>
                                    <div><strong>PNR রেফারেন্স:</strong> {{ $sInq->post->pnr_code ?? 'Group Block Reserved' }}</div>
                                    <div><strong>রুট ও ডিপার্চার:</strong> {{ $sInq->post->departure_city }} ➔ {{ $sInq->post->route_sequence == 'madinah_first' ? 'Madinah (MED)' : 'Jeddah (JED)' }}</div>
                                    <div><strong>ট্রানজিট:</strong> {{ strtoupper($sInq->post->flight_transit ?? 'Direct') }}</div>
                                    <div><strong>ব্যাগেজ অ্যালাউন্স:</strong> {{ $sInq->post->baggage_allowance ?? '40 KG + 7 KG Hand' }}</div>
                                </div>
                            </div>

                            <!-- 2. Accommodation -->
                            @if($sInq->post->makkah_hotel || $sInq->post->madinah_hotel)
                                <div style="background: #FFFDF5; border: 1px solid #FDE68A; padding: 1rem; border-radius: 10px; margin-bottom: 1rem;">
                                    <h4 style="font-size: 0.88rem; color: #78350F; font-weight: 700; margin-bottom: 0.5rem; text-transform: uppercase; border-bottom: 1px dashed #FCD34D; padding-bottom: 0.25rem;">
                                        🏨 হোটেল আবাসন ও কাবার দূরত্ব
                                    </h4>
                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; font-size: 0.85rem;">
                                        @if($sInq->post->makkah_hotel)
                                            <div>
                                                <strong>মক্কা হোটেল:</strong> {{ $sInq->post->makkah_hotel }}<br>
                                                <span style="color: #047857; font-weight: 700;"><i class="fa-solid fa-person-walking"></i> {{ $sInq->post->makkah_hotel_distance }} মি. (হাঁটা দূরত্ব {{ ceil($sInq->post->makkah_hotel_distance / 80) }} মিনিট)</span>
                                            </div>
                                        @endif
                                        @if($sInq->post->madinah_hotel)
                                            <div>
                                                <strong>মদিনা হোটেল:</strong> {{ $sInq->post->madinah_hotel }}<br>
                                                <span style="color: #0284C7; font-weight: 700;"><i class="fa-solid fa-person-walking"></i> {{ $sInq->post->madinah_hotel_distance }} মি. (মসজিদে নববী)</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <!-- 3. Financial & Proposal -->
                            <div style="background: #F0FDF4; border: 1px solid #BBF7D0; padding: 1rem; border-radius: 10px; margin-bottom: 1rem;">
                                <h4 style="font-size: 0.88rem; color: #166534; font-weight: 700; margin-bottom: 0.5rem; text-transform: uppercase; border-bottom: 1px dashed #86EFAC; padding-bottom: 0.25rem;">
                                    💰 ডিল লেনদেন ও প্রস্তাবের বিবরণ
                                </h4>
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; font-size: 0.85rem; color: #14532D;">
                                    <div><strong>অনুরোধকৃত সিট:</strong> {{ $sInq->requested_seats }} Pax Seats</div>
                                    <div><strong>জনপ্রতি অফার দর:</strong> ৳{{ number_format($sInq->offered_price_per_seat ?: $sInq->post->price_per_seat) }}</div>
                                    <div><strong>মোট ডিল মান:</strong> ৳{{ number_format($sInq->requested_seats * ($sInq->offered_price_per_seat ?: $sInq->post->price_per_seat)) }}</div>
                                    <div><strong>অগ্রিম টোকেন মানি:</strong> ৳{{ number_format($sInq->advance_amount_agreed ?: ($sInq->post->advance_deposit * $sInq->requested_seats)) }}</div>
                                </div>
                                <div style="margin-top: 0.5rem; padding-top: 0.5rem; border-top: 1px solid #BBF7D0; font-size: 0.83rem;">
                                    <div><strong>আপনার প্রপোজাল নোট:</strong> "{{ $sInq->message }}"</div>
                                    @if($sInq->seller_note)
                                        <div style="margin-top: 0.25rem; color: #047857;"><strong>সেলার কোটেশন উত্তর:</strong> "{{ $sInq->seller_note }}"</div>
                                    @endif
                                </div>
                            </div>

                            <!-- 4. Partner Agency Contact -->
                            <div style="background: #F8FAFC; border: 1px solid #E2E8F0; padding: 1rem; border-radius: 10px; font-size: 0.85rem;">
                                <h4 style="font-size: 0.88rem; color: var(--primary-dark); font-weight: 700; margin-bottom: 0.5rem; text-transform: uppercase;">
                                    🏢 সেলার এজেন্সি তথ্য
                                </h4>
                                <div><strong>সেলার এজেন্সি:</strong> {{ $sInq->post->agency->agency_name }} ({{ $sInq->post->agency->owner_name }})</div>
                                <div><strong>HAAB / লাইসেন্স:</strong> {{ $sInq->post->agency->haab_no ?? $sInq->post->agency->license_no }}</div>
                                <div><strong>মোবাইল:</strong> {{ $sInq->post->agency->phone }} | <strong>ঠিকানা:</strong> {{ $sInq->post->agency->address }}</div>
                            </div>

                            <div style="margin-top: 1.25rem; text-align: right;">
                                <button type="button" onclick="document.getElementById('sentDealDetailsModal_{{ $sInq->id }}').style.display='none'" class="btn-primary" style="background: var(--primary); padding: 0.5rem 1.25rem; border-radius: 8px;">
                                    ঠিক আছে / বন্ধ করুন
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div style="text-align: center; padding: 3rem 1.5rem; background: #F8FAFC; border-radius: 14px; border: 1px dashed var(--border-color); color: var(--text-muted);">
                    <i class="fa-solid fa-paper-plane" style="font-size: 2.8rem; color: #CBD5E1; margin-bottom: 0.75rem; display: block;"></i>
                    <p style="font-size: 0.95rem; margin-bottom: 0.75rem;">আপনি এখনো কোনো বিটুবি পোস্টে প্রস্তাব বা কোটেশন রিকোয়েস্ট পাঠাননি।</p>
                    <a href="{{ route('posts.index') }}" class="btn-primary" style="display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.6rem 1.4rem;">
                        <i class="fa-solid fa-magnifying-glass"></i> বিটুবি মার্কেটপ্লেস ব্রাউজ করুন
                    </a>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Section 4: Subscription & Payment Transaction History -->
    <div id="billing-section" class="responsive-card-padding" style="background: white; border-radius: 18px; padding: 1.75rem; border: 1px solid var(--border-color); margin-bottom: 2.5rem; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem; border-bottom: 1px solid #F1F5F9; padding-bottom: 1rem;">
            <div>
                <h3 class="font-heading" style="font-size: 1.35rem; color: var(--primary-dark); margin: 0; display: flex; align-items: center; gap: 0.6rem;">
                    <span style="width: 38px; height: 38px; background: #EEF2FF; color: #4F46E5; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; font-size: 1.1rem;">
                        <i class="fa-solid fa-file-invoice-dollar"></i>
                    </span>
                    Subscriptions & Billing History
                </h3>
                <p style="font-size: 0.85rem; color: var(--text-muted); margin: 0.35rem 0 0;">
                    আপনার সাবস্ক্রিপশন মেম্বারশিপ, ম্যানুয়াল পেমেন্ট ভেরিফিকেশন (bKash, Nagad, Rocket, Upay) ও চালান ট্র্যাকিং
                </p>
            </div>

            <div>
                @if(\App\Models\SiteSetting::isFreeMode())
                    <span style="background: #ECFDF5; color: #047857; font-weight: 800; font-size: 0.82rem; padding: 0.45rem 1rem; border-radius: 20px; border: 1px solid #A7F3D0; display: inline-flex; align-items: center; gap: 0.4rem;">
                        <i class="fa-solid fa-gift text-emerald-600"></i> ১০০% ফ্রি মোড সক্রিয় (জিরো ফি)
                    </span>
                @else
                    <a href="{{ route('payment.checkout') }}" class="btn-gold" style="padding: 0.55rem 1.25rem; font-size: 0.85rem; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 0.4rem; box-shadow: 0 4px 12px rgba(212,175,55,0.25);">
                        <i class="fa-solid fa-crown"></i> নতুন প্ল্যান আপগ্রেড / রিনিউ
                    </a>
                @endif
            </div>
        </div>

        @if(\App\Models\SiteSetting::isFreeMode())
            <div style="background: linear-gradient(135deg, #ECFDF5, #F0FDF4); border: 1.5px solid #A7F3D0; border-radius: 14px; padding: 1.25rem 1.5rem; margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: space-between; gap: 1.25rem; flex-wrap: wrap;">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="width: 46px; height: 46px; border-radius: 12px; background: #047857; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0; box-shadow: 0 3px 8px rgba(4,120,87,0.25);">
                        <i class="fa-solid fa-sparkles"></i>
                    </div>
                    <div>
                        <h4 style="font-size: 1.05rem; font-weight: 800; color: #065F46; margin: 0 0 0.2rem 0;">
                            বর্তমানে প্ল্যাটফর্মটি ১০০% ফ্রি প্রোমোশনাল মোডে চালু রয়েছে
                        </h4>
                        <p style="margin: 0; font-size: 0.85rem; color: #047857; line-height: 1.45;">
                            সকল ভেরিফাইড এজেন্সির জন্য পোস্ট তৈরি, চুক্তিপত্র ডাউনলোড ও আনলিমিটেড ডিল পরিচালনা সম্পূর্ণ চার্জমুক্ত। ভবিষ্যতে পেইড সিস্টেম চালু হলে আপনি এখান থেকেই পেইড প্ল্যান গ্রহণ করতে পারবেন।
                        </p>
                    </div>
                </div>
                <span style="background: #047857; color: white; font-weight: 800; padding: 0.4rem 0.9rem; border-radius: 20px; font-size: 0.78rem; display: inline-flex; align-items: center; gap: 0.35rem;">
                    <i class="fa-solid fa-circle-check"></i> নো সাবস্ক্রিপশন ফি
                </span>
            </div>
        @endif

        @if($activeSubscription)
            <div style="background: linear-gradient(135deg, #044E35, #023624); color: white; padding: 1.35rem 1.6rem; border-radius: 14px; margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; border: 1px solid #D4AF37; box-shadow: 0 4px 15px rgba(4,78,53,0.2);">
                <div>
                    <span style="font-size: 0.76rem; text-transform: uppercase; letter-spacing: 1px; color: #F3E5AB; font-weight: 800;">ACTIVE PLAN MEMBERSHIP</span>
                    <h4 style="margin: 0.2rem 0; font-size: 1.35rem; color: white; text-transform: capitalize; font-weight: 800;">
                        {{ $activeSubscription->plan_name }} VIP Membership
                    </h4>
                    <span style="font-size: 0.82rem; color: #CBD5E1;">
                        <i class="fa-regular fa-calendar-check me-1 text-emerald-400"></i> মেয়াদ শেষ: {{ optional($activeSubscription->ends_at)->format('d M, Y') ?? 'Ongoing' }}
                    </span>
                </div>
                <div style="background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3); padding: 0.5rem 1.1rem; border-radius: 20px; font-weight: 800; font-size: 0.85rem; color: #F3E5AB;">
                    <i class="fa-solid fa-circle-check text-emerald-400 me-1"></i> ভেরিফায়েড একটিভ সাবস্ক্রিপশন
                </div>
            </div>
        @endif

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: separate; border-spacing: 0; text-align: left; font-size: 0.88rem;">
                <thead>
                    <tr style="background: #F8FAFC; color: var(--text-muted); font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.5px;">
                        <th style="padding: 1rem 1.1rem; border-top: 1px solid var(--border-color); border-bottom: 2px solid var(--border-color); border-top-left-radius: 10px;">পেমেন্ট তারিখ</th>
                        <th style="padding: 1rem 0.85rem; border-top: 1px solid var(--border-color); border-bottom: 2px solid var(--border-color);">মেথড ও প্রেরক নম্বর</th>
                        <th style="padding: 1rem 0.85rem; border-top: 1px solid var(--border-color); border-bottom: 2px solid var(--border-color);">ট্রানজাকশন আইডি (TrxID)</th>
                        <th style="padding: 1rem 0.85rem; border-top: 1px solid var(--border-color); border-bottom: 2px solid var(--border-color);">টাকার পরিমাণ</th>
                        <th style="padding: 1rem 1.1rem; border-top: 1px solid var(--border-color); border-bottom: 2px solid var(--border-color); border-top-right-radius: 10px; text-align: right;">ভেরিফিকেশন স্ট্যাটাস</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($myTransactions as $trx)
                        <tr style="border-bottom: 1px solid #F1F5F9; transition: background 0.2s; {{ $trx->status == 'pending' ? 'background: #FFFDF5;' : '' }}" onmouseover="this.style.background='#FBFDFF'" onmouseout="this.style.background='{{ $trx->status == 'pending' ? '#FFFDF5' : 'white' }}'">
                            <td style="padding: 1rem 1.1rem; vertical-align: middle;">
                                <div style="font-weight: 700; color: #1E293B;">{{ $trx->created_at->format('d M, Y') }}</div>
                                <div style="font-size: 0.74rem; color: var(--text-muted);"><i class="fa-regular fa-clock"></i> {{ $trx->created_at->format('h:i A') }}</div>
                            </td>
                            <td style="padding: 1rem 0.85rem; vertical-align: middle;">
                                <div style="display: inline-flex; align-items: center; gap: 0.4rem; font-weight: 800; font-size: 0.85rem;">
                                    @if($trx->payment_method == 'bkash')
                                        <span style="background: #FDF2F8; border: 1px solid #FBCFE8; color: #E2136E; padding: 0.2rem 0.6rem; border-radius: 8px;">
                                            <i class="fa-solid fa-wallet"></i> bKash
                                        </span>
                                    @elseif($trx->payment_method == 'nagad')
                                        <span style="background: #FEF2F2; border: 1px solid #FECACA; color: #ED1C24; padding: 0.2rem 0.6rem; border-radius: 8px;">
                                            <i class="fa-solid fa-wallet"></i> Nagad
                                        </span>
                                    @elseif($trx->payment_method == 'rocket')
                                        <span style="background: #FAF5FF; border: 1px solid #E9D5FF; color: #8C1515; padding: 0.2rem 0.6rem; border-radius: 8px;">
                                            <i class="fa-solid fa-mobile-screen"></i> Rocket
                                        </span>
                                    @else
                                        <span style="background: #FFFBEB; border: 1px solid #FDE68A; color: #F6921E; padding: 0.2rem 0.6rem; border-radius: 8px;">
                                            <i class="fa-solid fa-bolt"></i> Upay
                                        </span>
                                    @endif
                                </div>
                                <div style="font-size: 0.78rem; color: var(--text-muted); margin-top: 0.2rem;">
                                    প্রেরক: <strong style="font-family: monospace;">{{ $trx->gateway_response['sender_number'] ?? 'N/A' }}</strong>
                                </div>
                            </td>
                            <td style="padding: 1rem 0.85rem; vertical-align: middle;">
                                <span style="font-family: monospace; font-weight: 800; font-size: 0.92rem; background: #F1F5F9; color: var(--primary-dark); padding: 0.25rem 0.6rem; border-radius: 6px; border: 1px solid #CBD5E1; display: inline-block;">
                                    {{ $trx->transaction_id }}
                                </span>
                                <div style="font-size: 0.72rem; color: var(--text-muted); margin-top: 0.25rem; font-weight: 600;">
                                    {{ strtoupper($trx->type) }}
                                </div>
                            </td>
                            <td style="padding: 1rem 0.85rem; vertical-align: middle;">
                                <strong style="font-size: 1.1rem; color: var(--primary-dark);">৳{{ number_format($trx->amount) }}</strong>
                            </td>
                            <td style="padding: 1rem 1.1rem; vertical-align: middle; text-align: right;">
                                @if($trx->status == 'completed')
                                    <span style="background: #ECFDF5; color: #047857; border: 1px solid #A7F3D0; font-weight: 800; font-size: 0.78rem; padding: 0.35rem 0.75rem; border-radius: 20px; display: inline-flex; align-items: center; gap: 0.35rem;">
                                        <i class="fa-solid fa-circle-check text-emerald-600"></i> অনুমোদিত (Approved)
                                    </span>
                                @elseif($trx->status == 'pending')
                                    <span style="background: #FFFBEB; color: #B45309; border: 1px solid #FCD34D; font-weight: 800; font-size: 0.78rem; padding: 0.35rem 0.75rem; border-radius: 20px; display: inline-flex; align-items: center; gap: 0.35rem;">
                                        <i class="fa-solid fa-clock text-amber-600"></i> অপেক্ষমান (Pending Check)
                                    </span>
                                @else
                                    <span style="background: #FEF2F2; color: #991B1B; border: 1px solid #FCA5A5; font-weight: 800; font-size: 0.78rem; padding: 0.35rem 0.75rem; border-radius: 20px; display: inline-flex; align-items: center; gap: 0.35rem;">
                                        <i class="fa-solid fa-circle-xmark text-rose-600"></i> বাতিল (Failed / Rejected)
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 3rem 1.5rem; color: var(--text-muted);">
                                <i class="fa-solid fa-file-invoice-dollar" style="font-size: 2.8rem; color: #CBD5E1; margin-bottom: 0.75rem; display: block;"></i>
                                <p style="margin: 0 0 0.75rem 0; font-size: 0.95rem;">আপনার কোনো সাবস্ক্রিপশন বা পেমেন্ট ট্রানজাকশন রেকর্ড পাওয়া যায়নি।</p>
                                @if(!\App\Models\SiteSetting::isFreeMode())
                                    <a href="{{ route('payment.checkout') }}" class="btn-primary" style="display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.55rem 1.35rem; font-size: 0.85rem;">
                                        <i class="fa-solid fa-crown"></i> প্রিমিয়াম প্যাকেজ গ্রহণ করুন
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Universal B2B Live Negotiation Chat Modal -->
    <div id="b2bChatModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.65); z-index: 9999; align-items: center; justify-content: center; padding: 1rem;">
        <div style="background: white; width: 100%; max-width: 560px; height: 600px; max-height: 90vh; border-radius: 16px; display: flex; flex-direction: column; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.3); border: 1px solid var(--border-color); animation: fadeIn 0.2s ease;">
            
            <!-- Chat Header -->
            <div style="background: var(--primary-dark); color: white; padding: 1rem 1.25rem; display: flex; justify-content: space-between; align-items: center;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 40px; height: 40px; border-radius: 50%; background: var(--accent); color: var(--primary-dark); display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.1rem;">
                        <i class="fa-solid fa-handshake"></i>
                    </div>
                    <div>
                        <h4 id="chatPartnerName" style="margin: 0; font-size: 1rem; color: white; font-weight: 700;">Partner Agency</h4>
                        <div id="chatPostContext" style="font-size: 0.76rem; color: var(--accent-light);">Deal Negotiation Thread</div>
                    </div>
                </div>

                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <span id="chatLiveBadge" style="background: #10B981; color: white; font-size: 0.65rem; font-weight: 800; padding: 2px 7px; border-radius: 10px;">LIVE</span>
                    <button type="button" onclick="closeChatModal()" style="background: none; border: none; color: white; font-size: 1.4rem; cursor: pointer; padding: 0 0.5rem;">&times;</button>
                </div>
            </div>

            <!-- Chat Messages Container -->
            <div id="chatMessagesBox" style="flex: 1; padding: 1.25rem; overflow-y: auto; background: #F8FAFC; display: flex; flex-direction: column; gap: 0.85rem;">
                <div style="text-align: center; color: var(--text-muted); font-size: 0.85rem; padding: 2rem 0;">
                    <i class="fa-solid fa-spinner fa-spin me-1"></i> মেসেজ লোড হচ্ছে...
                </div>
            </div>

            <!-- Image Attachment Preview Bar -->
            <div id="chatImagePreviewBar" style="display: none; padding: 0.5rem 1rem; background: #F1F5F9; border-top: 1px solid var(--border-color); align-items: center; justify-content: space-between; font-size: 0.82rem;">
                <div style="display: flex; align-items: center; gap: 0.65rem;">
                    <img id="chatImagePreviewThumb" src="" style="width: 38px; height: 38px; object-fit: cover; border-radius: 6px; border: 1px solid var(--border-color);">
                    <div>
                        <span id="chatImagePreviewName" style="font-weight: 700; color: #0F172A; display: block; max-width: 240px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"></span>
                        <span style="font-size: 0.7rem; color: #059669; font-weight: 600;"><i class="fa-solid fa-bolt me-1"></i>WebP ফরম্যাটে অপ্টিমাইজড হবে</span>
                    </div>
                </div>
                <button type="button" onclick="clearChatImageSelection()" style="background: #E2E8F0; border: none; width: 26px; height: 26px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; color: #475569;" title="ছবি মুছুন">&times;</button>
            </div>

            <!-- Chat Footer Input Form -->
            <form id="chatSendForm" onsubmit="handleSendChatMessage(event)" style="padding: 0.85rem 1rem; background: white; border-top: 1px solid var(--border-color); display: flex; gap: 0.5rem; align-items: center;">
                <input type="hidden" id="chatInquiryId" value="">
                
                <!-- Image Attachment Picker -->
                <label for="chatFileInput" style="cursor: pointer; width: 38px; height: 38px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #64748B; background: #F1F5F9; transition: 0.2s;" title="ছবি/ডকুমেন্ট সংযুক্ত করুন (WebP অটো কম্প্রেসড)" onmouseover="this.style.background='#E2E8F0'; this.style.color='var(--primary)'" onmouseout="this.style.background='#F1F5F9'; this.style.color='#64748B'">
                    <i class="fa-solid fa-paperclip" style="font-size: 1.1rem;"></i>
                </label>
                <input type="file" id="chatFileInput" accept="image/*" style="display: none;" onchange="handleChatFileSelect(this)">

                <input type="text" id="chatInputMessage" placeholder="একটি বার্তা লিখুন (মূল্য/শর্ত আলোচনা)..." autocomplete="off" style="flex: 1; padding: 0.7rem 1rem; border: 1.5px solid var(--border-color); border-radius: 25px; font-size: 0.88rem; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='var(--border-color)'">
                <button type="submit" id="chatSendBtn" style="background: var(--primary); color: white; border: none; width: 42px; height: 42px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: 0.2s;">
                    <i class="fa-solid fa-paper-plane"></i>
                </button>
            </form>

        </div>
    </div>

    <!-- Image Lightbox Viewer Modal -->
    <div id="chatImageViewerModal" onclick="closeChatImageViewer()" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.85); z-index: 10000; align-items: center; justify-content: center; padding: 1.5rem; backdrop-filter: blur(5px);">
        <div style="position: relative; max-width: 90vw; max-height: 90vh;" onclick="event.stopPropagation()">
            <img id="chatImageViewerSrc" src="" style="max-width: 100%; max-height: 85vh; border-radius: 12px; box-shadow: 0 20px 50px rgba(0,0,0,0.5); display: block;">
            <div style="position: absolute; top: -45px; right: 0; display: flex; gap: 0.75rem;">
                <a id="chatImageDownloadLink" href="" download target="_blank" style="background: white; color: #0F172A; text-decoration: none; padding: 0.4rem 0.85rem; border-radius: 20px; font-size: 0.82rem; font-weight: 700; display: inline-flex; align-items: center; gap: 0.35rem;">
                    <i class="fa-solid fa-download"></i> ডাউনলোড
                </a>
                <button type="button" onclick="closeChatImageViewer()" style="background: rgba(255,255,255,0.25); border: none; color: white; font-size: 1.25rem; width: 34px; height: 34px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                    &times;
                </button>
            </div>
        </div>
    </div>

    <!-- Live Chat JavaScript -->
    <script>
        let currentChatInquiryId = null;
        let chatPollTimer = null;
        let selectedChatFile = null;

        function handleChatFileSelect(input) {
            if (input.files && input.files[0]) {
                selectedChatFile = input.files[0];
                const previewBar = document.getElementById('chatImagePreviewBar');
                const previewThumb = document.getElementById('chatImagePreviewThumb');
                const previewName = document.getElementById('chatImagePreviewName');

                previewName.textContent = selectedChatFile.name;
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewThumb.src = e.target.result;
                    previewBar.style.display = 'flex';
                };
                reader.readAsDataURL(selectedChatFile);
            }
        }

        function clearChatImageSelection() {
            selectedChatFile = null;
            document.getElementById('chatFileInput').value = '';
            document.getElementById('chatImagePreviewBar').style.display = 'none';
            document.getElementById('chatImagePreviewThumb').src = '';
            document.getElementById('chatImagePreviewName').textContent = '';
        }

        function openChatImageViewer(imgUrl) {
            document.getElementById('chatImageViewerSrc').src = imgUrl;
            document.getElementById('chatImageDownloadLink').href = imgUrl;
            document.getElementById('chatImageViewerModal').style.display = 'flex';
        }

        function closeChatImageViewer() {
            document.getElementById('chatImageViewerModal').style.display = 'none';
        }

        function openChatModal(inquiryId, partnerName) {
            currentChatInquiryId = inquiryId;
            document.getElementById('chatInquiryId').value = inquiryId;
            document.getElementById('chatPartnerName').textContent = partnerName;
            document.getElementById('b2bChatModal').style.display = 'flex';
            document.getElementById('chatInputMessage').value = '';
            clearChatImageSelection();
            document.getElementById('chatInputMessage').focus();

            loadChatMessages(inquiryId);

            if (chatPollTimer) clearInterval(chatPollTimer);
            chatPollTimer = setInterval(() => {
                if (currentChatInquiryId) {
                    loadChatMessages(currentChatInquiryId, true);
                }
            }, 2500);
        }

        function closeChatModal() {
            document.getElementById('b2bChatModal').style.display = 'none';
            currentChatInquiryId = null;
            clearChatImageSelection();
            if (chatPollTimer) {
                clearInterval(chatPollTimer);
                chatPollTimer = null;
            }
        }

        function loadChatMessages(inquiryId, isPolling = false) {
            fetch(`/chat/${inquiryId}`)
                .then(r => r.json())
                .then(data => {
                    if (data.inquiry) {
                        document.getElementById('chatPostContext').textContent = `${data.inquiry.post_title} (${data.inquiry.requested_seats} Seats - ${data.inquiry.status.toUpperCase()})`;
                    }
                    renderChatMessages(data.messages, isPolling);
                })
                .catch(err => console.error(err));
        }

        function renderChatMessages(messages, isPolling) {
            const box = document.getElementById('chatMessagesBox');
            if (!box) return;

            if (!messages || messages.length === 0) {
                box.innerHTML = `
                    <div style="text-align: center; color: var(--text-muted); font-size: 0.85rem; padding: 2.5rem 1rem;">
                        <i class="fa-regular fa-comments" style="font-size: 2rem; color: #CBD5E1; margin-bottom: 0.5rem; display: block;"></i>
                        পার্টনার এজেন্সির সাথে আপনার নেগোসিয়েশন শুরু করতে প্রথম বার্তাটি পাঠান।
                    </div>`;
                return;
            }

            const wasScrolledToBottom = (box.scrollHeight - box.clientHeight <= box.scrollTop + 60);

            let html = '';
            messages.forEach(m => {
                let attachmentHtml = '';
                if (m.attachment) {
                    attachmentHtml = `
                    <div style="margin-top: 0.35rem;">
                        <img src="${m.attachment}" alt="ছবি" onclick="openChatImageViewer('${m.attachment}')" style="max-width: 220px; max-height: 180px; border-radius: 8px; object-fit: cover; cursor: pointer; border: 1px solid rgba(0,0,0,0.12); display: block; box-shadow: 0 2px 6px rgba(0,0,0,0.06); transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'" title="বড় আকারে দেখতে ক্লিক করুন">
                    </div>`;
                }

                if (m.is_me) {
                    html += `
                    <div style="align-self: flex-end; max-width: 82%; display: flex; flex-direction: column; align-items: flex-end;">
                        <div style="background: var(--primary); color: white; padding: 0.65rem 0.95rem; border-radius: 14px 14px 2px 14px; font-size: 0.88rem; line-height: 1.45; word-break: break-word; box-shadow: 0 2px 5px rgba(0,0,0,0.06);">
                            ${m.message ? `<div>${m.message}</div>` : ''}
                            ${attachmentHtml}
                        </div>
                        <span style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">${m.time}</span>
                    </div>`;
                } else {
                    html += `
                    <div style="align-self: flex-start; max-width: 82%; display: flex; flex-direction: column; align-items: flex-start;">
                        <span style="font-size: 0.72rem; font-weight: 700; color: #475569; margin-bottom: 0.15rem;">${m.sender_name}</span>
                        <div style="background: white; color: var(--text-dark); padding: 0.65rem 0.95rem; border-radius: 14px 14px 14px 2px; font-size: 0.88rem; line-height: 1.45; word-break: break-word; border: 1px solid var(--border-color); box-shadow: 0 2px 5px rgba(0,0,0,0.04);">
                            ${m.message ? `<div>${m.message}</div>` : ''}
                            ${attachmentHtml}
                        </div>
                        <span style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">${m.time}</span>
                    </div>`;
                }
            });

            box.innerHTML = html;

            if (!isPolling || wasScrolledToBottom) {
                box.scrollTop = box.scrollHeight;
            }
        }

        function handleSendChatMessage(e) {
            e.preventDefault();
            const input = document.getElementById('chatInputMessage');
            const message = input.value.trim();
            if ((!message && !selectedChatFile) || !currentChatInquiryId) return;

            const btn = document.getElementById('chatSendBtn');
            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';

            const formData = new FormData();
            formData.append('post_inquiry_id', currentChatInquiryId);
            if (message) formData.append('message', message);
            if (selectedChatFile) formData.append('attachment', selectedChatFile);

            fetch('/chat/send', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(r => r.json())
            .then(data => {
                input.value = '';
                clearChatImageSelection();
                btn.disabled = false;
                btn.innerHTML = '<i class="fa-solid fa-paper-plane"></i>';
                loadChatMessages(currentChatInquiryId);
            })
            .catch(err => {
                btn.disabled = false;
                btn.innerHTML = '<i class="fa-solid fa-paper-plane"></i>';
                console.error(err);
            });
        }

        // Close on escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeChatModal();
                closeReviewModal();
            }
        });

        // Review Modal Functions (Phase 4)
        function openReviewModal(inquiryId, targetAgencyId, agencyName) {
            document.getElementById('reviewInquiryId').value = inquiryId;
            document.getElementById('reviewTargetAgencyId').value = targetAgencyId;
            document.getElementById('reviewTargetAgencyName').innerText = agencyName;
            setReviewRating(5);
            document.getElementById('reviewComment').value = '';
            document.getElementById('reviewModal').style.display = 'flex';
        }

        function closeReviewModal() {
            document.getElementById('reviewModal').style.display = 'none';
        }

        function setReviewRating(rating) {
            document.getElementById('reviewRatingInput').value = rating;
            const stars = document.querySelectorAll('.review-star-btn');
            stars.forEach((btn, idx) => {
                const starVal = idx + 1;
                const icon = btn.querySelector('i');
                if (starVal <= rating) {
                    icon.className = 'fa-solid fa-star';
                    icon.style.color = '#F59E0B';
                } else {
                    icon.className = 'fa-regular fa-star';
                    icon.style.color = '#CBD5E1';
                }
            });
            document.getElementById('ratingScoreLabel').innerText = rating + ' স্টার (Star)';
        }

        // Initialize Agency Dashboard Interactive Analytics Charts & Listeners
        document.addEventListener('DOMContentLoaded', function () {
            // Auto-open chat modal if ?open_chat=inquiryId is passed in URL
            const urlParams = new URLSearchParams(window.location.search);
            const openChatId = urlParams.get('open_chat');
            if (openChatId) {
                openChatModal(openChatId, 'B2B Partner');
            }

            // 1. Seat Utilization Doughnut Chart
            const seatCanvas = document.getElementById('agencySeatChart');
            if (seatCanvas) {
                new Chart(seatCanvas.getContext('2d'), {
                    type: 'doughnut',
                    data: {
                        labels: ['ফাঁকা সিট (Available)', 'বুকড / বিক্রি (Sold)'],
                        datasets: [{
                            data: [{{ $totalSeatsAvailable > 0 ? $totalSeatsAvailable : 0 }}, {{ $totalSeatsSold > 0 ? $totalSeatsSold : 0 }}],
                            backgroundColor: ['#0284C7', '#059669'],
                            borderWidth: 0,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        cutout: '72%'
                    }
                });
            }

            // 2. Inventory Category Breakdown Chart
            const catCanvas = document.getElementById('agencyCategoryChart');
            if (catCanvas) {
                new Chart(catCanvas.getContext('2d'), {
                    type: 'doughnut',
                    data: {
                        labels: ['গ্রুপ সিট (Group Seats)', 'টিকিট ও ভিসা (Tickets)', 'হোটেল শেয়ার (Hotels)'],
                        datasets: [{
                            data: [
                                {{ $categoryBreakdown['group_seats'] ?? 0 }},
                                {{ $categoryBreakdown['ticket_only'] ?? 0 }},
                                {{ $categoryBreakdown['hotel_share'] ?? 0 }}
                            ],
                            backgroundColor: ['#044E35', '#0284C7', '#D97706'],
                            borderWidth: 0,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        cutout: '72%'
                    }
                });
            }

            // 3. Proposal & Deal Pipeline Bar Chart
            const pipeCanvas = document.getElementById('agencyPipelineChart');
            if (pipeCanvas) {
                new Chart(pipeCanvas.getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: ['আমার পোস্ট', 'প্রাপ্ত প্রস্তাব', 'প্রেরিত প্রস্তাব', 'আলোচনাধীন', 'চুক্তি সম্পন্ন'],
                        datasets: [{
                            label: 'কাউন্ট (Count)',
                            data: [
                                {{ $myPosts->count() }},
                                {{ $myInquiries->count() }},
                                {{ $sentInquiries->count() }},
                                {{ $inNegotiationCount }},
                                {{ $completedDealsCount }}
                            ],
                            backgroundColor: ['#044E35', '#0284C7', '#7C3AED', '#D97706', '#059669'],
                            borderRadius: 6,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            y: { beginAtZero: true, ticks: { precision: 0 }, grid: { color: '#F1F5F9' } },
                            x: { grid: { display: false } }
                        }
                    }
                });
            }
        });
    </script>

    <!-- Universal B2B Partner Review & Rating Modal (Phase 4) -->
    <div id="reviewModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.65); z-index: 10000; align-items: center; justify-content: center; padding: 1rem;">
        <div style="background: white; border-radius: 20px; max-width: 500px; width: 100%; border: 1px solid var(--border-color); box-shadow: 0 20px 45px rgba(0,0,0,0.3); overflow: hidden; animation: fadeIn 0.2s ease;">
            <!-- Header -->
            <div style="background: linear-gradient(135deg, #044E35, #064E3B); color: white; padding: 1.25rem 1.5rem; display: flex; justify-content: space-between; align-items: center;">
                <div style="display: flex; align-items: center; gap: 0.6rem;">
                    <div style="width: 36px; height: 36px; background: rgba(255,255,255,0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; color: #FBBF24;">
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <div>
                        <h4 style="font-size: 1.1rem; font-weight: 800; margin: 0; color: white;">পার্টনার এজেন্সিকে রিভিউ দিন</h4>
                        <span style="font-size: 0.78rem; color: rgba(255,255,255,0.8);">ভেরিফাইড সফল B2B লেনদেন মূল্যায়ন</span>
                    </div>
                </div>
                <button type="button" onclick="closeReviewModal()" style="background: none; border: none; color: white; font-size: 1.3rem; cursor: pointer;">&times;</button>
            </div>

            <!-- Body -->
            <form action="{{ route('reviews.store') }}" method="POST" style="padding: 1.75rem 1.5rem;">
                @csrf
                <input type="hidden" name="post_inquiry_id" id="reviewInquiryId" value="">
                <input type="hidden" name="target_agency_id" id="reviewTargetAgencyId" value="">
                <input type="hidden" name="rating" id="reviewRatingInput" value="5">

                <div style="background: #F8FAFC; border: 1px solid var(--border-color); padding: 0.85rem 1rem; border-radius: 10px; margin-bottom: 1.25rem;">
                    <span style="font-size: 0.78rem; color: var(--text-muted); display: block;">মূল্যায়ন প্রাপক এজেন্সি:</span>
                    <strong style="font-size: 1.05rem; color: var(--primary-dark);" id="reviewTargetAgencyName">Agency Name</strong>
                </div>

                <!-- Star Rating Picker -->
                <div style="text-align: center; margin-bottom: 1.5rem;">
                    <label style="display: block; font-size: 0.88rem; font-weight: 700; color: var(--text-dark); margin-bottom: 0.5rem;">
                        রেটিং প্রদান করুন (Click to Rate)
                    </label>
                    <div style="display: inline-flex; gap: 0.5rem; font-size: 2rem;">
                        @for($s = 1; $s <= 5; $s++)
                            <button type="button" class="review-star-btn" onclick="setReviewRating({{ $s }})" style="background: none; border: none; cursor: pointer; padding: 0.2rem; outline: none; transition: transform 0.15s ease;">
                                <i class="fa-solid fa-star" style="color: #F59E0B;"></i>
                            </button>
                        @endfor
                    </div>
                    <div id="ratingScoreLabel" style="font-size: 0.85rem; font-weight: 800; color: #D97706; margin-top: 0.25rem;">
                        5 স্টার (Star)
                    </div>
                </div>

                <!-- Feedback Textarea -->
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-size: 0.88rem; font-weight: 700; color: var(--text-dark); margin-bottom: 0.4rem;">
                        আপনার মন্তব্য ও অভিজ্ঞতা (মৌখিক প্রশংসা বা পার্টনারশিপ প্রতিক্রিয়া)
                    </label>
                    <textarea name="comment" id="reviewComment" rows="3" class="form-control" placeholder="যেমন: অত্যন্ত দ্রুত রেসপন্স ও নির্ভরযোগ্য এজেন্সি। সফলভাবে সিট বুকিং সম্পন্ন হয়েছে..." required></textarea>
                </div>

                <!-- Footer buttons -->
                <div style="display: flex; gap: 0.75rem; justify-content: flex-end;">
                    <button type="button" onclick="closeReviewModal()" class="btn-secondary" style="padding: 0.6rem 1.25rem; font-size: 0.88rem;">
                        বাতিল করুন
                    </button>
                    <button type="submit" class="btn-gold" style="padding: 0.6rem 1.5rem; font-size: 0.88rem; font-weight: 700;">
                        <i class="fa-solid fa-paper-plane me-1"></i> রিভিউ প্রকাশ করুন
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
