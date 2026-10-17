<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\Post;
use App\Models\PostInquiry;
use App\Models\Transaction;
use App\Models\Subscription;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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

        $allPostsList = Post::with('agency')
            ->where('status', '!=', 'closed')
            ->orderBy('flight_date', 'asc')
            ->take(10)
            ->get();

        // Urgent Flight Deals (Flight date nearest to today)
        $urgentDeals = Post::with('agency')
            ->where('status', '!=', 'closed')
            ->where('flight_date', '>=', now()->startOfDay())
            ->orderBy('flight_date', 'asc')
            ->take(3)
            ->get();

        // Special Admin Approved Offers
        $specialOffers = Post::with('agency')
            ->where('status', '!=', 'closed')
            ->where(function($q) {
                $q->where('is_special_offer', true)
                  ->orWhere('special_offer_status', 'pending')
                  ->orWhere('agent_commission', '>', 0);
            })
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('home', compact(
            'totalAgencies',
            'totalVacantPax',
            'totalActivePosts',
            'allPostsList',
            'urgentDeals',
            'specialOffers'
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

        if ($request->filled('hajj_or_umrah')) {
            $query->where('hajj_or_umrah', $request->hajj_or_umrah);
        }

        if ($request->filled('airline')) {
            $query->where('airline', $request->airline);
        }

        if ($request->filled('flight_date_from')) {
            $query->where('flight_date', '>=', $request->flight_date_from);
        }

        if ($request->filled('flight_date_to')) {
            $query->where('flight_date', '<=', $request->flight_date_to);
        }

        if ($request->filled('max_hotel_distance')) {
            $dist = (int) $request->max_hotel_distance;
            $query->where(function($q) use ($dist) {
                $q->where('makkah_hotel_distance', '<=', $dist)
                  ->orWhere('madinah_hotel_distance', '<=', $dist);
            });
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
                  ->orWhere('madinah_hotel', 'like', "%{$search}%")
                  ->orWhere('pnr_code', 'like', "%{$search}%");
            });
        }

        $posts = $query->orderBy('flight_date', 'asc')->paginate(9);

        // Fetch distinct available airlines for dynamic filter dropdown
        $availableAirlines = Post::whereNotNull('airline')
            ->where('airline', '!=', '')
            ->distinct()
            ->pluck('airline');

        return view('posts.index', compact('posts', 'availableAirlines'));
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

        $existingInquiry = null;
        if ($currentUser) {
            $existingInquiry = PostInquiry::where('post_id', $id)
                ->where('inquiring_agency_id', $currentUser->id)
                ->whereIn('status', ['pending', 'accepted'])
                ->latest()
                ->first();
        }

        return view('posts.show', compact('post', 'relatedPosts', 'isCanViewContact', 'existingInquiry'));
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
            'hajj_or_umrah' => 'required|string|in:hajj,umrah',
            'post_category' => 'nullable|string',
            'requirement_type' => 'required|string',
            'total_group_size' => 'nullable|integer|min:1',
            'available_seats' => 'required|integer|min:1',
            'flight_date' => 'required|date',
            'departure_time' => 'nullable|string|max:255',
            'arrival_time' => 'nullable|string|max:255',
            'transit_duration' => 'nullable|string|max:255',
            'return_date' => 'nullable|date|after_or_equal:flight_date',
            'duration_days' => 'required|integer|min:1',
            'airline' => 'nullable|string|max:255',
            'flight_transit' => 'nullable|string',
            'departure_city' => 'nullable|string',
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
            'moallem_number' => 'nullable|string',
            'arafat_tent_details' => 'nullable|string',
            'visa_type' => 'nullable|string',
            'makkah_hotel_type' => 'nullable|string',
            'madinah_hotel_type' => 'nullable|string',
            'itinerary_pdf' => 'nullable|string|max:500',
            'details' => 'nullable|string',
        ]);

        if ($validated['hajj_or_umrah'] === 'hajj') {
            $validated['post_category'] = 'group_seats';
            $validated['departure_city'] = 'Dhaka';
            $validated['flight_transit'] = 'direct';
            $validated['visa_type'] = 'hajj_visa';
        }
        if ($validated['requirement_type'] === 'need_seats') {
            $validated['total_group_size'] = 0;
        }

        $validated['agency_id'] = $agency->id;
        $validated['meals_included'] = $request->has('meals_included');
        $validated['visa_included'] = $request->has('visa_included');
        $validated['transport_included'] = $request->has('transport_included');
        $validated['makkah_shuttle'] = $request->has('makkah_shuttle');
        $validated['ziyarah_included'] = $request->has('ziyarah_included');
        $validated['guide_included'] = $request->has('guide_included');
        $validated['zamzam_included'] = $request->has('zamzam_included');
        $validated['haramain_train'] = $request->has('haramain_train');
        $validated['aziziyah_accommodation'] = $request->has('aziziyah_accommodation');
        $validated['shifting_package'] = $request->input('shifting_package') == '1';
        $validated['qurbani_included'] = $request->has('qurbani_included');
        $validated['currency'] = 'BDT';
        $validated['status'] = 'open';

        if ($request->has('request_special_offer')) {
            $validated['special_offer_status'] = 'pending';
        }

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
            'offered_price_per_seat' => 'nullable|numeric|min:0',
            'message' => 'required|string',
        ]);

        $existingInquiry = PostInquiry::where('post_id', $request->post_id)
            ->where('inquiring_agency_id', Auth::id())
            ->whereIn('status', ['pending', 'accepted'])
            ->first();

        if ($existingInquiry) {
            return back()->with('error', 'আপনার একটি প্রস্তাব ইতিমধ্যেই সেলার এজেন্সির কাছে পেন্ডিং অবস্থায় রয়েছে। অনুগ্রহ করে পূর্বের প্রস্তাবের সিদ্ধান্তের জন্য অপেক্ষা করুন।');
        }

        $validated['inquiring_agency_id'] = Auth::id();
        $validated['status'] = 'pending';

        $inquiry = PostInquiry::create($validated);

        // Notify seller agency
        $post = Post::find($request->post_id);
        if ($post) {
            Notification::send(
                $post->agency_id,
                'new_inquiry',
                'নতুন B2B ডিল প্রস্তাব!',
                Auth::user()->agency_name . ' আপনার "' . Str::limit($post->title, 35) . '" পোস্টে ' . $request->requested_seats . 'টি সিটের জন্য প্রস্তাব পাঠিয়েছেন।',
                route('dashboard.index')
            );
        }

        return back()->with('success', 'B2B Deal proposal submitted! The seller agency has been notified.');
    }

    public function respondInquiry(Request $request, $id)
    {
        if (!Auth::check()) {
            return back()->with('error', 'Unauthorized.');
        }

        $inquiry = PostInquiry::with('post')->findOrFail($id);

        if ($inquiry->post->agency_id !== Auth::id()) {
            return back()->with('error', 'Unauthorized access to this B2B deal inquiry.');
        }

        $validated = $request->validate([
            'seller_note' => 'nullable|string',
            'advance_amount_agreed' => 'nullable|numeric|min:0',
            'offered_price_per_seat' => 'nullable|numeric|min:0',
            'status' => 'required|string|in:accepted,rejected,pending',
        ]);

        $inquiry->update([
            'seller_note' => $request->input('seller_note'),
            'advance_amount_agreed' => $request->input('advance_amount_agreed'),
            'offered_price_per_seat' => $request->input('offered_price_per_seat') ?: $inquiry->offered_price_per_seat,
            'status' => $request->input('status'),
        ]);

        // Notify buyer agency
        Notification::send(
            $inquiry->inquiring_agency_id,
            'quotation_responded',
            'কোটেশন উত্তর: ' . strtoupper($request->input('status')),
            $inquiry->post->agency->agency_name . ' আপনার ডিল প্রস্তাবে কোটেশন উত্তর দিয়েছেন।',
            route('dashboard.index')
        );

        return back()->with('success', 'Quotation response sent to buyer agency!');
    }

    public function confirmDeal(Request $request, $id)
    {
        if (!Auth::check()) {
            return back()->with('error', 'Unauthorized.');
        }

        $inquiry = PostInquiry::with(['post', 'inquiringAgency', 'post.agency'])->findOrFail($id);
        $currentAgencyId = Auth::id();

        $isSeller = ($inquiry->post->agency_id === $currentAgencyId);
        $isBuyer = ($inquiry->inquiring_agency_id === $currentAgencyId);

        if (!$isSeller && !$isBuyer) {
            return back()->with('error', 'Unauthorized access to confirm this deal.');
        }

        if ($inquiry->status === 'pending') {
            return back()->with('error', 'পেন্ডিং অবস্থায় ডিল ডান কনফার্ম করা সম্ভব নয়। সেলার এজেন্সিকে প্রথমে কোটেশন রেসপন্স পাঠাতে হবে।');
        }

        if ($isSeller) {
            $inquiry->seller_deal_done = true;
        }

        if ($isBuyer) {
            $inquiry->buyer_deal_done = true;
        }

        if ($inquiry->seller_deal_done && $inquiry->buyer_deal_done) {
            $inquiry->status = 'completed';
            if (!$inquiry->contract_number) {
                $inquiry->contract_number = PostInquiry::generateContractNumber();
                $inquiry->deal_completed_at = now();

                // Deduct requested seats from post's available seats
                $post = $inquiry->post;
                if ($post) {
                    $post->available_seats = max(0, $post->available_seats - $inquiry->requested_seats);
                    if ($post->available_seats === 0) {
                        $post->status = 'closed';
                    } else {
                        $post->status = 'partially_filled';
                    }
                    $post->save();
                }
            }
        }

        $inquiry->save();

        if ($inquiry->status === 'completed') {
            // Send deal confirmation notifications to both agencies
            Notification::send(
                $inquiry->post->agency_id,
                'deal_confirmed',
                '🎉 দ্বিপাক্ষিক B2B ডিল সম্পন্ন!',
                $inquiry->inquiringAgency->agency_name . '-এর সাথে চুক্তিপত্র #' . $inquiry->contract_number . ' চূড়ান্ত হয়েছে!',
                route('posts.inquiry.contract', $inquiry->id)
            );

            Notification::send(
                $inquiry->inquiring_agency_id,
                'deal_confirmed',
                '🎉 দ্বিপাক্ষিক B2B ডিল সম্পন্ন!',
                $inquiry->post->agency->agency_name . '-এর সাথে চুক্তিপত্র #' . $inquiry->contract_number . ' চূড়ান্ত হয়েছে!',
                route('posts.inquiry.contract', $inquiry->id)
            );

            return back()->with('success', '🎉 DEAL COMPLETED! Both agencies have confirmed advance payment. Official B2B Contract Agreement #' . $inquiry->contract_number . ' is ready!');
        }

        // Notify other agency of Deal Done press
        $otherPartyId = $isSeller ? $inquiry->inquiring_agency_id : $inquiry->post->agency_id;
        Notification::send(
            $otherPartyId,
            'deal_step',
            'পার্টনার এজেন্সি ডিল ডান কনফার্ম করেছে!',
            Auth::user()->agency_name . ' অগ্রিম লেনদেন কনফার্ম করেছে। চুক্তিপত্র প্রস্তুত করতে আপনার কনফার্মেশন দিন।',
            route('dashboard.index')
        );

        return back()->with('success', 'Your "Deal Done" confirmation has been recorded. Waiting for partner agency confirmation.');
    }

    public function quotationLetterView($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $inquiry = PostInquiry::with(['post.agency', 'inquiringAgency'])->findOrFail($id);
        $currentAgencyId = Auth::id();

        $isSeller = ($inquiry->post->agency_id === $currentAgencyId);
        $isBuyer = ($inquiry->inquiring_agency_id === $currentAgencyId);
        $isAdmin = Auth::user()->isAdmin();

        if (!$isSeller && !$isBuyer && !$isAdmin) {
            return redirect()->route('home')->with('error', 'Unauthorized access to B2B Quotation Letter.');
        }

        return view('posts.inquiry_quotation_letter', compact('inquiry'));
    }

    public function contractView($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $inquiry = PostInquiry::with(['post.agency', 'inquiringAgency'])->findOrFail($id);
        $currentAgencyId = Auth::id();

        $isSeller = ($inquiry->post->agency_id === $currentAgencyId);
        $isBuyer = ($inquiry->inquiring_agency_id === $currentAgencyId);
        $isAdmin = Auth::user()->isAdmin();

        if (!$isSeller && !$isBuyer && !$isAdmin) {
            return redirect()->route('home')->with('error', 'Unauthorized access to B2B Contract Agreement.');
        }

        return view('posts.contract', compact('inquiry'));
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

        $sentInquiries = PostInquiry::with(['post.agency', 'post'])
            ->where('inquiring_agency_id', $agency->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $myTransactions = Transaction::where('agency_id', $agency->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $activeSubscription = Subscription::where('agency_id', $agency->id)
            ->where('status', 'active')
            ->orderBy('ends_at', 'desc')
            ->first();

        return view('dashboard.index', compact('agency', 'myPosts', 'myInquiries', 'sentInquiries', 'myTransactions', 'activeSubscription'));
    }

    public function updateStatus(Request $request, $id)
    {
        $post = Post::where('agency_id', Auth::id())->findOrFail($id);
        $post->status = $request->get('status', 'open');
        $post->save();

        return back()->with('success', 'Post status updated to ' . strtoupper($post->status));
    }

    public function adjustSeats(Request $request, $id)
    {
        if (!Auth::check()) {
            return back()->with('error', 'Unauthorized.');
        }

        $post = Post::where('agency_id', Auth::id())->findOrFail($id);

        $validated = $request->validate([
            'seats_count' => 'required|integer|min:0',
            'adjustment_type' => 'required|string|in:set,reduce',
        ]);

        if ($validated['adjustment_type'] === 'reduce') {
            $post->available_seats = max(0, $post->available_seats - (int)$validated['seats_count']);
        } else {
            $post->available_seats = (int)$validated['seats_count'];
        }

        if ($post->available_seats === 0) {
            $post->status = 'closed';
        } else if ($post->status === 'closed' && $post->available_seats > 0) {
            $post->status = 'open';
        }

        $post->save();

        return back()->with('success', 'সিট সংখ্যা সফলভাবে আপডেট/এডজাস্ট করা হয়েছে!');
    }
}
