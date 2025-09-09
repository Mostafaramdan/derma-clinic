<div class="card shadow-sm">
  <div class="card-header fw-bold text-primary">{{ __('medical_history') }}</div>
  <div class="card-body">
    <div class="row g-3">
      {{-- سيأتي من جدول chronic_diseases (JSON {ar,en}) --}}
      @foreach(($chronicDiseases ?? []) as $cd)
        <div class="col-md-3">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="history[cd][]" value="{{ $cd->id }}" id="cd{{ $cd->id }}">
            <label class="form-check-label" for="cd{{ $cd->id }}">{{ $cd->label() }}</label>
          </div>
        </div>
      @endforeach

      <div class="col-12">
        <label class="form-label">{{ __('other_notes') }}</label>
        <input class="form-control" name="history[notes]">
      </div>
    </div>
  </div>
</div>
