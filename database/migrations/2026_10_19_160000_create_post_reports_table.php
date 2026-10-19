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
        // 1. Create post_reports table
        if (!Schema::hasTable('post_reports')) {
            Schema::create('post_reports', function (Blueprint $table) {
                $table->id();
                $table->foreignId('post_id')->constrained('posts')->onDelete('cascade');
                $table->foreignId('reporter_agency_id')->constrained('agencies')->onDelete('cascade');
                $table->foreignId('offending_agency_id')->constrained('agencies')->onDelete('cascade');
                $table->foreignId('original_post_id')->nullable()->constrained('posts')->onDelete('set null');
                $table->string('reason'); // unauthorized_resale, ghost_seats, misleading_info, other
                $table->text('details');
                $table->string('proof_file')->nullable();
                $table->string('status')->default('pending'); // pending, resolved_removed, dismissed
                $table->text('admin_notes')->nullable();
                $table->foreignId('reviewed_by')->nullable()->constrained('agencies')->onDelete('set null');
                $table->timestamp('reviewed_at')->nullable();
                $table->timestamps();

                $table->index(['status', 'created_at']);
            });
        }

        // 2. Add is_reported flag to posts table
        Schema::table('posts', function (Blueprint $table) {
            if (!Schema::hasColumn('posts', 'is_reported')) {
                $table->boolean('is_reported')->default(false)->after('status');
            }
        });

        // 3. Add strike_count to agencies table
        Schema::table('agencies', function (Blueprint $table) {
            if (!Schema::hasColumn('agencies', 'strike_count')) {
                $table->integer('strike_count')->default(0)->after('verification_status');
            }
        });

        // 4. Make message nullable in messages table (so standalone image attachments can be sent)
        Schema::table('messages', function (Blueprint $table) {
            $table->text('message')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_reports');

        Schema::table('posts', function (Blueprint $table) {
            if (Schema::hasColumn('posts', 'is_reported')) {
                $table->dropColumn('is_reported');
            }
        });

        Schema::table('agencies', function (Blueprint $table) {
            if (Schema::hasColumn('agencies', 'strike_count')) {
                $table->dropColumn('strike_count');
            }
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->text('message')->nullable(false)->change();
        });
    }
};
