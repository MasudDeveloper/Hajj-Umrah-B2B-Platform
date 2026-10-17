<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'agency_id',
        'type',
        'title',
        'message',
        'link',
        'data',
        'is_read',
    ];

    protected $casts = [
        'data' => 'array',
        'is_read' => 'boolean',
    ];

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public static function send($agencyId, $type, $title, $message, $link = null, $data = null)
    {
        return self::create([
            'agency_id' => $agencyId,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'link' => $link,
            'data' => $data,
            'is_read' => false,
        ]);
    }
}
