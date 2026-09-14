<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Agency extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'agency_name',
        'company_name',
        'license_no',
        'haab_no',
        'trade_license_no',
        'owner_name',
        'nid_number',
        'phone',
        'whatsapp',
        'email',
        'password',
        'city',
        'country',
        'address',
        'is_admin',
        'is_verified',
        'verification_status',
        'subscription_plan',
        'rating',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_admin' => 'boolean',
        'is_verified' => 'boolean',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function inquiriesSent()
    {
        return $this->hasMany(PostInquiry::class, 'inquiring_agency_id');
    }

    public function reviewsReceived()
    {
        return $this->hasMany(Review::class, 'target_agency_id');
    }

    public function isApproved(): bool
    {
        return $this->is_verified && $this->verification_status === 'approved';
    }

    public function isAdmin(): bool
    {
        return $this->is_admin === true;
    }
}
