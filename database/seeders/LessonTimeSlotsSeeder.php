<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PHPUnit\TextUI\Output\NullPrinter;

class LessonTimeSlotsSeeder extends Seeder
{
    public function run()
    {
        DB::table('lesson_time_slots')->insert([
            // 平日 (Monday - Friday)
            ['class_name' => 'A', 'weekday_type' => 'WEEKDAY', 'start_time' => '10:30', 'end_time' => '12:00'],
            ['class_name' => 'B', 'weekday_type' => 'WEEKDAY', 'start_time' => '12:30', 'end_time' => '14:00'],
            ['class_name' => 'C', 'weekday_type' => 'WEEKDAY', 'start_time' => '14:30', 'end_time' => '16:00'],
            ['class_name' => 'D', 'weekday_type' => 'WEEKDAY', 'start_time' => '16:30', 'end_time' => '17:30'],
            ['class_name' => 'E', 'weekday_type' => 'WEEKDAY', 'start_time' => '17:30', 'end_time' => '19:00'],
            ['class_name' => 'F', 'weekday_type' => 'WEEKDAY', 'start_time' => '19:30', 'end_time' => '21:00'],

            // 土曜 (WEEKENDDAY) 日曜 (Sunday)
            ['class_name' => 'A', 'weekday_type' => 'WEEKENDDAY', 'start_time' => '09:10', 'end_time' => '10:40'],
            ['class_name' => 'B', 'weekday_type' => 'WEEKENDDAY', 'start_time' => '10:50', 'end_time' => '12:20'],
            ['class_name' => 'C', 'weekday_type' => 'WEEKENDDAY', 'start_time' => '12:30', 'end_time' => '14:00'],
            ['class_name' => 'D', 'weekday_type' => 'WEEKENDDAY', 'start_time' => '14:10', 'end_time' => '15:40'],
            ['class_name' => 'E', 'weekday_type' => 'WEEKENDDAY', 'start_time' => '15:50', 'end_time' => '17:20'],
            ['class_name' => 'F', 'weekday_type' => 'WEEKENDDAY', 'start_time' => '17:30', 'end_time' => '19:20'],

            // ジュニアクラス
            ['class_name' => 'J-B', 'weekday_type' => 'SATURDAY-JR', 'start_time' => '10:50', 'end_time' => '11:50'],
            ['class_name' => 'J-C', 'weekday_type' => 'SATURDAY-JR', 'start_time' => '11:50', 'end_time' => '12:50'],
            ['class_name' => 'J-CD', 'weekday_type' => 'SATURDAY-JR', 'start_time' => '13:00', 'end_time' => '14:30'],
            ['class_name' => 'J-D', 'weekday_type' => 'SATURDAY-JR', 'start_time' => '14:50', 'end_time' => '15:50'],
        ]);
    }
}
