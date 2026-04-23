<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('treasury_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();

            // ── Transaction Identity ──────────────────────────────
            // 'deposit'          → Cash in
            // 'withdrawal'       → Cash out
            // 'expense'          → Business expense
            // 'sale_payment'     → Linked to sale_invoice
            // 'purchase_payment' → Linked to purchase_invoice
            // 'opening_balance'  → Initial cash in treasury
            $table->string('type');
            $table->decimal('amount', 15, 4);

            // ── Balances (Snapshots) ──────────────────────────────
            // Mirroring Android 'totalbefore' and 'totalAfter'
            $table->decimal('balance_before', 15, 4);
            $table->decimal('balance_after', 15, 4);

            // ── Reference (Polymorphic) ───────────────────────────
            // Allows linking to SaleInvoice, PurchaseInvoice, etc.
            $table->nullableMorphs('reference');

            $table->date('transaction_date');
            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();

            // ── Indexes ───────────────────────────────────────────
            $table->index(['branch_id', 'transaction_date']);
            $table->index(['type', 'transaction_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('treasury_transactions');
    }
};
