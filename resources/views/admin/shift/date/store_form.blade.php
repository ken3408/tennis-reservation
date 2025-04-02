<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>テニスレッスン情報登録・編集</title>
  <style>
    /* 基本スタイル */
    :root {
      --background: 0 0% 100%;
      --foreground: 222.2 84% 4.9%;
      --card: 0 0% 100%;
      --card-foreground: 222.2 84% 4.9%;
      --popover: 0 0% 100%;
      --popover-foreground: 222.2 84% 4.9%;
      --primary: 221.2 83.2% 53.3%;
      --primary-foreground: 210 40% 98%;
      --secondary: 210 40% 96.1%;
      --secondary-foreground: 222.2 47.4% 11.2%;
      --muted: 210 40% 96.1%;
      --muted-foreground: 215.4 16.3% 46.9%;
      --accent: 210 40% 96.1%;
      --accent-foreground: 222.2 47.4% 11.2%;
      --destructive: 0 84.2% 60.2%;
      --destructive-foreground: 210 40% 98%;
      --border: 214.3 31.8% 91.4%;
      --input: 214.3 31.8% 91.4%;
      --ring: 221.2 83.2% 53.3%;
      --radius: 0.5rem;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }

    body {
      background-color: hsl(var(--background));
      color: hsl(var(--foreground));
      line-height: 1.5;
    }

    .container {
      max-width: 768px;
      margin: 0 auto;
      padding: 1rem;
    }

    .form {
      max-width: 100%;
    }

    .header {
      display: flex;
      align-items: center;
      margin-bottom: 1.5rem;
    }

    .back-button {
      display: flex;
      align-items: center;
      padding: 0.25rem 0.75rem;
      margin-right: 0.75rem;
      border: 1px solid hsl(var(--border));
      border-radius: var(--radius);
      background: transparent;
      font-size: 0.875rem;
      cursor: pointer;
      transition: background-color 0.2s, color 0.2s;
    }

    .back-button:hover {
      background-color: hsl(var(--accent));
    }

    .page-title {
      font-size: 1.5rem;
      font-weight: bold;
    }

    .page-title .time-slot {
      color: hsl(var(--primary));
    }

    @media (max-width: 768px) {
      .page-title span {
        display: block;
      }

      .page-title .separator {
        display: none;
      }
    }

    @media (min-width: 769px) {
      .page-title span {
        display: inline;
      }

      .page-title .separator {
        display: inline;
        margin: 0 0.25rem;
      }
    }

    .form-section {
      margin-bottom: 1.5rem;
    }

    .form-grid {
      display: grid;
      gap: 1rem;
    }

    .form-group {
      margin-bottom: 1rem;
    }

    .form-label {
      display: block;
      font-size: 0.875rem;
      font-weight: 500;
      margin-bottom: 0.5rem;
    }

    .form-control {
      display: flex;
      width: 100%;
      height: 2.5rem;
      padding: 0 0.75rem;
      border: 1px solid hsl(var(--border));
      border-radius: var(--radius);
      background-color: hsl(var(--background));
      font-size: 0.875rem;
    }

    select.form-control {
      appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 0.5rem center;
      background-size: 1rem;
      padding-right: 2rem;
    }

    .form-control:focus {
      outline: none;
      border-color: hsl(var(--ring));
      box-shadow: 0 0 0 2px hsla(var(--ring), 0.2);
    }

    .form-control:disabled {
      opacity: 0.5;
      cursor: not-allowed;
    }

    .form-textarea {
      min-height: 5rem;
      resize: none;
      padding: 0.5rem 0.75rem;
    }

    .form-readonly {
      display: flex;
      align-items: center;
      height: 2.5rem;
      padding: 0 0.75rem;
      border: 1px solid hsl(var(--border));
      border-radius: var(--radius);
      background-color: hsl(var(--background));
      font-size: 0.875rem;
    }

    .checkbox-group {
      display: flex;
      align-items: center;
      margin-top: 0.5rem;
    }

    .checkbox {
      width: 1rem;
      height: 1rem;
      margin-right: 0.5rem;
    }

    .checkbox-label {
      font-size: 0.875rem;
    }

    .button {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 0.5rem 1rem;
      border: 1px solid transparent;
      border-radius: var(--radius);
      font-size: 0.875rem;
      font-weight: 500;
      cursor: pointer;
      transition: background-color 0.2s, color 0.2s;
    }

    .button-primary {
      background-color: hsl(var(--primary));
      color: hsl(var(--primary-foreground));
    }

    .button-primary:hover {
      background-color: hsl(var(--primary) / 0.9);
    }

    .button-outline {
      background-color: transparent;
      border-color: hsl(var(--border));
      color: hsl(var(--foreground));
    }

    .button-outline:hover {
      background-color: hsl(var(--accent));
    }

    .button-ghost {
      background-color: transparent;
      color: hsl(var(--foreground));
    }

    .button-ghost:hover {
      background-color: hsl(var(--accent));
    }

    .button-sm {
      padding: 0.25rem 0.5rem;
      font-size: 0.75rem;
    }

    .button-icon {
      padding: 0.25rem;
      width: 2rem;
      height: 2rem;
    }

    .button:disabled {
      opacity: 0.5;
      cursor: not-allowed;
    }

    .button-full {
      width: 100%;
    }

    .section-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 0.5rem;
    }

    .section-title {
      font-size: 1.125rem;
      font-weight: 600;
    }

    .capacity-badge {
      display: flex;
      align-items: center;
      background-color: hsla(var(--muted) / 0.3);
      padding: 0.25rem 0.5rem;
      border-radius: var(--radius);
      font-size: 0.75rem;
      margin-left: 0.5rem;
    }

    .capacity-current {
      font-weight: 500;
    }

    .capacity-current.full {
      color: hsl(var(--destructive));
    }

    .capacity-current.available {
      color: hsl(var(--primary));
    }

    .capacity-edit {
      margin-left: 0.5rem;
      color: hsl(var(--muted-foreground));
      background: none;
      border: none;
      cursor: pointer;
    }

    .capacity-edit:hover {
      color: hsl(var(--foreground));
    }

    .card {
      background-color: hsl(var(--card));
      border: 1px solid hsl(var(--border));
      border-radius: var(--radius);
      overflow: hidden;
      margin-bottom: 1rem;
    }

    .card-header {
      padding: 1rem;
      border-bottom: 1px solid hsl(var(--border));
    }

    .card-content {
      padding: 1rem;
    }

    .search-form {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .search-input {
      flex: 1;
    }

    .student-list {
      list-style: none;
      border-top: 1px solid hsl(var(--border));
    }

    .student-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0.5rem 1rem;
      border-bottom: 1px solid hsl(var(--border));
    }

    .student-item.clickable {
      cursor: pointer;
    }

    .student-item.clickable:hover {
      background-color: hsl(var(--muted));
    }

    .student-item.disabled {
      opacity: 0.5;
      cursor: not-allowed;
    }

    .student-info {
      flex: 1;
    }

    .student-name {
      font-weight: 500;
    }

    .student-id {
      font-size: 0.75rem;
      color: hsl(var(--muted-foreground));
    }

    .student-level {
      font-size: 0.75rem;
      color: hsl(var(--muted-foreground));
    }

    .table {
      width: 100%;
      border-collapse: collapse;
    }

    .table th,
    .table td {
      padding: 0.75rem;
      text-align: left;
      border-bottom: 1px solid hsl(var(--border));
    }

    .table th {
      font-weight: 500;
      color: hsl(var(--muted-foreground));
      font-size: 0.75rem;
      text-transform: uppercase;
    }

    .empty-state {
      text-align: center;
      padding: 2rem 0;
      border: 1px solid hsl(var(--border));
      border-radius: var(--radius);
      background-color: hsla(var(--muted) / 0.2);
    }

    .empty-message {
      color: hsl(var(--muted-foreground));
      margin-bottom: 0.5rem;
    }

    .level-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 0.25rem;
    }

    .level-edit-button {
      font-size: 0.75rem;
      padding: 0.25rem 0.5rem;
      height: 2rem;
      color: hsl(var(--muted-foreground));
    }

    /* ダイアログ */
    .dialog-backdrop {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0, 0, 0, 0.5);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 50;
    }

    .dialog {
      background-color: hsl(var(--background));
      border-radius: var(--radius);
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
      width: 100%;
      max-width: 28rem;
      padding: 1.5rem;
      position: relative;
    }

    .dialog-header {
      margin-bottom: 1rem;
    }

    .dialog-title {
      font-size: 1.125rem;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .dialog-title-icon {
      color: #f59e0b;
    }

    .dialog-description {
      color: hsl(var(--muted-foreground));
      margin-top: 0.5rem;
    }

    .dialog-footer {
      display: flex;
      justify-content: flex-end;
      gap: 0.5rem;
      margin-top: 1.5rem;
    }

    .sr-only {
      position: absolute;
      width: 1px;
      height: 1px;
      padding: 0;
      margin: -1px;
      overflow: hidden;
      clip: rect(0, 0, 0, 0);
      white-space: nowrap;
      border-width: 0;
    }

    .hidden {
      display: none;
    }

    /* セクションタイトルのスタイル調整 */
    .section-heading {
      font-size: 1.125rem;
      font-weight: 600;
      margin-bottom: 0.75rem;
      padding-bottom: 0.5rem;
      border-bottom: 1px solid hsl(var(--border) / 0.5);
    }

    /* セクション間の余白を増やす */
    .student-section {
      margin-top: 2.5rem;
      margin-bottom: 2.5rem;
    }

    .bg-green-50 {
      background-color: rgba(236, 253, 245, 0.5);
    }

    .bg-red-50 {
      background-color: rgba(254, 242, 242, 0.5);
    }
  </style>
</head>

<body>
  <div class="container">
    <form id="lessonForm" class="form">
      <div class="header">
        <button type="button" class="back-button" id="backButton">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"
            style="margin-right: 4px;">
            <path d="m12 19-7-7 7-7"></path>
            <path d="M19 12H5"></path>
          </svg>
          戻る
        </button>
        <h1 class="page-title">
          <span id="lessonDate">2025年3月10日（月）</span>
          <span class="separator">|</span>
          <span id="lessonTimeSlot" class="time-slot">B時間帯（12:30～14:00）</span>
          <span class="separator">|</span>
          <span id="lessonCourt">コート1</span>
        </h1>
      </div>

      <div class="form-section">
        <div class="form-grid">
          <div class="form-group">
            <label for="lessonAvailability" class="form-label">レッスン:</label>
            <select id="lessonAvailability" class="form-control" style="width: 200px;">
              <option value="あり">あり</option>
              <option value="なし">なし</option>
            </select>
          </div>

          <div class="form-group" id="cancelReasonGroup" style="display: none;">
            <label for="cancelReason" class="form-label">中止理由:</label>
            <textarea id="cancelReason" class="form-control form-textarea" placeholder="中止理由を入力してください"></textarea>
          </div>

          <div class="form-group">
            <div class="level-header">
              <label for="level" class="form-label">レベル:</label>
              <button type="button" id="levelEditButton" class="button button-ghost level-edit-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"
                  style="margin-right: 4px;">
                  <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"></path>
                </svg>
                編集
              </button>
              <div id="levelEditActions" class="hidden">
                <button type="button" id="levelCancelButton" class="button button-ghost level-edit-button">
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon" style="margin-right: 4px;">
                    <path d="M18 6 6 18"></path>
                    <path d="m6 6 12 12"></path>
                  </svg>
                  キャンセル
                </button>
                <button type="button" id="levelConfirmButton" class="button button-ghost level-edit-button"
                  style="color: hsl(var(--primary));">
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="icon" style="margin-right: 4px;">
                    <path d="M20 6 9 17l-5-5"></path>
                  </svg>
                  確定
                </button>
              </div>
            </div>
            <div id="levelReadOnly" class="form-readonly">初級</div>
            <select id="levelSelect" class="form-control hidden">
              <option value="初級">初級</option>
              <option value="初中級">初中級</option>
              <option value="中級">中級</option>
              <option value="中上級">中上級</option>
              <option value="上級">上級</option>
            </select>
          </div>

          <div class="form-group">
            <label for="coach" class="form-label">コーチ:</label>
            <select id="coach" class="form-control">
              <option value="佐藤次郎">佐藤次郎</option>
              <option value="田中一郎">田中一郎</option>
              <option value="鈴木花子">鈴木花子</option>
              <option value="山田太郎">山田太郎</option>
              <option value="高橋恵子">高橋恵子</option>
            </select>
            <div class="checkbox-group">
              <input type="checkbox" id="isSubstitute" class="checkbox">
              <label for="isSubstitute" class="checkbox-label">代行コーチ</label>
            </div>
          </div>

          <div class="form-group">
            <div class="section-header">
              <div style="display: flex; align-items: center;">
                <h2 class="section-title">生徒一覧</h2>
                <div class="capacity-badge">
                  <span id="currentCapacity" class="capacity-current available">0</span>
                  <span>/</span>
                  <span id="maxCapacity">8</span>
                  <button type="button" class="capacity-edit" id="editCapacity" aria-label="最大人数を編集">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"
                      fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round">
                      <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"></path>
                    </svg>
                  </button>
                </div>
              </div>
            </div>

            <!-- 登録済み生徒セクション -->
            <div class="student-section">
              <h3 class="section-heading">登録済み生徒</h3>
              <div id="existingStudentsContainer">
                <table id="existingStudentsTable" class="table">
                  <thead>
                    <tr>
                      <th>番号</th>
                      <th>名前</th>
                      <th>レベル</th>
                      <th style="width: 80px;">操作</th>
                    </tr>
                  </thead>
                  <tbody id="existingStudentsBody">
                    <!-- 既存の生徒がここに表示されます -->
                  </tbody>
                </table>
                <div id="emptyExistingStudents" class="empty-state hidden">
                  <p class="empty-message">登録済みの生徒はいません</p>
                </div>
              </div>
            </div>

            <!-- 追加する生徒セクション -->
            <div class="student-section">
              <div class="section-header">
                <h3 class="section-heading">追加する生徒</h3>
                <button type="button" id="addStudentButton" class="button button-outline button-sm">
                  生徒を追加
                </button>
              </div>

              <div id="searchCard" class="card hidden">
                <div class="card-header">
                  <div class="search-form">
                    <input type="text" id="searchInput" class="form-control search-input"
                      placeholder="生徒番号または名前で検索">
                    <button type="button" id="clearSearchButton" class="button button-ghost button-icon">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                      </svg>
                    </button>
                  </div>
                </div>
                <div id="searchResults" class="card-content">
                  <ul id="searchResultsList" class="student-list">
                    <!-- 検索結果がここに表示されます -->
                  </ul>
                </div>
                <div id="noResults" class="card-content hidden">
                  <p class="empty-message">該当する生徒が見つかりませんでした</p>
                </div>
              </div>

              <div id="addedStudentsContainer">
                <table id="addedStudentsTable" class="table hidden">
                  <thead>
                    <tr>
                      <th>番号</th>
                      <th>名前</th>
                      <th>レベル</th>
                      <th style="width: 80px;">操作</th>
                    </tr>
                  </thead>
                  <tbody id="addedStudentsBody">
                    <!-- 追加する生徒がここに表示されます -->
                  </tbody>
                </table>
                <div id="emptyAddedStudents" class="empty-state">
                  <p class="empty-message">追加する生徒はいません</p>
                </div>
              </div>
            </div>

            <!-- キャンセルする生徒セクション -->
            <div id="canceledStudentsSection" class="student-section hidden">
              <h3 class="section-heading">キャンセルする生徒</h3>
              <table id="canceledStudentsTable" class="table">
                <thead>
                  <tr>
                    <th>番号</th>
                    <th>名前</th>
                    <th>レベル</th>
                    <th style="width: 80px;">操作</th>
                  </tr>
                </thead>
                <tbody id="canceledStudentsBody">
                  <!-- キャンセルする生徒がここに表示されます -->
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <button type="submit" class="button button-primary button-full" style="margin-top: 1.5rem;">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            style="margin-right: 8px;">
            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
            <polyline points="17 21 17 13 7 13 7 21"></polyline>
            <polyline points="7 3 7 8 15 8"></polyline>
          </svg>
          保存
        </button>
      </div>
    </form>
  </div>

  <!-- レベル変更確認ダイアログ -->
  <div id="levelDialog" class="dialog-backdrop hidden">
    <div class="dialog">
      <div class="dialog-header">
        <h3 class="dialog-title">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="dialog-title-icon">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="12" x2="12" y1="8" y2="12"></line>
            <line x1="12" x2="12.01" y1="16" y2="16"></line>
          </svg>
          レベル変更の確認
        </h3>
        <p class="dialog-description" id="levelChangeDescription">
          レベルを「初級」から「中級」に変更しますか？
          レベルの変更は生徒の参加資格に影響する可能性があります。
        </p>
      </div>
      <div class="dialog-footer">
        <button type="button" id="dialogCancelButton" class="button button-outline">キャンセル</button>
        <button type="button" id="dialogConfirmButton" class="button button-primary">変更を確定</button>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // サンプルデータ
      const SAMPLE_STUDENTS = [{
          id: "S001",
          name: "伊藤健太",
          level: "初級"
        },
        {
          id: "S002",
          name: "中村美咲",
          level: "初中級"
        },
        {
          id: "S003",
          name: "小林大輔",
          level: "中級"
        },
        {
          id: "S004",
          name: "加藤由美",
          level: "初級"
        },
        {
          id: "S005",
          name: "渡辺隆",
          level: "上級"
        },
        {
          id: "S006",
          name: "松本さくら",
          level: "中上級"
        },
        {
          id: "S007",
          name: "井上拓也",
          level: "初中級"
        },
        {
          id: "S008",
          name: "木村真理",
          level: "中級"
        },
      ];

      // 状態管理
      const state = {
        lessonInfo: {
          date: "2025年3月10日（月）",
          timeSlot: "B時間帯（12:30～14:00）",
          court: "コート1",
          isAvailable: "あり",
          cancelReason: "",
          level: "初級",
          coach: "佐藤次郎",
          isSubstitute: false
        },
        existingStudents: [{
            id: "S001",
            name: "伊藤健太",
            level: "初級"
          },
          {
            id: "S004",
            name: "加藤由美",
            level: "初級"
          },
        ],
        addedStudents: [],
        canceledStudents: [],
        searchTerm: "",
        searchResults: [],
        isSearching: false,
        maxCapacity: 8,
        isLevelEditable: false,
        tempLevel: "初級"
      };

      // 要素の参照を取得
      const elements = {
        // レッスン情報
        lessonDate: document.getElementById('lessonDate'),
        lessonTimeSlot: document.getElementById('lessonTimeSlot'),
        lessonCourt: document.getElementById('lessonCourt'),
        lessonAvailability: document.getElementById('lessonAvailability'),
        cancelReasonGroup: document.getElementById('cancelReasonGroup'),
        cancelReason: document.getElementById('cancelReason'),

        // レベル
        levelEditButton: document.getElementById('levelEditButton'),
        levelEditActions: document.getElementById('levelEditActions'),
        levelCancelButton: document.getElementById('levelCancelButton'),
        levelConfirmButton: document.getElementById('levelConfirmButton'),
        levelReadOnly: document.getElementById('levelReadOnly'),
        levelSelect: document.getElementById('levelSelect'),
        levelDialog: document.getElementById('levelDialog'),
        levelChangeDescription: document.getElementById('levelChangeDescription'),
        dialogCancelButton: document.getElementById('dialogCancelButton'),
        dialogConfirmButton: document.getElementById('dialogConfirmButton'),

        // コーチ
        coach: document.getElementById('coach'),
        isSubstitute: document.getElementById('isSubstitute'),

        // 生徒一覧
        currentCapacity: document.getElementById('currentCapacity'),
        maxCapacity: document.getElementById('maxCapacity'),
        editCapacity: document.getElementById('editCapacity'),

        // 既存生徒
        existingStudentsContainer: document.getElementById('existingStudentsContainer'),
        existingStudentsTable: document.getElementById('existingStudentsTable'),
        existingStudentsBody: document.getElementById('existingStudentsBody'),
        emptyExistingStudents: document.getElementById('emptyExistingStudents'),

        // 追加する生徒
        addStudentButton: document.getElementById('addStudentButton'),
        searchCard: document.getElementById('searchCard'),
        searchInput: document.getElementById('searchInput'),
        clearSearchButton: document.getElementById('clearSearchButton'),
        searchResults: document.getElementById('searchResults'),
        searchResultsList: document.getElementById('searchResultsList'),
        noResults: document.getElementById('noResults'),
        addedStudentsContainer: document.getElementById('addedStudentsContainer'),
        addedStudentsTable: document.getElementById('addedStudentsTable'),
        addedStudentsBody: document.getElementById('addedStudentsBody'),
        emptyAddedStudents: document.getElementById('emptyAddedStudents'),

        // キャンセルする生徒
        canceledStudentsSection: document.getElementById('canceledStudentsSection'),
        canceledStudentsTable: document.getElementById('canceledStudentsTable'),
        canceledStudentsBody: document.getElementById('canceledStudentsBody'),

        // フォーム
        backButton: document.getElementById('backButton'),
        lessonForm: document.getElementById('lessonForm')
      };

      // 現在の生徒数を計算（既存 - キャンセル + 追加）
      function getCurrentStudentCount() {
        return state.existingStudents.length - state.canceledStudents.length + state.addedStudents.length;
      }

      // 初期表示の設定
      function initializeDisplay() {
        elements.lessonDate.textContent = state.lessonInfo.date;
        elements.lessonTimeSlot.textContent = formatTimeSlot(state.lessonInfo.timeSlot);
        elements.lessonCourt.textContent = state.lessonInfo.court;
        elements.lessonAvailability.value = state.lessonInfo.isAvailable;
        elements.cancelReason.value = state.lessonInfo.cancelReason;
        elements.levelReadOnly.textContent = state.lessonInfo.level;
        elements.levelSelect.value = state.lessonInfo.level;
        elements.coach.value = state.lessonInfo.coach;
        elements.isSubstitute.checked = state.lessonInfo.isSubstitute;

        // レッスン有無による中止理由の表示/非表示
        toggleCancelReasonVisibility();

        // 生徒一覧の表示
        updateExistingStudentsList();
        updateAddedStudentsList();
        updateCanceledStudentsList();
        updateCapacityDisplay();
      }

      // タイムスロットの表示形式を整形
      function formatTimeSlot(timeSlot) {
        const match = timeSlot.match(/([A-Z])時間帯（(.+)）/);
        if (match && match.length >= 3) {
          return `${match[1]} ${match[2]}`;
        }
        return timeSlot;
      }

      // レッスン有無による中止理由の表示/非表示
      function toggleCancelReasonVisibility() {
        if (elements.lessonAvailability.value === "なし") {
          elements.cancelReasonGroup.style.display = "block";
        } else {
          elements.cancelReasonGroup.style.display = "none";
        }
      }

      // 既存生徒リストの更新
      function updateExistingStudentsList() {
        const filteredStudents = state.existingStudents.filter(
          student => !state.canceledStudents.some(s => s.id === student.id)
        );

        if (filteredStudents.length > 0) {
          elements.existingStudentsTable.classList.remove('hidden');
          elements.emptyExistingStudents.classList.add('hidden');

          // テーブルの内容をクリア
          elements.existingStudentsBody.innerHTML = '';

          // 生徒リストを表示
          filteredStudents.forEach(student => {
            const row = document.createElement('tr');

            const idCell = document.createElement('td');
            idCell.textContent = student.id;

            const nameCell = document.createElement('td');
            nameCell.textContent = student.name;

            const levelCell = document.createElement('td');
            levelCell.textContent = student.level;

            const actionCell = document.createElement('td');
            const cancelButton = document.createElement('button');
            cancelButton.className = 'button button-ghost button-icon';
            cancelButton.innerHTML = `
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 6 6 18"></path>
                <path d="m6 6 12 12"></path>
              </svg>
            `;
            cancelButton.addEventListener('click', () => cancelStudent(student));
            actionCell.appendChild(cancelButton);

            row.appendChild(idCell);
            row.appendChild(nameCell);
            row.appendChild(levelCell);
            row.appendChild(actionCell);

            elements.existingStudentsBody.appendChild(row);
          });
        } else {
          elements.existingStudentsTable.classList.add('hidden');
          elements.emptyExistingStudents.classList.remove('hidden');
        }
      }

      // 追加する生徒リストの更新
      function updateAddedStudentsList() {
        if (state.addedStudents.length > 0) {
          elements.addedStudentsTable.classList.remove('hidden');
          elements.emptyAddedStudents.classList.add('hidden');

          // テーブルの内容をクリア
          elements.addedStudentsBody.innerHTML = '';

          // 生徒リストを表示
          state.addedStudents.forEach(student => {
            const row = document.createElement('tr');
            row.className = 'bg-green-50';

            const idCell = document.createElement('td');
            idCell.textContent = student.id;

            const nameCell = document.createElement('td');
            nameCell.textContent = student.name;

            const levelCell = document.createElement('td');
            levelCell.textContent = student.level;

            const actionCell = document.createElement('td');
            const removeButton = document.createElement('button');
            removeButton.className = 'button button-ghost button-icon';
            removeButton.innerHTML = `
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 6 6 18"></path>
                <path d="m6 6 12 12"></path>
              </svg>
            `;
            removeButton.addEventListener('click', () => removeAddedStudent(student.id));
            actionCell.appendChild(removeButton);

            row.appendChild(idCell);
            row.appendChild(nameCell);
            row.appendChild(levelCell);
            row.appendChild(actionCell);

            elements.addedStudentsBody.appendChild(row);
          });
        } else {
          elements.addedStudentsTable.classList.add('hidden');
          elements.emptyAddedStudents.classList.remove('hidden');
        }
      }

      // キャンセルする生徒リストの更新
      function updateCanceledStudentsList() {
        if (state.canceledStudents.length > 0) {
          elements.canceledStudentsSection.classList.remove('hidden');

          // テーブルの内容をクリア
          elements.canceledStudentsBody.innerHTML = '';

          // 生徒リストを表示
          state.canceledStudents.forEach(student => {
            const row = document.createElement('tr');
            row.className = 'bg-red-50';

            const idCell = document.createElement('td');
            idCell.textContent = student.id;

            const nameCell = document.createElement('td');
            nameCell.textContent = student.name;

            const levelCell = document.createElement('td');
            levelCell.textContent = student.level;

            const actionCell = document.createElement('td');
            const restoreButton = document.createElement('button');
            restoreButton.className = 'button button-ghost button-sm';
            restoreButton.textContent = '戻す';
            restoreButton.addEventListener('click', () => uncancelStudent(student.id));
            actionCell.appendChild(restoreButton);

            row.appendChild(idCell);
            row.appendChild(nameCell);
            row.appendChild(levelCell);
            row.appendChild(actionCell);

            elements.canceledStudentsBody.appendChild(row);
          });
        } else {
          elements.canceledStudentsSection.classList.add('hidden');
        }
      }

      // 検索結果の更新
      function updateSearchResults() {
        if (state.searchTerm.trim() === '') {
          state.searchResults = [];
          elements.searchResultsList.innerHTML = '';
          elements.noResults.classList.add('hidden');
          return;
        }

        // 既に追加済みまたは既存の生徒IDを除外
        const existingIds = new Set([
          ...state.existingStudents.map(s => s.id),
          ...state.addedStudents.map(s => s.id)
        ]);

        state.searchResults = SAMPLE_STUDENTS.filter(
          student =>
          !existingIds.has(student.id) &&
          (student.id.toLowerCase().includes(state.searchTerm.toLowerCase()) ||
            student.name.includes(state.searchTerm))
        );

        // 検索結果の表示
        if (state.searchResults.length > 0) {
          elements.searchResultsList.innerHTML = '';
          elements.noResults.classList.add('hidden');

          // 検索結果を表示
          state.searchResults.forEach(student => {
            const listItem = document.createElement('li');
            const isDisabled = getCurrentStudentCount() >= state.maxCapacity;

            listItem.className = `student-item clickable ${isDisabled ? 'disabled' : ''}`;

            listItem.innerHTML = `
              <div>
                <p class="student-name">
                  ${student.name} <span class="student-id">(${student.id})</span>
                </p>
                <p class="student-level">レベル: ${student.level}</p>
              </div>
            `;

            if (!isDisabled) {
              listItem.addEventListener('click', () => addStudent(student));
            }

            elements.searchResultsList.appendChild(listItem);
          });
        } else {
          elements.searchResultsList.innerHTML = '';
          elements.noResults.classList.remove('hidden');
        }
      }

      // 定員表示の更新
      function updateCapacityDisplay() {
        const currentCount = getCurrentStudentCount();
        elements.currentCapacity.textContent = currentCount;
        elements.maxCapacity.textContent = state.maxCapacity;

        if (currentCount >= state.maxCapacity) {
          elements.currentCapacity.classList.remove('available');
          elements.currentCapacity.classList.add('full');
          elements.addStudentButton.disabled = true;
        } else {
          elements.currentCapacity.classList.remove('full');
          elements.currentCapacity.classList.add('available');
          elements.addStudentButton.disabled = false;
        }
      }

      // 生徒を追加
      function addStudent(student) {
        if (getCurrentStudentCount() < state.maxCapacity) {
          state.addedStudents.push(student);
          state.searchTerm = '';
          elements.searchInput.value = '';
          toggleSearchCard(false);
          updateAddedStudentsList();
          updateCapacityDisplay();
        }
      }

      // 追加した生徒を削除
      function removeAddedStudent(studentId) {
        state.addedStudents = state.addedStudents.filter(student => student.id !== studentId);
        updateAddedStudentsList();
        updateCapacityDisplay();
      }

      // 既存の生徒をキャンセル
      function cancelStudent(student) {
        if (!state.canceledStudents.some(s => s.id === student.id)) {
          state.canceledStudents.push(student);
          updateExistingStudentsList();
          updateCanceledStudentsList();
          updateCapacityDisplay();
        }
      }

      // キャンセルを戻す
      function uncancelStudent(studentId) {
        state.canceledStudents = state.canceledStudents.filter(student => student.id !== studentId);
        updateExistingStudentsList();
        updateCanceledStudentsList();
        updateCapacityDisplay();
      }

      // 検索カードの表示/非表示
      function toggleSearchCard(show) {
        state.isSearching = show;
        if (show) {
          elements.searchCard.classList.remove('hidden');
          elements.searchInput.focus();
        } else {
          elements.searchCard.classList.add('hidden');
          state.searchTerm = '';
          elements.searchInput.value = '';
          updateSearchResults();
        }
      }

      // レベル編集モードの切り替え
      function toggleLevelEditMode(editable) {
        state.isLevelEditable = editable;
        if (editable) {
          elements.levelEditButton.classList.add('hidden');
          elements.levelEditActions.classList.remove('hidden');
          elements.levelReadOnly.classList.add('hidden');
          elements.levelSelect.classList.remove('hidden');
          elements.levelSelect.focus();
          state.tempLevel = state.lessonInfo.level;
          elements.levelSelect.value = state.tempLevel;
        } else {
          elements.levelEditButton.classList.remove('hidden');
          elements.levelEditActions.classList.add('hidden');
          elements.levelReadOnly.classList.remove('hidden');
          elements.levelSelect.classList.add('hidden');
        }
      }

      // レベル変更の確認ダイアログを表示
      function showLevelChangeDialog() {
        elements.levelChangeDescription.textContent = `レベルを「${state.lessonInfo.level}」から「${state.tempLevel}」に変更しますか？
レベルの変更は生徒の参加資格に影響する可能性があります。`;
        elements.levelDialog.classList.remove('hidden');
      }

      // レベル変更を確定
      function confirmLevelChange() {
        state.lessonInfo.level = state.tempLevel;
        elements.levelReadOnly.textContent = state.lessonInfo.level;
        toggleLevelEditMode(false);
        elements.levelDialog.classList.add('hidden');
      }

      // イベントリスナーの設定
      function setupEventListeners() {
        // 戻るボタン
        elements.backButton.addEventListener('click', () => {
          window.history.back();
        });

        // レッスン有無の変更
        elements.lessonAvailability.addEventListener('change', () => {
          state.lessonInfo.isAvailable = elements.lessonAvailability.value;
          toggleCancelReasonVisibility();
        });

        // 中止理由の変更
        elements.cancelReason.addEventListener('input', () => {
          state.lessonInfo.cancelReason = elements.cancelReason.value;
        });

        // レベル編集ボタン
        elements.levelEditButton.addEventListener('click', () => {
          toggleLevelEditMode(true);
        });

        // レベル編集キャンセルボタン
        elements.levelCancelButton.addEventListener('click', () => {
          toggleLevelEditMode(false);
        });

        // レベル編集確定ボタン
        elements.levelConfirmButton.addEventListener('click', () => {
          if (state.tempLevel !== state.lessonInfo.level) {
            showLevelChangeDialog();
          } else {
            toggleLevelEditMode(false);
          }
        });

        // レベル選択の変更
        elements.levelSelect.addEventListener('change', () => {
          state.tempLevel = elements.levelSelect.value;
        });

        // ダイアログのキャンセルボタン
        elements.dialogCancelButton.addEventListener('click', () => {
          elements.levelDialog.classList.add('hidden');
        });

        // ダイアログの確定ボタン
        elements.dialogConfirmButton.addEventListener('click', () => {
          confirmLevelChange();
        });

        // コーチの変更
        elements.coach.addEventListener('change', () => {
          state.lessonInfo.coach = elements.coach.value;
        });

        // 代行コーチのチェック
        elements.isSubstitute.addEventListener('change', () => {
          state.lessonInfo.isSubstitute = elements.isSubstitute.checked;
        });

        // 最大人数の編集
        elements.editCapacity.addEventListener('click', () => {
          const newCapacity = prompt('最大受け入れ人数を入力してください', state.maxCapacity.toString());
          if (newCapacity && !isNaN(parseInt(newCapacity))) {
            state.maxCapacity = parseInt(newCapacity);
            updateCapacityDisplay();
          }
        });

        // 生徒追加ボタン
        elements.addStudentButton.addEventListener('click', () => {
          toggleSearchCard(!state.isSearching);
        });

        // 検索入力
        elements.searchInput.addEventListener('input', (e) => {
          state.searchTerm = e.target.value;
          updateSearchResults();
        });

        // 検索クリアボタン
        elements.clearSearchButton.addEventListener('click', () => {
          state.searchTerm = '';
          elements.searchInput.value = '';
          updateSearchResults();
        });

        // フォーム送信
        elements.lessonForm.addEventListener('submit', (e) => {
          e.preventDefault();
          console.log('保存されたレッスン情報:', {
            ...state.lessonInfo,
            existingStudents: state.existingStudents,
            addedStudents: state.addedStudents,
            canceledStudents: state.canceledStudents
          });
          alert('レッスン情報が保存されました');
        });
      }

      // 初期化
      function initialize() {
        initializeDisplay();
        setupEventListeners();
      }

      // アプリケーションの初期化
      initialize();
    });
  </script>
</body>

</html>
