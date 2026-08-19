<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peningkatan_kompetensi_kepala_sekolahs', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->text('deskripsi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peningkatan_kompetensi_kepala_sekolahs');
    }
};
