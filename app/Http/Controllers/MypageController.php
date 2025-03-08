<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MypageController extends Controller
{
    public function index(Request $request)
    {
        // ミドルウェアでセットされた `deviceType` を取得
        $deviceType = $request->get('deviceType', 'pc'); // デフォルトはPC


        return view($deviceType === 'sp' ? 'mypage_sp' : 'mypage_pc');
    }
}
