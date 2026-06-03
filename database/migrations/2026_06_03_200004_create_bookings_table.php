<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Booking Slots - defines available time windows per artist
        Schema::create('booking_slots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artist_id')->constrained()->cascadeOnDelete();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->date('slot_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('status', ['available', 'booked', 'blocked', 'break'])->default('available');
            $table->string('blocked_reason')->nullable();
            $table->boolean('is_walk_in')->default(false);
            $table->timestamps();

            $table->index(['artist_id', 'slot_date', 'status']);
            $table->index(['branch_id', 'slot_date', 'status']);
        });

        // Main Bookings Table
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_number')->unique(); // CHN-2026-00001
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // customer
            $table->foreignId('artist_id')->constrained()->cascadeOnDelete();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->foreignId('booking_slot_id')->nullable()->constrained('booking_slots')->nullOnDelete();

            // Appointment Details
            $table->date('appointment_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('duration_minutes');

            // Tattoo Details
            $table->string('tattoo_placement')->nullable(); // "Upper Arm", "Back", etc.
            $table->enum('tattoo_size', ['tiny', 'small', 'medium', 'large', 'extra_large', 'custom'])->nullable();
            $table->enum('color_type', ['black_grey', 'color', 'mixed'])->nullable();
            $table->enum('complexity', ['simple', 'moderate', 'complex', 'highly_complex'])->nullable();
            $table->integer('estimated_sessions')->default(1);
            $table->integer('current_session')->default(1);
            $table->text('customer_requirements')->nullable();
            $table->json('reference_images')->nullable(); // array of file paths

            // Booking Status
            $table->enum('status', [
                'pending',      // Customer submitted, awaiting admin confirm
                'confirmed',    // Admin confirmed
                'in_progress',  // Session started
                'completed',    // Session done
                'cancelled',    // Cancelled by customer or admin
                'rescheduled',  // Was rescheduled
                'no_show',      // Customer didn't show up
            ])->default('pending');
            $table->string('cancellation_reason')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();

            // Financials
            $table->decimal('quoted_price', 10, 2)->nullable();
            $table->decimal('final_price', 10, 2)->nullable();
            $table->decimal('deposit_amount', 10, 2)->default(0);
            $table->boolean('deposit_paid')->default(false);
            $table->string('deposit_payment_id')->nullable();
            $table->enum('payment_status', ['unpaid', 'deposit_paid', 'partially_paid', 'paid', 'refunded'])->default('unpaid');

            // Consent & Legal
            $table->boolean('consent_signed')->default(false);
            $table->string('consent_form_path')->nullable(); // PDF path
            $table->boolean('medical_declaration_signed')->default(false);
            $table->boolean('age_verified')->default(false);
            $table->string('digital_signature_path')->nullable();

            // Walk-in Flag
            $table->boolean('is_walk_in')->default(false);
            $table->boolean('is_touch_up')->default(false);
            $table->foreignId('parent_booking_id')->nullable()->constrained('bookings')->nullOnDelete();

            // Notes
            $table->text('admin_notes')->nullable();
            $table->text('artist_notes')->nullable();

            // Gift Voucher
            $table->string('voucher_code')->nullable();
            $table->decimal('voucher_discount', 10, 2)->default(0);

            // Loyalty
            $table->integer('loyalty_points_earned')->default(0);
            $table->integer('loyalty_points_used')->default(0);

            // Rescheduling
            $table->integer('reschedule_count')->default(0);
            $table->date('original_appointment_date')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['user_id', 'status']);
            $table->index(['artist_id', 'appointment_date', 'status']);
            $table->index(['branch_id', 'appointment_date', 'status']);
        });

        // Booking Timeline / Journey Events
        Schema::create('booking_timeline', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete(); // who performed action
            $table->string('event_type'); // consultation_created, design_submitted, booking_confirmed, etc.
            $table->string('title');
            $table->text('description')->nullable();
            $table->json('metadata')->nullable();
            $table->string('icon')->nullable();
            $table->string('color')->nullable();
            $table->timestamps();

            $table->index(['booking_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_timeline');
        Schema::dropIfExists('bookings');
        Schema::dropIfExists('booking_slots');
    }
};
