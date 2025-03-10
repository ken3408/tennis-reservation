<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LessonMaster; // 追加
use App\Models\Staff; // 追加
use App\Models\LessonSchedule; // 追加

class AdminController extends Controller
{
    public function index()
    {
        $lessonMasters = LessonMaster::all(); // 追加
        $staffs = Staff::all(); // 追加

        return view('admin.index', compact('lessonMasters', 'staffs')); // 変更
    }

    public function storeSchedule(Request $request)
    {
        $validatedData = $request->validate([
            'lesson_master_id' => 'required|exists:lesson_masters,id',
            'staff_id' => 'nullable|exists:staff,id',
            // 他のバリデーションルールを追加
        ]);

        LessonSchedule::create($validatedData);

        return redirect()->route('admin.index')->with('success', 'スケジュールが保存されました');
    }
}
