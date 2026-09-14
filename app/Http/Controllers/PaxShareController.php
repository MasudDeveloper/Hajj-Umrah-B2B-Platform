<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\PaxShareListing;
use Illuminate\Http\Request;

class PaxShareController extends Controller
{
    public function index(Request $request)
    {
        $query = PaxShareListing::with('agency')->where('status', 'active');

        if ($request->filled('package_type')) {
            $query->where('package_type', $request->package_type);
        }

        if ($request->filled('min_vacant')) {
            $query->where('vacant_seats', '>=', $request->min_vacant);
        }

        if ($request->filled('max_price')) {
            $query->where('price_per_pax', '<=', $request->max_price);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('makkah_hotel', 'like', "%{$search}%")
                  ->orWhere('airline_name', 'like', "%{$search}%");
            });
        }

        $listings = $query->orderBy('departure_date', 'asc')->paginate(9);

        return view('pax_share.index', compact('listings'));
    }

    public function show($id)
    {
        $listing = PaxShareListing::with('agency')->findOrFail($id);
        $relatedListings = PaxShareListing::with('agency')
            ->where('id', '!=', $id)
            ->where('status', 'active')
            ->take(3)
            ->get();

        return view('pax_share.show', compact('listing', 'relatedListings'));
    }

    public function create()
    {
        $agencies = Agency::all();
        return view('pax_share.create', compact('agencies'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'agency_id' => 'required|exists:agencies,id',
            'title' => 'required|string|max:255',
            'package_type' => 'required|string',
            'total_group_size' => 'required|integer|min:1',
            'vacant_seats' => 'required|integer|min:1',
            'departure_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:departure_date',
            'price_per_pax' => 'required|numeric|min:0',
            'airline_name' => 'required|string|max:255',
            'makkah_hotel' => 'nullable|string|max:255',
            'distance_makkah_m' => 'nullable|integer',
            'madinah_hotel' => 'nullable|string|max:255',
            'distance_madinah_m' => 'nullable|integer',
            'meals_included' => 'nullable|boolean',
            'visa_included' => 'nullable|boolean',
            'transport_included' => 'nullable|boolean',
            'description' => 'nullable|string',
        ]);

        $validated['meals_included'] = $request->has('meals_included');
        $validated['visa_included'] = $request->has('visa_included');
        $validated['transport_included'] = $request->has('transport_included');
        $validated['currency'] = 'BDT';
        $validated['status'] = 'active';

        PaxShareListing::create($validated);

        return redirect()->route('pax_share.index')->with('success', 'Group Pax Shortage listing created successfully!');
    }
}
