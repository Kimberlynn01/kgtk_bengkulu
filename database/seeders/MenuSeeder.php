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
            'menu_group_id' => 5,
            'slug_name' => 'pengguna',
            'menu_order' => 2,
            'link' => 'users',
            'icon' => 'icofont icofont-ui-user-group',
            'is_active' => 1,
        ]);

        // Menu::create([
        //     'name' => 'Manajemen Menu',
        //     'menu_group_id' => 2,
        //     'slug_name' => 'manajemen_menu',
        //     'menu_order' => 3,
        //     'link' => 'manajemen-menu',
        //     'icon' => 'icofont icofont-navigation-menu',
        //     'is_active' => 1,
        // ]);

        Menu::create([
            'name' => 'Otoritas',
            'menu_group_id' => 5,
            'slug_name' => 'otoritas',
            'menu_order' => 4,
            'link' => 'otoritas',
            'icon' => 'icofont icofont-shield-alt',
            'is_active' => 1,
        ]);

        Menu::create([
            'name' => 'Profil',
            'menu_group_id' => 1,
            'slug_name' => 'profil',
            'menu_order' => 5,
            'link' => 'profil',
            'icon' => 'icofont icofont-ui-user',
            'is_active' => 1,
        ]);

        $profil = [
            ['Visi dan Misi', 'visi_misi', 'visi_misi', 'icofont-paper-plane'],
            ['Tugas dan Fungsi', 'tugas_fungsi', 'tugas_fungsi', 'icofont-tasks-alt'],
            ['Tim Kerja', 'tim_kerja', 'tim_kerja', 'icofont-users-alt-2'],
            ['Janji & Maklumat Layanan', 'janji_maklumat', 'janji_maklumat', 'icofont-certificate-alt-1'],
            ['Profil Pejabat Struktural', 'profil_pejabat', 'profil_pejabat', 'icofont-users-social'],
            ['Struktur Organisasi', 'struktur_organisasi', 'struktur_organisasi', 'icofont-network'],
        ];

        foreach ($profil as $index => $m) {
            Menu::create([
                'name' => $m[0],
                'menu_group_id' => 2,
                'slug_name' => $m[1],
                'menu_order' => $index + 1,
                'link' => $m[2],
                'icon' => 'icofont ' . $m[3],
                'is_active' => 1,
            ]);
        }

        $layanan = [
            ['Informasi & Program', 'informasi_program', 'informasi_program', 'icofont-info-square'],
            ['Kemitraan', 'kemitraan', 'kemitraan', 'icofont-handshake-deal'],
            ['QnA', 'qna', 'qna', 'icofont-chat'],
            ['Permohonan Informasi',                       'permohonan_informasi',        'permohonan_informasi',        'icofont-file-document'],
            ['Permohonan Kerja Sama',                      'permohonan_kerja_sama',       'permohonan_kerja_sama',       'icofont-handshake-deal'],
            ['Permohonan Narasumber',                      'permohonan_narasumber',       'permohonan_narasumber',       'icofont-microphone-alt'],
            ['Permohonan Pemanfaatan Sarana & Prasarana',  'permohonan_sarana_prasarana', 'permohonan_sarana_prasarana', 'icofont-building-alt'],
        ];

        foreach ($layanan as $index => $m) {
            Menu::create([
                'name' => $m[0],
                'menu_group_id' => 3,
                'slug_name' => $m[1],
                'menu_order' => $index + 1,
                'link' => $m[2],
                'icon' => 'icofont ' . $m[3],
                'is_active' => 1,
            ]);
        }

        $publikasi = [
            ['Publikasi Artikel', 'artikel', 'artikel', 'icofont-read-book-alt'],
            ['Berita', 'berita', 'berita', 'icofont-news'],
            ['Survey Kepuasan (SKM)', 'skm', 'skm', 'icofont-listing-box'],
            ['Hasil Survey SKM', 'hasil_survey', 'hasil_survey', 'icofont-chart-histogram-alt'],
            ['Data Sasaran', 'data_sasaran', 'data_sasaran', 'icofont-focus'],
        ];

        foreach ($publikasi as $index => $m) {
            Menu::create([
                'name' => $m[0],
                'menu_group_id' => 4,
                'slug_name' => $m[1],
                'menu_order' => $index + 1,
                'link' => $m[2],
                'icon' => 'icofont ' . $m[3],
                'is_active' => 1,
            ]);
        }

        // Menu::create([
        //     'name' => 'Pengguna',
        //     'menu_group_id' => 5,
        //     'slug_name' => 'pengguna',
        //     'menu_order' => 1,
        //     'link' => 'users',
        //     'icon' => 'icofont icofont-ui-user-group',
        //     'is_active' => 1,
        // ]);

        Menu::create([
            'name' => 'Manajemen Menu',
            'menu_group_id' => 5,
            'slug_name' => 'manajemen_menu',
            'menu_order' => 2,
            'link' => 'manajemen-menu',
            'icon' => 'icofont icofont-navigation-menu',
            'is_active' => 1,
        ]);

        // Menu::create([
        //     'name' => 'Otoritas',
        //     'menu_group_id' => 5,
        //     'slug_name' => 'otoritas',
        //     'menu_order' => 3,
        //     'link' => 'otoritas',
        //     'icon' => 'icofont icofont-shield-alt',
        //     'is_active' => 1,
        // ]);
    }
}
