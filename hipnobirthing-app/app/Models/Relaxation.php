<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relaxation extends Model
{
    use HasFactory;

    protected $table = 'relaxations';

    protected $fillable = [
        'title',
        'description',
        'steps',
        'video_url',
        'anxiety_level'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}