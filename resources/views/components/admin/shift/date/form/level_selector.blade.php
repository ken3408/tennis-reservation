<div>
  <div class="level-header">
    <label for="level" class="form-label">レベル:</label>
    <button type="button" id="levelEditButton" class="button button-ghost level-edit-button">
      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"
        style="margin-right: 4px;">
        <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"></path>
      </svg>
      編集
    </button>
    <div id="levelEditActions" class="hidden">
      <button type="button" id="levelCancelButton" class="button button-ghost level-edit-button">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
          stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"
          style="margin-right: 4px;">
          <path d="M18 6 6 18"></path>
          <path d="m6 6 12 12"></path>
        </svg>
        キャンセル
      </button>
      <button type="button" id="levelConfirmButton" class="button button-ghost level-edit-button"
        style="color: hsl(var(--primary));">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
          stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"
          style="margin-right: 4px;">
          <path d="M20 6 9 17l-5-5"></path>
        </svg>
        確定
      </button>
    </div>
  </div>
  @if (empty($lessonMasterId))
    <div id="levelReadOnly" class="form-readonly">
      未設定
    </div>
  @else
    <div id="levelReadOnly" class="form-readonly"
      data-level="{{ $lessonMaster->firstWhere('id', $lessonMasterId)?->name }}">
      {{ $lessonMaster->firstWhere('id', $lessonMasterId)?->name }}
    </div>
  @endif
  <select id="levelSelect" class="form-control hidden">
    @foreach ($lessonMaster as $lesson)
      <option value="{{ $lesson->id }}" {{ $lesson->id == $lessonMasterId ? 'selected' : '' }}>
        {{ $lesson->name }}
      </option>
    @endforeach
  </select>
</div>
