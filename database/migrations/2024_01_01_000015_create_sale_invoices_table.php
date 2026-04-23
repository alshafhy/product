<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sale_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->string('invoice_number')->unique();
            $table->date('invoice_date');
            $table->foreignId('customer_id')->nullable()->constrained('customers')->nullOnDelete();
            $table->string('customer_name')->nullable();
            $table->foreignId('cashier_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('cashier_name')->nullable();
            $table->decimal('subtotal', 15, 4)->default(0);
            $table->decimal('discount_amount', 15, 4)->default(0);
            $table->string('discount_type')->default('fixed');
            $table->decimal('total', 15, 4)->default(0);
            $table->decimal('cost', 15, 4)->default(0);
            $table->decimal('profit', 15, 4)->default(0);
            $table->string('payment_type')->default('cash');
            $table->decimal('paid_amount', 15, 4)->default(0);
            $table->decimal('remaining_amount', 15, 4)->default(0);
            $table->decimal('previous_debt', 15, 4)->default(0);
            $table->string('status')->default('paid');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->index(['branch_id', 'invoice_date']);
            $table->index(['customer_id', 'status']);
        });

        Schema::create('sale_invoice_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_invoice_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->nullable()->constrained('products')->nullOnDelete();
            $table->string('product_code');
            $table->string('product_name');
            $table->string('price_type')->default('one');
            $table->string('unit_name')->nullable();
            $table->decimal('unit_factor', 15, 4)->default(1);
            $table->decimal('quantity', 15, 4);
            $table->decimal('sell_price', 15, 4);
            $table->decimal('buy_price', 15, 4)->default(0);
            $table->decimal('line_total', 15, 4);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sale_invoice_items');
        Schema::dropIfExists('sale_invoices');
    }
};
