<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaxShareListing extends Model
{
    use HasFactory;

    protected $fillable = [
        'agency_id',
        'title',
        'package_type',
        'total_group_size',
        'vacant_seats',
        'departure_date',
        'return_date',
        'price_per_pax',
        'currency',
        'airline_name',
        'makkah_hotel',
        'distance_makkah_m',
        'madinah_hotel',
        'distance_madinah_m',
        'meals_included',
        'visa_included',
        'transport_included',
        'description',
        'status',
    ];

    protected $casts = [
        'departure_date' => 'date',
        'return_date' => 'date',
        'meals_included' => 'boolean',
        'visa_included' => 'boolean',
        'transport_included' => 'boolean',
        'price_per_pax' => 'decimal:2',
    ];

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }
}
