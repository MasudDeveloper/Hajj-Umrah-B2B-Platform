<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

            if (!$agency->isPhoneVerified()) {
                return redirect()->route('verification.otp')->with('success', 'Please verify your phone number via OTP code.');
            }

            if (!$agency->hasSubmittedVerification()) {
                return redirect()->route('verification.portal')->with('success', 'Please complete your agency verification details & upload license documents.');
            }

            if (!$agency->isApproved()) {
                return redirect()->route('verification.portal')->with('success', 'Logged in successfully! Your agency verification status is PENDING approval by Super Admin.');
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
            'phone' => 'required|string|max:50|unique:agencies,phone',
            'email' => 'required|email|max:255|unique:agencies,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $otpCode = OtpService::generateCode();

        $agency = Agency::create([
            'agency_name' => $validated['agency_name'],
            'company_name' => $validated['agency_name'] . ' Ltd.',
            'license_no' => 'PENDING-LIC-' . rand(10000, 99999),
            'owner_name' => 'Agency Owner',
            'phone' => $validated['phone'],
            'is_phone_verified' => false,
            'otp_code' => $otpCode,
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'city' => 'Dhaka',
            'country' => 'Bangladesh',
            'is_admin' => false,
            'is_verified' => false,
            'verification_status' => 'pending',
            'subscription_plan' => 'free',
            'rating' => 5.00,
        ]);

        // Send Demo / Alpha SMS OTP
        OtpService::sendOtp($agency->phone, $otpCode);

        Auth::login($agency);

        return redirect()->route('verification.otp')->with('success', 'Registration Step 1 completed! Please enter the OTP code sent to ' . $agency->phone);
    }

    public function showOtp()
    {
        $agency = Auth::user();
        if (!$agency) {
            return redirect()->route('login');
        }

        if ($agency->isPhoneVerified()) {
            return redirect()->route('verification.portal');
        }

        return view('auth.otp', compact('agency'));
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp_code' => 'required|string',
        ]);

        $agency = Auth::user();
        if (!$agency) {
            return redirect()->route('login');
        }

        // Validate OTP code against stored code or demo fallback '123456'
        if ($request->otp_code === $agency->otp_code || $request->otp_code === '123456') {
            $agency->is_phone_verified = true;
            $agency->otp_code = null;
            $agency->save();

            return redirect()->route('verification.portal')->with('success', 'Mobile phone number verified successfully! Now please submit your agency license information & document hardcopies.');
        }

        return back()->withErrors(['otp_code' => 'Invalid OTP code. Please enter 123456 (Demo Code) or request a resend.']);
    }

    public function resendOtp()
    {
        $agency = Auth::user();
        if (!$agency) {
            return redirect()->route('login');
        }

        $otpCode = OtpService::generateCode();
        $agency->otp_code = $otpCode;
        $agency->save();

        OtpService::sendOtp($agency->phone, $otpCode);

        return back()->with('success', 'New OTP code sent to ' . $agency->phone . ' (Demo Code: 123456)');
    }

    public function showVerificationPortal()
    {
        $agency = Auth::user();
        if (!$agency) {
            return redirect()->route('login');
        }

        return view('agency.verification', compact('agency'));
    }

    public function submitVerification(Request $request)
    {
        $agency = Auth::user();
        if (!$agency) {
            return redirect()->route('login');
        }

        $rules = [
            'agency_name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'license_type' => 'required|in:hajj,umrah,both',
            'hajj_license_no' => 'required_if:license_type,hajj,both|nullable|string|max:100',
            'umrah_license_no' => 'required_if:license_type,umrah,both|nullable|string|max:100',
            'whatsapp' => 'nullable|string|max:50',
            'city' => 'required|string',
            'address' => 'required|string',
            'haab_no' => 'nullable|string|max:100',
            'trade_license_no' => 'required|string|max:100',
            'license_document' => $agency->license_document ? 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120' : 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'trade_license_document' => $agency->trade_license_document ? 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120' : 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ];

        $validated = $request->validate($rules);

        if ($request->hasFile('license_document')) {
            $path = $request->file('license_document')->store('verification_docs', 'public');
            $agency->license_document = $path;
        }

        if ($request->hasFile('trade_license_document')) {
            $path = $request->file('trade_license_document')->store('verification_docs', 'public');
            $agency->trade_license_document = $path;
        }

        $licenseType = $validated['license_type'];
        $hajjNo = in_array($licenseType, ['hajj', 'both']) ? Agency::formatLicensePrefixed($validated['hajj_license_no'] ?? null, 'HL') : null;
        $umrahNo = in_array($licenseType, ['umrah', 'both']) ? Agency::formatLicensePrefixed($validated['umrah_license_no'] ?? null, 'UL') : null;

        $agency->agency_name = $validated['agency_name'];
        $agency->company_name = $validated['company_name'];
        $agency->owner_name = $validated['owner_name'];
        $agency->license_type = $licenseType;
        $agency->hajj_license_no = $hajjNo;
        $agency->umrah_license_no = $umrahNo;
        
        $combined = array_filter([$hajjNo, $umrahNo]);
        $agency->license_no = !empty($combined) ? implode(' / ', $combined) : 'PENDING-LIC';

        $agency->whatsapp = $validated['whatsapp'] ?? $agency->phone;
        $agency->city = $validated['city'];
        $agency->address = $validated['address'];
        $agency->haab_no = $validated['haab_no'] ?? null;
        $agency->trade_license_no = $validated['trade_license_no'];
        $agency->verification_submitted_at = now();
        $agency->verification_status = 'pending';
        $agency->save();

        return redirect()->route('verification.portal')->with('success', 'Agency verification information & license documents submitted successfully! Your application is PENDING review by Super Admin.');
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
