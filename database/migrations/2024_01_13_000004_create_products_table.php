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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code_id')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            
            $table->foreignId('category_id')
                ->nullable()
                ->constrained('categories')
                ->nullOnDelete();

            // Pricing - Set 1
            $table->decimal('sell_price', 15, 4)->default(0);
            $table->decimal('buy_price', 15, 4)->default(0);
            
            // Pricing - Set 2
            $table->decimal('sell_price2', 15, 4)->default(0);
            $table->decimal('buy_price2', 15, 4)->default(0);
            
            // Pricing - Set 3
            $table->decimal('sell_price3', 15, 4)->default(0);
            $table->decimal('buy_price3', 15, 4)->default(0);

            $table->decimal('quantity', 15, 4)->default(0);

            // Multi-Unit Factors
            $table->string('unit1')->nullable(); // e.g. "Piece"
            $table->string('unit2')->nullable(); // e.g. "Box"
            $table->string('unit3')->nullable(); // e.g. "Cartoon"
            
            $table->decimal('factor2', 15, 4)->default(1);
            $table->decimal('factor3', 15, 4)->default(1);
            
            $table->decimal('sell_price_unit2', 15, 4)->default(0);
            $table->decimal('sell_price_unit3', 15, 4)->default(0);
            
            $table->string('barcode2')->nullable();
            $table->string('barcode3')->nullable();
            
            $table->date('expire_date')->nullable();
            
            $table->foreignId('branch_id')->nullable()->constrained('branches');

            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
