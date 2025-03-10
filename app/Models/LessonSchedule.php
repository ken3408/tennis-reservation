<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonSchedule extends Model
{
    use HasFactory;

    protected $table = 'lesson_schedules';

    protected $fillable = [
        'lesson_master_id',
        'year_month',
        'weekday',
        'court_num',
        'staff_id',
        'sub_staff_id',
        'lesson_time_slot_id',
    ];

    // スケジュールはレッスンマスターに属する
    public function lessonMaster()
    {
        return $this->belongsTo(LessonMaster::class, 'lesson_master_id');
    }

    // スケジュールに登録された生徒
    public function students()
    {
        return $this->belongsToMany(Student::class, 'lesson_students', 'lesson_schedule_id', 'student_id');
    }

    public function lessonTimeSlot()
    {
        return $this->belongsTo(LessonTimeSlot::class);
    }

    public function mainCoach()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    public function subCoach()
    {
        return $this->belongsTo(Staff::class, 'sub_staff_id');
    }
}
