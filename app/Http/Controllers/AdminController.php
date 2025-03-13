<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LessonMaster; // 追加
use App\Models\Staff; // 追加
use App\Models\LessonTimeSlot; // 追加
use App\Models\LessonSchedule; // 追加
use App\Http\Requests\StoreScheduleRequest; // 追加
use App\Services\ScheduleService; // 追加
use App\Repositories\LessonScheduleRepository; // 追加

class AdminController extends Controller
{
    public function index()
    {
        // 今年の年と月を取得
        $year = date('Y');
        $month = date('n');
        $lessonMasters = LessonMaster::all(); // 追加
        $staffs = Staff::all(); // 追加
        $lessonTimeSlot = LessonTimeSlot::all(); // 追加
        $lessonScadules = LessonScheduleRepository::getSchedulesForMonth($year, $month); // 変更
        $scheduleData = ScheduleService::generateScheduleData($lessonScadules); // 変更

        // $scheduleData = $this->getScheduleData(); // 追加
        return view('admin.index', compact('year', 'month', 'lessonMasters', 'staffs', 'lessonTimeSlot', 'scheduleData'));
    }

    public function storeSchedule(StoreScheduleRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['lesson_time_slot_id'] = LessonTimeSlot::where('class_name', $validatedData['lesson_time_slot_name'])->first()->id;
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
}
