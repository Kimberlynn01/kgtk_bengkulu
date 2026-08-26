<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PtkMenuSeeder extends Seeder
{
    public function run(): void
    {
        $group   = MenuGroup::firstOrCreate(['name' => 'Manajemen']);
        $groupId = $group->id;

        $roleId = 1;

        $menus = [
            ['name' => 'Data PTK',         'slug' => 'ptk',       'link' => 'ptk',       'icon' => 'icofont icofont-listing-box',   'order' => 20],
            ['name' => 'Rekapitulasi PTK', 'slug' => 'ptk_recap', 'link' => 'ptk/recap', 'icon' => 'icofont icofont-chart-pie-alt', 'order' => 21],
        ];

        foreach ($menus as $m) {
            $menu = Menu::withTrashed()->firstOrCreate(
                ['slug_name' => $m['slug']],
                [
                    'id'            => Str::uuid(),
                    'menu_group_id' => $groupId,
                    'parent_id'     => null,
                    'name'          => $m['name'],
                    'menu_order'    => $m['order'],
                    'link'          => $m['link'],
                    'icon'          => $m['icon'],
                    'is_active'     => 1,
                ]
            );

            if ($menu->trashed()) {
                $menu->restore();
            }

            for ($actionId = 1; $actionId <= 5; $actionId++) {
                DB::table('menu_role')->updateOrInsert(
                    ['menu_id' => $menu->id, 'role_id' => $roleId, 'action_id' => $actionId],
                    ['created_at' => now(), 'updated_at' => now()]
                );
            }
        }
    }
}