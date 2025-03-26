<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LessonSchedule;
use App\Models\LessonScheduleDetail;

class LessonController extends Controller
{
  public function save(Request $request)
  {
    $lessonInfo = $request->input('lessonInfo');
    $students = $request->input('students');
    dd($students);

    // レッスンスケジュールを保存
    $lessonSchedule = LessonSchedule::create([
      'lesson_time_slot_id' => $lessonInfo['timeSlotId'],
      'court_num' => $lessonInfo['court'],
      'staff_id' => $lessonInfo['coachId'],
      'is_main_substituted' => $lessonInfo['isSubstitute'],
      'cancel_reason' => $lessonInfo['cancelReason'],
    ]);

    // レッスンスケジュール詳細を保存
    foreach ($students as $student) {
      LessonScheduleDetail::create([
        'lesson_schedule_id' => $lessonSchedule->id,
        'student_id' => $student['id'],
        'level' => $student['level'],
      ]);
    }

    return response()->json(['message' => 'レッスン情報が保存されました'], 201);
  }
}
