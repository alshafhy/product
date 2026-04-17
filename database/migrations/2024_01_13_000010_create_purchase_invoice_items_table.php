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
            $table->foreignId('purchase_invoice_id')
                ->constrained('purchase_invoices')
                ->cascadeOnDelete();
            
            $table->foreignId('product_id')->constrained('products');
            
            // Snapshots
            $table->string('product_name');
            $table->string('code_id')->nullable();
            
            $table->decimal('quantity', 15, 4);
            $table->string('unit_name')->nullable();
            
            $table->decimal('buy_price', 15, 4);
            $table->decimal('suggested_sell_price', 15, 4)->default(0);
            
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
