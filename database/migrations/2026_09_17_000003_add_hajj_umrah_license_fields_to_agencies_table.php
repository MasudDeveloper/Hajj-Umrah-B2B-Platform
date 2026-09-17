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
            $table->string('license_type')->default('hajj')->after('company_name'); // hajj, umrah, both
            $table->string('hajj_license_no')->nullable()->after('license_type');
            $table->string('umrah_license_no')->nullable()->after('hajj_license_no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agencies', function (Blueprint $table) {
            $table->dropColumn(['license_type', 'hajj_license_no', 'umrah_license_no']);
        });
    }
};
