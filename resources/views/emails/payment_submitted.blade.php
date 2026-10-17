<div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
    <h2 style="color: #4F46E5; margin-bottom: 20px;">New Payment Submitted for Verification</h2>
    <div style="background: #f9fafb; padding: 15px; border-radius: 6px; margin-bottom: 20px;">
        <p style="margin: 5px 0;"><strong>Agency Name:</strong> {{ $agency->agency_name }}</p>
        <p style="margin: 5px 0;"><strong>Phone:</strong> {{ $agency->phone }}</p>
    </div>
    <div style="background: #fffbe8; padding: 15px; border: 1px solid #fde68a; border-radius: 6px;">
        <h3 style="margin-top: 0; color: #92400e;">Payment Details</h3>
        <p style="margin: 5px 0;"><strong>Payment Method:</strong> {{ strtoupper($transaction->payment_method) }}</p>
        <p style="margin: 5px 0;"><strong>Sender Number:</strong> {{ $transaction->gateway_response['sender_number'] ?? 'N/A' }}</p>
        <p style="margin: 5px 0;"><strong>Transaction ID:</strong> <span style="background: #e5e7eb; padding: 2px 6px; border-radius: 4px; font-family: monospace;">{{ $transaction->transaction_id }}</span></p>
        <p style="margin: 5px 0;"><strong>Amount:</strong> {{ $transaction->amount }} BDT</p>
    </div>
    <p style="margin-top: 20px; font-size: 14px; color: #6b7280;">Please verify this transaction in your merchant account and approve the subscription from the Admin Panel.</p>
</div>
