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
        // 1. Agencies Table (Acts as B2B Agency & User Auth model)
        Schema::create('agencies', function (Blueprint $table) {
            $table->id();
            $table->string('agency_name');
            $table->string('company_name');
            $table->string('license_no')->unique();       // Hajj / Umrah License No
            $table->string('haab_no')->nullable();         // HAAB Registration No
            $table->string('trade_license_no')->nullable();
            $table->string('owner_name');
            $table->string('nid_number')->nullable();
            $table->string('phone');
            $table->string('whatsapp')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('city')->default('Dhaka');       // Departure Hub
            $table->string('country')->default('Bangladesh');
            $table->text('address')->nullable();
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_verified')->default(false);
            $table->string('verification_status')->default('pending'); // pending, approved, rejected
            $table->string('subscription_plan')->default('free');      // free, monthly_b2b, yearly_b2b
            $table->decimal('rating', 3, 2)->default(4.90);
            $table->rememberToken();
            $table->timestamps();
        });

        // 2. Unified Multi-Category Posts Table (With Enhanced B2B Hajj/Umrah Fields)
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agency_id')->constrained('agencies')->onDelete('cascade');
            $table->string('title');
            
            // Core Categories: group_seats, ticket_only, hotel_share
            $table->string('post_category')->default('group_seats');
            
            // Requirement Type: need_seats, have_extra_seats, ticket_sale, ticket_need, hotel_share
            $table->string('requirement_type')->default('have_extra_seats');
            
            $table->integer('total_group_size')->default(35);
            $table->integer('available_seats')->default(5); // vacant or required count
            
            $table->date('flight_date');
            $table->date('return_date')->nullable();
            $table->integer('duration_days')->default(14); // e.g. 14 Days, 21 Days
            $table->string('airline')->default('Saudia');
            $table->string('flight_transit')->default('direct'); // direct, connecting
            $table->string('departure_city')->default('Dhaka'); // Dhaka, Chittagong, Sylhet
            
            // Package Tiers & Accommodation
            $table->string('package_tier')->default('standard'); // economy, standard, vip
            $table->string('room_type')->default('quad'); // quad, triple, double
            
            $table->string('makkah_hotel')->nullable();
            $table->integer('makkah_hotel_distance')->default(300); // meters
            $table->boolean('makkah_shuttle')->default(false); // free 24/7 shuttle bus
            
            $table->string('madinah_hotel')->nullable();
            $table->integer('madinah_hotel_distance')->default(200); // meters
            
            $table->decimal('price_per_seat', 12, 2);
            $table->decimal('advance_deposit', 12, 2)->default(10000.00); // Booking deposit per pax
            $table->date('name_deadline')->nullable(); // Passport/name submission deadline
            $table->string('currency')->default('BDT');
            $table->string('pnr_code')->nullable(); // GDS PNR status or reference
            $table->string('baggage_allowance')->default('46 KG (2 PC) + 7 KG Hand');
            
            // Comprehensive Service Inclusions
            $table->boolean('meals_included')->default(true);
            $table->boolean('visa_included')->default(true);
            $table->boolean('transport_included')->default(true);
            $table->boolean('ziyarah_included')->default(true); // Guided Makkah/Madinah Ziyarah
            $table->boolean('guide_included')->default(true);   // Experienced Muallem / Alem Guide
            $table->boolean('zamzam_included')->default(true);  // 5 Litres Zamzam water
            
            // Extended B2B Specific Fields (Gender, Route, Food, Transport, Commission, Terms, Visa)
            $table->string('allowed_gender')->default('any');           // any, male_only, female_only, family_only
            $table->string('passenger_type')->default('mixed_family');   // mixed_family, adults_only, elderly_friendly
            $table->string('route_sequence')->default('makkah_first');   // makkah_first (JED), madinah_first (MED), transit_stopover
            $table->string('catering_type')->default('bengali_catering'); // bengali_catering, hotel_buffet, half_board, breakfast_only, no_meals
            $table->string('transport_vehicle')->default('ac_bus_standard'); // ac_bus_standard, vip_coaster, gmc_suv, haramain_train_included
            $table->boolean('haramain_train')->default(false);          // Haramain High Speed Bullet Train Included
            $table->decimal('agent_commission', 12, 2)->default(0.00); // B2B Secret agent commission per seat BDT
            $table->string('name_change_policy')->default('free_replacement'); // free_replacement, fee_applies, strictly_non_changeable
            $table->string('payment_terms')->default('full_payment');   // full_payment, 50_advance_50_saudi, token_booking_only
            $table->string('hajj_tent_category')->default('none');      // none, mina_tent_a, mina_tent_b, standard_camp
            $table->string('visa_type')->default('umrah_evisa');        // umrah_evisa, saudi_tourist_1yr, hajj_moafa, none
            $table->string('makkah_hotel_type')->default('star_hotel'); // star_hotel, clock_tower, tashfeer_building, residential_apartment
            $table->string('madinah_hotel_type')->default('star_hotel');
            $table->string('itinerary_pdf')->nullable();                // Attachment or flyer link
            
            $table->text('details')->nullable();
            
            // Status Tracking: open, partially_filled, closed
            $table->string('status')->default('open');
            $table->timestamps();
        });

        // 3. Post Inquiries & Express Interest Table
        Schema::create('post_inquiries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade');
            $table->foreignId('inquiring_agency_id')->constrained('agencies')->onDelete('cascade');
            $table->integer('requested_seats')->default(1);
            $table->text('message')->nullable();
            $table->string('status')->default('pending'); // pending, accepted, rejected
            $table->timestamps();
        });

        // 4. Agency Reviews & Trust Score Table
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reviewer_agency_id')->constrained('agencies')->onDelete('cascade');
            $table->foreignId('target_agency_id')->constrained('agencies')->onDelete('cascade');
            $table->integer('rating')->default(5);
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('post_inquiries');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('agencies');
    }
};
