<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LessonMaster; // 追加
use App\Models\Staff; // 追加
use App\Models\LessonSchedule; // 追加
use App\Models\LessonTimeSlot; // 追加

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
        $scheduleData = [
            "A 10:30〜12:00" => [
                "1" => [ //コート番号
                    "1" => [
                        ["lesson_id" => 2, "class" => "初級"],
                        ["coach_id" => 1, "coach" => "山田 太郎"]
                    ], // 月
                    "2" => [
                        ["lesson_id" => 1, "class" => "初心"],
                        ["coach_id" => 2, "coach" => "山口"]
                    ], // 火
                    "3" => [
                        ["lesson_id" => 4, "class" => "中級"],
                        ["coach_id" => 3, "coach" => "佐藤 花子"]
                    ], // 水
                    "4" => [
                        ["lesson_id" => 6, "class" => "シングル"],
                        ["coach_id" => 4, "coach" => "高田"]
                    ], // 木
                    "5" => [
                        ["lesson_id" => 3, "class" => "初中級"],
                        ["coach_id" => 5, "coach" => "鈴木 一郎"]
                    ], // 金
                ],
                "2" => [
                    "1" => [
                        ["lesson_id" => 4, "class" => "担当クラス"],
                        ["coach_id" => 3, "coach" => "佐藤 花子"]
                    ],
                    "2" => [
                        ["lesson_id" => null, "class" => "担当クラス"],
                        ["coach_id" => null, "coach" => ""]
                    ],
                    "3" => [
                        ["lesson_id" => null, "class" => "担当クラス"],
                        ["coach_id" => null, "coach" => ""]
                    ],
                    "4" => [
                        ["lesson_id" => null, "class" => "担当クラス"],
                        ["coach_id" => null, "coach" => ""]
                    ],
                    "5" => [
                        ["lesson_id" => null, "class" => "担当クラス"],
                        ["coach_id" => null, "coach" => ""]
                    ],
                ],
                "3" => [
                    "1" => [
                        ["lesson_id" => 4, "class" => "担当クラス"],
                        ["coach_id" => 3, "coach" => "鈴木 一郎"]
                    ],
                    "2" => [
                        ["lesson_id" => null, "class" => "担当クラス"],
                        ["coach_id" => null, "coach" => ""]
                    ],
                    "3" => [
                        ["lesson_id" => null, "class" => "担当クラス"],
                        ["coach_id" => null, "coach" => ""]
                    ],
                    "4" => [
                        ["lesson_id" => null, "class" => "担当クラス"],
                        ["coach_id" => null, "coach" => ""]
                    ],
                    "5" => [
                        ["lesson_id" => null, "class" => "担当クラス"],
                        ["coach_id" => null, "coach" => ""]
                    ],
                ],
                "4" => [
                    "1" => [
                        ["lesson_id" => 4, "class" => "担当クラス"],
                        ["coach_id" => 3, "coach" => "高橋 美咲"]
                    ],
                    "2" => [
                        ["lesson_id" => null, "class" => "担当クラス"],
                        ["coach_id" => null, "coach" => ""]
                    ],
                    "3" => [
                        ["lesson_id" => null, "class" => "担当クラス"],
                        ["coach_id" => null, "coach" => ""]
                    ],
                    "4" => [
                        ["lesson_id" => null, "class" => "担当クラス"],
                        ["coach_id" => null, "coach" => ""]
                    ],
                    "5" => [
                        ["lesson_id" => null, "class" => "担当クラス"],
                        ["coach_id" => null, "coach" => ""]
                    ],
                ]
            ],
            "B 12:30〜14:00" => [
                "1" => [ //コート番号
                    "1" => [
                        ["lesson_id" => 2, "class" => "初級"],
                        ["coach_id" => 1, "coach" => "山田 太郎"]
                    ], // 月
                    "2" => [
                        ["lesson_id" => 1, "class" => "初心"],
                        ["coach_id" => 2, "coach" => "山口"]
                    ], // 火
                    "3" => [
                        ["lesson_id" => 4, "class" => "中級"],
                        ["coach_id" => 3, "coach" => "佐藤 花子"]
                    ], // 水
                    "4" => [
                        ["lesson_id" => 6, "class" => "シングル"],
                        ["coach_id" => 4, "coach" => "高田"]
                    ], // 木
                    "5" => [
                        ["lesson_id" => 3, "class" => "初中級"],
                        ["coach_id" => 5, "coach" => "鈴木 一郎"]
                    ], // 金
                ],
                "2" => [
                    "1" => [
                        ["lesson_id" => 6, "class" => "担当クラス"],
                        ["coach_id" => 6, "coach" => "高橋 美咲"]
                    ],
                    "2" => [
                        ["lesson_id" => null, "class" => "担当クラス"],
                        ["coach_id" => null, "coach" => ""]
                    ],
                    "3" => [
                        ["lesson_id" => null, "class" => "担当クラス"],
                        ["coach_id" => null, "coach" => ""]
                    ],
                    "4" => [
                        ["lesson_id" => null, "class" => "担当クラス"],
                        ["coach_id" => null, "coach" => ""]
                    ],
                    "5" => [
                        ["lesson_id" => null, "class" => "担当クラス"],
                        ["coach_id" => null, "coach" => ""]
                    ],
                ]
            ]
        ];

        return view('admin.index', compact('year', 'month', 'lessonMasters', 'staffs', 'lessonTimeSlot', 'scheduleData'));
    }

    public function storeSchedule(Request $request)
    {
        dd($request->all());
        // $validatedData = $request->validate([
        //     'lesson_master_id' => 'required|exists:lesson_masters,id',
        //     'staff_id' => 'nullable|exists:staff,id',
        //     // 他のバリデーションルールを追加
        // ]);

        LessonSchedule::create($validatedData);

        return redirect()->route('admin.index')->with('success', 'スケジュールが保存されました');
    }
}
