<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'title',
        'color_badge',
        'icon',
        'summary',
        'sorting_guide',
        'recycling_impact',
        'eco_theology_quote',
        'eco_theology_ref',
    ];
}
