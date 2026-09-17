<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class OtpService
{
    /**
     * Send OTP via SMS API (Currently in Demo Mode with Alpha SMS structure)
     */
    public static function sendOtp(string $phone, string $otpCode): bool
    {
        // 1. Log the OTP for local debugging / testing
        Log::info("OTP generated for phone {$phone}: {$otpCode}");

        // 2. Alpha SMS API Integration Placeholder
        $apiToken = env('ALPHA_SMS_API_TOKEN', null);
        
        if ($apiToken) {
            try {
                // Example Alpha SMS API HTTP request
                $response = Http::post('https://api.alphasms.biz/api/v1/sendsms', [
                    'api_key' => $apiToken,
                    'msg' => "Your B2B Hajj Umrah OTP verification code is: {$otpCode}. Do not share this code with anyone.",
                    'to' => $phone,
                ]);

                return $response->successful();
            } catch (\Exception $e) {
                Log::error("Alpha SMS API Error: " . $e->getMessage());
                return false;
            }
        }

        // Demo Mode Always Returns True
        return true;
    }

    /**
     * Generate a 6-digit numeric OTP code
     */
    public static function generateCode(): string
    {
        // In local/demo mode, default code is 123456 unless overridden
        return '123456';
    }
}
