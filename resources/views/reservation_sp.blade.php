<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>予約システム</title>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js"></script>
</head>

<body>
    <div class="container">
        <h1 class="title">予約システム</h1>

        <div class="view-selector">
            <div class="view-tabs">
                <button id="month-view-btn" class="view-tab active">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    月
                </button>
                <button id="week-view-btn" class="view-tab">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <line x1="8" y1="6" x2="21" y2="6"></line>
                        <line x1="8" y1="12" x2="21" y2="12"></line>
                        <line x1="8" y1="18" x2="21" y2="18"></line>
                        <line x1="3" y1="6" x2="3.01" y2="6"></line>
                        <line x1="3" y1="12" x2="3.01" y2="12"></line>
                        <line x1="3" y1="18" x2="3.01" y2="18"></line>
                    </svg>
                    週
                </button>
                <button id="day-view-btn" class="view-tab">
                    日
                </button>
            </div>
        </div>

        <div class="calendar-container">
            <div class="calendar-header">
                <button id="prev-btn" class="nav-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M15 18l-6-6 6-6"></path>
                    </svg>
                </button>

                <h2 id="current-date" class="current-date">
                    2025年3月
                    <button class="calendar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </button>
                </h2>

                <button id="next-btn" class="nav-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M9 18l6-6-6-6"></path>
                    </svg>
                </button>
            </div>

            <div id="calendar-view" class="calendar-view">
                <!-- カレンダーコンテンツがJSで挿入されます -->
            </div>
        </div>
    </div>
    <!-- 既存のコードの <div class="container"> の後に以下を追加 -->

    <!-- カレンダーモーダル -->
    <div id="calendar-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <button id="modal-prev-month" class="nav-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M15 18l-6-6 6-6"></path>
                    </svg>
                </button>

                <h3 id="modal-current-date">2025年3月</h3>

                <button id="modal-next-month" class="nav-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M9 18l6-6-6-6"></path>
                    </svg>
                </button>

                <button id="modal-close" class="modal-close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>

            <div class="modal-calendar">
                <div class="modal-weekdays">
                    <div class="modal-weekday">日</div>
                    <div class="modal-weekday">月</div>
                    <div class="modal-weekday">火</div>
                    <div class="modal-weekday">水</div>
                    <div class="modal-weekday">木</div>
                    <div class="modal-weekday">金</div>
                    <div class="modal-weekday">土</div>
                </div>
                <div id="modal-calendar-grid" class="modal-calendar-grid">
                    <!-- 日付がJavaScriptで挿入されます -->
                </div>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>
