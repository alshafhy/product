<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('installments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_invoice_id')->constrained()->cascadeOnDelete();
            $table->foreignId('customer_id')->nullable()->constrained('customers')->nullOnDelete();

            // ── Installment Identity ──────────────────────────────
            $table->string('client_name'); // snapshot of customer name
            $table->text('description')->nullable();

            // ── Schedule & Amount ─────────────────────────────────
            $table->unsignedInteger('days_limit')->default(0); // DAYSLIMIT
            $table->date('collect_date');                      // COLLECTDATE (due date)
            $table->decimal('amount', 15, 4);                 // KIST_VALUE

            // ── Status & Payment ──────────────────────────────────
            // 'not_paid' | 'paid'
            $table->string('status')->default('not_paid'); // STATUE
            $table->string('pay_type')->nullable();        // PAY_TYPE
            $table->date('paid_date')->nullable();         // PAYDATE (actual date)

            // ── Guarantor Info ────────────────────────────────────
            $table->string('guarantor_name')->nullable();  // DAMEN_NAME
            $table->string('guarantor_phone')->nullable(); // DAMEN_PHONE

            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();

            // ── Indexes ───────────────────────────────────────────
            $table->index(['customer_id', 'status']);
            $table->index(['collect_date', 'status']);
            $table->index(['sale_invoice_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('installments');
    }
};
