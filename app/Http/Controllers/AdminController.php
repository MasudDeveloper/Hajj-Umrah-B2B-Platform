<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\Post;
use App\Models\PostInquiry;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * 1. Overview & Visual Analytics Dashboard (/admin)
     */
    public function dashboard()
    {
        // Metric Counts
        $totalAgencies = Agency::where('is_admin', false)->count();
        $totalPendingCount = Agency::where('verification_status', 'pending')->where('is_admin', false)->count();
        $totalVerifiedCount = Agency::where('verification_status', 'approved')->where('is_admin', false)->count();
        $totalRejectedCount = Agency::where('verification_status', 'rejected')->where('is_admin', false)->count();
        $totalPostsCount = Post::count();
        $totalInquiriesCount = PostInquiry::count();

        // Analytics Data Breakdowns for Visual Charts
        $verificationChart = [
            'approved' => $totalVerifiedCount,
            'pending' => $totalPendingCount,
            'rejected' => $totalRejectedCount,
        ];

        $categoryChart = [
            'group_seats' => Post::where('post_category', 'group_seats')->count(),
            'ticket_only' => Post::where('post_category', 'ticket_only')->count(),
            'hotel_share' => Post::where('post_category', 'hotel_share')->count(),
        ];

        $cityChart = [
            'Dhaka' => Agency::where('city', 'Dhaka')->where('is_admin', false)->count(),
            'Chittagong' => Agency::where('city', 'Chittagong')->where('is_admin', false)->count(),
            'Sylhet' => Agency::where('city', 'Sylhet')->where('is_admin', false)->count(),
            'Others' => Agency::whereNotIn('city', ['Dhaka', 'Chittagong', 'Sylhet'])->where('is_admin', false)->count(),
        ];

        // Recent Activity Feed
        $recentRegistrations = Agency::where('is_admin', false)->orderBy('created_at', 'desc')->take(5)->get();
        $recentPosts = Post::with('agency')->orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact(
            'totalAgencies',
            'totalPendingCount',
            'totalVerifiedCount',
            'totalRejectedCount',
            'totalPostsCount',
            'totalInquiriesCount',
            'verificationChart',
            'categoryChart',
            'cityChart',
            'recentRegistrations',
            'recentPosts'
        ));
    }

    /**
     * 2. Dedicated Verification Queue Page (/admin/verifications)
     */
    public function verifications()
    {
        $pendingAgencies = Agency::where('verification_status', 'pending')
            ->where('is_admin', false)
            ->orderBy('created_at', 'desc')
            ->get();

        $totalPendingCount = $pendingAgencies->count();

        return view('admin.verifications', compact('pendingAgencies', 'totalPendingCount'));
    }

    /**
     * 3. Dedicated All Agencies Directory Page (/admin/agencies)
     */
    public function agencies(Request $request)
    {
        $query = Agency::where('is_admin', false);

        // Search Filter
        if ($request->filled('search')) {
            $search = trim($request->get('search'));
            $query->where(function ($q) use ($search) {
                $q->where('agency_name', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%")
                  ->orWhere('owner_name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('whatsapp', 'like', "%{$search}%")
                  ->orWhere('license_no', 'like', "%{$search}%")
                  ->orWhere('hajj_license_no', 'like', "%{$search}%")
                  ->orWhere('umrah_license_no', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%");
            });
        }

        // Status Filter
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('verification_status', $request->status);
        }

        // License Type Filter
        if ($request->filled('license_type') && $request->license_type !== 'all') {
            $query->where('license_type', $request->license_type);
        }

        $allAgencies = $query->orderBy('created_at', 'desc')->get();
        $totalAgencies = Agency::where('is_admin', false)->count();

        return view('admin.agencies', compact('allAgencies', 'totalAgencies'));
    }

    /**
     * 4. Dedicated Platform Site Settings Page (/admin/settings)
     */
    public function settings()
    {
        $settings = [
            'site_phone' => SiteSetting::get('site_phone', '01644416378'),
            'site_whatsapp' => SiteSetting::get('site_whatsapp', '01644416378'),
            'site_email' => SiteSetting::get('site_email', 'masudd.info@gmail.com'),
            'site_address' => SiteSetting::get('site_address', '53 DIT Extension Road, Naya Paltan, Dhaka'),
            'site_notice' => SiteSetting::get('site_notice', 'বাংলাদেশের ভেরিফাইড হজ ও ওমরাহ এজেন্সি সমূহের ১০০% নিরাপদ B2B নেটওয়ার্ক।'),
        ];

        return view('admin.settings', compact('settings'));
    }

    /**
     * Update Site Settings
     */
    public function updateSettings(Request $request)
    {
        $request->validate([
            'site_phone' => 'nullable|string|max:50',
            'site_whatsapp' => 'nullable|string|max:50',
            'site_email' => 'nullable|email|max:100',
            'site_address' => 'nullable|string|max:255',
            'site_notice' => 'nullable|string',
        ]);

        foreach (['site_phone', 'site_whatsapp', 'site_email', 'site_address', 'site_notice'] as $key) {
            SiteSetting::set($key, $request->input($key));
        }

        return back()->with('success', 'Platform site settings updated successfully!');
    }

    /**
     * Approve Agency Verification
     */
    public function approveAgency($id)
    {
        $agency = Agency::findOrFail($id);
        $agency->is_verified = true;
        $agency->verification_status = 'approved';
        $agency->save();

        return back()->with('success', 'Agency "' . $agency->agency_name . '" (' . $agency->formatted_license_display . ') has been APPROVED & verified!');
    }

    /**
     * Reject Agency Verification
     */
    public function rejectAgency($id)
    {
        $agency = Agency::findOrFail($id);
        $agency->is_verified = false;
        $agency->verification_status = 'rejected';
        $agency->save();

        return back()->with('success', 'Agency "' . $agency->agency_name . '" verification status set to REJECTED.');
    }

    /**
     * Subscription Plan Switcher
     */
    public function toggleSubscription(Request $request, $id)
    {
        $agency = Agency::findOrFail($id);
        $agency->subscription_plan = $request->get('subscription_plan', 'monthly_b2b');
        $agency->save();

        return back()->with('success', 'Agency subscription plan updated to ' . strtoupper($agency->subscription_plan));
    }

    /**
     * 1-Click Login / Impersonate as Agency
     */
    public function impersonate($id)
    {
        $currentUser = Auth::user();
        if (!$currentUser || !$currentUser->isAdmin()) {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }

        $targetAgency = Agency::findOrFail($id);

        session([
            'admin_user_id' => $currentUser->id,
            'impersonated_by_admin' => true,
        ]);

        Auth::login($targetAgency);

        return redirect()->route('dashboard.index')->with('success', 'ADMIN IMPERSONATION ACTIVE: Logged in as ' . $targetAgency->agency_name);
    }

    /**
     * Stop Impersonation and Return to Super Admin
     */
    public function stopImpersonation()
    {
        $adminId = session('admin_user_id');
        if ($adminId) {
            Auth::loginUsingId($adminId);
            session()->forget(['admin_user_id', 'impersonated_by_admin']);

            return redirect()->route('admin.dashboard')->with('success', 'Exited agency impersonation mode and returned to Super Admin Governance Panel.');
        }

        return redirect()->route('home');
    }

    /**
     * Fetch Full Agency JSON Details for Inspection Modal
     */
    public function agencyDetails($id)
    {
        $agency = Agency::with(['posts', 'inquiriesSent'])->findOrFail($id);

        return response()->json([
            'id' => $agency->id,
            'agency_name' => $agency->agency_name,
            'company_name' => $agency->company_name,
            'owner_name' => $agency->owner_name,
            'license_type' => strtoupper($agency->license_type ?? 'hajj'),
            'hajj_license_no' => $agency->hajj_license_no,
            'umrah_license_no' => $agency->umrah_license_no,
            'formatted_license' => $agency->formatted_license_display,
            'haab_no' => $agency->haab_no ?? 'N/A',
            'trade_license_no' => $agency->trade_license_no ?? 'N/A',
            'nid_number' => $agency->nid_number ?? 'N/A',
            'phone' => $agency->phone,
            'whatsapp' => $agency->whatsapp ?: $agency->phone,
            'email' => $agency->email,
            'city' => $agency->city,
            'address' => $agency->address ?? 'N/A',
            'verification_status' => ucfirst($agency->verification_status),
            'is_phone_verified' => $agency->is_phone_verified,
            'license_document_url' => $agency->license_document ? asset('storage/' . $agency->license_document) : null,
            'trade_license_document_url' => $agency->trade_license_document ? asset('storage/' . $agency->trade_license_document) : null,
            'created_at' => $agency->created_at->format('d M, Y h:i A'),
            'posts_count' => $agency->posts->count(),
        ]);
    }

    /**
     * Approve Post as Special Offer Spotlight
     */
    public function approveSpecialOffer($id)
    {
        $post = Post::findOrFail($id);
        $post->is_special_offer = true;
        $post->special_offer_status = 'approved';
        $post->save();

        return back()->with('success', 'Post #' . $post->id . ' "' . $post->title . '" has been APPROVED as a Special Spotlight Offer on the Homepage!');
    }

    /**
     * Update Site Notice Ticker (Admins Only)
     */
    public function updateNoticeTicker(Request $request)
    {
        $text = $request->input('notice_ticker_text');
        $active = $request->has('notice_ticker_active') ? '1' : '0';

        SiteSetting::set('notice_ticker_text', $text);
        SiteSetting::set('notice_ticker_active', $active);

        return back()->with('success', 'Site Announcement Notice Ticker updated successfully!');
    }
}
