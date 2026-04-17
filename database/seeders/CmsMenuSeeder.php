<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CmsMenuSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Menu Group for CMS if doesn't exist
        $group = MenuGroup::firstOrCreate(['name' => 'Manajemen Konten']);
        $groupId = $group->id;

        // 2. Define Menus
        $menus = [
            // PUBLIKASI
            [
                'name' => 'Publikasi',
                'slug_name' => 'publikasi_parent',
                'icon' => 'icofont icofont-notebook',
                'order' => 10,
                'childs' => [
                    ['name' => 'Artikel', 'slug' => 'artikel', 'link' => 'artikel', 'icon' => 'icofont icofont-document-folder'],
                    ['name' => 'Berita', 'slug' => 'berita', 'link' => 'berita', 'icon' => 'icofont icofont-news'],
                    ['name' => 'SKM', 'slug' => 'skm', 'link' => 'skm', 'icon' => 'icofont icofont-chart-histogram'],
                    ['name' => 'Hasil Survey', 'slug' => 'hasil_survey', 'link' => 'hasil_survey', 'icon' => 'icofont icofont-pie-chart'],
                ]
            ],
            // PROFIL
            [
                'name' => 'Profil KGTK',
                'slug_name' => 'profil_kgtk_parent',
                'icon' => 'icofont icofont-institution',
                'order' => 11,
                'childs' => [
                    ['name' => 'Visi Misi', 'slug' => 'visi_misi', 'link' => 'visi_misi', 'icon' => 'icofont icofont-bullseye'],
                    ['name' => 'Tugas Fungsi', 'slug' => 'tugas_fungsi', 'link' => 'tugas_fungsi', 'icon' => 'icofont icofont-tasks'],
                    ['name' => 'Tim Kerja', 'slug' => 'tim_kerja', 'link' => 'tim_kerja', 'icon' => 'icofont icofont-users-social'],
                    ['name' => 'Janji Maklumat', 'slug' => 'janji_maklumat', 'link' => 'janji_maklumat', 'icon' => 'icofont icofont-law-document'],
                    ['name' => 'Profil Pejabat', 'slug' => 'profil_pejabat', 'link' => 'profil_pejabat', 'icon' => 'icofont icofont-id-card'],
                ]
            ],
            // LAYANAN
            [
                'name' => 'Layanan',
                'slug_name' => 'layanan_parent',
                'icon' => 'icofont icofont-info-square',
                'order' => 12,
                'childs' => [
                    ['name' => 'Informasi & Program', 'slug' => 'informasi_program', 'link' => 'informasi_program', 'icon' => 'icofont icofont-info-circle'],
                    ['name' => 'Kemitraan', 'slug' => 'kemitraan', 'link' => 'kemitraan', 'icon' => 'icofont icofont-handshake'],
                ]
            ],
        ];

        foreach ($menus as $m) {
            $parent = Menu::create([
                'id' => Str::uuid(),
                'menu_group_id' => $groupId,
                'name' => $m['name'],
                'slug_name' => $m['slug_name'],
                'menu_order' => $m['order'],
                'link' => '#',
                'icon' => $m['icon'],
                'is_active' => 1,
            ]);

            // Assign view permission for parent
            DB::table('menu_role')->insert([
                'menu_id' => $parent->id,
                'role_id' => 1,
                'action_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($m['childs'] as $index => $c) {
                $child = Menu::create([
                    'id' => Str::uuid(),
                    'menu_group_id' => $groupId,
                    'parent_id' => $parent->id,
                    'name' => $c['name'],
                    'slug_name' => $c['slug'],
                    'menu_order' => $index + 1,
                    'link' => $c['link'],
                    'icon' => $c['icon'],
                    'is_active' => 1,
                ]);

                // Assign all permissions (1-4) for child
                for ($i = 1; $i <= 4; $i++) {
                    DB::table('menu_role')->insert([
                        'menu_id' => $child->id,
                        'role_id' => 1,
                        'action_id' => $i,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
