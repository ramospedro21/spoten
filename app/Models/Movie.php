<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $casts = [
        'stars' => 'array',
    ];

    protected $fillable = [
        'name',
        'year',
        'sinopse',
        'duration',
        'directors',
        'writers',
        'stars',
        'rating',
        'image',
    ];
}
