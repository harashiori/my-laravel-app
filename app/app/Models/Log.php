<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'habit_id',
        'user_id',
        'start_time',
        'end_time',
        'concentration',
        'satisfaction',
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function habit()
    {
        return $this->belongsTo(Habit::class);
    }
}
