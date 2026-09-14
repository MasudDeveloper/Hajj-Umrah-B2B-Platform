@extends('layouts.app')

@section('title', 'Post Surplus Flight Tickets')

@section('content')
    <div style="max-width: 800px; margin: 0 auto; background: white; border-radius: 16px; padding: 2.5rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-md);">
        <div style="margin-bottom: 2rem; border-bottom: 2px solid var(--accent); padding-bottom: 1rem;">
            <h1 class="font-heading" style="font-size: 1.8rem; color: var(--primary-dark);">List Surplus Flight Tickets</h1>
            <p style="color: var(--text-muted); font-size: 0.95rem;">Sell your unused or excess group flight tickets to other licensed travel agencies.</p>
        </div>

        <form action="{{ route('tickets.store') }}" method="POST">
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
                <label style="display: block; font-weight: 600; font-size: 0.9rem; margin-bottom: 0.4rem;">Ticket Offer Title *</label>
                <input type="text" name="title" required placeholder="e.g. 2 Excess Group Flight Tickets - Saudia DAC to JED" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.95rem;">
            </div>

            <!-- Grid 1: Airline & Route -->
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.4rem;">Airline Partner *</label>
                    <input type="text" name="airline_name" required placeholder="e.g. Saudia / Biman Bangladesh" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                </div>

                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.4rem;">Origin Airport *</label>
                    <input type="text" name="route_from" required value="DAC (Dhaka)" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                </div>

                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.4rem;">Destination Airport *</label>
                    <input type="text" name="route_to" required value="JED (Jeddah)" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                </div>
            </div>

            <!-- Grid 2: Flight Type & Dates -->
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.4rem;">Flight Type *</label>
                    <select name="flight_type" required style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                        <option value="return">Return Flight</option>
                        <option value="one_way">One-Way Flight</option>
                    </select>
                </div>

                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.4rem;">Departure Date *</label>
                    <input type="date" name="flight_date" required value="{{ date('Y-m-d', strtotime('+20 days')) }}" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                </div>

                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.4rem;">Return Date (Optional)</label>
                    <input type="date" name="return_date" value="{{ date('Y-m-d', strtotime('+34 days')) }}" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                </div>
            </div>

            <!-- Grid 3: Ticket Quantities & Price -->
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.4rem;">Total Purchased Block *</label>
                    <input type="number" name="total_tickets" required value="20" min="1" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                </div>

                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.4rem;">Available Excess Tickets *</label>
                    <input type="number" name="available_tickets" required value="2" min="1" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                </div>

                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.4rem;">Price per Ticket (BDT) *</label>
                    <input type="number" name="price_per_ticket" required placeholder="e.g. 70000" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                </div>
            </div>

            <!-- PNR & Baggage -->
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.4rem;">PNR / Quota Status *</label>
                    <input type="text" name="pnr_status" required value="GDS Group PNR Issued" placeholder="e.g. GDS Group PNR Issued / Confirmed Ticket" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                </div>

                <div>
                    <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.4rem;">Baggage Allowance *</label>
                    <input type="text" name="baggage_allowance" required value="46 KG (2 PC) + 7 KG Hand" placeholder="e.g. 46 KG + 7 KG Hand" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                </div>
            </div>

            <!-- Description -->
            <div style="margin-bottom: 2rem;">
                <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.4rem;">Additional Notes / Transfer Terms</label>
                <textarea name="description" rows="4" placeholder="Mention PNR name change deadlines, refund policy, or payment terms..." style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem; font-family: inherit;"></textarea>
            </div>

            <button type="submit" class="btn-gold" style="width: 100%; justify-content: center; font-size: 1.05rem; padding: 0.9rem;">
                <i class="fa-solid fa-paper-plane"></i> Publish Surplus Ticket Listing
            </button>
        </form>
    </div>
@endsection
