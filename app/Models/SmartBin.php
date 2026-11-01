<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmartBin extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'last_sync_at' => 'datetime',
        'last_ping_at' => 'datetime',
        'capacity_organik' => 'float',
        'capacity_plastik' => 'float',
        'capacity_kertas' => 'float',
        'capacity_logam' => 'float',
        'capacity_organic' => 'float',
        'capacity_plastic' => 'float',
        'capacity_paper' => 'float',
        'capacity_metal' => 'float',
    ];

    public function getStationCodeAttribute()
    {
        return $this->attributes['station_code'] ?? $this->attributes['uuid'] ?? '';
    }

    public function getUuidAttribute()
    {
        return $this->attributes['uuid'] ?? $this->attributes['station_code'] ?? '';
    }

    public function getCapacityOrganikAttribute()
    {
        return $this->attributes['capacity_organik'] ?? $this->attributes['capacity_organic'] ?? 0;
    }

    public function getCapacityPlastikAttribute()
    {
        return $this->attributes['capacity_plastik'] ?? $this->attributes['capacity_plastic'] ?? 0;
    }

    public function getCapacityKertasAttribute()
    {
        return $this->attributes['capacity_kertas'] ?? $this->attributes['capacity_paper'] ?? 0;
    }

    public function getCapacityLogamAttribute()
    {
        return $this->attributes['capacity_logam'] ?? $this->attributes['capacity_metal'] ?? 0;
    }

    /**
     * Hitung jarak dari koordinat pengguna dalam kilometer (rumus Haversine).
     */
    public function getDistanceFrom($userLat, $userLng)
    {
        if (!$userLat || !$userLng) return null;
        
        $earthRadius = 6371; // km
        $dLat = deg2rad($this->latitude - $userLat);
        $dLng = deg2rad($this->longitude - $userLng);
        
        $a = sin($dLat/2) * sin($dLat/2) +
             cos(deg2rad($userLat)) * cos(deg2rad($this->latitude)) *
             sin($dLng/2) * sin($dLng/2);
             
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        $distKm = $earthRadius * $c;
        
        return round($distKm, 2);
    }

    /**
     * Dapatkan status publik Smart Bin: Tersedia, Hampir Penuh, Penuh, Offline.
     */
    public function getPublicStatus(): array
    {
        $isOnline = $this->is_online ?? true;
        if (!$isOnline || $this->status === 'maintenance') {
            return [
                'status' => 'offline',
                'label' => 'Offline',
                'color' => '#64748b',
                'bg' => 'bg-slate-100 text-slate-700 border-slate-300',
                'dot' => 'bg-slate-400',
                'desc' => 'Perangkat sedang tidak merespons ping / dalam pemeliharaan.',
            ];
        }

        $capacities = [
            (float) $this->capacity_organik,
            (float) $this->capacity_plastik,
            (float) $this->capacity_kertas,
            (float) $this->capacity_logam,
        ];
        $maxCap = count($capacities) > 0 ? max($capacities) : 0;

        if ($this->status === 'full' || $maxCap >= 90) {
            return [
                'status' => 'penuh',
                'label' => 'Penuh',
                'color' => '#EF4444',
                'bg' => 'bg-rose-100 text-rose-800 border-rose-300',
                'dot' => 'bg-rose-500',
                'desc' => 'Kapasitas mencapai batas (> 90%). Menunggu petugas pengangkutan.',
            ];
        }

        if ($maxCap >= 75) {
            return [
                'status' => 'hampir_penuh',
                'label' => 'Hampir Penuh',
                'color' => '#F59E0B',
                'bg' => 'bg-amber-100 text-amber-800 border-amber-300',
                'dot' => 'bg-amber-500',
                'desc' => 'Kapasitas terisi 75%-90%. Segera dijadwalkan pengosongan.',
            ];
        }

        return [
            'status' => 'tersedia',
            'label' => 'Tersedia',
            'color' => '#287A4D',
            'bg' => 'bg-emerald-100 text-emerald-800 border-emerald-300',
            'dot' => 'bg-emerald-500',
            'desc' => 'Smart Bin aktif dan memiliki ruang cukup untuk membuang sampah.',
        ];
    }
}
