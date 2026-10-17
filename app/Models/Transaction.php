<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'agency_id',
        'transaction_id',
        'amount',
        'currency',
        'payment_method',
        'status',
        'type',
        'reference_id',
        'gateway_response',
    ];

    protected $casts = [
        'gateway_response' => 'array',
        'amount' => 'decimal:2',
    ];

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }
}
