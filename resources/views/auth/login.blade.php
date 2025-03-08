<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>テニス予約アプリ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    {{-- home.cssを読み込ませる  --}}
    @vite('resources/css/login.css')
    {{-- jquery読み込ませる --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- home.jsを読み込ませる  --}}
    @vite('resources/js/home.js')
    {{-- アイコンを読み込む  --}}
    {{-- フォントを読み込む  --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body>
    <main class="main">
        <div class="login-container">
            <h1 class="login-title">ログイン</h1>
            <!-- エラーメッセージエリア -->
            <div id="msg-area" class="error-message-area">
                <p class="bg-danger">ログインできません。<br>メールアドレスまたはパスワードが間違っています。</p>
            </div>

            <div class="login-content">
                <!-- エラーメッセージ表示 -->
                @if ($errors->any())
                    <div class="error-messages">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- Googleログインボタン -->
                <button class="google-button" onclick="handleGoogleLogin()">
                    <div class="google-button-content">
                        <svg viewBox="0 0 24 24" width="24" height="24" class="google-icon">
                            <path
                                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                                fill="#4285F4" />
                            <path
                                d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                                fill="#34A853" />
                            <path
                                d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                                fill="#FBBC05" />
                            <path
                                d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                                fill="#EA4335" />
                            <path d="M1 1h22v22H1z" fill="none" />
                        </svg>
                        <span class="google-text">Googleでログイン</span>
                    </div>
                </button>

                <!-- 区切り線 -->
                <div class="divider">
                    <span class="divider-text">または</span>
                </div>

                <div class="email-login-text">メールアドレスでログインする</div>

                <!-- メールログインフォーム -->
                <form id="loginForm" class="login-form" action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="form-label">メールアドレス</label>
                        <input id="email" type="email" placeholder="example@mail.com" class="form-input"
                            required />
                    </div>

                    <div class="form-group">
                        <div class="password-header">
                            <label for="password" class="form-label">パスワード</label>
                            <a href="#" class="forgot-password">パスワードを忘れた場合</a>
                        </div>
                        <input id="password" type="password" placeholder="••••••••" class="form-input" required />
                    </div>

                    <div class="remember-me">
                        <input type="checkbox" id="remember-me-checkbox" class="checkbox" />
                        <label for="remember-me-checkbox" class="checkbox-label">自動でログイン</label>
                    </div>

                    <button type="submit" class="login-button">ログイン</button>

                    <div class="signup-link">
                        アカウントをお持ちでない方は
                        <a href="#" class="signup-text">新規登録</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- スクロールトップボタン -->
        <button id="scrollTopBtn" class="scroll-top-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="chevron-up">
                <path d="m18 15-6-6-6 6" />
            </svg>
        </button>
    </main>

    <script>
        // エラーメッセージ表示関数
        function showErrorMessage() {
            const msgArea = document.getElementById('msg-area');

            // フェードイン
            msgArea.style.display = 'block';
            msgArea.style.opacity = '0';

            let opacity = 0;
            const fadeIn = setInterval(() => {
                if (opacity >= 1) {
                    clearInterval(fadeIn);

                } else {
                    opacity += 0.1;
                    msgArea.style.opacity = opacity.toString();
                }
            }, 50);
        }

        // ログインフォームの送信処理
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const rememberMe = document.getElementById('remember-me-checkbox').checked;

            console.log({
                email,
                password,
                rememberMe
            });

            // ここでログイン処理を行い、失敗した場合にエラーメッセージを表示
            // 例として、常に失敗するようにしています（デモ用）
            // 実際のアプリケーションでは、サーバーからのレスポンスに基づいて判断します
            // showErrorMessage();

            // 実際のログイン処理の例:
            fetch('/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        email,
                        password,
                        rememberMe
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // ログイン成功時の処理
                        window.location.href = '/dashboard';
                    } else {
                        // ログイン失敗時の処理
                        showErrorMessage();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showErrorMessage();
                });
        });

        // Googleログイン処理
        function handleGoogleLogin() {
            console.log('Google login clicked');
            // ここにGoogleログイン処理を実装
        }

        // スクロールトップボタン
        const scrollTopBtn = document.getElementById('scrollTopBtn');
        scrollTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // スクロール時にボタンを表示/非表示
        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                scrollTopBtn.style.display = 'block';
            } else {
                scrollTopBtn.style.display = 'none';
            }
        });
    </script>
</body>

</html>
