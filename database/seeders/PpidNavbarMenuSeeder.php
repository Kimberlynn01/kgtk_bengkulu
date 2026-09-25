<?php
// database/seeders/PpidNavbarMenuSeeder.php

namespace Database\Seeders;

use App\Models\NavbarMenu;
use Illuminate\Database\Seeder;

class PpidNavbarMenuSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedPpidMenu();
        $this->seedAkuntabilitasMenu();
    }

    private function seedPpidMenu(): void
    {
        $lastOrder = NavbarMenu::whereNull('parent_id')->max('sort_order') ?? 0;

        $ppid = NavbarMenu::firstOrCreate(
            ['slug' => 'ppid'],
            [
                'parent_id'  => null,
                'name'       => 'PPID',
                'path'       => null,
                'icon'       => null,
                'sort_order' => $lastOrder + 1,
                'is_active'  => true,
            ]
        );

        $childs = [
            ['name' => 'Visi Misi', 'slug' => 'ppid_visi_misi', 'path' => '/profil/visi-misi'],
            ['name' => 'Tugas dan Fungsi', 'slug' => 'ppid_tugas_fungsi', 'path' => '/profil/tugas-dan-fungsi'],
            ['name' => 'Layanan Informasi', 'slug' => 'ppid_layanan_informasi', 'path' => '/ppid/layanan-informasi'],
            ['name' => 'Informasi Berkala', 'slug' => 'ppid_informasi_berkala', 'path' => '/ppid/informasi-berkala'],
            ['name' => 'Informasi Dikecualikan', 'slug' => 'ppid_informasi_dikecualikan', 'path' => '/ppid/informasi-dikecualikan'],
            ['name' => 'Daftar Informasi Publik', 'slug' => 'ppid_daftar_informasi_publik', 'path' => '/ppid/daftar-informasi-publik'],
        ];

        foreach ($childs as $index => $child) {
            NavbarMenu::firstOrCreate(
                ['slug' => $child['slug']],
                [
                    'parent_id'  => $ppid->id,
                    'name'       => $child['name'],
                    'path'       => $child['path'],
                    'icon'       => null,
                    'sort_order' => $index + 1,
                    'is_active'  => true,
                ]
            );
        }
    }

    private function seedAkuntabilitasMenu(): void
    {
        $akuntabilitas = NavbarMenu::where('slug', 'akuntabilitas')->first();

        if (! $akuntabilitas) {
            $lastOrder = NavbarMenu::whereNull('parent_id')->max('sort_order') ?? 0;

            $akuntabilitas = NavbarMenu::firstOrCreate(
                ['slug' => 'akuntabilitas'],
                [
                    'parent_id'  => null,
                    'name'       => 'Akuntabilitas',
                    'path'       => null,
                    'icon'       => null,
                    'sort_order' => $lastOrder + 1,
                    'is_active'  => true,
                ]
            );
        }

        $lastChildOrder = NavbarMenu::where('parent_id', $akuntabilitas->id)->max('sort_order') ?? 0;

        $childs = [
            ['name' => 'DIPA', 'slug' => 'akuntabilitas_dipa', 'path' => '/akuntabilitas/dipa'],
            ['name' => 'Rencana Kerja Anggaran', 'slug' => 'akuntabilitas_rka', 'path' => '/akuntabilitas/rencana-kerja-anggaran'],
        ];

        foreach ($childs as $index => $child) {
            NavbarMenu::firstOrCreate(
                ['slug' => $child['slug']],
                [
                    'parent_id'  => $akuntabilitas->id,
                    'name'       => $child['name'],
                    'path'       => $child['path'],
                    'icon'       => null,
                    'sort_order' => $lastChildOrder + $index + 1,
                    'is_active'  => true,
                ]
            );
        }
    }
}