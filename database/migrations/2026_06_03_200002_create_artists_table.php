<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('artists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('branch_id')->constrained('branches')->cascadeOnDelete();
            $table->string('display_name');
            $table->string('slug')->unique();
            $table->text('bio')->nullable();
            $table->string('tagline')->nullable(); // "Master of Realism"
            $table->integer('experience_years')->default(0);
            $table->json('specializations')->nullable(); // ["Realism","Portrait","Blackwork"]
            $table->json('awards')->nullable(); // [{"year":2023,"title":"Best Realist"}]
            $table->json('social_links')->nullable(); // {"instagram":"...","youtube":"..."}
            $table->string('profile_photo')->nullable();
            $table->string('cover_photo')->nullable();
            $table->decimal('base_hourly_rate', 10, 2)->nullable();
            $table->integer('min_booking_notice_hours')->default(24); // min hours before appointment
            $table->integer('max_advance_booking_days')->default(60);
            $table->json('working_days')->default('["monday","tuesday","wednesday","thursday","friday","saturday"]');
            $table->time('work_start_time')->default('10:00:00');
            $table->time('work_end_time')->default('20:00:00');
            $table->integer('slot_duration_minutes')->default(60); // default slot length
            $table->integer('break_duration_minutes')->default(15); // break between slots
            $table->enum('commission_type', ['fixed', 'percentage'])->default('percentage');
            $table->decimal('commission_value', 8, 2)->default(60.00); // 60% to artist
            $table->boolean('is_active')->default(true);
            $table->boolean('accepts_walk_ins')->default(true);
            $table->integer('sort_order')->default(0);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('artist_branch', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artist_id')->constrained()->cascadeOnDelete();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artist_branch');
        Schema::dropIfExists('artists');
    }
};
