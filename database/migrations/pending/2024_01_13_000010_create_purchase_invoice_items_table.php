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
        Schema::create('purchase_invoice_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_invoice_id')->constrained('purchase_invoices')->cascadeOnDelete();
            $table->foreignId('product_id')->nullable()->constrained('products')->nullOnDelete();
            
            // Snapshots
            $table->string('product_name');
            $table->string('code_id');
            
            $table->decimal('quantity', 15, 4);
            $table->decimal('unit_factor', 15, 4)->default(1);
            $table->string('unit_name');
            
            $table->string('price_type')->default('unit1'); // unit1, unit2, unit3
            $table->decimal('buy_price', 15, 4);
            $table->decimal('sell_price', 15, 4); // snapshot of suggested sell price
            
            $table->decimal('line_total', 15, 4);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_invoice_items');
    }
};
