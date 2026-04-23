<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();

            // ── Identity ──────────────────────────────────────────
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->text('notes')->nullable();

            // ── Financial ─────────────────────────────────────────
            // hasmoney  → total amount deposited / paid by customer
            $table->decimal('paid_amount', 15, 4)->default(0);
            // paymoney  → total invoiced amount (running total)
            $table->decimal('total_invoiced', 15, 4)->default(0);
            // maxnotpaid → credit limit (0 = no limit)
            $table->decimal('credit_limit', 15, 4)->default(0);
            // Derived: current_debt = total_invoiced - paid_amount
            // Always computed, never stored — use accessor

            // ── Pricing Tier ──────────────────────────────────────
            // priceType: 1 = sell_price, 2 = sell_price2, 3 = sell_price3
            $table->unsignedTinyInteger('price_type')->default(1);

            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
