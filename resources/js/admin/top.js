$(document).ready(function () {
  // 現在編集中のセル要素を保持する変数
  let currentCell = null;

  // 平日/土日切り替え
  $(".day-btn").on("click", function () {
    $(".day-btn").removeClass("active");
    $(this).addClass("active");

    const dayType = $(this).data("day");

    // 時間割表の切り替え
    $(".timetable-container").removeClass("active");
    if (dayType === "weekend") {
      $(".timetable-container.weekend").addClass("active");
    } else {
      $(".timetable-container.weekday").addClass("active");
    }
  });

  // シフト確定ボタン
  $("#confirm-shift").on("click", function () {
    const year = $(this).data("year");
    const month = $(this).data("month"); // 月を2桁にする
    const yearMonth = year + month;
    const dayType = $(".day-btn.active").data("day");
    var modal = $("#confirm-modal");
    var reserveButtons = $(".js-reservation-button");
    var cancelButton = $("#cancel-button");

    // modal.fadeIn();

    // cancelButton.on("click", function () {
    //   modal.fadeOut();
    // });

    // $(window).on("click", function (event) {
    //   if ($(event.target).is(modal)) {
    //     modal.hide();
    //   }
    // });

    fetch(`/admin/schedule/detail/`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json();
      })
      .then((data) => {
        console.log("Success:", data);
        alert("シフトを確定しました");
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  });

  // セルをクリックしたときのモーダル表示
  $(".timetable td").on("click", function () {
    // クリックされたセルを保存
    currentCell = $(this);
    // ヘッダーセルや時間セルはクリック対象外
    if ($(this).hasClass("time-cell") || $(this).parent().is("thead")) {
      return;
    }

    // クラスが「ジュニア」の場合、クリックイベントを発生させない
    if ($(this).find(".class").text().trim() === "ジュニア") {
      return;
    }

    // セルの情報を取得
    const time = currentCell.data("lesson-time");
    const timeRange = currentCell.data("time-range");
    const court = currentCell.closest("tr").find(".court-num").text().trim();
    let dayIndex = ""; // 曜日を取得（列のインデックスから計算）
    let days = []; // 曜日を取得（列のインデックスから計算）
    let day = ""; // インデックスに対応する曜日を取得
    // もしweekendクラスがあれば、weekendday-indexを取得
    if ($(this).data("weekendday-index")) {
      dayIndex = $(this).data("weekendday-index") - 1; // 最初の2列（時間とコート）を除く
      days = ["土", "日"];
    } else {
      dayIndex = $(this).data("weekday-index") - 1; // 最初の2列（時間とコート）を除く
      days = ["月", "火", "水", "木", "金"];
    }
    day = days[dayIndex]; // インデックスに対応する曜日を取得

    // クラスとコーチの情報を取得
    const classValue = $(this).find(".class").text().trim();
    const lessonId = $(this).data("lesson-id");
    const coachId = $(this).data("coach-id");

    // モーダルに値をセット
    $("#dayValue").text(day);
    $("#timeValue").text(time + " " + timeRange);
    $("#courtValue").text(court);

    // セレクトボックスの値をセット
    if (classValue === "レッスンなし") {
      $("#classSelect").val("レッスンなし");
      $("#coachSelect").prop("disabled", true);
      $("#coachHelperText").show();
    } else {
      $("#classSelect").val(lessonId);
      $("#coachSelect").prop("disabled", false);
      $("#coachSelect").val(coachId);
      $("#coachHelperText").hide();
    }

    // モーダルを表示
    $("#editModal").css("display", "flex");
  });

  // クラス選択時の処理
  $("#classSelect").on("change", function () {
    const selectedClass = $("#classSelect option:selected").text();

    if (selectedClass === "レッスンなし") {
      // レッスンなしの場合、コーチ選択を無効化
      $("#coachSelect").prop("disabled", true);
      $("#coachSelect").val("");
      $("#coachHelperText").show();
    } else {
      // それ以外の場合、コーチ選択を有効化
      $("#coachSelect").prop("disabled", false);
      $("#coachHelperText").hide();
    }
  });

  // モーダルを閉じる処理
  $("#closeModalBtn, #cancelBtn").on("click", function () {
    $("#editModal").hide();
  });

  // route関数の定義
  function route(id = null) {
    if (id) {
      return `/admin/schedule/${id}`;
    } else {
      return "/admin/schedule";
    }
  }
  function getMethod(lessonScheduleId, selectedCoachId) {
    if (lessonScheduleId && selectedCoachId === "") return "DELETE"; // コーチが選択されていない場合は削除
    if (!lessonScheduleId) return "POST"; // IDがない場合は新規作成
    return "PUT"; // 既存データの更新
  }

  // 保存ボタンの処理
  $("#saveBtn").on("click", function () {
    if (!currentCell) return;

    const selectedClass = $("#classSelect option:selected").text();
    const selectedClassId = $("#classSelect").val();
    const selectedCoach = $("#coachSelect option:selected").text();
    const selectedCoachId = $("#coachSelect").val();
    const year = $("#shift-year").text();
    const month = $("#shift-month").text().padStart(2, "0"); // 月を2桁にする
    const yearMonth = year + month;
    const weekDay = $("#dayValue").text();
    const timeSlotName = currentCell.data("lesson_time_slot_class_name");
    const timeSlotWeekdayType = currentCell.data(
      "lesson_time_slot_weekday_type"
    );
    const court = $("#courtValue").text();
    const lessonScheduleId = currentCell.data("lesson_schedule_id"); // 追加

    // セルの内容を更新
    if (selectedClass === "レッスンなし") {
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

    // セルのデータ属性を更新
    currentCell.data("lesson-id", selectedClassId);
    currentCell.data("coach-id", selectedCoachId);
    currentCell.data("lesson_schedule_id", lessonScheduleId);

    // モーダルを閉じる
    $("#editModal").hide();

    // データをバックエンドに送信
    const data = {
      lesson_master_id: selectedClassId,
      year_month: yearMonth,
      weekday: weekDay,
      court_num: court,
      staff_id: selectedCoachId,
      lesson_time_slot_name: timeSlotName,
      lesson_time_slot_weekday_type: timeSlotWeekdayType,
    };

    fetch(`${route(lessonScheduleId)}`, {
      method: getMethod(lessonScheduleId, selectedCoachId), // 修正
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      body: JSON.stringify(data),
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json();
      })
      .then((data) => {
        console.log("Success:", data);
        // data.data.idが存在するなら、新規作成時のIDを lesson_schedule_id にセット (追加)
        if (data.data.id) {
          currentCell.attr("data-lesson_schedule_id", data.data.id);
          currentCell.attr("data-lesson-id", data.data.lesson_master_id);
          currentCell.attr("data-coach-id", data.data.staff_id);
          console.log(currentCell.attr("data-lesson_schedule_id"));
          console.log(currentCell.attr("data-lesson-id"));
          console.log(currentCell.attr("data-coach-id"));
        } else {
          currentCell.attr("data-lesson-schedule-id", null);
          currentCell.attr("data-lesson-id", null);
          currentCell.attr("data-coach-id", null);
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  });

  // モーダル外をクリックしたときに閉じる
  $("#editModal").on("click", function (e) {
    if (e.target === this) {
      $(this).hide();
    }
  });
});
