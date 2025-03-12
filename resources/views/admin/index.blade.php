<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>管理画面</title>
  {{-- home.cssを読み込ませる  --}}
  @vite('resources/css/admin/top.css')
  {{-- jquery読み込ませる --}}
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  {{-- home.jsを読み込ませる  --}}
  @vite('resources/js/admin/top.js')
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
  <header>
    <div class="container">
      <h1><i class="calendar-icon"></i> シフト管理</h1>
      <div class="user-info">管理者: 管理太郎</div>
    </div>
  </header>

  <main class="container">
    <div class="tab-content" id="timetable">
      <h2>シフト表　{{ $year }}年{{ $month }}月
      </h2>

      <div class="day-toggle">
        <button class="day-btn active" data-day="weekday">平日</button>
        <button class="day-btn" data-day="weekend">土日</button>
      </div>
      <div class="timetable-container weekday active">
        <!-- 平日の時間割表 -->
        <table class="timetable">
          <thead>
            <tr>
              <th>時間</th>
              <th>コート</th>
              <th>月</th>
              <th>火</th>
              <th>水</th>
              <th>木</th>
              <th>金</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($scheduleData as $lessonTime => $times)
              @foreach ($times as $courtNum => $schedule)
                <tr>
                  @if ($loop->first)
                    <td rowspan="{{ count($times) }}" class="time-cell">
                      <!-- A -->
                      {{ explode(' ', $lessonTime)[0] }}
                      <!-- 10:30〜12:00 -->
                      <div class="text-xs text-muted-foreground">{{ explode(' ', $lessonTime)[1] }}</div>
                    </td>
                  @endif
                  <td class="court-num">{{ $courtNum }}</td>
                  <!-- 月曜日から金曜日 -->
                  @foreach (range(1, 5) as $day)
                    <td data-weekday-index="{{ $day }}"
                      data-lesson-id="{{ $schedule[$day][0]['lesson_id'] ?? '' }}"
                      data-coach-id="{{ $schedule[$day][1]['coach_id'] ?? '' }}"
                      data-lesson_time_slot_class_name="{{ explode(' ', $lessonTime)[0] }}"
                      data-lesson_time_slot_weekday_type="WEEKDAY"
                      data-lesson-time="{{ explode(' ', $lessonTime)[0] }}"
                      data-time-range="{{ explode(' ', $lessonTime)[1] }}">
                      @if (!empty($schedule[$day]))
                        @foreach ($schedule[$day] as $info)
                          @if (isset($info['class']))
                            {{-- レッスン名 --}}
                            <div class="class">{{ $info['class'] }}</div>
                          @endif
                          @if (isset($info['coach']))
                            {{-- コーチ名 --}}
                            <div class="coach">{{ $info['coach'] }}</div>
                          @endif
                        @endforeach
                      @else
                        <div class="class">レッスンなし</div>
                      @endif
                    </td>
                  @endforeach
                </tr>
              @endforeach
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="timetable-container weekend">
        <table class="timetable">
          <thead>
            <tr>
              <th>時間</th>
              <th>コート</th>
              <th colspan="2">土</th>
              <th colspan="2">日</th>
            </tr>
            <tr>
              <th></th>
              <th></th>
              <th>担当クラス</th>
              <th>担当コーチ</th>
              <th>担当クラス</th>
              <th>担当コーチ</th>
            </tr>
          </thead>
          <tbody>
            <!-- A コート -->
            <tr>
              <td rowspan="4" class="time-cell">A</td>
              <td>1</td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
            </tr>
            <tr>
              <td>2</td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
            </tr>
            <tr>
              <td>3</td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
            </tr>
            <tr>
              <td>4</td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
            </tr>

            <!-- B コート -->
            <tr>
              <td rowspan="4" class="time-cell">B</td>
              <td>1</td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
            </tr>
            <tr>
              <td>2</td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
            </tr>
            <tr>
              <td>3</td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
            </tr>
            <tr>
              <td>4</td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
            </tr>

            <!-- C コート -->
            <tr>
              <td rowspan="4" class="time-cell">C</td>
              <td>1</td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
            </tr>
            <tr>
              <td>2</td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
            </tr>
            <tr>
              <td>3</td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
            </tr>
            <tr>
              <td>4</td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
            </tr>

            <!-- D コート -->
            <tr>
              <td rowspan="4" class="time-cell">D</td>
              <td>1</td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
            </tr>
            <tr>
              <td>2</td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
            </tr>
            <tr>
              <td>3</td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
            </tr>
            <tr>
              <td>4</td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
            </tr>

            <!-- E コート -->
            <tr>
              <td rowspan="4" class="time-cell">E</td>
              <td>1</td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
            </tr>
            <tr>
              <td>2</td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
            </tr>
            <tr>
              <td>3</td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
            </tr>
            <tr>
              <td>4</td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
            </tr>

            <!-- F コート -->
            <tr>
              <td rowspan="4" class="time-cell">F</td>
              <td>1</td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
            </tr>
            <tr>
              <td>2</td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
            </tr>
            <tr>
              <td>3</td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
            </tr>
            <tr>
              <td>4</td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
              <td>
                <div class="class">担当クラス</div>
              </td>
              <td>
                <div class="coach"></div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <!-- モーダル -->
    <div class="modal-overlay" id="editModal">
      <div class="modal">
        <div class="modal-header">
          <h3 class="modal-title">スケジュール編集</h3>
          <button class="close-btn" id="closeModalBtn">&times;</button>
        </div>
        <div class="modal-body">
          <form id="scheduleForm">
            @csrf
            <div class="form-group">
              <div class="form-label">年月</div>
              <div id="yearMonth"><span id="shift-year">{{ $year }}</span>年<span
                  id="shift-month">{{ $month }}</span>月</div>
            </div>
            <div class="form-group">
              <div class="form-label">曜日</div>
              <div id="dayValue"></div>
            </div>
            <div class="form-group">
              <div class="form-label">時間</div>
              <div id="timeValue"></div>
            </div>
            <div class="form-group">
              <div class="form-label">コート番号</div>
              <div id="courtValue"></div>
            </div>
            <div class="form-group">
              <label class="form-label" for="classSelect">クラス</label>
              <div>
                <select class="form-control" id="classSelect" name="lesson_master_id">
                  @foreach ($lessonMasters as $lesson)
                    <option value="{{ $lesson->id }}">{{ $lesson->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group" id="coachGroup">
              <label class="form-label" for="coachSelect">担当コーチ</label>
              <div>
                <select class="form-control" id="coachSelect" name="staff_id">
                  <option value="">選択してください</option>
                  @foreach ($staffs as $staff)
                    <option value="{{ $staff->id }}">
                      {{ $staff->last_name }} {{ $staff->first_name }}</option>
                  @endforeach
                </select>
                <div class="helper-text" id="coachHelperText" style="display: none;">
                  レッスンなしの場合、コーチは選択できません
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-outline" id="cancelBtn">キャンセル</button>
          <button class="btn btn-primary" id="saveBtn">保存</button>
        </div>
      </div>
    </div>
  </main>
</body>

</html>
