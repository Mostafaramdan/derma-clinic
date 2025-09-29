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
        @if(isset($chronicDiseases) && $chronicDiseases->count())
          @foreach($chronicDiseases->take(5) as $cd)
            <div class="field quarter">
              <label>{{ $cd->name['ar'] ?? $cd->name['en'] ?? '—' }}</label>
              <select name="history[chronic_{{ $cd->id }}]">
                <option value="0" @selected(($patient->history['chronic_' . $cd->id] ?? 0)==0)>لا</option>
                <option value="1" @selected(($patient->history['chronic_' . $cd->id] ?? 0)==1)>نعم</option>
              </select>
            </div>
          @endforeach
        @endif
        <div class="field full"><label>أمراض أخرى</label><input name="history[other_diseases]" placeholder="مثال: ربو، قلب…" value="{{ old('history.other_diseases', $patient->history['other_diseases'] ?? '') }}"></div>
        <div class="field full"><label>ملاحظات أخرى</label><input name="history[notes]" placeholder="تفاصيل إضافية…" value="{{ old('history.notes', $patient->history['notes'] ?? '') }}"></div>
        </div>
        @if($patient->chronicDiseases && $patient->chronicDiseases->count())
        <div class="chronic-diseases-list" style="margin-top:22px;">
          <label style="font-weight:700;font-size:15px;margin-bottom:8px;display:block;">الأمراض المزمنة المرتبطة بالمريض:</label>
          <div style="display:flex;flex-wrap:wrap;gap:12px;">
            @foreach($patient->chronicDiseases as $cd)
              <div class="chronic-card" style="background:#f8fafc;border-radius:10px;padding:10px 18px;box-shadow:0 2px 8px rgba(37,99,235,.04);min-width:120px;">
                <div style="font-weight:700;font-size:16px;">{{ $cd->name['ar'] ?? $cd->name['en'] ?? '—' }}</div>
                @if($cd->pivot->since)
                  <div style="font-size:13px;color:#555;margin-top:2px;">منذ: {{ $cd->pivot->since }}</div>
                @endif
                @if($cd->pivot->notes)
                  <div style="font-size:13px;color:#888;margin-top:2px;">ملاحظات: {{ $cd->pivot->notes }}</div>
                @endif
              </div>
            @endforeach
          </div>
        </div>
        @endif
      </div>
    </div>
  </aside>
</div>
