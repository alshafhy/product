<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('system_releases', function (Blueprint $table) {
            $table->id();
            $table->string('version_number');
            $table->date('release_date');
            $table->integer('order')->nullable();
            $table->boolean('is_current')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('system_releases_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('system_release_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('description');
            $table->integer('feature_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('system_releases_features');
        Schema::dropIfExists('system_releases');
    }
};
