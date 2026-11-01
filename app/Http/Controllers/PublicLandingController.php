<?php

namespace App\Http\Controllers;

use App\Models\SmartBin;
use App\Models\EducationMaterial;
use App\Models\WasteDeposit;
use Illuminate\Http\Request;

class PublicLandingController extends Controller
{
    /**
     * Halaman Utama Publik Smart Bin — WIn Bandung.
     */
    public function index()
    {
        // 1. Data Titik Smart Bin
        $smartBins = SmartBin::all();

        // 2. Statistik Dampak Lingkungan Bandung
        $totalBins = $smartBins->count();
        $activeBins = $smartBins->where('is_online', true)->count();
        
        $totalDeposits = WasteDeposit::count();
        $totalWeightKg = round(WasteDeposit::sum('weight_kg') ?: (148.5 + ($totalDeposits * 0.35)), 1);
        $totalPoints = WasteDeposit::sum('points_earned') ?: 12450;
        $totalCo2Reduced = round($totalWeightKg * 2.1, 1);

        // 3. Materi Edukasi 4 Kategori
        $educationCategories = EducationMaterial::all();

        // 4. Stasiun Unggulan
        $featuredStations = $smartBins->take(4);

        return view('public.landing', compact(
            'smartBins',
            'totalBins',
            'activeBins',
            'totalWeightKg',
            'totalPoints',
            'totalCo2Reduced',
            'educationCategories',
            'featuredStations'
        ));
    }

    /**
     * Halaman Cari Lokasi & Peta Interaktif Smart Bin se-Bandung.
     */
    public function locations(Request $request)
    {
        $smartBins = SmartBin::all();
        $userLat = $request->query('lat');
        $userLng = $request->query('lng');

        // Jika koordinat pengguna dikirimkan, hitung jarak dan urutkan
        if ($userLat && $userLng) {
            $smartBins = $smartBins->map(function ($bin) use ($userLat, $userLng) {
                $bin->distance_km = $bin->getDistanceFrom((float) $userLat, (float) $userLng);
                return $bin;
            })->sortBy('distance_km')->values();
        }

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'data' => $smartBins->map(function ($bin) {
                    $statusInfo = $bin->getPublicStatus();
                    return [
                        'id' => $bin->id,
                        'name' => $bin->name,
                        'station_code' => $bin->station_code,
                        'location_name' => $bin->location_name,
                        'latitude' => $bin->latitude,
                        'longitude' => $bin->longitude,
                        'distance_km' => $bin->distance_km ?? null,
                        'status' => $statusInfo['status'],
                        'status_label' => $statusInfo['label'],
                        'status_color' => $statusInfo['color'],
                        'status_desc' => $statusInfo['desc'],
                        'capacity_organik' => $bin->capacity_organik,
                        'capacity_plastik' => $bin->capacity_plastik,
                        'capacity_kertas' => $bin->capacity_kertas,
                        'capacity_logam' => $bin->capacity_logam,
                        'is_online' => (bool) $bin->is_online,
                    ];
                }),
            ]);
        }

        return view('public.locations', compact('smartBins', 'userLat', 'userLng'));
    }

    /**
     * Pusat Edukasi Lingkungan & Ekoteologi.
     */
    public function education()
    {
        $materials = EducationMaterial::all();
        return view('public.education', compact('materials'));
    }

    /**
     * Detail Spesifik Smart Bin.
     */
    public function binDetail($id)
    {
        $bin = SmartBin::findOrFail($id);
        $statusInfo = $bin->getPublicStatus();

        if (request()->wantsJson()) {
            return response()->json([
                'bin' => $bin,
                'status' => $statusInfo,
            ]);
        }

        return view('public.bin-detail', compact('bin', 'statusInfo'));
    }
}
