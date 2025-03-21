<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController; // 管理画面コントローラーを追加

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post'); // ログイン処理
// ダッシュボード (ログイン必須)
Route::middleware('auth')->group(function () {
  Route::post('/logout', [LoginController::class, 'logout'])->name('logout'); // ログアウト処理
  Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
  Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
  Route::post('/reservations/store', [ReservationController::class, 'store'])->name('reservations.store');
  Route::get('/mypage', [MypageController::class, 'index'])->name('mypage');
});
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index'); // 管理画面のルートを追加
Route::post('/admin/schedule', [AdminController::class, 'storeSchedule'])->name('admin.schedule.store');
Route::put('/admin/schedule/{id}', [AdminController::class, 'updateSchedule'])->name('admin.schedule.update');
Route::delete('/admin/schedule/{id}', [AdminController::class, 'deleteSchedule'])->name('admin.schedule.delete'); // 追加
Route::post('/admin/schedule/detail', [AdminController::class, 'storeScheduleDetail'])->name('admin.schedule.detail.store'); // 追加
Route::get('/admin/shift', [AdminController::class, 'dateIndex'])->name('admin.date.index'); // 管理画面のルートを追加
Route::get('/admin/shift/{date}', [AdminController::class, 'dateShift'])->name('admin.date.shift');
Route::get('/admin/shift/{date}/{lesson_schedule_detail_id?}', [AdminController::class, 'dateShiftForm'])
  ->where('date', '\d{8}') // ← 8桁の数字を受け取る
  ->where('lesson_schedule_detail_id', '[0-9]+')
  ->name('admin.shift.form');
