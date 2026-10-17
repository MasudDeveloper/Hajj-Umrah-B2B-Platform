<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value'];

    /**
     * Get setting value by key with fallback default
     */
    public static function get(string $key, ?string $default = null): ?string
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * Set setting key-value pair
     */
    public static function set(string $key, ?string $value): void
    {
        self::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }

    /**
     * Check if platform is running in 100% Free Mode
     */
    public static function isFreeMode(): bool
    {
        return self::get('platform_monetization_mode', 'free') === 'free';
    }

    /**
     * Check if platform is running in Paid VIP Subscription Mode
     */
    public static function isPaidMode(): bool
    {
        return self::get('platform_monetization_mode', 'free') === 'paid';
    }
}
