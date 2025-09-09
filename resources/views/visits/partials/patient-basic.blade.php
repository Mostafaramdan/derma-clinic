<div class="card shadow-sm">
  <div class="card-header fw-bold text-primary">{{ __('patient_basic') }}</div>
  <div class="card-body">
    <div class="row g-3">
      <div class="col-md-4">
        <label class="form-label">{{ __('name') }}</label>
        <input class="form-control" name="patient[name]" value="{{ old('patient.name', $patient->name ?? '') }}">
      </div>
      <div class="col-md-2">
        <label class="form-label">{{ __('age_years') }}</label>
        <input type="number" min="0" max="150" class="form-control" name="patient[age_years]" value="{{ old('patient.age_years') }}">
      </div>
      <div class="col-md-2">
        <label class="form-label">{{ __('age_months') }}</label>
        <input type="number" min="0" max="11" class="form-control" name="patient[age_months]" value="{{ old('patient.age_months') }}">
      </div>
      <div class="col-md-2">
        <label class="form-label">{{ __('gender') }}</label>
        <select class="form-select" name="patient[gender]">
          <option value="female">{{ __('female') }}</option>
          <option value="male">{{ __('male') }}</option>
          <option value="other">{{ __('other') }}</option>
        </select>
      </div>
      <div class="col-md-2">
        <label class="form-label">{{ __('marital_status') }}</label>
        <select class="form-select" name="patient[marital_status]">
          <option value="single">{{ __('single') }}</option>
          <option value="married">{{ __('married') }}</option>
          <option value="other">{{ __('other') }}</option>
        </select>
      </div>

      <div class="col-md-4">
        <label class="form-label">{{ __('occupation') }}</label>
        <input class="form-control" name="patient[occupation]">
      </div>
      <div class="col-md-4">
        <label class="form-label">{{ __('address') }}</label>
        <input class="form-control" name="patient[address]">
      </div>
      <div class="col-md-4">
        <label class="form-label">{{ __('phone') }}</label>
        <input class="form-control" name="patient[phone]">
      </div>

      <div class="col-12">
        <label class="form-label">{{ __('other_notes') }}</label>
        <input class="form-control" name="patient[notes]">
      </div>
    </div>
  </div>
</div>
