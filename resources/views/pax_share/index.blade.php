@extends('layouts.app')

@section('title', 'Group Pax Shortages & Vacancies Marketplace')

@section('content')
    <div style="background: white; padding: 2rem; border-radius: 16px; margin-bottom: 2rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
            <div>
                <h1 class="font-heading" style="font-size: 2rem; color: var(--primary-dark); margin-bottom: 0.25rem;">Group Pax Vacancies & Shortages</h1>
                <p style="color: var(--text-muted); font-size: 0.95rem;">Find partner agencies with available pax seats in confirmed Hajj & Umrah groups.</p>
            </div>

            <a href="{{ route('pax_share.create') }}" class="btn-gold">
                <i class="fa-solid fa-plus-circle"></i> Post Group Shortage
            </a>
        </div>

        <!-- Filter Bar -->
        <form action="{{ route('pax_share.index') }}" method="GET" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)) 120px; gap: 1rem; background: #F8FAFC; padding: 1.25rem; border-radius: 12px; border: 1px solid var(--border-color);">
            <div>
                <label style="display: block; font-size: 0.8rem; font-weight: 600; color: var(--text-muted); margin-bottom: 0.35rem;">Search Title/Hotel</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="e.g. Anjum / Saudia..." style="width: 100%; padding: 0.6rem 0.8rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
            </div>

            <div>
                <label style="display: block; font-size: 0.8rem; font-weight: 600; color: var(--text-muted); margin-bottom: 0.35rem;">Package Type</label>
                <select name="package_type" style="width: 100%; padding: 0.6rem 0.8rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                    <option value="">All Package Types</option>
                    <option value="umrah" {{ request('package_type') == 'umrah' ? 'selected' : '' }}>Umrah Standard</option>
                    <option value="ramadan_umrah" {{ request('package_type') == 'ramadan_umrah' ? 'selected' : '' }}>Ramadan Umrah</option>
                    <option value="hajj" {{ request('package_type') == 'hajj' ? 'selected' : '' }}>Hajj Group</option>
                </select>
            </div>

            <div>
                <label style="display: block; font-size: 0.8rem; font-weight: 600; color: var(--text-muted); margin-bottom: 0.35rem;">Min Vacant Seats</label>
                <input type="number" name="min_vacant" value="{{ request('min_vacant') }}" placeholder="e.g. 2" min="1" style="width: 100%; padding: 0.6rem 0.8rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
            </div>

            <div>
                <label style="display: block; font-size: 0.8rem; font-weight: 600; color: var(--text-muted); margin-bottom: 0.35rem;">Max Price (BDT)</label>
                <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="e.g. 200000" style="width: 100%; padding: 0.6rem 0.8rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
            </div>

            <div style="display: flex; align-items: flex-end;">
                <button type="submit" class="btn-primary" style="width: 100%; justify-content: center; padding: 0.65rem;">
                    <i class="fa-solid fa-filter"></i> Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Grid List -->
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(360px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
        @forelse($listings as $listing)
            <div class="card" style="display: flex; flex-direction: column;">
                <div style="padding: 1.25rem; background: #F8FAFC; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center;">
                    <span class="badge badge-{{ $listing->package_type }}">
                        <i class="fa-solid fa-kaaba"></i> {{ strtoupper(str_replace('_', ' ', $listing->package_type)) }}
                    </span>
                    <div style="background: #FEF2F2; color: #991B1B; font-weight: 700; font-size: 0.85rem; padding: 0.25rem 0.65rem; border-radius: 12px; border: 1px solid #FCA5A5;">
                        <i class="fa-solid fa-user-plus"></i> {{ $listing->vacant_seats }} / {{ $listing->total_group_size }} Seats Short
                    </div>
                </div>

                <div style="padding: 1.5rem; flex: 1; display: flex; flex-direction: column; justify-content: space-between;">
                    <div>
                        <h3 class="font-heading" style="font-size: 1.15rem; color: var(--text-dark); margin-bottom: 0.75rem; line-height: 1.3;">
                            <a href="{{ route('pax_share.show', $listing->id) }}" style="color: inherit; text-decoration: none;">
                                {{ $listing->title }}
                            </a>
                        </h3>

                        <!-- Agency Info -->
                        <div style="display: flex; align-items: center; gap: 0.65rem; margin-bottom: 1.25rem; background: #F1F5F9; padding: 0.5rem 0.75rem; border-radius: 8px;">
                            <div style="width: 32px; height: 32px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.85rem;">
                                {{ strtoupper(substr($listing->agency->name, 0, 1)) }}
                            </div>
                            <div style="overflow: hidden;">
                                <h4 style="font-size: 0.85rem; color: var(--primary-dark); font-weight: 700;">{{ $listing->agency->name }}</h4>
                                <span style="font-size: 0.75rem; color: var(--text-muted);"><i class="fa-solid fa-location-dot"></i> {{ $listing->agency->city }}</span>
                            </div>
                        </div>

                        <!-- Highlights -->
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; font-size: 0.85rem; color: var(--text-dark); margin-bottom: 1.25rem;">
                            <div>
                                <span style="color: var(--text-muted); display: block; font-size: 0.75rem;">Fly Date</span>
                                <strong><i class="fa-regular fa-calendar me-1"></i> {{ $listing->departure_date->format('d M, Y') }}</strong>
                            </div>
                            <div>
                                <span style="color: var(--text-muted); display: block; font-size: 0.75rem;">Airline</span>
                                <strong><i class="fa-solid fa-plane me-1"></i> {{ $listing->airline_name }}</strong>
                            </div>
                            <div>
                                <span style="color: var(--text-muted); display: block; font-size: 0.75rem;">Makkah Hotel</span>
                                <strong><i class="fa-solid fa-hotel me-1"></i> {{ $listing->makkah_hotel }}</strong>
                            </div>
                            <div>
                                <span style="color: var(--text-muted); display: block; font-size: 0.75rem;">Distance</span>
                                <strong><i class="fa-solid fa-person-walking me-1"></i> {{ $listing->distance_makkah_m }}m to Haram</strong>
                            </div>
                        </div>

                        <!-- Inclusions Chips -->
                        <div style="display: flex; gap: 0.4rem; flex-wrap: wrap; margin-bottom: 1.25rem;">
                            @if($listing->meals_included)
                                <span style="background: #ECFDF5; color: #047857; font-size: 0.72rem; padding: 0.2rem 0.5rem; border-radius: 4px; font-weight: 600;"><i class="fa-solid fa-utensils"></i> Meals</span>
                            @endif
                            @if($listing->visa_included)
                                <span style="background: #EFF6FF; color: #1D4ED8; font-size: 0.72rem; padding: 0.2rem 0.5rem; border-radius: 4px; font-weight: 600;"><i class="fa-solid fa-passport"></i> Visa</span>
                            @endif
                            @if($listing->transport_included)
                                <span style="background: #FEF3C7; color: #B45309; font-size: 0.72rem; padding: 0.2rem 0.5rem; border-radius: 4px; font-weight: 600;"><i class="fa-solid fa-bus"></i> Transport</span>
                            @endif
                        </div>
                    </div>

                    <!-- Price & Action -->
                    <div style="border-top: 1px dashed var(--border-color); padding-top: 1rem; display: flex; align-items: center; justify-content: space-between;">
                        <div>
                            <span style="font-size: 0.75rem; color: var(--text-muted); display: block;">Price per Pax</span>
                            <span style="font-size: 1.3rem; font-weight: 800; color: var(--primary-dark);">৳{{ number_format($listing->price_per_pax) }}</span>
                        </div>

                        <div style="display: flex; gap: 0.5rem;">
                            <a href="{{ route('pax_share.show', $listing->id) }}" class="btn-primary" style="padding: 0.5rem 0.85rem; font-size: 0.85rem;">
                                Details
                            </a>
                            <button onclick="openInquiryModal('pax_share', {{ $listing->id }}, '{{ addslashes($listing->title) }}')" class="btn-gold" style="padding: 0.5rem 0.85rem; font-size: 0.85rem;">
                                Inquire
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 4rem 2rem; background: white; border-radius: 12px;">
                <i class="fa-solid fa-folder-open" style="font-size: 3rem; color: var(--text-muted); margin-bottom: 1rem;"></i>
                <h3 style="color: var(--text-dark); margin-bottom: 0.5rem;">No Group Shortage Listings Found</h3>
                <p style="color: var(--text-muted);">Try adjusting your search filters or post a new requirement.</p>
            </div>
        @endforelse
    </div>

    <div>
        {{ $listings->links() }}
    </div>
@endsection
