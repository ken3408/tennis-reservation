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
use Carbon\Carbon;
use Illuminate\Support\Facades\DB; // DBクラスをインポート

class AdminController extends Controller
{
    const WEEKDAY = "WEEKDAY";
    const WEEKENDDAY = "WEEKENDDAY";
    const SATURDAY_JR = "SATURDAY-JR";

    /**
     * 管理画面のトップページを表示する
     */
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

    /**
     * スケジュールを保存する
     */
    public function storeSchedule(StoreScheduleRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['lesson_time_slot_id'] = LessonTimeSlot::where('class_name', $validatedData['lesson_time_slot_name'])
            ->where('weekday_type', $validatedData['lesson_time_slot_weekday_type'])
            ->first()->id;
        $lessonSchedule = LessonSchedule::create($validatedData);

        return response()->json(['message' => 'スケジュールが保存されました', 'data' => $lessonSchedule], 201);
    }

    /**
     * スケジュールを更新する
     */
    public function updateSchedule(StoreScheduleRequest $request, $id)
    {
        $validatedData = $request->validated();
        $validatedData['lesson_time_slot_id'] = LessonTimeSlot::where('class_name', $validatedData['lesson_time_slot_name'])->first()->id;

        $lessonSchedule = LessonSchedule::findOrFail($id);
        $lessonSchedule->update($validatedData);

        return response()->json(['message' => 'スケジュールが更新されました', 'data' => $lessonSchedule]);
    }

    /**
     * スケジュールを削除する
     */
    public function deleteSchedule($id) // 追加
    {
        $lessonSchedule = LessonSchedule::findOrFail($id);
        $lessonSchedule->delete();

        return response()->json(['message' => 'スケジュールが削除されました']);
    }

    /**
     * スケジュール詳細を保存する
     */
    public function storeScheduleDetail(Request $request)
    {
        $yearMonth = $request->input('year_month');
        $year = substr($yearMonth, 0, 4);
        $month = substr($yearMonth, 5, 2);
        ScheduleService::insertLessonScheduleDetails($yearMonth);

        return response()->json(['message' => 'スケジュール詳細が保存されました'], 201);
    }

    /**
     * 日付選択画面を表示する
     */
    public function dateIndex(Request $request)
    {
        return view('admin.date.index');
    }

    /**
     * 指定された日付のシフトデータを取得し、表示する
     */
    public function dateShift($date, Request $request)
    {
        // $dateをyearとmonth、day、weekdayに分ける
        $year = substr($date, 0, 4);
        $month = substr($date, 4, 2);
        $day = substr($date, 6, 2);
        $weekday = Carbon::parse($date)->format('D');
        // $weekdayを日本語に変換
        $weekday = str_replace(['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'], ['日', '月', '火', '水', '木', '金', '土'], $weekday);
        // $date(20240304)を-で2024-03-04のような形にする
        $date = substr($date, 0, 4) . '-' . substr($date, 4, 2) . '-' . substr($date, 6, 2);

        // $dateで平日か休日かを判定
        $weekdayType = Carbon::parse($date)->isWeekend() ? self::WEEKENDDAY : self::WEEKDAY;
        // $weekdayTypeでlessonTimeSlotを取得
        $lessonTimeSlots = LessonTimeSlot::where('weekday_type', $weekdayType)->get();

        // lesson_schedulesをlesson_time_slot_id毎に配列分け (サービスクラスに移動)
        $lessons = ScheduleService::getLessonsGroupedByTimeSlotByCourt($date, $lessonTimeSlots);

        return view('admin.date.shift', compact('year', 'month', 'day', 'weekday', 'lessonTimeSlots', 'lessons'));
    }
}
