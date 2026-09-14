<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\Post;
use App\Models\PostInquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function home()
    {
        $totalAgencies = Agency::where('verification_status', 'approved')->count();
        $totalVacantPax = Post::where('status', '!=', 'closed')->sum('available_seats');
        $totalActivePosts = Post::where('status', '!=', 'closed')->count();

        $featuredGroupSeats = Post::with('agency')
            ->where('post_category', 'group_seats')
            ->where('status', '!=', 'closed')
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        $featuredTickets = Post::with('agency')
            ->where('post_category', 'ticket_only')
            ->where('status', '!=', 'closed')
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        $featuredHotels = Post::with('agency')
            ->where('post_category', 'hotel_share')
            ->where('status', '!=', 'closed')
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        return view('home', compact(
            'totalAgencies',
            'totalVacantPax',
            'totalActivePosts',
            'featuredGroupSeats',
            'featuredTickets',
            'featuredHotels'
        ));
    }

    public function index(Request $request)
    {
        $query = Post::with('agency')->where('status', '!=', 'closed');

        if ($request->filled('post_category')) {
            $query->where('post_category', $request->post_category);
        }

        if ($request->filled('requirement_type')) {
            $query->where('requirement_type', $request->requirement_type);
        }

        if ($request->filled('departure_city')) {
            $query->where('departure_city', $request->departure_city);
        }

        if ($request->filled('flight_transit')) {
            $query->where('flight_transit', $request->flight_transit);
        }

        if ($request->filled('package_tier')) {
            $query->where('package_tier', $request->package_tier);
        }

        if ($request->filled('room_type')) {
            $query->where('room_type', $request->room_type);
        }

        if ($request->filled('allowed_gender')) {
            $query->where('allowed_gender', $request->allowed_gender);
        }

        if ($request->filled('route_sequence')) {
            $query->where('route_sequence', $request->route_sequence);
        }

        if ($request->filled('catering_type')) {
            $query->where('catering_type', $request->catering_type);
        }

        if ($request->filled('min_seats')) {
            $query->where('available_seats', '>=', $request->min_seats);
        }

        if ($request->filled('max_price')) {
            $query->where('price_per_seat', '<=', $request->max_price);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('airline', 'like', "%{$search}%")
                  ->orWhere('makkah_hotel', 'like', "%{$search}%")
                  ->orWhere('pnr_code', 'like', "%{$search}%");
            });
        }

        $posts = $query->orderBy('flight_date', 'asc')->paginate(9);

        return view('posts.index', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::with('agency.reviewsReceived')->findOrFail($id);
        $relatedPosts = Post::with('agency')
            ->where('id', '!=', $id)
            ->where('post_category', $post->post_category)
            ->take(3)
            ->get();

        $currentUser = Auth::user();
        $isCanViewContact = $currentUser && $currentUser->isApproved();

        return view('posts.show', compact('post', 'relatedPosts', 'isCanViewContact'));
    }

    public function quotation($id)
    {
        $post = Post::with('agency')->findOrFail($id);
        return view('posts.quotation', compact('post'));
    }

    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('success', 'Please login with your agency account to create a B2B post.');
        }

        $agency = Auth::user();
        if (!$agency->isApproved() && !$agency->isAdmin()) {
            return redirect()->route('home')->with('success', 'Your agency registration is currently PENDING approval. Only verified agencies can create posts.');
        }

        return view('posts.create');
    }

    public function store(Request $request)
    {
        $agency = Auth::user();
        if (!$agency || (!$agency->isApproved() && !$agency->isAdmin())) {
            return redirect()->route('home')->with('error', 'Unauthorized. Only verified agencies can post.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'post_category' => 'required|string',
            'requirement_type' => 'required|string',
            'total_group_size' => 'required|integer|min:1',
            'available_seats' => 'required|integer|min:1',
            'flight_date' => 'required|date',
            'return_date' => 'nullable|date|after_or_equal:flight_date',
            'duration_days' => 'required|integer|min:1',
            'airline' => 'required|string|max:255',
            'flight_transit' => 'required|string',
            'departure_city' => 'required|string',
            'package_tier' => 'required|string',
            'room_type' => 'required|string',
            'makkah_hotel' => 'nullable|string|max:255',
            'makkah_hotel_distance' => 'nullable|integer',
            'madinah_hotel' => 'nullable|string|max:255',
            'madinah_hotel_distance' => 'nullable|integer',
            'price_per_seat' => 'required|numeric|min:0',
            'advance_deposit' => 'nullable|numeric|min:0',
            'name_deadline' => 'nullable|date',
            'pnr_code' => 'nullable|string|max:255',
            'baggage_allowance' => 'nullable|string|max:255',
            'allowed_gender' => 'nullable|string',
            'passenger_type' => 'nullable|string',
            'route_sequence' => 'nullable|string',
            'catering_type' => 'nullable|string',
            'transport_vehicle' => 'nullable|string',
            'agent_commission' => 'nullable|numeric|min:0',
            'name_change_policy' => 'nullable|string',
            'payment_terms' => 'nullable|string',
            'hajj_tent_category' => 'nullable|string',
            'visa_type' => 'nullable|string',
            'makkah_hotel_type' => 'nullable|string',
            'madinah_hotel_type' => 'nullable|string',
            'itinerary_pdf' => 'nullable|string|max:500',
            'details' => 'nullable|string',
        ]);

        $validated['agency_id'] = $agency->id;
        $validated['meals_included'] = $request->has('meals_included');
        $validated['visa_included'] = $request->has('visa_included');
        $validated['transport_included'] = $request->has('transport_included');
        $validated['makkah_shuttle'] = $request->has('makkah_shuttle');
        $validated['ziyarah_included'] = $request->has('ziyarah_included');
        $validated['guide_included'] = $request->has('guide_included');
        $validated['zamzam_included'] = $request->has('zamzam_included');
        $validated['haramain_train'] = $request->has('haramain_train');
        $validated['currency'] = 'BDT';
        $validated['status'] = 'open';

        Post::create($validated);

        return redirect()->route('posts.index')->with('success', 'B2B Post published successfully!');
    }

    public function storeInquiry(Request $request)
    {
        if (!Auth::check() || !Auth::user()->isApproved()) {
            return back()->with('error', 'Only verified agencies can submit B2B deal inquiries.');
        }

        $validated = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'requested_seats' => 'required|integer|min:1',
            'message' => 'required|string',
        ]);

        $validated['inquiring_agency_id'] = Auth::id();
        $validated['status'] = 'pending';

        PostInquiry::create($validated);

        return back()->with('success', 'Express Interest inquiry submitted! The seller agency has been notified.');
    }

    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $agency = Auth::user();
        $myPosts = Post::where('agency_id', $agency->id)->orderBy('created_at', 'desc')->get();
        $myInquiries = PostInquiry::with(['post', 'inquiringAgency'])
            ->whereHas('post', function ($q) use ($agency) {
                $q->where('agency_id', $agency->id);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard.index', compact('agency', 'myPosts', 'myInquiries'));
    }

    public function updateStatus(Request $request, $id)
    {
        $post = Post::where('agency_id', Auth::id())->findOrFail($id);
        $post->status = $request->get('status', 'open');
        $post->save();

        return back()->with('success', 'Post status updated to ' . strtoupper($post->status));
    }
}
