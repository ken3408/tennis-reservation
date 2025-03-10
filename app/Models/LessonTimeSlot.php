<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonTimeSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_name',
        'weekday_type',
        'start_time',
        'end_time',
    ];

    public function lessonSchedules()
    {
        return $this->hasMany(LessonSchedule::class);
    }
}
