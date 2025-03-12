<?php

namespace App\Services;

use App\Models\LessonSchedule;

class ScheduleService
{
    public static function generateScheduleData($lessonScadules)
    {
        $scheduleData = [];

        foreach ($lessonScadules as $schedule) {
            $timeSlot = $schedule->lesson_time_slot_id;
            $courtNumber = $schedule->court_num;
            $weekday = $schedule->weekday;

            $scheduleData["{$timeSlot}"][$courtNumber][$weekday] = [
                [
                    "lesson_id" => $schedule->lesson_id,
                    "class" => $schedule->class,
                ],
                [
                    "coach_id" => $schedule->coach_id,
                    "coach" => $schedule->mainCoach->last_name . ' ' . $schedule->mainCoach->first_name,
                ],
                [
                    "lesson_time_slot_id" => $schedule->lesson_time_slot_id,
                    "class_name" => $schedule->class_name,
                    "start_time" => $schedule->start_time,
                    "end_time" => $schedule->end_time,
                ]
            ];
        }

        return $scheduleData;
    }
}
