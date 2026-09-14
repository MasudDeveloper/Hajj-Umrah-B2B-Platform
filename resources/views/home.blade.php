@extends('layouts.app')

@section('title', session('locale', 'bn') == 'bn' ? 'হজ ও ওমরাহ B2B শেয়ারিং প্ল্যাটফর্ম - বাংলাদেশ' : 'Hajj & Umrah B2B SaaS Platform - Bangladesh')

@section('content')
    @php
        $lang = session('locale', 'bn');
    @endphp

    <!-- Breathtaking Hero Banner with High-Res Makkah Kaaba Imagery & Glassmorphism -->
    <div style="position: relative; border-radius: 24px; padding: 4.5rem 3rem; color: white; margin-bottom: 3.5rem; overflow: hidden; box-shadow: 0 20px 40px rgba(0, 78, 53, 0.25); border: 1px solid rgba(212, 175, 55, 0.4); background: url('{{ asset('images/makkah_kaaba_hero.jpg') }}') center/cover no-repeat;">
        <!-- Dark Golden Emerald Gradient Overlay -->
        <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(2, 44, 30, 0.92) 0%, rgba(4, 78, 53, 0.85) 50%, rgba(0, 0, 0, 0.88) 100%); z-index: 1;"></div>

        <!-- Glowing Decorative Elements -->
        <div style="position: absolute; top: -100px; right: -100px; width: 350px; height: 350px; background: radial-gradient(circle, rgba(212, 175, 55, 0.25) 0%, rgba(0,0,0,0) 70%); pointer-events: none; z-index: 1;"></div>

        <div style="max-width: 850px; position: relative; z-index: 2;">
            <div style="display: inline-flex; align-items: center; gap: 0.6rem; background: rgba(212, 175, 55, 0.2); backdrop-filter: blur(10px); border: 1px solid rgba(212, 175, 55, 0.6); padding: 0.45rem 1.1rem; border-radius: 30px; font-size: 0.88rem; color: #F3E5AB; font-weight: 700; margin-bottom: 1.5rem; text-shadow: 0 2px 4px rgba(0,0,0,0.5);">
                <i class="fa-solid fa-kaaba text-amber-300"></i> {{ $lang == 'bn' ? 'বাংলাদেশের নিবন্ধিত হজ ও ওমরাহ এজেন্সি সমূহের জন্য ১০০% ভেরিফাইড B2B পোর্টাল' : 'Strictly Verified Agency-to-Agency B2B SaaS Portal' }}
            </div>
            
            <h1 class="font-heading" style="font-size: 3.1rem; font-weight: 800; line-height: 1.2; margin-bottom: 1.25rem; color: #FFFFFF; text-shadow: 0 4px 12px rgba(0,0,0,0.6);">
                @if($lang == 'bn')
                    হজ ও ওমরাহ <span style="color: #F3E5AB; background: linear-gradient(180deg, #F3E5AB 0%, #D4AF37 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">গ্রুপ সিট শেয়ারিং</span>, টিকিট এক্সচেঞ্জ ও হোটেল নেটওয়ার্ক
                @else
                    Exclusive <span style="color: #F3E5AB; background: linear-gradient(180deg, #F3E5AB 0%, #D4AF37 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Hajj & Umrah B2B</span> Collaboration & Sharing Portal
                @endif
            </h1>
            
            <p style="font-size: 1.15rem; line-height: 1.7; color: #E2E8F0; margin-bottom: 2.25rem; text-shadow: 0 2px 4px rgba(0,0,0,0.5); max-width: 760px;">
                @if($lang == 'bn')
                    আপনার গ্রুপের সিট শর্টেজ পূরণ করুন (যেমন: ২৫ জনের গ্রুপ রেডি, ১০ জন প্রয়োজন), কনফার্মড অতিরিক্ত ফ্লাইট টিকিট বেচাকেনা করুন এবং মক্কা-মদিনায় হোটেল রুম শেয়ারিং করুন সম্পূর্ণ নিরাপদ B2B মাধ্যমে।
                @else
                    Fill group seat shortages (25 pax ready + 10 seats needed), trade surplus flight tickets, and share Makkah/Madinah hotel rooms securely among licensed HAAB agencies in Bangladesh.
                @endif
            </p>

            <div style="display: flex; gap: 1.25rem; flex-wrap: wrap;">
                <a href="{{ route('posts.index') }}" class="btn-gold" style="font-size: 1.1rem; padding: 0.95rem 2rem; box-shadow: 0 8px 20px rgba(212, 175, 55, 0.4);">
                    <i class="fa-solid fa-layer-group"></i> {{ $lang == 'bn' ? 'B2B মার্কেটপ্লেস দেখুন' : 'Explore B2B Marketplace' }}
                </a>
                @guest
                    <a href="{{ route('register') }}" class="btn-primary" style="background: rgba(255,255,255,0.18); backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,0.4); font-size: 1.1rem; padding: 0.95rem 2rem;">
                        <i class="fa-solid fa-user-plus"></i> {{ $lang == 'bn' ? 'এজেন্সি অ্যাকাউন্ট খুলুন (ফ্রি)' : 'Register Agency Account' }}
                    </a>
                @endguest
            </div>
        </div>

        <!-- Live B2B Platform Stats Bar with Glassmorphism -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.5rem; margin-top: 3.5rem; background: rgba(0, 0, 0, 0.45); backdrop-filter: blur(16px); border-radius: 16px; padding: 1.75rem; border: 1px solid rgba(255, 255, 255, 0.2); position: relative; z-index: 2;">
            <div style="display: flex; align-items: center; gap: 1.1rem;">
                <div style="width: 52px; height: 52px; background: rgba(212, 175, 55, 0.25); border: 1px solid var(--accent); border-radius: 14px; display: flex; align-items: center; justify-content: center; color: var(--accent-light); font-size: 1.4rem;">
                    <i class="fa-solid fa-building-circle-check"></i>
                </div>
                <div>
                    <h3 style="font-size: 1.9rem; font-weight: 800; color: #FFFFFF; font-family: 'Outfit', sans-serif;">{{ $totalAgencies }}</h3>
                    <p style="font-size: 0.85rem; color: #CBD5E1; font-weight: 500;">{{ $lang == 'bn' ? 'অনুমোদিত ভেরিফাইড এজেন্সি' : 'Verified Licensed Agencies' }}</p>
                </div>
            </div>

            <div style="display: flex; align-items: center; gap: 1.1rem;">
                <div style="width: 52px; height: 52px; background: rgba(59, 130, 246, 0.25); border: 1px solid #93C5FD; border-radius: 14px; display: flex; align-items: center; justify-content: center; color: #93C5FD; font-size: 1.4rem;">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div>
                    <h3 style="font-size: 1.9rem; font-weight: 800; color: #FFFFFF; font-family: 'Outfit', sans-serif;">{{ $totalVacantPax }}</h3>
                    <p style="font-size: 0.85rem; color: #CBD5E1; font-weight: 500;">{{ $lang == 'bn' ? 'ফাঁকা/প্রয়োজনীয় প্যাক্স সিট' : 'Group Seat Shortages' }}</p>
                </div>
            </div>

            <div style="display: flex; align-items: center; gap: 1.1rem;">
                <div style="width: 52px; height: 52px; background: rgba(16, 185, 129, 0.25); border: 1px solid #6EE7B7; border-radius: 14px; display: flex; align-items: center; justify-content: center; color: #6EE7B7; font-size: 1.4rem;">
                    <i class="fa-solid fa-handshake"></i>
                </div>
                <div>
                    <h3 style="font-size: 1.9rem; font-weight: 800; color: #FFFFFF; font-family: 'Outfit', sans-serif;">{{ $totalActivePosts }}</h3>
                    <p style="font-size: 0.85rem; color: #CBD5E1; font-weight: 500;">{{ $lang == 'bn' ? 'সক্রিয় B2B ডিল' : 'Active B2B Deals' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Visual Showcase Gallery: Makkah & Madinah B2B Hubs -->
    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.75rem; margin-bottom: 4rem;">
        <!-- Madinah Mosque Visual Banner -->
        <div style="position: relative; border-radius: 20px; overflow: hidden; height: 260px; box-shadow: var(--shadow-md); border: 1px solid var(--border-color); background: url('{{ asset('images/madinah_nabawi_hero.jpg') }}') center/cover no-repeat;">
            <div style="position: absolute; inset: 0; background: linear-gradient(180deg, rgba(0,0,0,0.1) 0%, rgba(2, 44, 30, 0.9) 100%);"></div>
            <div style="position: absolute; bottom: 1.5rem; left: 1.5rem; right: 1.5rem; color: white; z-index: 2;">
                <span class="badge badge-ticket" style="background: rgba(212, 175, 55, 0.3); border: 1px solid var(--accent); color: #F3E5AB; margin-bottom: 0.5rem;">
                    🕌 MADINAH AL-MUNAWWARAH HUB
                </span>
                <h3 class="font-heading" style="font-size: 1.4rem; color: white; margin-bottom: 0.35rem;">
                    {{ $lang == 'bn' ? 'মদিনা হোটেল ও জিয়ারা গ্রুপ শেয়ারিং' : 'Madinah Hotel & Ziyarah Group Network' }}
                </h3>
                <p style="font-size: 0.85rem; color: #E2E8F0;">
                    {{ $lang == 'bn' ? 'মসজিদে নববীর নিকটে (৫০-৩০০ মিটারের মধ্যে) হোটেল রুম শেয়ারিং ডিল।' : 'Hotels within 50m - 300m walk to Masjid an-Nabawi Courtyard.' }}
                </p>
            </div>
        </div>

        <!-- Makkah Clock Tower Visual Banner -->
        <div style="position: relative; border-radius: 20px; overflow: hidden; height: 260px; box-shadow: var(--shadow-md); border: 1px solid var(--border-color); background: url('{{ asset('images/makkah_clock_tower.jpg') }}') center/cover no-repeat;">
            <div style="position: absolute; inset: 0; background: linear-gradient(180deg, rgba(0,0,0,0.1) 0%, rgba(2, 44, 30, 0.9) 100%);"></div>
            <div style="position: absolute; bottom: 1.5rem; left: 1.5rem; right: 1.5rem; color: white; z-index: 2;">
                <span class="badge badge-verified" style="background: rgba(4, 120, 87, 0.4); border: 1px solid #6EE7B7; color: #A7F3D0; margin-bottom: 0.5rem;">
                    🕋 MAKKAH CLOCK TOWER & HARAM HUB
                </span>
                <h3 class="font-heading" style="font-size: 1.4rem; color: white; margin-bottom: 0.35rem;">
                    {{ $lang == 'bn' ? 'মক্কা ক্লক টাওয়ার ও ৫-তারকা আবাসন' : 'Luxury Makkah Accommodation Deals' }}
                </h3>
                <p style="font-size: 0.85rem; color: #E2E8F0;">
                    {{ $lang == 'bn' ? 'সুইসোটেল, ফেয়ারমন্ট ও আনজুম হোটেলের কোটা শেয়ারিং।' : 'Exclusive luxury quota sharing in Swissotel, Fairmont & Anjum Makkah.' }}
                </p>
            </div>
        </div>
    </div>

    <!-- Section 1: How It Works (কিভাবে কাজ করে - ৪টি সহজ ধাপ) -->
    <div style="margin-bottom: 4rem;">
        <div style="text-align: center; max-width: 650px; margin: 0 auto 2.5rem;">
            <span class="badge badge-verified" style="margin-bottom: 0.5rem;"><i class="fa-solid fa-route"></i> {{ $lang == 'bn' ? 'সহজ কাজের ধারা' : 'How It Works' }}</span>
            <h2 class="font-heading" style="font-size: 2.2rem; color: var(--primary-dark); margin-bottom: 0.5rem;">
                {{ $lang == 'bn' ? 'কিভাবে প্ল্যাটফর্মটি ব্যবহার করবেন?' : '4 Simple Steps for Agency Collaboration' }}
            </h2>
            <p style="color: var(--text-muted); font-size: 0.95rem;">
                {{ $lang == 'bn' ? 'নিবন্ধন থেকে শুরু করে ডিল সম্পন্ন করা পর্যন্ত মাত্র ৪টি ধাপে সম্পন্ন করুন।' : 'From agency verification to deal closing, easily complete transactions in 4 transparent steps.' }}
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
            <div class="card" style="padding: 1.75rem; text-align: center; border-top: 4px solid var(--primary);">
                <div style="width: 60px; height: 60px; background: #ECFDF5; color: var(--primary); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 800; margin-bottom: 1.25rem;">
                    ১
                </div>
                <h3 class="font-heading" style="font-size: 1.15rem; color: var(--primary-dark); margin-bottom: 0.5rem;">
                    {{ $lang == 'bn' ? 'এজেন্সি ভেরিফিকেশন' : 'Agency Verification' }}
                </h3>
                <p style="font-size: 0.88rem; color: var(--text-muted); line-height: 1.5;">
                    {{ $lang == 'bn' ? 'হাব (HAAB) নম্বর ও গভঃ লাইসেন্স নম্বর দিয়ে অ্যাকাউন্ট রেজিস্ট্রেশন করুন। সুপার এডমিন যাচাই করে অ্যাপ্রুভ করবেন।' : 'Register with HAAB & Govt license number. Admin verifies identity for maximum fraud prevention.' }}
                </p>
            </div>

            <div class="card" style="padding: 1.75rem; text-align: center; border-top: 4px solid var(--accent);">
                <div style="width: 60px; height: 60px; background: #FEF3C7; color: #B45309; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 800; margin-bottom: 1.25rem;">
                    ২
                </div>
                <h3 class="font-heading" style="font-size: 1.15rem; color: var(--primary-dark); margin-bottom: 0.5rem;">
                    {{ $lang == 'bn' ? 'রিকোয়ারমেন্ট পোস্ট করুন' : 'Post Requirements' }}
                </h3>
                <p style="font-size: 0.88rem; color: var(--text-muted); line-height: 1.5;">
                    {{ $lang == 'bn' ? 'গ্রুপ সিট ভ্যাকেন্সি (যেমন: ২৫ জন রেডি, ১০ জন প্রয়োজন), অতিরিক্ত টিকিট বা হোটেল রুম শেয়ারের তথ্য পোস্ট করুন।' : 'Post group vacancies, surplus flight ticket blocks, or Makkah/Madinah room sharing.' }}
                </p>
            </div>

            <div class="card" style="padding: 1.75rem; text-align: center; border-top: 4px solid #0284C7;">
                <div style="width: 60px; height: 60px; background: #E0F2FE; color: #0284C7; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 800; margin-bottom: 1.25rem;">
                    ৩
                </div>
                <h3 class="font-heading" style="font-size: 1.15rem; color: var(--primary-dark); margin-bottom: 0.5rem;">
                    {{ $lang == 'bn' ? 'কন্টাক্ট ও হোয়াটসঅ্যাপ' : 'Direct Call & WhatsApp' }}
                </h3>
                <p style="font-size: 0.88rem; color: var(--text-muted); line-height: 1.5;">
                    {{ $lang == 'bn' ? 'ভেরিফাইড এজেন্সিরা সরাসরি পোস্টদাতার নম্বর ও ১-ক্লিক হোয়াটসঅ্যাপ বোতামের মাধ্যমে দ্রুত কথা বলুন।' : 'Approved agencies instantly unlock direct phone numbers & pre-formatted WhatsApp chat links.' }}
                </p>
            </div>

            <div class="card" style="padding: 1.75rem; text-align: center; border-top: 4px solid #7C3AED;">
                <div style="width: 60px; height: 60px; background: #F3E8FF; color: #7C3AED; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 800; margin-bottom: 1.25rem;">
                    ৪
                </div>
                <h3 class="font-heading" style="font-size: 1.15rem; color: var(--primary-dark); margin-bottom: 0.5rem;">
                    {{ $lang == 'bn' ? 'PDF কোটেশন ও ডিল' : 'Branded PDF Quotation' }}
                </h3>
                <p style="font-size: 0.88rem; color: var(--text-muted); line-height: 1.5;">
                    {{ $lang == 'bn' ? 'আপনার এজেন্সির প্যাড ও লোগোসহ ১-ক্লিকে B2B PDF কোটেশন ডেক ডাউনলোড বা প্রিন্ট করুন।' : 'Generate printable branded B2B quotation decks with hotel distances & rate breakdowns.' }}
                </p>
            </div>
        </div>
    </div>

    <!-- Category A Showcase: Group Seats -->
    <div style="margin-bottom: 4rem;">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
            <div>
                <span class="badge badge-seats" style="margin-bottom: 0.5rem;"><i class="fa-solid fa-users"></i> {{ $lang == 'bn' ? 'ক্যাটাগরি A: সিট শেয়ারিং' : 'Category A' }}</span>
                <h2 class="font-heading" style="font-size: 1.8rem; color: var(--primary-dark);">
                    {{ $lang == 'bn' ? 'গ্রুপ সিট প্রয়োজন ও অতিরিক্ত সিট ফাঁকা' : 'Group Seat Requirements & Availability' }}
                </h2>
                <p style="color: var(--text-muted); font-size: 0.95rem;">
                    {{ $lang == 'bn' ? 'অন্য এজেন্সির সাথে সিট শেয়ার করে ফ্লাইট কোটা পূরণ ও খরচ বাঁচান।' : 'Collaborate with agencies needing extra seats or holding confirmed flight blocks.' }}
                </p>
            </div>
            <a href="{{ route('posts.index', ['post_category' => 'group_seats']) }}" style="color: var(--primary); font-weight: 600; text-decoration: none; display: flex; align-items: center; gap: 0.4rem;">
                {{ $lang == 'bn' ? 'সকল সিট ডিল দেখুন' : 'View All Group Deals' }} <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 1.5rem;">
            @foreach($featuredGroupSeats as $post)
                <div class="card" style="display: flex; flex-direction: column;">
                    <div style="padding: 1.1rem; background: #F8FAFC; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center;">
                        <span class="badge badge-seats">GROUP SEATS</span>
                        <div style="background: {{ $post->requirement_type === 'need_seats' ? '#FEF2F2' : '#ECFDF5' }}; color: {{ $post->requirement_type === 'need_seats' ? '#991B1B' : '#065F46' }}; font-weight: 700; font-size: 0.8rem; padding: 0.2rem 0.6rem; border-radius: 12px;">
                            {{ $post->available_seats }} {{ $post->requirement_type === 'need_seats' ? ($lang == 'bn' ? 'সিট প্রয়োজন' : 'Seats Needed') : ($lang == 'bn' ? 'সিট ফাঁকা' : 'Seats Available') }}
                        </div>
                    </div>

                    <div style="padding: 1.5rem; flex: 1; display: flex; flex-direction: column; justify-content: space-between;">
                        <div>
                            <h3 class="font-heading" style="font-size: 1.15rem; color: var(--text-dark); margin-bottom: 0.75rem; line-height: 1.3;">
                                {{ $post->title }}
                            </h3>

                            <div style="font-size: 0.85rem; color: var(--text-dark); margin-bottom: 1.25rem;">
                                <p style="margin-bottom: 0.35rem;"><i class="fa-regular fa-calendar text-emerald-700 me-1"></i> <strong>{{ $lang == 'bn' ? 'ফ্লাইটের তারিখ:' : 'Flight Date:' }}</strong> {{ $post->flight_date->format('d M, Y') }}</p>
                                <p style="margin-bottom: 0.35rem;"><i class="fa-solid fa-plane text-blue-600 me-1"></i> <strong>{{ $lang == 'bn' ? 'হাব ও এয়ারলাইন:' : 'Hub & Airline:' }}</strong> {{ $post->departure_city }} ({{ $post->airline }})</p>
                                @if($post->makkah_hotel)
                                    <p style="margin-bottom: 0.35rem;"><i class="fa-solid fa-hotel me-1 text-amber-600"></i> <strong>{{ $lang == 'bn' ? 'মক্কা হোটেল:' : 'Makkah Hotel:' }}</strong> {{ $post->makkah_hotel }}</p>
                                    <span style="font-size: 0.75rem; background: #ECFDF5; color: #047857; padding: 0.2rem 0.5rem; border-radius: 6px; font-weight: 600; display: inline-block; margin-top: 0.2rem;">
                                        <i class="fa-solid fa-person-walking me-1"></i> {{ $post->makkah_hotel_distance }}m (~{{ ceil($post->makkah_hotel_distance / 80) }} {{ $lang == 'bn' ? 'মিনিট হাঁটার পথ' : 'Mins Walk to Haram' }})
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div style="border-top: 1px dashed var(--border-color); padding-top: 1rem; display: flex; align-items: center; justify-content: space-between;">
                            <div>
                                <span style="font-size: 0.72rem; color: var(--text-muted); display: block;">{{ $lang == 'bn' ? 'জনপ্রতি B2B রেট' : 'B2B Rate/Pax' }}</span>
                                <span style="font-size: 1.3rem; font-weight: 800; color: var(--primary-dark);">৳{{ number_format($post->price_per_seat) }}</span>
                            </div>

                            <a href="{{ route('posts.show', $post->id) }}" class="btn-gold" style="padding: 0.5rem 0.85rem; font-size: 0.85rem;">
                                {{ $lang == 'bn' ? 'ডিটেইলস ও কন্টাক্ট' : 'View Contact' }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Category B & C Showcase Grid -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 4rem;">
        <!-- Category B -->
        <div style="background: white; border-radius: 16px; padding: 1.75rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
                <span class="badge badge-ticket"><i class="fa-solid fa-ticket"></i> {{ $lang == 'bn' ? 'ক্যাটাগরি B' : 'Category B' }}</span>
                <a href="{{ route('posts.index', ['post_category' => 'ticket_only']) }}" style="color: var(--primary); font-weight: 600; font-size: 0.85rem; text-decoration: none;">{{ $lang == 'bn' ? 'সব টিকিট দেখুন' : 'View All Tickets' }} <i class="fa-solid fa-arrow-right"></i></a>
            </div>
            <h3 class="font-heading" style="font-size: 1.4rem; color: var(--primary-dark); margin-bottom: 1rem;">
                {{ $lang == 'bn' ? 'ফ্লাইট টিকিট ও ভিসা প্রসেসিং অনলি' : 'Ticket & Visa Only Offers' }}
            </h3>

            <div style="display: flex; flex-direction: column; gap: 1rem;">
                @foreach($featuredTickets as $t)
                    <div style="background: #F8FAFC; border: 1px solid var(--border-color); border-radius: 10px; padding: 1rem; display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <h4 style="font-size: 0.95rem; color: var(--primary-dark); margin-bottom: 0.25rem;">{{ $t->title }}</h4>
                            <p style="font-size: 0.8rem; color: var(--text-muted);"><i class="fa-solid fa-plane"></i> {{ $t->airline }} | {{ $t->flight_date->format('d M, Y') }}</p>
                        </div>
                        <a href="{{ route('posts.show', $t->id) }}" class="btn-primary" style="padding: 0.4rem 0.75rem; font-size: 0.8rem;">
                            ৳{{ number_format($t->price_per_seat) }}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Category C -->
        <div style="background: white; border-radius: 16px; padding: 1.75rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
                <span class="badge badge-hotel"><i class="fa-solid fa-hotel"></i> {{ $lang == 'bn' ? 'ক্যাটাগরি C' : 'Category C' }}</span>
                <a href="{{ route('posts.index', ['post_category' => 'hotel_share']) }}" style="color: var(--primary); font-weight: 600; font-size: 0.85rem; text-decoration: none;">{{ $lang == 'bn' ? 'সব হোটেল দেখুন' : 'View All Hotels' }} <i class="fa-solid fa-arrow-right"></i></a>
            </div>
            <h3 class="font-heading" style="font-size: 1.4rem; color: var(--primary-dark); margin-bottom: 1rem;">
                {{ $lang == 'bn' ? 'মক্কা ও মদিনার হোটেল রুম শেয়ারিং' : 'Makkah & Madinah Hotel Sharing' }}
            </h3>

            <div style="display: flex; flex-direction: column; gap: 1rem;">
                @foreach($featuredHotels as $h)
                    <div style="background: #F8FAFC; border: 1px solid var(--border-color); border-radius: 10px; padding: 1rem; display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <h4 style="font-size: 0.95rem; color: var(--primary-dark); margin-bottom: 0.25rem;">{{ $h->title }}</h4>
                            <p style="font-size: 0.8rem; color: var(--text-muted);"><i class="fa-solid fa-hotel"></i> {{ $h->makkah_hotel }} ({{ $h->makkah_hotel_distance }}m)</p>
                        </div>
                        <a href="{{ route('posts.show', $h->id) }}" class="btn-primary" style="padding: 0.4rem 0.75rem; font-size: 0.8rem;">
                            ৳{{ number_format($h->price_per_seat) }}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Section 3: OVERHAULED & HIGHLY STUNNING "WHY CHOOSE B2B PORTAL" (কেন আপনার এজেন্সি এই B2B পোর্টাল ব্যবহার করবে?) -->
    <div style="background: linear-gradient(180deg, #FFFFFF 0%, #F8FAFC 100%); border-radius: 24px; padding: 3.5rem 2.5rem; border: 1px solid rgba(212, 175, 55, 0.3); box-shadow: 0 15px 35px rgba(4, 78, 53, 0.06); margin-bottom: 4rem;">
        <div style="text-align: center; max-width: 700px; margin: 0 auto 3rem;">
            <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: #FFFDF5; border: 1px solid rgba(212, 175, 55, 0.5); padding: 0.35rem 1rem; border-radius: 30px; font-size: 0.85rem; color: #B45309; font-weight: 700; margin-bottom: 0.75rem;">
                <i class="fa-solid fa-crown text-amber-500"></i> {{ $lang == 'bn' ? 'এজেন্সি ডিল বিজনেসের মূল সুবিধাসমূহ' : 'Key Agency Advantages' }}
            </div>
            <h2 class="font-heading" style="font-size: 2.3rem; color: var(--primary-dark); font-weight: 800;">
                {{ $lang == 'bn' ? 'কেন আপনার এজেন্সি এই B2B পোর্টাল ব্যবহার করবে?' : 'Why Licensed Agencies Choose Our B2B Portal' }}
            </h2>
            <p style="color: var(--text-muted); font-size: 0.98rem; margin-top: 0.5rem;">
                {{ $lang == 'bn' ? 'বাংলাদেশ সরকারের লাইসেন্সপ্রাপ্ত ও হাব নিবন্ধিত এজেন্সি সমূহের নিরাপদ ব্যবসায়িক কোলাবরেশনের সেরা মাধ্যম।' : 'Designed specifically for licensed HAAB Agencies in Bangladesh to trade group seats & rooms.' }}
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.75rem;">
            <!-- Feature Card 1 -->
            <div style="background: white; border: 1px solid var(--border-color); border-radius: 18px; padding: 1.75rem; box-shadow: 0 4px 15px rgba(0,0,0,0.03); transition: all 0.3s ease; position: relative; overflow: hidden;" onmouseover="this.style.transform='translateY(-6px)'; this.style.borderColor='var(--accent)';" onmouseout="this.style.transform='none'; this.style.borderColor='var(--border-color)';">
                <div style="width: 56px; height: 56px; background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%); color: var(--primary); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 1.25rem; border: 1px solid #A7F3D0;">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <h3 class="font-heading" style="font-size: 1.2rem; color: var(--primary-dark); margin-bottom: 0.5rem;">
                    {{ $lang == 'bn' ? '১০০% ভেরিফাইড এজেন্সি স্পেস' : '100% Verified HAAB Space' }}
                </h3>
                <p style="font-size: 0.9rem; color: var(--text-muted); line-height: 1.6;">
                    {{ $lang == 'bn' ? 'হাব (HAAB) ও ধর্ম মন্ত্রণালয়ের ভেরিফাইড অনুমোদন ছাড়া কোনো দালাল বা সাধারণ কাস্টমার এজেন্সির মোবাইল নম্বর ও বিটুবি রেট দেখতে পারে না।' : 'Strict license checking blocks unauthorized brokers. Agency numbers & rates are strictly hidden from public.' }}
                </p>
                <span style="font-size: 0.78rem; font-weight: 700; color: var(--primary); display: inline-flex; align-items: center; gap: 0.3rem; margin-top: 1rem;">
                    <i class="fa-solid fa-circle-check"></i> {{ $lang == 'bn' ? 'হাব লাইসেন্স ভেরিফাইড' : 'HAAB Verified' }}
                </span>
            </div>

            <!-- Feature Card 2 -->
            <div style="background: white; border: 1px solid var(--border-color); border-radius: 18px; padding: 1.75rem; box-shadow: 0 4px 15px rgba(0,0,0,0.03); transition: all 0.3s ease; position: relative; overflow: hidden;" onmouseover="this.style.transform='translateY(-6px)'; this.style.borderColor='var(--accent)';" onmouseout="this.style.transform='none'; this.style.borderColor='var(--border-color)';">
                <div style="width: 56px; height: 56px; background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%); color: #B45309; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 1.25rem; border: 1px solid #FCD34D;">
                    <i class="fa-brands fa-whatsapp"></i>
                </div>
                <h3 class="font-heading" style="font-size: 1.2rem; color: var(--primary-dark); margin-bottom: 0.5rem;">
                    {{ $lang == 'bn' ? 'ইনস্ট্যান্ট হোয়াটসঅ্যাপ কানেক্ট' : 'Instant WhatsApp Connect' }}
                </h3>
                <p style="font-size: 0.9rem; color: var(--text-muted); line-height: 1.6;">
                    {{ $lang == 'bn' ? '১-ক্লিকে সরাসরি অন্য এজেন্সি মালিকের সাথে সরাসরি হোয়াটসঅ্যাপ ডায়ালগে প্যাক্স রিকোয়ারমেন্ট ও রেট আলোচনা চূড়ান্ত করুন।' : 'Click once to trigger instant WhatsApp chat templates with seller agencies for fast B2B deal closing.' }}
                </p>
                <span style="font-size: 0.78rem; font-weight: 700; color: #B45309; display: inline-flex; align-items: center; gap: 0.3rem; margin-top: 1rem;">
                    <i class="fa-solid fa-bolt"></i> {{ $lang == 'bn' ? '১-ক্লিক লিড কানেক্ট' : 'Direct Lead Dial' }}
                </span>
            </div>

            <!-- Feature Card 3 -->
            <div style="background: white; border: 1px solid var(--border-color); border-radius: 18px; padding: 1.75rem; box-shadow: 0 4px 15px rgba(0,0,0,0.03); transition: all 0.3s ease; position: relative; overflow: hidden;" onmouseover="this.style.transform='translateY(-6px)'; this.style.borderColor='var(--accent)';" onmouseout="this.style.transform='none'; this.style.borderColor='var(--border-color)';">
                <div style="width: 56px; height: 56px; background: linear-gradient(135deg, #E0F2FE 0%, #BAE6FD 100%); color: #0284C7; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 1.25rem; border: 1px solid #7DD3FC;">
                    <i class="fa-solid fa-file-pdf"></i>
                </div>
                <h3 class="font-heading" style="font-size: 1.2rem; color: var(--primary-dark); margin-bottom: 0.5rem;">
                    {{ $lang == 'bn' ? 'ব্র্যান্ডেড B2B PDF কোটেশন' : 'Branded PDF Quotations' }}
                </h3>
                <p style="font-size: 0.9rem; color: var(--text-muted); line-height: 1.6;">
                    {{ $lang == 'bn' ? 'আপনার এজেন্সির নাম ও প্যাডসহ ব্রান্ডেড B2B কোটেশন ডেক ১-ক্লিকে ডাউনলোড করে ক্লায়েন্ট বা পার্টনারদের শেয়ার করুন।' : 'Generate clean, printable PDF quotation decks with hotel walk-times and breakdown terms.' }}
                </p>
                <span style="font-size: 0.78rem; font-weight: 700; color: #0284C7; display: inline-flex; align-items: center; gap: 0.3rem; margin-top: 1rem;">
                    <i class="fa-solid fa-print"></i> {{ $lang == 'bn' ? 'প্রিন্ট রেডি কোটেশন' : 'Print Ready PDF' }}
                </span>
            </div>

            <!-- Feature Card 4 -->
            <div style="background: white; border: 1px solid var(--border-color); border-radius: 18px; padding: 1.75rem; box-shadow: 0 4px 15px rgba(0,0,0,0.03); transition: all 0.3s ease; position: relative; overflow: hidden;" onmouseover="this.style.transform='translateY(-6px)'; this.style.borderColor='var(--accent)';" onmouseout="this.style.transform='none'; this.style.borderColor='var(--border-color)';">
                <div style="width: 56px; height: 56px; background: linear-gradient(135deg, #F3E8FF 0%, #E9D5FF 100%); color: #7C3AED; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 1.25rem; border: 1px solid #C084FC;">
                    <i class="fa-solid fa-handshake-angle"></i>
                </div>
                <h3 class="font-heading" style="font-size: 1.2rem; color: var(--primary-dark); margin-bottom: 0.5rem;">
                    {{ $lang == 'bn' ? 'জিরো মিডলম্যান ও ০% কমিশন' : 'Zero Middleman & 0% Fees' }}
                </h3>
                <p style="font-size: 0.9rem; color: var(--text-muted); line-height: 1.6;">
                    {{ $lang == 'bn' ? 'কোনো দালাল বা থার্ড-পার্টি কমিশন ছাড়াই সরাসরি এজেন্সি-টু-এজেন্সি ট্রেডিং। প্ল্যাটফর্ম ব্যবহারে কোনো ফি কাটা হয় না।' : 'No middleman fees or hidden commissions. 100% free direct trading platform for agencies.' }}
                </p>
                <span style="font-size: 0.78rem; font-weight: 700; color: #7C3AED; display: inline-flex; align-items: center; gap: 0.3rem; margin-top: 1rem;">
                    <i class="fa-solid fa-gift"></i> {{ $lang == 'bn' ? '১০০% ফ্রি এক্সেস' : '100% Free SaaS' }}
                </span>
            </div>

            <!-- Feature Card 5 -->
            <div style="background: white; border: 1px solid var(--border-color); border-radius: 18px; padding: 1.75rem; box-shadow: 0 4px 15px rgba(0,0,0,0.03); transition: all 0.3s ease; position: relative; overflow: hidden;" onmouseover="this.style.transform='translateY(-6px)'; this.style.borderColor='var(--accent)';" onmouseout="this.style.transform='none'; this.style.borderColor='var(--border-color)';">
                <div style="width: 56px; height: 56px; background: linear-gradient(135deg, #FFF1F2 0%, #FFE4E6 100%); color: #E11D48; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 1.25rem; border: 1px solid #FDA4AF;">
                    <i class="fa-solid fa-person-walking-luggage"></i>
                </div>
                <h3 class="font-heading" style="font-size: 1.2rem; color: var(--primary-dark); margin-bottom: 0.5rem;">
                    {{ $lang == 'bn' ? 'হারাম দূরত্ব ভিজ্যুয়ালাইজার' : 'Haram Distance Calculator' }}
                </h3>
                <p style="font-size: 0.9rem; color: var(--text-muted); line-height: 1.6;">
                    {{ $lang == 'bn' ? 'মক্কা কাবা শরীফ ও মদিনা মসজিদে নববী থেকে হোটেলের নির্ভুল মিটার দূরত্ব এবং হাঁটার মিনিট হিসাব স্বয়ংক্রিয়ভাবে দেখায়।' : 'Automated walking time calculator in minutes from Makkah Haram and Madinah Nabawi courtyards.' }}
                </p>
                <span style="font-size: 0.78rem; font-weight: 700; color: #E11D48; display: inline-flex; align-items: center; gap: 0.3rem; margin-top: 1rem;">
                    <i class="fa-solid fa-clock"></i> {{ $lang == 'bn' ? 'হাঁটার সময় ক্যালকুলেটর' : 'Walk Calculator' }}
                </span>
            </div>

            <!-- Feature Card 6 -->
            <div style="background: white; border: 1px solid var(--border-color); border-radius: 18px; padding: 1.75rem; box-shadow: 0 4px 15px rgba(0,0,0,0.03); transition: all 0.3s ease; position: relative; overflow: hidden;" onmouseover="this.style.transform='translateY(-6px)'; this.style.borderColor='var(--accent)';" onmouseout="this.style.transform='none'; this.style.borderColor='var(--border-color)';">
                <div style="width: 56px; height: 56px; background: linear-gradient(135deg, #FEF9C3 0%, #FEF08A 100%); color: #CA8A04; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 1.25rem; border: 1px solid #FDE047;">
                    <i class="fa-solid fa-sliders"></i>
                </div>
                <h3 class="font-heading" style="font-size: 1.2rem; color: var(--primary-dark); margin-bottom: 0.5rem;">
                    {{ $lang == 'bn' ? 'বিটুবি স্পেসিফিকেশন ও কমিশন' : 'B2B Terms & Commission' }}
                </h3>
                <p style="font-size: 0.9rem; color: var(--text-muted); line-height: 1.6;">
                    {{ $lang == 'bn' ? 'যাত্রীর জেন্ডার (Male/Female), এহরাম রুট (মক্কা/মদিনা আগে), সিট কমিশন ও নাম পরিবর্তন পলিসি ফিল্টার করুন।' : 'Comprehensive B2B fields for Pax gender matching, Ahram flight route, catering, and name swap terms.' }}
                </p>
                <span style="font-size: 0.78rem; font-weight: 700; color: #CA8A04; display: inline-flex; align-items: center; gap: 0.3rem; margin-top: 1rem;">
                    <i class="fa-solid fa-tags"></i> {{ $lang == 'bn' ? 'বিটুবি কমিশন ফিল্টার' : 'B2B Commission Filter' }}
                </span>
            </div>
        </div>
    </div>

    <!-- Section 4: OVERHAULED & HIGHLY INTERACTIVE FAQ ACCORDION (সাধারণ প্রশ্ন ও উত্তর) -->
    <div style="margin-bottom: 4rem;">
        <div style="text-align: center; max-width: 650px; margin: 0 auto 2.5rem;">
            <span class="badge badge-verified" style="margin-bottom: 0.5rem;"><i class="fa-solid fa-circle-question"></i> {{ $lang == 'bn' ? 'সহজ জিজ্ঞাসা' : 'Got Questions?' }}</span>
            <h2 class="font-heading" style="font-size: 2.3rem; color: var(--primary-dark); font-weight: 800;">
                {{ $lang == 'bn' ? 'সাধারণ প্রশ্ন ও উত্তর (FAQ)' : 'Frequently Asked Questions' }}
            </h2>
            <p style="color: var(--text-muted); font-size: 0.95rem; margin-top: 0.35rem;">
                {{ $lang == 'bn' ? 'বিটুবি নেটওয়ার্ক ও এজেন্সি কার্যক্রম সংক্রান্ত সাধারণ প্রশ্নাবলীর সরাসরি উত্তর।' : 'Everything you need to know about agency verification and B2B trading.' }}
            </p>
        </div>

        <div style="max-width: 900px; margin: 0 auto; display: flex; flex-direction: column; gap: 1.1rem;">
            <!-- FAQ Item 1 -->
            <details style="background: white; border: 1px solid var(--border-color); border-radius: 16px; padding: 1.25rem 1.75rem; box-shadow: 0 4px 12px rgba(0,0,0,0.03); cursor: pointer;" open>
                <summary style="font-size: 1.1rem; font-weight: 700; color: var(--primary-dark); display: flex; justify-content: space-between; align-items: center; outline: none; list-style: none;">
                    <span style="display: flex; align-items: center; gap: 0.75rem;">
                        <span style="width: 32px; height: 32px; background: #ECFDF5; color: var(--primary); border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; font-size: 0.9rem;">🔒</span>
                        {{ $lang == 'bn' ? 'এই প্ল্যাটফর্মটি কি সাধারণ প্যাসেঞ্জার বা ক্লায়েন্টদের জন্য উন্মুক্ত?' : 'Is this platform open for general public pilgrims?' }}
                    </span>
                    <i class="fa-solid fa-chevron-down text-emerald-700 font-bold" style="transition: transform 0.3s;"></i>
                </summary>
                <div style="margin-top: 1rem; padding-top: 0.85rem; border-top: 1px dashed var(--border-color); color: var(--text-muted); font-size: 0.93rem; line-height: 1.6;">
                    <p>
                        {{ $lang == 'bn' ? 'না, এটি সম্পূর্ণভাবে শুধুমাত্র বাংলাদেশ সরকারের লাইসেন্সপ্রাপ্ত ও হাব (HAAB) নিবন্ধিত হজ ও ওমরাহ এজেন্সিগুলোর B2B শেয়ারিংয়ের জন্য। সাধারণ পাবলিক বা আন-ভেরিফাইড কোনো কাস্টমার এখানে মোবাইল নম্বর, হোয়াটসঅ্যাপ ডিরেক্ট ডায়াল বা ডিল প্রাইসিং দেখতে পারে না।' : 'No, this portal is strictly for licensed Hajj & Umrah agency owners to collaborate B2B. Phone numbers and deal pricing are locked from public visitors.' }}
                    </p>
                </div>
            </details>

            <!-- FAQ Item 2 -->
            <details style="background: white; border: 1px solid var(--border-color); border-radius: 16px; padding: 1.25rem 1.75rem; box-shadow: 0 4px 12px rgba(0,0,0,0.03); cursor: pointer;">
                <summary style="font-size: 1.1rem; font-weight: 700; color: var(--primary-dark); display: flex; justify-content: space-between; align-items: center; outline: none; list-style: none;">
                    <span style="display: flex; align-items: center; gap: 0.75rem;">
                        <span style="width: 32px; height: 32px; background: #FEF3C7; color: #B45309; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; font-size: 0.9rem;">🎁</span>
                        {{ $lang == 'bn' ? 'প্লাটফর্মে রেজিস্ট্রেশন ও ব্যবহারে কোন ফি বা সাবস্ক্রিপশন চার্জ আছে কি?' : 'Are there any hidden subscription fees for agencies?' }}
                    </span>
                    <i class="fa-solid fa-chevron-down text-amber-700 font-bold" style="transition: transform 0.3s;"></i>
                </summary>
                <div style="margin-top: 1rem; padding-top: 0.85rem; border-top: 1px dashed var(--border-color); color: var(--text-muted); font-size: 0.93rem; line-height: 1.6;">
                    <p>
                        {{ $lang == 'bn' ? 'না, এটি লাইসেন্সপ্রাপ্ত এজেন্সিগুলোর জন্য ১০০% ফ্রি এক্সেস প্ল্যাটফর্ম। এজেন্সিগুলোর ব্যবসায়িক মেলবন্ধন ও সিট ক্ষতি কমানোর সুবিধার্থে কোনো সাবস্ক্রিপশন ফি বা হিডেন চার্জ কাটা হয় না।' : 'No, our B2B SaaS platform is 100% free for verified agencies with zero hidden fees or monthly charges.' }}
                    </p>
                </div>
            </details>

            <!-- FAQ Item 3 -->
            <details style="background: white; border: 1px solid var(--border-color); border-radius: 16px; padding: 1.25rem 1.75rem; box-shadow: 0 4px 12px rgba(0,0,0,0.03); cursor: pointer;">
                <summary style="font-size: 1.1rem; font-weight: 700; color: var(--primary-dark); display: flex; justify-content: space-between; align-items: center; outline: none; list-style: none;">
                    <span style="display: flex; align-items: center; gap: 0.75rem;">
                        <span style="width: 32px; height: 32px; background: #E0F2FE; color: #0284C7; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; font-size: 0.9rem;">💬</span>
                        {{ $lang == 'bn' ? 'পোস্ট দেখার পর অন্য এজেন্সির সাথে কিভাবে দ্রুত যোগাযোগ করব?' : 'How do approved agencies instantly connect for deals?' }}
                    </span>
                    <i class="fa-solid fa-chevron-down text-blue-700 font-bold" style="transition: transform 0.3s;"></i>
                </summary>
                <div style="margin-top: 1rem; padding-top: 0.85rem; border-top: 1px dashed var(--border-color); color: var(--text-muted); font-size: 0.93rem; line-height: 1.6;">
                    <p>
                        {{ $lang == 'bn' ? 'পোস্টের ভেতরে ভেরিফাইড এজেন্সি হিসেবে প্রবেশ করলে ১-ক্লিক "Direct Call" বোতাম ও "WhatsApp Chat" ডায়ালগ আনলক হয়ে যাবে। আপনি সরাসরি কথা বলে গ্রুপের প্যাক্স ও হোটেল শেয়ার ফাইনাল করতে পারবেন।' : 'Approved agencies see unlocked phone numbers and pre-filled WhatsApp templates to immediately finalize seat allocation.' }}
                    </p>
                </div>
            </details>

            <!-- FAQ Item 4 -->
            <details style="background: white; border: 1px solid var(--border-color); border-radius: 16px; padding: 1.25rem 1.75rem; box-shadow: 0 4px 12px rgba(0,0,0,0.03); cursor: pointer;">
                <summary style="font-size: 1.1rem; font-weight: 700; color: var(--primary-dark); display: flex; justify-content: space-between; align-items: center; outline: none; list-style: none;">
                    <span style="display: flex; align-items: center; gap: 0.75rem;">
                        <span style="width: 32px; height: 32px; background: #F3E8FF; color: #7C3AED; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; font-size: 0.9rem;">📑</span>
                        {{ $lang == 'bn' ? 'কিভাবে ক্লায়েন্টের জন্য ব্র্যান্ডেড B2B PDF কোটেশন প্রিন্ট করব?' : 'How do I print a branded B2B Package Quotation?' }}
                    </span>
                    <i class="fa-solid fa-chevron-down text-purple-700 font-bold" style="transition: transform 0.3s;"></i>
                </summary>
                <div style="margin-top: 1rem; padding-top: 0.85rem; border-top: 1px dashed var(--border-color); color: var(--text-muted); font-size: 0.93rem; line-height: 1.6;">
                    <p>
                        {{ $lang == 'bn' ? 'যেকোনো পোস্টের বিস্তারিত পেজে "প্রিন্টযোগ্য B2B কোটেশন ডেক" বোতামে ক্লিক করলেই আপনার এজেন্সির লোগো ও হেডারসহ হোটেলের হাঁটার দূরত্ব, ফ্লাইটের তারিখ ও রেট ব্রেকডাউনের প্রিন্টফরম্যাট চলে আসবে।' : 'Simply click "Printable B2B Quotation Deck" inside any post to generate a clean branded PDF quotation sheet.' }}
                    </p>
                </div>
            </details>

            <!-- FAQ Item 5 -->
            <details style="background: white; border: 1px solid var(--border-color); border-radius: 16px; padding: 1.25rem 1.75rem; box-shadow: 0 4px 12px rgba(0,0,0,0.03); cursor: pointer;">
                <summary style="font-size: 1.1rem; font-weight: 700; color: var(--primary-dark); display: flex; justify-content: space-between; align-items: center; outline: none; list-style: none;">
                    <span style="display: flex; align-items: center; gap: 0.75rem;">
                        <span style="width: 32px; height: 32px; background: #FFF1F2; color: #E11D48; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; font-size: 0.9rem;">⏱️</span>
                        {{ $lang == 'bn' ? 'নতুন এজেন্সি সাইন-আপ করার পর ভেরিফিকেশনে কত সময় লাগে?' : 'How long does agency account approval take?' }}
                    </span>
                    <i class="fa-solid fa-chevron-down text-rose-700 font-bold" style="transition: transform 0.3s;"></i>
                </summary>
                <div style="margin-top: 1rem; padding-top: 0.85rem; border-top: 1px dashed var(--border-color); color: var(--text-muted); font-size: 0.93rem; line-height: 1.6;">
                    <p>
                        {{ $lang == 'bn' ? 'নতুন সাইন-আপের সময় হাব (HAAB) নম্বর, ট্রেড লাইসেন্স ও মালিকের NID প্রদান করলে সুপার এডমিন দ্রুত তথ্য ভেরিফাই করে ৩০ মিনিট থেকে সর্বোচ্চ ২ ঘণ্টার মধ্যে অ্যাকাউন্ট অ্যাপ্রুভ করেন।' : 'Super Admin verifies your HAAB license and trade license number usually within 30 minutes to 2 hours.' }}
                    </p>
                </div>
            </details>

            <!-- FAQ Item 6 -->
            <details style="background: white; border: 1px solid var(--border-color); border-radius: 16px; padding: 1.25rem 1.75rem; box-shadow: 0 4px 12px rgba(0,0,0,0.03); cursor: pointer;">
                <summary style="font-size: 1.1rem; font-weight: 700; color: var(--primary-dark); display: flex; justify-content: space-between; align-items: center; outline: none; list-style: none;">
                    <span style="display: flex; align-items: center; gap: 0.75rem;">
                        <span style="width: 32px; height: 32px; background: #FEF9C3; color: #CA8A04; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; font-size: 0.9rem;">🤝</span>
                        {{ $lang == 'bn' ? 'আর্থিক লেনদেন ও চুক্তি কিভাবে সম্পন্ন হয়?' : 'How are financial transactions handled?' }}
                    </span>
                    <i class="fa-solid fa-chevron-down text-yellow-700 font-bold" style="transition: transform 0.3s;"></i>
                </summary>
                <div style="margin-top: 1rem; padding-top: 0.85rem; border-top: 1px dashed var(--border-color); color: var(--text-muted); font-size: 0.93rem; line-height: 1.6;">
                    <p>
                        {{ $lang == 'bn' ? 'প্ল্যাটফর্মটি নিরাপদ ম্যাচমেকার (Matchmaking) হিসেবে কাজ করে। প্যাক্স বুকিং পেমেন্ট, টোকেন মানি ও চুক্তি এজেন্সিরা নিজেদের মধ্যে সরাসরি অফিশিয়াল ব্যাংক একাউন্ট বা চেকে সম্পন্ন করবেন।' : 'Agencies complete transactions directly via official bank transfer or cheques. The platform acts as a strict matchmaker.' }}
                    </p>
                </div>
            </details>
        </div>
    </div>
@endsection
