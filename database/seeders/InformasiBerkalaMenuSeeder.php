<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InformasiBerkalaMenuSeeder extends Seeder
{
    public function run(): void
    {
        $group   = MenuGroup::firstOrCreate(['name' => 'PPID']);
        $groupId = $group->id;

        $roleId = 1;

        $menu = Menu::withTrashed()->firstOrCreate(
            ['slug_name' => 'informasi_berkala'],
            [
                'menu_group_id' => $groupId,
                'parent_id'     => null,
                'name'          => 'Informasi Berkala',
                'menu_order'    => 1,
                'link'          => 'ppid/informasi-berkala',
                'icon'          => 'icofont icofont-file-document',
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