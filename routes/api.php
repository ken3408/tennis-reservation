<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Student;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\LessonController;

Route::get('/user', function (Request $request) {
  return $request->user();
})->middleware('auth:sanctum');

Route::get('/students/search', [StudentController::class, 'search']);
Route::post('/lesson/save', [LessonController::class, 'save']);
Route::put('/lesson/save', [LessonController::class, 'save']);
Route::put('/lesson/update', [LessonController::class, 'update']);
Route::put('/lesson/update/{lessonScheduleDetailId}', [LessonController::class, 'update']);
