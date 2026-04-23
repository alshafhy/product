<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();

            // ── Identification ─────────────────────────────────────
            $table->string('code_id')->unique();          // CODEID / primary barcode
            $table->string('barcode2')->nullable();        // BARCODE2
            $table->string('barcode3')->nullable();        // BARCODE3
            $table->string('name');
            $table->text('description')->nullable();
            $table->date('expire_date')->nullable();       // EXPIREDATE

            // ── Unit Tier 1 (base unit) ────────────────────────────
            // UNIT1 → unit_id (FK to units_of_measure)
            $table->foreignId('unit_id')->nullable()->constrained('units_of_measure')->nullOnDelete();
            $table->decimal('buy_price', 15, 4)->default(0);   // BUYPRICE
            $table->decimal('sell_price', 15, 4)->default(0);  // SELLPRICE

            // ── Unit Tier 2 (e.g. box = N pieces) ─────────────────
            // UNIT2, FACTOR2 = how many unit1 fit in unit2
            $table->string('unit2_name')->nullable();          // UNIT2 (free text in Android)
            $table->decimal('factor2', 15, 4)->nullable();     // FACTOR2
            $table->decimal('buy_price2', 15, 4)->nullable();  // BUYPRICE2
            $table->decimal('sell_price2', 15, 4)->nullable(); // SELLPRICE2
            $table->decimal('sell_price_unit2', 15, 4)->nullable(); // SELLPRICEUNIT2

            // ── Unit Tier 3 (e.g. carton) ─────────────────────────
            $table->string('unit3_name')->nullable();          // UNIT3
            $table->decimal('factor3', 15, 4)->nullable();     // FACTOR3
            $table->decimal('buy_price3', 15, 4)->nullable();  // BUYPRICE3
            $table->decimal('sell_price3', 15, 4)->nullable(); // SELLPRICE3
            $table->decimal('sell_price_unit3', 15, 4)->nullable(); // SELLPRICEUNIT3

            // ── Stock ──────────────────────────────────────────────
            $table->decimal('quantity', 15, 4)->default(0);    // QUANTITY
            $table->decimal('min_quantity', 15, 4)->default(0); // low-stock alert threshold

            // ── Image (stored via Attachments polymorphic system) ──
            // Android stored raw BLOB; we use the existing attachments table
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
