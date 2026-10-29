<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\User;
use App\Models\SmartBin;
use App\Models\WasteDeposit;
use App\Models\SensorLog;

class StationApiController extends Controller
{
    /**
     * Poin standar per jenis sampah (Gamifikasi).
     */
    private const POINT_RULES = [
        'organik' => 30,
        'plastik' => 50,
        'kertas' => 40,
        'logam_kaca' => 60,
    ];

    /**
     * Label manusiawi untuk kategori sampah.
     */
    private const CATEGORY_LABELS = [
        'organik' => 'Sampah Organik / Basah',
        'plastik' => 'Sampah Plastik',
        'kertas' => 'Sampah Kertas & Karton',
        'logam_kaca' => 'Sampah Logam & Kaca',
    ];

    /**
     * 1. Verifikasi QR Code dari Kamera SmartBin Raspberry Pi.
     * POST /api/station/verify-qr
     * Payload: { "qr_token": "SB-USR-XXXX" }
     */
    public function verifyQr(Request $request)
    {
        $qrToken = trim($request->input('qr_token', ''));
        if (empty($qrToken)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Token QR tidak boleh kosong'
            ], 400);
        }

        // Cari user berdasarkan token QR
        $user = User::where('qr_code_token', $qrToken)->first();

        if (!$user) {
            return response()->json([
                'status' => 'not_found',
                'message' => 'QR Code pengguna tidak dikenali dalam sistem.'
            ], 404);
        }

        return response()->json([
            'status' => 'ok',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'points' => (int) $user->points,
                'qr_token' => $user->qr_code_token,
                'avatar' => $user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name),
            ],
            'greeting' => "Halo, {$user->name}! Selamat Datang di SmartBin.",
            'instruction' => "Sesi Anda aktif. Silakan masukkan sampah Anda ke dalam wadah pemindaian."
        ]);
    }

    /**
     * 2. Catat Setoran Sampah dan Tambahkan Poin Pengguna (Gamifikasi).
     * POST /api/station/deposit
     * Payload: { "user_id": 2, "category": "plastik", "confidence": 98.2, "station_code": "STATION-01" }
     */
    public function storeDeposit(Request $request)
    {
        $request->validate([
            'category' => 'required|string',
            'confidence' => 'nullable|numeric',
            'station_code' => 'nullable|string',
        ]);

        $category = strtolower(trim($request->input('category')));
        $confidence = (float) $request->input('confidence', 95.0);
        $stationCode = $request->input('station_code', 'STATION-01');

        // Cari pengguna berdasarkan user_id atau qr_token
        $user = null;
        if ($request->filled('user_id')) {
            $user = User::find($request->input('user_id'));
        } elseif ($request->filled('qr_token')) {
            $user = User::where('qr_code_token', $request->input('qr_token'))->first();
        }

        // Tentukan perolehan poin berdasarkan kategori
        $pointsEarned = self::POINT_RULES[$category] ?? 25;
        $categoryLabel = self::CATEGORY_LABELS[$category] ?? ucfirst($category);
        $targetBin = match($category) {
            'organik' => 'BIN 1',
            'plastik' => 'BIN 2',
            'kertas' => 'BIN 3',
            'logam_kaca' => 'BIN 4',
            default => 'BIN 1'
        };

        $totalPoints = 0;
        $userName = 'Tamu Umum (Guest)';

        if ($user) {
            // Temukan ID SmartBin berdasarkan station_code
            $bin = SmartBin::where('uuid', $stationCode)->first();
            $binId = $bin ? $bin->id : 1;

            // Catat transaksi setoran
            WasteDeposit::create([
                'user_id' => $user->id,
                'smart_bin_id' => $binId,
                'category' => $category,
                'points_earned' => $pointsEarned,
                'confidence' => $confidence,
                'weight_est_kg' => match($category) {
                    'organik' => 0.35,
                    'plastik' => 0.15,
                    'kertas' => 0.20,
                    'logam_kaca' => 0.40,
                    default => 0.25
                },
                'source' => 'station_camera',
            ]);

            // Akumulasi Poin Pengguna
            $user->increment('points', $pointsEarned);
            $totalPoints = (int) $user->points;
            $userName = $user->name;
        }

        return response()->json([
            'status' => 'ok',
            'user_name' => $userName,
            'category' => $category,
            'category_label' => $categoryLabel,
            'points_earned' => $pointsEarned,
            'total_points' => $totalPoints,
            'target_bin' => $targetBin,
            'message' => "+{$pointsEarned} Poin berhasil ditambahkan ke akun {$userName}!"
        ]);
    }

    /**
     * 3. Sinkronisasi Telemetri Kapasitas Sensor dari Raspberry Pi.
     * POST /api/station/telemetry
     * Payload: { "station_code": "STATION-01", "sensor1": 25.0, "sensor2": 45.0, ... }
     */
    public function syncTelemetry(Request $request)
    {
        $stationCode = $request->input('station_code', 'STATION-01');
        $s1 = $request->input('sensor1');
        $s2 = $request->input('sensor2');
        $s3 = $request->input('sensor3');
        $s4 = $request->input('sensor4');

        // Update database titik SmartBin
        $bin = SmartBin::where('uuid', $stationCode)->first();
        if ($bin) {
            $bin->update([
                'capacity_organik' => $s1 !== null ? (float)$s1 : $bin->capacity_organik,
                'capacity_plastik' => $s2 !== null ? (float)$s2 : $bin->capacity_plastik,
                'capacity_kertas'  => $s3 !== null ? (float)$s3 : $bin->capacity_kertas,
                'capacity_logam'   => $s4 !== null ? (float)$s4 : $bin->capacity_logam,
                'last_sync_at'     => now(),
            ]);
        }

        // Cache untuk Public Monitor
        Cache::put('sensor_data', [
            'sensor1' => $s1,
            'sensor2' => $s2,
            'sensor3' => $s3,
            'sensor4' => $s4,
            'station_code' => $stationCode,
            'updated_at' => now()->toIso8601String(),
        ], now()->addMinutes(10));

        return response()->json([
            'status' => 'ok',
            'station_code' => $stationCode,
            'message' => 'Telemetri kapasitas berhasil disinkronisasi ke server pusat.'
        ]);
    }

    /**
     * 4. Daftar Titik SmartBin Terdekat (untuk App Mobile / User Portal).
     * GET /api/station/nearby?lat=-6.9298&lng=107.7181
     */
    public function getNearby(Request $request)
    {
        $userLat = $request->query('lat');
        $userLng = $request->query('lng');

        $bins = SmartBin::all()->map(function ($b) use ($userLat, $userLng) {
            $distKm = $b->getDistanceFrom($userLat, $userLng);
            return [
                'id' => $b->id,
                'station_code' => $b->uuid,
                'name' => $b->name,
                'location_name' => $b->location_name,
                'latitude' => (float) $b->latitude,
                'longitude' => (float) $b->longitude,
                'status' => $b->status,
                'distance_km' => $distKm,
                'distance_text' => $distKm !== null ? ($distKm < 1.0 ? round($distKm * 1000) . ' m' : $distKm . ' km') : 'Tidak diketahui',
                'capacities' => [
                    'organik' => (float) $b->capacity_organik,
                    'plastik' => (float) $b->capacity_plastik,
                    'kertas'  => (float) $b->capacity_kertas,
                    'logam'   => (float) $b->capacity_logam,
                ],
                'is_online' => $b->last_sync_at && $b->last_sync_at->diffInMinutes(now()) <= 15,
            ];
        });

        // Urutkan berdasarkan jarak terdekat jika koordinat tersedia
        if ($userLat && $userLng) {
            $bins = $bins->sortBy('distance_km')->values();
        }

        return response()->json([
            'status' => 'ok',
            'count' => $bins->count(),
            'stations' => $bins
        ]);
    }
}
