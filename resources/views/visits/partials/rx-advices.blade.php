@if ($errors->has('medications'))
  <div class="field-error">{{ $errors->first('medications') }}</div>
@endif
@if ($errors->has('advices'))
  <div class="field-error">{{ $errors->first('advices') }}</div>
@endif
<div class="card">
  <div class="head"><h3>💊 الروشتة & 💡 الإرشادات</h3></div>
  <div class="body">

    {{-- جدول الأدوية --}}
    <div class="row">
      <div class="field full">
        <div class="table-head-flex">
          <label>جدول الأدوية</label>
          <button type="button" id="addMedRow" class="btn primary">+ إضافة دواء</button>
        </div>
        <div class="note">لو اخترت “كل X ساعة” بقيمة ≥ 24 (مثلاً 48)، تُفهَم كجرعة كل 48 ساعة.</div>

        <div class="table-wrap">
          <table class="ltr">
            <thead>
            <tr>
              <th>الدواء</th>
              <th>التركيز</th>
              <th>التكرار</th>
              <th>المدّة (أيام)</th>
              <th>تعليمات</th>
              <th>حذف</th>
            </tr>
            </thead>
            <tbody id="medsBody">
              @php
                $meds = old('rx.meds', collect($medications)->map(fn($m)=>[
                  'name'=>$m['name']??'','dose'=>$m['dose']??'','per_day'=>$m['per_day']??'',
                  'every_hours'=>$m['every_hours']??'','days'=>$m['days']??7,'note'=>$m['note']??'',
                ])->toArray() ?: [['name'=>'','dose'=>'','per_day'=>'','every_hours'=>'','days'=>7,'note'=>'']]);
              @endphp
              @foreach ($meds as $i=>$m)
                <tr>
                  <td><input name="rx[meds][{{ $i }}][name]" value="{{ $m['name'] }}" placeholder="اسم الدواء"></td>
                  <td><input name="rx[meds][{{ $i }}][dose]" value="{{ $m['dose'] }}" placeholder="تركيز"></td>
                  <td>
                    <div class="flex-gap">
                      <select name="rx[meds][{{ $i }}][per_day]" class="per-day"></select><span>مرة/يوم</span>
                      <select name="rx[meds][{{ $i }}][every_hours]" class="every-hours"></select><span>ساعات</span>
                    </div>
                    <div class="note freq-hint"></div>
                  </td>
                  <td><input type="number" min="1" name="rx[meds][{{ $i }}][days]" value="{{ $m['days'] }}"></td>
                  <td><input name="rx[meds][{{ $i }}][note]" value="{{ $m['note'] }}" placeholder="تعليمات"></td>
                  <td><button class="btn danger med-remove" type="button">✕</button></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    {{-- الإرشادات --}}
    <div class="row mt-14">
      <div class="field full">
        <label class="inline">
          <input id="adviceActivate" type="checkbox" name="rx[advices_enabled]" value="1" @checked(old('rx.advices_enabled', filled($advices ?? [])))>
          تفعيل الإرشادات
        </label>
      </div>
    </div>

    <div id="adviceBlock" style="{{ filled($advices ?? []) ? '' : 'display:none' }}">
      <div class="row">
        <div class="field full mt-6">
          <div class="table-head-flex">
            <label>الإرشادات</label>
            <button type="button" id="addAdviceRow" class="btn">+ إضافة إرشاد</button>
          </div>
          <table>
            <thead><tr><th>التعليمات</th><th>حذف</th></tr></thead>
            <tbody id="adviceBody">
              @php
                $advs = old('rx.advices', (array)($advices ?? []));
                if (!$advs) $advs = [['text'=>'']];
              @endphp
              @foreach ($advs as $i=>$a)
                <tr>
                  <td>
                    <div class="flex-gap">
                      <input class="advice-input" name="rx[advices][{{ $i }}][text]" value="{{ $a['text'] ?? '' }}" placeholder="تعليمات">
                      <select class="advice-presets">
                        <option value="">— من القوالب —</option>
                        @foreach (['ابتعد عن الشمس','SPF 50+ يوميًا','مرطّب صباحًا ومساءً','غسول لطيف','اختبار حساسية موضعي أولًا','تجنّب محيط العين'] as $preset)
                          <option>{{ $preset }}</option>
                        @endforeach
                      </select>
                    </div>
                  </td>
                  <td><button class="btn danger advice-remove" type="button">✕</button></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</div>
