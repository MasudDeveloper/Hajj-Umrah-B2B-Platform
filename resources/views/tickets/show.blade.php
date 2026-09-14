@extends('layouts.app')

@section('title', $ticket->title . ' - Flight Ticket Details')

@section('content')
    <div style="margin-bottom: 1.5rem;">
        <a href="{{ route('tickets.index') }}" style="color: var(--primary); text-decoration: none; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 0.4rem;">
            <i class="fa-solid fa-arrow-left"></i> Back to Flight Ticket Exchange
        </a>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
        <!-- Left Ticket Column -->
        <div>
            <div style="background: white; border-radius: 16px; padding: 2rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); margin-bottom: 2rem;">
                <div style="display: flex; gap: 0.75rem; align-items: center; margin-bottom: 1rem;">
                    <span class="badge badge-ticket">
                        <i class="fa-solid fa-plane"></i> {{ strtoupper($ticket->flight_type) }} FLIGHT
                    </span>
                    <span class="badge badge-active"><i class="fa-solid fa-circle-check"></i> {{ strtoupper($ticket->status) }}</span>
                </div>

                <h1 class="font-heading" style="font-size: 2rem; color: var(--primary-dark); margin-bottom: 1.25rem; line-height: 1.2;">
                    {{ $ticket->title }}
                </h1>

                <!-- Flight Route Visual Card -->
                <div style="background: linear-gradient(135deg, var(--primary-dark), var(--primary)); color: white; padding: 1.75rem; border-radius: 14px; margin-bottom: 1.75rem; border: 1px solid var(--accent);">
                    <div style="display: flex; justify-content: space-between; align-items: center; text-align: center;">
                        <div>
                            <span style="font-size: 0.85rem; color: var(--accent-light); display: block;">DEPARTURE</span>
                            <h2 class="font-heading" style="font-size: 2rem; font-weight: 800; color: white;">{{ $ticket->route_from }}</h2>
                        </div>

                        <div style="display: flex; flex-direction: column; align-items: center; gap: 0.25rem;">
                            <span style="font-size: 0.8rem; background: rgba(255,255,255,0.2); padding: 0.2rem 0.6rem; border-radius: 10px;">{{ strtoupper($ticket->flight_type) }}</span>
                            <div style="font-size: 1.8rem; color: var(--accent);">
                                <i class="fa-solid fa-plane"></i>
                            </div>
                            <span style="font-size: 0.75rem; color: #CBD5E1;">Direct Group Quota</span>
                        </div>

                        <div>
                            <span style="font-size: 0.85rem; color: var(--accent-light); display: block;">DESTINATION</span>
                            <h2 class="font-heading" style="font-size: 2rem; font-weight: 800; color: white;">{{ $ticket->route_to }}</h2>
                        </div>
                    </div>
                </div>

                <!-- Metrics Grid -->
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; background: #F8FAFC; padding: 1.25rem; border-radius: 12px; margin-bottom: 1.75rem; border: 1px solid var(--border-color);">
                    <div>
                        <span style="font-size: 0.8rem; color: var(--text-muted); display: block;">Seats Available</span>
                        <strong style="font-size: 1.2rem; color: #0284C7;"><i class="fa-solid fa-chair"></i> {{ $ticket->available_tickets }} Left</strong>
                    </div>
                    <div>
                        <span style="font-size: 0.8rem; color: var(--text-muted); display: block;">PNR Status</span>
                        <strong style="font-size: 1.05rem; color: var(--text-dark);"><i class="fa-solid fa-file-invoice"></i> {{ $ticket->pnr_status }}</strong>
                    </div>
                    <div>
                        <span style="font-size: 0.8rem; color: var(--text-muted); display: block;">Ticket Price</span>
                        <strong style="font-size: 1.3rem; color: var(--primary-dark);">৳{{ number_format($ticket->price_per_ticket) }}</strong>
                    </div>
                </div>

                <!-- Flight Timings & Baggage -->
                <h3 class="font-heading" style="font-size: 1.2rem; color: var(--primary-dark); margin-bottom: 1rem; border-bottom: 2px solid var(--accent); padding-bottom: 0.5rem; display: inline-block;">
                    <i class="fa-solid fa-circle-info"></i> Ticket & Airline Specifications
                </h3>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 2rem;">
                    <div style="background: #F1F5F9; padding: 1rem; border-radius: 10px;">
                        <span style="font-size: 0.8rem; color: var(--text-muted); display: block;">Airline Carrier</span>
                        <strong style="font-size: 1rem; color: var(--text-dark);"><i class="fa-solid fa-plane-departure me-1"></i> {{ $ticket->airline_name }}</strong>
                    </div>
                    <div style="background: #F1F5F9; padding: 1rem; border-radius: 10px;">
                        <span style="font-size: 0.8rem; color: var(--text-muted); display: block;">Baggage Allowance</span>
                        <strong style="font-size: 1rem; color: var(--text-dark);"><i class="fa-solid fa-suitcase me-1"></i> {{ $ticket->baggage_allowance }}</strong>
                    </div>
                    <div style="background: #F1F5F9; padding: 1rem; border-radius: 10px;">
                        <span style="font-size: 0.8rem; color: var(--text-muted); display: block;">Flight Departure Date</span>
                        <strong style="font-size: 1rem; color: var(--text-dark);"><i class="fa-regular fa-calendar me-1"></i> {{ $ticket->flight_date->format('F d, Y (l)') }}</strong>
                    </div>
                    <div style="background: #F1F5F9; padding: 1rem; border-radius: 10px;">
                        <span style="font-size: 0.8rem; color: var(--text-muted); display: block;">Return Date (If Applicable)</span>
                        <strong style="font-size: 1rem; color: var(--text-dark);"><i class="fa-regular fa-calendar-check me-1"></i> {{ $ticket->return_date ? $ticket->return_date->format('F d, Y (l)') : 'N/A (One Way)' }}</strong>
                    </div>
                </div>

                <!-- Description -->
                @if($ticket->description)
                    <h3 class="font-heading" style="font-size: 1.2rem; color: var(--primary-dark); margin-bottom: 0.75rem;">Agency Ticket Notes</h3>
                    <p style="color: var(--text-dark); line-height: 1.7; font-size: 0.95rem; white-space: pre-line;">{{ $ticket->description }}</p>
                @endif
            </div>
        </div>

        <!-- Right Seller Agency Sidebar Card -->
        <div>
            <div style="background: white; border-radius: 16px; padding: 1.75rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-md); position: sticky; top: 100px;">
                <span style="font-size: 0.75rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 0.75rem;">SELLER AGENCY</span>

                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.25rem;">
                    <div style="width: 50px; height: 50px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.3rem;">
                        {{ strtoupper(substr($ticket->agency->name, 0, 1)) }}
                    </div>
                    <div>
                        <h3 class="font-heading" style="font-size: 1.15rem; color: var(--primary-dark);">{{ $ticket->agency->name }}</h3>
                        <p style="font-size: 0.8rem; color: var(--text-muted);"><i class="fa-solid fa-shield-check text-emerald-600"></i> {{ $ticket->agency->company_name }}</p>
                    </div>
                </div>

                <div style="background: #F8FAFC; padding: 1rem; border-radius: 10px; font-size: 0.85rem; margin-bottom: 1.5rem; border: 1px solid var(--border-color);">
                    <p style="margin-bottom: 0.5rem;"><i class="fa-solid fa-id-card text-amber-600 me-2"></i> <strong>Govt License:</strong> {{ $ticket->agency->license_number }}</p>
                    <p style="margin-bottom: 0.5rem;"><i class="fa-solid fa-location-dot text-red-500 me-2"></i> <strong>Location:</strong> {{ $ticket->agency->city }}, {{ $ticket->agency->country }}</p>
                    <p style="margin-bottom: 0.5rem;"><i class="fa-solid fa-star text-amber-400 me-2"></i> <strong>Agency Rating:</strong> {{ $ticket->agency->rating }} / 5.0</p>
                    <p><i class="fa-solid fa-phone text-blue-600 me-2"></i> <strong>Phone:</strong> {{ $ticket->agency->phone }}</p>
                </div>

                <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                    <button onclick="openInquiryModal('ticket', {{ $ticket->id }}, '{{ addslashes($ticket->title) }}')" class="btn-gold" style="width: 100%; justify-content: center; font-size: 1rem; padding: 0.85rem;">
                        <i class="fa-solid fa-shopping-cart"></i> Buy / Inquire Ticket
                    </button>

                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $ticket->agency->whatsapp ?? $ticket->agency->phone) }}?text=Salam%20agency,%20interested%20in%20your%20tickets:%20{{ urlencode($ticket->title) }}" target="_blank" class="btn-primary" style="background: #25D366; justify-content: center; font-size: 1rem; padding: 0.85rem;">
                        <i class="fa-brands fa-whatsapp"></i> Chat on WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
