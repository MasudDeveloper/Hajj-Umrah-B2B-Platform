<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketListing extends Model
{
    use HasFactory;

    protected $fillable = [
        'agency_id',
        'title',
        'airline_name',
        'route_from',
        'route_to',
        'flight_type',
        'flight_date',
        'return_date',
        'total_tickets',
        'available_tickets',
        'price_per_ticket',
        'currency',
        'pnr_status',
        'baggage_allowance',
        'description',
        'status',
    ];

    protected $casts = [
        'flight_date' => 'date',
        'return_date' => 'date',
        'price_per_ticket' => 'decimal:2',
    ];

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }
}
