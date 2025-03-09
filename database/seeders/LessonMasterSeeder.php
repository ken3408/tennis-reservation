<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonMasterSeeder extends Seeder
{
    public function run()
    {
        DB::table('lesson_master')->insert([
            [
                'name' => '初心',
                'level' => 1,
                'category' => 1, // 一般
                'max_participants' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '初級',
                'level' => 2,
                'category' => 1, // 一般
                'max_participants' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '初中級',
                'level' => 3,
                'category' => 1, // 一般
                'max_participants' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '中級',
                'level' => 4,
                'category' => 1, // 一般
                'max_participants' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '上級',
                'level' => 5,
                'category' => 1, // 一般
                'max_participants' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ジュニア初級',
                'level' => 1,
                'category' => 2, // ジュニア
                'max_participants' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ジュニア上級',
                'level' => 8,
                'category' => 2, // ジュニア
                'max_participants' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
