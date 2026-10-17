@extends('layouts.app')

@section('title', $agency->agency_name . ' - Agency Public Profile & Reputation')

@section('content')
    @php
        $lang = session('locale', 'bn');
    @endphp

    <div style="margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
        <a href="{{ route('posts.index') }}" style="color: var(--primary); text-decoration: none; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 0.4rem;">
            <i class="fa-solid fa-arrow-left"></i> {{ $lang == 'bn' ? 'মার্কেটপ্লেসে ফিরে যান' : 'Back to Marketplace' }}
        </a>

        @if(Auth::check() && Auth::id() === $agency->id)
            <a href="{{ route('agency.profile.edit') }}" class="btn-primary" style="background: #0D9488; padding: 0.5rem 1.25rem; font-size: 0.88rem; text-decoration: none;">
                <i class="fa-solid fa-pen-to-square"></i> {{ $lang == 'bn' ? 'প্রোফাইল ও সেটিংস এডিট করুন' : 'Edit Profile & Settings' }}
            </a>
        @endif
    </div>

    <!-- Agency Hero Banner -->
    <div style="background: white; border-radius: 20px; border: 1px solid var(--border-color); box-shadow: var(--shadow-md); overflow: hidden; margin-bottom: 2rem;">
        <div style="background: linear-gradient(135deg, #044E35 0%, #0F766E 50%, #064E3B 100%); padding: 3rem 2.5rem 4rem 2.5rem; color: white; position: relative;">
            <div style="position: absolute; right: 2rem; top: 1.5rem; opacity: 0.1; font-size: 8rem; pointer-events: none;">
                <i class="fa-solid fa-kaaba"></i>
            </div>
            
            <div style="display: flex; gap: 1.5rem; align-items: center; flex-wrap: wrap; position: relative; z-index: 1;">
                <div style="width: 100px; height: 100px; border-radius: 20px; background: white; border: 4px solid rgba(255,255,255,0.3); display: flex; align-items: center; justify-content: center; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
                    @if($agency->logo && file_exists(public_path($agency->logo)))
                        <img src="{{ asset($agency->logo) }}" alt="{{ $agency->agency_name }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <span style="font-size: 2.8rem; font-weight: 900; color: #044E35; font-family: 'Cinzel', serif;">
                            {{ strtoupper(substr($agency->agency_name, 0, 1)) }}
                        </span>
                    @endif
                </div>

                <div style="flex: 1; min-width: 280px;">
                    <div style="display: flex; align-items: center; gap: 0.6rem; flex-wrap: wrap; margin-bottom: 0.4rem;">
                        <h1 class="font-heading" style="font-size: 2rem; color: white; margin: 0; line-height: 1.2;">
                            {{ $agency->agency_name }}
                        </h1>
                        @if($agency->is_verified)
                            <span style="background: #10B981; color: white; font-size: 0.78rem; font-weight: 800; padding: 0.25rem 0.65rem; border-radius: 20px; display: inline-flex; align-items: center; gap: 0.3rem;">
                                <i class="fa-solid fa-circle-check"></i> VERIFIED B2B
                            </span>
                        @endif
                        @if($agency->isVip())
                            <span style="background: linear-gradient(135deg, #F59E0B, #D97706); color: white; font-size: 0.78rem; font-weight: 800; padding: 0.25rem 0.65rem; border-radius: 20px; display: inline-flex; align-items: center; gap: 0.3rem;">
                                <i class="fa-solid fa-crown"></i> VIP SUBSCRIBER
                            </span>
                        @endif
                    </div>

                    <p style="color: rgba(255,255,255,0.85); font-size: 0.95rem; margin-bottom: 0.75rem;">
                        <i class="fa-solid fa-building me-1"></i> {{ $agency->company_name }} &bull; <i class="fa-solid fa-location-dot me-1"></i> {{ $agency->city }}, Bangladesh
                    </p>

                    <!-- Star rating summary header -->
                    <div style="display: flex; align-items: center; gap: 0.8rem; flex-wrap: wrap;">
                        <div style="display: inline-flex; align-items: center; gap: 0.3rem; background: rgba(0,0,0,0.25); padding: 0.3rem 0.75rem; border-radius: 12px; border: 1px solid rgba(255,255,255,0.15);">
                            <span style="color: #FBBF24; font-size: 1.1rem;"><i class="fa-solid fa-star"></i></span>
                            <strong style="font-size: 1.1rem; color: white;">{{ number_format($averageRating, 1) }}</strong>
                            <span style="color: rgba(255,255,255,0.7); font-size: 0.82rem;">/ 5.0 ({{ $totalReviews }} {{ $lang == 'bn' ? 'টি রিভিউ' : 'reviews' }})</span>
                        </div>

                        <span style="color: rgba(255,255,255,0.7); font-size: 0.85rem;">
                            <i class="fa-solid fa-user-tie me-1"></i> {{ $lang == 'bn' ? 'মালিক/সিইও:' : 'Proprietor:' }} <strong>{{ $agency->owner_name }}</strong>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Badges & Verification Strip -->
        <div style="background: #F8FAFC; border-top: 1px solid var(--border-color); padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
            <div style="display: flex; gap: 1.5rem; flex-wrap: wrap; font-size: 0.85rem;">
                <div>
                    <span style="color: var(--text-muted); display: block; font-size: 0.75rem;">HAJJ / UMRAH LICENSE</span>
                    <strong style="color: var(--primary-dark);"><i class="fa-solid fa-id-card text-emerald-600 me-1"></i> {{ $agency->license_no }}</strong>
                </div>
                @if($agency->haab_no)
                    <div>
                        <span style="color: var(--text-muted); display: block; font-size: 0.75rem;">HAAB MEMBERSHIP</span>
                        <strong style="color: var(--primary-dark);"><i class="fa-solid fa-certificate text-amber-600 me-1"></i> HAAB-{{ $agency->haab_no }}</strong>
                    </div>
                @endif
                @if($agency->atab_no)
                    <div>
                        <span style="color: var(--text-muted); display: block; font-size: 0.75rem;">ATAB MEMBERSHIP</span>
                        <strong style="color: var(--primary-dark);"><i class="fa-solid fa-plane-departure text-blue-600 me-1"></i> ATAB-{{ $agency->atab_no }}</strong>
                    </div>
                @endif
                <div>
                    <span style="color: var(--text-muted); display: block; font-size: 0.75rem;">PHONE VERIFICATION</span>
                    <strong style="color: #059669;"><i class="fa-solid fa-shield-check me-1"></i> OTP VERIFIED</strong>
                </div>
            </div>

            <div style="display: flex; gap: 0.75rem;">
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $agency->whatsapp ?? $agency->phone) }}?text=Salam%20{{ urlencode($agency->agency_name) }},%20connecting%20via%20Hajj%20Umrah%20B2B%20Portal." target="_blank" class="btn-primary" style="background: #25D366; padding: 0.45rem 1rem; font-size: 0.85rem; text-decoration: none;">
                    <i class="fa-brands fa-whatsapp"></i> WhatsApp
                </a>
                <a href="tel:{{ $agency->phone }}" class="btn-secondary" style="padding: 0.45rem 1rem; font-size: 0.85rem; text-decoration: none;">
                    <i class="fa-solid fa-phone"></i> {{ $agency->phone }}
                </a>
            </div>
        </div>
    </div>

    <!-- Main Grid: Left Details & Right Rating Scorecard -->
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; margin-bottom: 2.5rem;" class="show-details-grid">
        <!-- Left: About & Reviews -->
        <div>
            <!-- Agency Bio / Overview -->
            <div style="background: white; border-radius: 16px; padding: 1.75rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); margin-bottom: 2rem;">
                <h3 class="font-heading" style="font-size: 1.25rem; color: var(--primary-dark); margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-circle-info text-emerald-600"></i> {{ $lang == 'bn' ? 'এজেন্সি পরিচিতি ও তথ্য' : 'Agency Overview & Profile' }}
                </h3>

                <p style="color: var(--text-dark); line-height: 1.7; font-size: 0.95rem; margin-bottom: 1.5rem; white-space: pre-line;">
                    {{ $agency->bio ?: ($lang == 'bn' ? 'এই এজেন্সিটি বাংলাদেশের একটি বিশ্বস্ত এবং অনুমোদিত হজ ও ওমরাহ ট্রাভেল সার্ভিস প্রোভাইডার। প্ল্যাটফর্মের মাধ্যমে নির্ভরযোগ্য B2B সিট শেয়ারিং ও টিকিট সেবা প্রদান করছে।' : 'This agency is a verified Hajj & Umrah provider in Bangladesh providing reliable B2B group seats, tickets, and accommodation arrangements.') }}
                </p>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; background: #F8FAFC; padding: 1.25rem; border-radius: 12px; border: 1px solid var(--border-color); font-size: 0.9rem;">
                    <div>
                        <span style="color: var(--text-muted); display: block; font-size: 0.8rem;">অফিস ঠিকানা:</span>
                        <strong style="color: var(--text-dark);"><i class="fa-solid fa-map-marker-alt text-red-500 me-1"></i> {{ $agency->address ?: 'N/A' }}</strong>
                    </div>
                    <div>
                        <span style="color: var(--text-muted); display: block; font-size: 0.8rem;">ইমেইল অ্যাড্রেস:</span>
                        <strong style="color: var(--text-dark);"><i class="fa-solid fa-envelope text-blue-500 me-1"></i> {{ $agency->email }}</strong>
                    </div>
                    @if($agency->website)
                        <div style="grid-column: span 2;">
                            <span style="color: var(--text-muted); display: block; font-size: 0.8rem;">অফিসিয়াল ওয়েবসাইট:</span>
                            <a href="{{ $agency->website }}" target="_blank" style="color: var(--primary); font-weight: 700; text-decoration: none;">
                                <i class="fa-solid fa-globe me-1"></i> {{ $agency->website }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Verified B2B Reviews Section -->
            <div style="background: white; border-radius: 16px; padding: 1.75rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); margin-bottom: 2rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
                    <div>
                        <h3 class="font-heading" style="font-size: 1.3rem; color: var(--primary-dark); margin: 0; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fa-solid fa-comments text-amber-500"></i> {{ $lang == 'bn' ? 'ভেরিফাইড এজেন্সিদের রিভিউ ও রেটিং' : 'Verified Partner Reviews' }}
                        </h3>
                        <p style="color: var(--text-muted); font-size: 0.85rem; margin-top: 0.25rem;">
                            {{ $lang == 'bn' ? 'সফল B2B লেনদেন সম্পন্ন করা এজেন্সি পার্টনারদের দেওয়া মতামত' : 'Ratings left by partner agencies following completed deals' }}
                        </p>
                    </div>

                    <span style="background: #FEF3C7; color: #92400E; font-size: 0.85rem; font-weight: 700; padding: 0.35rem 0.75rem; border-radius: 20px;">
                        {{ $totalReviews }} {{ $lang == 'bn' ? 'টি মোট রিভিউ' : 'Total Reviews' }}
                    </span>
                </div>

                @if($agency->reviewsReceived->count() > 0)
                    <div style="display: flex; flex-direction: column; gap: 1.25rem;">
                        @foreach($agency->reviewsReceived as $rev)
                            <div style="border: 1px solid var(--border-color); border-radius: 12px; padding: 1.25rem; background: #FAFAFA; transition: all 0.2s ease;">
                                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.75rem; flex-wrap: wrap; gap: 0.5rem;">
                                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                                        <div style="width: 42px; height: 42px; border-radius: 50%; background: #044E35; color: white; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.1rem;">
                                            {{ strtoupper(substr($rev->reviewerAgency->agency_name ?? 'A', 0, 1)) }}
                                        </div>
                                        <div>
                                            <a href="{{ route('agencies.show', $rev->reviewer_agency_id) }}" style="color: var(--primary-dark); font-weight: 700; text-decoration: none; font-size: 0.95rem;">
                                                {{ $rev->reviewerAgency->agency_name ?? 'Verified Agency' }}
                                            </a>
                                            <div style="font-size: 0.78rem; color: var(--text-muted);">
                                                <i class="fa-solid fa-certificate text-emerald-600"></i> {{ $rev->reviewerAgency->license_no ?? '' }} &bull; {{ $rev->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    </div>

                                    <div style="display: flex; align-items: center; gap: 0.4rem; background: white; padding: 0.3rem 0.65rem; border-radius: 8px; border: 1px solid #FDE68A;">
                                        <div style="color: #F59E0B; font-size: 0.85rem;">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $rev->rating)
                                                    <i class="fa-solid fa-star"></i>
                                                @else
                                                    <i class="fa-regular fa-star" style="color: #CBD5E1;"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <strong style="font-size: 0.85rem; color: #92400E;">{{ $rev->rating }}.0</strong>
                                    </div>
                                </div>

                                @if($rev->post_inquiry_id)
                                    <div style="margin-bottom: 0.6rem;">
                                        <span style="background: #ECFDF5; color: #065F46; font-size: 0.72rem; font-weight: 700; padding: 0.15rem 0.5rem; border-radius: 4px; border: 1px solid #A7F3D0;">
                                            <i class="fa-solid fa-shield-check"></i> ভেরিফাইড B2B ডিল ট্রানজেকশন
                                        </span>
                                    </div>
                                @endif

                                <p style="color: var(--text-dark); font-size: 0.92rem; line-height: 1.6; margin: 0; background: white; padding: 0.85rem; border-radius: 8px; border: 1px solid #E2E8F0;">
                                    "{{ $rev->comment ?: ($lang == 'bn' ? 'চমৎকার এবং নির্ভরযোগ্য পার্টনারশিপ। সময়মতো সমস্ত প্রসেসিং সম্পন্ন হয়েছে।' : 'Great experience working with this agency. Very professional.') }}"
                                </p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="text-align: center; padding: 3rem 1.5rem; background: #F8FAFC; border-radius: 12px; border: 1px dashed var(--border-color);">
                        <div style="font-size: 3rem; color: #CBD5E1; margin-bottom: 0.75rem;">
                            <i class="fa-regular fa-star"></i>
                        </div>
                        <h4 style="color: var(--text-dark); margin-bottom: 0.35rem;">{{ $lang == 'bn' ? 'এখনও কোনো রিভিউ জমা পড়েনি' : 'No Reviews Yet' }}</h4>
                        <p style="color: var(--text-muted); font-size: 0.88rem; max-width: 400px; margin: 0 auto;">
                            {{ $lang == 'bn' ? 'এই এজেন্সির সাথে সফল B2B ডিল সম্পন্ন করার পর চুক্তিপত্র ও ড্যাশবোর্ড থেকে রেটিং প্রদান করা যাবে।' : 'Once a B2B deal is completed with this agency, partners can leave verified ratings.' }}
                        </p>
                    </div>
                @endif
            </div>

            <!-- Active Listings by this Agency -->
            <div style="background: white; border-radius: 16px; padding: 1.75rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm);">
                <h3 class="font-heading" style="font-size: 1.25rem; color: var(--primary-dark); margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-ticket text-emerald-600"></i> {{ $lang == 'bn' ? 'চলমান B2B প্যাকেজ ও অফারসমূহ' : 'Current Active B2B Packages' }}
                </h3>

                @if($agency->posts->count() > 0)
                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        @foreach($agency->posts as $post)
                            <div style="border: 1px solid var(--border-color); border-radius: 12px; padding: 1.25rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                                <div>
                                    <div style="display: flex; gap: 0.5rem; margin-bottom: 0.35rem;">
                                        <span class="badge badge-{{ $post->post_category === 'group_seats' ? 'seats' : 'ticket' }}">
                                            {{ strtoupper(str_replace('_', ' ', $post->post_category)) }}
                                        </span>
                                        <span class="badge badge-pending">{{ strtoupper($post->departure_city) }}</span>
                                    </div>
                                    <h4 style="font-size: 1.05rem; color: var(--primary-dark); margin-bottom: 0.25rem;">
                                        {{ $post->title }}
                                    </h4>
                                    <div style="font-size: 0.82rem; color: var(--text-muted);">
                                        <i class="fa-solid fa-users text-red-500 me-1"></i> <strong>{{ $post->available_seats }} Pax</strong> &bull;
                                        <i class="fa-solid fa-calendar me-1"></i> {{ \Carbon\Carbon::parse($post->flight_date)->format('d M, Y') }} &bull;
                                        <i class="fa-solid fa-tag text-emerald-600 me-1"></i> <strong>৳{{ number_format($post->price_per_seat) }}</strong>/Pax
                                    </div>
                                </div>

                                <a href="{{ route('posts.show', $post->id) }}" class="btn-primary" style="padding: 0.5rem 1rem; font-size: 0.85rem; text-decoration: none;">
                                    {{ $lang == 'bn' ? 'অফার দেখুন' : 'View Deal' }} <i class="fa-solid fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p style="color: var(--text-muted); font-size: 0.9rem; text-align: center; padding: 1.5rem;">
                        {{ $lang == 'bn' ? 'বর্তমানে এই এজেন্সির কোনো সক্রিয় পাবলিক পোস্ট নেই।' : 'No active marketplace posts at the moment.' }}
                    </p>
                @endif
            </div>
        </div>

        <!-- Right: Reputation Scorecard & Rating Breakdown -->
        <div>
            <div style="background: white; border-radius: 16px; padding: 1.75rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); position: sticky; top: 90px;">
                <h3 class="font-heading" style="font-size: 1.15rem; color: var(--primary-dark); margin-bottom: 1.25rem; border-bottom: 2px solid var(--accent); padding-bottom: 0.5rem;">
                    <i class="fa-solid fa-award text-amber-500"></i> {{ $lang == 'bn' ? 'ট্রাস্ট স্কোর ও রেটিং বিশ্লেষণ' : 'Trust Score & Rating Breakdown' }}
                </h3>

                <!-- Big Scorecard -->
                <div style="text-align: center; background: #F8FAFC; padding: 1.5rem; border-radius: 14px; border: 1px solid var(--border-color); margin-bottom: 1.5rem;">
                    <div style="font-size: 3.5rem; font-weight: 900; color: #044E35; line-height: 1; font-family: 'Cinzel', serif;">
                        {{ number_format($averageRating, 1) }}
                    </div>
                    <div style="color: #F59E0B; font-size: 1.3rem; margin: 0.4rem 0;">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= round($averageRating))
                                <i class="fa-solid fa-star"></i>
                            @else
                                <i class="fa-regular fa-star" style="color: #CBD5E1;"></i>
                            @endif
                        @endfor
                    </div>
                    <p style="color: var(--text-muted); font-size: 0.82rem; margin: 0;">
                        {{ $lang == 'bn' ? 'ভেরিফাইড B2B স্কোর' : 'Verified B2B Rating' }} ({{ $totalReviews }} {{ $lang == 'bn' ? 'টি মূল্যায়ন' : 'Evaluations' }})
                    </p>
                </div>

                <!-- Star Breakdown Bars -->
                <div style="display: flex; flex-direction: column; gap: 0.65rem; margin-bottom: 1.5rem;">
                    @for($s = 5; $s >= 1; $s--)
                        <div style="display: flex; align-items: center; gap: 0.6rem; font-size: 0.82rem;">
                            <span style="width: 25px; font-weight: 700; color: var(--text-dark);">{{ $s }} ★</span>
                            <div style="flex: 1; height: 8px; background: #E2E8F0; border-radius: 4px; overflow: hidden;">
                                <div style="height: 100%; width: {{ $starPercentages[$s] }}%; background: #F59E0B; border-radius: 4px;"></div>
                            </div>
                            <span style="width: 35px; text-align: right; color: var(--text-muted); font-size: 0.78rem;">{{ $starCounts[$s] }}</span>
                        </div>
                    @endfor
                </div>

                <!-- Trust Badges Summary -->
                <div style="background: #ECFDF5; border: 1px solid #A7F3D0; border-radius: 10px; padding: 1rem; font-size: 0.82rem;">
                    <h5 style="color: #065F46; font-weight: 800; margin-bottom: 0.5rem; text-transform: uppercase;">
                        <i class="fa-solid fa-shield-halved me-1"></i> নিরাপত্তা ও নিশ্চয়তা
                    </h5>
                    <ul style="list-style: none; padding: 0; margin: 0; color: #047857; display: flex; flex-direction: column; gap: 0.35rem;">
                        <li><i class="fa-solid fa-check text-emerald-600 me-1"></i> লাইসেন্স ও কাগজপত্র অ্যাডমিন ভেরিফাইড</li>
                        <li><i class="fa-solid fa-check text-emerald-600 me-1"></i> শুধুমাত্র সম্পন্ন ডিলের পর রেটিং প্রযোজ্য</li>
                        <li><i class="fa-solid fa-check text-emerald-600 me-1"></i> ফেক রিভিউ ও স্প্যাম প্রতিরোধ ব্যবস্থা</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
