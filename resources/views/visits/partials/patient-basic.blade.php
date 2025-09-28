<div class="grid">
  <div class="card">
    <div class="head"><h3>🧑 البيانات الأساسية</h3><span class="hint">{{ __('patient_code') }} #{{ $patient->code ?? '—' }}</span></div>
    <div class="body">
      <div class="row">
        <div class="field third"><label>الاسم</label><input name="patient[name]" value="{{ old('patient.name', $patient->name ?? '') }}"></div>
        <div class="field quarter"><label>العمر — سنوات</label><input type="number" min="0" max="150" name="patient[age_years]" value="{{ old('patient.age_years', $patient->age_years ?? '') }}"></div>
        <div class="field quarter"><label>العمر — شهور</label><input type="number" min="0" max="11" name="patient[age_months]" value="{{ old('patient.age_months', $patient->age_months ?? '') }}"></div>
        <div class="field quarter">
          <label>النوع</label>
          <select name="patient[gender]">
            <option value="female" @selected(($patient->gender ?? '')==='female')>أنثى</option>
            <option value="male"   @selected(($patient->gender ?? '')==='male')>ذكر</option>
          </select>
        </div>
        <div class="field quarter">
          <label>الحالة الاجتماعية</label>
          <select name="patient[marital_status]">
            <option value="single"  @selected(($patient->marital_status ?? '')==='single')>أعزب/عزباء</option>
            <option value="married" @selected(($patient->marital_status ?? '')==='married')>متزوج/ة</option>
            <option value="other"   @selected(($patient->marital_status ?? '')==='other')>أخرى</option>
          </select>
        </div>
        <div class="field third"><label>المهنة</label><input name="patient[job]" placeholder="مثال: مُدرّسة" value="{{ old('patient.job', $patient->job ?? '') }}"></div>
        <div class="field third"><label>العنوان</label><input name="patient[address]" placeholder="القاهرة، المهندسين…" value="{{ old('patient.address', $patient->address ?? '') }}"></div>
        <div class="field third"><label>رقم التليفون</label><input name="patient[phone]" type="tel" placeholder="01xxxxxxxxx" value="{{ old('patient.phone', $patient->phone ?? '') }}"></div>
        <div class="field full"><label>ملاحظات أخرى</label><input name="patient[notes]" placeholder="أي ملاحظات إضافية…" value="{{ old('patient.notes', $patient->notes ?? '') }}"></div>
      </div>
    </div>
  </div>

  <aside class="card">
    <div class="head"><h3>⚕️ التاريخ المرضي</h3></div>
    <div class="body">
      <div class="row">
        <div class="field quarter"><label>سكر</label>
          <select name="history[dm]"><option value="0" @selected(($patient->history['dm'] ?? 0)==0)>لا</option><option value="1" @selected(($patient->history['dm'] ?? 0)==1)>نعم</option></select>
        </div>
        <div class="field quarter"><label>ضغط</label>
          <select name="history[htn]"><option value="0" @selected(($patient->history['htn'] ?? 0)==0)>لا</option><option value="1" @selected(($patient->history['htn'] ?? 0)==1)>نعم</option></select>
        </div>
        <div class="field quarter"><label>حساسية أدوية</label>
          <select name="history[drug_allergy]"><option value="0" @selected(($patient->history['drug_allergy'] ?? 0)==0)>لا</option><option value="1" @selected(($patient->history['drug_allergy'] ?? 0)==1)>نعم</option></select>
        </div>
        <div class="field quarter"><label>حمل</label>
          <select name="history[pregnant]"><option value="0" @selected(($patient->history['pregnant'] ?? 0)==0)>لا</option><option value="1" @selected(($patient->history['pregnant'] ?? 0)==1)>نعم</option></select>
        </div>
        <div class="field quarter"><label>رضاعة</label>
          <select name="history[lactation]"><option value="0" @selected(($patient->history['lactation'] ?? 0)==0)>لا</option><option value="1" @selected(($patient->history['lactation'] ?? 0)==1)>نعم</option></select>
        </div>
        <div class="field full"><label>أمراض أخرى</label><input name="history[other_diseases]" placeholder="مثال: ربو، قلب…" value="{{ old('history.other_diseases', $patient->history['other_diseases'] ?? '') }}"></div>
        <div class="field full"><label>ملاحظات أخرى</label><input name="history[notes]" placeholder="تفاصيل إضافية…" value="{{ old('history.notes', $patient->history['notes'] ?? '') }}"></div>
      </div>
    </div>
  </aside>
</div>
