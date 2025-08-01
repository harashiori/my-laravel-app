<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Coach extends Authenticatable
{

    //protected $guard = 'coach';   これも追加（guard指定）


    protected $fillable = [
        'name',
        'email',
        'password',
        'organization',
        'status',
        'invite_token',
        'invite_token_expires_at',
    ];
    protected $hidden = [
        'password',
        'remember_token'
    ];


    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function coachComments()
    {
        return $this->hasMany(CoachComment::class);
    }
}
