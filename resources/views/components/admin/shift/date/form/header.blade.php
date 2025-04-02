<div class="header">
  <button type="button" class="back-button" id="backButton">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"
      style="margin-right: 4px;">
      <path d="m12 19-7-7 7-7"></path>
      <path d="M19 12H5"></path>
    </svg>
    戻る
  </button>
  <h1 class="page-title">
    <span id="lessonDate">{{ $year }}年{{ $month }}月{{ $day }}日（{{ $weekday }}）</span>
    <span class="separator">|</span>
    <span id="lessonTimeSlot" class="time-slot">{{ $lessonTimeSlot->class_name }}
      {{ $lessonTimeSlot->start_time }}〜{{ $lessonTimeSlot->end_time }}</span>
    <span class="separator">|</span>
    <span id="lessonCourt" data-court_num="{{ $court_num }}">コート{{ $court_num }}</span>
  </h1>
</div>
