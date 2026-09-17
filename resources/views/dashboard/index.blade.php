@extends('layouts.app')

@section('title', 'Agency Dashboard & B2B Deal Contracting')

@section('content')
    <div class="responsive-card-padding" style="background: white; border-radius: 16px; padding: 2rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); margin-bottom: 2rem;">
        <div class="responsive-header-flex" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem;">
            <div>
                <span class="badge badge-verified" style="margin-bottom: 0.5rem;"><i class="fa-solid fa-building"></i> {{ Auth::user()->agency_name }}</span>
                <h1 class="font-heading" style="font-size: 2rem; color: var(--primary-dark);">Agency B2B Control Panel</h1>
                <p style="color: var(--text-muted); font-size: 0.95rem;">Manage your active post requirements, status tracking, and 2-way B2B deal contract agreements.</p>
            </div>

            <div>
                <a href="{{ route('posts.create') }}" class="btn-gold">
                    <i class="fa-solid fa-plus-circle"></i> Post New Requirement
                </a>
            </div>
        </div>
    </div>

    <!-- Agency Profile Header Banner -->
    <div class="responsive-card-padding" style="background: linear-gradient(135deg, var(--primary-dark), var(--primary)); color: white; border-radius: 16px; padding: 1.75rem 2rem; margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem; border: 1px solid var(--accent);">
        <div style="display: flex; align-items: center; gap: 1.25rem; flex-wrap: wrap;">
            <div style="width: 56px; height: 56px; background: var(--accent); color: var(--primary-dark); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; font-weight: 800;">
                {{ strtoupper(substr(Auth::user()->agency_name, 0, 1)) }}
            </div>
            <div>
                <h2 class="font-heading" style="font-size: 1.5rem; color: white;">{{ Auth::user()->agency_name }}</h2>
                <p style="color: var(--accent-light); font-size: 0.88rem;"><i class="fa-solid fa-certificate"></i> License: {{ Auth::user()->license_no }} | <i class="fa-solid fa-id-card"></i> HAAB: {{ Auth::user()->haab_no ?? 'N/A' }}</p>
            </div>
        </div>

        <div style="display: flex; gap: 0.75rem; align-items: center; flex-wrap: wrap;">
            <span class="badge badge-verified" style="font-size: 0.8rem; padding: 0.4rem 0.8rem;">
                <i class="fa-solid fa-shield-check"></i> {{ strtoupper(Auth::user()->verification_status) }}
            </span>
            <span style="background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3); color: var(--accent-light); font-weight: 700; font-size: 0.8rem; padding: 0.4rem 0.8rem; border-radius: 20px;">
                <i class="fa-solid fa-crown me-1 text-amber-400"></i> Plan: {{ strtoupper(str_replace('_', ' ', Auth::user()->subscription_plan)) }}
            </span>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="dashboard-stats-grid" style="margin-bottom: 2.5rem;">
        <div style="background: white; padding: 1.5rem; border-radius: 12px; border: 1px solid var(--border-color); display: flex; align-items: center; justify-content: space-between;">
            <div>
                <span style="font-size: 0.85rem; color: var(--text-muted); display: block;">My Active B2B Posts</span>
                <strong style="font-size: 1.75rem; color: var(--primary-dark);">{{ $myPosts->count() }}</strong>
            </div>
            <div style="width: 48px; height: 48px; background: #ECFDF5; color: #047857; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem;">
                <i class="fa-solid fa-layer-group"></i>
            </div>
        </div>

        <div style="background: white; padding: 1.5rem; border-radius: 12px; border: 1px solid var(--border-color); display: flex; align-items: center; justify-content: space-between;">
            <div>
                <span style="font-size: 0.85rem; color: var(--text-muted); display: block;">Received B2B Proposals</span>
                <strong style="font-size: 1.75rem; color: #0284C7;">{{ $myInquiries->count() }}</strong>
            </div>
            <div style="width: 48px; height: 48px; background: #E0F2FE; color: #0284C7; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem;">
                <i class="fa-solid fa-inbox"></i>
            </div>
        </div>

        <div style="background: white; padding: 1.5rem; border-radius: 12px; border: 1px solid var(--border-color); display: flex; align-items: center; justify-content: space-between;">
            <div>
                <span style="font-size: 0.85rem; color: var(--text-muted); display: block;">My Sent Deal Proposals</span>
                <strong style="font-size: 1.75rem; color: #D97706;">{{ $sentInquiries->count() }}</strong>
            </div>
            <div style="width: 48px; height: 48px; background: #FEF3C7; color: #D97706; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem;">
                <i class="fa-solid fa-paper-plane"></i>
            </div>
        </div>
    </div>

    <!-- Section 1: My B2B Posts & Status Tracking Table -->
    <div class="responsive-card-padding" style="background: white; border-radius: 16px; padding: 1.75rem; border: 1px solid var(--border-color); margin-bottom: 2.5rem; box-shadow: var(--shadow-sm);">
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
    <div class="responsive-card-padding" style="background: white; border-radius: 16px; padding: 1.75rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); margin-bottom: 2.5rem;">
        <h3 class="font-heading" style="font-size: 1.3rem; color: var(--primary-dark); margin-bottom: 1.25rem;">
            <i class="fa-solid fa-inbox text-amber-500 me-1"></i> Received B2B Proposals & Quotation Responses
        </h3>

        <div style="display: flex; flex-direction: column; gap: 1.25rem;">
            @forelse($myInquiries as $inq)
                <div style="background: #F8FAFC; border: 1px solid var(--border-color); border-radius: 14px; padding: 1.25rem; display: flex; flex-direction: column; gap: 1rem;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 0.75rem;">
                        <div>
                            <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.35rem; flex-wrap: wrap;">
                                <span class="badge badge-verified"><i class="fa-solid fa-certificate me-1"></i> HAAB Lic: {{ $inq->inquiringAgency->haab_no ?? $inq->inquiringAgency->license_no }}</span>
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
    <div class="responsive-card-padding" style="background: white; border-radius: 16px; padding: 1.75rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm);">
        <h3 class="font-heading" style="font-size: 1.3rem; color: var(--primary-dark); margin-bottom: 1.25rem;">
            <i class="fa-solid fa-paper-plane text-sky-600 me-1"></i> My Sent B2B Proposals & Deal Tracking
        </h3>

        <div style="display: flex; flex-direction: column; gap: 1.25rem;">
            @forelse($sentInquiries as $sInq)
                <div style="background: #F8FAFC; border: 1px solid var(--border-color); border-radius: 14px; padding: 1.25rem; display: flex; flex-direction: column; gap: 1rem;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 0.75rem;">
                        <div>
                            <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.35rem; flex-wrap: wrap;">
                                <span class="badge badge-verified"><i class="fa-solid fa-certificate me-1"></i> Seller HAAB: {{ $sInq->post->agency->haab_no ?? $sInq->post->agency->license_no }}</span>
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
@endsection
