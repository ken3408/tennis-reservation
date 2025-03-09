<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonCourtStatusTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('lesson_court_status')->insert([
            [
                'lesson_schedule_id' => 1,
                'reason' => '雨天のため中止',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 他のレコードも追加可能
        ]);
    }
}
