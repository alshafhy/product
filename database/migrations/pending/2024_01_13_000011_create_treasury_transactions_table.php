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
        Schema::create('treasury_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained('branches')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            
            // Transaction type
            $table->enum('type', [
                'deposit',
                'withdrawal',
                'expense',
                'sale_receipt',
                'purchase_payment'
            ]);
            
            $table->decimal('amount', 15, 4);
            
            // Polymorphic relation (SaleInvoice, PurchaseInvoice, etc.)
            $table->nullableMorphs('reference');
            
            $table->string('description')->nullable();
            $table->timestamp('transacted_at')->useCurrent();
            
            // Audit
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
        Schema::dropIfExists('treasury_transactions');
    }
};
