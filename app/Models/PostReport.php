<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'reporter_agency_id',
        'offending_agency_id',
        'original_post_id',
        'reason',
        'details',
        'proof_file',
        'status',
        'admin_notes',
        'reviewed_by',
        'reviewed_at',
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function reporterAgency()
    {
        return $this->belongsTo(Agency::class, 'reporter_agency_id');
    }

    public function offendingAgency()
    {
        return $this->belongsTo(Agency::class, 'offending_agency_id');
    }

    public function originalPost()
    {
        return $this->belongsTo(Post::class, 'original_post_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(Agency::class, 'reviewed_by');
    }

    public static function reasonLabel($reason)
    {
        return match ($reason) {
            'unauthorized_resale' => 'অননুমোদিত রিসেল / আমার সিটের ডুপ্লিকেট (Unauthorized Resale)',
            'ghost_seats'         => 'ভুয়া সিট / ইনভেন্টরি নেই (Ghost / Unavailable Seats)',
            'misleading_info'     => 'বিভ্রান্তিকর তথ্য / মিথ্যা বিবরণ (Misleading Info)',
            'price_gouging'       => 'অস্বাভাবিক অতিরিক্ত মূল্য / প্রতারণা (Price Manipulation)',
            default               => 'অন্যান্য অভিযোগ (Other Violation)',
        };
    }
}
