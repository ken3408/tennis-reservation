<?php

namespace App\Repositories;

use App\Models\LessonSchedule;
use App\Models\LessonTimeSlot;

class LessonScheduleRepository
{
    public static function getSchedulesForMonth($year, $month, $weekdayType)
    {
        $lessonTimeSlots = LessonTimeSlot::where('weekday_type', $weekdayType)->get();
        $lessonTimeSlotIds = $lessonTimeSlots->pluck('id')->toArray();
        return LessonSchedule::where('year_month', $year . sprintf('%02d', $month))
            ->whereIn('lesson_time_slot_id', $lessonTimeSlotIds)
            ->get();
    }
}
