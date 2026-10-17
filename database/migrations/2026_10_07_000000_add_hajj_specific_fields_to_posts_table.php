<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('moallem_number')->nullable()->after('hajj_tent_category');
            $table->string('arafat_tent_details')->nullable()->after('moallem_number');
            $table->boolean('aziziyah_accommodation')->default(false)->after('arafat_tent_details');
            $table->boolean('shifting_package')->default(false)->after('aziziyah_accommodation');
            $table->boolean('qurbani_included')->default(false)->after('shifting_package');
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn([
                'moallem_number',
                'arafat_tent_details',
                'aziziyah_accommodation',
                'shifting_package',
                'qurbani_included',
            ]);
        });
    }
};
