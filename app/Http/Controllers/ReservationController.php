<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Reservation;

class ReservationController extends Controller
{
    /**
     * 予約一覧ページ
     */
    public function index(Request $request)
    {
        // ミドルウェアでセットされた `deviceType` を取得
        $deviceType = $request->get('deviceType', 'pc'); // デフォルトはPC
        // $reservations = Reservation::orderBy('date', 'asc')->get();
        // return view('reservations.index', compact('reservations'));
        return view($deviceType === 'sp' ? 'reservation_sp' : 'reservation_pc');
    }

    /**
     * 予約フォームページ
     */
    public function create()
    {
        return view('reservations.create');
    }

    /**
     * 予約を保存
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required',
            'menu' => 'required|string|max:255',
        ]);

        // Reservation::create([
        //     'name' => $request->name,
        //     'date' => $request->date,
        //     'time' => $request->time,
        //     'menu' => $request->menu,
        // ]);

        return redirect()->route('reservations.index')->with('success', '予約を作成しました！');
    }
}
