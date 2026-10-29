<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
                'uuid' => 'STATION-01',
                'name' => 'SmartBin Rektorat Utama',
                'location_name' => 'Lobby Gedung Rektorat Kampus 1 UIN SGD Bandung',
                'latitude' => -6.929824,
                'longitude' => 107.718162,
                'status' => 'active',
                'capacity_organik' => 25.0,
                'capacity_plastik' => 45.0,
                'capacity_kertas' => 20.0,
                'capacity_logam' => 70.0,
                'last_sync_at' => now(),
            ],
            [
                'uuid' => 'STATION-02',
                'name' => 'SmartBin Sains & Teknologi',
                'location_name' => 'Plaza Fakultas Sains dan Teknologi (FST)',
                'latitude' => -6.929210,
                'longitude' => 107.717650,
                'status' => 'active',
                'capacity_organik' => 40.0,
                'capacity_plastik' => 85.0,
                'capacity_kertas' => 15.0,
                'capacity_logam' => 30.0,
                'last_sync_at' => now(),
            ],
            [
                'uuid' => 'STATION-03',
                'name' => 'SmartBin Perpustakaan Pusat',
                'location_name' => 'Samping Pintu Masuk Gedung Perpustakaan Kampus 1',
                'latitude' => -6.930450,
                'longitude' => 107.718890,
                'status' => 'active',
                'capacity_organik' => 15.0,
                'capacity_plastik' => 50.0,
                'capacity_kertas' => 60.0,
                'capacity_logam' => 20.0,
                'last_sync_at' => now(),
            ],
            [
                'uuid' => 'STATION-04',
                'name' => 'SmartBin Kampus 2 Cipadung',
                'location_name' => 'Kantin Kampus 2 Jl. Soekarno-Hatta UIN SGD',
                'latitude' => -6.933200,
                'longitude' => 107.715400,
                'status' => 'active',
                'capacity_organik' => 35.0,
                'capacity_plastik' => 40.0,
                'capacity_kertas' => 10.0,
                'capacity_logam' => 15.0,
                'last_sync_at' => now(),
            ],
        ];

        foreach ($locations as $loc) {
            SmartBin::updateOrCreate(
                ['uuid' => $loc['uuid']],
                $loc
            );
        }

        // 4. Modul Edukasi
        $educations = [
            [
                'category' => 'organik',
                'title' => 'Sampah Organik (Sisa Makanan & Dedaunan)',
                'color_badge' => 'emerald',
                'icon' => 'leaf',
                'summary' => 'Sampah yang mudah terurai hayati berasal dari sisa sayur, buah, nasi, dan dedaunan.',
                'sorting_guide' => 'Pisahkan dari kemasan plastik. Masukkan ke kompartemen hijau untuk diolah menjadi kompos.',
                'recycling_impact' => '1 kg sampah organik menghasilkan pupuk kompos alami dan mengurangi gas metana di TPA.',
                'eco_theology_quote' => 'Dan Dia-lah yang menjadikan tanaman-tanaman yang merambat dan yang tidak merambat... Makanlah dari buahnya bila dia berbuah dan tunaikanlah haknya di hari memetik hasilnya.',
                'eco_theology_ref' => 'QS. Al-An\'am: 141',
            ],
            [
                'category' => 'plastik',
                'title' => 'Sampah Anorganik: Plastik',
                'color_badge' => 'sky',
                'icon' => 'bottle',
                'summary' => 'Kemasan botol PET, gelas air mineral, kantong kresek, dan wadah polimer sintetis.',
                'sorting_guide' => 'Kosongkan sisa cairan, remas botol untuk menghemat ruang, masukkan ke kompartemen biru.',
                'recycling_impact' => 'Mendaur ulang 1 ton botol plastik menghemat 3,8 barel minyak bumi dan mencegah mikroplastik di lautan.',
                'eco_theology_quote' => 'Telah tampak kerusakan di darat dan di laut disebabkan karena perbuatan tangan manusia, supaya Allah merasakan kepada mereka sebagian dari (akibat) perbuatan mereka, agar mereka kembali (ke jalan yang benar).',
                'eco_theology_ref' => 'QS. Ar-Rum: 41',
            ],
            [
                'category' => 'kertas',
                'title' => 'Sampah Anorganik: Kertas & Karton',
                'color_badge' => 'amber',
                'icon' => 'newspaper',
                'summary' => 'Kardus, kertas HVS, amplop, koran, majalah, dan kotak karton kering.',
                'sorting_guide' => 'Pastikan kertas tidak basah atau berminyak, lipat rata, masukkan ke kompartemen kuning.',
                'recycling_impact' => 'Setiap 1 ton kertas yang didaur ulang menyelamatkan 17 batang pohon dewasa dan 26.500 liter air bersih.',
                'eco_theology_quote' => 'Kebersihan dan kesucian itu adalah separuh dari keimanan.',
                'eco_theology_ref' => 'HR. Muslim no. 223',
            ],
            [
                'category' => 'logam_kaca',
                'title' => 'Sampah Anorganik: Logam & Kaca',
                'color_badge' => 'rose',
                'icon' => 'cube',
                'summary' => 'Kaleng minuman aluminium, kaleng biskuit, botol kaca, pecahan piring, dan besi.',
                'sorting_guide' => 'Bilas bersih dari sisa makanan. Masukkan hati-hati ke kompartemen merah/rose.',
                'recycling_impact' => 'Aluminium dapat didaur ulang 100% tanpa batas tanpa mengurangi kualitasnya, menghemat 95% energi.',
                'eco_theology_quote' => 'Dan janganlah kamu berbuat kerusakan di muka bumi setelah (Allah) memperbaikinya...',
                'eco_theology_ref' => 'QS. Al-A\'raf: 56',
            ],
        ];

        foreach ($educations as $edu) {
            EducationMaterial::updateOrCreate(
                ['category' => $edu['category']],
                $edu
            );
        }
    }
}
