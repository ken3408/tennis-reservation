<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LessonMaster; // 追加
use App\Models\Staff; // 追加
use App\Models\LessonTimeSlot; // 追加
use App\Models\LessonSchedule; // 追加
use App\Models\LessonScheduleDetail; // 追加
use App\Http\Requests\StoreScheduleRequest; // 追加
use App\Services\ScheduleService; // 追加
use App\Repositories\LessonScheduleRepository; // 追加

class AdminController extends Controller
{
  const WEEKDAY = "WEEKDAY";
  const WEEKENDDAY = "WEEKENDDAY";
  const SATURDAY_JR = "SATURDAY-JR";
    public function index()
    {
        // 今年の年と月を取得
        $year = date('Y');
        $month = date('n');
        $lessonMasters = LessonMaster::all(); // マスターデータ
        $staffs = Staff::all(); // マスターデータ
        $lessonTimeSlot = LessonTimeSlot::all(); // マスターデータ

        // 平日のスケジュールデータを取得
        $lessonScadules = LessonScheduleRepository::getSchedulesForMonth($year, $month, self::WEEKDAY); // 変更
        $scheduleData = ScheduleService::generateScheduleData($lessonScadules, self::WEEKDAY); // 変更

        // 休日のスケジュールデータを取得
        $weekEndLessonScadules = LessonScheduleRepository::getSchedulesForMonth($year, $month, self::WEEKENDDAY);
        $weekEndScheduleData = ScheduleService::generateScheduleData($weekEndLessonScadules, self::WEEKENDDAY);
        $lessonTimeSlotSaturdayJrData = LessonTimeSlot::compareWeekendAndSaturdayJrTimes();
        $weekEndScheduleData = array_replace_recursive($weekEndScheduleData, $lessonTimeSlotSaturdayJrData);

        // 土曜日ジュニアのスケジュールデータを取得
        $saturdayJrLessonScadules = LessonScheduleRepository::getSchedulesForMonth($year, $month, self::SATURDAY_JR);
        $saturdayJrScheduleData = ScheduleService::generateScheduleData($saturdayJrLessonScadules, self::SATURDAY_JR);

        return view('admin.index', compact('year', 'month', 'lessonMasters', 'staffs', 'lessonTimeSlot', 'scheduleData', 'weekEndScheduleData', 'saturdayJrScheduleData'));
    }

    public function storeSchedule(StoreScheduleRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['lesson_time_slot_id'] = LessonTimeSlot::where('class_name', $validatedData['lesson_time_slot_name'])
        ->where('weekday_type', $validatedData['lesson_time_slot_weekday_type'])
        ->first()->id;
        $lessonSchedule = LessonSchedule::create($validatedData);

        return response()->json(['message' => 'スケジュールが保存されました', 'data' => $lessonSchedule], 201);
    }


    public function updateSchedule(StoreScheduleRequest $request, $id)
    {
        $validatedData = $request->validated();
        $validatedData['lesson_time_slot_id'] = LessonTimeSlot::where('class_name', $validatedData['lesson_time_slot_name'])->first()->id;

        $lessonSchedule = LessonSchedule::findOrFail($id);
        $lessonSchedule->update($validatedData);

        return response()->json(['message' => 'スケジュールが更新されました', 'data' => $lessonSchedule]);
    }

    public function deleteSchedule($id) // 追加
    {
        $lessonSchedule = LessonSchedule::findOrFail($id);
        $lessonSchedule->delete();

        return response()->json(['message' => 'スケジュールが削除されました']);
    }

    public function storeScheduleDetail(Request $request)
    {
        $yearMonth = $request->input('yearMonth');
        $year = substr($yearMonth, 0, 4);
        $month = substr($yearMonth, 5, 2);

        // LessonScheduleから対象のデータを取得
        $lessonSchedules = LessonSchedule::where('year_month', $yearMonth)->get();

        foreach ($lessonSchedules as $schedule) {
            // 月の日数を取得
            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

            for ($day = 1; $day <= $daysInMonth; $day++) {
                $date = sprintf('%04d-%02d-%02d', $year, $month, $day);
                $weekday = date('N', strtotime($date)); // 曜日を取得 (1:月曜日, 7:日曜日)

                if ($weekday == $schedule->weekday) {
                    // 日毎の情報をlesson_schedule_detailsに追加
                    LessonScheduleDetail::create([
                        'lesson_schedule_id' => $schedule->id,
                        'staff_id' => $schedule->staff_id,
                        'is_main_substituted' => false,
                        'sub_staff_id' => null,
                        'is_sub_substituted' => false,
                        'date' => $date,
                        'reserved_count' => 0,
                        'cancelled_count' => 0,
                        'lesson_court_status_id' => 1, // 仮のステータスID
                    ]);
                }
            }
        }

        return response()->json(['message' => 'スケジュール詳細が保存されました'], 201);
    }
}
