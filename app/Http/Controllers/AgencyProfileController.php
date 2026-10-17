<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\Review;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AgencyProfileController extends Controller
{
    /**
     * Show public profile of an agency, with ratings, reviews, and active listings.
     */
    public function show($id)
    {
        $agency = Agency::with(['reviewsReceived.reviewerAgency', 'posts' => function ($q) {
            $q->where('status', 'open')->latest();
        }])->findOrFail($id);

        $totalReviews = $agency->reviewsReceived->count();
        $averageRating = $agency->average_rating;

        // Calculate breakdown for 1 to 5 stars
        $starCounts = [
            5 => $agency->reviewsReceived->where('rating', 5)->count(),
            4 => $agency->reviewsReceived->where('rating', 4)->count(),
            3 => $agency->reviewsReceived->where('rating', 3)->count(),
            2 => $agency->reviewsReceived->where('rating', 2)->count(),
            1 => $agency->reviewsReceived->where('rating', 1)->count(),
        ];

        $starPercentages = [];
        foreach ($starCounts as $star => $count) {
            $starPercentages[$star] = $totalReviews > 0 ? round(($count / $totalReviews) * 100) : 0;
        }

        return view('agency.profile', compact('agency', 'totalReviews', 'averageRating', 'starCounts', 'starPercentages'));
    }

    /**
     * Show agency settings & profile edit view for authenticated user.
     */
    public function edit()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $agency = Auth::user();
        return view('agency.edit', compact('agency'));
    }

    /**
     * Update agency profile information & logo.
     */
    public function update(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $agency = Auth::user();

        $validated = $request->validate([
            'agency_name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'email' => 'required|email|max:255|unique:agencies,email,' . $agency->id,
            'city' => 'required|string|max:100',
            'address' => 'nullable|string|max:500',
            'website' => 'nullable|url|max:255',
            'bio' => 'nullable|string|max:1000',
            'haab_no' => 'nullable|string|max:100',
            'atab_no' => 'nullable|string|max:100',
            'hajj_license_no' => 'nullable|string|max:100',
            'umrah_license_no' => 'nullable|string|max:100',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = 'agency_' . $agency->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/logos');
            
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            
            $file->move($destinationPath, $filename);
            $validated['logo'] = 'uploads/logos/' . $filename;
        }

        $agency->update($validated);

        return back()->with('success', 'এজেন্সি প্রোফাইল সফলভাবে আপডেট করা হয়েছে!');
    }

    /**
     * Update agency account password.
     */
    public function updatePassword(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'current_password' => 'required|string',
            'password' => ['required', 'confirmed', Password::min(6)],
        ]);

        $agency = Auth::user();

        if (!Hash::check($request->current_password, $agency->password)) {
            return back()->withErrors(['current_password' => 'বর্তমান পাসওয়ার্ডটি সঠিক নয়।']);
        }

        $agency->password = Hash::make($request->password);
        $agency->save();

        return back()->with('success', 'অ্যাকাউন্টের পাসওয়ার্ড সফলভাবে পরিবর্তন করা হয়েছে!');
    }
}
