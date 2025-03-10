<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonScheduleDetail extends Model
{
    use HasFactory;

    protected $table = 'lesson_schedule_details';

    protected $fillable = [
        'lesson_schedule_id',
        'staff_id',
        'is_main_substituted',
        'sub_staff_id',
        'is_sub_substituted',
        'date',
        'reserved_count',
        'cancelled_count',
        'lesson_court_status_id', // レッスンコートステータスIDを追加
    ];

    public function lessonSchedule()
    {
        return $this->belongsTo(LessonSchedule::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function subStaff()
    {
        return $this->belongsTo(Staff::class, 'sub_staff_id');
    }
}
