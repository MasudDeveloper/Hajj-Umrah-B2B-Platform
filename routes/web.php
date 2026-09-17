<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;

// 1. Home / Landing Page
Route::get('/', [PostController::class, 'home'])->name('home');

// Language Switcher Route
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['bn', 'en'])) {
        session(['locale' => $locale]);
    }
    return back();
})->name('lang.switch');

// 2. Authentication & 2-Step Verification Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// OTP Phone Verification Routes
Route::get('/register/otp', [AuthController::class, 'showOtp'])->name('verification.otp');
Route::post('/register/otp', [AuthController::class, 'verifyOtp'])->name('verification.otp.submit');
Route::post('/register/otp/resend', [AuthController::class, 'resendOtp'])->name('verification.otp.resend');

// Agency License Information & Document Verification Portal
Route::get('/agency/verification', [AuthController::class, 'showVerificationPortal'])->name('verification.portal');
Route::post('/agency/verification', [AuthController::class, 'submitVerification'])->name('verification.submit');

// Quick Test Role Switcher (For easy demonstration)
Route::get('/quick-switch/{id}', [AuthController::class, 'quickSwitch'])->name('quick.switch');

// 3. Super Admin Control Panel (Dedicated Multi-Page Routes)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/verifications', [AdminController::class, 'verifications'])->name('verifications');
    Route::get('/agencies', [AdminController::class, 'agencies'])->name('agencies');
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    
    // Notice Ticker & Settings Actions
    Route::post('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');
    Route::post('/notice-ticker', [AdminController::class, 'updateNoticeTicker'])->name('notice.ticker');
    Route::post('/approve/{id}', [AdminController::class, 'approveAgency'])->name('approve');
    Route::post('/reject/{id}', [AdminController::class, 'rejectAgency'])->name('reject');
    Route::post('/subscription/{id}', [AdminController::class, 'toggleSubscription'])->name('subscription');
    
    // 1-Click Agency Impersonation Routes
    Route::post('/impersonate/{id}', [AdminController::class, 'impersonate'])->name('impersonate');
    Route::get('/stop-impersonation', [AdminController::class, 'stopImpersonation'])->name('stop.impersonation');
    Route::post('/special-offer/approve/{id}', [AdminController::class, 'approveSpecialOffer'])->name('special.approve');
    
    // Agency Details JSON for Inspection Modal
    Route::get('/agency/{id}', [AdminController::class, 'agencyDetails'])->name('agency.details');
});

// 4. Multi-Category B2B Posts (Group Seats, Tickets, Hotel Share)
Route::prefix('posts')->name('posts.')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/create', [PostController::class, 'create'])->name('create');
    Route::post('/', [PostController::class, 'store'])->name('store');
    Route::get('/{id}', [PostController::class, 'show'])->name('show');
    Route::get('/{id}/quotation', [PostController::class, 'quotation'])->name('quotation');
    Route::post('/inquiry', [PostController::class, 'storeInquiry'])->name('inquiry');
    Route::post('/inquiry/{id}/respond', [PostController::class, 'respondInquiry'])->name('inquiry.respond');
    Route::post('/inquiry/{id}/confirm-deal', [PostController::class, 'confirmDeal'])->name('inquiry.confirm_deal');
    Route::get('/inquiry/{id}/contract', [PostController::class, 'contractView'])->name('inquiry.contract');
    Route::get('/inquiry/{id}/quotation-letter', [PostController::class, 'quotationLetterView'])->name('inquiry.quotation_letter');
    Route::post('/status/{id}', [PostController::class, 'updateStatus'])->name('status');
    Route::post('/{id}/adjust-seats', [PostController::class, 'adjustSeats'])->name('adjust_seats');
});

// 5. Agency Dashboard & Incoming B2B Leads
Route::get('/dashboard', [PostController::class, 'dashboard'])->name('dashboard.index');
