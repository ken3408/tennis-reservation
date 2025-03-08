<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonStudent extends Model
{
    use HasFactory;

    protected $table = 'lesson_students';

    protected $fillable = [
        'lesson_schedule_id',
        'student_id',
        'status',
    ];

    // 生徒情報
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    // レッスン情報
    public function lessonSchedule()
    {
        return $this->belongsTo(LessonSchedule::class, 'lesson_schedule_id');
    }
}
