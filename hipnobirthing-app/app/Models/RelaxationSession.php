<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelaxationSession extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'type',
        'duration'
    ];
}