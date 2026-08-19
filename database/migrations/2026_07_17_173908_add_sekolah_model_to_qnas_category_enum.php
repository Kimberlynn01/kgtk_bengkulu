<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // <-- Pastikan ini di-import

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE qnas MODIFY COLUMN category ENUM('ppg', 'bcks', 'bcps', 'pkgbk', 'pkgsd mbi', 'stem', 'pm/kka', 'ukkj', 'gpk mahir', 'sekolah model', 'SM') NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE qnas MODIFY COLUMN category ENUM('ppg', 'bcks', 'bcps', 'pkgbk', 'pkgsd mbi', 'stem', 'pm/kka', 'ukkj', 'gpk mahir', 'sekolah model') NOT NULL");
    }
};