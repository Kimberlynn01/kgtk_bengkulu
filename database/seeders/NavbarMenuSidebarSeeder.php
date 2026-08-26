<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NavbarMenuSidebarSeeder extends Seeder
{
    public function run(): void
    {
        $group   = MenuGroup::firstOrCreate(['name' => 'Manajemen']);
        $groupId = $group->id;

        $roleId = 1;

        $menu = Menu::withTrashed()->firstOrCreate(
            ['slug_name' => 'navbar_menu'],
            [
                'id'            => Str::uuid(),
                'menu_group_id' => $groupId,
                'parent_id'     => null,
                'name'          => 'Manajemen Navbar',
                'menu_order'    => 22,
                'link'          => 'navbar-menu',
                'icon'          => 'icofont icofont-navigation-menu',
                'is_active'     => 1,
            ]
        );

        if ($menu->trashed()) {
            $menu->restore();
        }

        foreach ([1, 3] as $actionId) {
            DB::table('menu_role')->updateOrInsert(
                ['menu_id' => $menu->id, 'role_id' => $roleId, 'action_id' => $actionId],
                ['created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}