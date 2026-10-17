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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_inquiry_id')->nullable()->constrained('post_inquiries')->onDelete('cascade');
            $table->foreignId('sender_agency_id')->constrained('agencies')->onDelete('cascade');
            $table->foreignId('receiver_agency_id')->constrained('agencies')->onDelete('cascade');
            $table->text('message');
            $table->string('attachment')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamps();

            $table->index(['post_inquiry_id', 'created_at']);
            $table->index(['receiver_agency_id', 'is_read']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
