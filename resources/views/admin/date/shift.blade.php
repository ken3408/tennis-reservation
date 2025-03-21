<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>シフト管理 - 2025年3月3日のシフト</title>
  <style>
    /* リセットCSS */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Hiragino Sans', 'Hiragino Kaku Gothic ProN', Meiryo, sans-serif;
      background-color: #f0f2f5;
      color: #333;
      line-height: 1.5;
    }

    /* ヘッダー */
    .header {
      background-color: #000;
      color: #fff;
      padding: 0.75rem 1.5rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .header-title {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .header-title h1 {
      font-size: 1rem;
      font-weight: normal;
    }

    .admin-info {
      font-size: 0.875rem;
    }

    /* メインコンテンツ */
    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 1.5rem;
    }

    .card {
      background-color: #fff;
      border-radius: 0.25rem;
      box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
      padding: 1.5rem;
    }

    /* ナビゲーション */
    .page-header {
      display: flex;
      align-items: center;
      margin-bottom: 1.5rem;
    }

    .back-button {
      display: inline-flex;
      align-items: center;
      gap: 0.25rem;
      padding: 0.5rem 0.75rem;
      border: 1px solid #ddd;
      border-radius: 0.25rem;
      background-color: #fff;
      font-size: 0.875rem;
      margin-right: 1rem;
      text-decoration: none;
      color: #333;
      cursor: pointer;
    }

    .back-button:hover {
      background-color: #f9f9f9;
    }

    .page-title {
      font-size: 1.25rem;
      font-weight: normal;
    }

    /* 時間帯タブ */
    .time-slots-container {
      margin-bottom: 1.5rem;
      display: flex;
      width: 100%;
    }

    .time-slots {
      display: flex;
      width: 100%;
      background-color: #f0f2f5;
      border-radius: 0.25rem;
      overflow: hidden;
      height: 45px;
      /* 固定の高さを設定 */
    }

    .time-slot {
      flex: 1;
      position: relative;
      cursor: pointer;
    }

    .time-slot-content {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.875rem;
    }

    .time-slot.active .time-slot-content {
      background-color: #fff;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
      z-index: 1;
      margin: 4px 0;
      border-radius: 0.25rem;
    }

    /* 最初の時間帯が選択された時 */
    .time-slot:first-child.active .time-slot-content {
      margin-left: 4px;
    }

    /* 最後の時間帯が選択された時 */
    .time-slot:last-child.active .time-slot-content {
      margin-right: 4px;
    }

    /* テーブル */
    .table-container {
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      border: 1px solid #eee;
      padding: 0.75rem;
      text-align: center;
    }

    th {
      background-color: #f9f9f9;
      font-weight: normal;
    }

    /* 編集ボタン */
    .edit-button {
      display: inline-block;
      padding: 0.25rem 0.75rem;
      border: 1px solid #ddd;
      border-radius: 0.25rem;
      background-color: #f9f9f9;
      font-size: 0.75rem;
      text-decoration: none;
      color: #333;
    }

    .edit-button:hover {
      background-color: #f0f0f0;
    }

    /* アイコン */
    .icon {
      width: 1rem;
      height: 1rem;
      display: inline-block;
      vertical-align: text-top;
    }

    /* シフト情報 */
    .shift-info {
      display: none;
    }

    .shift-info.active {
      display: block;
    }
  </style>
</head>

<body>
  <header class="header">
    <div class="header-title">
      <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
        <line x1="16" y1="2" x2="16" y2="6"></line>
        <line x1="8" y1="2" x2="8" y2="6"></line>
        <line x1="3" y1="10" x2="21" y2="10"></line>
      </svg>
      <h1>シフト管理</h1>
    </div>
    <div class="admin-info">管理者: 管理太郎</div>
  </header>

  <main class="container">
    <div class="card">
      <div class="page-header">
        <a href="/dates" class="back-button">
          <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6"></polyline>
          </svg>
          日付一覧へ戻る
        </a>
        <h2 class="page-title">{{ $year }}年{{ $month }}月{{ $day }}日（{{ $weekday }}）のシフト
        </h2>
      </div>

      <div class="time-slots-container">
        <div class="time-slots">
          @foreach ($lessonTimeSlots as $lessonTimeSlot)
            <div class="time-slot" data-time-slot="{{ $lessonTimeSlot->class_name }}">
              <div class="time-slot-content">{{ $lessonTimeSlot->class_name }}:
                {{ $lessonTimeSlot->start_time }}〜{{ $lessonTimeSlot->end_time }}</div>
            </div>
          @endforeach
        </div>
      </div>

      @foreach ($lessons as $lessonTime => $lessonDetails)
        <div id="shift-info-{{ $lessonTime }}" class="shift-info active">
          <div class="table-container">
            <table>
              <thead>
                <tr>
                  <th style="width: 10%;">コート</th>
                  <th style="width: 40%;">レベル</th>
                  <th style="width: 40%;">コーチ</th>
                  <th style="width: 10%;">操作</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($lessonDetails as $court_num => $lesson)
                  <tr>
                    <td>{{ $court_num }}</td>
                    @if (!empty($lesson))
                      <td>{{ $lesson['lesson_master']['name'] }}</td>
                      <td>{{ $lesson['main_coach']['last_name'] }}
                        {{ $lesson['main_coach']['first_name'] }}</td>
                      <td>
                        <a href="{{ route('admin.shift.form', ['date' => sprintf('%04d%02d%02d', $year, $month, $day), 'lesson_schedule_detail_id' => $lesson['lesson_schedule_detail_id']]) }}"
                          class="edit-button">編集</a>
                      </td>
                    @else
                      <td></td>
                      <td></td>
                      <td>
                        <a href="{{ route('admin.shift.form', ['date' => sprintf('%04d%02d%02d', $year, $month, $day)]) }}"
                          class="edit-button">登録</a>
                      </td>
                    @endif
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      @endforeach
    </div>
  </main>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const timeSlots = document.querySelectorAll('.time-slot');
      const shiftInfos = document.querySelectorAll('.shift-info');

      function setActiveTimeSlot(timeSlot) {
        // アクティブなタブのクラスを削除
        document.querySelector('.time-slot.active')?.classList.remove('active');

        // クリックされたタブをアクティブにする
        timeSlot.classList.add('active');

        // シフト情報の表示を切り替える
        const timeSlotId = timeSlot.getAttribute('data-time-slot');
        shiftInfos.forEach(info => {
          if (info.id === `shift-info-${timeSlotId}`) {
            info.classList.add('active');
          } else {
            info.classList.remove('active');
          }
        });
      }

      // 初期状態でAを選択
      setActiveTimeSlot(timeSlots[0]);

      timeSlots.forEach(slot => {
        slot.addEventListener('click', function() {
          setActiveTimeSlot(this);
        });
      });
    });
  </script>
</body>

</html>
