<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CoachesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('coaches')->insert([
            'name' => '鈴木一郎',
            'email' => 'susuki@test.com',
            'password' => '12345678',
            'organization' => '家庭教師',
            'created_at' => Carbon::now(),
            'updated_at' =>	carbon::now(),
        ]);
    }
}
