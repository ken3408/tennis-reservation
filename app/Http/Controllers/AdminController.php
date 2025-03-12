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
        // dd($scheduleData); // 追加
        // $scheduleData = $this->getScheduleData(); // 追加
        return view('admin.index', compact('year', 'month', 'lessonMasters', 'staffs', 'lessonTimeSlot', 'scheduleData'));
    }

    public function storeSchedule(StoreScheduleRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['lesson_time_slot_id'] = LessonTimeSlot::where('class_name', $validatedData['lesson_time_slot_name'])->first()->id;
        LessonSchedule::create($validatedData);


        return redirect()->route('admin.index')->with('success', 'スケジュールが保存されました');
    }
    private function getScheduleData()
    {
      $scheduleData = [
        "A 10:30〜12:00" => [
            "1" => [ //コート番号
                "1" => [
                    ["lesson_id" => 2, "class" => "初級"],
                    ["coach_id" => 1, "coach" => "山田 太郎"],
                    ["lesson_time_slot_id" => 1, "class_name" => "A", "start_time" => "10:30", "end_time" => "12:00"],
                ], // 月
                "2" => [
                    ["lesson_id" => 1, "class" => "初心"],
                    ["coach_id" => 2, "coach" => "山口"],
                    ["lesson_time_slot_id" => 1, "class_name" => "A", "start_time" => "10:30", "end_time" => "12:00"],
                ], // 火
                "3" => [
                    ["lesson_id" => 4, "class" => "中級"],
                    ["coach_id" => 3, "coach" => "佐藤 花子"],
                    ["lesson_time_slot_id" => 1, "class_name" => "A", "start_time" => "10:30", "end_time" => "12:00"],
                ], // 水
                "4" => [
                    ["lesson_id" => 6, "class" => "シングル"],
                    ["coach_id" => 4, "coach" => "高田"],
                    ["lesson_time_slot_id" => 1, "class_name" => "A", "start_time" => "10:30", "end_time" => "12:00"],
                ], // 木
                "5" => [
                    ["lesson_id" => 3, "class" => "初中級"],
                    ["coach_id" => 5, "coach" => "鈴木 一郎"],
                    ["lesson_time_slot_id" => 1, "class_name" => "A", "start_time" => "10:30", "end_time" => "12:00"],
                ], // 金
            ],
            "2" => [
                "1" => [
                    ["lesson_id" => 4, "class" => "担当クラス"],
                    ["coach_id" => 3, "coach" => "佐藤 花子"],
                    ["lesson_time_slot_id" => 1, "class_name" => "A", "start_time" => "10:30", "end_time" => "12:00"],
                ],
                "2" => [
                    ["lesson_id" => null, "class" => "担当クラス"],
                    ["coach_id" => null, "coach" => ""],
                    ["lesson_time_slot_id" => 1, "class_name" => "A", "start_time" => "10:30", "end_time" => "12:00"],
                ],
                "3" => [
                    ["lesson_id" => null, "class" => "担当クラス"],
                    ["coach_id" => null, "coach" => ""],
                    ["lesson_time_slot_id" => 1, "class_name" => "A", "start_time" => "10:30", "end_time" => "12:00"],
                ],
                "4" => [
                    ["lesson_id" => null, "class" => "担当クラス"],
                    ["coach_id" => null, "coach" => ""],
                    ["lesson_time_slot_id" => 1, "class_name" => "A", "start_time" => "10:30", "end_time" => "12:00"],
                ],
                "5" => [
                    ["lesson_id" => null, "class" => "担当クラス"],
                    ["coach_id" => null, "coach" => ""],
                    ["lesson_time_slot_id" => 1, "class_name" => "A", "start_time" => "10:30", "end_time" => "12:00"],
                ],
            ],
            "3" => [
                "1" => [
                    ["lesson_id" => 4, "class" => "担当クラス"],
                    ["coach_id" => 3, "coach" => "鈴木 一郎"],
                    ["lesson_time_slot_id" => 1, "class_name" => "A", "start_time" => "10:30", "end_time" => "12:00"],
                ],
                "2" => [
                    ["lesson_id" => null, "class" => "担当クラス"],
                    ["coach_id" => null, "coach" => ""],
                    ["lesson_time_slot_id" => 1, "class_name" => "A", "start_time" => "10:30", "end_time" => "12:00"],
                ],
                "3" => [
                    ["lesson_id" => null, "class" => "担当クラス"],
                    ["coach_id" => null, "coach" => ""],
                    ["lesson_time_slot_id" => 1, "class_name" => "A", "start_time" => "10:30", "end_time" => "12:00"],
                ],
                "4" => [
                    ["lesson_id" => null, "class" => "担当クラス"],
                    ["coach_id" => null, "coach" => ""],
                    ["lesson_time_slot_id" => 1, "class_name" => "A", "start_time" => "10:30", "end_time" => "12:00"],
                ],
                "5" => [
                    ["lesson_id" => null, "class" => "担当クラス"],
                    ["coach_id" => null, "coach" => ""],
                    ["lesson_time_slot_id" => 1, "class_name" => "A", "start_time" => "10:30", "end_time" => "12:00"],
                ],
            ],
            "4" => [
                "1" => [
                    ["lesson_id" => 4, "class" => "担当クラス"],
                    ["coach_id" => 3, "coach" => "高橋 美咲"],
                    ["lesson_time_slot_id" => 1, "class_name" => "A", "start_time" => "10:30", "end_time" => "12:00"],
                ],
                "2" => [
                    ["lesson_id" => null, "class" => "担当クラス"],
                    ["coach_id" => null, "coach" => ""],
                    ["lesson_time_slot_id" => 1, "class_name" => "A", "start_time" => "10:30", "end_time" => "12:00"],
                ],
                "3" => [
                    ["lesson_id" => null, "class" => "担当クラス"],
                    ["coach_id" => null, "coach" => ""],
                    ["lesson_time_slot_id" => 1, "class_name" => "A", "start_time" => "10:30", "end_time" => "12:00"],
                ],
                "4" => [
                    ["lesson_id" => null, "class" => "担当クラス"],
                    ["coach_id" => null, "coach" => ""],
                    ["lesson_time_slot_id" => 1, "class_name" => "A", "start_time" => "10:30", "end_time" => "12:00"],
                ],
                "5" => [
                    ["lesson_id" => null, "class" => "担当クラス"],
                    ["coach_id" => null, "coach" => ""],
                    ["lesson_time_slot_id" => 1, "class_name" => "A", "start_time" => "10:30", "end_time" => "12:00"],
                ],
            ]
        ],
        "B 12:30〜14:00" => [
            "1" => [ //コート番号
                "1" => [
                    ["lesson_id" => 2, "class" => "初級"],
                    ["coach_id" => 1, "coach" => "山田 太郎"],
                    ["lesson_time_slot_id" => 2, "class_name" => "B", "start_time" => "12:30", "end_time" => "14:00"],
                ], // 月
                "2" => [
                    ["lesson_id" => 1, "class" => "初心"],
                    ["coach_id" => 2, "coach" => "山口"],
                    ["lesson_time_slot_id" => 2, "class_name" => "B", "start_time" => "12:30", "end_time" => "14:00"],
                ], // 火
                "3" => [
                    ["lesson_id" => 4, "class" => "中級"],
                    ["coach_id" => 3, "coach" => "佐藤 花子"],
                    ["lesson_time_slot_id" => 2, "class_name" => "B", "start_time" => "12:30", "end_time" => "14:00"],
                ], // 水
                "4" => [
                    ["lesson_id" => 6, "class" => "シングル"],
                    ["coach_id" => 4, "coach" => "高田"],
                    ["lesson_time_slot_id" => 2, "class_name" => "B", "start_time" => "12:30", "end_time" => "14:00"],
                ], // 木
                "5" => [
                    ["lesson_id" => 3, "class" => "初中級"],
                    ["coach_id" => 5, "coach" => "鈴木 一郎"],
                    ["lesson_time_slot_id" => 2, "class_name" => "B", "start_time" => "12:30", "end_time" => "14:00"],
                ], // 金
            ],
            "2" => [
                "1" => [
                    ["lesson_id" => 6, "class" => "担当クラス"],
                    ["coach_id" => 6, "coach" => "高橋 美咲"],
                    ["lesson_time_slot_id" => 2, "class_name" => "B", "start_time" => "12:30", "end_time" => "14:00"],
                ],
                "2" => [
                    ["lesson_id" => null, "class" => "担当クラス"],
                    ["coach_id" => null, "coach" => ""],
                    ["lesson_time_slot_id" => 2, "class_name" => "B", "start_time" => "12:30", "end_time" => "14:00"],
                ],
                "3" => [
                    ["lesson_id" => null, "class" => "担当クラス"],
                    ["coach_id" => null, "coach" => ""],
                    ["lesson_time_slot_id" => 2, "class_name" => "B", "start_time" => "12:30", "end_time" => "14:00"],
                ],
                "4" => [
                    ["lesson_id" => null, "class" => "担当クラス"],
                    ["coach_id" => null, "coach" => ""],
                    ["lesson_time_slot_id" => 2, "class_name" => "B", "start_time" => "12:30", "end_time" => "14:00"],
                ],
                "5" => [
                    ["lesson_id" => null, "class" => "担当クラス"],
                    ["coach_id" => null, "coach" => ""],
                    ["lesson_time_slot_id" => 2, "class_name" => "B", "start_time" => "12:30", "end_time" => "14:00"],
                ],
            ],
            "3" => [
                "1" => [
                    ["lesson_id" => 5, "class" => "上級"],
                    ["coach_id" => 4, "coach" => "高田"],
                    ["lesson_time_slot_id" => 2, "class_name" => "B", "start_time" => "12:30", "end_time" => "14:00"],
                ],
                "2" => [
                    ["lesson_id" => 2, "class" => "初級"],
                    ["coach_id" => 1, "coach" => "山田 太郎"],
                    ["lesson_time_slot_id" => 2, "class_name" => "B", "start_time" => "12:30", "end_time" => "14:00"],
                ],
                "3" => [
                    ["lesson_id" => 3, "class" => "中級"],
                    ["coach_id" => 2, "coach" => "山口"],
                    ["lesson_time_slot_id" => 2, "class_name" => "B", "start_time" => "12:30", "end_time" => "14:00"],
                ],
                "4" => [
                    ["lesson_id" => 4, "class" => "シングル"],
                    ["coach_id" => 3, "coach" => "佐藤 花子"],
                    ["lesson_time_slot_id" => 2, "class_name" => "B", "start_time" => "12:30", "end_time" => "14:00"],
                ],
                "5" => [
                    ["lesson_id" => 6, "class" => "ダブルス"],
                    ["coach_id" => 5, "coach" => "鈴木 一郎"],
                    ["lesson_time_slot_id" => 2, "class_name" => "B", "start_time" => "12:30", "end_time" => "14:00"],
                ],
            ],
            "4" => [
                "1" => [
                    ["lesson_id" => 1, "class" => "初心"],
                    ["coach_id" => 2, "coach" => "山口"],
                    ["lesson_time_slot_id" => 2, "class_name" => "B", "start_time" => "12:30", "end_time" => "14:00"],
                ],
                "2" => [
                    ["lesson_id" => 3, "class" => "初中級"],
                    ["coach_id" => 5, "coach" => "鈴木 一郎"],
                    ["lesson_time_slot_id" => 2, "class_name" => "B", "start_time" => "12:30", "end_time" => "14:00"],
                ],
                "3" => [
                    ["lesson_id" => 4, "class" => "中級"],
                    ["coach_id" => 3, "coach" => "佐藤 花子"],
                    ["lesson_time_slot_id" => 2, "class_name" => "B", "start_time" => "12:30", "end_time" => "14:00"],
                ],
                "4" => [
                    ["lesson_id" => 6, "class" => "シングル"],
                    ["coach_id" => 4, "coach" => "高田"],
                    ["lesson_time_slot_id" => 2, "class_name" => "B", "start_time" => "12:30", "end_time" => "14:00"],
                ],
                "5" => [
                    ["lesson_id" => 2, "class" => "初級"],
                    ["coach_id" => 1, "coach" => "山田 太郎"],
                    ["lesson_time_slot_id" => 2, "class_name" => "B", "start_time" => "12:30", "end_time" => "14:00"],
                ],
            ]
        ],
        "C 14:30〜16:00" => [
            "1" => [ //コート番号
                "1" => [
                    ["lesson_id" => 3, "class" => "中級"],
                    ["coach_id" => 2, "coach" => "山口"],
                    ["lesson_time_slot_id" => 3, "class_name" => "C", "start_time" => "14:30", "end_time" => "16:00"],
                ], // 月
                "2" => [
                    ["lesson_id" => 1, "class" => "初心"],
                    ["coach_id" => 2, "coach" => "山口"],
                    ["lesson_time_slot_id" => 3, "class_name" => "C", "start_time" => "14:30", "end_time" => "16:00"],
                ], // 火
                "3" => [
                    ["lesson_id" => 4, "class" => "中級"],
                    ["coach_id" => 3, "coach" => "佐藤 花子"],
                    ["lesson_time_slot_id" => 3, "class_name" => "C", "start_time" => "14:30", "end_time" => "16:00"],
                ], // 水
                "4" => [
                    ["lesson_id" => 6, "class" => "シングル"],
                    ["coach_id" => 4, "coach" => "高田"],
                    ["lesson_time_slot_id" => 3, "class_name" => "C", "start_time" => "14:30", "end_time" => "16:00"],
                ], // 木
                "5" => [
                    ["lesson_id" => 3, "class" => "初中級"],
                    ["coach_id" => 5, "coach" => "鈴木 一郎"],
                    ["lesson_time_slot_id" => 3, "class_name" => "C", "start_time" => "14:30", "end_time" => "16:00"],
                ], // 金
            ],
            "2" => [
                "1" => [
                    ["lesson_id" => 6, "class" => "担当クラス"],
                    ["coach_id" => 6, "coach" => "高橋 美咲"],
                    ["lesson_time_slot_id" => 3, "class_name" => "C", "start_time" => "14:30", "end_time" => "16:00"],
                ],
                "2" => [
                    ["lesson_id" => null, "class" => "担当クラス"],
                    ["coach_id" => null, "coach" => ""],
                    ["lesson_time_slot_id" => 3, "class_name" => "C", "start_time" => "14:30", "end_time" => "16:00"],
                ],
                "3" => [
                    ["lesson_id" => null, "class" => "担当クラス"],
                    ["coach_id" => null, "coach" => ""],
                    ["lesson_time_slot_id" => 3, "class_name" => "C", "start_time" => "14:30", "end_time" => "16:00"],
                ],
                "4" => [
                    ["lesson_id" => null, "class" => "担当クラス"],
                    ["coach_id" => null, "coach" => ""],
                    ["lesson_time_slot_id" => 3, "class_name" => "C", "start_time" => "14:30", "end_time" => "16:00"],
                ],
                "5" => [
                    ["lesson_id" => null, "class" => "担当クラス"],
                    ["coach_id" => null, "coach" => ""],
                    ["lesson_time_slot_id" => 3, "class_name" => "C", "start_time" => "14:30", "end_time" => "16:00"],
                ],
            ],
            "3" => [
                "1" => [
                    ["lesson_id" => 5, "class" => "上級"],
                    ["coach_id" => 4, "coach" => "高田"],
                    ["lesson_time_slot_id" => 3, "class_name" => "C", "start_time" => "14:30", "end_time" => "16:00"],
                ],
                "2" => [
                    ["lesson_id" => 2, "class" => "初級"],
                    ["coach_id" => 1, "coach" => "山田 太郎"],
                    ["lesson_time_slot_id" => 3, "class_name" => "C", "start_time" => "14:30", "end_time" => "16:00"],
                ],
                "3" => [
                    ["lesson_id" => 3, "class" => "中級"],
                    ["coach_id" => 2, "coach" => "山口"],
                    ["lesson_time_slot_id" => 3, "class_name" => "C", "start_time" => "14:30", "end_time" => "16:00"],
                ],
                "4" => [
                    ["lesson_id" => 4, "class" => "シングル"],
                    ["coach_id" => 3, "coach" => "佐藤 花子"],
                    ["lesson_time_slot_id" => 3, "class_name" => "C", "start_time" => "14:30", "end_time" => "16:00"],
                ],
                "5" => [
                    ["lesson_id" => 6, "class" => "ダブルス"],
                    ["coach_id" => 5, "coach" => "鈴木 一郎"],
                    ["lesson_time_slot_id" => 3, "class_name" => "C", "start_time" => "14:30", "end_time" => "16:00"],
                ],
            ],
            "4" => [
                "1" => [
                    ["lesson_id" => 1, "class" => "初心"],
                    ["coach_id" => 2, "coach" => "山口"],
                    ["lesson_time_slot_id" => 3, "class_name" => "C", "start_time" => "14:30", "end_time" => "16:00"],
                ],
                "2" => [
                    ["lesson_id" => 3, "class" => "初中級"],
                    ["coach_id" => 5, "coach" => "鈴木 一郎"],
                    ["lesson_time_slot_id" => 3, "class_name" => "C", "start_time" => "14:30", "end_time" => "16:00"],
                ],
                "3" => [
                    ["lesson_id" => 4, "class" => "中級"],
                    ["coach_id" => 3, "coach" => "佐藤 花子"],
                    ["lesson_time_slot_id" => 3, "class_name" => "C", "start_time" => "14:30", "end_time" => "16:00"],
                ],
                "4" => [
                    ["lesson_id" => 6, "class" => "シングル"],
                    ["coach_id" => 4, "coach" => "高田"],
                    ["lesson_time_slot_id" => 3, "class_name" => "C", "start_time" => "14:30", "end_time" => "16:00"],
                ],
                "5" => [
                    ["lesson_id" => 2, "class" => "初級"],
                    ["coach_id" => 1, "coach" => "山田 太郎"],
                    ["lesson_time_slot_id" => 3, "class_name" => "C", "start_time" => "14:30", "end_time" => "16:00"],
                ],
            ]
        ],
        "D 16:30〜18:00" => [
            "1" => [ //コート番号
                "1" => [
                    ["lesson_id" => 4, "class" => "上級"],
                    ["coach_id" => 3, "coach" => "佐藤 花子"],
                    ["lesson_time_slot_id" => 4, "class_name" => "D", "start_time" => "16:30", "end_time" => "18:00"],
                ], // 月
                "2" => [
                    ["lesson_id" => 1, "class" => "初心"],
                    ["coach_id" => 2, "coach" => "山口"],
                    ["lesson_time_slot_id" => 4, "class_name" => "D", "start_time" => "16:30", "end_time" => "18:00"],
                ], // 火
                "3" => [
                    ["lesson_id" => 4, "class" => "中級"],
                    ["coach_id" => 3, "coach" => "佐藤 花子"],
                    ["lesson_time_slot_id" => 4, "class_name" => "D", "start_time" => "16:30", "end_time" => "18:00"],
                ], // 水
                "4" => [
                    ["lesson_id" => 6, "class" => "シングル"],
                    ["coach_id" => 4, "coach" => "高田"],
                    ["lesson_time_slot_id" => 4, "class_name" => "D", "start_time" => "16:30", "end_time" => "18:00"],
                ], // 木
                "5" => [
                    ["lesson_id" => 3, "class" => "初中級"],
                    ["coach_id" => 5, "coach" => "鈴木 一郎"],
                    ["lesson_time_slot_id" => 4, "class_name" => "D", "start_time" => "16:30", "end_time" => "18:00"],
                ], // 金
            ],
            "2" => [
                "1" => [
                    ["lesson_id" => 6, "class" => "担当クラス"],
                    ["coach_id" => 6, "coach" => "高橋 美咲"],
                    ["lesson_time_slot_id" => 4, "class_name" => "D", "start_time" => "16:30", "end_time" => "18:00"],
                ],
                "2" => [
                    ["lesson_id" => null, "class" => "担当クラス"],
                    ["coach_id" => null, "coach" => ""],
                    ["lesson_time_slot_id" => 4, "class_name" => "D", "start_time" => "16:30", "end_time" => "18:00"],
                ],
                "3" => [
                    ["lesson_id" => null, "class" => "担当クラス"],
                    ["coach_id" => null, "coach" => ""],
                    ["lesson_time_slot_id" => 4, "class_name" => "D", "start_time" => "16:30", "end_time" => "18:00"],
                ],
                "4" => [
                    ["lesson_id" => null, "class" => "担当クラス"],
                    ["coach_id" => null, "coach" => ""],
                    ["lesson_time_slot_id" => 4, "class_name" => "D", "start_time" => "16:30", "end_time" => "18:00"],
                ],
                "5" => [
                    ["lesson_id" => null, "class" => "担当クラス"],
                    ["coach_id" => null, "coach" => ""],
                    ["lesson_time_slot_id" => 4, "class_name" => "D", "start_time" => "16:30", "end_time" => "18:00"],
                ],
            ],
            "3" => [
                "1" => [
                    ["lesson_id" => 5, "class" => "上級"],
                    ["coach_id" => 4, "coach" => "高田"],
                    ["lesson_time_slot_id" => 4, "class_name" => "D", "start_time" => "16:30", "end_time" => "18:00"],
                ],
                "2" => [
                    ["lesson_id" => 2, "class" => "初級"],
                    ["coach_id" => 1, "coach" => "山田 太郎"],
                    ["lesson_time_slot_id" => 4, "class_name" => "D", "start_time" => "16:30", "end_time" => "18:00"],
                ],
                "3" => [
                    ["lesson_id" => 3, "class" => "中級"],
                    ["coach_id" => 2, "coach" => "山口"],
                    ["lesson_time_slot_id" => 4, "class_name" => "D", "start_time" => "16:30", "end_time" => "18:00"],
                ],
                "4" => [
                    ["lesson_id" => 4, "class" => "シングル"],
                    ["coach_id" => 3, "coach" => "佐藤 花子"],
                    ["lesson_time_slot_id" => 4, "class_name" => "D", "start_time" => "16:30", "end_time" => "18:00"],
                ],
                "5" => [
                    ["lesson_id" => 6, "class" => "ダブルス"],
                    ["coach_id" => 5, "coach" => "鈴木 一郎"],
                    ["lesson_time_slot_id" => 4, "class_name" => "D", "start_time" => "16:30", "end_time" => "18:00"],
                ],
            ],
            "4" => [
                "1" => [
                    ["lesson_id" => 1, "class" => "初心"],
                    ["coach_id" => 2, "coach" => "山口"],
                    ["lesson_time_slot_id" => 4, "class_name" => "D", "start_time" => "16:30", "end_time" => "18:00"],
                ],
                "2" => [
                    ["lesson_id" => 3, "class" => "初中級"],
                    ["coach_id" => 5, "coach" => "鈴木 一郎"],
                    ["lesson_time_slot_id" => 4, "class_name" => "D", "start_time" => "16:30", "end_time" => "18:00"],
                ],
                "3" => [
                    ["lesson_id" => 4, "class" => "中級"],
                    ["coach_id" => 3, "coach" => "佐藤 花子"],
                    ["lesson_time_slot_id" => 4, "class_name" => "D", "start_time" => "16:30", "end_time" => "18:00"],
                ],
                "4" => [
                    ["lesson_id" => 6, "class" => "シングル"],
                    ["coach_id" => 4, "coach" => "高田"],
                    ["lesson_time_slot_id" => 4, "class_name" => "D", "start_time" => "16:30", "end_time" => "18:00"],
                ],
                "5" => [
                    ["lesson_id" => 2, "class" => "初級"],
                    ["coach_id" => 1, "coach" => "山田 太郎"],
                    ["lesson_time_slot_id" => 4, "class_name" => "D", "start_time" => "16:30", "end_time" => "18:00"],
                ],
            ]
        ],
        "E 18:30〜20:00" => [
            "1" => [ //コート番号
                "1" => [
                    ["lesson_id" => 5, "class" => "シングル"],
                    ["coach_id" => 4, "coach" => "高田"],
                    ["lesson_time_slot_id" => 5, "class_name" => "E", "start_time" => "18:30", "end_time" => "20:00"],
                ], // 月
                "2" => [
                    ["lesson_id" => 1, "class" => "初心"],
                    ["coach_id" => 2, "coach" => "山口"],
                    ["lesson_time_slot_id" => 5, "class_name" => "E", "start_time" => "18:30", "end_time" => "20:00"],
                ], // 火
                "3" => [
                    ["lesson_id" => 4, "class" => "中級"],
                    ["coach_id" => 3, "coach" => "佐藤 花子"],
                    ["lesson_time_slot_id" => 5, "class_name" => "E", "start_time" => "18:30", "end_time" => "20:00"],
                ], // 水
                "4" => [
                    ["lesson_id" => 6, "class" => "シングル"],
                    ["coach_id" => 4, "coach" => "高田"],
                    ["lesson_time_slot_id" => 5, "class_name" => "E", "start_time" => "18:30", "end_time" => "20:00"],
                ], // 木
                "5" => [
                    ["lesson_id" => 3, "class" => "初中級"],
                    ["coach_id" => 5, "coach" => "鈴木 一郎"],
                    ["lesson_time_slot_id" => 5, "class_name" => "E", "start_time" => "18:30", "end_time" => "20:00"],
                ], // 金
            ],
            "2" => [
                "1" => [
                    ["lesson_id" => 6, "class" => "担当クラス"],
                    ["coach_id" => 6, "coach" => "高橋 美咲"],
                    ["lesson_time_slot_id" => 5, "class_name" => "E", "start_time" => "18:30", "end_time" => "20:00"],
                ],
                "2" => [
                    ["lesson_id" => null, "class" => "担当クラス"],
                    ["coach_id" => null, "coach" => ""],
                    ["lesson_time_slot_id" => 5, "class_name" => "E", "start_time" => "18:30", "end_time" => "20:00"],
                ],
                "3" => [
                    ["lesson_id" => null, "class" => "担当クラス"],
                    ["coach_id" => null, "coach" => ""],
                    ["lesson_time_slot_id" => 5, "class_name" => "E", "start_time" => "18:30", "end_time" => "20:00"],
                ],
                "4" => [
                    ["lesson_id" => null, "class" => "担当クラス"],
                    ["coach_id" => null, "coach" => ""],
                    ["lesson_time_slot_id" => 5, "class_name" => "E", "start_time" => "18:30", "end_time" => "20:00"],
                ],
                "5" => [
                    ["lesson_id" => null, "class" => "担当クラス"],
                    ["coach_id" => null, "coach" => ""],
                    ["lesson_time_slot_id" => 5, "class_name" => "E", "start_time" => "18:30", "end_time" => "20:00"],
                ],
            ],
            "3" => [
                "1" => [
                    ["lesson_id" => 5, "class" => "上級"],
                    ["coach_id" => 4, "coach" => "高田"],
                    ["lesson_time_slot_id" => 5, "class_name" => "E", "start_time" => "18:30", "end_time" => "20:00"],
                ],
                "2" => [
                    ["lesson_id" => 2, "class" => "初級"],
                    ["coach_id" => 1, "coach" => "山田 太郎"],
                    ["lesson_time_slot_id" => 5, "class_name" => "E", "start_time" => "18:30", "end_time" => "20:00"],
                ],
                "3" => [
                    ["lesson_id" => 3, "class" => "中級"],
                    ["coach_id" => 2, "coach" => "山口"],
                    ["lesson_time_slot_id" => 5, "class_name" => "E", "start_time" => "18:30", "end_time" => "20:00"],
                ],
                "4" => [
                    ["lesson_id" => 4, "class" => "シングル"],
                    ["coach_id" => 3, "coach" => "佐藤 花子"],
                    ["lesson_time_slot_id" => 5, "class_name" => "E", "start_time" => "18:30", "end_time" => "20:00"],
                ],
                "5" => [
                    ["lesson_id" => 6, "class" => "ダブルス"],
                    ["coach_id" => 5, "coach" => "鈴木 一郎"],
                    ["lesson_time_slot_id" => 5, "class_name" => "E", "start_time" => "18:30", "end_time" => "20:00"],
                ],
            ],
            "4" => [
                "1" => [
                    ["lesson_id" => 1, "class" => "初心"],
                    ["coach_id" => 2, "coach" => "山口"],
                    ["lesson_time_slot_id" => 5, "class_name" => "E", "start_time" => "18:30", "end_time" => "20:00"],
                ],
                "2" => [
                    ["lesson_id" => 3, "class" => "初中級"],
                    ["coach_id" => 5, "coach" => "鈴木 一郎"],
                    ["lesson_time_slot_id" => 5, "class_name" => "E", "start_time" => "18:30", "end_time" => "20:00"],
                ],
                "3" => [
                    ["lesson_id" => 4, "class" => "中級"],
                    ["coach_id" => 3, "coach" => "佐藤 花子"],
                    ["lesson_time_slot_id" => 5, "class_name" => "E", "start_time" => "18:30", "end_time" => "20:00"],
                ],
                "4" => [
                    ["lesson_id" => 6, "class" => "シングル"],
                    ["coach_id" => 4, "coach" => "高田"],
                    ["lesson_time_slot_id" => 5, "class_name" => "E", "start_time" => "18:30", "end_time" => "20:00"],
                ],
                "5" => [
                    ["lesson_id" => 2, "class" => "初級"],
                    ["coach_id" => 1, "coach" => "山田 太郎"],
                    ["lesson_time_slot_id" => 5, "class_name" => "E", "start_time" => "18:30", "end_time" => "20:00"],
                ],
            ]
        ],
        "F 20:30〜22:00" => [
            "1" => [ //コート番号
                "1" => [
                    ["lesson_id" => 6, "class" => "ダブルス"],
                    ["coach_id" => 5, "coach" => "鈴木 一郎"],
                    ["lesson_time_slot_id" => 6, "class_name" => "F", "start_time" => "20:30", "end_time" => "22:00"],
                ], // 月
                "2" => [
                    ["lesson_id" => 1, "class" => "初心"],
                    ["coach_id" => 2, "coach" => "山口"],
                    ["lesson_time_slot_id" => 6, "class_name" => "F", "start_time" => "20:30", "end_time" => "22:00"],
                ], // 火
                "3" => [
                    ["lesson_id" => 4, "class" => "中級"],
                    ["coach_id" => 3, "coach" => "佐藤 花子"],
                    ["lesson_time_slot_id" => 6, "class_name" => "F", "start_time" => "20:30", "end_time" => "22:00"],
                ], // 水
                "4" => [
                    ["lesson_id" => 6, "class" => "シングル"],
                    ["coach_id" => 4, "coach" => "高田"],
                    ["lesson_time_slot_id" => 6, "class_name" => "F", "start_time" => "20:30", "end_time" => "22:00"],
                ], // 木
                "5" => [
                    ["lesson_id" => 3, "class" => "初中級"],
                    ["coach_id" => 5, "coach" => "鈴木 一郎"],
                    ["lesson_time_slot_id" => 6, "class_name" => "F", "start_time" => "20:30", "end_time" => "22:00"],
                ], // 金
            ],
            "2" => [
                "1" => [
                    ["lesson_id" => 6, "class" => "担当クラス"],
                    ["coach_id" => 6, "coach" => "高橋 美咲"],
                    ["lesson_time_slot_id" => 6, "class_name" => "F", "start_time" => "20:30", "end_time" => "22:00"],
                ],
                "2" => [
                    ["lesson_id" => null, "class" => "担当クラス"],
                    ["coach_id" => null, "coach" => ""],
                    ["lesson_time_slot_id" => 6, "class_name" => "F", "start_time" => "20:30", "end_time" => "22:00"],
                ],
                "3" => [
                    ["lesson_id" => null, "class" => "担当クラス"],
                    ["coach_id" => null, "coach" => ""],
                    ["lesson_time_slot_id" => 6, "class_name" => "F", "start_time" => "20:30", "end_time" => "22:00"],
                ],
                "4" => [
                    ["lesson_id" => null, "class" => "担当クラス"],
                    ["coach_id" => null, "coach" => ""],
                    ["lesson_time_slot_id" => 6, "class_name" => "F", "start_time" => "20:30", "end_time" => "22:00"],
                ],
                "5" => [
                    ["lesson_id" => null, "class" => "担当クラス"],
                    ["coach_id" => null, "coach" => ""],
                    ["lesson_time_slot_id" => 6, "class_name" => "F", "start_time" => "20:30", "end_time" => "22:00"],
                ],
            ],
            "3" => [
                "1" => [
                    ["lesson_id" => 5, "class" => "上級"],
                    ["coach_id" => 4, "coach" => "高田"],
                    ["lesson_time_slot_id" => 6, "class_name" => "F", "start_time" => "20:30", "end_time" => "22:00"],
                ],
                "2" => [
                    ["lesson_id" => 2, "class" => "初級"],
                    ["coach_id" => 1, "coach" => "山田 太郎"],
                    ["lesson_time_slot_id" => 6, "class_name" => "F", "start_time" => "20:30", "end_time" => "22:00"],
                ],
                "3" => [
                    ["lesson_id" => 3, "class" => "中級"],
                    ["coach_id" => 2, "coach" => "山口"],
                    ["lesson_time_slot_id" => 6, "class_name" => "F", "start_time" => "20:30", "end_time" => "22:00"],
                ],
                "4" => [
                    ["lesson_id" => 4, "class" => "シングル"],
                    ["coach_id" => 3, "coach" => "佐藤 花子"],
                    ["lesson_time_slot_id" => 6, "class_name" => "F", "start_time" => "20:30", "end_time" => "22:00"],
                ],
                "5" => [
                    ["lesson_id" => 6, "class" => "ダブルス"],
                    ["coach_id" => 5, "coach" => "鈴木 一郎"],
                    ["lesson_time_slot_id" => 6, "class_name" => "F", "start_time" => "20:30", "end_time" => "22:00"],
                ],
            ],
            "4" => [
                "1" => [
                    ["lesson_id" => 1, "class" => "初心"],
                    ["coach_id" => 2, "coach" => "山口"],
                    ["lesson_time_slot_id" => 6, "class_name" => "F", "start_time" => "20:30", "end_time" => "22:00"],
                ],
                "2" => [
                    ["lesson_id" => 3, "class" => "初中級"],
                    ["coach_id" => 5, "coach" => "鈴木 一郎"],
                    ["lesson_time_slot_id" => 6, "class_name" => "F", "start_time" => "20:30", "end_time" => "22:00"],
                ],
                "3" => [
                    ["lesson_id" => 4, "class" => "中級"],
                    ["coach_id" => 3, "coach" => "佐藤 花子"],
                    ["lesson_time_slot_id" => 6, "class_name" => "F", "start_time" => "20:30", "end_time" => "22:00"],
                ],
                "4" => [
                    ["lesson_id" => 6, "class" => "シングル"],
                    ["coach_id" => 4, "coach" => "高田"],
                    ["lesson_time_slot_id" => 6, "class_name" => "F", "start_time" => "20:30", "end_time" => "22:00"],
                ],
                "5" => [
                    ["lesson_id" => 2, "class" => "初級"],
                    ["coach_id" => 1, "coach" => "山田 太郎"],
                    ["lesson_time_slot_id" => 6, "class_name" => "F", "start_time" => "20:30", "end_time" => "22:00"],
                ],
            ]
        ]
    ];
        return $scheduleData;
    }
}
