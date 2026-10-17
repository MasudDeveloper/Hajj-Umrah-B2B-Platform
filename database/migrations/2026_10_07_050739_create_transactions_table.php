<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agency_id')->constrained()->onDelete('cascade');
            $table->string('transaction_id')->unique()->nullable(); // Payment gateway TXN ID
            $table->decimal('amount', 10, 2);
            $table->string('currency')->default('BDT');
            $table->string('payment_method')->nullable();
            $table->enum('status', ['pending', 'completed', 'failed', 'cancelled'])->default('pending');
            $table->string('type'); // e.g., 'subscription', 'booking_advance', 'escrow'
            $table->unsignedBigInteger('reference_id')->nullable(); // Can be subscription_id or inquiry_id
            $table->json('gateway_response')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
