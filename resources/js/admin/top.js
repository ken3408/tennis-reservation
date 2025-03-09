// データ定義
const classCodes = ['A', 'B', 'C', 'D', 'E', 'F'];
const courtNumbers = [1, 2, 3, 4];
const weekdays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'];
const weekends = ['saturday', 'sunday'];

const dayOfWeekJapanese = {
  monday: '月',
  tuesday: '火',
  wednesday: '水',
  thursday: '木',
  friday: '金',
  saturday: '土',
  sunday: '日'
};

// 初期データ
let teachers = [
  {
    id: '1',
    name: '山田 太郎',
    position: '国語'
  },
  {
    id: '2',
    name: '佐藤 花子',
    position: '数学'
  },
  {
    id: '3',
    name: '鈴木 一郎',
    position: '英語'
  },
  {
    id: '4',
    name: '高橋 美咲',
    position: '理科'
  }
];

let classSchedules = [
  // Aクラスの初期データ
  {
    id: '1',
    teacherId: '1',
    dayOfWeek: 'monday',
    classCode: 'A',
    className: '初級',
    courtNumber: 1
  },
  {
    id: '2',
    teacherId: '2',
    dayOfWeek: 'monday',
    classCode: 'A',
    className: '中級',
    courtNumber: 2
  },
  // 他のスケジュールも同様に追加可能
];

// DOM要素
const tabButtons = document.querySelectorAll('.tab-button');
const tabContents = document.querySelectorAll('.tab-content');
const dayTypeButtons = document.querySelectorAll('.day-type-button');
const timetableTable = document.getElementById('timetable');
const teacherList = document.getElementById('teacher-list');
const addTeacherButton = document.getElementById('add-teacher-button');

// モーダル要素
const scheduleModal = document.getElementById('schedule-modal');
const modalTitle = document.getElementById('modal-title');
const levelInput = document.getElementById('level-input');
const teacherSelect = document.getElementById('teacher-select');
const cancelButton = document.getElementById('cancel-button');
const saveButton = document.getElementById('save-button');
const closeButtons = document.querySelectorAll('.close-button');

const teacherModal = document.getElementById('teacher-modal');
const teacherModalTitle = document.getElementById('teacher-modal-title');
const teacherNameInput = document.getElementById('teacher-name-input');
const teacherPositionInput = document.getElementById('teacher-position-input');
const teacherCancelButton = document.getElementById('teacher-cancel-button');
const teacherSaveButton = document.getElementById('teacher-save-button');

// 現在の状態
let currentDayType = 'weekday';
let selectedDay = null;
let selectedClass = null;
let selectedCourtNumber = null;
let editingTeacherId = null;

// 初期化
document.addEventListener('DOMContentLoaded', () => {
  setupEventListeners();
  renderTimetable();
  renderTeacherList();
});

// イベントリスナーの設定
function setupEventListeners() {
  // タブ切り替え
  tabButtons.forEach((button, index) => {
    button.addEventListener('click', () => {
      tabButtons.forEach(btn => btn.classList.remove('active'));
      tabContents.forEach(content => content.classList.remove('active'));
      button.classList.add('active');
      tabContents[index].classList.add('active');
    });
  });

  // 曜日タイプ切り替え
  dayTypeButtons.forEach(button => {
    button.addEventListener('click', () => {
      dayTypeButtons.forEach(btn => btn.classList.remove('active'));
      button.classList.add('active');
      currentDayType = button.textContent === '平日' ? 'weekday' : 'weekend';
      renderTimetable();
    });
  });

  // モーダル操作
  cancelButton.addEventListener('click', closeScheduleModal);
  saveButton.addEventListener('click', saveSchedule);

  closeButtons.forEach(button => {
    button.addEventListener('click', () => {
      scheduleModal.style.display = 'none';
      teacherModal.style.display = 'none';
    });
  });

  // 講師追加ボタン
  addTeacherButton.addEventListener('click', () => openTeacherModal());

  teacherCancelButton.addEventListener('click', closeTeacherModal);
  teacherSaveButton.addEventListener('click', saveTeacher);

  // モーダル外クリックで閉じる
  window.addEventListener('click', (event) => {
    if (event.target === scheduleModal) closeScheduleModal();
    if (event.target === teacherModal) closeTeacherModal();
  });
}

// 時間割表の描画
function renderTimetable() {
  const days = currentDayType === 'weekday' ? weekdays : weekends;
  timetableTable.innerHTML = '';

  // ヘッダー行1（時間、コート、曜日）
  const headerRow1 = document.createElement('tr');

  const timeHeader = document.createElement('th');
  timeHeader.textContent = '時間';
  timeHeader.rowSpan = 2;
  headerRow1.appendChild(timeHeader);

  const courtHeader = document.createElement('th');
  courtHeader.textContent = 'コート';
  courtHeader.rowSpan = 2;
  headerRow1.appendChild(courtHeader);

  days.forEach(day => {
    const dayHeader = document.createElement('th');
    dayHeader.textContent = dayOfWeekJapanese[day];
    dayHeader.colSpan = 2;
    headerRow1.appendChild(dayHeader);
  });

  timetableTable.appendChild(headerRow1);

  // ヘッダー行2（担当クラス、担当コーチ）
  const headerRow2 = document.createElement('tr');

  days.forEach(() => {
    const classHeader = document.createElement('th');
    classHeader.textContent = '担当クラス';
    headerRow2.appendChild(classHeader);

    const teacherHeader = document.createElement('th');
    teacherHeader.textContent = '担当コーチ';
    headerRow2.appendChild(teacherHeader);
  });

  timetableTable.appendChild(headerRow2);

  // データ行
  classCodes.forEach(code => {
    courtNumbers.forEach((courtNumber, courtIndex) => {
      const row = document.createElement('tr');

      // 時間セル（最初のコートの行のみ）
      if (courtIndex === 0) {
        const timeCell = document.createElement('td');
        timeCell.className = 'time-cell';
        timeCell.textContent = code;
        timeCell.rowSpan = 4;
        row.appendChild(timeCell);
      }

      // コート番号セル
      const courtCell = document.createElement('td');
      courtCell.className = 'court-cell';
      courtCell.textContent = courtNumber;
      row.appendChild(courtCell);

      // 各曜日のセル
      days.forEach(day => {
        const schedule = getSchedule(day, code, courtNumber);

        // 担当クラスセル
        const classCell = document.createElement('td');
        classCell.textContent = schedule ? schedule.className || '' : '';
        classCell.addEventListener('click', () => {
          openScheduleModal(day, code, courtNumber);
        });
        row.appendChild(classCell);

        // 担当コーチセル
        const teacherCell = document.createElement('td');
        teacherCell.textContent = schedule ? getTeacherName(schedule.teacherId) : '';
        teacherCell.addEventListener('click', () => {
          openScheduleModal(day, code, courtNumber);
        });
        row.appendChild(teacherCell);
      });

      timetableTable.appendChild(row);
    });
  });
}

// 講師リストの描画
function renderTeacherList() {
  teacherList.innerHTML = '';

  teachers.forEach(teacher => {
    const row = document.createElement('tr');

    const nameCell = document.createElement('td');
    nameCell.textContent = teacher.name;
    row.appendChild(nameCell);

    const positionCell = document.createElement('td');
    positionCell.textContent = teacher.position;
    row.appendChild(positionCell);

    const actionsCell = document.createElement('td');
    const actionsDiv = document.createElement('div');
    actionsDiv.className = 'action-buttons';

    const editButton = document.createElement('button');
    editButton.className = 'button small';
    editButton.textContent = '編集';
    editButton.addEventListener('click', () => openTeacherModal(teacher));
    actionsDiv.appendChild(editButton);

    const deleteButton = document.createElement('button');
    deleteButton.className = 'button small';
    deleteButton.textContent = '削除';
    deleteButton.addEventListener('click', () => deleteTeacher(teacher.id));
    actionsDiv.appendChild(deleteButton);

    actionsCell.appendChild(actionsDiv);
    row.appendChild(actionsCell);

    teacherList.appendChild(row);
  });
}

// スケジュールモーダルを開く
function openScheduleModal(day, classCode, courtNumber) {
  selectedDay = day;
  selectedClass = classCode;
  selectedCourtNumber = courtNumber;

  const schedule = getSchedule(day, classCode, courtNumber);

  modalTitle.textContent = `${dayOfWeekJapanese[day]} ${classCode}クラス コート${courtNumber}の設定`;
  levelInput.value = schedule ? schedule.className || '' : '';

  // 講師選択肢を更新
  teacherSelect.innerHTML = '<option value="none">未設定</option>';
  teachers.forEach(teacher => {
    const option = document.createElement('option');
    option.value = teacher.id;
    option.textContent = teacher.name;
    teacherSelect.appendChild(option);
  });

  teacherSelect.value = schedule && schedule.teacherId ? schedule.teacherId : 'none';

  scheduleModal.style.display = 'block';
}

// スケジュールモーダルを閉じる
function closeScheduleModal() {
  scheduleModal.style.display = 'none';
  selectedDay = null;
  selectedClass = null;
  selectedCourtNumber = null;
}

// スケジュールを保存
function saveSchedule() {
  if (!selectedDay || !selectedClass || !selectedCourtNumber) return;

  const teacherId = teacherSelect.value === 'none' ? '' : teacherSelect.value;
  const level = levelInput.value;

  const existingSchedule = getSchedule(selectedDay, selectedClass, selectedCourtNumber);

  if (existingSchedule) {
    // 既存のスケジュールを更新
    existingSchedule.teacherId = teacherId;
    existingSchedule.className = level;
  } else if (teacherId || level) {
    // 新しいスケジュールを作成
    const newSchedule = {
      id: generateId(),
      teacherId,
      dayOfWeek: selectedDay,
      classCode: selectedClass,
      className: level,
      courtNumber: selectedCourtNumber
    };

    classSchedules.push(newSchedule);
  }

  renderTimetable();
  closeScheduleModal();
}

// 講師モーダルを開く
function openTeacherModal(teacher = null) {
  editingTeacherId = teacher ? teacher.id : null;

  teacherModalTitle.textContent = teacher ? '講師編集' : '講師追加';
  teacherNameInput.value = teacher ? teacher.name : '';
  teacherPositionInput.value = teacher ? teacher.position : '国語';

  teacherModal.style.display = 'block';
}

// 講師モーダルを閉じる
function closeTeacherModal() {
  teacherModal.style.display = 'none';
  editingTeacherId = null;
}

// 講師を保存
function saveTeacher() {
  const name = teacherNameInput.value.trim();
  const position = teacherPositionInput.value;

  if (!name) return;

  if (editingTeacherId) {
    // 既存の講師を更新
    const teacherIndex = teachers.findIndex(t => t.id === editingTeacherId);
    if (teacherIndex !== -1) {
      teachers[teacherIndex].name = name;
      teachers[teacherIndex].position = position;
    }
  } else {
    // 新しい講師を追加
    const newTeacher = {
      id: generateId(),
      name,
      position
    };

    teachers.push(newTeacher);
  }

  renderTeacherList();
  renderTimetable();
  closeTeacherModal();
}

// 講師を削除
function deleteTeacher(id) {
  if (!confirm('この講師を削除してもよろしいですか？関連するスケジュールも削除されます。')) return;

  teachers = teachers.filter(teacher => teacher.id !== id);
  classSchedules = classSchedules.filter(schedule => schedule.teacherId !== id);

  renderTeacherList();
  renderTimetable();
}

// ヘルパー関数
function getSchedule(day, classCode, courtNumber) {
  return classSchedules.find(s =>
    s.dayOfWeek === day &&
    s.classCode === classCode &&
    s.courtNumber === courtNumber
  );
}

function getTeacherName(teacherId) {
  const teacher = teachers.find(t => t.id === teacherId);
  return teacher ? teacher.name : '';
}

function generateId() {
  return Math.random().toString(36).substring(2, 9);
}
