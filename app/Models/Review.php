<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'reviewer_agency_id',
        'target_agency_id',
        'post_inquiry_id',
        'rating',
        'comment',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    public function reviewerAgency()
    {
        return $this->belongsTo(Agency::class, 'reviewer_agency_id');
    }

    public function targetAgency()
    {
        return $this->belongsTo(Agency::class, 'target_agency_id');
    }

    public function postInquiry()
    {
        return $this->belongsTo(PostInquiry::class, 'post_inquiry_id');
    }
}
