$(document).ready(function () {
  // サンプルデータ
  const SAMPLE_STUDENTS = [
    { id: "S001", name: "伊藤健太", level: "初級" },
    { id: "S002", name: "中村美咲", level: "初中級" },
    { id: "S003", name: "小林大輔", level: "中級" },
    { id: "S004", name: "加藤由美", level: "初級" },
    { id: "S005", name: "渡辺隆", level: "上級" },
    { id: "S006", name: "松本さくら", level: "中上級" },
    { id: "S007", name: "井上拓也", level: "初中級" },
    { id: "S008", name: "木村真理", level: "中級" },
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
      isSubstitute: false,
    },
    students: [],
    searchTerm: "",
    searchResults: [],
    isSearching: false,
    maxCapacity: 8,
    isLevelEditable: false,
    tempLevel: "初級",
  };

  // タイムスロットの表示形式を整形
  function formatTimeSlot(timeSlot) {
    const match = timeSlot.match(/([A-Z])時間帯（(.+)）/);
    if (match && match.length >= 3) {
      return `${match[1]} ${match[2]}`;
    }
    return timeSlot;
  }

  // 初期表示の設定
  function initializeDisplay() {
    $("#lessonDate").text(state.lessonInfo.date);
    $("#lessonTimeSlot").text(formatTimeSlot(state.lessonInfo.timeSlot));
    $("#lessonCourt").text(state.lessonInfo.court);
    $("#lessonAvailability").val(state.lessonInfo.isAvailable);
    $("#cancelReason").val(state.lessonInfo.cancelReason);
    $("#levelReadOnly").text(state.lessonInfo.level);
    $("#levelSelect").val(state.lessonInfo.level);
    $("#coach").val(state.lessonInfo.coach);
    $("#isSubstitute").prop("checked", state.lessonInfo.isSubstitute);

    // レッスン有無による中止理由の表示/非表示
    toggleCancelReasonVisibility();

    // 生徒一覧の表示
    updateStudentList();
    updateCapacityDisplay();
  }

  // レッスン有無による中止理由の表示/非表示
  function toggleCancelReasonVisibility() {
    if ($("#lessonAvailability").val() === "なし") {
      $("#cancelReasonGroup").show();
    } else {
      $("#cancelReasonGroup").hide();
    }
  }

  // 生徒一覧の更新
  function updateStudentList() {
    if (state.students.length > 0) {
      $("#studentTable").removeClass("hidden");
      $("#emptyStudentList").addClass("hidden");

      // テーブルの内容をクリア
      $("#studentTableBody").empty();

      // 生徒リストを表示
      $.each(state.students, function (index, student) {
        const row = $("<tr>");

        $("<td>").text(student.id).appendTo(row);
        $("<td>").text(student.name).appendTo(row);
        $("<td>").text(student.level).appendTo(row);

        const actionCell = $("<td>");
        const removeButton = $("<button>")
          .addClass("button button-ghost button-icon")
          .html(
            `
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 6 6 18"></path>
                <path d="m6 6 12 12"></path>
              </svg>
              `
          )
          .on("click", function () {
            removeStudent(student.id);
          });

        actionCell.append(removeButton);
        row.append(actionCell);

        $("#studentTableBody").append(row);
      });
    } else {
      $("#studentTable").addClass("hidden");
      $("#emptyStudentList").removeClass("hidden");
    }
  }

  // 生徒を追加
  function addStudent(student) {
    if (
      !state.students.some((s) => s.id === student.id) &&
      state.students.length < state.maxCapacity
    ) {
      state.students.push(student);
      updateStudentList();
      updateCapacityDisplay();

      // 検索をリセット
      state.searchTerm = "";
      $("#searchInput").val("");
      toggleSearchCard(false);
    }
  }

  // 生徒を削除
  function removeStudent(studentId) {
    state.students = state.students.filter(
      (student) => student.id !== studentId
    );
    updateStudentList();
    updateCapacityDisplay();
  }

  // 検索結果の更新
  function updateSearchResults() {
    if (state.searchTerm.trim() === "") {
      state.searchResults = [];
      $("#searchResults").addClass("hidden");
      $("#noResults").addClass("hidden");
      return;
    }

    state.searchResults = SAMPLE_STUDENTS.filter(
      (student) =>
        student.id.toLowerCase().includes(state.searchTerm.toLowerCase()) ||
        student.name.includes(state.searchTerm)
    );

    // 検索結果の表示
    if (state.searchResults.length > 0) {
      $("#searchResults").removeClass("hidden");
      $("#noResults").addClass("hidden");

      // 検索結果リストをクリア
      $("#searchResultsList").empty();

      // 検索結果を表示
      $.each(state.searchResults, function (index, student) {
        const listItem = $("<li>").addClass("student-item");

        const studentInfo = $("<div>").addClass("student-info");

        const nameSpan = $("<p>")
          .addClass("student-name")
          .html(
            `${student.name} <span class="student-id">(${student.id})</span>`
          );

        const levelSpan = $("<p>")
          .addClass("student-level")
          .text(`レベル: ${student.level}`);

        studentInfo.append(nameSpan, levelSpan);
        listItem.append(studentInfo);

        // 生徒項目全体をクリックできるようにする
        listItem.on("click", function () {
          if (state.students.length < state.maxCapacity) {
            addStudent(student);
          }
        });

        // 定員に達している場合は選択できないようにする
        if (state.students.length >= state.maxCapacity) {
          listItem.css("opacity", "0.5");
          listItem.css("cursor", "not-allowed");
        }

        $("#searchResultsList").append(listItem);
      });
    } else {
      $("#searchResults").addClass("hidden");
      $("#noResults").removeClass("hidden");
    }
  }

  // 検索カードの表示/非表示
  function toggleSearchCard(show) {
    state.isSearching = show;
    if (show) {
      $("#searchCard").removeClass("hidden");
      $("#searchInput").focus();
    } else {
      $("#searchCard").addClass("hidden");
      state.searchTerm = "";
      $("#searchInput").val("");
      updateSearchResults();
    }
  }

  // 定員表示の更新
  function updateCapacityDisplay() {
    $("#currentCapacity").text(state.students.length);
    $("#maxCapacity").text(state.maxCapacity);

    if (state.students.length >= state.maxCapacity) {
      $("#currentCapacity").removeClass("available").addClass("full");
      $("#addStudentButton, #emptyAddButton").prop("disabled", true);
    } else {
      $("#currentCapacity").removeClass("full").addClass("available");
      $("#addStudentButton, #emptyAddButton").prop("disabled", false);
    }
  }

  // レベル編集モードの切り替え
  function toggleLevelEditMode(editable) {
    state.isLevelEditable = editable;
    if (editable) {
      $("#levelEditButton").addClass("hidden");
      $("#levelEditActions").removeClass("hidden");
      $("#levelReadOnly").addClass("hidden");
      $("#levelSelect").removeClass("hidden").focus();
      state.tempLevel = state.lessonInfo.level;
      $("#levelSelect").val(state.tempLevel);
    } else {
      $("#levelEditButton").removeClass("hidden");
      $("#levelEditActions").addClass("hidden");
      $("#levelReadOnly").removeClass("hidden");
      $("#levelSelect").addClass("hidden");
    }
  }

  // レベル変更の確認ダイアログを表示
  function showLevelChangeDialog() {
    $(
      "#levelChangeDescription"
    ).text(`レベルを「${state.lessonInfo.level}」から「${state.tempLevel}」に変更しますか？
レベルの変更は生徒の参加資格に影響する可能性があります。`);
    $("#levelDialog").removeClass("hidden");
  }

  // レベル変更を確定
  function confirmLevelChange() {
    state.lessonInfo.level = state.tempLevel;
    $("#levelReadOnly").text(state.lessonInfo.level);
    toggleLevelEditMode(false);
    $("#levelDialog").addClass("hidden");
  }

  // 保存完了メッセージを表示
  function showSaveSuccessMessage() {
    $("#saveSuccessMessage").removeClass("hidden");
  }

  // イベントリスナーの設定
  function setupEventListeners() {
    // 戻るボタン
    $("#backButton").on("click", function () {
      window.history.back();
    });

    // レッスン有無の変更
    $("#lessonAvailability").on("change", function () {
      state.lessonInfo.isAvailable = $(this).val();
      toggleCancelReasonVisibility();
    });

    // 中止理由の変更
    $("#cancelReason").on("input", function () {
      state.lessonInfo.cancelReason = $(this).val();
    });

    // レベル編集ボタン
    $("#levelEditButton").on("click", function () {
      toggleLevelEditMode(true);
    });

    // レベル編集キャンセルボタン
    $("#levelCancelButton").on("click", function () {
      toggleLevelEditMode(false);
    });

    // レベル編集確定ボタン
    $("#levelConfirmButton").on("click", function () {
      if (state.tempLevel !== state.lessonInfo.level) {
        showLevelChangeDialog();
      } else {
        toggleLevelEditMode(false);
      }
    });

    // レベル選択の変更
    $("#levelSelect").on("change", function () {
      state.tempLevel = $(this).val();
    });

    // ダイアログのキャンセルボタン
    $("#dialogCancelButton").on("click", function () {
      $("#levelDialog").addClass("hidden");
    });

    // ダイアログの確定ボタン
    $("#dialogConfirmButton").on("click", function () {
      confirmLevelChange();
    });

    // コーチの変更
    $("#coach").on("change", function () {
      state.lessonInfo.coach = $(this).val();
    });

    // 代行コーチのチェック
    $("#isSubstitute").on("change", function () {
      state.lessonInfo.isSubstitute = $(this).prop("checked");
    });

    // 最大人数の編集
    $("#editCapacity").on("click", function () {
      const newCapacity = prompt(
        "最大受け入れ人数を入力してください",
        state.maxCapacity.toString()
      );
      if (newCapacity && !isNaN(parseInt(newCapacity))) {
        state.maxCapacity = parseInt(newCapacity);
        updateCapacityDisplay();
      }
    });

    // 生徒追加ボタン
    $("#addStudentButton").on("click", function () {
      toggleSearchCard(!state.isSearching);
    });

    // 空の状態からの生徒追加ボタン
    $("#emptyAddButton").on("click", function () {
      toggleSearchCard(true);
    });

    // 検索入力
    $("#searchInput").on("input", function () {
      state.searchTerm = $(this).val();
      updateSearchResults();
    });

    // 検索クリアボタン
    $("#clearSearchButton").on("click", function () {
      state.searchTerm = "";
      $("#searchInput").val("");
      updateSearchResults();
    });

    // 保存完了メッセージのOKボタン
    $("#saveSuccessOkButton").on("click", function () {
      $("#saveSuccessMessage").addClass("hidden");
    });

    // フォーム送信
    $("#lessonForm").on("submit", function (e) {
      e.preventDefault();
      console.log("保存されたレッスン情報:", {
        ...state.lessonInfo,
        students: state.students,
      });
      showSaveSuccessMessage();
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
