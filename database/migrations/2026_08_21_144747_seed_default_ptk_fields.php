<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $fields = [
            [
                'label' => 'Nama', 'key' => 'nama', 'type' => 'text',
                'options' => null, 'is_required' => true, 'is_filterable' => false, 'sort_order' => 1,
            ],
            [
                'label' => 'Instansi', 'key' => 'instansi', 'type' => 'text',
                'options' => null, 'is_required' => true, 'is_filterable' => false, 'sort_order' => 2,
            ],
            [
                'label' => 'Jenjang', 'key' => 'jenjang', 'type' => 'select',
                'options' => json_encode(['PAUD', 'SD', 'SLB', 'SMA', 'SMK', 'SMP', 'SPNF']),
                'is_required' => true, 'is_filterable' => true, 'sort_order' => 3,
            ],
            [
                'label' => 'Jabatan', 'key' => 'jabatan', 'type' => 'select',
                'options' => json_encode(['Guru', 'Kepala Sekolah', 'Tenaga Kependidikan']),
                'is_required' => true, 'is_filterable' => true, 'sort_order' => 4,
            ],
        ];

        foreach ($fields as $f) {
            $f['created_at'] = now();
            $f['updated_at'] = now();
            DB::table('ptk_fields')->insert($f);
        }
    }

    public function down(): void
    {
        DB::table('ptk_fields')->whereIn('key', ['nama', 'instansi', 'jenjang', 'jabatan'])->delete();
    }
};