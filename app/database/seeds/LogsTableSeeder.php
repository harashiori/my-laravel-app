<?php

use Illuminate\Database\Seeder;
use App\Models\Log;
use Carbon\Carbon;

class LogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 例として5件の仮データを作成
        for ($i = 1; $i <= 5; $i++) {
            Log::create([
                'user_id' => 1,  // 実際に存在するユーザーIDに合わせてください
                'habit_id' => $i, // 実際のhabit_idに合わせてください
                'start_time' => Carbon::now()->subDays($i),
                'duration' => rand(20, 60), // 分単位
                'concentration' => rand(60, 100),
                'satisfaction' => rand(60, 100),
            ]);
        }
    }
}
