<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_inquiry_id',
        'sender_agency_id',
        'receiver_agency_id',
        'message',
        'attachment',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    public function inquiry()
    {
        return $this->belongsTo(PostInquiry::class, 'post_inquiry_id');
    }

    public function sender()
    {
        return $this->belongsTo(Agency::class, 'sender_agency_id');
    }

    public function receiver()
    {
        return $this->belongsTo(Agency::class, 'receiver_agency_id');
    }
}
