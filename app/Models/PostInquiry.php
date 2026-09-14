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
        'message',
        'status',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function inquiringAgency()
    {
        return $this->belongsTo(Agency::class, 'inquiring_agency_id');
    }
}
