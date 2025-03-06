<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // ミドルウェアでセットされた `deviceType` を取得
        $deviceType = $request->get('deviceType', 'pc'); // デフォルトはPC
        Log::info('Device Type in Controller: ' . $deviceType);

        return view($deviceType === 'sp' ? 'home_sp' : 'home_pc');
    }
}
