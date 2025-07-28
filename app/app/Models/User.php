<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'notification_on',
        'coach_id',
    ];

    
    public function coach()
    {
        return $this->belongsTo(Coach::class);
    }

    public function habits()
    {
        return $this->hasMany(Habit::class);
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function aiFeedbacks()
    {
        return $this->hasMany(AiFeedback::class);
    }

    public function coachComments()
    {
        return $this->hasMany(CoachComment::class);
    }
}

