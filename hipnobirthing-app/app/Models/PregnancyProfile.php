<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PregnancyProfile extends Model
{
    protected $fillable = [
        'user_id',
        'hpht',
        'cycle_length',
        'estimated_due_date',
        'gestational_age_weeks'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
