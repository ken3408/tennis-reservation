<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LessonStudentRecord;

class LessonStudentRecordSeeder extends Seeder
{
    public function run()
    {
        LessonStudentRecord::create([
            'lesson_schedule_detail_id' => 1,
            'student_id' => 1,
            'status' => 'RESERVED',
            'action_date' => '2025-03-08',
        ]);

        LessonStudentRecord::create([
            'lesson_schedule_detail_id' => 1,
            'student_id' => 2,
            'status' => 'CANCELLED',
            'action_date' => '2025-03-09',
        ]);
    }
}
