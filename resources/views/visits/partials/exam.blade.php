<div class="card">
  <div class="head"><h3>🩺 الكشف</h3></div>
  <div class="body">
    <div class="row">
      <div class="field full">
        <label>نوع البشرة (Fitzpatrick)</label>
        <div class="skin-types" id="skinTypes">
          @foreach(['I','II','III','IV','V','VI'] as $t)
            <div class="skin-card @if(($visit->skin_type ?? '')==$t) active @endif" data-value="{{ $t }}">
              <div class="skin-swatch st{{ $loop->iteration }}"></div><div>{{ $t }}</div>
            </div>
          @endforeach
        </div>
        <input type="hidden" id="skinTypeInput" name="skin_type" value="{{ $visit->skin_type ?? '' }}">
      </div>
      <div class="field third"><label>شكوى رئيسية</label><input name="visit[chief_complaint]" placeholder="حب شباب — حبوب تحت الجلد" value="{{ $visit->chief_complaint ?? '' }}"></div>
      <div class="field third"><label>شدة الأعراض</label>
        <select name="visit[severity]">
          <option value="1" @if(($visit->severity ?? '')=='1') selected @endif>1 — بسيط</option>
          <option value="2" @if(($visit->severity ?? '')=='2') selected @endif>2 — متوسط</option>
          <option value="3" @if(($visit->severity ?? '')=='3') selected @endif>3 — شديد</option>
          <option value="4" @if(($visit->severity ?? '')=='4') selected @endif>4 — عنيف جدًا</option>
        </select>
      </div>
      <div class="field third"><label>المدة</label>
        <select name="visit[duration_bucket]">
          <option value="<1m" @if(($visit->duration_bucket ?? '')=='<1m') selected @endif>أقل من شهر</option>
          <option value="1-3m" @if(($visit->duration_bucket ?? '')=='1-3m') selected @endif>1–3 شهور</option>
          <option value="3-6m" @if(($visit->duration_bucket ?? '')=='3-6m') selected @endif>3–6 شهور</option>
          <option value="6-12m" @if(($visit->duration_bucket ?? '')=='6-12m') selected @endif>6–12 شهر</option>
          <option value=">12m" @if(($visit->duration_bucket ?? '')=='>12m') selected @endif>أكثر من سنة</option>
        </select>
      </div>
      <div class="field full"><label>الصورة المرضية (Clinical picture)</label><textarea name="visit[clinical_picture]" placeholder="Clinical picture — Grade 2">{{ $visit->clinical_picture ?? '' }}</textarea></div>
    </div>
    <div class="bp-toolbar">
      <button type="button" class="btn primary" id="addByClickBtn" style="display:none">وضع الإضافة بالنقر: مفعل</button>
      <button type="button" class="btn" id="addNewBtn" style="display:none">+ إضافة نقطة وسط</button>
      <button type="button" class="btn danger" id="deleteBtn">حذف المحددة</button>
      <button type="button" class="btn danger" id="deleteAllBtn">حذف الكل</button>
    </div>
    <div class="bodypicker" id="BodyPicker" aria-label="خريطة جسم" style="position: relative;">
      <div style="position: absolute; left: 50%; top: 10px; transform: translateX(-50%); z-index: 10; pointer-events: none;">
        <span style="background: rgba(255,255,255,0.8); padding: 6px 14px; border-radius: 12px; font-weight: 800; color: #2563eb; font-size: 18px;">اماكن الاصابة (Distribution)</span>
      </div>
      <div class="bp-canvas" id="bpCanvas">
        <img id="bpImage" class="bp-img" alt="Body Front" draggable="false" src="{{ asset('images/anatomy.png') }}">
        <!-- spots injected here -->
      </div>
      <input type="hidden" id="locationsInput" name="locations" value="{{ old('locations', $visit->locations ?? '') }}">
    </div>
    <div class="row" style="margin-top:12px; margin-bottom: 12px;">
      <div class="field full">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px">
          <label style="margin:0">جدول التشخيص</label>
          <button id="addDxRow" class="btn primary">+ إضافة تشخيص</button>
        </div>
        <div class="table-wrap" style="margin-top:8px">
          <table>
            <thead>
              <tr>
                <th>التشخيص</th>
                <th>ملاحظات</th>
                <th>حذف</th>
              </tr>
            </thead>
            <tbody id="dxBody">
              @foreach(($visit->diagnoses ?? [ ['diagnosis'=>'','notes'=>''] ]) as $dx)
                <tr>
                  <td><input name="diagnoses[][diagnosis]" placeholder="مثال: Acne vulgaris — Grade 2" value="{{ $dx['diagnosis'] ?? '' }}"></td>
                  <td><input name="diagnoses[][notes]" placeholder="ملاحظات التشخيص" value="{{ $dx['notes'] ?? '' }}"></td>
                  <td><button class="btn danger dx-remove">✕</button></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="field third"><label>موعد المتابعة</label><input type="date" name="visit[follow_up_on]" value="{{ $visit->follow_up_on ?? '' }}"></div>
    </div>
  </div>
</div>
<div class="card">
  <div class="head">
    <h3>{{ __('exam') }}</h3>
  </div>
  <div class="body">
    <div class="row">
      <div class="field full">
        <label>{{ __('skin_type') }}</label>
        <div class="skin-types">
          @foreach(['I','II','III','IV','V','VI'] as $t)
            <label class="skin-card">
              <input type="radio" name="visit[skin_type]" value="{{ $t }}" @if(isset($visit) && $visit->skin_type == $t) checked @endif> {{ $t }}
            </label>
          @endforeach
        </div>
      </div>
      <div class="field third">
        <label>{{ __('chief_complaint') }}</label>
        <input name="visit[chief_complaint]" value="{{ $visit->chief_complaint ?? '' }}">
      </div>
      <div class="field third">
        <label>{{ __('severity') }}</label>
        <select name="visit[severity]">
          <option value="1" @if(isset($visit) && $visit->severity == 1) selected @endif>1 — {{ __('mild') }}</option>
          <option value="2" @if(isset($visit) && $visit->severity == 2) selected @endif>2 — {{ __('moderate') }}</option>
          <option value="3" @if(isset($visit) && $visit->severity == 3) selected @endif>3 — {{ __('severe') }}</option>
          <option value="4" @if(isset($visit) && $visit->severity == 4) selected @endif>4 — {{ __('very_severe') }}</option>
        </select>
      </div>
      <div class="field third">
        <label>{{ __('duration') }}</label>
        <select name="visit[duration_bucket]">
          <option value="<1m" @if(isset($visit) && $visit->duration_bucket == '<1m') selected @endif>{{ __('lt_1m') }}</option>
          <option value="1-3m" @if(isset($visit) && $visit->duration_bucket == '1-3m') selected @endif>{{ __('b_1_3m') }}</option>
          <option value="3-6m" @if(isset($visit) && $visit->duration_bucket == '3-6m') selected @endif>{{ __('b_3_6m') }}</option>
          <option value="6-12m" @if(isset($visit) && $visit->duration_bucket == '6-12m') selected @endif>{{ __('b_6_12m') }}</option>
          <option value=">12m" @if(isset($visit) && $visit->duration_bucket == '>12m') selected @endif>{{ __('gt_12m') }}</option>
        </select>
      </div>
      <div class="field full">
        <label>{{ __('locations_map') }}</label>
        <div class="uploader">
          <img id="bpImage" style="max-width:100%;height:auto;user-select:none" src="{{ asset('images/anatomy.png') }}" alt="">
          <input type="hidden" name="visit[body_spots]" id="bodySpots">
          <div class="hint">{{ __('add_spot') }} / {{ __('delete_selected') }} (JS)</div>
        </div>
      </div>
      <div class="field third">
        <label>{{ __('onset') }}</label>
        <input name="visit[onset]" value="{{ $visit->onset ?? '' }}">
      </div>
      <div class="field third">
        <label>{{ __('course') }}</label>
        <select name="visit[course]">
          <option value="continuous" @if(isset($visit) && $visit->course == 'continuous') selected @endif>{{ __('continuous') }}</option>
          <option value="relapsing" @if(isset($visit) && $visit->course == 'relapsing') selected @endif>{{ __('relapsing') }}</option>
          <option value="improving" @if(isset($visit) && $visit->course == 'improving') selected @endif>{{ __('improving') }}</option>
          <option value="worsening" @if(isset($visit) && $visit->course == 'worsening') selected @endif>{{ __('worsening') }}</option>
        </select>
      </div>
      <div class="field third">
        <label>{{ __('diagnosis') }}</label>
        <input name="visit[diagnosis]" value="{{ $visit->diagnosis ?? '' }}">
      </div>
      <div class="field third">
        <label>{{ __('diagnosis_notes') }}</label>
        <input name="visit[diagnosis_notes]" value="{{ $visit->diagnosis_notes ?? '' }}">
      </div>
      <div class="field third">
        <label>{{ __('follow_up_on') }}</label>
        <input type="date" name="visit[follow_up_on]" value="{{ $visit->follow_up_on ?? '' }}">
      </div>
    </div>
  </div>
</div>
      </div>
    </div>
  </div>
</div>
