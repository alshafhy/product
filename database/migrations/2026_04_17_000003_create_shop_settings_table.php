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
        Schema::create('shop_settings', function (Blueprint $column) {
            $column->id();
            $column->foreignId('branch_id')
                ->constrained('branches')
                ->cascadeOnDelete();
            $column->string('shop_name');
            $column->string('phone');
            $column->string('logo_path')->nullable();
            $column->string('currency')->default('EGP');
            $column->json('print_settings');
            $column->json('invoice_settings');
            $column->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_settings');
    }
};
