$(document).ready(function() {
    // 現在編集中のセル要素を保持する変数
    let currentCell = null;

    // 平日/土日切り替え
    $('.day-btn').on('click', function() {
        $('.day-btn').removeClass('active');
        $(this).addClass('active');

        const dayType = $(this).data('day');

        // 時間割表の切り替え
        $('.timetable-container').removeClass('active');
        if (dayType === 'weekend') {
            $('.timetable-container.weekend').addClass('active');
        } else {
            $('.timetable-container.weekday').addClass('active');
        }
    });

    // セルをクリックしたときのモーダル表示
    $('.timetable td').on('click', function() {
        // ヘッダーセルや時間セルはクリック対象外
        if ($(this).hasClass('time-cell') || $(this).parent().is('thead')) {
            return;
        }

        // クリックされたセルを保存
        currentCell = $(this);

        // セルの情報を取得
        const timeCell = $(this).closest('tr').find('.time-cell');
        const time = timeCell.contents().first().text().trim();
        const timeRange = timeCell.find('.text-xs').text().trim();
        const court = $(this).closest('tr').find('td:nth-child(2)').text().trim();

        // // 年と月の情報を取得して設定
        // const year = $('#shift-year').text();
        // const month = $('#shift-month').text();
        // $('#yearMonth').text(`${year}年${month}月`);

        // 曜日を取得（列のインデックスから計算）
        const dayIndex = $(this).index() - 1; // 最初の2列（時間とコート）を除く
        const days = ['月', '火', '水', '木', '金'];
        const day = days[dayIndex - 1]; // -1 は時間列とコート列の分

        // クラスとコーチの情報を取得
        const classValue = $(this).find('.class').text().trim();
        const coachValue = $(this).find('.coach').text().trim();

        // モーダルに値をセット
        $('#dayValue').text(day);
        $('#timeValue').text(time + ' ' + timeRange);
        $('#courtValue').text(court);

        // セレクトボックスの値をセット
        if (classValue === 'レッスンなし') {
            $('#classSelect').val('レッスンなし');
            $('#coachSelect').prop('disabled', true);
            $('#coachHelperText').show();
        } else {
            $('#classSelect').val(classValue === '担当クラス' ? '初級' : classValue);
            $('#coachSelect').prop('disabled', false);
            $('#coachSelect').val(coachValue);
            $('#coachHelperText').hide();
        }

        // モーダルを表示
        $('#editModal').css('display', 'flex');
    });

    // クラス選択時の処理
    $('#classSelect').on('change', function() {
        const selectedClass = $(this).val();

        if (selectedClass === 'レッスンなし') {
            // レッスンなしの場合、コーチ選択を無効化
            $('#coachSelect').prop('disabled', true);
            $('#coachSelect').val('');
            $('#coachHelperText').show();
        } else {
            // それ以外の場合、コーチ選択を有効化
            $('#coachSelect').prop('disabled', false);
            $('#coachHelperText').hide();
        }
    });

    // モーダルを閉じる処理
    $('#closeModalBtn, #cancelBtn').on('click', function() {
        $('#editModal').hide();
    });

    // route関数の定義
    function route(name) {
        const routes = {
            'admin.schedule.store': '/admin/schedule/store'
        };
        return routes[name];
    }

    // 保存ボタンの処理
    $('#saveBtn').on('click', function() {
        if (!currentCell) return;

        const selectedClass = $('#classSelect').val();
        const selectedCoach = $('#coachSelect').val();
        const year = $('#shift-year').text();
        const month = $('#shift-month').text().padStart(2, '0'); // 月を2桁にする
        const yearMonth = year + month;
        const week_day = $('#dayValue').text();
        const time = $('#timeValue').text();
        const court = $('#courtValue').text();

        // セルの内容を更新
        if (selectedClass === 'レッスンなし') {
            // レッスンなしの場合、クラス名のみ表示
            currentCell.html(`
                <div class="class">${selectedClass}</div>
            `);
        } else {
            // 通常の場合、クラスとコーチを表示
            currentCell.html(`
                <div class="class">${selectedClass}</div>
                <div class="coach">${selectedCoach}</div>
            `);
        }

        // モーダルを閉じる
        $('#editModal').hide();

        // データをバックエンドに送信
        const data = {
            yearMonth,
            week_day,
            time,
            court,
            class: selectedClass,
            coach: selectedCoach
        };

        fetch(`${route('admin.schedule.store')}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Success:', data);
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    });

    // モーダル外をクリックしたときに閉じる
    $('#editModal').on('click', function(e) {
        if (e.target === this) {
            $(this).hide();
        }
    });
});
