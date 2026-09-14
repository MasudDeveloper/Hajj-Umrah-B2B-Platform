@extends('layouts.app')

@section('title', $post->title . ' - B2B Deal Details')

@section('content')
    @php
        $lang = session('locale', 'bn');
    @endphp

    <div style="margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
        <a href="{{ route('posts.index') }}" style="color: var(--primary); text-decoration: none; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 0.4rem;">
            <i class="fa-solid fa-arrow-left"></i> {{ $lang == 'bn' ? 'মার্কেটপ্লেসে ফিরে যান' : 'Back to B2B Marketplace' }}
        </a>

        <a href="{{ route('posts.quotation', $post->id) }}" target="_blank" class="btn-primary" style="background: #0369A1; padding: 0.5rem 1rem; font-size: 0.85rem;">
            <i class="fa-solid fa-file-pdf"></i> {{ $lang == 'bn' ? 'প্রিন্টযোগ্য B2B কোটেশন ডেক' : 'Print Branded B2B Quotation' }}
        </a>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
        <!-- Left Main Post Details -->
        <div>
            <div style="background: white; border-radius: 16px; padding: 2rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); margin-bottom: 2rem;">
                <div style="display: flex; gap: 0.75rem; align-items: center; margin-bottom: 1rem; flex-wrap: wrap;">
                    <span class="badge badge-{{ $post->post_category === 'group_seats' ? 'seats' : ($post->post_category === 'ticket_only' ? 'ticket' : 'hotel') }}">
                        {{ strtoupper(str_replace('_', ' ', $post->post_category)) }}
                    </span>
                    <span class="badge badge-verified"><i class="fa-solid fa-circle-check"></i> {{ strtoupper($post->status) }}</span>
                    <span class="badge badge-pending"><i class="fa-solid fa-plane"></i> {{ strtoupper($post->departure_city) }} HUB</span>
                    <span style="background: #F3E8FF; color: #7C3AED; font-size: 0.75rem; font-weight: 700; padding: 0.25rem 0.6rem; border-radius: 20px;">
                        <i class="fa-solid fa-hotel me-1"></i> {{ strtoupper($post->room_type) }} ROOM
                    </span>
                </div>

                <h1 class="font-heading" style="font-size: 2rem; color: var(--primary-dark); margin-bottom: 1.25rem; line-height: 1.2;">
                    {{ $post->title }}
                </h1>

                <!-- Key Metrics Bar -->
                <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; background: #F8FAFC; padding: 1.25rem; border-radius: 12px; margin-bottom: 1.75rem; border: 1px solid var(--border-color);">
                    <div>
                        <span style="font-size: 0.78rem; color: var(--text-muted); display: block;">{{ $lang == 'bn' ? 'টাইপ' : 'Type' }}</span>
                        <strong style="font-size: 0.95rem; color: var(--primary-dark);">
                            {{ $post->requirement_type === 'need_seats' ? ($lang == 'bn' ? 'সিট প্রয়োজন' : 'Seats Needed') : ($lang == 'bn' ? 'সিট ফাঁকা' : 'Seats Available') }}
                        </strong>
                    </div>
                    <div>
                        <span style="font-size: 0.78rem; color: var(--text-muted); display: block;">{{ $lang == 'bn' ? 'সিট সংখ্যা' : 'Available Pax' }}</span>
                        <strong style="font-size: 1.15rem; color: #DC2626;"><i class="fa-solid fa-users"></i> {{ $post->available_seats }} Pax</strong>
                    </div>
                    <div>
                        <span style="font-size: 0.78rem; color: var(--text-muted); display: block;">{{ $lang == 'bn' ? 'জনপ্রতি রেট' : 'B2B Rate' }}</span>
                        <strong style="font-size: 1.25rem; color: var(--primary-dark);">৳{{ number_format($post->price_per_seat) }}</strong>
                    </div>
                    <div>
                        <span style="font-size: 0.78rem; color: var(--text-muted); display: block;">{{ $lang == 'bn' ? 'বুকিং এডভান্স' : 'Advance Deposit' }}</span>
                        <strong style="font-size: 1.1rem; color: #0284C7;">৳{{ number_format($post->advance_deposit) }}</strong>
                    </div>
                </div>

                <!-- Flight & Itinerary Schedule -->
                <h3 class="font-heading" style="font-size: 1.2rem; color: var(--primary-dark); margin-bottom: 1rem; border-bottom: 2px solid var(--accent); padding-bottom: 0.5rem; display: inline-block;">
                    <i class="fa-solid fa-plane-departure"></i> {{ $lang == 'bn' ? 'ফ্লাইট ও ভ্রমণ সমস্যানুসূচী' : 'Flight & Travel Specifications' }}
                </h3>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 2rem;">
                    <div style="background: #F1F5F9; padding: 1rem; border-radius: 10px;">
                        <span style="font-size: 0.78rem; color: var(--text-muted); display: block;">{{ $lang == 'bn' ? 'ফ্লাইটের তারিখ' : 'Departure Date' }}</span>
                        <strong style="font-size: 0.95rem; color: var(--text-dark);"><i class="fa-regular fa-calendar me-1"></i> {{ $post->flight_date->format('F d, Y (l)') }}</strong>
                    </div>
                    <div style="background: #F1F5F9; padding: 1rem; border-radius: 10px;">
                        <span style="font-size: 0.78rem; color: var(--text-muted); display: block;">{{ $lang == 'bn' ? 'রিটার্ন তারিখ' : 'Return Date' }}</span>
                        <strong style="font-size: 0.95rem; color: var(--text-dark);"><i class="fa-regular fa-calendar-check me-1"></i> {{ $post->return_date ? $post->return_date->format('F d, Y (l)') : 'N/A' }}</strong>
                    </div>
                    <div style="background: #F1F5F9; padding: 1rem; border-radius: 10px;">
                        <span style="font-size: 0.78rem; color: var(--text-muted); display: block;">{{ $lang == 'bn' ? 'এয়ারলাইন ও ট্রানজিট' : 'Airline & Transit' }}</span>
                        <strong style="font-size: 0.95rem; color: var(--primary-dark);"><i class="fa-solid fa-plane me-1"></i> {{ $post->airline }} ({{ strtoupper($post->flight_transit) }})</strong>
                    </div>
                    <div style="background: #F1F5F9; padding: 1rem; border-radius: 10px;">
                        <span style="font-size: 0.78rem; color: var(--text-muted); display: block;">{{ $lang == 'bn' ? 'নাম প্রদানের শেষ তারিখ' : 'Name Submission Deadline' }}</span>
                        <strong style="font-size: 0.95rem; color: #DC2626;"><i class="fa-solid fa-clock me-1"></i> {{ $post->name_deadline ? $post->name_deadline->format('F d, Y') : 'N/A' }}</strong>
                    </div>
                </div>

                <!-- PNR & Baggage Status -->
                <div style="background: #EFF6FF; border: 1px solid #BFDBFE; padding: 1rem; border-radius: 10px; margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <span style="font-size: 0.78rem; color: #1D4ED8; font-weight: 700;">PNR REFERENCE STATUS</span>
                        <h4 style="font-size: 1.05rem; color: #1E3A8A; margin-top: 0.15rem;"><i class="fa-solid fa-ticket me-1"></i> {{ $post->pnr_code ?? 'Group Block Reserved' }}</h4>
                    </div>
                    <div style="text-align: right;">
                        <span style="font-size: 0.78rem; color: #1D4ED8; font-weight: 700;">BAGGAGE ALLOWANCE</span>
                        <h4 style="font-size: 1rem; color: #1E3A8A; margin-top: 0.15rem;"><i class="fa-solid fa-suitcase me-1"></i> {{ $post->baggage_allowance }}</h4>
                    </div>
                </div>

                <!-- Extended B2B Specifications Grid -->
                <div style="background: #FFFDF5; border: 1px solid rgba(212, 175, 55, 0.3); padding: 1.25rem; border-radius: 12px; margin-bottom: 2rem;">
                    <h4 style="font-size: 1.05rem; color: var(--primary-dark); margin-bottom: 0.75rem; border-bottom: 1px solid var(--accent); padding-bottom: 0.35rem;">
                        <i class="fa-solid fa-sliders me-1"></i> B2B ট্রেডিং স্পেসিফিকেশন ও কমিশন শর্ত
                    </h4>
                    
                    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem;">
                        <div>
                            <span style="font-size: 0.75rem; color: var(--text-muted); display: block;">যাত্রীর জেন্ডার</span>
                            <strong style="font-size: 0.9rem; color: var(--text-dark);">
                                @if($post->allowed_gender == 'male_only') 👨 শুধু পুরুষ সিট @elseif($post->allowed_gender == 'female_only') 👩 শুধু মহিলা সিট @elseif($post->allowed_gender == 'family_only') 👨‍👩‍👧 শুধু ফ্যামিলি @else 🚻 যেকোনো জেন্ডার @endif
                            </strong>
                        </div>

                        <div>
                            <span style="font-size: 0.75rem; color: var(--text-muted); display: block;">এহরাম ও ফ্লিট রুট</span>
                            <strong style="font-size: 0.9rem; color: var(--text-dark);">
                                @if($post->route_sequence == 'madinah_first') 🕌 মদিনা আগে (MED First) @elseif($post->route_sequence == 'makkah_first') 🕋 মক্কা আগে (JED First) @else ✈️ ট্রানজিট @endif
                            </strong>
                        </div>

                        <div>
                            <span style="font-size: 0.75rem; color: var(--text-muted); display: block;">খাবার ও ক্যাটারিং</span>
                            <strong style="font-size: 0.9rem; color: var(--text-dark);">
                                @if($post->catering_type == 'bengali_catering') 🍱 বাংলা খাবার @elseif($post->catering_type == 'hotel_buffet') 🍽️ আন্তর্জাতিক বুফে @else ☕ হালকা নাস্তা / খাবার ছাড়া @endif
                            </strong>
                        </div>

                        <div>
                            <span style="font-size: 0.75rem; color: var(--text-muted); display: block;">পার্টনার সিট কমিশন</span>
                            <strong style="font-size: 0.95rem; color: #16A34A; background: #DCFCE7; padding: 0.15rem 0.4rem; border-radius: 6px;">
                                ৳{{ number_format($post->agent_commission ?? 0) }} / সিট
                            </strong>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-top: 1rem; padding-top: 0.75rem; border-top: 1px dashed var(--border-color);">
                        <div>
                            <span style="font-size: 0.75rem; color: var(--text-muted); display: block;">নাম পরিবর্তন নীতি</span>
                            <strong style="font-size: 0.85rem; color: var(--text-dark);">
                                @if($post->name_change_policy == 'free_replacement') 🔄 বিনামূল্যে নাম পরিবর্তন @elseif($post->name_change_policy == 'fee_applies') ⚠️ ফি সাপেক্ষ @else 🚫 নাম পরিবর্তন অযোগ্য @endif
                            </strong>
                        </div>

                        <div>
                            <span style="font-size: 0.75rem; color: var(--text-muted); display: block;">সৌদি ট্রান্সপোর্ট</span>
                            <strong style="font-size: 0.85rem; color: var(--text-dark);">
                                🚌 {{ strtoupper(str_replace('_', ' ', $post->transport_vehicle ?? 'AC Bus')) }}
                                @if($post->haramain_train)
                                    <span style="background: #E0F2FE; color: #0369A1; font-size: 0.72rem; padding: 0.15rem 0.35rem; border-radius: 4px; font-weight: 700; margin-left: 0.25rem;">🚆 High Speed Train Included</span>
                                @endif
                            </strong>
                        </div>

                        <div>
                            <span style="font-size: 0.75rem; color: var(--text-muted); display: block;">ভিসা টাইপ</span>
                            <strong style="font-size: 0.85rem; color: var(--text-dark);">
                                🛂 {{ strtoupper(str_replace('_', ' ', $post->visa_type ?? 'Umrah E-Visa')) }}
                            </strong>
                        </div>
                    </div>
                </div>

                <!-- Accommodation Details & Haram Walk-Time Calculation -->
                @if($post->makkah_hotel || $post->madinah_hotel)
                    <h3 class="font-heading" style="font-size: 1.2rem; color: var(--primary-dark); margin-bottom: 1rem; border-bottom: 2px solid var(--accent); padding-bottom: 0.5rem; display: inline-block;">
                        <i class="fa-solid fa-hotel"></i> {{ $lang == 'bn' ? 'হোটেল আবাসন ও কাবার দূরত্ব ভিজ্যুয়ালাইজার' : 'Accommodation & Haram Distance Visualizer' }}
                    </h3>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 2rem;">
                        @if($post->makkah_hotel)
                            <div style="border: 1px solid var(--border-color); padding: 1.25rem; border-radius: 12px; background: white;">
                                <span class="badge badge-hotel" style="margin-bottom: 0.5rem;">MAKKAH HOTEL</span>
                                <h4 style="font-size: 1.1rem; color: var(--text-dark); margin-bottom: 0.5rem;">{{ $post->makkah_hotel }}</h4>
                                <p style="color: var(--primary); font-weight: 700; font-size: 0.9rem; margin-bottom: 0.35rem;">
                                    <i class="fa-solid fa-person-walking"></i> {{ $post->makkah_hotel_distance }} Meters from Haram
                                </p>
                                <span style="font-size: 0.78rem; background: #ECFDF5; color: #047857; padding: 0.2rem 0.5rem; border-radius: 6px; font-weight: 600;">
                                    <i class="fa-solid fa-clock me-1"></i> Approx. {{ ceil($post->makkah_hotel_distance / 80) }} Mins Walk to Courtyard
                                </span>
                                @if($post->makkah_shuttle)
                                    <span style="font-size: 0.75rem; background: #FEF3C7; color: #B45309; padding: 0.2rem 0.5rem; border-radius: 6px; font-weight: 600; display: inline-block; margin-top: 0.35rem;">
                                        🚌 Free 24/7 Shuttle Bus
                                    </span>
                                @endif
                            </div>
                        @endif

                        @if($post->madinah_hotel)
                            <div style="border: 1px solid var(--border-color); padding: 1.25rem; border-radius: 12px; background: white;">
                                <span class="badge badge-ticket" style="margin-bottom: 0.5rem;">MADINAH HOTEL</span>
                                <h4 style="font-size: 1.1rem; color: var(--text-dark); margin-bottom: 0.5rem;">{{ $post->madinah_hotel }}</h4>
                                <p style="color: var(--primary); font-weight: 700; font-size: 0.9rem; margin-bottom: 0.35rem;">
                                    <i class="fa-solid fa-person-walking"></i> {{ $post->madinah_hotel_distance }} Meters from Masjid an-Nabawi
                                </p>
                                <span style="font-size: 0.78rem; background: #EFF6FF; color: #1D4ED8; padding: 0.2rem 0.5rem; border-radius: 6px; font-weight: 600;">
                                    <i class="fa-solid fa-clock me-1"></i> Approx. {{ ceil($post->madinah_hotel_distance / 80) }} Mins Walk to Haram
                                </span>
                            </div>
                        @endif
                    </div>
                @endif

                <!-- Comprehensive Service Inclusions Badges -->
                <h3 class="font-heading" style="font-size: 1.2rem; color: var(--primary-dark); margin-bottom: 1rem; border-bottom: 2px solid var(--accent); padding-bottom: 0.5rem; display: inline-block;">
                    <i class="fa-solid fa-list-check"></i> {{ $lang == 'bn' ? 'প্যাকেজের সেবা সমুহ' : 'Comprehensive Package Service Inclusions' }}
                </h3>

                <div style="display: flex; gap: 0.75rem; flex-wrap: wrap; margin-bottom: 2rem;">
                    @if($post->meals_included)
                        <span style="background: #ECFDF5; color: #047857; font-size: 0.85rem; padding: 0.4rem 0.8rem; border-radius: 8px; font-weight: 600;"><i class="fa-solid fa-utensils me-1"></i> 3 Times Buffet Meals</span>
                    @endif
                    @if($post->visa_included)
                        <span style="background: #EFF6FF; color: #1D4ED8; font-size: 0.85rem; padding: 0.4rem 0.8rem; border-radius: 8px; font-weight: 600;"><i class="fa-solid fa-passport me-1"></i> Visa Processing</span>
                    @endif
                    @if($post->transport_included)
                        <span style="background: #FEF3C7; color: #B45309; font-size: 0.85rem; padding: 0.4rem 0.8rem; border-radius: 8px; font-weight: 600;"><i class="fa-solid fa-bus me-1"></i> AC Transport Bus</span>
                    @endif
                    @if($post->ziyarah_included)
                        <span style="background: #F3E8FF; color: #7C3AED; font-size: 0.85rem; padding: 0.4rem 0.8rem; border-radius: 8px; font-weight: 600;"><i class="fa-solid fa-kaaba me-1"></i> Guided Ziyarah Tour</span>
                    @endif
                    @if($post->guide_included)
                        <span style="background: #FCE7F3; color: #9D174D; font-size: 0.85rem; padding: 0.4rem 0.8rem; border-radius: 8px; font-weight: 600;"><i class="fa-solid fa-user-tie me-1"></i> Alem / Muallem Guide</span>
                    @endif
                    @if($post->zamzam_included)
                        <span style="background: #E0F2FE; color: #0369A1; font-size: 0.85rem; padding: 0.4rem 0.8rem; border-radius: 8px; font-weight: 600;"><i class="fa-solid fa-bottle-water me-1"></i> 5 Litres Zamzam Water</span>
                    @endif
                </div>

                <!-- Description -->
                @if($post->details)
                    <h3 class="font-heading" style="font-size: 1.2rem; color: var(--primary-dark); margin-bottom: 0.75rem;">Deal Description & Terms</h3>
                    <p style="color: var(--text-dark); line-height: 1.7; font-size: 0.95rem; white-space: pre-line;">{{ $post->details }}</p>
                @endif
            </div>
        </div>

        <!-- Right Seller Agency Sidebar & Strict Privacy Lock -->
        <div>
            <div style="background: white; border-radius: 16px; padding: 1.75rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-md); position: sticky; top: 100px;">
                <span style="font-size: 0.75rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 0.75rem;">POSTING AGENCY</span>

                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.25rem;">
                    <div style="width: 50px; height: 50px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.3rem;">
                        {{ strtoupper(substr($post->agency->agency_name, 0, 1)) }}
                    </div>
                    <div>
                        <h3 class="font-heading" style="font-size: 1.15rem; color: var(--primary-dark);">{{ $post->agency->agency_name }}</h3>
                        <p style="font-size: 0.8rem; color: var(--text-muted);"><i class="fa-solid fa-certificate text-amber-500"></i> License: {{ $post->agency->license_no }}</p>
                    </div>
                </div>

                <div style="background: #F8FAFC; padding: 1rem; border-radius: 10px; font-size: 0.85rem; margin-bottom: 1.5rem; border: 1px solid var(--border-color);">
                    <p style="margin-bottom: 0.5rem;"><i class="fa-solid fa-id-card text-amber-600 me-2"></i> <strong>HAAB No:</strong> {{ $post->agency->haab_no ?? 'N/A' }}</p>
                    <p style="margin-bottom: 0.5rem;"><i class="fa-solid fa-location-dot text-red-500 me-2"></i> <strong>Address:</strong> {{ $post->agency->address }}</p>
                    <p style="margin-bottom: 0.5rem;"><i class="fa-solid fa-star text-amber-400 me-2"></i> <strong>Trust Score:</strong> {{ $post->agency->rating }} / 5.0</p>
                </div>

                <!-- Privacy Contact Lock Condition -->
                @if($isCanViewContact)
                    <!-- UNLOCKED CONTACT FOR APPROVED VERIFIED AGENCIES -->
                    <div style="background: #ECFDF5; border: 1px solid #A7F3D0; padding: 1rem; border-radius: 10px; margin-bottom: 1.25rem;">
                        <span style="font-size: 0.75rem; color: #065F46; font-weight: 700; text-transform: uppercase;"><i class="fa-solid fa-lock-open me-1"></i> VERIFIED CONTACT ACCESS</span>
                        <p style="font-size: 1.1rem; font-weight: 800; color: var(--primary-dark); margin-top: 0.25rem;">
                            <i class="fa-solid fa-phone me-1 text-emerald-600"></i> {{ $post->agency->phone }}
                        </p>
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $post->agency->whatsapp ?? $post->agency->phone) }}?text=Salam%20agency,%20interested%20in%20your%20B2B%20post:%20{{ urlencode($post->title) }}" target="_blank" class="btn-primary" style="background: #25D366; justify-content: center; font-size: 1rem; padding: 0.85rem;">
                            <i class="fa-brands fa-whatsapp"></i> Chat on WhatsApp
                        </a>

                        <form action="{{ route('posts.inquiry') }}" method="POST">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <div style="margin-bottom: 0.75rem;">
                                <label style="display: block; font-size: 0.8rem; font-weight: 600; margin-bottom: 0.25rem;">Pax / Seats You Have *</label>
                                <input type="number" name="requested_seats" required value="2" min="1" style="width: 100%; padding: 0.5rem; border: 1px solid var(--border-color); border-radius: 6px; font-size: 0.9rem;">
                            </div>
                            <div style="margin-bottom: 0.75rem;">
                                <textarea name="message" rows="2" required placeholder="Write message to agency owner..." style="width: 100%; padding: 0.5rem; border: 1px solid var(--border-color); border-radius: 6px; font-size: 0.85rem; font-family: inherit;"></textarea>
                            </div>
                            <button type="submit" class="btn-gold" style="width: 100%; justify-content: center; font-size: 0.95rem; padding: 0.75rem;">
                                <i class="fa-solid fa-paper-plane"></i> Express Interest Deal
                            </button>
                        </form>
                    </div>
                @else
                    <!-- LOCKED OVERLAY FOR GUESTS / PENDING AGENCIES -->
                    <div style="background: #FEF3C7; border: 1px solid #FDE68A; padding: 1.25rem; border-radius: 12px; text-align: center;">
                        <div style="font-size: 2rem; color: #D97706; margin-bottom: 0.5rem;">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <h4 style="font-size: 1rem; color: #92400E; margin-bottom: 0.5rem;">Agency Contact Info Locked</h4>
                        <p style="font-size: 0.82rem; color: #B45309; line-height: 1.5; margin-bottom: 1rem;">
                            To prevent fraud, phone numbers and direct WhatsApp links are restricted exclusively to <strong>Approved HAAB Verified Agencies</strong>.
                        </p>

                        @auth
                            <div style="background: white; padding: 0.6rem; border-radius: 6px; font-size: 0.8rem; color: var(--text-muted);">
                                Your account status: <strong>Pending Approval</strong>. Super Admin will verify your license shortly.
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="btn-gold" style="width: 100%; justify-content: center; font-size: 0.9rem;">
                                <i class="fa-solid fa-right-to-bracket"></i> Login / Register to Unlock
                            </a>
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
