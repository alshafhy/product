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

            // ── Type ──────────────────────────────────────────────
            // Maps Android: deposit=إضافة, withdrawal=خصم, expense=مصروف
            // sale_payment / purchase_payment added automatically by services
            $table->enum('type', [
                'opening_balance',
                'deposit',
                'withdrawal',
                'expense',
                'sale_payment',
                'purchase_payment',
            ]);

            // ── Amount & Running Balance ───────────────────────────
            // Maps Android: value, totalbefore, totalAfter
            $table->decimal('amount', 15, 4);
            $table->decimal('balance_before', 15, 4)->default(0); // totalbefore
            $table->decimal('balance_after', 15, 4)->default(0);  // totalAfter

            // ── Reference (polymorphic link to invoice if applicable)
            $table->string('reference_type')->nullable(); // 'sale_invoice' | 'purchase_invoice'
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->index(['reference_type', 'reference_id'], 'treasury_reference_index');

            $table->text('notes')->nullable();
            $table->date('transaction_date');

            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();

            // ── Indexes ───────────────────────────────────────────
            $table->index(['branch_id', 'transaction_date']);
            $table->index(['branch_id', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('treasury_transactions');
    }
};
