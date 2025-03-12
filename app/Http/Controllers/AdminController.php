<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LessonMaster; // 追加
use App\Models\Staff; // 追加
use App\Models\LessonSchedule; // 追加
use App\Models\LessonTimeSlot; // 追加
use App\Http\Requests\StoreScheduleRequest; // 追加
use App\Services\ScheduleService; // 追加

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
        $lessonScadules = LessonSchedule::where('year_month', $year . sprintf('%02d', $month))->get(); // 追加
        $scheduleData = ScheduleService::generateScheduleData($lessonScadules); // 変更
        dd($scheduleData); // 追加

        return view('admin.index', compact('year', 'month', 'lessonMasters', 'staffs', 'lessonTimeSlot', 'scheduleData'));
    }

    public function storeSchedule(StoreScheduleRequest $request)
    {
        $validatedData = $request->validated();

        LessonSchedule::create($validatedData);


        return redirect()->route('admin.index')->with('success', 'スケジュールが保存されました');
    }
}
