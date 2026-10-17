<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'agency_id',
        'plan_name',
        'amount',
        'starts_at',
        'ends_at',
        'status',
        'transaction_id',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'amount' => 'decimal:2',
    ];

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function isActive()
    {
        return $this->status === 'active' && $this->ends_at && $this->ends_at->isFuture();
    }
}
