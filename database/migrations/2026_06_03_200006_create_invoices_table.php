<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Invoices
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique(); // INV-2026-00001
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('artist_id')->constrained()->cascadeOnDelete();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();

            // Amounts
            $table->decimal('subtotal', 10, 2);
            $table->decimal('tax_rate', 5, 2)->default(18.00); // GST %
            $table->decimal('tax_amount', 10, 2)->default(0);
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->decimal('voucher_discount', 10, 2)->default(0);
            $table->decimal('loyalty_discount', 10, 2)->default(0);
            $table->decimal('total', 10, 2);
            $table->decimal('amount_paid', 10, 2)->default(0);
            $table->decimal('amount_due', 10, 2);

            // Status
            $table->enum('status', ['draft', 'issued', 'partially_paid', 'paid', 'overdue', 'cancelled'])->default('draft');
            $table->date('issue_date');
            $table->date('due_date')->nullable();
            $table->timestamp('paid_at')->nullable();

            // GST
            $table->string('gstin')->nullable();
            $table->string('hsn_code')->default('999799'); // Tattoo services HSN

            // QR Verification
            $table->string('qr_code_path')->nullable();
            $table->string('verification_token', 64)->unique()->nullable();

            // PDF
            $table->string('pdf_path')->nullable();

            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Payments
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete();
            $table->string('payment_reference')->unique(); // PAY-2026-00001
            $table->string('razorpay_order_id')->nullable();
            $table->string('razorpay_payment_id')->nullable();
            $table->string('razorpay_signature')->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('currency', 3)->default('INR');
            $table->enum('method', ['razorpay', 'cash', 'upi', 'bank_transfer', 'card', 'voucher'])->default('razorpay');
            $table->enum('status', ['pending', 'captured', 'failed', 'refunded'])->default('pending');
            $table->enum('type', ['deposit', 'partial', 'full', 'refund'])->default('full');
            $table->json('gateway_response')->nullable();
            $table->string('notes')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            $table->index(['invoice_id', 'status']);
            $table->index(['booking_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
        Schema::dropIfExists('invoices');
    }
};
