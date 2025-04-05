<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>テニスレッスン情報登録・編集</title>
  <!-- jQuery の読み込み -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  @vite('resources/js/admin/shift_form.js')
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
      cursor: pointer;
      transition: background-color 0.2s;
    }

    .student-item:hover {
      background-color: hsl(var(--accent));
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

    /* 保存完了メッセージ */
    .save-success {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: white;
      border-radius: var(--radius);
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
      padding: 1.5rem;
      z-index: 100;
      text-align: center;
      max-width: 90%;
      width: 400px;
    }

    .save-success-title {
      font-size: 1.25rem;
      margin-bottom: 1.5rem;
    }

    .save-success-button {
      background-color: hsl(var(--primary));
      color: white;
      border: none;
      border-radius: var(--radius);
      padding: 0.5rem 2rem;
      font-size: 1rem;
      cursor: pointer;
    }
  </style>
</head>

<body>
  <div class="container">
    <form id="lessonForm" class="form">
      @include('components.admin.shift.date.form.header', [
          'year' => $year,
          'month' => $month,
          'day' => $day,
          'weekday' => $weekday,
          'lessonTimeSlot' => $lessonTimeSlot,
          'court_num' => $court_num,
      ])
      <div class="form-section">
        <div class="form-grid">
          <div class="form-group">
            {{-- レベル --}}
            @include('components.admin.shift.date.form.level_selector', [
                'lessonMaster' => $lessonMaster,
                'lessonMasterId' => '',
            ])
          </div>

          <div class="form-group">
            {{-- コーチ --}}
            @include('components.admin.shift.date.form.coach_selector', [
                'staffs' => $staffs,
                'staffId' => '',
            ])
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
              <button type="button" id="addStudentButton" class="button button-outline button-sm">生徒を追加</button>
            </div>

            <div id="searchCard" class="card hidden">
              <div class="card-header">
                <div class="search-form">
                  <input type="text" id="searchInput" class="form-control search-input" placeholder="生徒番号または名前で検索">
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
              <div id="searchResults" class="card-content hidden">
                <ul id="searchResultsList" class="student-list">
                  <!-- 検索結果がここに表示されます -->
                </ul>
              </div>
              <div id="noResults" class="card-content hidden">
                <p class="empty-message">該当する生徒が見つかりませんでした</p>
              </div>
            </div>

            <div id="studentTableContainer">
              <table id="studentTable" class="table hidden">
                <thead>
                  <tr>
                    <th>番号</th>
                    <th>名前</th>
                    <th>レベル</th>
                    <th style="width: 80px;"></th>
                  </tr>
                </thead>
                <tbody id="studentTableBody">
                  <!-- 生徒リストがここに表示されます -->
                </tbody>
              </table>
              <div id="emptyStudentList" class="empty-state">
                <p class="empty-message">生徒が登録されていません</p>
                <button type="button" id="emptyAddButton" class="button button-outline button-sm"
                  style="margin-top: 0.5rem;">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    style="margin-right: 4px;">
                    <path d="M5 12h14"></path>
                    <path d="M12 5v14"></path>
                  </svg>
                  生徒を追加
                </button>
              </div>
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

  <!-- 保存完了メッセージ -->
  <div id="saveSuccessMessage" class="save-success hidden">
    <p class="save-success-title">レッスン情報が保存されました</p>
    <button type="button" id="saveSuccessOkButton" class="save-success-button">OK</button>
  </div>

  <script></script>
</body>

</html>
