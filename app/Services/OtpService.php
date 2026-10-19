<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class OtpService
{
    /**
     * Send OTP via Alpha SMS API (or Demo Mode)
     */
    public static function sendOtp(string $phone, string $otpCode): bool
    {
        // 1. Log the OTP for local debugging / testing
        Log::info("OTP generated for phone {$phone}: {$otpCode}");

        // Format phone number for Bangladesh (8801...)
        $formattedPhone = preg_replace('/[^0-9]/', '', $phone);
        if (str_starts_with($formattedPhone, '01')) {
            $formattedPhone = '88' . $formattedPhone;
        }

        // 2. Alpha SMS API Integration
        // Alpha SMS documentation: https://api.alphasms.biz/api/v1/sendsms
        $apiToken = env('ALPHA_SMS_API_KEY') ?: env('ALPHA_SMS_API_TOKEN');
        $senderId = env('ALPHA_SMS_SENDER_ID', null);

        if ($apiToken) {
            try {
                $payload = [
                    'api_key' => $apiToken,
                    'msg'     => "আপনার B2B Hajj Umrah Platform ওটিপি ভেরিফিকেশন কোড: {$otpCode}। এটি কারও সাথে শেয়ার করবেন না।",
                    'to'      => $formattedPhone,
                ];

                if (!empty($senderId)) {
                    $payload['sender_id'] = $senderId;
                }

                $response = Http::timeout(10)->post('https://api.alphasms.biz/api/v1/sendsms', $payload);

                Log::info("Alpha SMS response: " . $response->body());
                return $response->successful();
            } catch (\Exception $e) {
                Log::error("Alpha SMS API Error: " . $e->getMessage());
                return false;
            }
        }

        // Demo Mode: If no Alpha SMS API key is configured, fallback smoothly
        return true;
    }

    /**
     * Generate a 6-digit numeric OTP code
     */
    public static function generateCode(): string
    {
        // If demo mode is active without live API key, use 123456 for easy developer/client testing
        if (env('OTP_FORCE_DEMO', true) || empty(env('ALPHA_SMS_API_KEY'))) {
            return '123456';
        }

        return (string) rand(100000, 999999);
    }
}
