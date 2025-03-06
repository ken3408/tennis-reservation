<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class DeviceDetectionMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $userAgent = $request->header('User-Agent');
        $deviceType = preg_match('/(iPhone|iPad|iPod|Android.*Mobile|Windows Phone)/i', $userAgent) ? 'sp' : 'pc';
        // デバッグ用のログ
        Log::info('User-Agent: ' . $userAgent);
        Log::info('Device Type: ' . $deviceType);

        // リクエスト属性にデバイスタイプをセット
        $request->attributes->set('deviceType', $deviceType);

        return $next($request);
    }
}
