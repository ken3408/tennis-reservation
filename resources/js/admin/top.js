$(document).ready(function() {
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
    // セルをクリックしたときの編集機能
    $('.timetable td').on('click', function() {
        // ヘッダーセルや時間セルはクリック対象外
        if ($(this).hasClass('time-cell') || $(this).parent().is('thead')) {
            return;
        }

        const courseCell = $(this);
        const currentCoach = courseCell.find('.coach').text().trim();

        // 簡易的な編集機能（実際のアプリではモーダルやフォームを使用）
        const newCoach = prompt('担当コーチ名を入力してください:', currentCoach);

        if (newCoach !== null) {
            courseCell.find('.coach').text(newCoach);
        }
    });
});
