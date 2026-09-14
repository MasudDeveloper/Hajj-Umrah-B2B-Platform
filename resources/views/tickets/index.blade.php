@extends('layouts.app')

@section('title', 'Flight Ticket Exchange Marketplace')

@section('content')
    <div style="background: white; padding: 2rem; border-radius: 16px; margin-bottom: 2rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
            <div>
                <h1 class="font-heading" style="font-size: 2rem; color: var(--primary-dark); margin-bottom: 0.25rem;">Excess Flight Ticket Exchange</h1>
                <p style="color: var(--text-muted); font-size: 0.95rem;">Buy or sell surplus group flight tickets from verified Hajj & Umrah agencies.</p>
            </div>

            <a href="{{ route('tickets.create') }}" class="btn-gold">
                <i class="fa-solid fa-plus-circle"></i> Post Excess Tickets
            </a>
        </div>

        <!-- Filter Bar -->
        <form action="{{ route('tickets.index') }}" method="GET" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)) 120px; gap: 1rem; background: #F8FAFC; padding: 1.25rem; border-radius: 12px; border: 1px solid var(--border-color);">
            <div>
                <label style="display: block; font-size: 0.8rem; font-weight: 600; color: var(--text-muted); margin-bottom: 0.35rem;">Search Title/PNR</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="e.g. Saudia / DAC-JED..." style="width: 100%; padding: 0.6rem 0.8rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
            </div>

            <div>
                <label style="display: block; font-size: 0.8rem; font-weight: 600; color: var(--text-muted); margin-bottom: 0.35rem;">Airline</label>
                <input type="text" name="airline" value="{{ request('airline') }}" placeholder="e.g. Biman / Saudia" style="width: 100%; padding: 0.6rem 0.8rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
            </div>

            <div>
                <label style="display: block; font-size: 0.8rem; font-weight: 600; color: var(--text-muted); margin-bottom: 0.35rem;">Destination Airport</label>
                <select name="route_to" style="width: 100%; padding: 0.6rem 0.8rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                    <option value="">All Destinations</option>
                    <option value="JED" {{ request('route_to') == 'JED' ? 'selected' : '' }}>Jeddah (JED)</option>
                    <option value="MED" {{ request('route_to') == 'MED' ? 'selected' : '' }}>Madinah (MED)</option>
                </select>
            </div>

            <div>
                <label style="display: block; font-size: 0.8rem; font-weight: 600; color: var(--text-muted); margin-bottom: 0.35rem;">Flight Type</label>
                <select name="flight_type" style="width: 100%; padding: 0.6rem 0.8rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.9rem;">
                    <option value="">All Types</option>
                    <option value="return" {{ request('flight_type') == 'return' ? 'selected' : '' }}>Return Flight</option>
                    <option value="one_way" {{ request('flight_type') == 'one_way' ? 'selected' : '' }}>One-Way Flight</option>
                </select>
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
        @forelse($tickets as $ticket)
            <div class="card" style="display: flex; flex-direction: column; border-top: 4px solid var(--accent);">
                <div style="padding: 1.25rem; background: #F8FAFC; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center;">
                    <span class="badge badge-ticket">
                        <i class="fa-solid fa-ticket"></i> {{ strtoupper($ticket->flight_type) }} FLIGHT
                    </span>
                    <div style="background: #E0F2FE; color: #0369A1; font-weight: 700; font-size: 0.85rem; padding: 0.25rem 0.65rem; border-radius: 12px; border: 1px solid #7DD3FC;">
                        <i class="fa-solid fa-seat-airline"></i> {{ $ticket->available_tickets }} Seats Available
                    </div>
                </div>

                <div style="padding: 1.5rem; flex: 1; display: flex; flex-direction: column; justify-content: space-between;">
                    <div>
                        <h3 class="font-heading" style="font-size: 1.15rem; color: var(--text-dark); margin-bottom: 0.75rem; line-height: 1.3;">
                            <a href="{{ route('tickets.show', $ticket->id) }}" style="color: inherit; text-decoration: none;">
                                {{ $ticket->title }}
                            </a>
                        </h3>

                        <!-- Route Visual Banner -->
                        <div style="background: linear-gradient(135deg, #F1F5F9, #E2E8F0); padding: 0.75rem 1rem; border-radius: 10px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                            <div>
                                <span style="font-size: 0.75rem; color: var(--text-muted); display: block;">FROM</span>
                                <strong style="font-size: 1.1rem; color: var(--primary-dark);">{{ $ticket->route_from }}</strong>
                            </div>
                            <div style="color: var(--accent); font-size: 1.2rem;">
                                <i class="fa-solid fa-plane"></i>
                            </div>
                            <div style="text-align: right;">
                                <span style="font-size: 0.75rem; color: var(--text-muted); display: block;">TO</span>
                                <strong style="font-size: 1.1rem; color: var(--primary-dark);">{{ $ticket->route_to }}</strong>
                            </div>
                        </div>

                        <!-- Agency & Details -->
                        <div style="font-size: 0.85rem; color: var(--text-dark); margin-bottom: 1rem;">
                            <p style="margin-bottom: 0.35rem;"><i class="fa-solid fa-plane-departure text-emerald-700 me-1"></i> <strong>Airline:</strong> {{ $ticket->airline_name }}</p>
                            <p style="margin-bottom: 0.35rem;"><i class="fa-regular fa-calendar-check text-blue-600 me-1"></i> <strong>Flight Date:</strong> {{ $ticket->flight_date->format('d M, Y') }}</p>
                            <p style="margin-bottom: 0.35rem;"><i class="fa-solid fa-file-contract text-amber-600 me-1"></i> <strong>PNR Type:</strong> {{ $ticket->pnr_status }}</p>
                            <p style="margin-bottom: 0.35rem;"><i class="fa-solid fa-suitcase text-purple-600 me-1"></i> <strong>Baggage:</strong> {{ $ticket->baggage_allowance }}</p>
                        </div>
                    </div>

                    <!-- Price & Buy Button -->
                    <div style="border-top: 1px dashed var(--border-color); padding-top: 1rem; display: flex; align-items: center; justify-content: space-between;">
                        <div>
                            <span style="font-size: 0.75rem; color: var(--text-muted); display: block;">Price per Ticket</span>
                            <span style="font-size: 1.3rem; font-weight: 800; color: var(--primary-dark);">৳{{ number_format($ticket->price_per_ticket) }}</span>
                        </div>

                        <div style="display: flex; gap: 0.5rem;">
                            <a href="{{ route('tickets.show', $ticket->id) }}" class="btn-primary" style="padding: 0.5rem 0.85rem; font-size: 0.85rem;">
                                Details
                            </a>
                            <button onclick="openInquiryModal('ticket', {{ $ticket->id }}, '{{ addslashes($ticket->title) }}')" class="btn-gold" style="padding: 0.5rem 0.85rem; font-size: 0.85rem;">
                                Buy Ticket
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 4rem 2rem; background: white; border-radius: 12px;">
                <i class="fa-solid fa-ticket-simple" style="font-size: 3rem; color: var(--text-muted); margin-bottom: 1rem;"></i>
                <h3 style="color: var(--text-dark); margin-bottom: 0.5rem;">No Surplus Ticket Listings Found</h3>
                <p style="color: var(--text-muted);">Try adjusting your flight search filters or list extra tickets.</p>
            </div>
        @endforelse
    </div>

    <div>
        {{ $tickets->links() }}
    </div>
@endsection
