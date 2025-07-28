<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiFeedback extends Model
{
    protected $fillable = [
        'user_id',
        'week_start_date',
        'summary',
        'feedbacks',
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
