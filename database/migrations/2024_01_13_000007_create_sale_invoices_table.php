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
        Schema::create('sale_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            
            $table->foreignId('customer_id')
                ->nullable()
                ->constrained('customers')
                ->nullOnDelete();
            
            $table->foreignId('user_id')->constrained('users'); // Cashier
            $table->foreignId('branch_id')->constrained('branches');
            
            $table->decimal('subtotal', 15, 4);
            $table->decimal('discount', 15, 4)->default(0);
            $table->enum('discount_type', ['value', 'percent'])->default('value');
            $table->decimal('total', 15, 4);
            
            $table->decimal('cost', 15, 4)->default(0);
            $table->decimal('profit', 15, 4)->default(0);
            
            $table->decimal('paid', 15, 4)->default(0);
            $table->decimal('remaining', 15, 4)->default(0);
            
            $table->decimal('previous_debt', 15, 4)->default(0);
            $table->decimal('total_debt', 15, 4)->default(0);
            
            $table->enum('payment_type', ['cash', 'debt', 'partial'])->default('cash');
            $table->enum('status', ['draft', 'completed', 'voided'])->default('completed');
            
            $table->text('notes')->nullable();
            $table->timestamp('invoiced_at');

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
        Schema::dropIfExists('sale_invoices');
    }
};
