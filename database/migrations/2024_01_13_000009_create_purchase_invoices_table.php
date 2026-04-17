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
        Schema::create('purchase_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            
            $table->foreignId('supplier_id')
                ->nullable()
                ->constrained('suppliers')
                ->nullOnDelete();
            
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('branch_id')->constrained('branches');
            
            $table->decimal('total', 15, 4)->default(0);
            $table->decimal('paid', 15, 4)->default(0);
            $table->decimal('remaining', 15, 4)->default(0);
            
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
        Schema::dropIfExists('purchase_invoices');
    }
};
