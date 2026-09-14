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

// 2. Authentication & Verification Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Quick Test Role Switcher (For easy demonstration)
Route::get('/quick-switch/{id}', [AuthController::class, 'quickSwitch'])->name('quick.switch');

// 3. Super Admin Verification Panel
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/approve/{id}', [AdminController::class, 'approveAgency'])->name('approve');
    Route::post('/reject/{id}', [AdminController::class, 'rejectAgency'])->name('reject');
    Route::post('/subscription/{id}', [AdminController::class, 'toggleSubscription'])->name('subscription');
});

// 4. Multi-Category B2B Posts (Group Seats, Tickets, Hotel Share)
Route::prefix('posts')->name('posts.')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/create', [PostController::class, 'create'])->name('create');
    Route::post('/', [PostController::class, 'store'])->name('store');
    Route::get('/{id}', [PostController::class, 'show'])->name('show');
    Route::get('/{id}/quotation', [PostController::class, 'quotation'])->name('quotation');
    Route::post('/inquiry', [PostController::class, 'storeInquiry'])->name('inquiry');
    Route::post('/status/{id}', [PostController::class, 'updateStatus'])->name('status');
});

// 5. Agency Dashboard & Incoming B2B Leads
Route::get('/dashboard', [PostController::class, 'dashboard'])->name('dashboard.index');
