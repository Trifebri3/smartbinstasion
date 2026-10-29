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
}
