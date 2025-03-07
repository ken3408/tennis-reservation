<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>テニス予約アプリ</title>
  {{-- home.cssを読み込ませる  --}}
  @vite('resources/css/pc/home.css')
  {{-- jquery読み込ませる --}}
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  {{-- home.jsを読み込ませる  --}}
@vite('resources/js/home.js')
{{-- アイコンを読み込む  --}}
{{-- フォントを読み込む  --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="min-h-screen bg-base">
  <!-- Navigation -->
  <header class="header">
    <div class="container header-container">
      <div class="logo">
        <a href="/" class="logo-link">
          <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="16" cy="16" r="16" fill="#6CCBB0" />
            <path d="M10 16C10 12.6863 12.6863 10 16 10C19.3137 10 22 12.6863 22 16" stroke="white" stroke-width="2" />
            <path d="M16 16L16 22" stroke="white" stroke-width="2" />
          </svg>
          <span>TennisPro</span>
        </a>
      </div>

      <nav class="nav">
        <ul class="nav-list">
          <li><a href="/mypage" class="nav-link">mypage</a></li>
          <li><a href="/solutions" class="nav-link">Solutions</a></li>
          <li><a href="/community" class="nav-link">Community</a></li>
          <li><a href="/resources" class="nav-link">Resources</a></li>
          <li><a href="/pricing" class="nav-link">Pricing</a></li>
          <li><a href="/contact" class="nav-link">Contact</a></li>
        </ul>
      </nav>

      <div class="auth-buttons">
        <button class="btn btn-outline">Sign in</button>
        <button class="btn btn-primary">Register</button>
      </div>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="hero">
    <div class="container">
      <h1 class="hero-title">Title</h1>
      <p class="hero-subtitle">Subtitle</p>
    </div>
  </section>

  <!-- Lesson Information -->
  <section class="container lesson-section">
    <!-- Improved Today's Lesson Header -->
    <div class="lesson-header-no-border">
      <div class="lesson-header-content">
        <div>
          <div class="lesson-title-container">
            <svg class="icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <h2 class="lesson-title">本日のレッスン</h2>
            <span class="date-badge">2024/11/01</span>
          </div>
          <div class="lesson-time-container">
            <svg class="icon-sm" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div class="lesson-time">
              <span class="time-text">Aクラス</span>
              <span class="time-separator">|</span>
              <span class="time-text">09:10～10:40</span>
              <span class="time-duration">90分</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Court Cards -->
    <div class="cards-grid">
      <!-- Card 1: Available - Using only main and base colors -->
      <div class="card">
        <div class="card-header card-header-advanced">
          <h3 class="card-header-title">1番コート</h3>
          <span class="level-badge level-badge-advanced">上級</span>
        </div>
        <div class="card-body">
          <div class="info-row">
            <svg class="icon-sm" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            <span class="info-text">担当コーチ: <strong>田中 健太</strong></span>
          </div>
          <div class="info-row">
            <svg class="icon-sm" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            <span class="info-text">定員: <strong>5名 / 8名</strong></span>
          </div>
          <p class="card-description">
            テクニックとフットワークの向上に重点を置いたレッスンです。ラリー練習とゲーム形式の練習を行います。
          </p>
        </div>
        <div class="card-footer card-footer-base">
          <button class="btn btn-primary btn-full js-reservation-button">
            予約する
            <svg class="icon-xs" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path d="M5 12h14"></path>
              <path d="m12 5 7 7-7 7"></path>
            </svg>
          </button>
        </div>
      </div>

      <!-- Card 2: Reserved -->
      <div class="card">
        <div class="card-header card-header-intermediate">
          <h3 class="card-header-title">2番コート</h3>
          <span class="level-badge level-badge-intermediate">初中級</span>
        </div>
        <div class="card-body">
          <div class="info-row">
            <svg class="icon-sm" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            <span class="info-text">担当コーチ: <strong>佐藤 美咲</strong></span>
          </div>
          <div class="info-row">
            <svg class="icon-sm" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            <span class="info-text">定員: <strong>8名 / 8名</strong></span>
            <span class="full-badge">満員</span>
          </div>
          <p class="card-description">
            基本的なストロークとラリー練習を中心としたレッスンです。フォアハンドとバックハンドの基礎を学びます。
          </p>
        </div>
        <div class="card-footer">
          <button class="btn btn-outline btn-full">
            予約取り消し
            <svg class="icon-xs" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path d="M18 6L6 18"></path>
              <path d="M6 6l12 12"></path>
            </svg>
          </button>
        </div>
      </div>

      <!-- Card 3: Canceled (Gray) -->
      <div class="card card-canceled">
        <div class="card-header card-header-junior">
          <h3 class="card-header-title card-header-title-canceled">3番コート</h3>
          <span class="level-badge level-badge-junior">ジュニア</span>
        </div>
        <div class="canceled-overlay">
          <div class="canceled-label">中止</div>
        </div>
        <div class="card-body">
          <div class="info-row">
            <svg class="icon-sm icon-gray" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            <span class="info-text-gray">担当コーチ: <strong>鈴木 大輔</strong></span>
          </div>
          <div class="info-row">
            <svg class="icon-sm icon-gray" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            <span class="info-text-gray">定員: <strong>0名 / 10名</strong></span>
          </div>
          <p class="card-description-gray">
            テニスを始めたばかりの子供向けのレッスンです。楽しみながらテニスの基本を学びます。
          </p>
        </div>
        <div class="card-footer card-footer-gray">
          <button class="btn btn-disabled" disabled>予約不可</button>
        </div>
      </div>

      <!-- Card 4: Level Not Reached (No Button) -->
      <div class="card">
        <div class="card-header card-header-advanced">
          <h3 class="card-header-title">4番コート</h3>
          <span class="level-badge level-badge-advanced">上級</span>
        </div>
        <div class="card-body">
          <div class="info-row">
            <svg class="icon-sm" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            <span class="info-text">担当コーチ: <strong>山田 太郎</strong></span>
          </div>
          <div class="info-row">
            <svg class="icon-sm" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            <span class="info-text">定員: <strong>3名 / 6名</strong></span>
          </div>
          <div class="warning-box">
            <svg class="icon-sm icon-warning" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
            <span class="warning-text">
              このクラスは上級者向けです。あなたの現在のレベルでは参加できません。
            </span>
          </div>
          <p class="card-description">
            高度なテクニックとゲーム戦略に焦点を当てた上級者向けのレッスンです。試合形式の練習が中心となります。
          </p>
        </div>
        <div class="card-footer">
          <p class="level-not-reached-text">レベルに達していないため予約できません</p>
        </div>
      </div>
    </div>
    <!-- モーダルコンポーネントの呼び出し -->
    <x-confirm-modal title="このレッスンを予約しますか？">
        <img src="{{ Vite::asset('resources/images/undraw_confirm_rds7.png') }}" alt="予約内容">
    </x-confirm-modal>
    <!-- Pagination -->
    <div class="pagination">
      <nav class="pagination-nav">
        <button class="pagination-btn">
          <span class="sr-only">前のページ</span>
          <svg class="icon-xs" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M15 19l-7-7 7-7"></path>
          </svg>
        </button>
        <button class="pagination-btn pagination-btn-active">1</button>
        <button class="pagination-btn">2</button>
        <button class="pagination-btn">3</button>
        <span class="pagination-ellipsis">...</span>
        <button class="pagination-btn">8</button>
        <button class="pagination-btn">
          <span class="sr-only">次のページ</span>
          <svg class="icon-xs" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M9 5l7 7-7 7"></path>
          </svg>
        </button>
      </nav>
    </div>
  </section>
</div>
</body>
</html>

