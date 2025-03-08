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
        // バリデーション
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // 認証試行
        if (Auth::guard('students')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            return redirect()->route('dashboard'); // ログイン成功時にリダイレクト
        }

        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが正しくありません。',
        ])->withInput($request->only('email', 'remember'));
    }

    // ログアウト処理
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login')->with('status', 'ログアウトしました');
    }
}
