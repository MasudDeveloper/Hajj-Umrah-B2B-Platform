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
        Schema::table('post_inquiries', function (Blueprint $table) {
            $table->decimal('offered_price_per_seat', 10, 2)->nullable()->after('requested_seats');
            $table->text('seller_note')->nullable()->after('message');
            $table->decimal('advance_amount_agreed', 10, 2)->nullable()->after('seller_note');
            $table->boolean('seller_deal_done')->default(false)->after('status');
            $table->boolean('buyer_deal_done')->default(false)->after('seller_deal_done');
            $table->string('contract_number')->nullable()->unique()->after('buyer_deal_done');
            $table->timestamp('deal_completed_at')->nullable()->after('contract_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('post_inquiries', function (Blueprint $table) {
            $table->dropColumn([
                'offered_price_per_seat',
                'seller_note',
                'advance_amount_agreed',
                'seller_deal_done',
                'buyer_deal_done',
                'contract_number',
                'deal_completed_at',
            ]);
        });
    }
};
