<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostInquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'inquiring_agency_id',
        'requested_seats',
        'offered_price_per_seat',
        'message',
        'seller_note',
        'advance_amount_agreed',
        'status',
        'seller_deal_done',
        'buyer_deal_done',
        'contract_number',
        'deal_completed_at',
    ];

    protected $casts = [
        'seller_deal_done' => 'boolean',
        'buyer_deal_done' => 'boolean',
        'deal_completed_at' => 'datetime',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function inquiringAgency()
    {
        return $this->belongsTo(Agency::class, 'inquiring_agency_id');
    }

    public function sellerAgency()
    {
        return $this->post ? $this->post->agency() : null;
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed' || ($this->seller_deal_done && $this->buyer_deal_done);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'post_inquiry_id');
    }

    public function hasReviewedBy($agencyId): bool
    {
        return $this->reviews()->where('reviewer_agency_id', $agencyId)->exists();
    }

    public static function generateContractNumber(): string
    {
        return 'B2B-CONTRACT-' . date('Y') . '-' . strtoupper(substr(uniqid(), -6));
    }
}
