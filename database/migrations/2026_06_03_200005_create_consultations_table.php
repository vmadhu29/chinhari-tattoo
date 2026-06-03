<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Consultations (separate from bookings, can convert to booking)
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->string('consultation_number')->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('artist_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->enum('type', ['online', 'in_person'])->default('in_person');
            $table->enum('status', ['pending', 'assigned', 'scheduled', 'completed', 'converted', 'cancelled'])->default('pending');
            $table->date('preferred_date')->nullable();
            $table->time('preferred_time')->nullable();
            $table->date('scheduled_date')->nullable();
            $table->time('scheduled_time')->nullable();
            $table->text('tattoo_idea')->nullable();
            $table->string('tattoo_placement')->nullable();
            $table->string('budget_range')->nullable();
            $table->json('inspiration_images')->nullable();
            $table->text('admin_notes')->nullable();
            $table->foreignId('converted_booking_id')->nullable()->constrained('bookings')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });

        // Design Approval Workflow
        Schema::create('design_approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete();
            $table->foreignId('artist_id')->constrained()->cascadeOnDelete();
            $table->foreignId('customer_id')->constrained('users')->cascadeOnDelete();
            $table->integer('version')->default(1);
            $table->string('design_file_path');
            $table->enum('status', ['submitted', 'under_review', 'revision_requested', 'approved', 'rejected'])->default('submitted');
            $table->text('customer_feedback')->nullable();
            $table->text('artist_notes')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });

        // Consent Forms
        Schema::create('consent_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('form_type', ['tattoo_consent', 'medical_declaration', 'age_verification'])->default('tattoo_consent');
            $table->json('form_data'); // all form field values
            $table->string('digital_signature_path')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('pdf_path')->nullable();
            $table->timestamp('signed_at')->nullable();
            $table->timestamps();
        });

        // Aftercare Schedules
        Schema::create('aftercare_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->integer('day_number'); // 1, 3, 7, 14, 30
            $table->string('title');
            $table->text('message');
            $table->enum('channel', ['email', 'whatsapp', 'database'])->default('email');
            $table->enum('status', ['pending', 'sent', 'failed'])->default('pending');
            $table->timestamp('scheduled_at');
            $table->timestamp('sent_at')->nullable();
            $table->string('error_message')->nullable();
            $table->timestamps();

            $table->index(['status', 'scheduled_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aftercare_schedules');
        Schema::dropIfExists('consent_forms');
        Schema::dropIfExists('design_approvals');
        Schema::dropIfExists('consultations');
    }
};
