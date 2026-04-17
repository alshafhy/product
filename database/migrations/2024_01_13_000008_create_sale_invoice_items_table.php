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
        Schema::create('sale_invoice_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_invoice_id')
                ->constrained('sale_invoices')
                ->cascadeOnDelete();
            
            $table->foreignId('product_id')->constrained('products');
            
            // Snapshots at time of sale
            $table->string('product_name');
            $table->string('code_id')->nullable();
            
            $table->decimal('quantity', 15, 4);
            $table->decimal('unit_factor', 15, 4)->default(1);
            $table->string('unit_name')->nullable();
            
            $table->enum('price_type', ['one', 'two', 'three'])->default('one');
            $table->decimal('sell_price', 15, 4);
            $table->decimal('buy_price', 15, 4); // For profit calculation
            
            $table->decimal('line_total', 15, 4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_invoice_items');
    }
};
