<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menus')->truncate();

        Menu::create([
            'name' => 'Beranda',
            'menu_group_id' => 1,
            'slug_name' => 'beranda',
            'menu_order' => 1,
            'link' => 'dashboard',
            'icon' => 'icofont icofont-ui-home',
            'is_active' => 1,
        ]);

        Menu::create([
            'name' => 'Pengguna',
            'menu_group_id' => 2,
            'slug_name' => 'pengguna',
            'menu_order' => 2,
            'link' => 'users',
            'icon' => 'icofont icofont-ui-user-group',
            'is_active' => 1,
        ]);

        Menu::create([
            'name' => 'Manajemen Menu',
            'menu_group_id' => 2,
            'slug_name' => 'manajemen_menu',
            'menu_order' => 3,
            'link' => 'manajemen-menu',
            'icon' => 'icofont icofont-navigation-menu',
            'is_active' => 1,
        ]);

        Menu::create([
            'name' => 'Otoritas',
            'menu_group_id' => 2,
            'slug_name' => 'otoritas',
            'menu_order' => 4,
            'link' => 'otoritas',
            'icon' => 'icofont icofont-shield-alt',
            'is_active' => 1,
        ]);
    }
}
