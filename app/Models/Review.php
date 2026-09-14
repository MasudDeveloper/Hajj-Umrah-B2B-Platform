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
        'rating',
        'comment',
    ];

    public function reviewerAgency()
    {
        return $this->belongsTo(Agency::class, 'reviewer_agency_id');
    }

    public function targetAgency()
    {
        return $this->belongsTo(Agency::class, 'target_agency_id');
    }
}
