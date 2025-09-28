
<div class="card">
  <div class="head"><h3>🩺 التاريخ المرضي</h3></div>
  <div class="body">
    <div class="row">
      <div class="field quarter"><label>سكر</label>
        <select name="history[diabetes]">
          <option value="no" @if(($visit->diabetes ?? '')=='no') selected @endif>لا</option>
          <option value="yes" @if(($visit->diabetes ?? '')=='yes') selected @endif>نعم</option>
        </select>
      </div>
      <div class="field quarter"><label>ضغط</label>
        <select name="history[hypertension]">
          <option value="no" @if(($visit->hypertension ?? '')=='no') selected @endif>لا</option>
          <option value="yes" @if(($visit->hypertension ?? '')=='yes') selected @endif>نعم</option>
        </select>
      </div>
      <div class="field quarter"><label>حساسية أدوية</label>
        <select name="history[drug_allergy]">
          <option value="no" @if(($visit->drug_allergy ?? '')=='no') selected @endif>لا</option>
          <option value="yes" @if(($visit->drug_allergy ?? '')=='yes') selected @endif>نعم</option>
        </select>
      </div>
      <div class="field quarter"><label>حمل</label>
        <select name="history[pregnancy]">
          <option value="no" @if(($visit->pregnancy ?? '')=='no') selected @endif>لا</option>
          <option value="yes" @if(($visit->pregnancy ?? '')=='yes') selected @endif>نعم</option>
        </select>
      </div>
      <div class="field quarter"><label>رضاعة</label>
        <select name="history[lactation]">
          <option value="no" @if(($visit->lactation ?? '')=='no') selected @endif>لا</option>
          <option value="yes" @if(($visit->lactation ?? '')=='yes') selected @endif>نعم</option>
        </select>
      </div>
      <div class="field full"><label>أمراض أخرى</label><input name="history[other_diseases]" value="{{ old('history.other_diseases', $visit->other_diseases ?? '') }}"></div>
      <div class="field full"><label>ملاحظات أخرى</label><input name="history[notes]" value="{{ old('history.notes', $visit->notes ?? '') }}"></div>
    </div>
    <div class="row">
      <div class="field full">
        <label>أمراض مزمنة</label>
        <div style="display:flex;flex-wrap:wrap;gap:10px;">
          @foreach(($chronicDiseases ?? []) as $cd)
            @if(is_object($cd))
              <label class="chip">
                <input type="checkbox" name="history[cd][]" value="{{ $cd->id }}" style="margin-inline-end:6px"
                  @if(isset($visit) && is_array($visit->chronic_disease_ids ?? null) && in_array($cd->id, $visit->chronic_disease_ids)) checked @endif>
                {{ $cd->label() }}
              </label>
            @endif
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>

<aside class="card">
  <div class="head"><h3>⚕️ التاريخ المرضي</h3></div>
  <div class="body">
    <div class="row">
      <div class="field quarter"><label>سكر</label>
        <select name="history[diabetes]">
          <option value="no" @if(($visit->diabetes ?? '')=='no') selected @endif>لا</option>
          <option value="yes" @if(($visit->diabetes ?? '')=='yes') selected @endif>نعم</option>
        </select>
      </div>
      <div class="field quarter"><label>ضغط</label>
        <select name="history[hypertension]">
          <option value="no" @if(($visit->hypertension ?? '')=='no') selected @endif>لا</option>
          <option value="yes" @if(($visit->hypertension ?? '')=='yes') selected @endif>نعم</option>
        </select>
      </div>
      <div class="field quarter"><label>حساسية أدوية</label>
        <select name="history[drug_allergy]">
          <option value="no" @if(($visit->drug_allergy ?? '')=='no') selected @endif>لا</option>
          <option value="yes" @if(($visit->drug_allergy ?? '')=='yes') selected @endif>نعم</option>
        </select>
      </div>
      <div class="field quarter"><label>حمل</label>
        <select name="history[pregnancy]">
          <option value="no" @if(($visit->pregnancy ?? '')=='no') selected @endif>لا</option>
          <option value="yes" @if(($visit->pregnancy ?? '')=='yes') selected @endif>نعم</option>
        </select>
      </div>
      <div class="field quarter"><label>رضاعة</label>
        <select name="history[lactation]">
          <option value="no" @if(($visit->lactation ?? '')=='no') selected @endif>لا</option>
          <option value="yes" @if(($visit->lactation ?? '')=='yes') selected @endif>نعم</option>
        </select>
      </div>
      <div class="field full"><label>أمراض أخرى</label><input name="history[other_diseases]" placeholder="مثال: ربو، قلب…" value="{{ old('history.other_diseases', $visit->other_diseases ?? '') }}"></div>
      <div class="field full"><label>ملاحظات أخرى</label><input name="history[notes]" placeholder="تفاصيل إضافية…" value="{{ old('history.notes', $visit->notes ?? '') }}"></div>
    </div>
    <div class="row">
      <div class="field full">
        <label>أمراض مزمنة</label>
        <div style="display:flex;flex-wrap:wrap;gap:10px;">
          @foreach(($chronicDiseases ?? []) as $cd)
            @if(is_object($cd))
              <label class="chip">
                <input type="checkbox" name="history[cd][]" value="{{ $cd->id }}" style="margin-inline-end:6px"
                  @if(isset($visit) && is_array($visit->chronic_disease_ids ?? null) && in_array($cd->id, $visit->chronic_disease_ids)) checked @endif>
                {{ $cd->label() }}
              </label>
            @endif
          @endforeach
        </div>
      </div>
    </div>
  </div>
</aside>
