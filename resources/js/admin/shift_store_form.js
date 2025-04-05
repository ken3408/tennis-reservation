$(document).ready(function () {
  // 状態管理
  const state = {
    lessonInfo: {
      isAvailable: "あり",
      cancelReason: "",
      level: $("#levelReadOnly").data("level"),
      coach: "",
      isSubstitute: false,
    },
    existingStudents: existingStudentsData || [],
    student: {
      id: null,
      num: null,
      name: "",
      level: "",
    },

    addedStudents: [],
    canceledStudents: [],
    searchTerm: "",
    searchResults: [],
    isSearching: false,
    maxCapacity: 8,
    isLevelEditable: false,
    tempLevel: "",
  };

  // 要素の参照を取得
  const elements = {
    lessonAvailability: $("#lessonAvailability"),
    cancelReasonGroup: $("#cancelReasonGroup"),
    cancelReason: $("#cancelReason"),
    levelEditButton: $("#levelEditButton"),
    levelEditActions: $("#levelEditActions"),
    levelCancelButton: $("#levelCancelButton"),
    levelConfirmButton: $("#levelConfirmButton"),
    levelReadOnly: $("#levelReadOnly"),
    levelSelect: $("#levelSelect"),
    levelDialog: $("#levelDialog"),
    levelChangeDescription: $("#levelChangeDescription"),
    dialogCancelButton: $("#dialogCancelButton"),
    dialogConfirmButton: $("#dialogConfirmButton"),
    coach: $("#coach"),
    isSubstitute: $("#isSubstitute"),
    currentCapacity: $("#currentCapacity"),
    maxCapacity: $("#maxCapacity"),
    editCapacity: $("#editCapacity"),
    existingStudentsContainer: $("#existingStudentsContainer"),
    existingStudentsTable: $("#existingStudentsTable"),
    existingStudentsBody: $("#existingStudentsBody"),
    emptyExistingStudents: $("#emptyExistingStudents"),
    addStudentButton: $("#addStudentButton"),
    searchCard: $("#searchCard"),
    searchInput: $("#searchInput"),
    clearSearchButton: $("#clearSearchButton"),
    searchResults: $("#searchResults"),
    searchResultsList: $("#searchResultsList"),
    noResults: $("#noResults"),
    addedStudentsContainer: $("#addedStudentsContainer"),
    addedStudentsTable: $("#addedStudentsTable"),
    addedStudentsBody: $("#addedStudentsBody"),
    emptyAddedStudents: $("#emptyAddedStudents"),
    canceledStudentsSection: $("#canceledStudentsSection"),
    canceledStudentsTable: $("#canceledStudentsTable"),
    canceledStudentsBody: $("#canceledStudentsBody"),
    backButton: $("#backButton"),
    lessonForm: $("#lessonForm"),
  };

  // --- ユーティリティ関数 ---
  // 現在の生徒数を計算
  function getCurrentStudentCount() {
    return (
      state.existingStudents.length -
      state.canceledStudents.length +
      state.addedStudents.length
    );
  }

  // --- 初期化処理 ---
  // 初期表示の設定
  function initializeDisplay() {
    elements.lessonAvailability.val(state.lessonInfo.isAvailable);
    elements.cancelReason.val(state.lessonInfo.cancelReason);
    elements.levelReadOnly.text(state.lessonInfo.level);
    elements.levelSelect.val(state.lessonInfo.level);
    elements.isSubstitute.prop("checked", state.lessonInfo.isSubstitute);

    toggleCancelReasonVisibility();
    updateExistingStudentsList();
    updateAddedStudentsList();
    updateCanceledStudentsList();
    updateCapacityDisplay();
  }

  // --- UI更新関数 ---
  // レッスン有無による中止理由の表示/非表示
  function toggleCancelReasonVisibility() {
    if (elements.lessonAvailability.val() === "なし") {
      elements.cancelReasonGroup.show();
    } else {
      elements.cancelReasonGroup.hide();
    }
  }

  // 既存生徒リストの更新
  function updateExistingStudentsList() {
    const filteredStudents = state.existingStudents.filter(
      (student) => !state.canceledStudents.some((s) => s.id === student.id)
    );

    if (filteredStudents.length > 0) {
      elements.existingStudentsBody.empty();

      filteredStudents.forEach((student) => {
        const row = $("<tr>");
        row.append($("<td>").text(student.num));
        row.append($("<td>").text(student.name));
        row.append($("<td>").text(student.level));
        const actionCell = $("<td>");
        const cancelButton = $("<button>")
          .addClass("button button-ghost button-icon")
          .attr("data-student-id", student.id)
          .attr("data-action", "cancel")
          .html(
            `
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M18 6 6 18"></path>
              <path d="m6 6 12 12"></path>
            </svg>
          `
          )
          .on("click", () => cancelStudent(student));
        actionCell.append(cancelButton);
        row.append(actionCell);
        elements.existingStudentsBody.append(row);
      });
    }
  }

  // 追加する生徒リストの更新
  function updateAddedStudentsList() {
    if (state.addedStudents.length > 0) {
      elements.addedStudentsTable.removeClass("hidden");
      elements.emptyAddedStudents.addClass("hidden");
      elements.addedStudentsBody.empty();

      state.addedStudents.forEach((student) => {
        const row = $("<tr>").addClass("bg-green-50");
        row.append($("<td>").text(student.student_number));
        row.append($("<td>").text(student.name));
        row.append(
          $("<td>").text(
            student.lesson_master ? student.lesson_master.name : "未設定"
          )
        );
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
          .on("click", () => removeAddedStudent(student.id));
        actionCell.append(removeButton);
        row.append(actionCell);
        elements.addedStudentsBody.append(row);
      });
    } else {
      elements.addedStudentsTable.addClass("hidden");
      elements.emptyAddedStudents.removeClass("hidden");
    }
  }

  // キャンセルする生徒リストの更新
  function updateCanceledStudentsList() {
    if (state.canceledStudents.length > 0) {
      elements.canceledStudentsSection.removeClass("hidden");

      elements.canceledStudentsBody.empty();

      state.canceledStudents.forEach((student) => {
        const row = $("<tr>").addClass("bg-red-50");
        row.append($("<td>").text(student.id));
        row.append($("<td>").text(student.name));
        row.append($("<td>").text(student.level));
        const actionCell = $("<td>");
        const restoreButton = $("<button>")
          .addClass("button button-ghost button-sm")
          .text("戻す")
          .on("click", () => uncancelStudent(student.id));
        actionCell.append(restoreButton);
        row.append(actionCell);
        elements.canceledStudentsBody.append(row);
      });
    } else {
      elements.canceledStudentsSection.addClass("hidden");
    }
  }

  // 検索結果の更新
  function updateSearchResults() {
    if (state.searchTerm.trim() === "") {
      state.searchResults = [];
      $("#searchResults").addClass("hidden");
      $("#noResults").addClass("hidden");
      return;
    }

    // サーバーから検索結果を取得
    $.ajax({
      url: "/api/students/search",
      method: "GET",
      data: { query: state.searchTerm },
      success: function (data) {
        state.searchResults = data;

        // 検索結果の表示
        if (state.searchResults.length > 0) {
          $("#searchResults").removeClass("hidden");
          $("#noResults").addClass("hidden");

          // 検索結果リストをクリア
          $("#searchResultsList").empty();

          // 検索結果の表示部分
          $.each(state.searchResults, function (index, student) {
            const listItem = $("<li>").addClass("student-item");

            const studentInfo = $("<div>").addClass("student-info");

            const nameSpan = $("<p>")
              .addClass("student-name")
              .html(
                `${student.name} <span class="student-id">(${student.student_number})</span>`
              );

            const levelSpan = $("<p>")
              .addClass("student-level")
              .text(
                `レベル: ${
                  student.lesson_master ? student.lesson_master.name : "未設定"
                }`
              );

            studentInfo.append(nameSpan, levelSpan);
            listItem.append(studentInfo);

            // 生徒項目全体をクリックできるようにする
            listItem.on("click", function () {
              if (state.existingStudents.length < state.maxCapacity) {
                addStudent(student);
              }
            });

            // 定員に達している場合は選択できないようにする
            if (state.existingStudents.length >= state.maxCapacity) {
              listItem.css("opacity", "0.5");
              listItem.css("cursor", "not-allowed");
            }

            $("#searchResultsList").append(listItem);
          });
        } else {
          $("#searchResults").addClass("hidden");
          $("#noResults").removeClass("hidden");
        }
      },
      error: function () {
        console.error("生徒データの取得に失敗しました");
      },
    });
  }

  // 定員表示の更新
  function updateCapacityDisplay() {
    const currentCount = getCurrentStudentCount();
    elements.currentCapacity.text(currentCount);
    elements.maxCapacity.text(state.maxCapacity);

    if (currentCount >= state.maxCapacity) {
      elements.currentCapacity.removeClass("available").addClass("full");
      elements.addStudentButton.prop("disabled", true);
    } else {
      elements.currentCapacity.removeClass("full").addClass("available");
      elements.addStudentButton.prop("disabled", false);
    }
  }

  // 生徒を追加
  function addStudent(student) {
    const isAlreadyExisting = state.existingStudents.some(
      (s) => s.id === student.id
    );
    const isAlreadyAdded = state.addedStudents.some((s) => s.id === student.id);

    if (isAlreadyExisting || isAlreadyAdded) {
      alert("この生徒は既に登録済み、または追加済みです。");
      return;
    }

    if (getCurrentStudentCount() < state.maxCapacity) {
      state.addedStudents.push(student);
      state.searchTerm = "";
      elements.searchInput.val("");
      toggleSearchCard(false);
      updateAddedStudentsList();
      updateCapacityDisplay();
    }
  }

  // 追加した生徒を削除
  function removeAddedStudent(studentId) {
    state.addedStudents = state.addedStudents.filter(
      (student) => student.id !== studentId
    );
    updateAddedStudentsList();
    updateCapacityDisplay();
  }

  // 既存の生徒をキャンセル
  function cancelStudent(student) {
    if (!state.canceledStudents.some((s) => s.id === student.id)) {
      state.canceledStudents.push(student);
      updateExistingStudentsList();
      updateCanceledStudentsList();
      updateCapacityDisplay();
    }
  }

  // キャンセルを戻す
  function uncancelStudent(studentId) {
    state.canceledStudents = state.canceledStudents.filter(
      (student) => student.id !== studentId
    );
    updateExistingStudentsList();
    updateCanceledStudentsList();
    updateCapacityDisplay();
  }

  // 検索カードの表示/非表示
  function toggleSearchCard(show) {
    state.isSearching = show;
    if (show) {
      elements.searchCard.removeClass("hidden");
      elements.searchInput.focus();
    } else {
      elements.searchCard.addClass("hidden");
      state.searchTerm = "";
      elements.searchInput.val("");
      updateSearchResults();
    }
  }

  // レベル編集モードの切り替え
  function toggleLevelEditMode(editable) {
    state.isLevelEditable = editable;
    if (editable) {
      elements.levelEditButton.addClass("hidden");
      elements.levelEditActions.removeClass("hidden");
      elements.levelReadOnly.addClass("hidden");
      elements.levelSelect.removeClass("hidden");
      elements.levelSelect.focus();
      state.tempLevel = state.lessonInfo.level;
      elements.levelSelect.val(state.tempLevel);
    } else {
      elements.levelEditButton.removeClass("hidden");
      elements.levelEditActions.addClass("hidden");
      elements.levelReadOnly.removeClass("hidden");
      elements.levelSelect.addClass("hidden");
    }
  }

  // レベル変更の確認ダイアログを表示
  function showLevelChangeDialog() {
    elements
      .levelChangeDescription.text(`レベルを「${state.lessonInfo.level}」から「${state.tempLevel}」に変更しますか？
レベルの変更は生徒の参加資格に影響する可能性があります。`);
    elements.levelDialog.removeClass("hidden");
  }

  // レベル変更を確定
  function confirmLevelChange() {
    state.lessonInfo.level = state.tempLevel;
    elements.levelReadOnly.text(state.lessonInfo.level);
    toggleLevelEditMode(false);
    elements.levelDialog.addClass("hidden");
  }

  // --- イベントリスナー ---
  function setupEventListeners() {
    elements.backButton.on("click", () => window.history.back());
    elements.lessonAvailability.on("change", () => {
      state.lessonInfo.isAvailable = elements.lessonAvailability.val();
      toggleCancelReasonVisibility();
    });
    elements.cancelReason.on("input", () => {
      state.lessonInfo.cancelReason = elements.cancelReason.val();
    });
    elements.levelEditButton.on("click", () => toggleLevelEditMode(true));
    elements.levelCancelButton.on("click", () => toggleLevelEditMode(false));
    elements.levelConfirmButton.on("click", () => {
      if (state.tempLevel !== state.lessonInfo.level) {
        showLevelChangeDialog();
      } else {
        toggleLevelEditMode(false);
      }
    });
    elements.levelSelect.on("change", () => {
      state.tempLevel = elements.levelSelect.val();
    });
    elements.dialogCancelButton.on("click", () => {
      elements.levelDialog.addClass("hidden");
    });
    elements.dialogConfirmButton.on("click", () => {
      confirmLevelChange();
    });
    elements.coach.on("change", () => {
      state.lessonInfo.coach = elements.coach.val();
    });
    elements.isSubstitute.on("change", () => {
      state.lessonInfo.isSubstitute = elements.isSubstitute.prop("checked");
    });
    elements.editCapacity.on("click", () => {
      const newCapacity = prompt(
        "最大受け入れ人数を入力してください",
        state.maxCapacity.toString()
      );
      if (newCapacity && !isNaN(parseInt(newCapacity))) {
        state.maxCapacity = parseInt(newCapacity);
        updateCapacityDisplay();
      }
    });
    elements.addStudentButton.on("click", () => {
      toggleSearchCard(!state.isSearching);
    });
    // 検索入力
    $("#searchInput").on("input", function () {
      state.searchTerm = $(this).val();
      updateSearchResults();
    });
    elements.clearSearchButton.on("click", () => {
      state.searchTerm = "";
      elements.searchInput.val("");
      updateSearchResults();
    });
    elements.lessonForm.on("submit", (e) => {
      e.preventDefault();
      console.log("保存されたレッスン情報:", {
        ...state.lessonInfo,
        existingStudents: state.existingStudents,
        addedStudents: state.addedStudents,
        canceledStudents: state.canceledStudents,
      });
      // alert("レッスン情報が保存されました");
    });
    elements.existingStudentsBody.on(
      "click",
      ".cancel-student-button",
      function () {
        let student = state.student;
        student.id = $(this).data("student-id");
        student.num = $(this).data("student-num");
        student.name = $(this).data("student-num");
        student.level = $(this).data("student-level");
        if (student) {
          cancelStudent(student);
        }
      }
    );
  }

  // --- アプリケーションの初期化 ---
  function initialize() {
    initializeDisplay();
    setupEventListeners();
  }

  // アプリケーションの初期化
  initialize();
});
