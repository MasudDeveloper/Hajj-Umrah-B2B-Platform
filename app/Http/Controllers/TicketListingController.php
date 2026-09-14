<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\TicketListing;
use Illuminate\Http\Request;

class TicketListingController extends Controller
{
    public function index(Request $request)
    {
        $query = TicketListing::with('agency')->where('status', 'active');

        if ($request->filled('airline')) {
            $query->where('airline_name', 'like', "%{$request->airline}%");
        }

        if ($request->filled('route_to')) {
            $query->where('route_to', 'like', "%{$request->route_to}%");
        }

        if ($request->filled('flight_type')) {
            $query->where('flight_type', $request->flight_type);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('airline_name', 'like', "%{$search}%")
                  ->orWhere('pnr_status', 'like', "%{$search}%");
            });
        }

        $tickets = $query->orderBy('flight_date', 'asc')->paginate(9);

        return view('tickets.index', compact('tickets'));
    }

    public function show($id)
    {
        $ticket = TicketListing::with('agency')->findOrFail($id);
        $relatedTickets = TicketListing::with('agency')
            ->where('id', '!=', $id)
            ->where('status', 'active')
            ->take(3)
            ->get();

        return view('tickets.show', compact('ticket', 'relatedTickets'));
    }

    public function create()
    {
        $agencies = Agency::all();
        return view('tickets.create', compact('agencies'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'agency_id' => 'required|exists:agencies,id',
            'title' => 'required|string|max:255',
            'airline_name' => 'required|string|max:255',
            'route_from' => 'required|string|max:100',
            'route_to' => 'required|string|max:100',
            'flight_type' => 'required|string',
            'flight_date' => 'required|date',
            'return_date' => 'nullable|date|after_or_equal:flight_date',
            'total_tickets' => 'required|integer|min:1',
            'available_tickets' => 'required|integer|min:1',
            'price_per_ticket' => 'required|numeric|min:0',
            'pnr_status' => 'required|string|max:255',
            'baggage_allowance' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $validated['currency'] = 'BDT';
        $validated['status'] = 'active';

        TicketListing::create($validated);

        return redirect()->route('tickets.index')->with('success', 'Flight ticket offer posted successfully!');
    }
}
