<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\PaxShareListing;
use App\Models\TicketListing;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class AgencyDashboardController extends Controller
{
    public function index(Request $request)
    {
        $selectedAgencyId = $request->get('agency_id', 1);
        $currentAgency = Agency::findOrFail($selectedAgencyId);

        $paxListings = PaxShareListing::where('agency_id', $selectedAgencyId)
            ->orderBy('created_at', 'desc')
            ->get();

        $ticketListings = TicketListing::where('agency_id', $selectedAgencyId)
            ->orderBy('created_at', 'desc')
            ->get();

        $inquiries = Inquiry::orderBy('created_at', 'desc')->get();
        $allAgencies = Agency::all();

        return view('dashboard.index', compact('currentAgency', 'paxListings', 'ticketListings', 'inquiries', 'allAgencies'));
    }

    public function storeInquiry(Request $request)
    {
        $validated = $request->validate([
            'sender_agency_name' => 'required|string|max:255',
            'sender_phone' => 'required|string|max:50',
            'sender_email' => 'nullable|email|max:255',
            'listing_type' => 'required|string',
            'listing_id' => 'required|integer',
            'requested_seats' => 'required|integer|min:1',
            'message' => 'nullable|string',
        ]);

        $validated['status'] = 'pending';

        Inquiry::create($validated);

        return back()->with('success', 'Your B2B deal inquiry has been submitted! The seller agency will contact you shortly.');
    }

    public function togglePaxStatus($id)
    {
        $listing = PaxShareListing::findOrFail($id);
        $listing->status = ($listing->status === 'active') ? 'filled' : 'active';
        $listing->save();

        return back()->with('success', 'Listing status updated to ' . strtoupper($listing->status));
    }

    public function toggleTicketStatus($id)
    {
        $listing = TicketListing::findOrFail($id);
        $listing->status = ($listing->status === 'active') ? 'sold' : 'active';
        $listing->save();

        return back()->with('success', 'Ticket status updated to ' . strtoupper($listing->status));
    }
}
