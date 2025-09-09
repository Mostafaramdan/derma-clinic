<div class="card shadow-sm">
  <div class="card-header fw-bold text-primary">{{ __('rx_advices') }}</div>
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center mb-2">
      <label class="fw-bold m-0">{{ __('medications') }}</label>
      <button class="btn btn-primary btn-sm" id="addMedRow">+ {{ __('add_med') }}</button>
    </div>
    <div class="table-responsive">
      <table class="table align-middle">
        <thead class="table-light">
          <tr>
            <th>{{ __('drug') }}</th>
            <th>{{ __('strength') }}</th>
            <th>{{ __('frequency') }}</th>
            <th>{{ __('duration_days') }}</th>
            <th>{{ __('instructions') }}</th>
            <th>{{ __('delete') }}</th>
          </tr>
        </thead>
        <tbody id="medsBody">
          <tr>
            <td><input class="form-control" name="meds[0][drug_name]" placeholder="{{ __('drug') }}"></td>
            <td><input class="form-control" name="meds[0][strength]" placeholder="{{ __('strength') }}"></td>
            <td>
              <div class="d-flex align-items-center gap-2">
                <select class="form-select form-select-sm per-day" name="meds[0][times_per_day]"></select><span class="text-muted small">{{ __('per_day') }}</span>
                <select class="form-select form-select-sm every-hours" name="meds[0][every_hours]"></select><span class="text-muted small">{{ __('hours') }}</span>
              </div>
              <div class="small text-muted freq-hint"></div>
            </td>
            <td><input type="number" class="form-control" name="meds[0][duration_days]" value="7" min="1"></td>
            <td><input class="form-control" name="meds[0][instructions]" placeholder="{{ __('instructions') }}"></td>
            <td><button class="btn btn-outline-danger btn-sm med-remove">✕</button></td>
          </tr>
        </tbody>
      </table>
    </div>

    <hr>

    <div class="form-check form-switch mb-2">
      <input class="form-check-input" type="checkbox" id="adviceActivate">
      <label class="form-check-label" for="adviceActivate">{{ __('enable_advices') }}</label>
    </div>

    <div id="adviceBlock" class="d-none">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <label class="fw-bold m-0">{{ __('advices') }}</label>
        <button class="btn btn-outline-primary btn-sm" id="addAdviceRow">+ {{ __('add_advice') }}</button>
      </div>
      <div class="table-responsive">
        <table class="table align-middle">
          <thead class="table-light"><tr><th>{{ __('advice_text') }}</th><th>{{ __('delete') }}</th></tr></thead>
          <tbody id="adviceBody">
            <tr>
              <td>
                <div class="d-flex gap-2">
                  <input class="form-control advice-input" name="advices[0][text]" placeholder="{{ __('advice_text') }}">
                  <select class="form-select advice-presets">
                    <option value="">{{ __('from_presets') }}</option>
                    <option>{{ __('preset_avoid_sun') }}</option>
                    <option>{{ __('preset_spf') }}</option>
                    <option>{{ __('preset_moisturizer') }}</option>
                    <option>{{ __('preset_gentle_cleanser') }}</option>
                  </select>
                </div>
              </td>
              <td><button class="btn btn-outline-danger btn-sm advice-remove">✕</button></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>
