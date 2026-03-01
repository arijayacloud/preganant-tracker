<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HarsResult extends Model
{
    protected $fillable = [
        'user_id',
        'total_score',
        'anxiety_level'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
