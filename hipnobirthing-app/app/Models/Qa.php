<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qa extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'question',
        'answer',
        'midwife_id',
        'status'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Relasi ke ibu (user)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke bidan yang menjawab
     */
    public function midwife()
    {
        return $this->belongsTo(User::class, 'midwife_id');
    }

    /**
     * Scope untuk pertanyaan pending
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope untuk pertanyaan yang sudah dijawab
     */
    public function scopeAnswered($query)
    {
        return $query->where('status', 'answered');
    }
}