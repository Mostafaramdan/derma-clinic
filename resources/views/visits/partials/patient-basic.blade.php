<div class="grid">
  <div class="card">
  <div class="head"><h3>@lang('messages.patient_basic.title')</h3><span class="hint">@lang('messages.patient_basic.code') #{{ $patient->code ?? '—' }}</span></div>
    <div class="body">
      <div class="row">
  <div class="field third"><label>@lang('messages.patient_basic.name')</label><input name="patient[name]" value="{{ old('patient.name', $patient->name ?? '') }}"></div>
  <div class="field quarter"><label>@lang('messages.patient_basic.age_years')</label><input type="number" min="0" max="150" name="patient[age_years]" value="{{ old('patient.age_years', $patient->age_years ?? '') }}"></div>
  <div class="field quarter"><label>@lang('messages.patient_basic.age_months')</label><input type="number" min="0" max="11" name="patient[age_months]" value="{{ old('patient.age_months', $patient->age_months ?? '') }}"></div>
        <div class="field quarter">
          <label>@lang('messages.patient_basic.gender')</label>
          <select name="patient[gender]">
            <option value="female" @selected(($patient->gender ?? '')==='female')>@lang('messages.patient_basic.female')</option>
            <option value="male"   @selected(($patient->gender ?? '')==='male')>@lang('messages.patient_basic.male')</option>
          </select>
        </div>
        <div class="field quarter">
          <label>@lang('messages.patient_basic.marital_status')</label>
          <select name="patient[marital_status]">
            <option value="single"  @selected(($patient->marital_status ?? '')==='single')>@lang('messages.patient_basic.single')</option>
            <option value="married" @selected(($patient->marital_status ?? '')==='married')>@lang('messages.patient_basic.married')</option>
            <option value="other"   @selected(($patient->marital_status ?? '')==='other')>@lang('messages.patient_basic.other')</option>
          </select>
        </div>
  <div class="field third"><label>@lang('messages.patient_basic.job')</label><input name="patient[job]" placeholder="@lang('messages.patient_basic.job_placeholder')" value="{{ old('patient.job', $patient->job ?? '') }}"></div>
  <div class="field third"><label>@lang('messages.patient_basic.address')</label><input name="patient[address]" placeholder="@lang('messages.patient_basic.address_placeholder')" value="{{ old('patient.address', $patient->address ?? '') }}"></div>
  <div class="field third"><label>@lang('messages.patient_basic.phone')</label><input name="patient[phone]" type="tel" placeholder="@lang('messages.patient_basic.phone_placeholder')" value="{{ old('patient.phone', $patient->phone ?? '') }}"></div>
  <div class="field full"><label>@lang('messages.patient_basic.notes')</label><input name="patient[notes]" placeholder="@lang('messages.patient_basic.notes_placeholder')" value="{{ old('patient.notes', $patient->notes ?? '') }}"></div>
      </div>
    </div>
  </div>

  <aside class="card">
  <div class="head"><h3>@lang('messages.patient_basic.medical_history_title')</h3></div>
    <div class="body">
      <div class="row">
        @if(isset($chronicDiseases) && $chronicDiseases->count())
          @foreach($chronicDiseases->take(5) as $cd)
            <div class="field quarter">
              <label>{{ $cd->localName() }}</label>
              <select name="history[chronic_{{ $cd->id }}]">
                <option value="0" @selected($visit->patientChronicDiseases->where('chronic_disease_id', $cd->id)?->first() ? false : true)>@lang('messages.patient_basic.no')</option>
                <option value="1" @selected($visit->patientChronicDiseases->where('chronic_disease_id', $cd->id)?->first() ? true : false)>@lang('messages.patient_basic.yes')</option>
              </select>
            </div>
          @endforeach
        @endif
        <div class="field full">
          <label>@lang('messages.patient_basic.other_diseases')</label>
          <input name="history[other_diseases]" placeholder="@lang('messages.patient_basic.other_diseases_placeholder')"
            value="{{ old('history.other_diseases', $visit->patientChronicDiseases->where('note_type', 'other_diseases')?->first()?->notes ?? '') }}">
        </div>
        <div class="field full">
          <label>@lang('messages.patient_basic.notes')</label>
          <input name="history[notes]" placeholder="@lang('messages.patient_basic.notes_placeholder')"
            value="{{ old('history.notes', $visit->patientChronicDiseases->where('note_type', 'notes')?->first()?->notes ?? '') }}">
        </div>
        </div>
      </div>
    </div>
  </aside>
</div>
