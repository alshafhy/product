<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_invoice_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_invoice_id')->constrained()->cascadeOnDelete();

            // ── Product FK + point-in-time snapshots ──────────────
            $table->foreignId('product_id')->nullable()->constrained('products')->nullOnDelete();
            $table->string('product_code');
            $table->string('product_name');

            // ── Unit snapshots ────────────────────────────────────
            $table->string('unit_name')->nullable();
            $table->decimal('unit_factor', 15, 4)->default(1);

            // ── Quantities & Prices (all snapshots) ───────────────
            $table->decimal('quantity', 15, 4);
            $table->decimal('buy_price', 15, 4);   // price paid per unit
            $table->decimal('sell_price', 15, 4)->default(0); // updated sell price (optional)
            $table->decimal('line_total', 15, 4);  // quantity * buy_price

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_invoice_items');
    }
};
