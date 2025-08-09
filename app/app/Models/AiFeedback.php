<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class AiFeedback extends Model
{
    protected $table = 'ai_feedbacks';

    protected $fillable = [
        'user_id',
        'week_start_date',
        'summary',
        'feedback',
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function logs()
    {
        return $this->hasMany(Log::class, 'user_id', 'user_id');
    }
}
