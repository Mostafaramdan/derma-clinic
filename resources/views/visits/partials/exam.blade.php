<div class="card shadow-sm">
  <div class="card-header fw-bold text-primary">{{ __('exam') }}</div>
  <div class="card-body">
    <div class="row g-3">
      <div class="col-md-12">
        <label class="form-label">{{ __('skin_type') }}</label>
        <div class="d-flex gap-2 flex-wrap">
          @foreach(['I','II','III','IV','V','VI'] as $t)
            <label class="btn btn-outline-secondary btn-sm">
              <input class="form-check-input me-1" type="radio" name="visit[skin_type]" value="{{ $t }}"> {{ $t }}
            </label>
          @endforeach
        </div>
      </div>

      <div class="col-md-4">
        <label class="form-label">{{ __('chief_complaint') }}</label>
        <input class="form-control" name="visit[chief_complaint]">
      </div>
      <div class="col-md-4">
        <label class="form-label">{{ __('severity') }}</label>
        <select class="form-select" name="visit[severity]">
          <option value="1">1 — {{ __('mild') }}</option>
          <option value="2">2 — {{ __('moderate') }}</option>
          <option value="3">3 — {{ __('severe') }}</option>
          <option value="4">4 — {{ __('very_severe') }}</option>
        </select>
      </div>
      <div class="col-md-4">
        <label class="form-label">{{ __('duration') }}</label>
        <select class="form-select" name="visit[duration_bucket]">
          <option value="<1m">{{ __('lt_1m') }}</option>
          <option value="1-3m">{{ __('b_1_3m') }}</option>
          <option value="3-6m">{{ __('b_3_6m') }}</option>
          <option value="6-12m">{{ __('b_6_12m') }}</option>
          <option value=">12m">{{ __('gt_12m') }}</option>
        </select>
      </div>

      {{-- BODY PICKER صورة + سبوتس (اربطها بvisit.js) --}}
      <div class="col-12">
        <div class="border rounded-3 p-3 bg-white">
          <div class="d-flex justify-content-between mb-2">
            <div class="fw-bold">{{ __('locations_map') }}</div>
            <div class="d-flex gap-2">
              <button type="button" class="btn btn-outline-primary btn-sm" id="addSpotBtn">+ {{ __('add_spot') }}</button>
              <button type="button" class="btn btn-outline-danger btn-sm" id="delSpotBtn">{{ __('delete_selected') }}</button>
            </div>
          </div>
          <div id="bodyPicker" class="position-relative border rounded overflow-hidden" style="min-height:360px">
            <img id="bpImage" class="w-100 user-select-none" src="{{ asset('images/body-front.png') }}" alt="">
            {{-- Spots inject via JS --}}
          </div>
          <input type="hidden" name="visit[body_spots]" id="bodySpots">
        </div>
      </div>

      <div class="col-md-4">
        <label class="form-label">{{ __('onset') }}</label>
        <input class="form-control" name="visit[onset]">
      </div>
      <div class="col-md-4">
        <label class="form-label">{{ __('course') }}</label>
        <select class="form-select" name="visit[course]">
          <option value="continuous">{{ __('continuous') }}</option>
          <option value="relapsing">{{ __('relapsing') }}</option>
          <option value="improving">{{ __('improving') }}</option>
          <option value="worsening">{{ __('worsening') }}</option>
        </select>
      </div>
      <div class="col-md-4">
        <label class="form-label">{{ __('diagnosis') }}</label>
        <input class="form-control" name="visit[diagnosis]">
      </div>
      <div class="col-md-6">
        <label class="form-label">{{ __('diagnosis_notes') }}</label>
        <input class="form-control" name="visit[diagnosis_notes]">
      </div>
      <div class="col-md-6">
        <label class="form-label">{{ __('follow_up_on') }}</label>
        <input type="date" class="form-control" name="visit[follow_up_on]">
      </div>
    </div>
  </div>
</div>
