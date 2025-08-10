<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;

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

    // 連続継続日数を計算する例（今日まで連続してログがあるかを判定）
    public function calculateStreakDays()
    {
        $logs = $this->logs()->orderBy('created_at', 'desc')->pluck('created_at')->map(function($date) {
            return Carbon::parse($date)->startOfDay();
        });

        $streak = 0;
        $today = Carbon::today();

        foreach ($logs as $logDate) {
            if ($logDate->equalTo($today->copy()->subDays($streak))) {
                $streak++;
            } else {
                break;
            }
        }

        return $streak;
    }
}
