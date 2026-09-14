<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\PaxShareListing;
use App\Models\TicketListing;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $totalAgencies = Agency::count();
        $totalVacantPax = PaxShareListing::where('status', 'active')->sum('vacant_seats');
        $totalExcessTickets = TicketListing::where('status', 'active')->sum('available_tickets');
        $totalActiveListings = PaxShareListing::where('status', 'active')->count() + TicketListing::where('status', 'active')->count();

        $featuredPaxListings = PaxShareListing::with('agency')
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        $featuredTicketListings = TicketListing::with('agency')
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        return view('home', compact(
            'totalAgencies',
            'totalVacantPax',
            'totalExcessTickets',
            'totalActiveListings',
            'featuredPaxListings',
            'featuredTicketListings'
        ));
    }
}
