<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();

            // ── Identity ──────────────────────────────────────────
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->text('notes')->nullable();

            // ── Financial ─────────────────────────────────────────
            // Total we have paid to this supplier
            $table->decimal('paid_amount', 15, 4)->default(0);
            // Total purchase invoices billed from this supplier
            $table->decimal('total_invoiced', 15, 4)->default(0);
            // Manual balance correction (maps to Android remove_supplier_error dialog)
            $table->decimal('balance_adjustment', 15, 4)->default(0);

            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
