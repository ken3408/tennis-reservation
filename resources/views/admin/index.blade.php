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
    <header>
        <div class="container">
            <h1><i class="calendar-icon"></i> コーチ時間割管理システム</h1>
            <div class="user-info">管理者: 管理太郎</div>
        </div>
    </header>

    <main class="container">
        <div class="tab-content" id="timetable">
            <h2>時間割表　<span>2025</span>年<span>3</span>月</h2>

            <div class="day-toggle">
                <button class="day-btn active" data-day="weekday">平日</button>
                <button class="day-btn" data-day="weekend">土日</button>
            </div>

            <div class="timetable-container weekday active">
                <!-- 平日の時間割表 -->
                <table class="timetable">
                    <thead>
                        <tr>
                            <th>時間</th>
                            <th>コート</th>
                            <th>月</th>
                            <th>火</th>
                            <th>水</th>
                            <th>木</th>
                            <th>金</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- A コート -->
                        <tr>
                            <td rowspan="4" class="time-cell">
                                A
                                <div class="text-xs text-muted-foreground">10:30〜12:00</div>
                            </td>
                            <td>1</td>
                            <td>
                                <div class="class">初級</div>
                                <div class="coach">山田 太郎</div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach">佐藤 花子</div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                        </tr>

                        <!-- B コート -->
                        <tr>
                            <td rowspan="4" class="time-cell">B</td>
                            <td>1</td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach">鈴木 一郎</div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach">高橋 美咲</div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                        </tr>

                        <!-- C コート -->
                        <tr>
                            <td rowspan="4" class="time-cell">C</td>
                            <td>1</td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach">山田 太郎</div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach">佐藤 花子</div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                        </tr>

                        <!-- D コート -->
                        <tr>
                            <td rowspan="4" class="time-cell">D</td>
                            <td>1</td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                                <div class="coach"></div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="timetable-container weekend">
                <table class="timetable">
                    <thead>
                        <tr>
                            <th>時間</th>
                            <th>コート</th>
                            <th colspan="2">土</th>
                            <th colspan="2">日</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>担当クラス</th>
                            <th>担当コーチ</th>
                            <th>担当クラス</th>
                            <th>担当コーチ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- A コート -->
                        <tr>
                            <td rowspan="4" class="time-cell">A</td>
                            <td>1</td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                        </tr>

                        <!-- B コート -->
                        <tr>
                            <td rowspan="4" class="time-cell">B</td>
                            <td>1</td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                        </tr>

                        <!-- C コート -->
                        <tr>
                            <td rowspan="4" class="time-cell">C</td>
                            <td>1</td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                        </tr>

                        <!-- D コート -->
                        <tr>
                            <td rowspan="4" class="time-cell">D</td>
                            <td>1</td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                        </tr>

                        <!-- E コート -->
                        <tr>
                            <td rowspan="4" class="time-cell">E</td>
                            <td>1</td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                        </tr>

                        <!-- F コート -->
                        <tr>
                            <td rowspan="4" class="time-cell">F</td>
                            <td>1</td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                            <td>
                                <div class="class">担当クラス</div>
                            </td>
                            <td>
                                <div class="coach"></div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>

</html>
