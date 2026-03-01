<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrimesterDiscomfort extends Model
{
    protected $fillable = [
        'trimester',
        'category',
        'discomfort',
        'solution',
        'notes',
        'reference',
    ];
}
