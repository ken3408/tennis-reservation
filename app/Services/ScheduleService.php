<?php

namespace App\Services;

use App\Models\LessonSchedule;
use App\Models\LessonTimeSlot;
use Carbon\Carbon;
use App\Repositories\LessonScheduleRepository; // 追加
use App\Models\LessonScheduleDetail; // 追加

class ScheduleService
{
  /**
   * スケジュールデータを生成する
   */
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

  /**
   * 曜日を数値に変換する
   */
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

  /**
   * スケジュール詳細を挿入または更新する
   */
  public static function insertLessonScheduleDetails($yearMonth)
  {
    // 対象年月のスケジュールを取得
    $lessonSchedules = LessonSchedule::where('year_month', $yearMonth)->get();

    foreach ($lessonSchedules as $schedule) {
      $dates = self::getDatesFromYearMonthAndWeekday($schedule->year_month, $schedule->weekday);

      foreach ($dates as $date) {
        LessonScheduleDetail::updateOrCreate(
          [
            'lesson_schedule_id' => $schedule->id,
            'date' => $date,
          ],
          [
            'staff_id' => $schedule->staff_id,
            'is_main_substituted' => false,
            'sub_staff_id' => $schedule->sub_staff_id,
            'is_sub_substituted' => false,
            'reserved_count' => 0,
            'cancelled_count' => 0,
          ]
        );
      }
    }
  }

  /**
   * 年月と曜日から該当する日付を取得する
   */
  public static function getDatesFromYearMonthAndWeekday($yearMonth, $weekday)
  {
    $weekdayNumber = self::convertWeekdayToNumber($weekday);
    $dates = [];
    $year = substr($yearMonth, 0, 4);  // 年 (YYYY)
    $month = substr($yearMonth, 4, 2); // 月 (MM)

    // 月の初日を取得
    $date = Carbon::create($year, $month, 1);
    $endOfMonth = $date->copy()->endOfMonth(); // `copy()` を使って参照の影響を防ぐ
    // 指定された曜日に一致する日付を取得
    while ($date->lte($endOfMonth)) {
      if ($date->isoWeekday() == $weekdayNumber) { // `isoWeekday()` は `1 = 月曜, 7 = 日曜`
        $dates[] = $date->format('Y-m-d'); // YYYY-MM-DD 形式で追加
      }
      $date->addDay(); // 1日ずつ進める
    }

    return $dates;
  }

  /**
   * 曜日を数値に変換する (月曜=1, 日曜=7)
   */
  public static function convertWeekdayToNumber($weekday)
  {
    $map = [
      "月" => 1,
      "火" => 2,
      "水" => 3,
      "木" => 4,
      "金" => 5,
      "土" => 6,
      "日" => 7,
    ];
    return $map[$weekday] ?? null; // 該当しない場合は null
  }

  /**
   * 指定された日付のレッスンを時間帯とコートごとにグループ化する
   */
  public static function getLessonsGroupedByTimeSlotByCourt($date, $lessonTimeSlots)
  {

    $result = [];

    foreach ($lessonTimeSlots as $slot) {
      $className = $slot->class_name;

      // A〜F のキーを作成し、コート1〜4を空配列で初期化
      $result[$className] = [
        1 => [],
        2 => [],
        3 => [],
        4 => [],
      ];
    }

    // ②: スケジュールを取得（LessonScheduleRepositoryを利用）
    $lessons = LessonScheduleRepository::getLessonsGroupedByTimeSlot($date);

    foreach ($lessons as $group) {
      foreach ($group as $detail) {
        $lessonSchedule = $detail->lessonSchedule;
        $className = $lessonSchedule->lessonTimeSlot->class_name;
        $courtNum = $lessonSchedule->court_num;

        // 既に $result[$className] は初期化済みなので、上書きするだけ
        $result[$className][$courtNum] = array_merge(
          $lessonSchedule->toArray(),
          ['lesson_schedule_detail_id' => $detail->id] // lesson_schedule_details.id を追加
        );
      }
    }

    return $result;
  }
}
