<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_agency_name',
        'sender_phone',
        'sender_email',
        'listing_type',
        'listing_id',
        'requested_seats',
        'message',
        'status',
    ];
}
