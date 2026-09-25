<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PpidMenuSeeder extends Seeder
{
    public function run(): void
    {
        $group   = MenuGroup::firstOrCreate(['name' => 'PPID']);
        $groupId = $group->id;

        $roleId = 1;

        $menus = [
            [
                'slug_name'  => 'ppid_visi_misi',
                'name'       => 'Visi Misi',
                'menu_order' => 5,
                'link'       => 'ppid/visi-misi',
                'icon'       => 'icofont icofont-paper-plane',
            ],
            [
                'slug_name'  => 'ppid_tugas_fungsi',
                'name'       => 'Tugas dan Fungsi',
                'menu_order' => 6,
                'link'       => 'ppid/tugas-fungsi',
                'icon'       => 'icofont icofont-tasks-alt',
            ],
            [
                'slug_name'  => 'layanan_informasi',
                'name'       => 'Layanan Informasi',
                'menu_order' => 2,
                'link'       => 'ppid/layanan-informasi',
                'icon'       => 'icofont icofont-info-square',
            ],
            [
                'slug_name'  => 'informasi_dikecualikan',
                'name'       => 'Informasi Dikecualikan',
                'menu_order' => 3,
                'link'       => 'ppid/informasi-dikecualikan',
                'icon'       => 'icofont icofont-ban',
            ],
            [
                'slug_name'  => 'daftar_informasi_publik',
                'name'       => 'Daftar Informasi Publik',
                'menu_order' => 4,
                'link'       => 'ppid/daftar-informasi-publik',
                'icon'       => 'icofont icofont-listing-box',
            ],
        ];

        foreach ($menus as $item) {
            $menu = Menu::withTrashed()->firstOrCreate(
                ['slug_name' => $item['slug_name']],
                [
                    'menu_group_id' => $groupId,
                    'parent_id'     => null,
                    'name'          => $item['name'],
                    'menu_order'    => $item['menu_order'],
                    'link'          => $item['link'],
                    'icon'          => $item['icon'],
                    'is_active'     => 1,
                ]
            );

            if ($menu->trashed()) {
                $menu->restore();
            }

            foreach ([1, 2, 3, 4] as $actionId) {
                DB::table('menu_role')->updateOrInsert(
                    ['menu_id' => $menu->id, 'role_id' => $roleId, 'action_id' => $actionId],
                    ['created_at' => now(), 'updated_at' => now()]
                );
            }
        }
    }
}