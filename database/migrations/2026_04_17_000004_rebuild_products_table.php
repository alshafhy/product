<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop existing tables due to dependency
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('products');

        // Recreate products table with CashPOS structure
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code_id')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            
            // Prices (decimal 15,4)
            $table->decimal('sell_price', 15, 4)->default(0);
            $table->decimal('sell_price2', 15, 4)->default(0);
            $table->decimal('sell_price3', 15, 4)->default(0);
            $table->decimal('buy_price', 15, 4)->default(0);
            $table->decimal('buy_price2', 15, 4)->default(0);
            $table->decimal('buy_price3', 15, 4)->default(0);
            
            // Stock and Units
            $table->decimal('quantity', 15, 4)->default(0);
            $table->date('expire_date')->nullable();
            
            $table->string('unit1')->nullable();
            $table->string('unit2')->nullable();
            $table->string('unit3')->nullable();
            
            $table->decimal('factor2', 15, 4)->default(1);
            $table->decimal('factor3', 15, 4)->default(1);
            
            $table->decimal('sell_price_unit2', 15, 4)->default(0);
            $table->decimal('sell_price_unit3', 15, 4)->default(0);
            
            $table->string('barcode2')->nullable();
            $table->string('barcode3')->nullable();
            
            // Meta and Relations
            $table->foreignId('branch_id')->constrained('branches')->cascadeOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            
            $table->timestamps();
            $table->softDeletes();
        });

        // Recreate product_images table relinked to the new products table
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->string('image_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('products');
    }
};
