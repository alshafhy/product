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
        Schema::create('installments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_invoice_id')->constrained('sale_invoices')->cascadeOnDelete();
            $table->foreignId('customer_id')->nullable()->constrained('customers')->nullOnDelete();
            
            $table->decimal('amount', 15, 4);
            $table->date('due_date');
            $table->date('paid_date')->nullable();
            
            $table->enum('status', ['not_paid', 'paid', 'overdue'])->default('not_paid');
            
            $table->string('payment_type')->nullable(); // cash, credit_card, etc.
            
            // Guarantor details
            $table->string('guarantor_name')->nullable();
            $table->string('guarantor_phone')->nullable();
            
            $table->integer('days_limit')->default(0); // Grace period
            $table->text('description')->nullable();
            
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('installments');
    }
};
