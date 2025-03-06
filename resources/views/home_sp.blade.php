<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Court Ready - テニスレッスン予約</title>
  {{-- home.cssを読み込ませる  --}}
  @vite('resources/css/sp/home.css')
  {{-- home.jsを読み込ませる  --}}
</head>
<body>
  <div class="app-container">
    <!-- App Header -->
    <header class="app-header">
      <button class="icon-button">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="menu-icon">
          <line x1="4" x2="20" y1="12" y2="12"></line>
          <line x1="4" x2="20" y1="6" y2="6"></line>
          <line x1="4" x2="20" y1="18" y2="18"></line>
        </svg>
      </button>
      <h1 class="header-title">Top</h1>
      <button class="icon-button">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="user-icon">
          <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
          <circle cx="12" cy="7" r="4"></circle>
        </svg>
      </button>
    </header>

    <!-- Hero Section - Single Image -->
    <div class="hero-section">
      <img src="https://via.placeholder.com/430x288" alt="Tennis Court Hero Image" class="hero-image">
      <div class="hero-overlay">
        <h1 class="hero-title">TOP</h1>
      </div>
    </div>

    <!-- Today's Lesson -->
    <div class="content-section">
      <div class="section-title-container">
        <div class="title-line"></div>
        <div class="title-wrapper">
          <h2 class="section-title">本日の<span class="title-accent">レッスン</span></h2>
        </div>
        <div class="title-line"></div>
      </div>

      <div class="date-time-container">
        <div class="date-container">
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="calendar-icon">
            <rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect>
            <line x1="16" x2="16" y1="2" y2="6"></line>
            <line x1="8" x2="8" y1="2" y2="6"></line>
            <line x1="3" x2="21" y1="10" y2="10"></line>
          </svg>
          <span class="date-text">2024/11/01</span>
        </div>
        <div class="divider"></div>
        <div class="time-container">
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="clock-icon">
            <circle cx="12" cy="12" r="10"></circle>
            <polyline points="12 6 12 12 16 14"></polyline>
          </svg>
          <span class="time-text">Aクラス 09:10〜10:40</span>
        </div>
      </div>

      <!-- Class Navigation -->
      <div class="class-navigation">
        <button class="nav-button nav-button-active">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="chevron-left">
            <path d="m15 18-6-6 6-6"></path>
          </svg>
          <span>前のクラス</span>
        </button>
        <button class="nav-button">
          <span>次のクラス</span>
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="chevron-right">
            <path d="m9 18 6-6-6-6"></path>
          </svg>
        </button>
      </div>

      <!-- Class List -->
      <div class="class-list">
        <!-- Junior Class -->
        <div class="class-card">
          <div class="class-number-container">
            <span class="class-number">1</span>
          </div>
          <div class="class-info">
            <h3 class="class-level">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="award-icon">
                <circle cx="12" cy="8" r="6"></circle>
                <path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"></path>
              </svg>
              ジュニア
            </h3>
            <p class="coach-name">
              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="user-circle-icon">
                <circle cx="12" cy="12" r="10"></circle>
                <circle cx="12" cy="10" r="3"></circle>
                <path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662"></path>
              </svg>
              山田コーチ
            </p>
            <div class="status-badge status-badge-available">
              残り3名
            </div>
          </div>
          <div class="class-action">
            <p class="capacity-text">定員10名</p>
            <button class="reserve-button">予約する</button>
          </div>
        </div>

        <!-- Beginner Class -->
        <div class="class-card">
          <div class="class-number-container">
            <span class="class-number">2</span>
          </div>
          <div class="class-info">
            <h3 class="class-level">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="award-icon">
                <circle cx="12" cy="8" r="6"></circle>
                <path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"></path>
              </svg>
              初級
            </h3>
            <p class="coach-name">
              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="user-circle-icon">
                <circle cx="12" cy="12" r="10"></circle>
                <circle cx="12" cy="10" r="3"></circle>
                <path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662"></path>
              </svg>
              佐藤コーチ
            </p>
            <div class="status-badge status-badge-full">
              満員
            </div>
          </div>
          <div class="class-action">
            <p class="capacity-text">定員8名</p>
            <button class="cancel-button">予約を取り消す</button>
          </div>
        </div>

        <!-- Beginner-Intermediate Class - Canceled -->
        <div class="class-card class-card-canceled">
          <div class="class-number-container class-number-container-canceled">
            <span class="class-number class-number-canceled">3</span>
          </div>
          <div class="class-info">
            <div class="class-level-container">
              <h3 class="class-level class-level-canceled">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="award-icon-canceled">
                  <circle cx="12" cy="8" r="6"></circle>
                  <path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"></path>
                </svg>
                初中級
              </h3>
              <div class="status-badge status-badge-canceled">
                雨天のため休講
              </div>
            </div>
            <p class="coach-name">
              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="user-circle-icon">
                <circle cx="12" cy="12" r="10"></circle>
                <circle cx="12" cy="10" r="3"></circle>
                <path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662"></path>
              </svg>
              鈴木コーチ
            </p>
            <div class="status-badge status-badge-unavailable">
              予約不可
            </div>
          </div>
          <div class="class-action">
            <p class="capacity-text capacity-text-canceled">定員8名</p>
            <!-- ボタンを非表示に -->
          </div>
        </div>

        <!-- Advanced Class -->
        <div class="class-card">
          <div class="class-number-container">
            <span class="class-number">4</span>
          </div>
          <div class="class-info">
            <h3 class="class-level">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="award-icon">
                <circle cx="12" cy="8" r="6"></circle>
                <path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"></path>
              </svg>
              上級
            </h3>
            <p class="coach-name">
              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="user-circle-icon">
                <circle cx="12" cy="12" r="10"></circle>
                <circle cx="12" cy="10" r="3"></circle>
                <path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662"></path>
              </svg>
              田中コーチ
            </p>
            <div class="status-badge status-badge-limited">
              残り1名
            </div>
          </div>
          <div class="class-action">
            <p class="capacity-text">定員6名</p>
            <button class="reserve-button">予約する</button>
          </div>
        </div>
      </div>
    </div>
      <!-- モーダルコンポーネントの呼び出し -->
      <x-modal title="予約確認">
        <p>このレッスンを予約しますか？</p>
      </x-modal>
    <!-- Bottom Navigation -->
    <nav class="bottom-nav">
      <button class="nav-item nav-item-active">
        <div class="nav-icon-container nav-icon-container-active">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="nav-icon nav-icon-active">
            <rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect>
            <line x1="16" x2="16" y1="2" y2="6"></line>
            <line x1="8" x2="8" y1="2" y2="6"></line>
            <line x1="3" x2="21" y1="10" y2="10"></line>
          </svg>
        </div>
        <span class="nav-text">別日レッスン予約</span>
      </button>
      <button class="nav-item">
        <div class="nav-icon-container">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="nav-icon">
            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
          </svg>
        </div>
        <span class="nav-text nav-text-inactive">電話</span>
      </button>
      <button class="nav-item">
        <div class="nav-icon-container">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="nav-icon">
            <line x1="8" x2="21" y1="6" y2="6"></line>
            <line x1="8" x2="21" y1="12" y2="12"></line>
            <line x1="8" x2="21" y1="18" y2="18"></line>
            <line x1="3" x2="3.01" y1="6" y2="6"></line>
            <line x1="3" x2="3.01" y1="12" y2="12"></line>
            <line x1="3" x2="3.01" y1="18" y2="18"></line>
          </svg>
        </div>
        <span class="nav-text nav-text-inactive">レッスン一覧</span>
      </button>
    </nav>

    <!-- Bottom Home Indicator -->
    <div class="home-indicator"></div>
  </div>
</body>
</html>

