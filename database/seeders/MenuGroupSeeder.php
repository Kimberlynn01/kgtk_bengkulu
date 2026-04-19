<?php

namespace Database\Seeders;

use App\Models\MenuGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Beranda',
            'Page Profil',
            'Layanan Page',
            'Publikasi',
            'Manajemen',
        ];
        DB::table('menu_groups')->truncate();
        foreach ($data as $key => $value) {
            MenuGroup::create([
                'name' => $value
            ]);
        }
    }
}
