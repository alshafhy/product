<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemComponentsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_components', function (Blueprint $table) {
            $table->id();
            $table->string('comp_name');
            $table->string('comp_ar_label');
            $table->text('description')->nullable();
            $table->integer('_lft');
            $table->integer('_rgt');
            $table->integer('comp_type');
            $table->string('route_name');
            $table->string('prefix')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('system_components');
            $table->string('icon_name')->nullable();
            $table->json('config')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('system_components');
    }
}
