<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AncReminder extends Model
{
    protected $fillable = [
        'user_id',
        'appointment_date',
        'location',
        'is_notified'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
