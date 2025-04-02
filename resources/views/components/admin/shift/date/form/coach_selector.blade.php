<div>
  <label for="coach" class="form-label">コーチ:</label>
  <select id="coach" class="form-control">
    @foreach ($staffs as $staff)
      <option value="{{ $staff->last_name }}{{ $staff->first_name }}" data-coach_id="{{ $staff->id }}">
        {{ $staff->last_name }}{{ $staff->first_name }}</option>
    @endforeach
  </select>
  <div class="checkbox-group">
    <input type="checkbox" id="isSubstitute" class="checkbox">
    <label for="isSubstitute" class="checkbox-label">代行コーチ</label>
  </div>
</div>
