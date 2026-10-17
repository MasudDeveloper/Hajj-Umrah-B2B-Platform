<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agency_id')->constrained()->onDelete('cascade');
            $table->string('plan_name'); // e.g., 'monthly', 'yearly', 'lifetime'
            $table->decimal('amount', 10, 2);
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->enum('status', ['active', 'expired', 'cancelled', 'pending'])->default('pending');
            $table->foreignId('transaction_id')->nullable()->constrained('transactions')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
