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
}
