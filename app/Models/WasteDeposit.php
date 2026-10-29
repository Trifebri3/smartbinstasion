<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteDeposit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'smart_bin_id',
        'category',
        'points_earned',
        'weight_est_kg',
        'photo_path',
        'confidence',
        'source',
    ];

    protected $casts = [
        'confidence' => 'float',
        'points_earned' => 'integer',
        'weight_est_kg' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function smartBin()
    {
        return $this->belongsTo(SmartBin::class);
    }
}
