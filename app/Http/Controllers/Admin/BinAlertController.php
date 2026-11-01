<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SmartBin;
use App\Services\BinAlertService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class BinAlertController extends Controller
{
    /**
     * Trigger kirim email alert untuk stasiun tertentu via klik di Admin.
     * POST /admin/stations/{id}/alert-email
     */
    public function triggerStationAlert(Request $request, $id)
    {
        $bin = SmartBin::find($id);
        if (!$bin) {
            // Coba cari berdasarkan station_code
            $bin = SmartBin::where('station_code', $id)->first();
        }

        if (!$bin) {
            // Fallback stasiun dummy jika database belum terisi
            $bin = [
                'id' => $id,
                'station_code' => 'STATION-' . str_pad($id, 2, '0', STR_PAD_LEFT),
                'name' => 'SmartBin Rektorat Utama',
                'location_name' => 'Lobby Gedung Rektorat Kampus 1 UIN SGD Bandung',
                'organik' => 90.0,
                'plastik' => 88.0,
                'kertas' => 45.0,
                'logam' => 20.0,
                'latitude' => -6.929824,
                'longitude' => 107.718162,
            ];
        }

        $targetEmail = $request->input('target_email');
        $adminName = Auth::user() ? Auth::user()->name : 'Administrator SmartBin';

        $result = BinAlertService::sendAlert(
            bin: $bin,
            customRecipient: $targetEmail,
            triggerType: 'manual',
            triggeredBy: $adminName,
            force: true // Paksa kirim langsung saat diklik admin
        );

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json($result);
        }

        if ($result['status'] === 'success') {
            return back()->with('success', $result['message']);
        }

        return back()->with('error', $result['message']);
    }

    /**
     * Trigger kirim email alert berdasarkan data sensor live saat ini.
     * POST /admin/sensors/alert-live
     */
    public function triggerLiveSensorAlert(Request $request)
    {
        $sensorData = Cache::get('sensor_data', [
            'sensor1' => 90,
            'sensor2' => 85,
            'sensor3' => 40,
            'sensor4' => 20,
        ]);

        $targetEmail = $request->input('target_email');
        $adminName = Auth::user() ? Auth::user()->name : 'Administrator SmartBin';

        // Konversi jarak atau persen sensor
        $s1 = (float)($sensorData['sensor1'] ?? 0);
        $s2 = (float)($sensorData['sensor2'] ?? 0);
        $s3 = (float)($sensorData['sensor3'] ?? 0);
        $s4 = (float)($sensorData['sensor4'] ?? 0);

        $binData = [
            'id' => 1,
            'station_code' => 'STATION-LIVE',
            'name' => 'SmartBin Stasiun Utama IoT',
            'location_name' => 'Laboratorium IoT / Stasiun Kampus 1 UIN SGD Bandung',
            'organik' => $s1 > 0 ? $s1 : 92.0,
            'plastik' => $s2 > 0 ? $s2 : 88.0,
            'kertas'  => $s3 > 0 ? $s3 : 35.0,
            'logam'   => $s4 > 0 ? $s4 : 15.0,
            'latitude' => -6.929824,
            'longitude' => 107.718162,
        ];

        $result = BinAlertService::sendAlert(
            bin: $binData,
            customRecipient: $targetEmail,
            triggerType: 'manual',
            triggeredBy: $adminName,
            force: true
        );

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json($result);
        }

        if ($result['status'] === 'success') {
            return back()->with('success', $result['message']);
        }

        return back()->with('error', $result['message']);
    }
}
