<div class="card">
  <div class="head"><h3>🩺 الكشف</h3></div>
  <div class="body">
    <div class="row">
      <div class="field full">
        <label>نوع البشرة (Fitzpatrick)</label>
        <div class="skin-types" id="skinTypes">
          @foreach (['I','II','III','IV','V','VI'] as $st)
            <div class="skin-card" data-value="{{ $st }}"><div class="skin-swatch st{{ $loop->iteration }}"></div><div>{{ $st }}</div></div>
          @endforeach
        </div>
        <input type="hidden" id="skinTypeInput" name="exam[skin_type]" value="{{ old('exam.skin_type', $visit->exam['skin_type'] ?? '') }}">
      </div>

      <div class="field third"><label>شكوى رئيسية</label>
        <input name="exam[chief_complaint]" placeholder="حب شباب — حبوب تحت الجلد" value="{{ old('exam.chief_complaint', $visit->exam['chief_complaint'] ?? '') }}">
@if ($errors->has('exam.chief_complaint'))
  <div class="field-error">{{ $errors->first('exam.chief_complaint') }}</div>
@endif
      </div>

      <div class="field third"><label>شدة الأعراض</label>
        <select name="exam[severity]">
@if ($errors->has('exam.severity'))
  <div class="field-error">{{ $errors->first('exam.severity') }}</div>
@endif
          @foreach ([1=>'1 — بسيط',2=>'2 — متوسط',3=>'3 — شديد',4=>'4 — عنيف جدًا'] as $k=>$v)
            <option value="{{ $k }}" @selected(($visit->exam['severity'] ?? null)==$k)>{{ $v }}</option>
          @endforeach
        </select>
      </div>

      <div class="field third"><label>المدة</label>
        <select name="exam[duration]">
@if ($errors->has('exam.duration'))
  <div class="field-error">{{ $errors->first('exam.duration') }}</div>
@endif
          @foreach (['<1m'=>'أقل من شهر','1-3m'=>'1–3 شهور','3-6m'=>'3–6 شهور','6-12m'=>'6–12 شهر','>12m'=>'أكثر من سنة'] as $k=>$v)
            <option value="{{ $k }}" @selected(($visit->exam['duration'] ?? null)==$k)>{{ $v }}</option>
          @endforeach
        </select>
      </div>

      <div class="field third"><label>الصورة المرضية (Clinical picture)</label>
        <textarea name="exam[clinical_picture]" placeholder="Clinical picture — Grade 2">{{ old('exam.clinical_picture', $visit->exam['clinical_picture'] ?? '') }}</textarea>
@if ($errors->has('exam.clinical_picture'))
  <div class="field-error">{{ $errors->first('exam.clinical_picture') }}</div>
@endif
      </div>
    </div>

    {{-- أدوات الخريطة --}}
    <div class="bp-toolbar">
      <button type="button" class="btn danger" id="deleteBtn">حذف المحددة</button>
      <button type="button" class="btn danger" id="deleteAllBtn">حذف الكل</button>
    </div>

    {{-- BODY PICKER --}}
    <div class="bodypicker" id="BodyPicker" aria-label="خريطة جسم">
      <div class="bp-title">اماكن الاصابة (Distribution)</div>
      <div class="bp-canvas" id="bpCanvas">
        <img id="bpImage" class="bp-img" alt="Body Front" draggable="false" src="{{ $visit->bp_image_url ?? 'https://api.cefour.com/storage/image/anatomy_68bc89752e694.png' }}">
        {{-- نقاط ديناميكية بالـ JS --}}
      </div>
    </div>
    <input type="hidden" id="locationsInput" name="exam[locations]" value='@json($visit->exam['locations'] ?? [])'>
@if ($errors->has('exam.locations'))
  <div class="field-error">{{ $errors->first('exam.locations') }}</div>
@endif
@if ($errors->has('exam.locations'))
  <div class="field-error">{{ $errors->first('exam.locations') }}</div>
@endif

    {{-- جدول التشخيص --}}
    <div class="row" style="margin-top:12px; margin-bottom: 12px;">
      <div class="field full">
        <div class="table-head-flex">
          <label>جدول التشخيص</label>
          <button type="button" id="addDxRow" class="btn primary">+ إضافة تشخيص</button>
        </div>
        <div class="table-wrap">
          <table>
            <thead><tr><th>التشخيص</th><th>ملاحظات</th><th>حذف</th></tr></thead>
            <tbody id="dxBody">
              @php $dxList = old('exam.dx', $visit->exam['dx'] ?? [['name'=>'','note'=>'']]); @endphp
              @foreach ($dxList as $row)
                <tr>
                  <td><input name="exam[dx][{{ $loop->index }}][name]" value="{{ $row['name'] }}"></td>
                  <td><input name="exam[dx][{{ $loop->index }}][note]" value="{{ $row['note'] }}"></td>
                  <td><button class="btn danger dx-remove" type="button">✕</button></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="field third"><label>موعد المتابعة</label><input type="date" name="exam[follow_up_at]" value="{{ old('exam.follow_up_at', $visit->exam['follow_up_at'] ?? '') }}"></div>
    </div>
  </div>
</div>
