<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sale_invoice_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_invoice_id')->constrained()->cascadeOnDelete();

            // ── Product FK + point-in-time snapshots ──────────────
            // NEVER recalculate from product — prices change over time
            $table->foreignId('product_id')->nullable()->constrained('products')->nullOnDelete();
            $table->string('product_code');    // code_id snapshot
            $table->string('product_name');    // name snapshot

            // ── Unit / Tier snapshots ─────────────────────────────
            // priceType: 'one' | 'two' | 'three'
            $table->string('price_type')->default('one');
            $table->string('unit_name')->nullable();   // UNITNAME snapshot
            $table->decimal('unit_factor', 15, 4)->default(1); // UNITFACTOR

            // ── Quantities ────────────────────────────────────────
            $table->decimal('quantity', 15, 4);

            // ── Prices (all snapshots at time of sale) ────────────
            $table->decimal('sell_price', 15, 4);      // SELLPRICE snapshot
            $table->decimal('buy_price', 15, 4)->default(0); // BUYPRICE snapshot (COGS)
            $table->decimal('line_total', 15, 4);      // quantity * sell_price

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sale_invoice_items');
    }
};
