<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    public static function getTimeSlotsByWeekdayType($weekdayType)
    {
        return self::where('weekday_type', $weekdayType)->get()->map(function ($timeSlot) {
            return $timeSlot->class_name . ' ' . Carbon::parse($timeSlot->start_time)->format('H:i') . '〜' . Carbon::parse($timeSlot->end_time)->format('H:i');
        })->toArray();
    }

    public function isJuniorClass($startTime, $endTime)
    {
        return $this->weekday_type === 'SATURDAY-JR' && $this->start_time === $startTime && $this->end_time === $endTime;
    }
}
