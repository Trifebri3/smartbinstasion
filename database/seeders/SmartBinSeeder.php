<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\SmartBin;
use App\Models\EducationMaterial;

class SmartBinSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin (Full Control & Full Akses ke SmartBin)
        User::updateOrCreate(
            ['email' => 'admin@smartbin.myoin.id'],
            [
                'name' => 'Administrator SmartBin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'points' => 9999,
                'qr_code_token' => 'SB-ADM-MASTER99',
            ]
        );

        // 2. Akun User Demonstrasi
        User::updateOrCreate(
            ['email' => 'user@smartbin.myoin.id'],
            [
                'name' => 'Ahmad Fauzi (Mahasiswa)',
                'password' => Hash::make('user123'),
                'role' => 'user',
                'points' => 250,
                'qr_code_token' => 'SB-USR-AHMAD2026',
            ]
        );

        // 3. Titik-Titik Lokasi SmartBin Terdekat (Area UIN SGD Bandung & Sekitarnya)
        $locations = [
            [
                'code' => 'STATION-01',
                'name' => 'SmartBin Rektorat Utama',
                'location_name' => 'Lobby Gedung Rektorat Kampus 1 UIN SGD Bandung',
                'latitude' => -6.929824,
                'longitude' => 107.718162,
                'status' => 'active',
                'organik' => 25.0,
                'plastik' => 45.0,
                'kertas' => 20.0,
                'logam' => 70.0,
            ],
            [
                'code' => 'STATION-02',
                'name' => 'SmartBin Sains & Teknologi',
                'location_name' => 'Plaza Fakultas Sains dan Teknologi (FST)',
                'latitude' => -6.929210,
                'longitude' => 107.717650,
                'status' => 'active',
                'organik' => 15.0,
                'plastik' => 60.0,
                'kertas' => 35.0,
                'logam' => 20.0,
            ],
            [
                'code' => 'STATION-03',
                'name' => 'SmartBin Tarbiyah & Keguruan',
                'location_name' => 'Koridor Fakultas Tarbiyah dan Keguruan (FTK)',
                'latitude' => -6.930410,
                'longitude' => 107.718910,
                'status' => 'active',
                'organik' => 40.0,
                'plastik' => 85.0,
                'kertas' => 50.0,
                'logam' => 30.0,
            ],
            [
                'code' => 'STATION-04',
                'name' => 'SmartBin Masjid Ikomah',
                'location_name' => 'Halaman Masjid Ikomah Kampus 1 UIN SGD',
                'latitude' => -6.928750,
                'longitude' => 107.719220,
                'status' => 'active',
                'organik' => 10.0,
                'plastik' => 30.0,
                'kertas' => 15.0,
                'logam' => 10.0,
            ]
        ];

        $hasStationCode = Schema::hasColumn('smart_bins', 'station_code');
        foreach ($locations as $loc) {
            if ($hasStationCode) {
                SmartBin::updateOrCreate(
                    ['station_code' => $loc['code']],
                    [
                        'name' => $loc['name'],
                        'location_name' => $loc['location_name'],
                        'latitude' => $loc['latitude'],
                        'longitude' => $loc['longitude'],
                        'status' => $loc['status'],
                        'capacity_organic' => $loc['organik'],
                        'capacity_plastic' => $loc['plastik'],
                        'capacity_paper' => $loc['kertas'],
                        'capacity_metal' => $loc['logam'],
                        'is_online' => true,
                        'last_ping_at' => now(),
                    ]
                );
            } else {
                SmartBin::updateOrCreate(
                    ['uuid' => $loc['code']],
                    [
                        'name' => $loc['name'],
                        'location_name' => $loc['location_name'],
                        'latitude' => $loc['latitude'],
                        'longitude' => $loc['longitude'],
                        'status' => $loc['status'],
                        'capacity_organik' => $loc['organik'],
                        'capacity_plastik' => $loc['plastik'],
                        'capacity_kertas' => $loc['kertas'],
                        'capacity_logam' => $loc['logam'],
                        'last_sync_at' => now(),
                    ]
                );
            }
        }

        // 4. Materi Edukasi Ekoteologi & Pemilahan
        $materials = [
            [
                'category' => 'organik',
                'title' => 'Berkah Makanan & Kompos Tanah',
                'color_badge' => '#10B981',
                'icon' => 'leaf',
                'summary' => 'Sampah organik seperti sisa makanan dan daun adalah nutrisi fitrah bumi. Memilahnya mencegah produksi gas metana berbahaya di TPA dan menghasilkan pupuk kompos subur.',
                'sorting_guide' => 'Wadah Hijau: Sisa sayuran, nasi, kulit buah, daun kering, ampas kopi/teh. Jangan masukkan plastik kemasan atau styrofoam.',
                'recycling_impact' => 'Dapat diolah menjadi pupuk kompos berkualitas tinggi dan pakan budidaya maggot BSF untuk ketahanan pangan kampus.',
                'eco_theology_quote' => 'Dan Dia-lah yang menurunkan air hujan dari langit, lalu Kami tumbuhkan dengan air itu segala macam tumbuh-tumbuhan.',
                'eco_theology_ref' => 'QS. Al-An\'am: 99',
            ],
            [
                'category' => 'plastik',
                'title' => 'Menjaga Mizan (Keseimbangan) dari Polusi Plastik',
                'color_badge' => '#F59E0B',
                'icon' => 'recycle',
                'summary' => 'Plastik membutuhkan ratusan tahun untuk terurai dan terfragmentasi menjadi mikroplastik beracun. Pemilahan plastik mendukung ekonomi sirkular dan perlindungan ekosistem laut.',
                'sorting_guide' => 'Wadah Kuning/Orange: Botol PET, gelas air mineral, tutup botol, kantong kresek bersih. Kosongkan sisa cairan terlebih dahulu.',
                'recycling_impact' => 'Didaur ulang menjadi biji plastik rPET, benang poliester, dakron tekstil, dan papan paving ramah lingkungan.',
                'eco_theology_quote' => 'Telah tampak kerusakan di darat dan di laut disebabkan karena perbuatan tangan manusia.',
                'eco_theology_ref' => 'QS. Ar-Rum: 41',
            ],
            [
                'category' => 'kertas',
                'title' => 'Menghargai Pohon & Keberlanjutan Pohon Kehidupan',
                'color_badge' => '#3B82F6',
                'icon' => 'book-open',
                'summary' => 'Setiap ton kertas daur ulang menyelamatkan sekitar 17 pohon dewasa dan 26.000 liter air bersih. Menghindari pemborosan kertas adalah wujud syukur nikmat ilmu dan alam.',
                'sorting_guide' => 'Wadah Biru: Kardus, kertas HVS, koran, majalah, karton telur. Pastikan tidak terkena minyak atau air sisa makanan.',
                'recycling_impact' => 'Dilebur menjadi bubur kertas (pulp) untuk karton kemasan baru, buku tulis ramah lingkungan, dan kantong belanja kertas.',
                'eco_theology_quote' => 'Dan pohon-pohonan dan tumbuh-tumbuhan kedua-duanya tunduk kepada-Nya.',
                'eco_theology_ref' => 'QS. Ar-Rahman: 6',
            ],
            [
                'category' => 'logam',
                'title' => 'Kekuatan Besi & Daur Ulang Mineral Logam',
                'color_badge' => '#EF4444',
                'icon' => 'sparkles',
                'summary' => 'Logam dan kaca dapat didaur ulang tanpa batas tanpa kehilangan kualitas fisiknya. Menghemat hingga 95% energi dibanding menambang bijih logam mentah baru.',
                'sorting_guide' => 'Wadah Abu-abu/Merah: Kaleng minuman aluminium, kaleng susu, sendok logam rusak, botol kaca sirup/selai.',
                'recycling_impact' => 'Dilebur kembali di pabrik peleburan aluminium/baja menjadi produk logam baru dengan jejak karbon sangat rendah.',
                'eco_theology_quote' => 'Dan Kami menciptakan besi yang padanya terdapat kekuatan yang hebat dan berbagai manfaat bagi manusia.',
                'eco_theology_ref' => 'QS. Al-Hadid: 25',
            ],
        ];

        foreach ($materials as $mat) {
            EducationMaterial::updateOrCreate(
                ['category' => $mat['category']],
                $mat
            );
        }
    }
}
