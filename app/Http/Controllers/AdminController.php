<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\Post;
use App\Models\PostInquiry;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $pendingAgencies = Agency::where('verification_status', 'pending')->orderBy('created_at', 'desc')->get();
        $verifiedAgencies = Agency::where('verification_status', 'approved')->where('is_admin', false)->orderBy('created_at', 'desc')->get();
        
        $totalAgencies = Agency::count();
        $totalPendingCount = $pendingAgencies->count();
        $totalVerifiedCount = $verifiedAgencies->count();
        $totalPostsCount = Post::count();
        $totalInquiriesCount = PostInquiry::count();

        return view('admin.dashboard', compact(
            'pendingAgencies',
            'verifiedAgencies',
            'totalAgencies',
            'totalPendingCount',
            'totalVerifiedCount',
            'totalPostsCount',
            'totalInquiriesCount'
        ));
    }

    public function approveAgency($id)
    {
        $agency = Agency::findOrFail($id);
        $agency->is_verified = true;
        $agency->verification_status = 'approved';
        $agency->save();

        return back()->with('success', 'Agency "' . $agency->agency_name . '" (License: ' . $agency->license_no . ') has been APPROVED and verified!');
    }

    public function rejectAgency($id)
    {
        $agency = Agency::findOrFail($id);
        $agency->is_verified = false;
        $agency->verification_status = 'rejected';
        $agency->save();

        return back()->with('success', 'Agency "' . $agency->agency_name . '" verification status set to REJECTED.');
    }

    public function toggleSubscription(Request $request, $id)
    {
        $agency = Agency::findOrFail($id);
        $agency->subscription_plan = $request->get('subscription_plan', 'monthly_b2b');
        $agency->save();

        return back()->with('success', 'Agency subscription updated to ' . strtoupper($agency->subscription_plan));
    }
}
