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
        Schema::create('menus', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('menu_group_id')->unsigned()->nullable(true)->default(null);
            $table->uuid('parent_id')->nullable(true)->default(null);
            $table->string('name', 255)->nullable(false);
            $table->string('slug_name', 255)->nullable(false);
            $table->integer('menu_order')->unsigned()->nullable()->default(null);
            $table->string('link', 100)->nullable()->default(null);
            $table->string('icon', 100)->nullable()->default(null);
            $table->tinyInteger('is_active')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
