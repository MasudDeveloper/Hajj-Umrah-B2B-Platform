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
        'license_type',
        'hajj_license_no',
        'umrah_license_no',
        'license_no',
        'haab_no',
        'trade_license_no',
        'owner_name',
        'nid_number',
        'phone',
        'is_phone_verified',
        'otp_code',
        'whatsapp',
        'email',
        'password',
        'city',
        'country',
        'address',
        'license_document',
        'trade_license_document',
        'is_admin',
        'is_verified',
        'verification_status',
        'verification_submitted_at',
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
        'is_phone_verified' => 'boolean',
        'verification_submitted_at' => 'datetime',
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

    public static function formatLicensePrefixed(?string $number, string $prefix): ?string
    {
        if (!$number) return null;
        $trimmed = trim($number);
        if (str_starts_with(strtoupper($trimmed), strtoupper($prefix) . '-')) {
            return $trimmed;
        }
        return strtoupper($prefix) . '-' . ltrim($trimmed, '- ');
    }

    public function getFormattedLicenseDisplayAttribute(): string
    {
        $licenses = [];
        if ($this->hajj_license_no) {
            $licenses[] = self::formatLicensePrefixed($this->hajj_license_no, 'HL');
        }
        if ($this->umrah_license_no) {
            $licenses[] = self::formatLicensePrefixed($this->umrah_license_no, 'UL');
        }
        if (!empty($licenses)) {
            return implode(' / ', $licenses);
        }
        return $this->license_no ?? 'N/A';
    }

    public function isPhoneVerified(): bool
    {
        return $this->is_phone_verified === true;
    }

    public function hasSubmittedVerification(): bool
    {
        return !empty($this->license_document) || !empty($this->verification_submitted_at) || !empty($this->trade_license_document);
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
