$(function() {
    // 現在の日付
    let currentDate = new Date(2025, 2, 7); // 2025年3月7日

    // モーダルカレンダーの現在の日付
    let modalCurrentDate = new Date(currentDate);

    // 予約データ
    const reservationData = {
      "2025-03-07": [
        { id: 1, time: "10:00-14:00", menu: "初級", type: "", isAvailable: true, price: 2000 },
        { id: 2, time: "11:00-13:00", menu: "中級", type: "", isAvailable: true, price: 3000 },
        { id: 3, time: "14:00-16:00", menu: "上級", type: "", isAvailable: true, price: 3000 },
      ],
      "2025-03-08": [
        { id: 4, time: "14:00-16:00", menu: "上級", type: "", isAvailable: true, price: 3000 },
      ],
      "2025-03-10": [
        { id: 5, time: "10:00-12:00", menu: "ジュニア", type: "", isAvailable: true, price: 2500 },
        { id: 6, time: "14:00-16:00", menu: "上級", type: "", isAvailable: false, price: 3000 },
      ],
      "2025-03-12": [
        { id: 7, time: "10:00-12:00", menu: "ジュニア", type: "", isAvailable: true, price: 2500 },
        { id: 8, time: "11:00-13:00", menu: "中級", type: "", isAvailable: true, price: 3000 },
      ],
      "2025-03-13": [
        { id: 9, time: "10:00-14:00", menu: "初級", type: "", isAvailable: true, price: 2000 },
        { id: 10, time: "14:00-16:00", menu: "上級", type: "", isAvailable: false, price: 3000 },
      ],
      "2025-03-15": [
        { id: 11, time: "10:00-14:00", menu: "初級", type: "", isAvailable: true, price: 2000 },
      ],
      "2025-03-20": [
        { id: 12, time: "10:00-12:00", menu: "ジュニア", type: "", isAvailable: true, price: 2500 },
      ],
      "2025-03-21": [
        { id: 13, time: "10:00-14:00", menu: "初級", type: "", isAvailable: true, price: 2000 },
        { id: 14, time: "14:00-16:00", menu: "上級", type: "", isAvailable: true, price: 3000 },
      ],
      "2025-03-22": [
        { id: 15, time: "14:00-16:00", menu: "上級", type: "", isAvailable: true, price: 3000 },
      ],
      "2025-03-28": [
        { id: 16, time: "10:00-14:00", menu: "初級", type: "", isAvailable: true, price: 2000 },
      ],
    };

    // 日付フォーマット関数
    function formatDate(date) {
      return `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}-${String(date.getDate()).padStart(2, '0')}`;
    }

    // 日付表示の更新
    function updateDateDisplay() {
      // 週の開始日と終了日を計算
      const weekStart = getWeekStart(currentDate);
      const weekEnd = new Date(weekStart);
      weekEnd.setDate(weekStart.getDate() + 6);

      $('#current-date').html(`${weekStart.getFullYear()}年${weekStart.getMonth() + 1}月${weekStart.getDate()}日 ～
        ${weekEnd.getFullYear()}年${weekEnd.getMonth() + 1}月${weekEnd.getDate()}日
        <button class="calendar-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
            <line x1="16" y1="2" x2="16" y2="6"></line>
            <line x1="8" y1="2" x2="8" y2="6"></line>
            <line x1="3" y1="10" x2="21" y2="10"></line>
          </svg>
        </button>`);
    }

    // 週の開始日（日曜日）を取得
    function getWeekStart(date) {
      const result = new Date(date);
      const day = result.getDay();
      result.setDate(result.getDate() - day);
      return result;
    }

    // 前へ/次へボタンの処理
    function navigate(direction) {
      // 週単位で移動
      currentDate.setDate(currentDate.getDate() + (7 * direction));
      updateDateDisplay();
      renderCalendar();
    }

    // カレンダーの描画（週表示のみ）
    function renderCalendar() {
      renderWeekView();
    }

    // 週表示の描画
    function renderWeekView() {
      // 週の開始日（日曜日）を取得
      const weekStart = getWeekStart(currentDate);

      // 曜日の配列
      const weekdays = ["日", "月", "火", "水", "木", "金", "土"];

      // 週表示のHTMLを生成
      let html = '<div class="week-grid">';

      // 週の各日を生成
      for (let i = 0; i < 7; i++) {
        const date = new Date(weekStart);
        date.setDate(weekStart.getDate() + i);
        const dateKey = formatDate(date);
        const dayReservations = reservationData[dateKey]?.filter(slot => slot.isAvailable) || [];

        html += `<div class="week-day">
          <div class="week-day-header ${i === 0 ? 'weekday-sun' : ''} ${i === 6 ? 'weekday-sat' : ''}">
            <div class="week-day-date">${date.getMonth() + 1}/${date.getDate()}</div>
            <div class="week-day-name">${weekdays[i]}</div>
          </div>
          <div class="week-day-content">`;

        if (dayReservations.length > 0) {
          dayReservations.forEach(slot => {
            let slotClass = '';
            if (slot.menu.includes('初級')) slotClass = 'time-slot-holiday';
            else if (slot.menu.includes('中級')) slotClass = 'time-slot-japanese';
            else if (slot.menu.includes('上級')) slotClass = 'time-slot-western';
            else if (slot.menu.includes('ジュニア')) slotClass = 'time-slot-basic';

            html += `<div class="time-slot ${slotClass}">
							<a href="" class="js-reserve">
								<div class="time-slot-time">${slot.time}</div>
								<div>${slot.menu}${slot.type}</div>
								<div class="availability-circle"></div>
							</a>
            </div>`;
          });
        } else {
          html += '<div class="no-reservations">空きなし</div>';
        }

        html += '</div></div>';
      }

      html += '</div>';
      $('#calendar-view').html(html);
    }

    // モーダルを表示
    function showModal() {
      // モーダルの日付を現在の週の日曜日がある月に設定
      modalCurrentDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
      $('#calendar-modal').addClass('show');
      renderModalCalendar();
    }

    // モーダルを非表示
    function hideModal() {
      $('#calendar-modal').removeClass('show');
    }

    // モーダルカレンダーの描画（月の予約情報を表示）
    function renderModalCalendar() {
      // 月の最初の日と最後の日を取得
      const firstDay = new Date(modalCurrentDate.getFullYear(), modalCurrentDate.getMonth(), 1);
      const lastDay = new Date(modalCurrentDate.getFullYear(), modalCurrentDate.getMonth() + 1, 0);

      // 月の最初の日の曜日（0: 日曜日, 1: 月曜日, ..., 6: 土曜日）
      const firstDayOfWeek = firstDay.getDay();

      // 月の日数
      const daysInMonth = lastDay.getDate();

      // モーダルの日付表示を更新
      $('#modal-current-date').text(`${modalCurrentDate.getFullYear()}年${modalCurrentDate.getMonth() + 1}月`);

      // カレンダーグリッドのHTML生成
      let html = '';

      // 前月の日を追加
      const prevMonth = new Date(modalCurrentDate.getFullYear(), modalCurrentDate.getMonth(), 0);
      const daysInPrevMonth = prevMonth.getDate();

      for (let i = 0; i < firstDayOfWeek; i++) {
        const day = daysInPrevMonth - firstDayOfWeek + i + 1;
        html += `<div class="modal-day other-month">
          <div class="modal-day-number">${day}</div>
        </div>`;
      }

      // 当月の日を追加
      const today = new Date();
      const weekStart = getWeekStart(currentDate);
      const weekEnd = new Date(weekStart);
      weekEnd.setDate(weekStart.getDate() + 6);

      for (let day = 1; day <= daysInMonth; day++) {
        const date = new Date(modalCurrentDate.getFullYear(), modalCurrentDate.getMonth(), day);
        const dateKey = formatDate(date);
        const dayReservations = reservationData[dateKey]?.filter(slot => slot.isAvailable) || [];

        const isToday = date.getDate() === today.getDate() &&
                        date.getMonth() === today.getMonth() &&
                        date.getFullYear() === today.getFullYear();

        // 現在表示されている週に含まれる日かどうか
        const isInCurrentWeek = date >= weekStart && date <= weekEnd;

        html += `<div class="modal-day ${isToday ? 'today' : ''} ${isInCurrentWeek ? 'selected' : ''}" data-date="${dateKey}">
          <div class="modal-day-number">${day}</div>
          <div class="modal-day-content">`;

        if (dayReservations.length > 0) {
          // 最大2つまで表示
          dayReservations.slice(0, 2).forEach(slot => {
            let slotClass = '';
            if (slot.menu.includes('休日')) slotClass = 'modal-time-slot-holiday';
            else if (slot.menu.includes('和食')) slotClass = 'modal-time-slot-japanese';
            else if (slot.menu.includes('洋食')) slotClass = 'modal-time-slot-western';
            else if (slot.menu.includes('基本')) slotClass = 'modal-time-slot-basic';

            html += `<div class="modal-time-slot ${slotClass}">
              <span>${slot.time}</span>
              <span class="availability-circle"></span>
            </div>`;
          });

          if (dayReservations.length > 2) {
            html += `<div class="modal-more-slots">他 ${dayReservations.length - 2} 件</div>`;
          }
        }

        html += `</div></div>`;
      }

      // 翌月の日を追加
      const daysToAdd = (Math.ceil((firstDayOfWeek + daysInMonth) / 7) * 7) - (firstDayOfWeek + daysInMonth);
      for (let day = 1; day <= daysToAdd; day++) {
        html += `<div class="modal-day other-month">
          <div class="modal-day-number">${day}</div>
        </div>`;
      }

      $('#modal-calendar-grid').html(html);

      // 日付クリックイベントの設定
      $('.modal-day:not(.other-month)').on('click', function() {
        const dateKey = $(this).data('date');
        if (dateKey) {
          const [year, month, day] = dateKey.split('-').map(Number);
          currentDate = new Date(year, month - 1, day);
          updateDateDisplay();
          renderCalendar();
          hideModal();
        }
      });
    }

    // イベントリスナーの設定
    $('#prev-btn').on('click', function() {
      navigate(-1);
    });

    $('#next-btn').on('click', function() {
      navigate(1);
    });

    // カレンダーアイコンのクリックイベント
    $(document).on('click', '.calendar-icon', function() {
      showModal();
    });

    // モーダル内の月移動
    $('#modal-prev-month').on('click', function() {
      modalCurrentDate.setMonth(modalCurrentDate.getMonth() - 1);
      renderModalCalendar();
    });

    $('#modal-next-month').on('click', function() {
      modalCurrentDate.setMonth(modalCurrentDate.getMonth() + 1);
      renderModalCalendar();
    });

    // モーダルを閉じる
    $('#modal-close').on('click', function() {
      hideModal();
    });

    // モーダル外クリックで閉じる
    $('#calendar-modal').on('click', function(e) {
      if (e.target === this) {
        hideModal();
      }
    });

    // 初期表示
    updateDateDisplay();
    renderCalendar();
  });
$(document).ready(function() {
    // モーダル要素
    const modal = $('#reservation-modal'); // モーダル本体
    const modalTime = $('.reservation-modal__value').eq(0); // 時間表示
    const modalClass = $('.reservation-modal__value').eq(1); // クラス表示
    const modalClose = $('#cancel-button'); // 閉じるボタン
    // const modalBackdrop = $('<div class="modal-backdrop"></div>'); // 背景（追加）

    // // 背景をbodyに追加（最初は非表示）
    // $('body').append(modalBackdrop);

    // 予約リンクをクリックしたときにモーダルを開く
    $(document).on('click', '.js-reserve', function(event) {
        event.preventDefault(); // デフォルトのリンク動作をキャンセル

        // クリックした要素の情報を取得
        let time = $(this).find('.time-slot-time').text();
        // let classType = $(this).find('div:nth-child(2)').text(); // 2番目の `<div>` にクラス情報が入っている
        let classType = $(this).find('.reservation-class').text();

        // モーダルにデータをセット
        modalTime.text(time);
        modalClass.text(classType);

        // モーダルを表示
        modal.fadeIn();
        // modalBackdrop.fadeIn();
    });

    // モーダルを閉じる
    modalClose.on('click', function() {
        modal.fadeOut();
        // modalBackdrop.fadeOut();
    });
    $(window).on('click', function(event) {
      if ($(event.target).is(modal)) {
          modal.fadeOut();
      }
    });

    // 背景をクリックしてモーダルを閉じる
    // modalBackdrop.on('click', function() {
    //     modal.fadeOut();
    //     modalBackdrop.fadeOut();
    // });
});
