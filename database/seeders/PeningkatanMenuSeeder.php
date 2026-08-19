<?php

namespace Database\Seeders;

use App\Models\Action;
use App\Models\Menu;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeningkatanMenuSeeder extends Seeder
{
    public function run(): void
    {
        $menuGroupId = 3;

        $items = [
            ['Peningkatan Guru', 'peningkatan_guru', 'peningkatan-guru', 'icofont-teacher'],
            ['Peningkatan Kompetensi Kepala Sekolah', 'peningkatan_kompetensi_kepala_sekolah', 'peningkatan-kompetensi-kepala-sekolah', 'icofont-business-man-alt-2'],
            ['Peningkatan Kompetensi Pengawas Sekolah', 'peningkatan_kompetensi_pengawas_sekolah', 'peningkatan-kompetensi-pengawas-sekolah', 'icofont-binoculars'],
            ['Peningkatan Kompetensi Tenaga Pendidikan', 'peningkatan_kompetensi_tenaga_pendidikan', 'peningkatan-kompetensi-tenaga-pendidikan', 'icofont-graduate'],
        ];

        $nextOrder = (int) (Menu::where('menu_group_id', $menuGroupId)->max('menu_order') ?? 0) + 1;
        $superAdmin = Role::where('name', 'Super Admin')->first();
        $allActions = Action::all();

        foreach ($items as $m) {
            [$name, $slug, $link, $icon] = $m;

            $menu = Menu::firstOrCreate(
                ['slug_name' => $slug],
                [
                    'name' => $name,
                    'menu_group_id' => $menuGroupId,
                    'menu_order' => $nextOrder,
                    'link' => $link,
                    'icon' => 'icofont ' . $icon,
                    'is_active' => 1,
                ]
            );

            if ($menu->wasRecentlyCreated) {
                $nextOrder++;
                $this->command?->info("Menu '{$name}' dibuat.");
            } else {
                $this->command?->info("Menu '{$name}' sudah ada, dilewati.");
            }

            if ($superAdmin) {
                foreach ($allActions as $action) {
                    $alreadyAttached = DB::table('menu_role')
                        ->where('menu_id', $menu->id)
                        ->where('role_id', $superAdmin->id)
                        ->where('action_id', $action->id)
                        ->exists();

                    if (! $alreadyAttached) {
                        $superAdmin->menus()->attach($menu->id, ['action_id' => $action->id]);
                    }
                }
            } else {
                $this->command?->warn('Role "Super Admin" tidak ditemukan — menu dibuat tapi belum di-attach ke role manapun.');
            }
        }
    }
}
