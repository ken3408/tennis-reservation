<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonTimeSlotsSeeder extends Seeder
{
    public function run()
    {
        DB::table('lesson_time_slots')->insert([
            // 平日 (Monday - Friday)
            ['class_name' => 'A', 'weekday_type' => 'WEEKDAY', 'start_time' => '10:30:00', 'end_time' => '12:00:00'],
            ['class_name' => 'B', 'weekday_type' => 'WEEKDAY', 'start_time' => '12:30:00', 'end_time' => '14:00:00'],
            ['class_name' => 'C', 'weekday_type' => 'WEEKDAY', 'start_time' => '14:30:00', 'end_time' => '16:00:00'],
            ['class_name' => 'D', 'weekday_type' => 'WEEKDAY', 'start_time' => '16:30:00', 'end_time' => '17:30:00'],
            ['class_name' => 'E', 'weekday_type' => 'WEEKDAY', 'start_time' => '17:30:00', 'end_time' => '19:00:00'],
            ['class_name' => 'F', 'weekday_type' => 'WEEKDAY', 'start_time' => '19:30:00', 'end_time' => '21:00:00'],

            // 土曜 (Saturday)
            ['class_name' => 'A', 'weekday_type' => 'SATURDAY', 'start_time' => '09:10:00', 'end_time' => '10:40:00'],
            ['class_name' => 'B', 'weekday_type' => 'SATURDAY', 'start_time' => '10:50:00', 'end_time' => '12:20:00'],
            ['class_name' => 'C', 'weekday_type' => 'SATURDAY', 'start_time' => '12:30:00', 'end_time' => '14:00:00'],
            ['class_name' => 'D', 'weekday_type' => 'SATURDAY', 'start_time' => '14:10:00', 'end_time' => '15:40:00'],
            ['class_name' => 'E', 'weekday_type' => 'SATURDAY', 'start_time' => '15:50:00', 'end_time' => '17:20:00'],
            ['class_name' => 'F', 'weekday_type' => 'SATURDAY', 'start_time' => '17:30:00', 'end_time' => '19:20:00'],

            // 日曜 (Sunday)
            ['class_name' => 'A', 'weekday_type' => 'SUNDAY', 'start_time' => '09:10:00', 'end_time' => '10:40:00'],
            ['class_name' => 'B', 'weekday_type' => 'SUNDAY', 'start_time' => '10:50:00', 'end_time' => '12:20:00'],
            ['class_name' => 'C', 'weekday_type' => 'SUNDAY', 'start_time' => '12:30:00', 'end_time' => '14:00:00'],
            ['class_name' => 'D', 'weekday_type' => 'SUNDAY', 'start_time' => '14:10:00', 'end_time' => '15:40:00'],
            ['class_name' => 'E', 'weekday_type' => 'SUNDAY', 'start_time' => '15:50:00', 'end_time' => '17:20:00'],
            ['class_name' => 'F', 'weekday_type' => 'SUNDAY', 'start_time' => '17:30:00', 'end_time' => '19:20:00'],

            // ジュニアクラス
            ['class_name' => 'Jr1', 'weekday_type' => 'SATURDAY', 'start_time' => '10:50:00', 'end_time' => '11:50:00'],
            ['class_name' => 'Jr1', 'weekday_type' => 'SATURDAY', 'start_time' => '11:50:00', 'end_time' => '12:50:00'],
            ['class_name' => 'Jr1', 'weekday_type' => 'SATURDAY', 'start_time' => '14:50:00', 'end_time' => '15:50:00'],
            ['class_name' => 'Jr1', 'weekday_type' => 'SUNDAY', 'start_time' => '10:50:00', 'end_time' => '11:50:00'],
            ['class_name' => 'Jr1', 'weekday_type' => 'SUNDAY', 'start_time' => '11:50:00', 'end_time' => '12:50:00'],
            ['class_name' => 'Jr1', 'weekday_type' => 'SUNDAY', 'start_time' => '14:50:00', 'end_time' => '15:50:00'],
        ]);
    }
}
