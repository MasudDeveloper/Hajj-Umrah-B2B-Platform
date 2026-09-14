<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();
            $agency = Auth::user();

            if ($agency->isAdmin()) {
                return redirect()->route('admin.dashboard')->with('success', 'Welcome Super Admin!');
            }

            if (!$agency->isApproved()) {
                return redirect()->route('home')->with('success', 'Logged in successfully! Your agency verification is currently PENDING approval by HAAB Admin.');
            }

            return redirect()->route('dashboard.index')->with('success', 'Welcome back, ' . $agency->agency_name);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our verified agency records.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'agency_name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'license_no' => 'required|string|max:100|unique:agencies,license_no',
            'haab_no' => 'nullable|string|max:100',
            'trade_license_no' => 'nullable|string|max:100',
            'owner_name' => 'required|string|max:255',
            'nid_number' => 'nullable|string|max:100',
            'phone' => 'required|string|max:50',
            'whatsapp' => 'nullable|string|max:50',
            'email' => 'required|email|max:255|unique:agencies,email',
            'password' => 'required|string|min:6|confirmed',
            'city' => 'required|string',
            'address' => 'nullable|string',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['is_admin'] = false;
        $validated['is_verified'] = false;
        $validated['verification_status'] = 'pending';
        $validated['subscription_plan'] = 'free';
        $validated['rating'] = 5.00;

        $agency = Agency::create($validated);

        Auth::login($agency);

        return redirect()->route('home')->with('success', 'Registration submitted successfully! Your account is PENDING verification by Super Admin for security compliance.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Logged out successfully.');
    }

    // Quick Role Switcher for instant testing between Admin, Verified Agency, and Guest
    public function quickSwitch($id)
    {
        if ($id == 0) {
            Auth::logout();
            return redirect()->route('home')->with('success', 'Switched to Guest / Public Visitor Mode.');
        }

        $agency = Agency::findOrFail($id);
        Auth::login($agency);

        if ($agency->isAdmin()) {
            return redirect()->route('admin.dashboard')->with('success', 'Switched context to Super Admin.');
        }

        return redirect()->route('home')->with('success', 'Switched context to ' . $agency->agency_name . ' (' . ucfirst($agency->verification_status) . ')');
    }
}
