<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete()->after('id');
            $table->string('phone', 20)->nullable()->after('email');
            $table->string('whatsapp', 20)->nullable()->after('phone');
            $table->string('avatar')->nullable()->after('whatsapp');
            $table->date('date_of_birth')->nullable()->after('avatar');
            $table->enum('gender', ['male', 'female', 'other', 'prefer_not_to_say'])->nullable()->after('date_of_birth');
            $table->text('address')->nullable()->after('gender');
            $table->string('city', 100)->nullable()->after('address');
            $table->string('state', 100)->nullable()->after('city');
            $table->string('pincode', 10)->nullable()->after('state');
            $table->string('referral_code', 20)->unique()->nullable()->after('pincode');
            $table->string('referred_by', 20)->nullable()->after('referral_code'); // referral code of referrer
            $table->integer('loyalty_points')->default(0)->after('referred_by');
            $table->boolean('is_active')->default(true)->after('loyalty_points');
            $table->boolean('age_verified')->default(false)->after('is_active');
            $table->timestamp('last_visited_at')->nullable()->after('age_verified');
            $table->json('preferences')->nullable()->after('last_visited_at'); // notification prefs etc.
            $table->string('google_id')->nullable()->after('preferences');
            $table->string('facebook_id')->nullable()->after('google_id');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'branch_id', 'phone', 'whatsapp', 'avatar', 'date_of_birth', 'gender',
                'address', 'city', 'state', 'pincode', 'referral_code', 'referred_by',
                'loyalty_points', 'is_active', 'age_verified', 'last_visited_at',
                'preferences', 'google_id', 'facebook_id'
            ]);
        });
    }
};
