<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmartBin extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'location_name',
        'latitude',
        'longitude',
        'capacity_organik',
        'capacity_plastik',
        'capacity_kertas',
        'capacity_logam',
        'status',
        'last_sync_at',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'last_sync_at' => 'datetime',
        'capacity_organik' => 'float',
        'capacity_plastik' => 'float',
        'capacity_kertas' => 'float',
        'capacity_logam' => 'float',
    ];

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
