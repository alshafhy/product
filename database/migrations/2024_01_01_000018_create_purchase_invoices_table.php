<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();

            // ── Invoice Identity ──────────────────────────────────
            $table->string('invoice_number')->unique();
            $table->date('invoice_date');

            // ── Supplier (snapshot + FK) ──────────────────────────
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->nullOnDelete();
            $table->string('supplier_name')->nullable(); // snapshot

            // ── Cashier snapshot ──────────────────────────────────
            $table->foreignId('cashier_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('cashier_name')->nullable();

            // ── Financials ────────────────────────────────────────
            $table->decimal('subtotal', 15, 4)->default(0);
            $table->decimal('discount_amount', 15, 4)->default(0);
            $table->string('discount_type')->default('fixed'); // 'fixed' | 'percent'
            $table->decimal('total', 15, 4)->default(0);

            // ── Payment ───────────────────────────────────────────
            // 'cash' | 'credit' | 'partial'
            $table->string('payment_type')->default('cash');
            $table->decimal('paid_amount', 15, 4)->default(0);
            $table->decimal('remaining_amount', 15, 4)->default(0);

            // ── Status ────────────────────────────────────────────
            // 'paid' | 'partial' | 'unpaid' | 'cancelled'
            $table->string('status')->default('paid');

            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');

            // ── Indexes ───────────────────────────────────────────
            $table->index(['branch_id', 'invoice_date']);
            $table->index(['supplier_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_invoices');
    }
};
