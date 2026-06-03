<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Loyalty Points Ledger
        Schema::create('loyalty_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('booking_id')->nullable()->constrained()->nullOnDelete();
            $table->enum('type', ['earned', 'redeemed', 'expired', 'bonus', 'referral', 'review', 'birthday'])->default('earned');
            $table->integer('points'); // positive = earned, negative = redeemed
            $table->integer('balance_after');
            $table->string('description');
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'type']);
        });

        // Referrals
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('referrer_id')->constrained('users')->cascadeOnDelete(); // who referred
            $table->foreignId('referred_id')->constrained('users')->cascadeOnDelete(); // who was referred
            $table->foreignId('booking_id')->nullable()->constrained()->nullOnDelete(); // qualifying booking
            $table->enum('status', ['pending', 'converted', 'rewarded', 'expired'])->default('pending');
            $table->decimal('referrer_discount', 10, 2)->default(0);
            $table->integer('referrer_points')->default(0);
            $table->decimal('referred_discount', 10, 2)->default(0);
            $table->timestamp('converted_at')->nullable();
            $table->timestamp('rewarded_at')->nullable();
            $table->timestamps();
        });

        // Memberships
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('tier', ['silver', 'gold', 'platinum'])->default('silver');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('price_paid', 10, 2)->default(0);
            $table->enum('status', ['active', 'expired', 'cancelled'])->default('active');
            $table->json('benefits')->nullable(); // snapshot of benefits at time of purchase
            $table->integer('discount_percentage')->default(0);
            $table->boolean('priority_booking')->default(false);
            $table->integer('free_touch_ups')->default(0);
            $table->integer('touch_ups_used')->default(0);
            $table->timestamps();
        });

        // Gift Vouchers
        Schema::create('gift_vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique();
            $table->string('name')->nullable(); // "Birthday Gift for Rahul"
            $table->foreignId('issued_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('issued_to')->nullable()->constrained('users')->nullOnDelete();
            $table->decimal('original_amount', 10, 2);
            $table->decimal('remaining_amount', 10, 2);
            $table->enum('status', ['active', 'partially_used', 'fully_used', 'expired', 'cancelled'])->default('active');
            $table->date('valid_from');
            $table->date('valid_until');
            $table->string('recipient_email')->nullable();
            $table->string('recipient_name')->nullable();
            $table->text('gift_message')->nullable();
            $table->foreignId('payment_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });

        // Reviews (post-session)
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete();
            $table->foreignId('artist_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('overall_rating'); // 1-5
            $table->unsignedTinyInteger('artist_skill_rating')->nullable();
            $table->unsignedTinyInteger('cleanliness_rating')->nullable();
            $table->unsignedTinyInteger('communication_rating')->nullable();
            $table->text('review_text')->nullable();
            $table->json('review_photos')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'flagged'])->default('pending');
            $table->boolean('is_verified')->default(false); // verified purchase
            $table->boolean('show_publicly')->default(false);
            $table->integer('helpful_count')->default(0);
            $table->text('admin_reply')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });

        // Wishlists
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('portfolio_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('artist_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('service_id')->nullable()->constrained()->nullOnDelete();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wishlists');
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('gift_vouchers');
        Schema::dropIfExists('memberships');
        Schema::dropIfExists('referrals');
        Schema::dropIfExists('loyalty_transactions');
    }
};
