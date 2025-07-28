<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoachComment extends Model
{
    protected $fillable = [
        'coach_id',
        'user_id',
        'comment',
    ];

    
    public function coach()
    {
        return $this->belongsTo(Coach::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
