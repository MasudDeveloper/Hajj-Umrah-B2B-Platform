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
        Schema::table('posts', function (Blueprint $table) {
            $table->string('hajj_or_umrah')->default('umrah')->after('post_category');
            $table->string('departure_time')->nullable()->after('flight_date');
            $table->string('transit_duration')->nullable()->after('flight_transit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['hajj_or_umrah', 'departure_time', 'transit_duration']);
        });
    }
};
