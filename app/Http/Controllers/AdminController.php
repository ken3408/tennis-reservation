<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LessonMaster; // 追加
use App\Models\Staff; // 追加

class AdminController extends Controller
{
    public function index()
    {
        $lessonMasters = LessonMaster::all(); // 追加
        $staffs = Staff::all(); // 追加

        return view('admin.index', compact('lessonMasters', 'staffs')); // 変更
    }
}
