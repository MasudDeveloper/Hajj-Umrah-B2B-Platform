<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('agencies', function (Blueprint $table) {
            $table->boolean('is_phone_verified')->default(false)->after('phone');
            $table->string('otp_code')->nullable()->after('is_phone_verified');
            $table->string('license_document')->nullable()->after('trade_license_no');
            $table->string('trade_license_document')->nullable()->after('license_document');
            $table->timestamp('verification_submitted_at')->nullable()->after('verification_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agencies', function (Blueprint $table) {
            $table->dropColumn([
                'is_phone_verified',
                'otp_code',
                'license_document',
                'trade_license_document',
                'verification_submitted_at',
            ]);
        });
    }
};
