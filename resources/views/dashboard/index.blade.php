@extends('layouts.app')

@section('title', 'Agency Dashboard & B2B Deal Contracting')

@section('content')
    <!-- Verification Status Alert Banners -->
    @if(Auth::user()->verification_status === 'rejected')
        <div style="background: linear-gradient(135deg, #FEF2F2, #FFF1F2); border: 2px solid #FCA5A5; border-radius: 16px; padding: 1.5rem 1.75rem; margin-bottom: 2rem; box-shadow: 0 4px 20px rgba(239, 68, 68, 0.12); display: flex; align-items: flex-start; gap: 1.25rem; flex-wrap: wrap;">
            <div style="width: 54px; height: 54px; border-radius: 14px; background: #EF4444; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.7rem; flex-shrink: 0; box-shadow: 0 4px 12px rgba(239, 68, 68, 0.35);">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <div style="flex: 1; min-width: 280px;">
                <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.35rem; flex-wrap: wrap;">
                    <span style="background: #DC2626; color: white; font-weight: 800; font-size: 0.75rem; padding: 0.25rem 0.75rem; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px;">
                        <i class="fa-solid fa-ban me-1"></i> ভেরিফিকেশন প্রত্যাখ্যাত (Verification Rejected)
                    </span>
                    <span style="font-size: 0.82rem; color: #991B1B; font-weight: 700;">জরুরি পদক্ষেপ প্রয়োজন</span>
                </div>
                <h3 style="font-size: 1.25rem; font-weight: 800; color: #991B1B; margin: 0 0 0.5rem 0;">
                    আপনার এজেন্সি ভেরিফিকেশন আবেদনটি সুপার এডমিন কর্তৃক প্রত্যাখ্যাত হয়েছে
                </h3>
                <div style="background: white; border: 1.5px dashed #F87171; border-radius: 12px; padding: 1rem 1.25rem; margin-bottom: 1rem;">
                    <div style="font-size: 0.8rem; font-weight: 800; color: #7F1D1D; text-transform: uppercase; margin-bottom: 0.35rem; display: flex; align-items: center; gap: 0.4rem;">
                        <i class="fa-solid fa-comment-dots text-rose-600"></i> এডমিনের প্রত্যাখ্যানের সুনির্দিষ্ট কারণ (Admin Rejection Reason):
                    </div>
                    <p style="margin: 0; font-size: 0.95rem; color: #991B1B; font-weight: 600; line-height: 1.55;">
                        "{{ Auth::user()->rejection_reason ?: 'আপনার আপলোডকৃত ট্রেড লাইসেন্স বা HAAB সনদের কপি অস্পষ্ট বা ত্রুটিপূর্ণ ছিল। অনুগ্রহ করে সঠিক ও স্পষ্ট ডকুমেন্ট পুনরায় আপলোড করুন।' }}"
                    </p>
                </div>
                <div style="display: flex; gap: 0.75rem; align-items: center; flex-wrap: wrap;">
                    <a href="{{ route('verification.portal') }}" class="btn-gold" style="background: #DC2626; color: white; border: none; padding: 0.65rem 1.4rem; font-size: 0.88rem; font-weight: 700; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 4px 12px rgba(220, 38, 38, 0.25);">
                        <i class="fa-solid fa-file-arrow-up"></i> সংশোধিত ডকুমেন্ট পুনরায় আপলোড করুন (Verification Portal)
                    </a>
                    <a href="{{ route('agency.profile.edit') }}" style="color: #991B1B; font-size: 0.85rem; font-weight: 700; text-decoration: underline; padding: 0.5rem;">
                        <i class="fa-solid fa-pen-to-square me-1"></i> প্রোফাইল তথ্য সংশোধন করুন
                    </a>
                </div>
            </div>
        </div>
    @elseif(Auth::user()->verification_status === 'pending')
        <div style="background: linear-gradient(135deg, #FFFBEB, #FEF3C7); border: 2px solid #FCD34D; border-radius: 16px; padding: 1.25rem 1.5rem; margin-bottom: 2rem; box-shadow: 0 4px 15px rgba(245, 158, 11, 0.08); display: flex; align-items: center; justify-content: space-between; gap: 1.25rem; flex-wrap: wrap;">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="width: 48px; height: 48px; border-radius: 12px; background: #F59E0B; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0;">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </div>
                <div>
                    <h4 style="font-size: 1.05rem; font-weight: 800; color: #92400E; margin: 0 0 0.2rem 0;">
                        আপনার এজেন্সি ভেরিফিকেশন বর্তমানে প্রক্রিয়াধীন রয়েছে (Pending Approval)
                    </h4>
                    <p style="margin: 0; font-size: 0.85rem; color: #B45309;">
                        আমাদের প্ল্যাটফর্ম এডমিন টিম আপনার লাইসেন্স ও কাগজপত্র নিরীক্ষা করছে। দ্রুত অনুমোদনের জন্য অপেক্ষা করুন।
                    </p>
                </div>
            </div>
            <div>
                <a href="{{ route('verification.portal') }}" style="background: white; color: #92400E; border: 1px solid #FCD34D; font-weight: 700; padding: 0.55rem 1.1rem; border-radius: 8px; font-size: 0.85rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.35rem; box-shadow: var(--shadow-sm);">
                    <i class="fa-solid fa-shield-halved text-amber-600"></i> ভেরিফিকেশন স্ট্যাটাস দেখুন
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

    <!-- Stats Row -->
    <div class="dashboard-stats-grid" style="margin-bottom: 2rem;">
        <div style="background: white; padding: 1.5rem; border-radius: 14px; border: 1px solid var(--border-color); display: flex; align-items: center; justify-content: space-between; box-shadow: var(--shadow-sm); transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
            <div>
                <span style="font-size: 0.82rem; color: var(--text-muted); display: block; font-weight: 600;">My Active B2B Posts</span>
                <strong style="font-size: 1.85rem; color: var(--primary-dark); font-family: var(--font-heading);">{{ $myPosts->count() }}</strong>
            </div>
            <div style="width: 50px; height: 50px; background: #ECFDF5; color: #047857; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem;">
                <i class="fa-solid fa-layer-group"></i>
            </div>
        </div>

        <div style="background: white; padding: 1.5rem; border-radius: 14px; border: 1px solid var(--border-color); display: flex; align-items: center; justify-content: space-between; box-shadow: var(--shadow-sm); transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
            <div>
                <span style="font-size: 0.82rem; color: var(--text-muted); display: block; font-weight: 600;">Received Proposals</span>
                <strong style="font-size: 1.85rem; color: #0284C7; font-family: var(--font-heading);">{{ $myInquiries->count() }}</strong>
            </div>
            <div style="width: 50px; height: 50px; background: #E0F2FE; color: #0284C7; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem;">
                <i class="fa-solid fa-inbox"></i>
            </div>
        </div>

        <div style="background: white; padding: 1.5rem; border-radius: 14px; border: 1px solid var(--border-color); display: flex; align-items: center; justify-content: space-between; box-shadow: var(--shadow-sm); transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
            <div>
                <span style="font-size: 0.82rem; color: var(--text-muted); display: block; font-weight: 600;">My Sent Proposals</span>
                <strong style="font-size: 1.85rem; color: #D97706; font-family: var(--font-heading);">{{ $sentInquiries->count() }}</strong>
            </div>
            <div style="width: 50px; height: 50px; background: #FEF3C7; color: #D97706; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem;">
                <i class="fa-solid fa-paper-plane"></i>
            </div>
        </div>

        @if(\App\Models\SiteSetting::isFreeMode())
            <div style="background: white; padding: 1.5rem; border-radius: 14px; border: 1.5px solid #A7F3D0; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.08); transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                <div>
                    <span style="font-size: 0.8rem; color: #047857; font-weight: 700; display: block; text-transform: uppercase;">প্ল্যাটফর্ম মোড</span>
                    <strong style="font-size: 1.25rem; color: #065F46; display: block;">১০০% ফ্রি মোড</strong>
                    <div style="font-size: 0.78rem; color: #059669; font-weight: 600; margin-top: 0.15rem;">
                        <i class="fa-solid fa-circle-check text-emerald-500 me-1"></i> কোনো ফি ছাড়াই ফুল ফিচার
                    </div>
                </div>
                <div style="width: 50px; height: 50px; background: #ECFDF5; color: #047857; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem;">
                    <i class="fa-solid fa-gift"></i>
                </div>
            </div>
        @else
            <div style="background: white; padding: 1.5rem; border-radius: 14px; border: 1px solid var(--border-color); display: flex; align-items: center; justify-content: space-between; box-shadow: var(--shadow-sm); transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                <div>
                    <span style="font-size: 0.82rem; color: var(--text-muted); display: block; font-weight: 600;">VIP Subscription</span>
                    <strong style="font-size: 1.25rem; color: #4F46E5; text-transform: capitalize; display: block;">
                        {{ $agency->subscription_plan ? str_replace('_', ' ', $agency->subscription_plan) : 'Free Tier' }}
                    </strong>
                    <a href="{{ route('payment.checkout') }}" style="display: inline-block; font-size: 0.78rem; color: #B45309; font-weight: 700; text-decoration: none; margin-top: 0.2rem;">
                        <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Upgrade / Pay
                    </a>
                </div>
                <div style="width: 50px; height: 50px; background: #EEF2FF; color: #4F46E5; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem;">
                    <i class="fa-solid fa-crown"></i>
                </div>
            </div>
        @endif
    </div>

    <!-- Quick Section Navigation Pills -->
    <div style="background: white; border-radius: 14px; padding: 0.65rem 0.85rem; border: 1px solid var(--border-color); display: flex; gap: 0.5rem; margin-bottom: 2rem; overflow-x: auto; box-shadow: var(--shadow-sm);">
        <a href="#my-posts-section" style="padding: 0.6rem 1.1rem; border-radius: 8px; font-size: 0.88rem; font-weight: 700; color: var(--primary-dark); text-decoration: none; background: #F8FAFC; display: inline-flex; align-items: center; gap: 0.45rem; white-space: nowrap; transition: 0.2s;" onmouseover="this.style.background='#EEF2F6'" onmouseout="this.style.background='#F8FAFC'">
            <i class="fa-solid fa-layer-group text-emerald-600"></i> আমার পোস্ট সমূহ ({{ $myPosts->count() }})
        </a>
        <a href="#received-proposals-section" style="padding: 0.6rem 1.1rem; border-radius: 8px; font-size: 0.88rem; font-weight: 700; color: var(--primary-dark); text-decoration: none; background: #F8FAFC; display: inline-flex; align-items: center; gap: 0.45rem; white-space: nowrap; transition: 0.2s;" onmouseover="this.style.background='#EEF2F6'" onmouseout="this.style.background='#F8FAFC'">
            <i class="fa-solid fa-inbox text-sky-600"></i> প্রাপ্ত প্রস্তাব ও কোটেশন ({{ $myInquiries->count() }})
        </a>
        <a href="#sent-proposals-section" style="padding: 0.6rem 1.1rem; border-radius: 8px; font-size: 0.88rem; font-weight: 700; color: var(--primary-dark); text-decoration: none; background: #F8FAFC; display: inline-flex; align-items: center; gap: 0.45rem; white-space: nowrap; transition: 0.2s;" onmouseover="this.style.background='#EEF2F6'" onmouseout="this.style.background='#F8FAFC'">
            <i class="fa-solid fa-paper-plane text-amber-600"></i> প্রেরিত প্রস্তাব ট্র্যাকিং ({{ $sentInquiries->count() }})
        </a>
        <a href="#billing-section" style="padding: 0.6rem 1.1rem; border-radius: 8px; font-size: 0.88rem; font-weight: 700; color: var(--primary-dark); text-decoration: none; background: #F8FAFC; display: inline-flex; align-items: center; gap: 0.45rem; white-space: nowrap; transition: 0.2s;" onmouseover="this.style.background='#EEF2F6'" onmouseout="this.style.background='#F8FAFC'">
            <i class="fa-solid fa-receipt text-indigo-600"></i> সাবস্ক্রিপশন ও বিলিং
        </a>
    </div>

    <!-- Section 1: My B2B Posts & Status Tracking Table -->
    <div id="my-posts-section" class="responsive-card-padding" style="background: white; border-radius: 16px; padding: 1.75rem; border: 1px solid var(--border-color); margin-bottom: 2.5rem; box-shadow: var(--shadow-sm);">
        <h3 class="font-heading" style="font-size: 1.3rem; color: var(--primary-dark); margin-bottom: 1.25rem;">
            <i class="fa-solid fa-list-check"></i> My Active B2B Requirement Listings & Deal Status
        </h3>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.9rem;">
                <thead>
                    <tr style="background: #F8FAFC; border-bottom: 2px solid var(--border-color); color: var(--text-muted); font-size: 0.8rem; text-transform: uppercase;">
                        <th style="padding: 0.85rem;">Title & Category</th>
                        <th style="padding: 0.85rem;">Flight Date</th>
                        <th style="padding: 0.85rem;">Available / Block</th>
                        <th style="padding: 0.85rem;">Price/Seat</th>
                        <th style="padding: 0.85rem;">Current Status</th>
                        <th style="padding: 0.85rem; text-align: right;">Update Deal Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($myPosts as $post)
                        <tr style="border-bottom: 1px solid var(--border-color);">
                            <td style="padding: 1rem 0.85rem;">
                                <strong><a href="{{ route('posts.show', $post->id) }}" style="color: inherit; text-decoration: none;">{{ $post->title }}</a></strong>
                                <div style="font-size: 0.78rem; color: var(--text-muted);">Category: {{ strtoupper(str_replace('_', ' ', $post->post_category)) }}</div>
                            </td>
                            <td style="padding: 1rem 0.85rem;">{{ $post->flight_date->format('d M, Y') }}</td>
                            <td style="padding: 1rem 0.85rem;">
                                <span style="font-weight: 700; color: var(--primary-dark);">{{ $post->available_seats }} Pax</span> / {{ $post->total_group_size }} Total
                                @if($post->pendingSeats() > 0)
                                    <div style="font-size: 0.72rem; color: #D97706; font-weight: 700; margin-top: 0.2rem;">
                                        <i class="fa-solid fa-clock"></i> {{ $post->pendingSeats() }} টি সিট প্রক্রিয়াধীন
                                    </div>
                                @endif
                            </td>
                            <td style="padding: 1rem 0.85rem; font-weight: 700; color: var(--primary-dark);">৳{{ number_format($post->price_per_seat) }}</td>
                            <td style="padding: 1rem 0.85rem;">
                                <span class="badge badge-{{ $post->status === 'open' ? 'verified' : ($post->status === 'partially_filled' ? 'pending' : 'admin') }}">
                                    {{ strtoupper(str_replace('_', ' ', $post->status)) }}
                                </span>
                            </td>
                            <td style="padding: 1rem 0.85rem; text-align: right;">
                                <div style="display: flex; gap: 0.5rem; align-items: center; justify-content: flex-end; flex-wrap: wrap;">
                                    <button type="button" onclick="document.getElementById('adjust-seats-modal-{{ $post->id }}').style.display='flex'" class="btn-primary" style="padding: 0.35rem 0.65rem; font-size: 0.78rem; background: #047857; color: white;">
                                        <i class="fa-solid fa-calculator me-1"></i> সিট বিয়োগ / বিক্রি
                                    </button>

                                    <form action="{{ route('posts.status', $post->id) }}" method="POST" style="display: inline-flex; gap: 0.35rem; align-items: center;">
                                        @csrf
                                        <select name="status" onchange="this.form.submit()" style="padding: 0.35rem 0.6rem; border-radius: 6px; border: 1px solid var(--border-color); font-size: 0.8rem; background: white; font-weight: 600;">
                                            <option value="open" {{ $post->status == 'open' ? 'selected' : '' }}>🟢 Open</option>
                                            <option value="partially_filled" {{ $post->status == 'partially_filled' ? 'selected' : '' }}>🟡 Partially Filled</option>
                                            <option value="closed" {{ $post->status == 'closed' ? 'selected' : '' }}>🔴 Fully Booked / Closed</option>
                                        </select>
                                    </form>
                                </div>

                                <!-- Modal for Quick Manual Seat Adjustment -->
                                <div id="adjust-seats-modal-{{ $post->id }}" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 9999; align-items: center; justify-content: center; text-align: left;">
                                    <div style="background: white; border-radius: 14px; padding: 1.5rem; max-width: 420px; width: 90%; border: 1px solid var(--border-color); box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
                                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; border-bottom: 1px solid var(--border-color); padding-bottom: 0.5rem;">
                                            <h4 style="font-size: 1rem; font-weight: 700; color: var(--primary-dark); margin: 0;">
                                                <i class="fa-solid fa-calculator me-1 text-emerald-600"></i> সিট সংখ্যা ম্যানুয়াল এডজাস্টমেন্ট
                                            </h4>
                                            <button type="button" onclick="document.getElementById('adjust-seats-modal-{{ $post->id }}').style.display='none'" style="border: none; background: none; font-size: 1.4rem; cursor: pointer; color: var(--text-muted);">&times;</button>
                                        </div>
                                        
                                        <div style="background: #F8FAFC; border: 1px solid var(--border-color); padding: 0.75rem; border-radius: 8px; margin-bottom: 1rem; font-size: 0.82rem; color: var(--text-dark);">
                                            <strong>পোস্ট:</strong> {{ $post->title }}<br>
                                            <strong>বর্তমান অবশিষ্ট সিট:</strong> <span style="color: #DC2626; font-weight: 800;">{{ $post->available_seats }} টি</span>
                                        </div>

                                        <form action="{{ route('posts.adjust_seats', $post->id) }}" method="POST">
                                            @csrf
                                            <div style="margin-bottom: 1rem;">
                                                <label style="display: block; font-size: 0.8rem; font-weight: 700; margin-bottom: 0.35rem; color: var(--text-dark);">এডজাস্টমেন্ট মোড *</label>
                                                <select name="adjustment_type" required style="width: 100%; padding: 0.5rem; border-radius: 6px; border: 1px solid var(--border-color); font-size: 0.85rem;">
                                                    <option value="reduce">🔴 অফলাইনে বিক্রিত সিট বিয়োগ করুন (Reduce Seats)</option>
                                                    <option value="set">⚙️ সরাসরি অবশিষ্ট সিট সেট করুন (Set Exact Seats)</option>
                                                </select>
                                            </div>

                                            <div style="margin-bottom: 1.25rem;">
                                                <label style="display: block; font-size: 0.8rem; font-weight: 700; margin-bottom: 0.35rem; color: var(--text-dark);">সিট সংখ্যা *</label>
                                                <input type="number" name="seats_count" min="0" required placeholder="উদাহরণ: 2" style="width: 100%; padding: 0.5rem; border-radius: 6px; border: 1px solid var(--border-color); font-size: 0.9rem;">
                                            </div>

                                            <button type="submit" class="btn-gold" style="width: 100%; justify-content: center; font-size: 0.88rem; padding: 0.6rem;">
                                                <i class="fa-solid fa-check me-1"></i> সিট আপডেট সেভ করুন
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 2rem; color: var(--text-muted);">
                                You have not posted any B2B requirements yet. <a href="{{ route('posts.create') }}" style="color: var(--primary); font-weight: 600;">Post a requirement now</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Section 2: Received Inquiries & Leads Inbox -->
    <div id="received-proposals-section" class="responsive-card-padding" style="background: white; border-radius: 16px; padding: 1.75rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); margin-bottom: 2.5rem;">
        <h3 class="font-heading" style="font-size: 1.3rem; color: var(--primary-dark); margin-bottom: 1.25rem;">
            <i class="fa-solid fa-inbox text-amber-500 me-1"></i> Received B2B Proposals & Quotation Responses
        </h3>

        <div style="display: flex; flex-direction: column; gap: 1.25rem;">
            @forelse($myInquiries as $inq)
                <div style="background: #F8FAFC; border: 1px solid var(--border-color); border-radius: 14px; padding: 1.25rem; display: flex; flex-direction: column; gap: 1rem;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 0.75rem;">
                        <div>
                            <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.35rem; flex-wrap: wrap;">
                                <span class="badge badge-verified"><i class="fa-solid fa-certificate me-1"></i> লাইসেন্স: {{ $inq->inquiringAgency->license_no }}</span>
                                <span style="font-size: 0.78rem; color: var(--text-muted);">Received: {{ $inq->created_at->diffForHumans() }}</span>
                                <span class="badge badge-{{ $inq->status === 'completed' ? 'verified' : ($inq->status === 'accepted' ? 'pending' : 'admin') }}">
                                    STATUS: {{ strtoupper(str_replace('_', ' ', $inq->status)) }}
                                </span>
                            </div>
                            <h4 style="font-size: 1.1rem; color: var(--primary-dark); font-weight: 700; margin-bottom: 0.25rem;">
                                Proposal From: {{ $inq->inquiringAgency->agency_name }} ({{ $inq->inquiringAgency->owner_name }})
                            </h4>
                            <p style="font-size: 0.88rem; color: var(--text-muted);">
                                For Post: <strong><a href="{{ route('posts.show', $inq->post_id) }}" target="_blank" style="color: inherit;">{{ $inq->post->title }}</a></strong>
                            </p>
                        </div>

                        <div style="text-align: right;">
                            <div style="font-size: 1.25rem; font-weight: 800; color: #DC2626;">{{ $inq->requested_seats }} Pax Requested</div>
                            <div style="font-size: 0.88rem; color: var(--primary-dark); font-weight: 700;">Rate: ৳{{ number_format($inq->offered_price_per_seat ?: $inq->post->price_per_seat) }}/seat</div>
                        </div>
                    </div>

                    <!-- Buyer Message & Notes -->
                    <div style="background: white; border: 1px solid var(--border-color); padding: 0.85rem 1rem; border-radius: 8px; font-size: 0.88rem;">
                        <p style="margin-bottom: 0.35rem; color: var(--text-dark);">
                            <i class="fa-solid fa-quote-left text-amber-500 me-1"></i> <strong>Buyer Note:</strong> "{{ $inq->message }}"
                        </p>
                        @if($inq->seller_note)
                            <p style="color: #047857; margin: 0;">
                                <i class="fa-solid fa-circle-check me-1"></i> <strong>Your Sent Quotation Note:</strong> "{{ $inq->seller_note }}"
                                @if($inq->advance_amount_agreed)
                                    &bull; <strong>Agreed Advance Token: ৳{{ number_format($inq->advance_amount_agreed) }}</strong>
                                @endif
                            </p>
                        @endif
                    </div>

                    <!-- Action Controls for Seller -->
                    <div style="display: flex; gap: 0.75rem; align-items: center; justify-content: space-between; flex-wrap: wrap; border-top: 1px dashed var(--border-color); padding-top: 0.85rem;">
                        <div style="display: flex; gap: 0.5rem; align-items: center; flex-wrap: wrap;">
                            <button type="button" onclick="document.getElementById('dealDetailsModal_{{ $inq->id }}').style.display='flex'" class="btn-primary" style="background: #475569; padding: 0.45rem 0.85rem; font-size: 0.82rem;">
                                <i class="fa-solid fa-eye me-1"></i> View Full Details
                            </button>
                            <button type="button" onclick="openChatModal({{ $inq->id }}, '{{ addslashes($inq->inquiringAgency->agency_name) }}')" class="btn-primary" style="background: #4F46E5; color: white; padding: 0.45rem 0.85rem; font-size: 0.82rem; border-radius: 6px;">
                                <i class="fa-solid fa-comments me-1"></i> লাইভ চ্যাট / নেগোসিয়েশন
                            </button>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $inq->inquiringAgency->whatsapp ?? $inq->inquiringAgency->phone) }}?text=Salam%20agency,%20responding%20to%20your%20B2B%20inquiry%20regarding%20{{ urlencode($inq->post->title) }}" target="_blank" class="btn-primary" style="background: #25D366; padding: 0.45rem 0.85rem; font-size: 0.82rem;">
                                <i class="fa-brands fa-whatsapp me-1"></i> WhatsApp
                            </a>
                            <a href="tel:{{ $inq->inquiringAgency->phone }}" class="btn-primary" style="background: #0284C7; padding: 0.45rem 0.85rem; font-size: 0.82rem;">
                                <i class="fa-solid fa-phone me-1"></i> Call Phone
                            </a>
                        </div>

                        <div style="display: flex; gap: 0.5rem; align-items: center; flex-wrap: wrap;">
                            @if($inq->status === 'accepted' || $inq->status === 'completed')
                                <a href="{{ route('posts.inquiry.quotation_letter', $inq->id) }}" target="_blank" class="btn-primary" style="background: #0284C7; padding: 0.45rem 0.85rem; font-size: 0.82rem;">
                                    <i class="fa-solid fa-file-invoice me-1"></i> 📄 View Quotation Letter
                                </a>
                            @endif

                            @if($inq->status === 'completed')
                                <a href="{{ route('posts.inquiry.contract', $inq->id) }}" target="_blank" class="btn-gold" style="padding: 0.5rem 1rem; font-size: 0.85rem; background: #047857; color: white;">
                                    <i class="fa-solid fa-file-contract me-1"></i> 📄 Download B2B Contract (বিটুবি চুক্তিপত্র)
                                </a>

                                @if(!$inq->hasReviewedBy(Auth::id()))
                                    <button type="button" onclick="openReviewModal({{ $inq->id }}, {{ $inq->inquiring_agency_id }}, '{{ addslashes($inq->inquiringAgency->agency_name) }}')" class="btn-gold" style="padding: 0.5rem 1rem; font-size: 0.85rem; background: #F59E0B; color: #78350F; border: 1px solid #D97706; font-weight: 700;">
                                        <i class="fa-solid fa-star me-1"></i> ⭐ বায়ার এজেন্সিকে রিভিউ দিন
                                    </button>
                                @else
                                    <span style="background: #FEF3C7; color: #92400E; font-size: 0.82rem; font-weight: 700; padding: 0.45rem 0.75rem; border-radius: 8px; border: 1px solid #FDE68A; display: inline-flex; align-items: center; gap: 0.3rem;">
                                        <i class="fa-solid fa-circle-check text-emerald-600"></i> রিভিউ সম্পন্ন
                                    </span>
                                @endif
                            @else
                                <!-- Seller Respond Form Button -->
                                <button type="button" onclick="document.getElementById('respondModal_{{ $inq->id }}').style.display='block'" class="btn-primary" style="background: #0284C7; padding: 0.45rem 0.85rem; font-size: 0.82rem;">
                                    <i class="fa-solid fa-reply me-1"></i> Respond & Send Quote
                                </button>

                                <!-- 2-Way Deal Done Button for Seller -->
                                @if($inq->status === 'pending')
                                    <button type="button" disabled class="btn-gold" style="padding: 0.45rem 0.85rem; font-size: 0.82rem; background: #CBD5E1; color: #64748B; cursor: not-allowed; border: 1px solid #94A3B8;" title="Please respond with a quotation first">
                                        <i class="fa-solid fa-lock me-1"></i> Send Quote First to Confirm Deal
                                    </button>
                                @else
                                    <form action="{{ route('posts.inquiry.confirm_deal', $inq->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @if($inq->seller_deal_done)
                                            <span class="badge badge-verified" style="font-size: 0.8rem; padding: 0.45rem 0.75rem;">
                                                <i class="fa-solid fa-check-double me-1"></i> You Marked Advance Received
                                            </span>
                                        @else
                                            <button type="submit" class="btn-gold" style="padding: 0.45rem 0.85rem; font-size: 0.82rem; background: #D97706; color: white;">
                                                <i class="fa-solid fa-handshake-check me-1"></i> Mark Advance Received & Deal Done
                                            </button>
                                        @endif
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>

                    <!-- Full Deal Specifications Modal for Seller -->
                    <div id="dealDetailsModal_{{ $inq->id }}" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.65); z-index: 9999; align-items: center; justify-content: center; padding: 1rem; text-align: left;">
                        <div style="background: white; border-radius: 16px; padding: 1.75rem; max-width: 650px; width: 100%; max-height: 90vh; overflow-y: auto; border: 1px solid var(--border-color); box-shadow: 0 15px 35px rgba(0,0,0,0.25);">
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
                                <button type="button" onclick="document.getElementById('dealDetailsModal_{{ $inq->id }}').style.display='none'" class="btn-primary" style="background: var(--primary); padding: 0.5rem 1.25rem;">
                                    ঠিক আছে / বন্ধ করুন
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Inline Seller Quotation Respond Modal -->
                    <div id="respondModal_{{ $inq->id }}" style="display: none; background: #FFFDF5; border: 2px solid #FDE68A; border-radius: 12px; padding: 1.25rem; margin-top: 0.5rem;">
                        <h5 style="font-size: 0.95rem; color: #78350F; font-weight: 700; margin-bottom: 0.75rem;">
                            <i class="fa-solid fa-reply me-1"></i> Respond Quotation Terms to {{ $inq->inquiringAgency->agency_name }}
                        </h5>
                        <form action="{{ route('posts.inquiry.respond', $inq->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="accepted">
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; margin-bottom: 0.75rem;">
                                <div>
                                    <label style="display: block; font-size: 0.78rem; font-weight: 600; color: #78350F; margin-bottom: 0.25rem;">Rate Per Seat (BDT)</label>
                                    <input type="number" name="offered_price_per_seat" value="{{ $inq->offered_price_per_seat ?: $inq->post->price_per_seat }}" style="width: 100%; padding: 0.5rem; border: 1px solid #FCD34D; border-radius: 6px; font-size: 0.88rem;">
                                </div>
                                <div>
                                    <label style="display: block; font-size: 0.78rem; font-weight: 600; color: #78350F; margin-bottom: 0.25rem;">Required Advance Token (BDT)</label>
                                    <input type="number" name="advance_amount_agreed" value="{{ $inq->post->advance_deposit }}" placeholder="e.g. 15000" style="width: 100%; padding: 0.5rem; border: 1px solid #FCD34D; border-radius: 6px; font-size: 0.88rem;">
                                </div>
                            </div>
                            <div style="margin-bottom: 0.75rem;">
                                <label style="display: block; font-size: 0.78rem; font-weight: 600; color: #78350F; margin-bottom: 0.25rem;">Seller Confirmation Note / Payment Terms</label>
                                <textarea name="seller_note" rows="2" placeholder="e.g. 5 seats confirmed. Please send token money via bank/cheque..." style="width: 100%; padding: 0.5rem; border: 1px solid #FCD34D; border-radius: 6px; font-size: 0.85rem; font-family: inherit;">{{ $inq->seller_note }}</textarea>
                            </div>
                            <div style="display: flex; gap: 0.5rem; justify-content: flex-end;">
                                <button type="button" onclick="document.getElementById('respondModal_{{ $inq->id }}').style.display='none'" class="btn-primary" style="background: #94A3B8; padding: 0.4rem 0.85rem; font-size: 0.8rem;">Cancel</button>
                                <button type="submit" class="btn-gold" style="padding: 0.4rem 0.85rem; font-size: 0.8rem;">Send Quotation Response</button>
                            </div>
                        </form>
                    </div>
                </div>
            @empty
                <div style="text-align: center; padding: 2.5rem; background: #F8FAFC; border-radius: 10px; color: var(--text-muted);">
                    <i class="fa-solid fa-envelope-open" style="font-size: 2.5rem; margin-bottom: 0.5rem;"></i>
                    <p>No incoming B2B deal proposals received yet.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Section 3: My Sent B2B Deal Proposals -->
    <div id="sent-proposals-section" class="responsive-card-padding" style="background: white; border-radius: 16px; padding: 1.75rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); margin-bottom: 2.5rem;">
        <h3 class="font-heading" style="font-size: 1.3rem; color: var(--primary-dark); margin-bottom: 1.25rem;">
            <i class="fa-solid fa-paper-plane text-sky-600 me-1"></i> My Sent B2B Proposals & Deal Tracking
        </h3>

        <div style="display: flex; flex-direction: column; gap: 1.25rem;">
            @forelse($sentInquiries as $sInq)
                <div style="background: #F8FAFC; border: 1px solid var(--border-color); border-radius: 14px; padding: 1.25rem; display: flex; flex-direction: column; gap: 1rem;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 0.75rem;">
                        <div>
                            <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.35rem; flex-wrap: wrap;">
                                <span class="badge badge-verified"><i class="fa-solid fa-certificate me-1"></i> সেলার লাইসেন্স: {{ $sInq->post->agency->license_no }}</span>
                                <span style="font-size: 0.78rem; color: var(--text-muted);">Sent: {{ $sInq->created_at->diffForHumans() }}</span>
                                <span class="badge badge-{{ $sInq->status === 'completed' ? 'verified' : ($sInq->status === 'accepted' ? 'pending' : 'admin') }}">
                                    STATUS: {{ strtoupper(str_replace('_', ' ', $sInq->status)) }}
                                </span>
                            </div>
                            <h4 style="font-size: 1.1rem; color: var(--primary-dark); font-weight: 700; margin-bottom: 0.25rem;">
                                Proposal To: {{ $sInq->post->agency->agency_name }} ({{ $sInq->post->agency->owner_name }})
                            </h4>
                            <p style="font-size: 0.88rem; color: var(--text-muted);">
                                Deal Post: <strong><a href="{{ route('posts.show', $sInq->post_id) }}" target="_blank" style="color: inherit;">{{ $sInq->post->title }}</a></strong>
                            </p>
                        </div>

                        <div style="text-align: right;">
                            <div style="font-size: 1.25rem; font-weight: 800; color: #DC2626;">{{ $sInq->requested_seats }} Pax Seats</div>
                            <div style="font-size: 0.88rem; color: var(--primary-dark); font-weight: 700;">Rate: ৳{{ number_format($sInq->offered_price_per_seat ?: $sInq->post->price_per_seat) }}/seat</div>
                        </div>
                    </div>

                    <!-- Notes -->
                    <div style="background: white; border: 1px solid var(--border-color); padding: 0.85rem 1rem; border-radius: 8px; font-size: 0.88rem;">
                        <p style="margin-bottom: 0.35rem; color: var(--text-dark);">
                            <i class="fa-solid fa-quote-left text-sky-500 me-1"></i> <strong>My Proposal Note:</strong> "{{ $sInq->message }}"
                        </p>
                        @if($sInq->seller_note)
                            <p style="color: #047857; margin: 0;">
                                <i class="fa-solid fa-certificate me-1 text-amber-500"></i> <strong>Seller Quotation Reply:</strong> "{{ $sInq->seller_note }}"
                                @if($sInq->advance_amount_agreed)
                                    &bull; <strong>Required Token Money: ৳{{ number_format($sInq->advance_amount_agreed) }}</strong>
                                @endif
                            </p>
                        @endif
                    </div>

                    <!-- Actions for Buyer -->
                    <div style="display: flex; gap: 0.75rem; align-items: center; justify-content: space-between; flex-wrap: wrap; border-top: 1px dashed var(--border-color); padding-top: 0.85rem;">
                        <div style="display: flex; gap: 0.5rem; align-items: center; flex-wrap: wrap;">
                            <button type="button" onclick="document.getElementById('sentDealDetailsModal_{{ $sInq->id }}').style.display='flex'" class="btn-primary" style="background: #475569; padding: 0.45rem 0.85rem; font-size: 0.82rem;">
                                <i class="fa-solid fa-eye me-1"></i> View Full Details
                            </button>
                            <button type="button" onclick="openChatModal({{ $sInq->id }}, '{{ addslashes($sInq->post->agency->agency_name) }}')" class="btn-primary" style="background: #4F46E5; color: white; padding: 0.45rem 0.85rem; font-size: 0.82rem; border-radius: 6px;">
                                <i class="fa-solid fa-comments me-1"></i> লাইভ চ্যাট / নেগোসিয়েশন
                            </button>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $sInq->post->agency->whatsapp ?? $sInq->post->agency->phone) }}?text=Salam%20agency,%20following%20up%20on%20my%20B2B%20proposal%20for%20{{ urlencode($sInq->post->title) }}" target="_blank" class="btn-primary" style="background: #25D366; padding: 0.45rem 0.85rem; font-size: 0.82rem;">
                                <i class="fa-brands fa-whatsapp me-1"></i> Chat Seller on WhatsApp
                            </a>
                            <a href="tel:{{ $sInq->post->agency->phone }}" class="btn-primary" style="background: #0284C7; padding: 0.45rem 0.85rem; font-size: 0.82rem;">
                                <i class="fa-solid fa-phone me-1"></i> Call Seller
                            </a>
                        </div>

                        <div style="display: flex; gap: 0.5rem; align-items: center; flex-wrap: wrap;">
                            @if($sInq->status === 'accepted' || $sInq->status === 'completed')
                                <a href="{{ route('posts.inquiry.quotation_letter', $sInq->id) }}" target="_blank" class="btn-primary" style="background: #0284C7; padding: 0.45rem 0.85rem; font-size: 0.82rem;">
                                    <i class="fa-solid fa-file-invoice me-1"></i> 📄 View Quotation Letter
                                </a>
                            @endif

                            @if($sInq->status === 'completed')
                                <a href="{{ route('posts.inquiry.contract', $sInq->id) }}" target="_blank" class="btn-gold" style="padding: 0.5rem 1rem; font-size: 0.85rem; background: #047857; color: white;">
                                    <i class="fa-solid fa-file-contract me-1"></i> 📄 Download B2B Contract (বিটুবি চুক্তিপত্র)
                                </a>

                                @if(!$sInq->hasReviewedBy(Auth::id()))
                                    <button type="button" onclick="openReviewModal({{ $sInq->id }}, {{ $sInq->post->agency_id }}, '{{ addslashes($sInq->post->agency->agency_name) }}')" class="btn-gold" style="padding: 0.5rem 1rem; font-size: 0.85rem; background: #F59E0B; color: #78350F; border: 1px solid #D97706; font-weight: 700;">
                                        <i class="fa-solid fa-star me-1"></i> ⭐ সেলার এজেন্সিকে রিভিউ দিন
                                    </button>
                                @else
                                    <span style="background: #FEF3C7; color: #92400E; font-size: 0.82rem; font-weight: 700; padding: 0.45rem 0.75rem; border-radius: 8px; border: 1px solid #FDE68A; display: inline-flex; align-items: center; gap: 0.3rem;">
                                        <i class="fa-solid fa-circle-check text-emerald-600"></i> রিভিউ সম্পন্ন
                                    </span>
                                @endif
                            @else
                                @if($sInq->status === 'pending')
                                    <button type="button" disabled class="btn-gold" style="padding: 0.45rem 0.85rem; font-size: 0.82rem; background: #CBD5E1; color: #64748B; cursor: not-allowed; border: 1px solid #94A3B8;" title="Waiting for seller agency's quotation response">
                                        <i class="fa-solid fa-clock me-1"></i> Waiting for Seller Quotation
                                    </button>
                                @else
                                    <!-- 2-Way Deal Done Button for Buyer -->
                                    <form action="{{ route('posts.inquiry.confirm_deal', $sInq->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @if($sInq->buyer_deal_done)
                                            <span class="badge badge-verified" style="font-size: 0.8rem; padding: 0.45rem 0.75rem;">
                                                <i class="fa-solid fa-check-double me-1"></i> You Marked Advance Paid
                                            </span>
                                        @else
                                            <button type="submit" class="btn-gold" style="padding: 0.45rem 0.85rem; font-size: 0.82rem; background: #D97706; color: white;">
                                                <i class="fa-solid fa-handshake-check me-1"></i> Mark Advance Paid & Deal Done
                                            </button>
                                        @endif
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>

                    <!-- Full Deal Specifications Modal for Buyer -->
                    <div id="sentDealDetailsModal_{{ $sInq->id }}" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.65); z-index: 9999; align-items: center; justify-content: center; padding: 1rem; text-align: left;">
                        <div style="background: white; border-radius: 16px; padding: 1.75rem; max-width: 650px; width: 100%; max-height: 90vh; overflow-y: auto; border: 1px solid var(--border-color); box-shadow: 0 15px 35px rgba(0,0,0,0.25);">
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
                                <button type="button" onclick="document.getElementById('sentDealDetailsModal_{{ $sInq->id }}').style.display='none'" class="btn-primary" style="background: var(--primary); padding: 0.5rem 1.25rem;">
                                    ঠিক আছে / বন্ধ করুন
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div style="text-align: center; padding: 2.5rem; background: #F8FAFC; border-radius: 10px; color: var(--text-muted);">
                    <i class="fa-solid fa-paper-plane" style="font-size: 2.5rem; margin-bottom: 0.5rem;"></i>
                    <p>You have not sent any B2B deal proposals yet. Browse the <a href="{{ route('posts.index') }}" style="color: var(--primary); font-weight: 600;">B2B Marketplace</a> to start collaborating.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Section 4: Subscription & Payment Transaction History -->
    <div id="billing-section" class="responsive-card-padding" style="background: white; border-radius: 16px; padding: 1.75rem; border: 1px solid var(--border-color); margin-bottom: 2.5rem; box-shadow: var(--shadow-sm);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem; flex-wrap: wrap; gap: 1rem;">
            <div>
                <h3 class="font-heading" style="font-size: 1.3rem; color: var(--primary-dark); margin: 0;">
                    <i class="fa-solid fa-file-invoice-dollar text-emerald-600 me-2"></i> সাবস্ক্রিপশন ও পেমেন্ট হিস্ট্রি (Subscriptions & Billing History)
                </h3>
                <p style="font-size: 0.85rem; color: var(--text-muted); margin: 0.25rem 0 0;">
                    Review your manual payment verifications (bKash, Nagad, Rocket, Upay) and active subscription validity.
                </p>
            </div>

            @if(\App\Models\SiteSetting::isFreeMode())
                <span style="background: #ECFDF5; color: #047857; font-weight: 700; font-size: 0.85rem; padding: 0.5rem 1rem; border-radius: 20px; border: 1px solid #A7F3D0; display: inline-flex; align-items: center; gap: 0.4rem;">
                    <i class="fa-solid fa-gift text-emerald-600"></i> ১০০% ফ্রি মোড সক্রিয় (জিরো ফি)
                </span>
            @else
                <a href="{{ route('payment.checkout') }}" class="btn-gold" style="padding: 0.5rem 1.25rem; font-size: 0.85rem; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 0.4rem;">
                    <i class="fa-solid fa-crown"></i> নতুন প্ল্যান আপগ্রেড / রিনিউ
                </a>
            @endif
        </div>

        @if(\App\Models\SiteSetting::isFreeMode())
            <div style="background: linear-gradient(135deg, #ECFDF5, #F0FDF4); border: 1.5px solid #A7F3D0; border-radius: 14px; padding: 1.25rem 1.5rem; margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: space-between; gap: 1rem; flex-wrap: wrap;">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="width: 44px; height: 44px; border-radius: 12px; background: #047857; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0;">
                        <i class="fa-solid fa-sparkles"></i>
                    </div>
                    <div>
                        <h4 style="font-size: 1rem; font-weight: 800; color: #065F46; margin: 0 0 0.15rem 0;">
                            বর্তমানে প্ল্যাটফর্মটি ১০০% ফ্রি প্রোমোশনাল মোডে চালু রয়েছে
                        </h4>
                        <p style="margin: 0; font-size: 0.83rem; color: #047857;">
                            সকল ভেরিফাইড এজেন্সির জন্য পোস্ট তৈরি, চুক্তিপত্র ডাউনলোড ও আনলিমিটেড ডিল পরিচালনা সম্পূর্ণ চার্জমুক্ত। ভবিষ্যতে পেইড সিস্টেম চালু হলে আপনি এখান থেকেই পেইড প্ল্যান গ্রহণ করতে পারবেন।
                        </p>
                    </div>
                </div>
                <span class="badge" style="background: #047857; color: white; font-weight: 700; padding: 0.4rem 0.85rem; border-radius: 20px; font-size: 0.78rem;">
                    <i class="fa-solid fa-circle-check me-1"></i> নো সাবস্ক্রিপশন ফি
                </span>
            </div>
        @endif

        @if($activeSubscription)
            <div style="background: linear-gradient(135deg, #044E35, #023624); color: white; padding: 1.25rem 1.5rem; border-radius: 12px; margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <div>
                    <span style="font-size: 0.78rem; text-transform: uppercase; letter-spacing: 1px; color: var(--accent-light); font-weight: 700;">ACTIVE PLAN MEMBERSHIP</span>
                    <h4 style="margin: 0.2rem 0; font-size: 1.4rem; color: white; text-transform: capitalize;">{{ $activeSubscription->plan_name }} VIP Membership</h4>
                    <span style="font-size: 0.82rem; color: #CBD5E1;">
                        <i class="fa-regular fa-calendar-check me-1"></i> মেয়াদ শেষ: {{ optional($activeSubscription->ends_at)->format('d M, Y') ?? 'Ongoing' }}
                    </span>
                </div>
                <div style="background: rgba(255,255,255,0.15); padding: 0.5rem 1rem; border-radius: 8px; font-weight: 700; font-size: 0.85rem;">
                    <i class="fa-solid fa-circle-check text-emerald-400 me-1"></i> ভেরিফায়েড একটিভ সাবস্ক্রিপশন
                </div>
            </div>
        @endif

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.88rem;">
                <thead>
                    <tr style="background: #F8FAFC; border-bottom: 2px solid var(--border-color); color: var(--text-muted); font-size: 0.78rem; text-transform: uppercase;">
                        <th style="padding: 0.85rem;">পেমেন্ট তারিখ</th>
                        <th style="padding: 0.85rem;">মেথড ও প্রেরক নম্বর</th>
                        <th style="padding: 0.85rem;">ট্রানজাকশন আইডি (TrxID)</th>
                        <th style="padding: 0.85rem;">টাকার পরিমাণ</th>
                        <th style="padding: 0.85rem;">ভেরিফিকেশন স্ট্যাটাস</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($myTransactions as $trx)
                        <tr style="border-bottom: 1px solid var(--border-color); {{ $trx->status == 'pending' ? 'background: #FFFBEB;' : '' }}">
                            <td style="padding: 0.9rem 0.85rem;">
                                <div style="font-weight: 600;">{{ $trx->created_at->format('d M, Y') }}</div>
                                <div style="font-size: 0.74rem; color: var(--text-muted);">{{ $trx->created_at->format('h:i A') }}</div>
                            </td>
                            <td style="padding: 0.9rem 0.85rem;">
                                <div style="font-weight: 700;">
                                    @if($trx->payment_method == 'bkash')
                                        <span style="color: #E2136E;"><i class="fa-solid fa-wallet"></i> bKash</span>
                                    @elseif($trx->payment_method == 'nagad')
                                        <span style="color: #ED1C24;"><i class="fa-solid fa-wallet"></i> Nagad</span>
                                    @elseif($trx->payment_method == 'rocket')
                                        <span style="color: #8C1515;"><i class="fa-solid fa-wallet"></i> Rocket</span>
                                    @else
                                        <span style="color: #F6921E;"><i class="fa-solid fa-wallet"></i> Upay</span>
                                    @endif
                                </div>
                                <div style="font-size: 0.78rem; color: var(--text-muted);">
                                    From: <strong>{{ $trx->gateway_response['sender_number'] ?? 'N/A' }}</strong>
                                </div>
                            </td>
                            <td style="padding: 0.9rem 0.85rem;">
                                <span style="font-family: monospace; font-weight: 700; font-size: 0.95rem; color: var(--primary-dark);">{{ $trx->transaction_id }}</span>
                                <div style="font-size: 0.72rem; color: var(--text-muted);">{{ strtoupper($trx->type) }}</div>
                            </td>
                            <td style="padding: 0.9rem 0.85rem;">
                                <strong style="font-size: 1rem; color: var(--primary-dark);">৳{{ number_format($trx->amount) }}</strong>
                            </td>
                            <td style="padding: 0.9rem 0.85rem;">
                                @if($trx->status == 'completed')
                                    <span class="badge" style="background: #D1FAE5; color: #065F46; font-size: 0.78rem;">
                                        <i class="fa-solid fa-check-circle me-1"></i> অনুমোদিত (Approved)
                                    </span>
                                @elseif($trx->status == 'pending')
                                    <span class="badge" style="background: #FEF3C7; color: #92400E; font-size: 0.78rem;">
                                        <i class="fa-solid fa-clock me-1"></i> অপেক্ষমান (Pending Admin Check)
                                    </span>
                                @else
                                    <span class="badge" style="background: #FEE2E2; color: #991B1B; font-size: 0.78rem;">
                                        <i class="fa-solid fa-circle-xmark me-1"></i> বাতিল (Failed / Rejected)
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 2.5rem; color: var(--text-muted);">
                                <i class="fa-solid fa-receipt" style="font-size: 2.2rem; color: #CBD5E1; margin-bottom: 0.5rem; display: block;"></i>
                                <p style="margin: 0; font-size: 0.9rem;">আপনার কোনো সাবস্ক্রিপশন বা পেমেন্ট ট্রানজাকশন রেকর্ড পাওয়া যায়নি।</p>
                                <a href="{{ route('payment.checkout') }}" class="btn-primary" style="margin-top: 0.75rem; display: inline-block; padding: 0.5rem 1.25rem; font-size: 0.85rem;">
                                    <i class="fa-solid fa-crown me-1"></i> প্রিমিয়াম প্যাকেজ গ্রহণ করুন
                                </a>
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

            <!-- Chat Footer Input Form -->
            <form id="chatSendForm" onsubmit="handleSendChatMessage(event)" style="padding: 0.85rem 1rem; background: white; border-top: 1px solid var(--border-color); display: flex; gap: 0.5rem; align-items: center;">
                <input type="hidden" id="chatInquiryId" value="">
                <input type="text" id="chatInputMessage" placeholder="একটি বার্তা লিখুন (মূল্য/শর্ত আলোচনা)..." autocomplete="off" required style="flex: 1; padding: 0.7rem 1rem; border: 1.5px solid var(--border-color); border-radius: 25px; font-size: 0.88rem; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='var(--border-color)'">
                <button type="submit" id="chatSendBtn" style="background: var(--primary); color: white; border: none; width: 42px; height: 42px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: 0.2s;">
                    <i class="fa-solid fa-paper-plane"></i>
                </button>
            </form>

        </div>
    </div>

    <!-- Live Chat JavaScript -->
    <script>
        let currentChatInquiryId = null;
        let chatPollTimer = null;

        function openChatModal(inquiryId, partnerName) {
            currentChatInquiryId = inquiryId;
            document.getElementById('chatInquiryId').value = inquiryId;
            document.getElementById('chatPartnerName').textContent = partnerName;
            document.getElementById('b2bChatModal').style.display = 'flex';
            document.getElementById('chatInputMessage').value = '';
            document.getElementById('chatInputMessage').focus();

            loadChatMessages(inquiryId);

            if (chatPollTimer) clearInterval(chatPollTimer);
            // Dynamic fast polling for near-instant messaging before WebSocket is connected
            chatPollTimer = setInterval(() => {
                if (currentChatInquiryId) {
                    loadChatMessages(currentChatInquiryId, true);
                }
            }, 2500);
        }

        function closeChatModal() {
            document.getElementById('b2bChatModal').style.display = 'none';
            currentChatInquiryId = null;
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

            const wasScrolledToBottom = (box.scrollHeight - box.clientHeight <= box.scrollTop + 50);

            let html = '';
            messages.forEach(m => {
                if (m.is_me) {
                    html += `
                    <div style="align-self: flex-end; max-width: 78%; display: flex; flex-direction: column; align-items: flex-end;">
                        <div style="background: var(--primary); color: white; padding: 0.65rem 0.95rem; border-radius: 14px 14px 2px 14px; font-size: 0.88rem; line-height: 1.45; word-break: break-word; box-shadow: 0 2px 5px rgba(0,0,0,0.06);">
                            ${m.message}
                        </div>
                        <span style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">${m.time}</span>
                    </div>`;
                } else {
                    html += `
                    <div style="align-self: flex-start; max-width: 78%; display: flex; flex-direction: column; align-items: flex-start;">
                        <span style="font-size: 0.72rem; font-weight: 700; color: #475569; margin-bottom: 0.15rem;">${m.sender_name}</span>
                        <div style="background: white; color: var(--text-dark); padding: 0.65rem 0.95rem; border-radius: 14px 14px 14px 2px; font-size: 0.88rem; line-height: 1.45; word-break: break-word; border: 1px solid var(--border-color); box-shadow: 0 2px 5px rgba(0,0,0,0.04);">
                            ${m.message}
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
            if (!message || !currentChatInquiryId) return;

            const btn = document.getElementById('chatSendBtn');
            btn.disabled = true;

            fetch('/chat/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    post_inquiry_id: currentChatInquiryId,
                    message: message
                })
            })
            .then(r => r.json())
            .then(data => {
                input.value = '';
                btn.disabled = false;
                loadChatMessages(currentChatInquiryId);
            })
            .catch(err => {
                btn.disabled = false;
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
