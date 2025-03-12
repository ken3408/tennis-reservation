<?php

namespace App\Services;

use App\Models\LessonSchedule;
use Carbon\Carbon;

class ScheduleService
{
    public static function generateScheduleData($lessonScadules)
    {
        $scheduleData = [];
        $filledScheduleData = [];

        // 時間帯とコート番号の初期化
        $timeSlots = [
            'A 10:30〜12:00',
            'B 12:30〜14:00',
            'C 14:30〜16:00',
            'D 16:30〜18:00',
            'E 18:30〜20:00',
            'F 20:30〜22:00'
        ];
        $courtNumbers = [1, 2, 3, 4];
        $weekdays = [1, 2, 3, 4, 5];

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
            $weekday = self::convertWeekday($schedule->weekday);
            $className = $schedule->lessonTimeSlot->class_name;
            $start_time = Carbon::parse($schedule->lessonTimeSlot->start_time)->format('H:i');
            $end_time = Carbon::parse($schedule->lessonTimeSlot->end_time)->format('H:i');
            $lessonTime = $start_time . '〜' . $end_time;
            $time = $className . ' ' . $lessonTime;
            $filledScheduleData["{$time}"][$courtNumber][$weekday] = [
                [
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
        // `array_merge_recursive()` で `filled` を `empty` に統合
    // $scheduleData = array_merge_recursive($scheduleData, $filledScheduleData);
        // `filled` のデータを `empty` に統合する
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

    private static function convertWeekday($weekday)
    {
        $weekdays = [
            '月' => 1,
            '火' => 2,
            '水' => 3,
            '木' => 4,
            '金' => 5
        ];

        return $weekdays[$weekday] ?? $weekday;
    }
}
