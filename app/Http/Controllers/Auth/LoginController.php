<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // ログインフォームを表示
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // ログイン処理
    public function login(Request $request)
    {
        // 認証試行
        if (Auth::guard('students')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            return response()->json(['success' => true, 'redirect' => route('home')]); // ログイン成功時にリダイレクト
        }
        return response()->json([
            'success' => false,
            'errors' => ['email' => 'メールアドレスまたはパスワードが正しくありません。']
        ]);
    }

    // ログアウト処理
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login')->with('status', 'ログアウトしました');
    }
}
