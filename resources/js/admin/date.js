document.addEventListener("DOMContentLoaded", function () {
  // 現在の日付を取得
  const today = new Date();

  // 表示する年月を管理する変数
  let currentYear = today.getFullYear();
  let currentMonth = today.getMonth() + 1; // JavaScriptの月は0から始まるので+1

  // 初期表示
  renderCalendar(currentYear, currentMonth);

  // 前月ボタンのイベントリスナー
  document
    .getElementById("prevMonthBtn")
    .addEventListener("click", function () {
      if (currentMonth === 1) {
        currentYear--;
        currentMonth = 12;
      } else {
        currentMonth--;
      }
      renderCalendar(currentYear, currentMonth);
    });

  // 次月ボタンのイベントリスナー
  document
    .getElementById("nextMonthBtn")
    .addEventListener("click", function () {
      if (currentMonth === 12) {
        currentYear++;
        currentMonth = 1;
      } else {
        currentMonth++;
      }
      renderCalendar(currentYear, currentMonth);
    });

  // カレンダーを描画する関数
  function renderCalendar(year, month) {
    // タイトルを更新
    document.getElementById("monthTitle").textContent = `${year}年${month}月`;

    // カレンダーグリッドをクリア
    const calendarGrid = document.getElementById("calendarGrid");
    calendarGrid.innerHTML = "";

    // 月の最初の日と最後の日を取得
    const firstDay = new Date(year, month - 1, 1);
    const lastDay = new Date(year, month, 0);

    // 月の最初の日の曜日（0: 日曜日, 1: 月曜日, ..., 6: 土曜日）
    // 月曜始まりに調整（月曜: 0, 火曜: 1, ..., 日曜: 6）
    const firstDayOfWeek = firstDay.getDay() === 0 ? 6 : firstDay.getDay() - 1;

    // 前月の日数を取得
    const prevMonthLastDay = new Date(year, month - 1, 0).getDate();

    // 前月の日を追加
    for (let i = firstDayOfWeek - 1; i >= 0; i--) {
      const day = prevMonthLastDay - i;
      const prevMonth = month === 1 ? 12 : month - 1;
      const prevYear = month === 1 ? year - 1 : year;
      const date = new Date(prevYear, prevMonth - 1, day);

      // 日付のIDを生成（YYYYMMDD形式）
      const dateId = formatDateId(date);

      // 曜日を取得（0: 日曜日, 1: 月曜日, ..., 6: 土曜日）
      const dayOfWeek = date.getDay();

      // 日付セルを作成
      const dayElement = createDayElement(day, dateId, dayOfWeek, false);
      calendarGrid.appendChild(dayElement);
    }

    // 当月の日を追加
    for (let i = 1; i <= lastDay.getDate(); i++) {
      const date = new Date(year, month - 1, i);

      // 日付のIDを生成（YYYYMMDD形式）
      const dateId = formatDateId(date);

      // 曜日を取得（0: 日曜日, 1: 月曜日, ..., 6: 土曜日）
      const dayOfWeek = date.getDay();

      // 今日かどうかをチェック
      const isToday = date.toDateString() === today.toDateString();

      // 日付セルを作成
      const dayElement = createDayElement(i, dateId, dayOfWeek, true, isToday);
      calendarGrid.appendChild(dayElement);
    }

    // 翌月の日を追加（6週間分になるように）
    const totalDaysDisplayed = firstDayOfWeek + lastDay.getDate();
    const remainingDays = 42 - totalDaysDisplayed; // 6週 × 7日 = 42

    for (let i = 1; i <= remainingDays; i++) {
      const nextMonth = month === 12 ? 1 : month + 1;
      const nextYear = month === 12 ? year + 1 : year;
      const date = new Date(nextYear, nextMonth - 1, i);

      // 日付のIDを生成（YYYYMMDD形式）
      const dateId = formatDateId(date);

      // 曜日を取得（0: 日曜日, 1: 月曜日, ..., 6: 土曜日）
      const dayOfWeek = date.getDay();

      // 日付セルを作成
      const dayElement = createDayElement(i, dateId, dayOfWeek, false);
      calendarGrid.appendChild(dayElement);
    }
  }

  // 日付セルを作成する関数
  function createDayElement(
    day,
    dateId,
    dayOfWeek,
    isCurrentMonth,
    isToday = false
  ) {
    const dayElement = document.createElement("div");
    dayElement.className = `calendar-day${
      isCurrentMonth ? "" : " other-month"
    }`;

    // 日付番号の要素
    const dayNumber = document.createElement("div");

    // 曜日に応じたクラスを追加
    if (dayOfWeek === 6) {
      // 土曜日
      dayNumber.className = `day-number${
        isCurrentMonth ? " saturday" : " other-month"
      }`;
    } else if (dayOfWeek === 0) {
      // 日曜日
      dayNumber.className = `day-number${
        isCurrentMonth ? " sunday" : " other-month"
      }`;
    } else {
      dayNumber.className = `day-number${isCurrentMonth ? "" : " other-month"}`;
    }

    // 今日の日付の場合、特別なクラスを追加
    if (isToday) {
      dayNumber.className += " today";
    }

    dayNumber.textContent = day;
    dayElement.appendChild(dayNumber);

    // 当月の日付のみ詳細ボタンを表示
    if (isCurrentMonth) {
      const buttonContainer = document.createElement("div");
      buttonContainer.className = "detail-button-container";

      const detailButton = document.createElement("a");
      detailButton.href = `shift/${dateId}`;
      detailButton.className = "detail-button";
      detailButton.textContent = "詳細";

      buttonContainer.appendChild(detailButton);
      dayElement.appendChild(buttonContainer);
    }

    return dayElement;
  }

  // 日付をYYYYMMDD形式に変換する関数
  function formatDateId(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, "0");
    const day = String(date.getDate()).padStart(2, "0");
    return `${year}${month}${day}`;
  }

  // 日本語の月名を取得する関数
  function getJapaneseMonthName(month) {
    return `${month}月`;
  }
});
