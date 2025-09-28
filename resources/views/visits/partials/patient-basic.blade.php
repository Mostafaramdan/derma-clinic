
<div class="card">
  <div class="head"><h3>🧑 البيانات الأساسية</h3><span class="hint">ملف #{{ $patient->code ?? $patient->id }}</span></div>
  <div class="body">
    <div class="row">
      <div class="field third"><label>الاسم</label><input name="patient[name]" value="{{ old('patient.name', $patient->name ?? '') }}"></div>
      <div class="field quarter"><label>العمر — سنوات</label><input type="number" min="0" max="150" name="patient[age_years]" value="{{ old('patient.age_years', $patient->age_years ?? '') }}"></div>
      <div class="field quarter"><label>العمر — شهور</label><input type="number" min="0" max="11" name="patient[age_months]" value="{{ old('patient.age_months', $patient->age_months ?? '') }}"></div>
      <div class="field quarter"><label>النوع</label>
        <select name="patient[gender]">
          <option value="female" @if(($patient->gender ?? '')=='female') selected @endif>أنثى</option>
          <option value="male" @if(($patient->gender ?? '')=='male') selected @endif>ذكر</option>
          <option value="other" @if(($patient->gender ?? '')=='other') selected @endif>أخرى</option>
        </select>
      </div>
      <div class="field quarter"><label>الحالة الاجتماعية</label>
        <select name="patient[marital_status]">
          <option value="single" @if(($patient->marital_status ?? '')=='single') selected @endif>أعزب/عزباء</option>
          <option value="married" @if(($patient->marital_status ?? '')=='married') selected @endif>متزوج/ة</option>
          <option value="other" @if(($patient->marital_status ?? '')=='other') selected @endif>أخرى</option>
        </select>
      </div>
      <div class="field third"><label>المهنة</label><input name="patient[occupation]" placeholder="مثال: مُدرّسة" value="{{ old('patient.occupation', $patient->occupation ?? '') }}"></div>
      <div class="field third"><label>العنوان</label><input name="patient[address]" placeholder="القاهرة، المهندسين…" value="{{ old('patient.address', $patient->address ?? '') }}"></div>
      <div class="field third"><label>رقم التليفون</label><input name="patient[phone]" type="tel" placeholder="01xxxxxxxxx" value="{{ old('patient.phone', $patient->phone ?? '') }}"></div>
      <div class="field full"><label>ملاحظات أخرى</label><input name="patient[notes]" placeholder="أي ملاحظات إضافية…" value="{{ old('patient.notes', $patient->notes ?? '') }}"></div>
    </div>
  </div>
</div>
