<?php

namespace App\Services;

use App\Models\LessonSchedule;
use App\Models\LessonTimeSlot;
use Carbon\Carbon;
use App\Repositories\LessonScheduleRepository; // 追加

class ScheduleService
{
    public static function generateScheduleData($lessonScadules, $weekdayType)
    {
        $scheduleData = [];
        $filledScheduleData = [];

        // 時間帯とコート番号の初期化
        $timeSlots = LessonTimeSlot::getTimeSlotsByWeekdayType($weekdayType);
        if ($weekdayType === 'WEEKDAY' || $weekdayType === 'WEEKENDDAY') {
            $courtNumbers = [1, 2, 3, 4];
        } elseif ($weekdayType === 'SATURDAY-JR') {
            $courtNumbers = [1];
        }

        // 変更: if文を使用して$weekdaysを設定
        if ($weekdayType === 'WEEKDAY') {
            $weekdays = [1, 2, 3, 4, 5];
        } elseif ($weekdayType === 'WEEKENDDAY') {
            $weekdays = [1, 2];
        } elseif ($weekdayType === 'SATURDAY-JR') {
            $weekdays = [1];
        }

        foreach ($timeSlots as $time) {
            foreach ($courtNumbers as $courtNumber) {
                foreach ($weekdays as $weekday) {
                    if (!isset($scheduleData["{$time}"][$courtNumber][$weekday])) {
                        $scheduleData["{$time}"][$courtNumber][$weekday] = [];
                    }
                }
            }
        }

        foreach ($lessonScadules as $schedule) {
            $courtNumber = $schedule->court_num;
            $weekday = self::convertWeekday($schedule->weekday, $weekdayType); // 変更
            $className = $schedule->lessonTimeSlot->class_name;
            $start_time = Carbon::parse($schedule->lessonTimeSlot->start_time)->format('H:i');
            $end_time = Carbon::parse($schedule->lessonTimeSlot->end_time)->format('H:i');
            $lessonTime = $start_time . '〜' . $end_time;
            $time = $className . ' ' . $lessonTime;
            $filledScheduleData["{$time}"][$courtNumber][$weekday] = [
                [
                    "lesson_schedule_id" => $schedule->id,
                    "lesson_id" => $schedule->lesson_master_id,
                    "class" => $schedule->LessonMaster->name,
                ],
                [
                    "coach_id" => $schedule->staff_id,
                    "coach" => $schedule->mainCoach->last_name . ' ' . $schedule->mainCoach->first_name,
                ],
                [
                    "lesson_time_slot_id" => $schedule->lesson_time_slot_id,
                    "class_name" => $className,
                    "start_time" => $start_time,
                    "end_time" => $end_time,
                ]
            ];
        }
        foreach ($filledScheduleData as $time => $courts) {
            foreach ($courts as $courtNumber => $weekdaysData) {
                foreach ($weekdaysData as $weekday => $lessonData) {
                    if (isset($scheduleData[$time][$courtNumber][$weekday])) {
                        $scheduleData[$time][$courtNumber][$weekday] = $lessonData; // `filled` のデータを `empty` にセット
                    }
                }
            }
        }

        return $scheduleData;
    }

    private static function convertWeekday($weekday, $weekdayType) // 変更
    {
        if ($weekdayType === 'WEEKDAY') {
            $weekdays = [
                '月' => 1,
                '火' => 2,
                '水' => 3,
                '木' => 4,
                '金' => 5
            ];
        } elseif ($weekdayType === 'WEEKENDDAY') {
            $weekdays = [
                '土' => 1,
                '日' => 2
            ];
        } elseif ($weekdayType === 'SATURDAY-JR') {
            $weekdays = [
                '土' => 1
            ];
        }

        return $weekdays[$weekday] ?? $weekday;
    }
}
