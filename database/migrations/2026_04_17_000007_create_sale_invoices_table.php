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
            $table->foreignId('customer_id')->nullable()->constrained('customers')->nullOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('branch_id')->constrained('branches')->cascadeOnDelete();
            
            // Financials (decimal 15,4)
            $table->decimal('subtotal', 15, 4)->default(0);
            $table->decimal('discount', 15, 4)->default(0);
            $table->string('discount_type')->default('fixed'); // fixed, percentage
            $table->decimal('total', 15, 4)->default(0);
            
            // Accounting
            $table->decimal('cost', 15, 4)->default(0);
            $table->decimal('profit', 15, 4)->default(0);
            
            // Payment tracking
            $table->decimal('paid', 15, 4)->default(0);
            $table->decimal('remaining', 15, 4)->default(0);
            
            // Debt snapshot
            $table->decimal('previous_debt', 15, 4)->default(0);
            $table->decimal('total_debt', 15, 4)->default(0);
            
            $table->string('payment_type')->default('cash'); // cash, credit, etc.
            $table->string('status')->default('paid'); // paid, partially_paid, unpaid, void
            
            $table->text('notes')->nullable();
            $table->dateTime('invoiced_at');
            
            // Audit
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            
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
