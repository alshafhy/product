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
            $table->foreignId('unit_id')->nullable()->constrained('units_of_measure')->nullOnDelete();
            // Identification
            $table->string('code_id')->unique();
            $table->string('barcode2')->nullable();
            $table->string('barcode3')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->date('expire_date')->nullable();
            // Unit tier 1
            $table->decimal('buy_price', 15, 4)->default(0);
            $table->decimal('sell_price', 15, 4)->default(0);
            // Unit tier 2
            $table->string('unit2_name')->nullable();
            $table->decimal('factor2', 15, 4)->nullable();
            $table->decimal('buy_price2', 15, 4)->nullable();
            $table->decimal('sell_price2', 15, 4)->nullable();
            $table->decimal('sell_price_unit2', 15, 4)->nullable();
            // Unit tier 3
            $table->string('unit3_name')->nullable();
            $table->decimal('factor3', 15, 4)->nullable();
            $table->decimal('buy_price3', 15, 4)->nullable();
            $table->decimal('sell_price3', 15, 4)->nullable();
            $table->decimal('sell_price_unit3', 15, 4)->nullable();
            // Stock
            $table->decimal('quantity', 15, 4)->default(0);
            $table->decimal('min_quantity', 15, 4)->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
