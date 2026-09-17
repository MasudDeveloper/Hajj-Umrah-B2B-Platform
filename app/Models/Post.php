<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'agency_id',
        'title',
        'post_category',
        'hajj_or_umrah',
        'requirement_type',
        'total_group_size',
        'available_seats',
        'flight_date',
        'departure_time',
        'arrival_time',
        'return_date',
        'duration_days',
        'airline',
        'flight_transit',
        'transit_duration',
        'departure_city',
        'package_tier',
        'room_type',
        'makkah_hotel',
        'makkah_hotel_distance',
        'makkah_shuttle',
        'madinah_hotel',
        'madinah_hotel_distance',
        'price_per_seat',
        'advance_deposit',
        'name_deadline',
        'currency',
        'pnr_code',
        'baggage_allowance',
        'meals_included',
        'visa_included',
        'transport_included',
        'ziyarah_included',
        'guide_included',
        'zamzam_included',
        'allowed_gender',
        'passenger_type',
        'route_sequence',
        'catering_type',
        'transport_vehicle',
        'haramain_train',
        'agent_commission',
        'name_change_policy',
        'payment_terms',
        'hajj_tent_category',
        'visa_type',
        'makkah_hotel_type',
        'madinah_hotel_type',
        'itinerary_pdf',
        'details',
        'status',
        'is_special_offer',
        'special_offer_status',
    ];

    protected $casts = [
        'flight_date' => 'date',
        'return_date' => 'date',
        'name_deadline' => 'date',
        'meals_included' => 'boolean',
        'visa_included' => 'boolean',
        'transport_included' => 'boolean',
        'makkah_shuttle' => 'boolean',
        'ziyarah_included' => 'boolean',
        'guide_included' => 'boolean',
        'zamzam_included' => 'boolean',
        'haramain_train' => 'boolean',
        'is_special_offer' => 'boolean',
        'price_per_seat' => 'decimal:2',
        'advance_deposit' => 'decimal:2',
        'agent_commission' => 'decimal:2',
    ];

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function inquiries()
    {
        return $this->hasMany(PostInquiry::class);
    }

    public function pendingSeats()
    {
        return (int) $this->inquiries()
            ->whereIn('status', ['pending', 'accepted'])
            ->sum('requested_seats');
    }
}

