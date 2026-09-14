@extends('layouts.app')

@section('title', 'Post Group Pax Shortage Listing')

@section('content')
    <div style="max-width: 800px; margin: 0 auto; background: white; border-radius: 16px; padding: 2.5rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-md);">
        <div style="margin-bottom: 2rem; border-bottom: 2px solid var(--accent); padding-bottom: 1rem;">
            <h1 class="font-heading" style="font-size: 1.8rem; color: var(--primary-dark);">Post Group Vacancy / Pax Shortage</h1>
            <p style="color: var(--text-muted); font-size: 0.95rem;">Fill your remaining group quota by collaborating with licensed partner agencies.</p>
        </div>

        <form action="{{ route('pax_share.store') }}" method="POST">
            @csrf

            <!-- Posting Agency Selection -->
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-weight: 600; font-size: 0.9rem; margin-bottom: 0.4rem;">Select Your Agency *</label>
                <select name="agency_id" required style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.95rem;">
                    @foreach($agencies as $agency)
                        <option value="{{ $agency->id }}">{{ $agency->name }} (License: {{ $agency->license_number }})</option>
                    @endforeach
                </select>
            </div>

            <!-- Title -->
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-weight: 600; font-size: 0.9rem; margin-bottom: 0.4rem;">Listing Title *</label>
                <input type="text" name="title" required placeholder="e.g. 5 Pax Shortage in 35-Pax Premium Umrah Group" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.95rem;">
            </div>

            <!-- Grid 1: Package Type & Group Counts -->
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.4rem;">Package Type *</label>
                    <select name="package_type" required style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                        <option value="umrah">Umrah Standard</option>
                        <option value="ramadan_umrah">Ramadan Umrah</option>
                        <option value="hajj">Hajj Group</option>
                    </select>
                </div>

                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.4rem;">Total Group Size *</label>
                    <input type="number" name="total_group_size" required value="35" min="1" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                </div>

                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.4rem;">Vacant Seats / Shortage *</label>
                    <input type="number" name="vacant_seats" required value="5" min="1" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                </div>
            </div>

            <!-- Grid 2: Flight & Pricing -->
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.4rem;">Departure Flight Date *</label>
                    <input type="date" name="departure_date" required value="{{ date('Y-m-d', strtotime('+30 days')) }}" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                </div>

                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.4rem;">Return Flight Date *</label>
                    <input type="date" name="return_date" required value="{{ date('Y-m-d', strtotime('+44 days')) }}" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                </div>

                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.4rem;">Price per Pax (BDT) *</label>
                    <input type="number" name="price_per_pax" required placeholder="e.g. 150000" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                </div>
            </div>

            <!-- Grid 3: Airline & Hotel Info -->
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.4rem;">Airline Partner *</label>
                    <input type="text" name="airline_name" required placeholder="e.g. Saudia / Biman Bangladesh" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                </div>

                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.4rem;">Makkah Hotel & Distance (Meters)</label>
                    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 0.5rem;">
                        <input type="text" name="makkah_hotel" placeholder="e.g. Anjum Hotel" style="padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                        <input type="number" name="distance_makkah_m" placeholder="Meters" value="300" style="padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                    </div>
                </div>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.4rem;">Madinah Hotel & Distance (Meters)</label>
                <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 0.5rem;">
                    <input type="text" name="madinah_hotel" placeholder="e.g. Frontel Al Harithia" style="padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                    <input type="number" name="distance_madinah_m" placeholder="Meters" value="200" style="padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                </div>
            </div>

            <!-- Inclusions Checkboxes -->
            <div style="margin-bottom: 1.5rem; background: #F8FAFC; padding: 1rem; border-radius: 10px;">
                <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.75rem;">Package Service Inclusions</label>
                <div style="display: flex; gap: 1.5rem;">
                    <label style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem; cursor: pointer;">
                        <input type="checkbox" name="meals_included" value="1" checked> 3 Times Buffet Meals
                    </label>
                    <label style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem; cursor: pointer;">
                        <input type="checkbox" name="visa_included" value="1" checked> Visa Processing Included
                    </label>
                    <label style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem; cursor: pointer;">
                        <input type="checkbox" name="transport_included" value="1" checked> AC Bus Transport
                    </label>
                </div>
            </div>

            <!-- Description -->
            <div style="margin-bottom: 2rem;">
                <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.4rem;">Additional B2B Details / Terms</label>
                <textarea name="description" rows="4" placeholder="Mention any special conditions, visa requirements, or payment terms..." style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem; font-family: inherit;"></textarea>
            </div>

            <button type="submit" class="btn-gold" style="width: 100%; justify-content: center; font-size: 1.05rem; padding: 0.9rem;">
                <i class="fa-solid fa-paper-plane"></i> Publish Group Shortage Listing
            </button>
        </form>
    </div>
@endsection
