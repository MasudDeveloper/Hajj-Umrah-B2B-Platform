<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Subscription;
use App\Mail\PaymentSubmittedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function checkout()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        return view('payment.checkout');
    }

    public function submitPayment(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|string|in:bkash,nagad,rocket,upay',
            'sender_number' => 'required|string',
            'transaction_id' => 'required|string|unique:transactions,transaction_id',
            'plan_name' => 'required|string|in:monthly,yearly',
        ]);

        $agency = Auth::user();
        $amount = $request->plan_name == 'yearly' ? 5000 : 500;

        $transaction = Transaction::create([
            'agency_id' => $agency->id,
            'transaction_id' => $request->transaction_id,
            'amount' => $amount,
            'currency' => 'BDT',
            'payment_method' => $request->payment_method,
            'status' => 'pending',
            'type' => 'subscription',
            'gateway_response' => [
                'sender_number' => $request->sender_number
            ]
        ]);

        Subscription::create([
            'agency_id' => $agency->id,
            'plan_name' => $request->plan_name,
            'amount' => $amount,
            'status' => 'pending',
            'transaction_id' => $transaction->id,
        ]);

        // Send email to admin
        try {
            Mail::to('admin@example.com')->send(new PaymentSubmittedNotification($transaction, $agency));
        } catch (\Exception $e) {
            // Log or ignore if mail fails locally due to missing SMTP
        }

        return redirect()->route('dashboard.index')->with('payment_submitted', true);
    }
}
