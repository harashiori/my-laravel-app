<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Habit extends Model
{
    protected $table = 'habits';

    protected $fillable = [
        'user_id',
        'name',
        'frequency',
        'days',
        'schedule_time',
        'notification_time',
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }
}
