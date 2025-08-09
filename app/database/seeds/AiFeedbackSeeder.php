<?php

use Illuminate\Database\Seeder;
use App\Models\AiFeedback;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AiFeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AiFeedback::create([
            'user_id' => 2,
            'week_start_date' => Carbon::parse('2025-07-28'),
            'summary' => '今週は作業効率が向上しました。',
            'feedback' => '集中力が高く、計画通りに進められました。',
        ]);

        AiFeedback::create([
            'user_id' => 2,
            'week_start_date' => Carbon::parse('2025-08-04'),
            'summary' => '今週は予定外のタスクが多く発生しました。',
            'feedback' => '時間管理の改善が必要です。',
        ]);

        AiFeedback::create([
            'user_id' => 3,
            'week_start_date' => Carbon::parse('2025-08-04'),
            'summary' => '今週は予定外のタスクが多く発生しました。',
            'feedback' => '時間管理の改善が必要です。',
        ]);
    }

}
