<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>テニス予約アプリ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    {{-- home.cssを読み込ませる  --}}
    @vite('resources/css/pc/mypage.css')
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
    <main class="container">
        <div class="card header-card">
            <div class="card-header">
                <div class="card-title header-title">
                    <h1>マイページ</h1>
                    <p class="card-description">
                        <i class="fas fa-user"></i> 山田 太郎さん
                    </p>
                </div>
            </div>
        </div>

        <div class="grid-container">
            <!-- Plan Information -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-credit-card"></i> プラン情報
                    </h2>
                </div>
                <div class="card-content">
                    <div class="info-section">
                        <h3>現在のプラン</h3>
                        <p class="info-value">1ヶ月４回プラン</p>
                        <p class="info-detail">1ヶ月４回</p>
                    </div>

                    <div class="info-section">
                        <h3>レギュラークラス</h3>
                        <p class="info-value">日曜日 A 中級</p>
                    </div>

                    <div class="info-section">
                        <h3>レベルクラス</h3>
                        <div class="badge-container">
                            <span class="badge">中級</span>
                            <span class="badge">初級</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tickets Information -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-ticket-alt"></i> チケット情報
                    </h2>
                </div>
                <div class="card-content">
                    <div class="info-section">
                        <h3>残りチケット枚数</h3>
                        <div class="ticket-count">
                            <span class="ticket-number">2</span>
                            <span class="ticket-total">/ 4枚</span>
                        </div>
                    </div>

                    <div class="info-section">
                        <h3>チケット有効期限</h3>
                        <p class="info-value">
                            <i class="fas fa-calendar"></i> 2024年12月31日
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Upcoming Reservations -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">
                    <i class="fas fa-clock"></i> 予約しているクラス
                </h2>
            </div>
            <div class="card-content">
                <div class="table-container">
                    <table class="data-table" id="reservations-table">
                        <thead>
                            <tr>
                                <th>日付</th>
                                <th>時間</th>
                                <th>レベル</th>
                                <th class="text-right">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-id="1">
                                <td>2024年10月8日</td>
                                <td>A</td>
                                <td>中級</td>
                                <td class="text-right">
                                    <button class="cancel-button" data-id="1">
                                        <i class="fas fa-times"></i> 取り消し
                                    </button>
                                </td>
                            </tr>
                            <tr data-id="2">
                                <td>2024年10月15日</td>
                                <td>B</td>
                                <td>初級</td>
                                <td class="text-right">
                                    <button class="cancel-button" data-id="2">
                                        <i class="fas fa-times"></i> 取り消し
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Participation History -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">
                    <i class="fas fa-history"></i> 参加履歴
                </h2>
                <p class="card-description">過去2ヶ月分の参加履歴</p>
            </div>
            <div class="card-content">
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>日付</th>
                                <th>時間</th>
                                <th>レベル</th>
                                <th>種別</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2024年10月1日</td>
                                <td>A</td>
                                <td>中級</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>2024年9月24日</td>
                                <td>B</td>
                                <td>初級</td>
                                <td><span class="substitute-badge">振替え</span></td>
                            </tr>
                            <tr>
                                <td>2024年9月17日</td>
                                <td>A</td>
                                <td>中級</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>2024年9月10日</td>
                                <td>A</td>
                                <td>中級</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>2024年9月3日</td>
                                <td>A</td>
                                <td>中級</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>2024年8月27日</td>
                                <td>B</td>
                                <td>初級</td>
                                <td><span class="substitute-badge">振替え</span></td>
                            </tr>
                            <tr>
                                <td>2024年8月20日</td>
                                <td>A</td>
                                <td>中級</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>2024年8月13日</td>
                                <td>A</td>
                                <td>中級</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Cancellation Dialog -->
        <div id="cancel-dialog" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>予約取り消しの確認</h2>
                    <p>以下のクラスの予約を取り消しますか？この操作は元に戻せません。</p>
                </div>
                <div class="modal-body">
                    <p id="cancel-date" class="modal-reservation-date"></p>
                    <p id="cancel-details" class="modal-reservation-details"></p>
                </div>
                <div class="modal-footer">
                    <button id="cancel-close" class="button button-outline">キャンセル</button>
                    <button id="cancel-confirm" class="button button-primary">取り消す</button>
                </div>
            </div>
        </div>
    </main>

    <script src="script.js"></script>
</body>

</html>
