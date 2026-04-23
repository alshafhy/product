<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shop_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->string('shop_name');
            $table->string('shop_ar_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('currency')->default('EGP');
            $table->string('currency_symbol')->default('ج.م');
            $table->unsignedTinyInteger('decimal_places')->default(2);
            $table->json('print_settings')->nullable();
            $table->json('invoice_settings')->nullable();
            $table->timestamps();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shop_settings');
    }
};
