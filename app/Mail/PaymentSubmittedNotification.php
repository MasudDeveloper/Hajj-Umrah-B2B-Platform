<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class PaymentSubmittedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $transaction;
    public $agency;

    public function __construct($transaction, $agency)
    {
        $this->transaction = $transaction;
        $this->agency = $agency;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Manual Payment Verification Request - ' . $this->agency->agency_name,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.payment_submitted',
        );
    }
}
