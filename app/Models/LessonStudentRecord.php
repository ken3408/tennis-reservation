<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonStudentRecord extends Model
{
  use HasFactory;

  protected $fillable = [
    'lesson_schedule_detail_id',
    'student_id',
    'status',
    'action_date',
  ];

  public function lessonScheduleDetail()
  {
    return $this->belongsTo(LessonScheduleDetail::class);
  }

  public function student()
  {
    return $this->belongsTo(Student::class);
  }

  public static function updateStudentRecords($lessonScheduleDetailId, $addedStudents, $canceledStudents)
  {
    // キャンセルされた生徒を更新
    foreach ($canceledStudents as $student) {
      self::where('lesson_schedule_detail_id', $lessonScheduleDetailId)
        ->where('student_id', $student['id'])
        ->update([
          'status' => (string) 'CANCELLED', // 明示的に文字列として設定
          'action_date' => now(),
        ]);
    }
    // 追加された生徒を登録または更新
    foreach ($addedStudents as $student) {
      self::updateOrCreate(
        [
          'lesson_schedule_detail_id' => $lessonScheduleDetailId,
          'student_id' => $student['id'],
        ],
        [
          'status' => (string) 'RESERVED', // 明示的に文字列として設定
          'action_date' => now(),
        ]
      );
    }
  }
}
