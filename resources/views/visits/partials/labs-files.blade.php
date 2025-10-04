@if ($errors->has('labs'))
  <div class="field-error">{{ $errors->first('labs') }}</div>
@endif
@if ($errors->has('files'))
  <div class="field-error">{{ $errors->first('files') }}</div>
@endif
<div class="grid">
  <div class="card">
  <div class="head"><h3>@lang('messages.labs_files.labs_title')</h3></div>
    <div class="body">
  <div class="hint">@lang('messages.labs_files.upload_hint')</div>

      <div id="labRepeater" class="mt-10">
        @php
          $labsList = old('labs', (array)($labs ?? []));
          if (!$labsList) $labsList = [['name'=>'','note'=>'','provider'=>'','file'=>null]];
        @endphp
        @foreach ($labsList as $i=>$lab)
          <div class="lab-item">
            <div class="row">
              <div class="field third"><label>@lang('messages.labs_files.lab_name')</label><input name="labs[{{ $i }}][name]" value="{{ $lab['name'] ?? '' }}" placeholder="CBC / LFTs / …"></div>
              <div class="field third"><label>@lang('messages.labs_files.note')</label><input name="labs[{{ $i }}][note]" value="{{ $lab['note'] ?? '' }}" placeholder="@lang('messages.labs_files.note_placeholder')"></div>
              <div class="field third"><label>@lang('messages.labs_files.upload_result')</label><input type="file" name="labs[{{ $i }}][file]"></div>
              <div class="field third"><label>@lang('messages.labs_files.provider')</label><input name="labs[{{ $i }}][provider]" value="{{ $lab['provider'] ?? '' }}" placeholder="@lang('messages.labs_files.provider_placeholder')"></div>
              <div class="field quarter"><label>&nbsp;</label><button class="btn lab-remove" type="button" style="width:100%">@lang('messages.labs_files.remove')</button></div>
            </div>
          </div>
        @endforeach
      </div>

  <button id="addLab" class="btn mt-8" type="button">+ @lang('messages.labs_files.add_lab')</button>
    </div>
  </div>

  <aside class="card">
  <div class="head"><h3>@lang('messages.labs_files.saved_files_title')</h3></div>
    <div class="body">
      <table>
        <thead><tr><th>@lang('messages.labs_files.file')</th><th>@lang('messages.labs_files.type')</th><th>@lang('messages.labs_files.date')</th><th>@lang('messages.labs_files.action')</th></tr></thead>
        <tbody>
          @forelse(($files ?? []) as $f)
            <tr>
              <td>{{ $f->name }}</td>
              <td>{{ strtoupper($f->type) }}</td>
              <td>{{ optional($f->created_at)->format('d-m-Y') }}</td>
              <td><a class="btn" href="{{ $f->url }}" target="_blank">@lang('messages.labs_files.show')</a></td>
            </tr>
          @empty
            <tr><td colspan="4" class="hint">@lang('messages.labs_files.empty')</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </aside>
</div>
