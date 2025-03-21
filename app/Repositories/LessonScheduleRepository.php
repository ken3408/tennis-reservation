<?php

namespace App\Repositories;

use App\Models\LessonSchedule;
use App\Models\LessonTimeSlot;
use App\Models\LessonScheduleDetail;

class LessonScheduleRepository
{
    /**
     * 指定された年月と曜日タイプに基づいてスケジュールを取得する
     */
    public static function getSchedulesForMonth($year, $month, $weekdayType)
    {
        $lessonTimeSlots = LessonTimeSlot::where('weekday_type', $weekdayType)->get();
        $lessonTimeSlotIds = $lessonTimeSlots->pluck('id')->toArray();
        return LessonSchedule::where('year_month', $year . sprintf('%02d', $month))
            ->whereIn('lesson_time_slot_id', $lessonTimeSlotIds)
            ->get();
    }

    /**
     * 指定された日付のレッスンを時間帯ごとにグループ化する
     */
    public static function getLessonsGroupedByTimeSlot($date)
    {
        return LessonScheduleDetail::where('date', $date)
            ->with(['lessonSchedule.lessonMaster', 'lessonSchedule.mainCoach', 'lessonSchedule.subCoach', 'lessonSchedule.lessonTimeSlot'])
            ->get()
            ->sortBy(function ($item) {
                return $item->lessonSchedule->court_num; // コート番号でソート
            })
            ->groupBy(function ($item) {
                return $item->lessonSchedule->lesson_time_slot_id; // lesson_time_slot_idでグループ化
            });
    }
}
