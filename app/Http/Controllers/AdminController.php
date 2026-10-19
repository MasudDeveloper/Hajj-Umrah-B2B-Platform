<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\Post;
use App\Models\PostInquiry;
use App\Models\SiteSetting;
use App\Models\Transaction;
use App\Models\Subscription;
use App\Models\Notification;
use App\Models\PostReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

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
        $totalCompletedDeals = PostInquiry::where('status', 'completed')->count();
        $totalPendingTransactions = Transaction::where('status', 'pending')->count();
        $totalRevenue = Transaction::where('status', 'approved')->sum('amount');
        $currentPlatformMode = SiteSetting::get('platform_monetization_mode', 'free');
        $totalReportsCount = PostReport::count();
        $pendingReportsCount = PostReport::where('status', 'pending')->count();

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

        // Dynamic Division & District Distribution of Registered Agencies
        $divisions = ['Dhaka', 'Chittagong', 'Sylhet', 'Rajshahi', 'Khulna', 'Barisal', 'Rangpur', 'Mymensingh'];
        $divisionStats = [];
        foreach ($divisions as $div) {
            $divisionStats[$div] = Agency::where(function($q) use ($div) {
                $q->where('city', $div)
                  ->orWhere('city', 'like', "%{$div}%")
                  ->orWhere('address', 'like', "%{$div}%");
            })->where('is_admin', false)->count();
        }
        $cityChart = $divisionStats;

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
            'totalCompletedDeals',
            'totalPendingTransactions',
            'totalRevenue',
            'totalReportsCount',
            'pendingReportsCount',
            'currentPlatformMode',
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
            'platform_monetization_mode' => SiteSetting::get('platform_monetization_mode', 'free'),
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
            'platform_monetization_mode' => 'nullable|string|in:free,paid',
        ]);

        foreach (['site_phone', 'site_whatsapp', 'site_email', 'site_address', 'site_notice', 'platform_monetization_mode'] as $key) {
            if ($request->has($key)) {
                SiteSetting::set($key, $request->input($key));
            }
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
    public function rejectAgency(Request $request, $id)
    {
        $agency = Agency::findOrFail($id);
        $agency->is_verified = false;
        $agency->verification_status = 'rejected';
        $reason = $request->input('rejection_reason');
        if (empty(trim($reason))) {
            $reason = 'দাখিলকৃত লাইসেন্স বা ট্রেড লাইসেন্সের কাগজপত্র অসম্পূর্ণ, অস্পষ্ট বা সরকারি রেকর্ডের সাথে অমিল রয়েছে।';
        }
        $agency->rejection_reason = $reason;
        $agency->save();

        // Send alert notification to the agency
        Notification::send(
            $agency->id,
            'verification_rejected',
            '❌ এজেন্সির ভেরিফিকেশন আবেদন বাতিল হয়েছে',
            'কারণ: ' . $reason . ' - অনুগ্রহ করে ভেরিফিকেশন পোর্টালে গিয়ে সঠিক কাগজপত্র পুনরায় আপলোড করুন।',
            route('verification.portal')
        );

        return back()->with('success', 'Agency "' . $agency->agency_name . '" verification status set to REJECTED. Reason recorded & agency notified.');
    }

    /**
     * Toggle Platform Access Mode: Free vs Paid VIP Mode
     */
    public function togglePlatformMode(Request $request)
    {
        $mode = $request->input('mode', 'free');
        SiteSetting::set('platform_monetization_mode', $mode);
        $msg = ($mode === 'free') 
            ? 'প্ল্যাটফর্ম সম্পূর্ণ ফ্রি মোডে (100% Free Mode) চালু করা হয়েছে। সকল ভেরিফাইড এজেন্সির জন্য আনলিমিটেড অ্যাক্সেস সক্রিয়।' 
            : 'পেইড সাবস্ক্রিপশন মোড (Paid B2B Subscription Mode) সক্রিয় করা হয়েছে।';

        return back()->with('success', $msg);
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
    /**
     * View Transactions
     */
    public function transactions()
    {
        $transactions = Transaction::with('agency')->orderBy('created_at', 'desc')->get();
        return view('admin.transactions', compact('transactions'));
    }

    /**
     * Approve Transaction
     */
    public function approveTransaction($id)
    {
        $transaction = Transaction::findOrFail($id);
        
        if ($transaction->status === 'completed') {
            return back()->with('error', 'Transaction is already completed.');
        }

        $transaction->status = 'completed';
        $transaction->save();

        if ($transaction->type === 'subscription') {
            $subscription = Subscription::where('transaction_id', $transaction->id)->first();
            if ($subscription) {
                $subscription->status = 'active';
                $subscription->starts_at = now();
                $subscription->ends_at = $subscription->plan_name === 'yearly' ? now()->addYear() : now()->addMonths(1);
                $subscription->save();
                
                $agency = $transaction->agency;
                if ($agency) {
                    $agency->subscription_plan = $subscription->plan_name;
                    $agency->save();
                }
            }
        }

        // Notify agency
        Notification::send(
            $transaction->agency_id,
            'payment_approved',
            'পেমেন্ট অনুমোদিত হয়েছে!',
            'আপনার সাবস্ক্রিপশন ট্রানজাকশন #' . $transaction->transaction_id . ' (৳' . number_format($transaction->amount) . ') সফলভাবে অনুমোদিত হয়েছে।',
            route('dashboard.index')
        );

        return back()->with('success', 'Transaction #' . $transaction->transaction_id . ' Approved Successfully!');
    }

    /**
     * Reject Transaction
     */
    public function rejectTransaction($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->status = 'failed'; // or rejected
        $transaction->save();

        if ($transaction->type === 'subscription') {
            $subscription = Subscription::where('transaction_id', $transaction->id)->first();
            if ($subscription) {
                $subscription->status = 'cancelled';
                $subscription->save();
            }
        }

        // Notify agency
        Notification::send(
            $transaction->agency_id,
            'payment_rejected',
            'পেমেন্ট বাতিল হয়েছে',
            'আপনার ট্রানজাকশন #' . $transaction->transaction_id . ' বাতিল করা হয়েছে। তথ্যাদি যাচাই করে পুনরায় চেষ্টা করুন।',
            route('payment.checkout')
        );

        return back()->with('success', 'Transaction #' . $transaction->transaction_id . ' has been Rejected.');
    }

    /**
     * Run manual platform maintenance cleanup (Cron job trigger).
     */
    public function runCleanup()
    {
        Artisan::call('platform:cleanup');
        return back()->with('success', 'প্ল্যাটফর্মের অটোমেটেড ক্লিনআপ (মেয়াদোত্তীর্ণ পোস্ট ও স্টেল প্রস্তাব বাতিল) সফলভাবে সম্পন্ন হয়েছে!');
    }

    /**
     * Disputes & Post Reports Governance Center
     */
    public function reports(Request $request)
    {
        $status = $request->get('status', 'all');

        $query = PostReport::with(['post.agency', 'reporterAgency', 'offendingAgency', 'originalPost', 'reviewer'])
            ->latest();

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $reports = $query->paginate(15)->withQueryString();

        $metrics = [
            'total' => PostReport::count(),
            'pending' => PostReport::where('status', 'pending')->count(),
            'resolved' => PostReport::where('status', 'resolved_removed')->count(),
            'dismissed' => PostReport::where('status', 'dismissed')->count(),
        ];

        return view('admin.reports', compact('reports', 'metrics', 'status'));
    }

    /**
     * Approve Report: Suspend offending post & penalize offending agency
     */
    public function approveReport(Request $request, $id)
    {
        $report = PostReport::with(['post', 'offendingAgency', 'reporterAgency'])->findOrFail($id);

        $adminNotes = $request->input('admin_notes', 'ডুপ্লিকেট ও অননুমোদিত সিটের অভিযোগ প্রমাণিত হওয়ায় পোস্টটি বাতিল করা হয়েছে।');

        // Suspend the reported post
        if ($report->post) {
            $report->post->update([
                'status' => 'suspended',
                'is_reported' => true,
            ]);
        }

        // Add strike to offending agency
        if ($report->offendingAgency) {
            $report->offendingAgency->increment('strike_count');
        }

        // Update report status
        $report->update([
            'status' => 'resolved_removed',
            'admin_notes' => $adminNotes,
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        // Send alert notification to offending agency
        Notification::send(
            $report->offending_agency_id,
            'strike_warning',
            '⚠️ সতর্কবার্তা: আপনার পোস্টটি স্থগিত করা হয়েছে',
            "পোস্ট #{$report->post_id} ডুপ্লিকেট/অনুমতিহীন হওয়ায় সুপার এডমিন কর্তৃক বাতিল করা হয়েছে এবং আপনার অ্যাকাউন্টে ১টি স্ট্রাইক যোগ হয়েছে। (বর্তমান স্ট্রাইক: {$report->offendingAgency->strike_count})",
            route('dashboard.index')
        );

        // Send confirmation notification to reporter agency
        Notification::send(
            $report->reporter_agency_id,
            'dispute_resolved',
            '✅ আপনার অভিযোগটি কার্যকর হয়েছে',
            "পোস্ট #{$report->post_id} এর বিরুদ্ধে আপনার রিপোর্টটি সত্য প্রমাণিত হয়েছে এবং উক্ত ডুপ্লিকেট পোস্টটি মার্কেটপ্লেস থেকে প্রত্যাহার করা হয়েছে।",
            route('dashboard.index')
        );

        return back()->with('success', "অভিযোগটি সফলভাবে কার্যকর হয়েছে! পোস্ট #{$report->post_id} সাসপেন্ড করা হয়েছে এবং অভিযুক্ত এজেন্সিকে ১টি স্ট্রাইক দেওয়া হয়েছে।");
    }

    /**
     * Dismiss Report: Dismiss false/unfounded report & keep post live
     */
    public function dismissReport(Request $request, $id)
    {
        $report = PostReport::with(['post', 'reporterAgency'])->findOrFail($id);

        $adminNotes = $request->input('admin_notes', 'যাচাই শেষে অভিযোগটি ভিত্তিহীন বা অপ্রমাণিত পাওয়ায় খারিজ করা হলো।');

        $report->update([
            'status' => 'dismissed',
            'admin_notes' => $adminNotes,
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        // If no other pending reports for this post, clear is_reported flag
        if ($report->post) {
            $hasOtherPending = PostReport::where('post_id', $report->post_id)
                ->where('status', 'pending')
                ->exists();

            if (!$hasOtherPending) {
                $report->post->update(['is_reported' => false]);
            }
        }

        // Notify reporter agency
        Notification::send(
            $report->reporter_agency_id,
            'dispute_dismissed',
            'আপনার অভিযোগ পর্যালোচনা সম্পন্ন হয়েছে',
            "পোস্ট #{$report->post_id} এর বিরুদ্ধে আপনার অভিযোগটি অ্যাডমিন কর্তৃক পর্যালোচনায় খারিজ করা হয়েছে। নোট: {$adminNotes}",
            route('dashboard.index')
        );

        return back()->with('success', "রিপোর্টটি সফলভাবে খারিজ করা হয়েছে এবং পোস্টটি লাইভ রাখা হয়েছে।");
    }
}
