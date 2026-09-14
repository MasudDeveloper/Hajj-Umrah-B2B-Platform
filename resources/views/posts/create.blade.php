@extends('layouts.app')

@section('title', session('locale', 'bn') == 'bn' ? 'B2B পোস্ট তৈরি করুন' : 'Post B2B Requirement / Offer')

@section('content')
    @php
        $lang = session('locale', 'bn');
    @endphp

    <div style="max-width: 860px; margin: 0 auto; background: white; border-radius: 16px; padding: 2.5rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-md);">
        <div style="margin-bottom: 2rem; border-bottom: 2px solid var(--accent); padding-bottom: 1rem;">
            <span class="badge badge-verified" style="margin-bottom: 0.5rem;"><i class="fa-solid fa-building"></i> {{ Auth::user()->agency_name }}</span>
            <h1 class="font-heading" style="font-size: 1.8rem; color: var(--primary-dark);">
                {{ $lang == 'bn' ? 'নতুন B2B ডিল / রিকোয়ারমেন্ট পোস্ট করুন' : 'Publish B2B Post Requirement / Offer' }}
            </h1>
            <p style="color: var(--text-muted); font-size: 0.95rem;">
                {{ $lang == 'bn' ? 'গ্রুপ সিট ভ্যাকেন্সি, উদ্বৃত্ত টিকিট বা হোটেল রুম শেয়ারিং করার জন্য বিস্তারিত তথ্য প্রদান করুন।' : 'Collaborate with licensed Hajj & Umrah agencies for group seat filling, ticket excess, or hotel sharing.' }}
            </p>
        </div>

        @if ($errors->any())
            <div class="alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('posts.store') }}" method="POST">
            @csrf

            <!-- Post Title -->
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-weight: 600; font-size: 0.9rem; margin-bottom: 0.35rem;">
                    {{ $lang == 'bn' ? 'পোস্টের শিরোনাম (Title) *' : 'Post Title *' }}
                </label>
                <input type="text" name="title" value="{{ old('title') }}" required placeholder="e.g. 10 Extra Seats Available in 35-Pax Premium Umrah Group" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.95rem;">
            </div>

            <!-- Grid 1: Category & Requirement Type -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">
                        {{ $lang == 'bn' ? 'মূল ক্যাটাগরি *' : 'Main Category *' }}
                    </label>
                    <select name="post_category" required style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                        <option value="group_seats">Category A: Group Seats (গ্রুপ সিট)</option>
                        <option value="ticket_only">Category B: Ticket / Visa Only (টিকিট/ভিসা)</option>
                        <option value="hotel_share">Category C: Hotel Room Sharing (হোটেল রুম শেয়ারিং)</option>
                    </select>
                </div>

                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">
                        {{ $lang == 'bn' ? 'রিকোয়ারমেন্ট টাইপ *' : 'Requirement Type *' }}
                    </label>
                    <select name="requirement_type" required style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                        <option value="have_extra_seats">Seats Available (আমার কাছে অতিরিক্ত সিট ফাঁকা আছে)</option>
                        <option value="need_seats">Seats Required (আমার গ্রুপ সিট প্রয়োজন / শর্টেজ)</option>
                        <option value="ticket_sale">Surplus Ticket Sale (টিকিট বিক্রি)</option>
                        <option value="hotel_share">Hotel Room Sharing (হোটেল শেয়ার)</option>
                    </select>
                </div>
            </div>

            <!-- Grid 2: Group Quantities & Departure Hub -->
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">
                        {{ $lang == 'bn' ? 'মোট গ্রুপের সাইজ *' : 'Total Group Block Size *' }}
                    </label>
                    <input type="number" name="total_group_size" value="35" min="1" required style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                </div>

                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">
                        {{ $lang == 'bn' ? 'প্রয়োজনীয়/ফাঁকা সিট *' : 'Available / Shortage Pax *' }}
                    </label>
                    <input type="number" name="available_seats" value="5" min="1" required style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                </div>

                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">
                        {{ $lang == 'bn' ? 'ডিপার্চার হাব (ফ্লাইট শুরু) *' : 'Departure Hub *' }}
                    </label>
                    <select name="departure_city" required style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                        <option value="Dhaka">Dhaka (ঢাকা)</option>
                        <option value="Chittagong">Chittagong (চট্টগ্রাম)</option>
                        <option value="Sylhet">Sylhet (সিলেট)</option>
                    </select>
                </div>
            </div>

            <!-- Grid 3: Flight Details & Transit -->
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">
                        {{ $lang == 'bn' ? 'ফ্লাইটের তারিখ *' : 'Flight Date *' }}
                    </label>
                    <input type="date" name="flight_date" value="{{ date('Y-m-d', strtotime('+30 days')) }}" required style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.85rem;">
                </div>

                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">
                        {{ $lang == 'bn' ? 'রিটার্ন তারিখ' : 'Return Date' }}
                    </label>
                    <input type="date" name="return_date" value="{{ date('Y-m-d', strtotime('+44 days')) }}" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.85rem;">
                </div>

                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">
                        {{ $lang == 'bn' ? 'এয়ারলাইন *' : 'Airline *' }}
                    </label>
                    <input type="text" name="airline" value="Saudia Air Lines" required placeholder="e.g. Saudia / Biman" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                </div>

                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">
                        {{ $lang == 'bn' ? 'ফ্লাইট টাইপ *' : 'Flight Transit *' }}
                    </label>
                    <select name="flight_transit" required style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.85rem;">
                        <option value="direct">Direct Flight (ডিরেক্ট ফ্লাইট)</option>
                        <option value="connecting">Connecting Flight (ট্রানজিট ফ্লাইট)</option>
                    </select>
                </div>
            </div>

            <!-- Grid 4: Package Tier, Room Type & Duration -->
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">
                        {{ $lang == 'bn' ? 'প্যাকেজের ক্যাটাগরি *' : 'Package Tier *' }}
                    </label>
                    <select name="package_tier" required style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                        <option value="standard">3-Star Standard (স্ট্যান্ডার্ড)</option>
                        <option value="vip">5-Star VIP (ভিআইপি)</option>
                        <option value="economy">Economy (ইকোনমি)</option>
                    </select>
                </div>

                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">
                        {{ $lang == 'bn' ? 'রুম ক্যাটাগরি *' : 'Room Type *' }}
                    </label>
                    <select name="room_type" required style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                        <option value="quad">Quad Room (৪ জন শেয়ারিং)</option>
                        <option value="triple">Triple Room (৩ জন শেয়ারিং)</option>
                        <option value="double">Double Room (২ জন শেয়ারিং)</option>
                    </select>
                </div>

                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">
                        {{ $lang == 'bn' ? 'স্থায়িত্ব (দিন) *' : 'Duration (Days) *' }}
                    </label>
                    <input type="number" name="duration_days" value="14" min="1" required style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                </div>
            </div>

            <!-- Hotels & Haram Distance -->
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">
                        {{ $lang == 'bn' ? 'মক্কা হোটেল ও হারাম দূরত্ব (মিটারে)' : 'Makkah Hotel & Haram Distance (Meters)' }}
                    </label>
                    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 0.5rem;">
                        <input type="text" name="makkah_hotel" placeholder="e.g. Anjum Hotel Makkah" style="padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                        <input type="number" name="makkah_hotel_distance" value="250" placeholder="Meters" style="padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                    </div>
                </div>

                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">
                        {{ $lang == 'bn' ? 'মদিনা হোটেল ও দূরত্ব (মিটারে)' : 'Madinah Hotel & Distance (Meters)' }}
                    </label>
                    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 0.5rem;">
                        <input type="text" name="madinah_hotel" placeholder="e.g. Frontel Al Harithia" style="padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                        <input type="number" name="madinah_hotel_distance" value="200" placeholder="Meters" style="padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                    </div>
                </div>
            </div>

            <!-- Pricing, Deposit, PNR & Baggage -->
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">
                        {{ $lang == 'bn' ? 'জনপ্রতি রেট (BDT) *' : 'Price per Seat (BDT) *' }}
                    </label>
                    <input type="number" name="price_per_seat" required placeholder="e.g. 165000" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                </div>

                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">
                        {{ $lang == 'bn' ? 'বুকিং এডভান্সড (টোকেন)' : 'Advance Booking Token' }}
                    </label>
                    <input type="number" name="advance_deposit" value="15000" placeholder="e.g. 15000" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                </div>

                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">
                        {{ $lang == 'bn' ? 'নাম প্রদানের শেষ তারিখ' : 'Name Submission Deadline' }}
                    </label>
                    <input type="date" name="name_deadline" value="{{ date('Y-m-d', strtotime('+15 days')) }}" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.85rem;">
                </div>

                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">
                        {{ $lang == 'bn' ? 'PNR কোড / স্ট্যাটাস' : 'PNR Status / Reference' }}
                    </label>
                    <input type="text" name="pnr_code" placeholder="e.g. SV-BG-9982" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.85rem;">
                </div>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">
                    {{ $lang == 'bn' ? 'ব্যাগেজ অ্যালফাওয়েন্স' : 'Baggage Allowance' }}
                </label>
                <input type="text" name="baggage_allowance" value="46 KG (2 PC) + 7 KG Hand Baggage" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
            </div>

            <!-- Extended B2B Trading Specifications Grid -->
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 1.5rem; background: #FFFDF5; padding: 1.25rem; border-radius: 12px; border: 1px solid rgba(212, 175, 55, 0.3);">
                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">
                        {{ $lang == 'bn' ? 'যাত্রীর জেন্ডার শর্ত' : 'Gender Requirement' }}
                    </label>
                    <select name="allowed_gender" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.85rem;">
                        <option value="any">Any Gender (যেকোনো)</option>
                        <option value="male_only">Male Only (শুধু পুরুষ সিট)</option>
                        <option value="female_only">Female Only (শুধু মহিলা সিট)</option>
                        <option value="family_only">Family Only (শুধু পরিবার)</option>
                    </select>
                </div>

                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">
                        {{ $lang == 'bn' ? 'ফ্লাইটের রুট ও এহরাম' : 'Flight Route Sequence' }}
                    </label>
                    <select name="route_sequence" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.85rem;">
                        <option value="makkah_first">Makkah First (ঢাকা -> জেদ্দা)</option>
                        <option value="madinah_first">Madinah First (ঢাকা -> মদিনা)</option>
                        <option value="transit_stopover">Transit Stopover (ট্রানজিট বিরতি)</option>
                    </select>
                </div>

                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">
                        {{ $lang == 'bn' ? 'খাবার ও ক্যাটারিং' : 'Catering / Food Style' }}
                    </label>
                    <select name="catering_type" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.85rem;">
                        <option value="bengali_catering">Bengali Catering (বাংলা খাবার)</option>
                        <option value="hotel_buffet">Hotel Buffet (আন্তর্জাতিক বুফে)</option>
                        <option value="half_board">Half Board (২ বেলা খাবার)</option>
                        <option value="no_meals">No Food (খাবার ছাড়া)</option>
                    </select>
                </div>

                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">
                        {{ $lang == 'bn' ? 'সৌদি পরিবহন' : 'Saudi Transport Vehicle' }}
                    </label>
                    <select name="transport_vehicle" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.85rem;">
                        <option value="ac_bus_standard">AC Bus Standard (স্ট্যান্ডার্ড বাস)</option>
                        <option value="vip_coaster">VIP Coaster (ভিআইপি কোস্টার)</option>
                        <option value="gmc_suv">GMC / SUV Private (জিএমসি কার)</option>
                    </select>
                </div>
            </div>

            <!-- B2B Agent Commission & Name Policy Grid -->
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">
                        {{ $lang == 'bn' ? 'পার্টনার সিট কমিশন (BDT)' : 'B2B Agent Commission' }}
                    </label>
                    <input type="number" name="agent_commission" value="2000" placeholder="e.g. 2000 BDT/Pax" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                </div>

                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">
                        {{ $lang == 'bn' ? 'নাম পরিবর্তন নীতি' : 'Name Change Policy' }}
                    </label>
                    <select name="name_change_policy" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.85rem;">
                        <option value="free_replacement">Free Swap (ফ্রি নাম পরিবর্তন)</option>
                        <option value="fee_applies">Fee Applies (ফি সাপেক্ষ)</option>
                        <option value="strictly_non_changeable">Non-Changeable (অপরিবর্তনযোগ্য)</option>
                    </select>
                </div>

                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">
                        {{ $lang == 'bn' ? 'পেমেন্ট টার্মস' : 'Payment Terms' }}
                    </label>
                    <select name="payment_terms" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.85rem;">
                        <option value="full_payment">Full Payment Before Flight</option>
                        <option value="50_advance_50_saudi">50% Deposit + 50% at Saudi</option>
                        <option value="token_booking_only">Token Booking Only</option>
                    </select>
                </div>

                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">
                        {{ $lang == 'bn' ? 'ভিসার ধরণ' : 'Visa Type' }}
                    </label>
                    <select name="visa_type" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.85rem;">
                        <option value="umrah_evisa">Umrah E-Visa (নুশুক ওমরাহ)</option>
                        <option value="saudi_tourist_1yr">1-Year Tourist Visa (মাল্টিপল)</option>
                        <option value="hajj_moafa">Hajj Pilgrim Moafa (হজ ভিসা)</option>
                    </select>
                </div>
            </div>

            <!-- Comprehensive Service Inclusions Checkboxes -->
            <div style="margin-bottom: 1.5rem; background: #F8FAFC; padding: 1.25rem; border-radius: 12px; border: 1px solid var(--border-color);">
                <label style="display: block; font-weight: 600; font-size: 0.9rem; color: var(--primary-dark); margin-bottom: 0.75rem;">
                    <i class="fa-solid fa-list-check me-1"></i> {{ $lang == 'bn' ? 'প্যাকেজে অন্তর্ভুক্ত সার্ভিস সমুহ (Service Inclusions):' : 'Package Service Inclusions:' }}
                </label>
                
                <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem;">
                    <label style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.88rem; cursor: pointer;">
                        <input type="checkbox" name="meals_included" value="1" checked> 🍽️ খাবার ক্যাটারিং
                    </label>

                    <label style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.88rem; cursor: pointer;">
                        <input type="checkbox" name="visa_included" value="1" checked> 🛂 ওমরাহ/হজ ভিসা
                    </label>

                    <label style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.88rem; cursor: pointer;">
                        <input type="checkbox" name="transport_included" value="1" checked> 🚌 AC বাস ট্রান্সপোর্ট
                    </label>

                    <label style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.88rem; cursor: pointer;">
                        <input type="checkbox" name="haramain_train" value="1" checked> 🚆 হ্যারামাইন বুলেট ট্রেন
                    </label>

                    <label style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.88rem; cursor: pointer;">
                        <input type="checkbox" name="ziyarah_included" value="1" checked> 🕌 মক্কা ও মদিনা জিয়ারা
                    </label>

                    <label style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.88rem; cursor: pointer;">
                        <input type="checkbox" name="guide_included" value="1" checked> 👳 আলেম/মুয়াল্লেম গাইড
                    </label>

                    <label style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.88rem; cursor: pointer;">
                        <input type="checkbox" name="makkah_shuttle" value="1"> 🚐 ২৪ ঘণ্টা শাটল বাস
                    </label>

                    <label style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.88rem; cursor: pointer;">
                        <input type="checkbox" name="zamzam_included" value="1" checked> 💧 ৫ লিটার জমজম পানি
                    </label>
                </div>
            </div>

            <!-- Details -->
            <div style="margin-bottom: 2rem;">
                <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.35rem;">
                    {{ $lang == 'bn' ? 'অতিরিক্ত B2B নোট ও শর্তাবলী' : 'Additional Notes / Transfer Terms' }}
                </label>
                <textarea name="details" rows="4" placeholder="Mention PNR conditions, group payment terms, or special requirements..." style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem; font-family: inherit;"></textarea>
            </div>

            <button type="submit" class="btn-gold" style="width: 100%; justify-content: center; font-size: 1.05rem; padding: 0.9rem;">
                <i class="fa-solid fa-paper-plane"></i> {{ $lang == 'bn' ? 'B2B রিকোয়ারমেন্ট প্রকাশ করুন' : 'Publish B2B Requirement / Offer' }}
            </button>
        </form>
    </div>
@endsection
