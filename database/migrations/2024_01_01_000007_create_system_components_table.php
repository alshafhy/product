<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('system_components', function (Blueprint $table) {
            $table->id();
            $table->string('comp_name');
            $table->string('comp_ar_label');
            $table->text('description')->nullable();
            $table->integer('_lft')->default(0);
            $table->integer('_rgt')->default(0);
            $table->integer('comp_type')->default(0);
            $table->string('route_name')->nullable();
            $table->string('prefix')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('system_components')->nullOnDelete();
            $table->string('icon_name')->nullable();
            $table->string('icon_class')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->string('permission_name')->nullable();
            $table->json('config')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('system_components');
    }
};
