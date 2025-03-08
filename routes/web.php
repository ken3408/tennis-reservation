<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\Auth\LoginController;


Route::get('/', [HomeController::class, 'index']);
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
