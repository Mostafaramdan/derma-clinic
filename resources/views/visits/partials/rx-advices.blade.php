@if ($errors->has('medications'))
  <div class="field-error">{{ $errors->first('medications') }}</div>
@endif
@if ($errors->has('advices'))
  <div class="field-error">{{ $errors->first('advices') }}</div>
@endif
<div class="card">
  <div class="head"><h3>@lang('messages.rx_advices.title')</h3></div>
  <div class="body">

    {{-- جدول الأدوية --}}
    <div class="row">
      <div class="field full">
        <div class="table-head-flex">
          <label>@lang('messages.rx_advices.meds_table')</label>
          <button type="button" id="addMedRow" class="btn primary">+ @lang('messages.rx_advices.add_med')</button>
        </div>
  <div class="note">@lang('messages.rx_advices.freq_hint')</div>

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
                  <td><input name="rx[meds][{{ $i }}][name]" value="{{ $m['name'] }}" placeholder="@lang('messages.rx_advices.med_name')"></td>
                  <td><input name="rx[meds][{{ $i }}][dose]" value="{{ $m['dose'] }}" placeholder="@lang('messages.rx_advices.dose')"></td>
                  <td>
                    <div class="flex-gap">
                      <select name="rx[meds][{{ $i }}][per_day]" class="per-day"></select><span>@lang('messages.rx_advices.per_day')</span>
                      <select name="rx[meds][{{ $i }}][every_hours]" class="every-hours"></select><span>@lang('messages.rx_advices.hours')</span>
                    </div>
                    <div class="note freq-hint"></div>
                  </td>
                  <td><input type="number" min="1" name="rx[meds][{{ $i }}][days]" value="{{ $m['days'] }}"></td>
                  <td><input name="rx[meds][{{ $i }}][note]" value="{{ $m['note'] }}" placeholder="@lang('messages.rx_advices.instructions')"></td>
                  <td><button class="btn danger med-remove" type="button">@lang('messages.rx_advices.remove')</button></td>
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
          @lang('messages.rx_advices.enable_advices')
        </label>
      </div>
    </div>

    <div id="adviceBlock" style="{{ filled($advices ?? []) ? '' : 'display:none' }}">
      <div class="row">
        <div class="field full mt-6">
          <div class="table-head-flex">
            <label>@lang('messages.rx_advices.advices')</label>
            <button type="button" id="addAdviceRow" class="btn">+ @lang('messages.rx_advices.add_advice')</button>
          </div>
          <table>
            <thead><tr><th>@lang('messages.rx_advices.instructions')</th><th>@lang('messages.rx_advices.remove')</th></tr></thead>
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
