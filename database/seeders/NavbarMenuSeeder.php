<?php
// database/seeders/NavbarMenuSeeder.php

namespace Database\Seeders;

use App\Models\NavbarMenu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NavbarMenuSeeder extends Seeder
{
    public function run(): void
    {
        NavbarMenu::truncate();

        $data = [
            [
                'name' => 'Home', 'slug' => 'home', 'path' => '/', 'order' => 1,
            ],
            [
                'name' => 'Profile', 'slug' => 'profile', 'path' => null, 'order' => 2,
                'childs' => [
                    ['name' => 'Visi dan Misi', 'slug' => 'profile_visi_misi', 'path' => '/profil/visi-misi'],
                    ['name' => 'Tugas dan Fungsi', 'slug' => 'profile_tugas_fungsi', 'path' => '/profil/tugas-dan-fungsi'],
                    ['name' => 'Sejarah', 'slug' => 'profile_sejarah', 'path' => '/profil/sejarah'],
                    ['name' => 'Tim Kerja', 'slug' => 'profile_tim_kerja', 'path' => '/profil/tim-kerja'],
                    ['name' => 'Janji dan Maklumat Layanan', 'slug' => 'profile_janji_maklumat', 'path' => '/profil/janji-maklumat-layanan'],
                    ['name' => 'Panduan Perilaku Core Value', 'slug' => 'profile_core_value', 'path' => '/profil/panduan-perilaku-core-value'],
                ],
            ],
            [
                'name' => 'Publikasi', 'slug' => 'publikasi', 'path' => null, 'order' => 3,
                'childs' => [
                    ['name' => 'Artikel', 'slug' => 'publikasi_artikel', 'path' => '/publikasi/artikel'],
                    ['name' => 'Berita', 'slug' => 'publikasi_berita', 'path' => '/publikasi/berita'],
                    ['name' => 'Data Sasaran KGTK Bengkulu', 'slug' => 'publikasi_data_sasaran', 'path' => '/publikasi/data-sasaran'],
                    ['name' => 'Hasil Survey Kepuasan Masyarakat', 'slug' => 'publikasi_hasil_survey', 'path' => '/publikasi/survey-kepuasan'],
                    ['name' => 'Capaian Kerja', 'slug' => 'publikasi_capaian_kerja', 'path' => '/publikasi/capaian-kerja'],
                ],
            ],
            [
                'name' => 'Layanan', 'slug' => 'layanan', 'path' => null, 'order' => 4,
                'childs' => [
                    ['name' => 'Permohonan Informasi', 'slug' => 'layanan_permohonan_informasi', 'path' => '/layanan/permohonan-informasi'],
                    ['name' => 'Pemanfaatan Sarana dan Prasarana', 'slug' => 'layanan_sarana_prasarana', 'path' => '/layanan/pemanfaatan-sarana-prasarana'],
                    ['name' => 'Permohonan Narasumber', 'slug' => 'layanan_permohonan_narasumber', 'path' => '/layanan/permohonan-narasumber'],
                    ['name' => 'Permohonan Kerja Sama', 'slug' => 'layanan_permohonan_kerja_sama', 'path' => '/layanan/permohonan-kerja-sama'],
                    ['name' => 'Tanya Jawab', 'slug' => 'layanan_tanya_jawab', 'path' => '/program/tanya-jawab'],
                ],
            ],
            [
                'name' => 'Program', 'slug' => 'program', 'path' => null, 'order' => 5,
                'childs' => [
                    [
                        'name' => 'Program Prioritas', 'slug' => 'program_prioritas', 'path' => null,
                        'childs' => [
                            ['name' => 'Peningkatan Kompetensi Guru', 'slug' => 'program_prioritas_guru', 'path' => '/program/prioritas/peningkatan-kompetensi-guru'],
                            ['name' => 'Peningkatan Kompetensi Kepala Sekolah', 'slug' => 'program_prioritas_kepsek', 'path' => '/program/prioritas/peningkatan-kompetensi-kepala-sekolah'],
                            ['name' => 'Peningkatan Kompetensi Pengawas Sekolah', 'slug' => 'program_prioritas_pengawas', 'path' => '/program/prioritas/peningkatan-kompetensi-pengawas-sekolah'],
                            ['name' => 'Peningkatan Kompetensi Tenaga Kependidikan', 'slug' => 'program_prioritas_tendik', 'path' => '/program/prioritas/peningkatan-kompetensi-tenaga-kependidikan'],
                        ],
                    ],
                    [
                        'name' => 'Program Inovasi', 'slug' => 'program_inovasi', 'path' => null,
                        'childs' => [
                            ['name' => 'SiKobe', 'slug' => 'program_inovasi_sikobe', 'path' => '/program/inovasi/sikobe'],
                            ['name' => 'Pelatihan TIK Adaptif', 'slug' => 'program_inovasi_tik', 'path' => '/program/inovasi/pelatihan-tik-adaptif'],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Akuntabilitas', 'slug' => 'akuntabilitas', 'path' => null, 'order' => 6,
                'childs' => [
                    ['name' => 'Rencana Strategis', 'slug' => 'akuntabilitas_renstra', 'path' => '/akuntabilitas/rencana-strategis'],
                    ['name' => 'Perjanjian Kerja', 'slug' => 'akuntabilitas_perjanjian_kerja', 'path' => '/akuntabilitas/perjanjian-kinerja'],
                    ['name' => 'Laporan Kerja', 'slug' => 'akuntabilitas_laporan_kerja', 'path' => '/akuntabilitas/laporan-kinerja'],
                ],
            ],
            [
                'name' => 'Pengaduan', 'slug' => 'pengaduan', 'path' => '/pengaduan/sp4n-lapor', 'order' => 7,
            ],
        ];

        foreach ($data as $item) {
            $this->createRecursive($item, null);
        }
    }

    private function createRecursive(array $item, ?int $parentId): void
    {
        $menu = NavbarMenu::create([
            'parent_id'  => $parentId,
            'name'       => $item['name'],
            'slug'       => $item['slug'],
            'path'       => $item['path'] ?? null,
            'sort_order' => $item['order'] ?? 0,
            'is_active'  => true,
        ]);

        foreach ($item['childs'] ?? [] as $index => $child) {
            $child['order'] = $index + 1;
            $this->createRecursive($child, $menu->id);
        }
    }
}