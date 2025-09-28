
<div class="card">
  <div class="head"><h3>💊 الروشتة & 💡 الإرشادات</h3></div>
  <div class="body">
    <div class="row">
      <div class="field full">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px">
          <label style="margin:0">جدول الأدوية</label>
          <button id="addMedRow" class="btn primary">+ إضافة دواء</button>
        </div>
        <div class="note">معلومة: لو اخترت “كل X ساعة” بقيمة ≥ 24 (مثلاً 48)، هيُفهم كجرعة كل 48 ساعة.</div>
        <div class="table-wrap" style="margin-top:8px">
          <table style="direction:ltr">
            <thead>
              <tr>
                <th style="text-align:left">الدواء</th>
                <th style="text-align:left">التركيز</th>
                <th style="text-align:left">التكرار</th>
                <th style="text-align:left">المدّة (أيام)</th>
                <th style="text-align:left">تعليمات</th>
                <th style="text-align:left">حذف</th>
              </tr>
            </thead>
            <tbody id="medsBody">
              @foreach(($medications ?? [ ['drug'=>'','strength'=>'','frequency'=>'','duration'=>7,'instructions'=>''] ]) as $med)
                <tr>
                  <td><input name="medications[][drug]" placeholder="اسم الدواء" value="{{ $med['drug'] ?? '' }}"></td>
                  <td><input name="medications[][strength]" placeholder="تركيز" value="{{ $med['strength'] ?? '' }}"></td>
                  <td>
                    <div style="display:flex;gap:8px;align-items:center">
                      <select class="per-day" name="medications[][per_day]" title="مرات/اليوم"></select><span>مرة/يوم</span>
                      <select class="every-hours" name="medications[][every_hours]" title="كل كام ساعة"></select><span>ساعات</span>
                    </div>
                    <div class="note freq-hint"></div>
                  </td>
                  <td><input type="number" name="medications[][duration]" value="{{ $med['duration'] ?? 7 }}" min="1"></td>
                  <td><input name="medications[][instructions]" placeholder="تعليمات" value="{{ $med['instructions'] ?? '' }}"></td>
                  <td><button class="btn danger med-remove">✕</button></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="row" style="margin-top:14px">
      <div class="field full">
        <label style="display:flex;align-items:center;gap:8px">
          <input id="adviceActivate" type="checkbox" @if(!empty($advices)) checked @endif> تفعيل الإرشادات
        </label>
      </div>
    </div>
  <div id="adviceBlock" @if(empty($advices)) style="display:none;" @endif>
      <div class="row">
        <div class="field full" style="margin-top:6px">
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px">
            <label style="margin:0">الإرشادات</label>
            <button id="addAdviceRow" class="btn">+ إضافة إرشاد</button>
          </div>
          <table>
            <thead><tr><th>التعليمات</th><th>حذف</th></tr></thead>
            <tbody id="adviceBody">
              @foreach(($advices ?? [ ['text'=>''] ]) as $advice)
                <tr>
                  <td>
                    <div style="display:flex;gap:6px;align-items:center">
                      <input class="advice-input" name="advices[][text]" placeholder="تعليمات" value="{{ $advice['text'] ?? '' }}">
                      <select class="advice-presets" title="قوالب جاهزة">
                        <option value="">— من القوالب —</option>
                        <option>ابتعد عن الشمس</option>
                        <option>SPF 50+ يوميًا</option>
                        <option>مرطّب صباحًا ومساءً</option>
                        <option>غسول لطيف</option>
                        <option>اختبار حساسية موضعي أولًا</option>
                        <option>تجنّب محيط العين</option>
                      </select>
                    </div>
                  </td>
                  <td><button class="btn danger advice-remove">✕</button></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="card">
  <div class="head">
    <h3>{{ __('rx_advices') }}</h3>
  </div>
  <div class="body">
    <div class="row">
      <div class="field full">
        <label>{{ __('medications') }}</label>
        <div style="overflow-x:auto">
          <table style="width:100%;border-collapse:collapse;font-size:14px">
            <thead>
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
                <td><input name="meds[0][drug_name]" placeholder="{{ __('drug') }}"></td>
                <td><input name="meds[0][strength]" placeholder="{{ __('strength') }}"></td>
                <td>
                  <div style="display:flex;align-items:center;gap:8px;">
                    <select class="per-day" name="meds[0][times_per_day]"></select><span class="hint">{{ __('per_day') }}</span>
                    <select class="every-hours" name="meds[0][every_hours]"></select><span class="hint">{{ __('hours') }}</span>
                  </div>
                  <div class="hint freq-hint"></div>
                </td>
                <td><input type="number" name="meds[0][duration_days]" value="7" min="1"></td>
                <td><input name="meds[0][instructions]" placeholder="{{ __('instructions') }}"></td>
                <td><button type="button" class="chip med-remove">✕</button></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="field full">
        <label>{{ __('advices') }}</label>
        <div style="overflow-x:auto">
          <table style="width:100%;border-collapse:collapse;font-size:14px">
            <thead><tr><th>{{ __('advice_text') }}</th><th>{{ __('delete') }}</th></tr></thead>
            <tbody id="adviceBody">
              <tr>
                <td>
                  <div style="display:flex;gap:8px;">
                    <input class="advice-input" name="advices[0][text]" placeholder="{{ __('advice_text') }}">
                    <select class="advice-presets">
                      <option value="">{{ __('from_presets') }}</option>
                      <option>{{ __('preset_avoid_sun') }}</option>
                      <option>{{ __('preset_spf') }}</option>
                      <option>{{ __('preset_moisturizer') }}</option>
                      <option>{{ __('preset_gentle_cleanser') }}</option>
                    </select>
                  </div>
                </td>
                <td><button type="button" class="chip advice-remove">✕</button></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
