<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('system_components', function (Blueprint $table) {
            if (!Schema::hasColumn('system_components', 'icon_class')) {
                $table->string('icon_class')->nullable()->after('icon_name');
            }
            if (!Schema::hasColumn('system_components', 'sort_order')) {
                $table->unsignedInteger('sort_order')->default(0)->after('icon_class');
            }
            if (!Schema::hasColumn('system_components', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('sort_order');
            }
            if (!Schema::hasColumn('system_components', 'permission_name')) {
                $table->string('permission_name')->nullable()->after('is_active');
            }
        });
    }

    public function down(): void
    {
        Schema::table('system_components', function (Blueprint $table) {
            $table->dropColumn(array_filter([
                Schema::hasColumn('system_components', 'icon_class')     ? 'icon_class'      : null,
                Schema::hasColumn('system_components', 'sort_order')     ? 'sort_order'      : null,
                Schema::hasColumn('system_components', 'is_active')      ? 'is_active'       : null,
                Schema::hasColumn('system_components', 'permission_name') ? 'permission_name' : null,
            ]));
        });
    }
};
