<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
return new class extends Migration
{
    public function up(): void
    {
        $labels = [
            'ppg'       => 'PPG',
            'bcks'      => 'BCKS',
            'bcps'      => 'BCPS',
            'pkgbk'     => 'PKGBK',
            'pkgsd mbi' => 'PKGSD MBI',
            'stem'      => 'STEM',
            'pm/kka'    => 'PM/KKA',
            'ukkj'      => 'UKKJ',
            'gpk mahir' => 'GPK Mahir',
            'SM'        => 'Sekolah Model',
        ];

        $categoryIds = [];

        foreach ($labels as $oldValue => $name) {
            $id = DB::table('qna_categories')->insertGetId([
                'name'       => $name,
                'slug'       => Str::slug($name),
                'is_active'  => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $categoryIds[$oldValue] = $id;
        }

        Schema::table('qnas', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->after('category')
                ->constrained('qna_categories')->nullOnDelete();
        });

        foreach ($categoryIds as $oldValue => $newId) {
            DB::table('qnas')->where('category', $oldValue)->update(['category_id' => $newId]);
        }

        Schema::table('qnas', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }

    public function down(): void
    {
        Schema::table('qnas', function (Blueprint $table) {
            $table->enum('category', [
                'ppg','bcks','bcps','pkgbk','pkgsd mbi','stem','pm/kka','ukkj','gpk mahir','SM'
            ])->nullable()->after('category_id');
        });

        $reverseMap = [
            'ppg' => 'ppg', 'bcks' => 'bcks', 'bcps' => 'bcps', 'pkgbk' => 'pkgbk',
            'pkgsd-mbi' => 'pkgsd mbi', 'stem' => 'stem', 'pm-kka' => 'pm/kka',
            'ukkj' => 'ukkj', 'gpk-mahir' => 'gpk mahir', 'sekolah-model' => 'SM',
        ];

        $categories = DB::table('qna_categories')->pluck('slug', 'id');

        foreach (DB::table('qnas')->whereNotNull('category_id')->get(['id', 'category_id']) as $row) {
            $slug = $categories[$row->category_id] ?? null;
            $old  = $reverseMap[$slug] ?? null;
            if ($old) {
                DB::table('qnas')->where('id', $row->id)->update(['category' => $old]);
            }
        }

        Schema::table('qnas', function (Blueprint $table) {
            $table->dropConstrainedForeignId('category_id');
        });
    }
};
