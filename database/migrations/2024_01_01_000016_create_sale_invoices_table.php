<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sale_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();

            // ── Invoice Identity ──────────────────────────────────
            // Human-readable invoice number e.g. "INV-2024-00001"
            $table->string('invoice_number')->unique();
            $table->date('invoice_date');

            // ── Customer (snapshot + FK) ──────────────────────────
            // FK nullable: walk-in customers have no account
            $table->foreignId('customer_id')->nullable()->constrained('customers')->nullOnDelete();
            $table->string('customer_name')->nullable(); // snapshot at time of sale

            // ── Cashier snapshot ──────────────────────────────────
            $table->foreignId('cashier_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('cashier_name')->nullable(); // snapshot

            // ── Financials ────────────────────────────────────────
            // total      → gross invoice total before discount
            $table->decimal('subtotal', 15, 4)->default(0);
            // discount amount and type ('fixed' | 'percent')
            $table->decimal('discount_amount', 15, 4)->default(0);
            $table->string('discount_type')->default('fixed'); // discount_kind
            // final total after discount
            $table->decimal('total', 15, 4)->default(0);
            // cost → total buy price of items (COGS)
            $table->decimal('cost', 15, 4)->default(0);
            // profit = total - cost
            $table->decimal('profit', 15, 4)->default(0);

            // ── Payment ───────────────────────────────────────────
            // kind: 'cash' | 'credit' | 'partial'
            $table->string('payment_type')->default('cash');
            // amount actually paid at time of sale
            $table->decimal('paid_amount', 15, 4)->default(0);
            // notpaid → remaining balance on this invoice
            $table->decimal('remaining_amount', 15, 4)->default(0);
            // previousDebt → customer's debt snapshot before this invoice
            $table->decimal('previous_debt', 15, 4)->default(0);

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
            $table->index(['customer_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sale_invoices');
    }
};
