<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理画面</title>
    {{-- home.cssを読み込ませる  --}}
    @vite('resources/css/admin/top.css')
    {{-- jquery読み込ませる --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- home.jsを読み込ませる  --}}
    @vite('resources/js/admin/top.js')
</head>

<body>
    <header class="header">
        <div class="container">
            <div class="header-left">
                <i class="fas fa-calendar"></i>
                <h1>コーチ時間割管理システム</h1>
            </div>
            <div class="header-right">
                <span>管理者: 管理太郎</span>
            </div>
        </div>
    </header>

    <main class="container">
        <div class="tab-navigation">
            <button class="tab-button active">時間割表</button>
            <button class="tab-button">講師一覧</button>
        </div>

        <div class="content-area">
            <div class="tab-content active" id="timetable">
                <div class="timetable-header">
                    <h2>時間割表</h2>
                    <div class="day-type-switch">
                        <button class="day-type-button active">平日</button>
                        <button class="day-type-button">土日</button>
                    </div>
                </div>

                <div class="timetable-container">
                    <table id="timetable" class="timetable">
                        <!-- テーブルはJavaScriptで動的に生成 -->
                    </table>
                </div>
            </div>

            <div class="tab-content" id="teachers">
                <div class="teachers-header">
                    <h2>講師一覧</h2>
                    <button id="add-teacher-button" class="button">新規講師</button>
                </div>

                <table class="teacher-table">
                    <thead>
                        <tr>
                            <th>名前</th>
                            <th>担当科目</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody id="teacher-list">
                        <!-- 講師リストはJavaScriptで動的に生成 -->
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- モーダルダイアログ -->
    <div id="schedule-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modal-title">時間割設定</h3>
                <button class="close-button">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="level-input">担当クラス（レベル）</label>
                    <input type="text" id="level-input" placeholder="初級、中級など">
                </div>
                <div class="form-group">
                    <label for="teacher-select">担当コーチ</label>
                    <select id="teacher-select">
                        <option value="none">未設定</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="button secondary" id="cancel-button">キャンセル</button>
                <button class="button primary" id="save-button">保存</button>
            </div>
        </div>
    </div>

    <div id="teacher-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="teacher-modal-title">講師追加</h3>
                <button class="close-button">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="teacher-name-input">名前</label>
                    <input type="text" id="teacher-name-input" placeholder="名前を入力">
                </div>
                <div class="form-group">
                    <label for="teacher-position-input">担当科目</label>
                    <select id="teacher-position-input">
                        <option value="国語">国語</option>
                        <option value="数学">数学</option>
                        <option value="英語">英語</option>
                        <option value="理科">理科</option>
                        <option value="社会">社会</option>
                        <option value="その他">その他</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="button secondary" id="teacher-cancel-button">キャンセル</button>
                <button class="button primary" id="teacher-save-button">保存</button>
            </div>
        </div>
    </div>
</body>

</html>
