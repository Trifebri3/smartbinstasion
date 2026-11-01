<?php

namespace App\Services;

use App\Mail\BinFullAlertMail;
use App\Models\SmartBin;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;

class BinAlertService
{
    /**
     * Ambang batas kapasitas penuh (persen)
     */
    public const FULL_THRESHOLD = 85.0;

    /**
     * Durasi jeda cooldown notifikasi otomatis (menit)
     */
    public const COOLDOWN_MINUTES = 30;

    /**
     * Kirim notifikasi email kepenuhan wadah untuk stasiun tertentu.
     *
     * @param SmartBin|array $bin
     * @param string|array|null $customRecipient
     * @param string $triggerType 'manual'|'automatic'
     * @param string|null $triggeredBy
     * @param bool $force Kirim langsung tanpa cek cooldown atau batas kapasitas
     * @return array
     */
    public static function sendAlert(
        SmartBin|array $bin,
        string|array|null $customRecipient = null,
        string $triggerType = 'automatic',
        ?string $triggeredBy = null,
        bool $force = false
    ): array {
        // Konversi data bin ke array standar
        $binData = self::normalizeBinData($bin);
        $binId = $binData['id'] ?? $binData['station_code'] ?? '1';

        // Periksa kapasitas masing-masing kompartemen
        $organik = (float)($binData['organik'] ?? 0);
        $plastik = (float)($binData['plastik'] ?? 0);
        $kertas  = (float)($binData['kertas'] ?? 0);
        $logam   = (float)($binData['logam'] ?? 0);

        $fullChambers = [];
        if ($organik >= self::FULL_THRESHOLD) $fullChambers[] = "Organik ({$organik}%)";
        if ($plastik >= self::FULL_THRESHOLD) $fullChambers[] = "Plastik ({$plastik}%)";
        if ($kertas  >= self::FULL_THRESHOLD) $fullChambers[] = "Kertas ({$kertas}%)";
        if ($logam   >= self::FULL_THRESHOLD) $fullChambers[] = "Logam & Kaca ({$logam}%)";

        // Jika otomatis dan belum ada wadah yang mencapai batas, lewati
        if (!$force && empty($fullChambers)) {
            return [
                'status' => 'skipped',
                'message' => 'Semua wadah masih di bawah ambang batas (' . self::FULL_THRESHOLD . '%).',
                'full_chambers' => [],
            ];
        }

        // Cek Cooldown jika otomatis
        $cacheKey = "bin_full_alert_cooldown_{$binId}";
        if (!$force && Cache::has($cacheKey)) {
            return [
                'status' => 'throttled',
                'message' => 'Peringatan email untuk stasiun ini sudah dikirim dalam ' . self::COOLDOWN_MINUTES . ' menit terakhir.',
                'full_chambers' => $fullChambers,
            ];
        }

        // Tentukan penerima email
        $recipients = self::resolveRecipients($customRecipient);
        if (empty($recipients)) {
            return [
                'status' => 'error',
                'message' => 'Tidak ada alamat email tujuan penerima notifikasi.',
            ];
        }

        $triggeredByName = $triggeredBy ?? ($triggerType === 'manual' ? 'Administrator' : 'Sensor Ultrasonik IoT Real-Time');

        try {
            Mail::to($recipients)->send(
                new BinFullAlertMail(
                    binData: $binData,
                    fullChambers: $fullChambers,
                    triggerType: $triggerType,
                    triggeredBy: $triggeredByName
                )
            );

            // Simpan cooldown 30 menit
            try {
                Cache::put($cacheKey, now()->toIso8601String(), now()->addMinutes(self::COOLDOWN_MINUTES));
            } catch (\Throwable $ce) {
                // Ignore cache storage error
            }

            Log::info("SmartBin Alert Email sent for {$binData['name']} ({$binData['station_code']}) to " . implode(', ', $recipients));

            return [
                'status' => 'success',
                'message' => 'Notifikasi email berhasil dikirim ke ' . implode(', ', $recipients),
                'recipients' => $recipients,
                'station_name' => $binData['name'],
                'full_chambers' => $fullChambers,
            ];
        } catch (\Throwable $e) {
            Log::error("Failed to send SmartBin Alert Email: " . $e->getMessage());

            return [
                'status' => 'error',
                'message' => 'Gagal mengirim email: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Dapatkan daftar penerima email yang valid.
     */
    public static function resolveRecipients(string|array|null $customRecipient = null): array
    {
        if (!empty($customRecipient)) {
            $list = is_array($customRecipient) ? $customRecipient : array_map('trim', explode(',', $customRecipient));
            $valid = array_filter($list, fn($e) => filter_var($e, FILTER_VALIDATE_EMAIL));
            if (!empty($valid)) {
                return array_values($valid);
            }
        }

        $recipients = [];

        // 1. Cek dari konfigurasi env khusus jika ada (Default: trifebriansah321@gmail.com)
        if ($envAlert = env('ALERT_RECIPIENT_EMAIL', 'trifebriansah321@gmail.com')) {
            $recipients[] = trim($envAlert);
        }

        // 2. Cek semua user dengan role admin di database
        try {
            if (Schema::hasTable('users')) {
                $adminEmails = User::where('role', 'admin')
                    ->whereNotNull('email')
                    ->pluck('email')
                    ->toArray();

                $recipients = array_merge($recipients, $adminEmails);
            }
        } catch (\Throwable $e) {
            // Ignore DB error
        }

        // 3. Fallback ke MAIL_FROM_ADDRESS atau default admin UIN
        if (empty($recipients)) {
            $fallback = config('mail.from.address', 'admin@smartbin.myoin.id');
            if (filter_var($fallback, FILTER_VALIDATE_EMAIL)) {
                $recipients[] = $fallback;
            } else {
                $recipients[] = 'admin@smartbin.myoin.id';
            }
        }

        return array_values(array_unique(array_filter($recipients)));
    }

    /**
     * Normalisasi format SmartBin model / array ke array seragam.
     */
    private static function normalizeBinData(SmartBin|array $bin): array
    {
        if (is_array($bin)) {
            return [
                'id' => $bin['id'] ?? 1,
                'station_code' => $bin['station_code'] ?? $bin['code'] ?? 'STATION-01',
                'name' => $bin['name'] ?? 'SmartBin UIN SGD',
                'location_name' => $bin['location_name'] ?? 'Kampus 1 UIN Bandung',
                'organik' => $bin['capacity_organik'] ?? $bin['capacity_organic'] ?? $bin['organik'] ?? 0,
                'plastik' => $bin['capacity_plastik'] ?? $bin['capacity_plastic'] ?? $bin['plastik'] ?? 0,
                'kertas'  => $bin['capacity_kertas'] ?? $bin['capacity_paper'] ?? $bin['kertas'] ?? 0,
                'logam'   => $bin['capacity_logam'] ?? $bin['capacity_metal'] ?? $bin['logam'] ?? 0,
                'latitude' => $bin['latitude'] ?? -6.929824,
                'longitude' => $bin['longitude'] ?? 107.718162,
            ];
        }

        return [
            'id' => $bin->id,
            'station_code' => $bin->station_code ?? 'STATION-01',
            'name' => $bin->name ?? 'SmartBin UIN SGD',
            'location_name' => $bin->location_name ?? 'Kampus 1 UIN Bandung',
            'organik' => $bin->capacity_organik ?? $bin->capacity_organic ?? 0,
            'plastik' => $bin->capacity_plastik ?? $bin->capacity_plastic ?? 0,
            'kertas'  => $bin->capacity_kertas ?? $bin->capacity_paper ?? 0,
            'logam'   => $bin->capacity_logam ?? $bin->capacity_metal ?? 0,
            'latitude' => $bin->latitude ?? -6.929824,
            'longitude' => $bin->longitude ?? 107.718162,
        ];
    }
}

