<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Log extends Model
{
    protected $table = 'logs';

    protected $fillable = [
        'habit_id',
        'user_id',
        'start_time',
        'end_time',
        'concentration',
        'satisfaction',
    ];

    protected $casts = [
    'start_time' => 'datetime',
    'end_time' => 'datetime',
    ];


    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function habit()
    {
        return $this->belongsTo(Habit::class);
    }

    // public function getDurationFormattedAttribute()
    // {
    //     if (!is_null($this->duration)) {
    //         $hours = floor($this->duration / 60);
    //         $minutes = $this->duration % 60;

    //         return sprintf('%02d:%02d', $hours, $minutes); // 例: 01:25
    //     }
    //     return null;
    // }
}
