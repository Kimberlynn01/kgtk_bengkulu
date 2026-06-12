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
        Schema::create('qnas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('instansi');
            $table->bigInteger('phone');
            $table->string('email');
            $table->enum('category', ['ppg', 'bcks', 'pkgbk', 'pkgsd mbi', 'stem' ,'pm/kka', 'ukkj', 'gpk mahir']);
            $table->text('question');
            $table->text('answer')->nullable();
            $table->foreignUuid('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qnas');
    }
};
