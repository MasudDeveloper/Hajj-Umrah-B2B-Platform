@extends('layouts.app')

@section('title', $listing->title . ' - Group Pax Vacancy Details')

@section('content')
    <div style="margin-bottom: 1.5rem;">
        <a href="{{ route('pax_share.index') }}" style="color: var(--primary); text-decoration: none; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 0.4rem;">
            <i class="fa-solid fa-arrow-left"></i> Back to Group Vacancies Marketplace
        </a>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
        <!-- Left Main Details Column -->
        <div>
            <div style="background: white; border-radius: 16px; padding: 2rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); margin-bottom: 2rem;">
                <div style="display: flex; gap: 0.75rem; align-items: center; margin-bottom: 1rem;">
                    <span class="badge badge-{{ $listing->package_type }}">
                        <i class="fa-solid fa-kaaba"></i> {{ strtoupper(str_replace('_', ' ', $listing->package_type)) }}
                    </span>
                    <span class="badge badge-active"><i class="fa-solid fa-circle-check"></i> {{ strtoupper($listing->status) }}</span>
                </div>

                <h1 class="font-heading" style="font-size: 2rem; color: var(--primary-dark); margin-bottom: 1.25rem; line-height: 1.2;">
                    {{ $listing->title }}
                </h1>

                <!-- Key Metrics Grid -->
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; background: #F8FAFC; padding: 1.25rem; border-radius: 12px; margin-bottom: 1.75rem; border: 1px solid var(--border-color);">
                    <div>
                        <span style="font-size: 0.8rem; color: var(--text-muted); display: block;">Total Group Size</span>
                        <strong style="font-size: 1.2rem; color: var(--text-dark);"><i class="fa-solid fa-users text-blue-600"></i> {{ $listing->total_group_size }} Pax</strong>
                    </div>
                    <div>
                        <span style="font-size: 0.8rem; color: var(--text-muted); display: block;">Seats Needed/Shortage</span>
                        <strong style="font-size: 1.2rem; color: #DC2626;"><i class="fa-solid fa-user-plus"></i> {{ $listing->vacant_seats }} Pax Vacant</strong>
                    </div>
                    <div>
                        <span style="font-size: 0.8rem; color: var(--text-muted); display: block;">B2B Price per Pax</span>
                        <strong style="font-size: 1.3rem; color: var(--primary-dark);">৳{{ number_format($listing->price_per_pax) }}</strong>
                    </div>
                </div>

                <!-- Package Flight & Schedule -->
                <h3 class="font-heading" style="font-size: 1.2rem; color: var(--primary-dark); margin-bottom: 1rem; border-bottom: 2px solid var(--accent); padding-bottom: 0.5rem; display: inline-block;">
                    <i class="fa-solid fa-plane-departure"></i> Flight & Travel Schedule
                </h3>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 2rem;">
                    <div style="background: #F1F5F9; padding: 1rem; border-radius: 10px;">
                        <span style="font-size: 0.8rem; color: var(--text-muted); display: block;">Departure Flight Date</span>
                        <strong style="font-size: 1rem; color: var(--text-dark);"><i class="fa-regular fa-calendar me-1"></i> {{ $listing->departure_date->format('F d, Y (l)') }}</strong>
                    </div>
                    <div style="background: #F1F5F9; padding: 1rem; border-radius: 10px;">
                        <span style="font-size: 0.8rem; color: var(--text-muted); display: block;">Return Flight Date</span>
                        <strong style="font-size: 1rem; color: var(--text-dark);"><i class="fa-regular fa-calendar-check me-1"></i> {{ $listing->return_date->format('F d, Y (l)') }}</strong>
                    </div>
                    <div style="background: #F1F5F9; padding: 1rem; border-radius: 10px; grid-column: 1 / -1;">
                        <span style="font-size: 0.8rem; color: var(--text-muted); display: block;">Airline Partner</span>
                        <strong style="font-size: 1.05rem; color: var(--primary-dark);"><i class="fa-solid fa-plane me-1"></i> {{ $listing->airline_name }}</strong>
                    </div>
                </div>

                <!-- Hotel & Distance to Haram Info -->
                <h3 class="font-heading" style="font-size: 1.2rem; color: var(--primary-dark); margin-bottom: 1rem; border-bottom: 2px solid var(--accent); padding-bottom: 0.5rem; display: inline-block;">
                    <i class="fa-solid fa-hotel"></i> Accommodation & Distance to Haram
                </h3>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 2rem;">
                    <div style="border: 1px solid var(--border-color); padding: 1.25rem; border-radius: 12px; background: white;">
                        <span class="badge badge-hajj" style="margin-bottom: 0.5rem;">MAKKAH</span>
                        <h4 style="font-size: 1.1rem; color: var(--text-dark); margin-bottom: 0.5rem;">{{ $listing->makkah_hotel }}</h4>
                        <p style="color: var(--primary); font-weight: 600; font-size: 0.9rem;"><i class="fa-solid fa-person-walking"></i> {{ $listing->distance_makkah_m }} Meters from Haram</p>
                    </div>

                    <div style="border: 1px solid var(--border-color); padding: 1.25rem; border-radius: 12px; background: white;">
                        <span class="badge badge-umrah" style="margin-bottom: 0.5rem;">MADINAH</span>
                        <h4 style="font-size: 1.1rem; color: var(--text-dark); margin-bottom: 0.5rem;">{{ $listing->madinah_hotel }}</h4>
                        <p style="color: var(--primary); font-weight: 600; font-size: 0.9rem;"><i class="fa-solid fa-person-walking"></i> {{ $listing->distance_madinah_m }} Meters from Masjid an-Nabawi</p>
                    </div>
                </div>

                <!-- Package Inclusions -->
                <h3 class="font-heading" style="font-size: 1.2rem; color: var(--primary-dark); margin-bottom: 1rem; border-bottom: 2px solid var(--accent); padding-bottom: 0.5rem; display: inline-block;">
                    <i class="fa-solid fa-circle-check"></i> Package Services Included
                </h3>

                <div style="display: flex; gap: 1rem; flex-wrap: wrap; margin-bottom: 2rem;">
                    <div style="display: flex; align-items: center; gap: 0.5rem; background: {{ $listing->meals_included ? '#ECFDF5' : '#F1F5F9' }}; padding: 0.75rem 1.25rem; border-radius: 10px; font-weight: 600; color: {{ $listing->meals_included ? '#047857' : '#64748B' }};">
                        <i class="fa-solid {{ $listing->meals_included ? 'fa-check-circle' : 'fa-times-circle' }}"></i> 3 Times Buffet Meals
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.5rem; background: {{ $listing->visa_included ? '#EFF6FF' : '#F1F5F9' }}; padding: 0.75rem 1.25rem; border-radius: 10px; font-weight: 600; color: {{ $listing->visa_included ? '#1D4ED8' : '#64748B' }};">
                        <i class="fa-solid {{ $listing->visa_included ? 'fa-check-circle' : 'fa-times-circle' }}"></i> Umrah / Hajj Visa Processing
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.5rem; background: {{ $listing->transport_included ? '#FEF3C7' : '#F1F5F9' }}; padding: 0.75rem 1.25rem; border-radius: 10px; font-weight: 600; color: {{ $listing->transport_included ? '#B45309' : '#64748B' }};">
                        <i class="fa-solid {{ $listing->transport_included ? 'fa-check-circle' : 'fa-times-circle' }}"></i> AC Transport Bus (JED-MAK-MED)
                    </div>
                </div>

                <!-- Description -->
                @if($listing->description)
                    <h3 class="font-heading" style="font-size: 1.2rem; color: var(--primary-dark); margin-bottom: 0.75rem;">Agency Description & Notes</h3>
                    <p style="color: var(--text-dark); line-height: 1.7; font-size: 0.95rem; white-space: pre-line;">{{ $listing->description }}</p>
                @endif
            </div>
        </div>

        <!-- Right Seller Agency Sidebar Card -->
        <div>
            <div style="background: white; border-radius: 16px; padding: 1.75rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-md); position: sticky; top: 100px;">
                <span style="font-size: 0.75rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 0.75rem;">POSTED BY AGENCY</span>

                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.25rem;">
                    <div style="width: 50px; height: 50px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.3rem;">
                        {{ strtoupper(substr($listing->agency->name, 0, 1)) }}
                    </div>
                    <div>
                        <h3 class="font-heading" style="font-size: 1.15rem; color: var(--primary-dark);">{{ $listing->agency->name }}</h3>
                        <p style="font-size: 0.8rem; color: var(--text-muted);"><i class="fa-solid fa-shield-check text-emerald-600"></i> {{ $listing->agency->company_name }}</p>
                    </div>
                </div>

                <div style="background: #F8FAFC; padding: 1rem; border-radius: 10px; font-size: 0.85rem; margin-bottom: 1.5rem; border: 1px solid var(--border-color);">
                    <p style="margin-bottom: 0.5rem;"><i class="fa-solid fa-id-card text-amber-600 me-2"></i> <strong>Govt License:</strong> {{ $listing->agency->license_number }}</p>
                    <p style="margin-bottom: 0.5rem;"><i class="fa-solid fa-location-dot text-red-500 me-2"></i> <strong>Location:</strong> {{ $listing->agency->city }}, {{ $listing->agency->country }}</p>
                    <p style="margin-bottom: 0.5rem;"><i class="fa-solid fa-star text-amber-400 me-2"></i> <strong>Agency Rating:</strong> {{ $listing->agency->rating }} / 5.0</p>
                    <p><i class="fa-solid fa-phone text-blue-600 me-2"></i> <strong>Phone:</strong> {{ $listing->agency->phone }}</p>
                </div>

                <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                    <button onclick="openInquiryModal('pax_share', {{ $listing->id }}, '{{ addslashes($listing->title) }}')" class="btn-gold" style="width: 100%; justify-content: center; font-size: 1rem; padding: 0.85rem;">
                        <i class="fa-solid fa-paper-plane"></i> Send B2B Deal Inquiry
                    </button>

                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $listing->agency->whatsapp ?? $listing->agency->phone) }}?text=Salam%20agency,%20interested%20in%20your%20pax%20shortage:%20{{ urlencode($listing->title) }}" target="_blank" class="btn-primary" style="background: #25D366; justify-content: center; font-size: 1rem; padding: 0.85rem;">
                        <i class="fa-brands fa-whatsapp"></i> Chat on WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
