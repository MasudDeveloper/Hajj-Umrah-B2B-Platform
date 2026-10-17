<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\PostInquiry;
use App\Models\Review;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Store a newly created review in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Please log in to submit a review.'], 401);
            }
            return redirect()->route('login')->with('error', 'Please log in to submit a review.');
        }

        $validated = $request->validate([
            'target_agency_id' => 'required|exists:agencies,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
            'post_inquiry_id' => 'nullable|exists:post_inquiries,id',
        ]);

        $reviewer = Auth::user();
        $targetAgencyId = (int) $validated['target_agency_id'];

        if ($reviewer->id === $targetAgencyId) {
            $msg = 'নিজ এজেন্সিকে রিভিউ দেওয়া সম্ভব নয়।';
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json(['success' => false, 'message' => $msg], 422);
            }
            return back()->with('error', $msg);
        }

        $inquiryId = $validated['post_inquiry_id'] ?? null;
        if ($inquiryId) {
            $inquiry = PostInquiry::with('post')->findOrFail($inquiryId);
            
            // Check authorization to review this inquiry
            $isSeller = ($inquiry->post->agency_id === $reviewer->id);
            $isBuyer = ($inquiry->inquiring_agency_id === $reviewer->id);

            if (!$isSeller && !$isBuyer) {
                $msg = 'এই ডিলের সাথে আপনার সংশ্লিষ্টতা নেই।';
                if ($request->expectsJson() || $request->ajax()) {
                    return response()->json(['success' => false, 'message' => $msg], 403);
                }
                return back()->with('error', $msg);
            }

            // Check if already reviewed
            $alreadyReviewed = Review::where('reviewer_agency_id', $reviewer->id)
                ->where('post_inquiry_id', $inquiryId)
                ->exists();

            if ($alreadyReviewed) {
                $msg = 'আপনি ইতিমধ্যে এই সফল লেনদেনের জন্য রিভিউ দিয়েছেন।';
                if ($request->expectsJson() || $request->ajax()) {
                    return response()->json(['success' => false, 'message' => $msg], 422);
                }
                return back()->with('error', $msg);
            }
        }

        // Create review
        $review = Review::create([
            'reviewer_agency_id' => $reviewer->id,
            'target_agency_id' => $targetAgencyId,
            'post_inquiry_id' => $inquiryId,
            'rating' => (int) $validated['rating'],
            'comment' => $validated['comment'] ?? null,
        ]);

        // Recalculate target agency rating
        $targetAgency = Agency::find($targetAgencyId);
        if ($targetAgency) {
            $targetAgency->recalculateRating();

            // Send notification to target agency
            Notification::send(
                $targetAgency->id,
                'review_received',
                '⭐ নতুন রিভিউ ও রেটিং পেয়েছেন!',
                $reviewer->agency_name . ' আপনাকে একটি ' . $review->rating . '★ রিভিউ এবং রেটিং দিয়েছেন।',
                route('agencies.show', $targetAgency->id)
            );
        }

        $successMsg = 'আপনার রিভিউ ও রেটিং সফলভাবে জমা হয়েছে! ধন্যবাদ।';

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $successMsg,
                'review' => $review->load('reviewerAgency'),
            ]);
        }

        return back()->with('success', $successMsg);
    }
}
