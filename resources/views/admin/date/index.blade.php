<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>シフト管理 - カレンダー</title>
  {{-- home.cssを読み込ませる  --}}
  @vite('resources/css/admin/date.css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  {{-- jquery読み込ませる --}}
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  {{-- top.jsを読み込ませる  --}}
  @vite('resources/js/admin/date.js')
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
  <header>
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
      <div class="nav-container">
        <div class="nav-left">
          <a href="{{ route('admin.index') }}" class="back-button">
            <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
            戻る
          </a>
          <h2 class="month-title" id="monthTitle">読み込み中...</h2>
        </div>
        <div class="nav-buttons">
          <button class="nav-button" id="prevMonthBtn">
            <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
            前月
          </button>
          <button class="nav-button" id="nextMonthBtn">
            次月
            <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
          </button>
        </div>
      </div>

      <div class="calendar">
        <!-- 曜日ヘッダー -->
        <div class="weekdays">
          <div class="weekday">月</div>
          <div class="weekday">火</div>
          <div class="weekday">水</div>
          <div class="weekday">木</div>
          <div class="weekday">金</div>
          <div class="weekday saturday">土</div>
          <div class="weekday sunday">日</div>
        </div>

        <!-- カレンダー本体 -->
        <div class="calendar-grid" id="calendarGrid">
          <div class="loading">
            <div class="loading-spinner"></div>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>

</html>
