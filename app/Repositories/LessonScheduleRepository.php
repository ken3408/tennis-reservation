<?php

namespace App\Repositories;

use App\Models\LessonSchedule;

class LessonScheduleRepository
{
    public static function getSchedulesForMonth($year, $month)
    {
        return LessonSchedule::where('year_month', $year . sprintf('%02d', $month))->get();
    }
}
