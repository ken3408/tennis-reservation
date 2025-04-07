<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LessonSchedule;
use App\Models\LessonScheduleDetail;
use App\Models\LessonStudentRecord;
use Illuminate\Support\Facades\DB;

class LessonController extends Controller
{
  public function save(Request $request)
  {
    $lessonScheduleDetailId = $request->query('lessonScheduleDetailId');
    $lessonInfo = $request->input('lessonInfo');
    $existingStudents = $request->input('existingStudents');
    $addedStudents = $request->input('addedStudents');
    $canceledStudents = $request->input('canceledStudents');

    // レッスンスケジュール詳細を取得
    $lessonScheduleDetail = LessonScheduleDetail::find($lessonScheduleDetailId);
    if (!$lessonScheduleDetail) {
      return response()->json(['message' => 'レッスンスケジュールが見つかりません'], 404);
    }

    // レッスンスケジュール詳細を更新
    $lessonScheduleDetail->update([
      'staff_id' => $lessonInfo['coachId'],
      'is_main_substituted' => $lessonInfo['isSubstitute'],
      'cancel_reason' => $lessonInfo['cancelReason'],
    ]);

    return response()->json(['message' => 'レッスン情報が更新されました'], 200);
  }

  public function update(Request $request, $lessonScheduleDetailId)
  {
    $lessonInfo = $request->input('lessonInfo');
    $existingStudents = $request->input('existingStudents');
    $addedStudents = $request->input('addedStudents');
    $canceledStudents = $request->input('canceledStudents');

    // レッスンスケジュール詳細を取得
    $lessonScheduleDetail = LessonScheduleDetail::find($lessonScheduleDetailId);
    if (!$lessonScheduleDetail) {
      return response()->json(['message' => 'レッスンスケジュールが見つかりません'], 404);
    }

    DB::beginTransaction();
    try {
      // レッスンスケジュール詳細を更新
      $lessonScheduleDetail->update([
        'staff_id' => $lessonInfo['coachId'],
        'is_main_substituted' => $lessonInfo['isSubstitute'],
        'cancel_reason' => $lessonInfo['cancelReason'],
      ]);

      // 生徒の登録と削除を更新
      LessonStudentRecord::updateStudentRecords($lessonScheduleDetailId, $addedStudents, $canceledStudents);

      DB::commit();
    } catch (\Exception $e) {
      DB::rollBack();
      return response()->json(['message' => '更新中にエラーが発生しました', 'error' => $e->getMessage()], 500);
    }

    return response()->json(['message' => 'レッスン情報が更新されました'], 200);
  }
}
