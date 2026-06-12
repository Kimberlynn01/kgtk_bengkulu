<?php

namespace Database\Seeders;

use App\Models\Action;
use App\Models\Menu;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arr = ['Super Admin', 'User'];

        $allMenus = Menu::all()->pluck('id');
        $homeMenu = Menu::where('name', '=', 'Beranda')->first();
        $profilMenu = Menu::where('name', '=', 'Profil')->first();

        $allActions = Action::all()->pluck('id');

        DB::table('roles')->truncate();
        DB::table('menu_role')->truncate();
        foreach ($arr as $key => $value) {
            $role = Role::create([
                'name' => $value,
                'slug_name' => Str::slug($value),
                'is_active' => 1
            ]);

            if ($key === 0) {
                foreach ($allMenus as $menu) {
                    foreach ($allActions as $action) {
                        $role->menus()->attach($menu, ['action_id' => $action]);
                    }
                }
            } else {
                $allowedMenus = collect([$homeMenu, $profilMenu])->filter();

                foreach ($allowedMenus as $menu) {
                    foreach ($allActions as $action) {
                        $role->menus()->attach($menu->id, ['action_id' => $action]);
                    }
                }
            }
        }
    }
}
