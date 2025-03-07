document.addEventListener('DOMContentLoaded', function() {
    // 現在の日付と表示モード
    let currentDate = new Date(2025, 2, 1); // 2025年3月
    let currentView = 'month';

    // DOM要素
    const monthViewBtn = document.getElementById('month-view-btn');
    const weekViewBtn = document.getElementById('week-view-btn');
    const dayViewBtn = document.getElementById('day-view-btn');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    const currentDateEl = document.getElementById('current-date');
    const calendarView = document.getElementById('calendar-view');

    // 予約データ
    const reservationData = {
      // 月表示用データ
      month: {
        "2025-03-07": [
          { id: 1, time: "10:00-14:00", menu: "休日メニュー", type: "専科", isAvailable: true, price: 2000 },
          { id: 2, time: "11:00-13:00", menu: "和食メニュー", type: "専科", isAvailable: true, price: 3000 },
          { id: 3, time: "14:00-16:00", menu: "洋食メニュー", type: "専科", isAvailable: true, price: 3000 },
        ],
        "2025-03-10": [
          { id: 4, time: "10:00-12:00", menu: "料理の基本", type: "本科", isAvailable: true, price: 2500 },
          { id: 5, time: "14:00-16:00", menu: "洋食メニュー", type: "専科", isAvailable: false, price: 3000 },
        ],
        "2025-03-12": [
          { id: 6, time: "10:00-12:00", menu: "料理の基本", type: "本科", isAvailable: true, price: 2500 },
          { id: 7, time: "11:00-13:00", menu: "和食メニュー", type: "専科", isAvailable: true, price: 3000 },
        ],
        "2025-03-13": [
          { id: 8, time: "10:00-14:00", menu: "休日メニュー", type: "専科", isAvailable: true, price: 2000 },
          { id: 9, time: "14:00-16:00", menu: "洋食メニュー", type: "専科", isAvailable: false, price: 3000 },
        ],
        "2025-03-14": [
          { id: 10, time: "10:00-14:00", menu: "休日メニュー", type: "専科", isAvailable: true, price: 2000 },
          { id: 11, time: "11:00-13:00", menu: "和食メニュー", type: "専科", isAvailable: false, price: 3000 },
          { id: 12, time: "14:00-16:00", menu: "洋食メニュー", type: "専科", isAvailable: true, price: 3000 },
        ],
        "2025-03-15": [
          { id: 13, time: "10:00-14:00", menu: "休日メニュー", type: "専科", isAvailable: true, price: 2000 },
          { id: 14, time: "14:00-16:00", menu: "洋食メニュー", type: "専科", isAvailable: true, price: 3000 },
        ],
      }
    };

    // 日付フォーマット関数
    function formatDate(date) {
      return `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}-${String(date.getDate()).padStart(2, '0')}`;
    }

    // 表示モード切り替え
    function setView(view) {
      currentView = view;

      // ボタンのアクティブ状態を更新
      monthViewBtn.classList.toggle('active', view === 'month');
      weekViewBtn.classList.toggle('active', view === 'week');
      dayViewBtn.classList.toggle('active', view === 'day');

      // 日付表示を更新
      updateDateDisplay();

      // カレンダーを再描画
      renderCalendar();
    }

    // 日付表示の更新
    function updateDateDisplay() {
      if (currentView === 'month') {
        currentDateEl.innerHTML = `${currentDate.getFullYear()}年${currentDate.getMonth() + 1}月
          <button class="calendar-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
              <line x1="16" y1="2" x2="16" y2="6"></line>
              <line x1="8" y1="2" x2="8" y2="6"></line>
              <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
          </button>`;
      } else if (currentView === 'week') {
        const weekStart = new Date(currentDate);
        const dayOfWeek = weekStart.getDay();
        weekStart.setDate(weekStart.getDate() - dayOfWeek);

        const weekEnd = new Date(weekStart);
        weekEnd.setDate(weekStart.getDate() + 6);

        currentDateEl.innerHTML = `${weekStart.getFullYear()}年${weekStart.getMonth() + 1}月${weekStart.getDate()}日 ～
          ${weekEnd.getFullYear()}年${weekEnd.getMonth() + 1}月${weekEnd.getDate()}日
          <button class="calendar-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
              <line x1="16" y1="2" x2="16" y2="6"></line>
              <line x1="8" y1="2" x2="8" y2="6"></line>
              <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
          </button>`;
      } else if (currentView === 'day') {
        const weekdays = ["日", "月", "火", "水", "木", "金", "土"];
        currentDateEl.innerHTML = `${currentDate.getFullYear()}年${currentDate.getMonth() + 1}月${currentDate.getDate()}日(${weekdays[currentDate.getDay()]})
          <button class="calendar-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
              <line x1="16" y1="2" x2="16" y2="6"></line>
              <line x1="8" y1="2" x2="8" y2="6"></line>
              <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
          </button>`;
      }
    }

    // 前へ/次へボタンの処理
    function navigate(direction) {
      if (currentView === 'month') {
        currentDate.setMonth(currentDate.getMonth() + direction);
      } else if (currentView === 'week') {
        currentDate.setDate(currentDate.getDate() + (7 * direction));
      } else if (currentView === 'day') {
        currentDate.setDate(currentDate.getDate() + direction);
      }

      updateDateDisplay();
      renderCalendar();
    }

    // カレンダーの描画
    function renderCalendar() {
      if (currentView === 'month') {
        renderMonthView();
      } else if (currentView === 'week') {
        renderWeekView();
      } else if (currentView === 'day') {
        renderDayView();
      }
    }

    // 月表示の描画
    function renderMonthView() {
      // 月の最初の日と最後の日を取得
      const firstDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
      const lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);

      // 月の最初の日の曜日（0: 日曜日, 1: 月曜日, ..., 6: 土曜日）
      const firstDayOfWeek = firstDay.getDay();

      // 月の日数
      const daysInMonth = lastDay.getDate();

      // 曜日の配列
      const weekdays = ["日", "月", "火", "水", "木", "金", "土"];

      // 月表示のHTMLを生成
      let html = '<div class="month-grid">';

      // 曜日ヘッダー
      weekdays.forEach((day, index) => {
        html += `<div class="weekday-header ${index === 0 ? 'weekday-sun' : ''} ${index === 6 ? 'weekday-sat' : ''}">${day}</div>`;
      });

      // 前月の日を追加
      for (let i = 0; i < firstDayOfWeek; i++) {
        html += '<div class="day-cell"></div>';
      }

      // 当月の日を追加
      for (let day = 1; day <= daysInMonth; day++) {
        const date = new Date(currentDate.getFullYear(), currentDate.getMonth(), day);
        const dateKey = formatDate(date);
        const dayReservations = reservationData.month[dateKey]?.filter(slot => slot.isAvailable) || [];

        html += `<div class="day-cell" data-date="${dateKey}">
          <div class="day-number">${day}</div>`;

        if (dayReservations.length > 0) {
          dayReservations.slice(0, 2).forEach(slot => {
            let slotClass = '';
            if (slot.menu.includes('休日')) slotClass = 'time-slot-holiday';
            else if (slot.menu.includes('和食')) slotClass = 'time-slot-japanese';
            else if (slot.menu.includes('洋食')) slotClass = 'time-slot-western';
            else if (slot.menu.includes('基本')) slotClass = 'time-slot-basic';

            html += `<div class="time-slot ${slotClass}">
              <div class="time-slot-time">${slot.time}</div>
              <div>${slot.menu}</div>
              <div class="availability-circle"></div>
            </div>`;
          });

          if (dayReservations.length > 2) {
            html += `<div class="more-slots">他 ${dayReservations.length - 2} 件</div>`;
          }
        }

        html += '</div>';
      }

      html += '</div>';
      calendarView.innerHTML = html;
    }

    // 週表示の描画
    function renderWeekView() {
      // 週の開始日（現在の日付から計算）
      const weekStart = new Date(currentDate);
      const dayOfWeek = weekStart.getDay();
      weekStart.setDate(weekStart.getDate() - dayOfWeek);

      // 曜日の配列
      const weekdays = ["日", "月", "火", "水", "木", "金", "土"];

      // 週表示のHTMLを生成
      let html = '<div class="week-grid">';

      // 週の各日を生成
      for (let i = 0; i < 7; i++) {
        const date = new Date(weekStart);
        date.setDate(weekStart.getDate() + i);
        const dateKey = formatDate(date);
        const dayReservations = reservationData.month[dateKey]?.filter(slot => slot.isAvailable) || [];

        html += `<div class="week-day">
          <div class="week-day-header ${i === 0 ? 'weekday-sun' : ''} ${i === 6 ? 'weekday-sat' : ''}">
            ${date.getMonth() + 1}/${date.getDate()}
            <div class="weekday-name">${weekdays[i]}</div>
          </div>
          <div class="week-day-content">`;

        if (dayReservations.length > 0) {
          dayReservations.forEach(slot => {
            let slotClass = '';
            if (slot.menu.includes('休日')) slotClass = 'time-slot-holiday';
            else if (slot.menu.includes('和食')) slotClass = 'time-slot-japanese';
            else if (slot.menu.includes('洋食')) slotClass = 'time-slot-western';
            else if (slot.menu.includes('基本')) slotClass = 'time-slot-basic';

            html += `<div class="time-slot ${slotClass}">
              <div class="time-slot-time">${slot.time}</div>
              <div>${slot.menu}</div>
              <div class="availability-circle"></div>
            </div>`;
          });
        } else {
          html += '<div class="no-reservations">予約なし</div>';
        }

        html += '</div></div>';
      }

      html += '</div>';
      calendarView.innerHTML = html;
    }

    // 日表示の描画
    function renderDayView() {
      const dateKey = formatDate(currentDate);
      const dayReservations = reservationData.month[dateKey]?.filter(slot => slot.isAvailable) || [];

      let html = '<div class="day-view">';

      if (dayReservations.length > 0) {
        dayReservations.forEach(slot => {
          let slotClass = '';
          if (slot.menu.includes('休日')) slotClass = 'time-slot-holiday';
          else if (slot.menu.includes('和食')) slotClass = 'time-slot-japanese';
          else if (slot.menu.includes('洋食')) slotClass = 'time-slot-western';
          else if (slot.menu.includes('基本')) slotClass = 'time-slot-basic';

          html += `<div class="day-time-slot ${slotClass}">
            <div class="availability-indicator"></div>
            <div class="day-time-slot-time">${slot.time}</div>
            <div class="day-time-slot-menu">${slot.menu}—${slot.type}</div>
            <div class="day-time-slot-price">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 2v2M12 8v2M12 14v2M12 20v2M2 12h2M8 12h2M14 12h2M20 12h2"></path>
              </svg>
              ¥ ${slot.price.toLocaleString()}
            </div>
          </div>`;
        });
      } else {
        html += '<div class="no-reservations">この日の予約はありません</div>';
      }

      html += '</div>';
      calendarView.innerHTML = html;
    }

    // イベントリスナーの設定
    monthViewBtn.addEventListener('click', () => setView('month'));
    weekViewBtn.addEventListener('click', () => setView('week'));
    dayViewBtn.addEventListener('click', () => setView('day'));
    prevBtn.addEventListener('click', () => navigate(-1));
    nextBtn.addEventListener('click', () => navigate(1));

    // 初期表示
    setView('month');
    // 既存のコードの document.addEventListener('DOMContentLoaded', function() { の中に以下を追加

  // モーダル関連の要素
  const calendarModal = document.getElementById('calendar-modal');
  const modalClose = document.getElementById('modal-close');
  const modalPrevMonth = document.getElementById('modal-prev-month');
  const modalNextMonth = document.getElementById('modal-next-month');
  const modalCurrentDateEl = document.getElementById('modal-current-date');
  const modalCalendarGrid = document.getElementById('modal-calendar-grid');

  // モーダルカレンダーの現在の日付
  let modalCurrentDate = new Date();

  // カレンダーアイコンのクリックイベント
  document.addEventListener('click', function(e) {
    if (e.target.closest('.calendar-icon')) {
      showModal();
    }
  });

  // モーダルを表示
  function showModal() {
    calendarModal.classList.add('show');
    renderModalCalendar();
  }

  // モーダルを非表示
  function hideModal() {
    calendarModal.classList.remove('show');
  }

  // モーダルカレンダーの描画
  function renderModalCalendar() {
    // 月の最初の日と最後の日を取得
    const firstDay = new Date(modalCurrentDate.getFullYear(), modalCurrentDate.getMonth(), 1);
    const lastDay = new Date(modalCurrentDate.getFullYear(), modalCurrentDate.getMonth() + 1, 0);

    // 月の最初の日の曜日（0: 日曜日, 1: 月曜日, ..., 6: 土曜日）
    const firstDayOfWeek = firstDay.getDay();

    // 月の日数
    const daysInMonth = lastDay.getDate();

    // モーダルの日付表示を更新
    modalCurrentDateEl.innerHTML = `${modalCurrentDate.getFullYear()}年${modalCurrentDate.getMonth() + 1}月`;

    // カレンダーグリッドのHTML生成
    let html = '';

    // 前月の日を追加
    const prevMonth = new Date(modalCurrentDate.getFullYear(), modalCurrentDate.getMonth(), 0);
    const daysInPrevMonth = prevMonth.getDate();

    for (let i = 0; i < firstDayOfWeek; i++) {
      const day = daysInPrevMonth - firstDayOfWeek + i + 1;
      html += `<div class="modal-day other-month">${day}</div>`;
    }

    // 当月の日を追加
    const today = new Date();
    const selectedDate = currentDate; // メイン表示の選択された日付

    for (let day = 1; day <= daysInMonth; day++) {
      const date = new Date(modalCurrentDate.getFullYear(), modalCurrentDate.getMonth(), day);
      const dateKey = formatDate(date);
      const hasEvents = reservationData.month[dateKey]?.some(slot => slot.isAvailable);

      const isToday = date.getDate() === today.getDate() &&
                      date.getMonth() === today.getMonth() &&
                      date.getFullYear() === today.getFullYear();

      const isSelected = date.getDate() === selectedDate.getDate() &&
                        date.getMonth() === selectedDate.getMonth() &&
                        date.getFullYear() === selectedDate.getFullYear();

      html += `<div class="modal-day ${isToday ? 'today' : ''} ${isSelected ? 'selected' : ''} ${hasEvents ? 'has-events' : ''}" data-date="${dateKey}">${day}</div>`;
    }

    // 翌月の日を追加
    const remainingDays = 42 - (firstDayOfWeek + daysInMonth); // 6週間分のグリッドを確保
    for (let day = 1; day <= remainingDays; day++) {
      html += `<div class="modal-day other-month">${day}</div>`;
    }

    modalCalendarGrid.innerHTML = html;

    // 日付クリックイベントの設定
    modalCalendarGrid.querySelectorAll('.modal-day:not(.other-month)').forEach(dayEl => {
      dayEl.addEventListener('click', function() {
        const dateKey = this.dataset.date;
        if (dateKey) {
          const [year, month, day] = dateKey.split('-').map(Number);
          currentDate = new Date(year, month - 1, day);
          updateDateDisplay();
          renderCalendar();
          hideModal();
        }
      });
    });
  }

  // モーダル内の月移動
  modalPrevMonth.addEventListener('click', function() {
    modalCurrentDate.setMonth(modalCurrentDate.getMonth() - 1);
    renderModalCalendar();
  });

  modalNextMonth.addEventListener('click', function() {
    modalCurrentDate.setMonth(modalCurrentDate.getMonth() + 1);
    renderModalCalendar();
  });

  // モーダルを閉じる
  modalClose.addEventListener('click', hideModal);

  // モーダル外クリックで閉じる
  calendarModal.addEventListener('click', function(e) {
    if (e.target === calendarModal) {
      hideModal();
    }
  });
  });
