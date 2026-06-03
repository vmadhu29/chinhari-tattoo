<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Inventory Categories + Items
        Schema::create('inventory_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('inventory_categories')->cascadeOnDelete();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('sku')->nullable()->unique();
            $table->text('description')->nullable();
            $table->string('unit', 20)->default('piece'); // piece, box, ml, pair
            $table->integer('current_stock')->default(0);
            $table->integer('minimum_stock')->default(5); // low stock alert threshold
            $table->integer('reorder_quantity')->default(20);
            $table->decimal('unit_price', 10, 2)->nullable();
            $table->string('vendor_name')->nullable();
            $table->string('vendor_contact')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('inventory_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('inventory_items')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // who performed
            $table->foreignId('booking_id')->nullable()->constrained()->nullOnDelete();
            $table->enum('type', ['stock_in', 'stock_out', 'adjustment', 'damaged'])->default('stock_in');
            $table->integer('quantity'); // positive = in, negative = out
            $table->integer('stock_after');
            $table->decimal('unit_price', 10, 2)->nullable();
            $table->string('reference')->nullable(); // PO number, etc.
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // Lead CRM
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('whatsapp', 20)->nullable();
            $table->enum('source', ['website', 'whatsapp', 'instagram', 'facebook', 'referral', 'walk_in', 'call', 'other'])->default('website');
            $table->string('tattoo_interest')->nullable();
            $table->decimal('budget', 10, 2)->nullable();
            $table->enum('stage', ['new', 'contacted', 'consultation_scheduled', 'converted', 'lost'])->default('new');
            $table->string('lost_reason')->nullable();
            $table->text('notes')->nullable();
            $table->json('follow_up_history')->nullable();
            $table->date('next_follow_up_date')->nullable();
            $table->foreignId('converted_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('converted_booking_id')->nullable()->constrained('bookings')->nullOnDelete();
            $table->timestamp('converted_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Artist Commissions
        Schema::create('artist_commissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artist_id')->constrained()->cascadeOnDelete();
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete();
            $table->foreignId('invoice_id')->constrained()->cascadeOnDelete();
            $table->decimal('booking_amount', 10, 2);
            $table->enum('commission_type', ['fixed', 'percentage'])->default('percentage');
            $table->decimal('commission_rate', 8, 2); // % or fixed amount
            $table->decimal('commission_amount', 10, 2);
            $table->enum('status', ['pending', 'paid', 'held'])->default('pending');
            $table->date('paid_on')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // App Settings
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('string'); // string, boolean, json, integer
            $table->string('group')->default('general');
            $table->string('label')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_public')->default(false); // visible to frontend
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
        Schema::dropIfExists('artist_commissions');
        Schema::dropIfExists('leads');
        Schema::dropIfExists('inventory_transactions');
        Schema::dropIfExists('inventory_items');
        Schema::dropIfExists('inventory_categories');
    }
};
