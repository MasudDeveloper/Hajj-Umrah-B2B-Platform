@extends('layouts.app')

@section('title', 'Agency Dashboard & Deal Tracking')

@section('content')
    <div style="background: white; border-radius: 16px; padding: 2rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); margin-bottom: 2rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem;">
            <div>
                <span class="badge badge-verified" style="margin-bottom: 0.5rem;"><i class="fa-solid fa-building"></i> {{ Auth::user()->agency_name }}</span>
                <h1 class="font-heading" style="font-size: 2rem; color: var(--primary-dark);">Agency B2B Control Panel</h1>
                <p style="color: var(--text-muted); font-size: 0.95rem;">Manage your active post requirements, status tracking, and incoming agency deal inquiries.</p>
            </div>

            <div>
                <a href="{{ route('posts.create') }}" class="btn-gold">
                    <i class="fa-solid fa-plus-circle"></i> Post New Requirement
                </a>
            </div>
        </div>
    </div>

    <!-- Agency Profile Header Banner -->
    <div style="background: linear-gradient(135deg, var(--primary-dark), var(--primary)); color: white; border-radius: 16px; padding: 1.75rem 2rem; margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem; border: 1px solid var(--accent);">
        <div style="display: flex; align-items: center; gap: 1.25rem;">
            <div style="width: 56px; height: 56px; background: var(--accent); color: var(--primary-dark); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; font-weight: 800;">
                {{ strtoupper(substr(Auth::user()->agency_name, 0, 1)) }}
            </div>
            <div>
                <h2 class="font-heading" style="font-size: 1.5rem; color: white;">{{ Auth::user()->agency_name }}</h2>
                <p style="color: var(--accent-light); font-size: 0.88rem;"><i class="fa-solid fa-certificate"></i> License: {{ Auth::user()->license_no }} | <i class="fa-solid fa-id-card"></i> HAAB: {{ Auth::user()->haab_no ?? 'N/A' }}</p>
            </div>
        </div>

        <div style="display: flex; gap: 0.75rem; align-items: center;">
            <span class="badge badge-verified" style="font-size: 0.8rem; padding: 0.4rem 0.8rem;">
                <i class="fa-solid fa-shield-check"></i> {{ strtoupper(Auth::user()->verification_status) }}
            </span>
            <span style="background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3); color: var(--accent-light); font-weight: 700; font-size: 0.8rem; padding: 0.4rem 0.8rem; border-radius: 20px;">
                <i class="fa-solid fa-crown me-1 text-amber-400"></i> Plan: {{ strtoupper(str_replace('_', ' ', Auth::user()->subscription_plan)) }}
            </span>
        </div>
    </div>

    <!-- Stats Row -->
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; margin-bottom: 2.5rem;">
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
                <span style="font-size: 0.85rem; color: var(--text-muted); display: block;">Total Vacant/Shortage Seats</span>
                <strong style="font-size: 1.75rem; color: #0284C7;">{{ $myPosts->sum('available_seats') }}</strong>
            </div>
            <div style="width: 48px; height: 48px; background: #E0F2FE; color: #0284C7; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem;">
                <i class="fa-solid fa-users"></i>
            </div>
        </div>

        <div style="background: white; padding: 1.5rem; border-radius: 12px; border: 1px solid var(--border-color); display: flex; align-items: center; justify-content: space-between;">
            <div>
                <span style="font-size: 0.85rem; color: var(--text-muted); display: block;">Received B2B Leads Inbox</span>
                <strong style="font-size: 1.75rem; color: #D97706;">{{ $myInquiries->count() }}</strong>
            </div>
            <div style="width: 48px; height: 48px; background: #FEF3C7; color: #D97706; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem;">
                <i class="fa-solid fa-inbox"></i>
            </div>
        </div>
    </div>

    <!-- Section 1: My B2B Posts & Status Tracking Table -->
    <div style="background: white; border-radius: 16px; padding: 1.75rem; border: 1px solid var(--border-color); margin-bottom: 2.5rem; box-shadow: var(--shadow-sm);">
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
                            </td>
                            <td style="padding: 1rem 0.85rem; font-weight: 700; color: var(--primary-dark);">৳{{ number_format($post->price_per_seat) }}</td>
                            <td style="padding: 1rem 0.85rem;">
                                <span class="badge badge-{{ $post->status === 'open' ? 'verified' : ($post->status === 'partially_filled' ? 'pending' : 'admin') }}">
                                    {{ strtoupper(str_replace('_', ' ', $post->status)) }}
                                </span>
                            </td>
                            <td style="padding: 1rem 0.85rem; text-align: right;">
                                <form action="{{ route('posts.status', $post->id) }}" method="POST" style="display: inline-flex; gap: 0.35rem; align-items: center;">
                                    @csrf
                                    <select name="status" onchange="this.form.submit()" style="padding: 0.35rem 0.6rem; border-radius: 6px; border: 1px solid var(--border-color); font-size: 0.8rem; background: white; font-weight: 600;">
                                        <option value="open" {{ $post->status == 'open' ? 'selected' : '' }}>🟢 Open</option>
                                        <option value="partially_filled" {{ $post->status == 'partially_filled' ? 'selected' : '' }}>🟡 Partially Filled</option>
                                        <option value="closed" {{ $post->status == 'closed' ? 'selected' : '' }}>🔴 Fully Booked / Closed</option>
                                    </select>
                                </form>
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
    <div style="background: white; border-radius: 16px; padding: 1.75rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm);">
        <h3 class="font-heading" style="font-size: 1.3rem; color: var(--primary-dark); margin-bottom: 1.25rem;">
            <i class="fa-solid fa-inbox text-amber-500"></i> Received B2B Deal Inquiries & Partner Leads
        </h3>

        <div style="display: flex; flex-direction: column; gap: 1rem;">
            @forelse($myInquiries as $inq)
                <div style="background: #F8FAFC; border: 1px solid var(--border-color); border-radius: 12px; padding: 1.25rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                    <div>
                        <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.35rem;">
                            <span class="badge badge-verified"><i class="fa-solid fa-certificate me-1"></i> {{ $inq->inquiringAgency->license_no }}</span>
                            <span style="font-size: 0.78rem; color: var(--text-muted);">Received: {{ $inq->created_at->diffForHumans() }}</span>
                        </div>
                        <h4 style="font-size: 1.05rem; color: var(--primary-dark); margin-bottom: 0.35rem;">
                            Inquiry From: {{ $inq->inquiringAgency->agency_name }} ({{ $inq->inquiringAgency->owner_name }})
                        </h4>
                        <p style="font-size: 0.85rem; color: var(--text-dark); margin-bottom: 0.5rem;">
                            <i class="fa-solid fa-quote-left text-amber-500 me-1"></i> "{{ $inq->message }}"
                        </p>
                        <div style="font-size: 0.82rem; color: var(--text-muted);">
                            <span style="margin-right: 1rem;"><i class="fa-solid fa-users me-1 text-blue-600"></i> Requested Pax/Seats: <strong>{{ $inq->requested_seats }} Pax</strong></span>
                            <span style="margin-right: 1rem;"><i class="fa-solid fa-phone me-1 text-emerald-600"></i> Phone: <strong>{{ $inq->inquiringAgency->phone }}</strong></span>
                            <span><i class="fa-solid fa-location-dot me-1 text-red-500"></i> Hub: {{ $inq->inquiringAgency->city }}</span>
                        </div>
                    </div>

                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $inq->inquiringAgency->whatsapp ?? $inq->inquiringAgency->phone) }}?text=Salam%20agency,%20responding%20to%20your%20B2B%20inquiry%20regarding%20our%20post." target="_blank" class="btn-primary" style="background: #25D366; padding: 0.65rem 1.1rem; font-size: 0.88rem;">
                        <i class="fa-brands fa-whatsapp me-1"></i> Chat on WhatsApp
                    </a>
                </div>
            @empty
                <div style="text-align: center; padding: 2.5rem; background: #F8FAFC; border-radius: 10px; color: var(--text-muted);">
                    <i class="fa-solid fa-envelope-open" style="font-size: 2.5rem; margin-bottom: 0.5rem;"></i>
                    <p>No incoming B2B deal inquiries received yet.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
