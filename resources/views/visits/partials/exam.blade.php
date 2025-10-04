<div class="card">
  <div class="head"><h3>@lang('messages.exam.title')</h3></div>
  <div class="body">
    <div class="row">
      <div class="field full">
  <label>@lang('messages.exam.skin_type')</label>
        <div class="skin-types" id="skinTypes">
          @foreach (['I','II','III','IV','V','VI'] as $st)
            <div class="skin-card" data-value="{{ $st }}"><div class="skin-swatch st{{ $loop->iteration }}"></div><div>{{ $st }}</div></div>
          @endforeach
        </div>
        <input type="hidden" id="skinTypeInput" name="exam[skin_type]" value="{{ old('exam.skin_type', $visit->skin_type ?? '') }}">
      </div>

      <div class="field third"><label>@lang('messages.exam.chief_complaint')</label>
        <input name="exam[chief_complaint]" placeholder="@lang('messages.exam.chief_complaint_placeholder')" value="{{ old('exam.chief_complaint', $visit->chief_complaint ?? '') }}">
@if ($errors->has('exam.chief_complaint'))
  <div class="field-error">{{ $errors->first('exam.chief_complaint') }}</div>
@endif
      </div>

  <div class="field third"><label>@lang('messages.exam.severity')</label>
        <select name="exam[severity]">
@if ($errors->has('exam.severity'))
  <div class="field-error">{{ $errors->first('exam.severity') }}</div>
@endif
          @foreach ([1=>__('messages.exam.mild'),2=>__('messages.exam.moderate'),3=>__('messages.exam.severe'),4=>__('messages.exam.very_severe')] as $k=>$v)
            <option value="{{ $k }}" @selected(($visit->severity ?? null)==$k)>@lang('messages.exam.'.($k==1?'mild':($k==2?'moderate':($k==3?'severe':'very_severe'))))</option>
          @endforeach
        </select>
      </div>

  <div class="field third"><label>@lang('messages.exam.duration')</label>
        <select name="exam[duration]">
@if ($errors->has('exam.duration'))
  <div class="field-error">{{ $errors->first('exam.duration') }}</div>
@endif
          @foreach ([
            '<1m'=>__('messages.exam.less_than_month'),
            '1-3m'=>__('messages.exam.one_to_three_months'),
            '3-6m'=>__('messages.exam.three_to_six_months'),
            '6-12m'=>__('messages.exam.six_to_twelve_months'),
            '>12m'=>__('messages.exam.more_than_year')
          ] as $k=>$v)
            <option value="{{ $k }}" @selected(($visit->duration_bucket ?? null)==$k)>@lang('messages.exam.'.(
              $k=='<1m'?'less_than_month':
              ($k=='1-3m'?'one_to_three_months':
              ($k=='3-6m'?'three_to_six_months':
              ($k=='6-12m'?'six_to_twelve_months':'more_than_year')))))</option>
          @endforeach
        </select>
      </div>

      <div class="field third"><label>@lang('messages.exam.clinical_picture')</label>
        <textarea name="exam[clinical_picture]" placeholder="@lang('messages.exam.clinical_picture_placeholder')">{{ old('exam.clinical_picture', $visit->exam['clinical_picture'] ?? '') }}</textarea>
@if ($errors->has('exam.clinical_picture'))
  <div class="field-error">{{ $errors->first('exam.clinical_picture') }}</div>
@endif
      </div>
    </div>

    {{-- أدوات الخريطة --}}
    <div class="bp-toolbar">
      <button type="button" class="btn danger" id="deleteBtn">@lang('messages.exam.delete_selected')</button>
      <button type="button" class="btn danger" id="deleteAllBtn">@lang('messages.exam.delete_all')</button>
    </div>

    {{-- BODY PICKER --}}
    <div class="bodypicker" id="BodyPicker" aria-label="@lang('messages.exam.body_map')">
      <div class="bp-title">@lang('messages.exam.distribution')</div>
      <div class="bp-canvas" id="bpCanvas">
  <img id="bpImage" class="bp-img" alt="Body Front" draggable="false"  src="{{ $visit->bp_image_url ?? 'https://api.cefour.com/storage/image/anatomy_68bc89752e694.png' }}">
        {{-- نقاط ديناميكية بالـ JS --}}
      </div>
    </div>
    <input type="hidden" id="locationsInput" name="exam[body_spots]" value='@json($visit->body_spots ?? [])'>
        @if ($errors->has('exam.body_spots'))
            <div class="field-error">{{ $errors->first('exam.body_spots') }}</div>
        @endif
        @if ($errors->has('exam.body_spots'))
            <div class="field-error">{{ $errors->first('exam.body_spots') }}</div>
        @endif

    {{-- جدول التشخيص --}}
    <div class="row" style="margin-top:12px; margin-bottom: 12px;">
      <div class="field full">
        <div class="table-head-flex">
          <label>@lang('messages.exam.diagnosis_table')</label>
          <button type="button" id="addDxRow" class="btn primary">+ @lang('messages.exam.add_diagnosis')</button>
        </div>
        <div class="table-wrap">
          <table>
            <thead><tr><th>@lang('messages.exam.diagnosis')</th><th>@lang('messages.exam.diagnosis_note')</th><th>@lang('messages.exam.remove')</th></tr></thead>
            <tbody id="dxBody">
              @php $dxList = old('exam.dx', $visit->diagnosis ?? [['name'=>'','note'=>'']]); @endphp
              @for ($i = 0; $i < count($dxList); $i++)
                <tr>
                  <td><input name="exam[diagnosis][{{ $i }}][name]" value="{{ $dxList[$i]['name'] }}"></td>
                  <td><input name="exam[diagnosis][{{ $i }}][note]" value="{{ $dxList[$i]['note'] }}"></td>
                  <td><button class="btn danger dx-remove" type="button">@lang('messages.exam.remove')</button></td>
                </tr>
              @endfor
            </tbody>
          </table>
        </div>
      </div>
  <div class="field third"><label>@lang('messages.exam.follow_up_at')</label><input type="date" name="exam[follow_up_at]" value="{{ old('exam.follow_up_at', $visit->exam['follow_up_at'] ?? '') }}"></div>
    </div>
  </div>
</div>
