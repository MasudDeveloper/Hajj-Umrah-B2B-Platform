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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agency_id')->constrained('agencies')->onDelete('cascade');
            $table->string('type')->default('general'); // new_inquiry, deal_confirmed, message, payment_approved, system
            $table->string('title');
            $table->text('message');
            $table->string('link')->nullable();
            $table->json('data')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamps();

            $table->index(['agency_id', 'is_read']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
