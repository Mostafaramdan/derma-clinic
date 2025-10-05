@if ($errors->has('labs'))
  <div class="field-error">{{ $errors->first('labs') }}</div>
@endif
@if ($errors->has('files'))
  <div class="field-error">{{ $errors->first('files') }}</div>
@endif

<div class="tab-content-wrapper">
  <div class="grid">
    <div class="card">
      <div class="head">
        <h3>@lang('messages.labs_files.labs_title')</h3>
      </div>
      <div class="body">
        <div class="hint">@lang('messages.labs_files.upload_hint')</div>

        <div id="labRepeater" class="mt-10">

          @foreach ($visit->labs()->get() as $i=>$lab)
            <div class="lab-item">
              <div class="row">
                <div class="field third">
                  <label>@lang('messages.labs_files.lab_name')</label>
                  <input name="labs[{{ $i }}][name]" value="{{ $lab['test_name'] ?? '' }}" placeholder="@lang('messages.labs_files.lab_name_placeholder')">
                </div>
                <div class="field third">
                  <label>@lang('messages.labs_files.note')</label>
                  <input name="labs[{{ $i }}][note]" value="{{ $lab['notes'] ?? '' }}" placeholder="@lang('messages.labs_files.note_placeholder')">
                </div>
                <div class="field third">
                  <label>@lang('messages.labs_files.upload_result')</label>
                  <input type="file" name="labs[{{ $i }}][file]">
                  @if (!empty($lab['file_url']))
                    <div class="mt-2">
                      <a href="{{ $lab->resultFile->file_url }}" target="_blank" class="btn btn-sm">عرض النتيجة</a>
                    </div>
                  @endif
                </div>
                <div class="field third">
                  <label>@lang('messages.labs_files.provider')</label>
                  <input name="labs[{{ $i }}][provider]" value="{{ $lab['lab_info'] ?? '' }}" placeholder="@lang('messages.labs_files.provider_placeholder')">
                </div>
                <div class="field quarter">
                  <label>&nbsp;</label>
                  <button class="btn lab-remove" type="button" style="width:100%">@lang('messages.labs_files.remove')</button>
                </div>
              </div>
            </div>
          @endforeach
        </div>

        <button id="addLab" class="btn mt-8" type="button">
          + @lang('messages.labs_files.add_lab')
        </button>
      </div>
    </div>

    <aside class="card">
      <div class="head">
        <h3>@lang('messages.labs_files.saved_files_title')</h3>
      </div>
      <div class="body">
        <table>
          <thead>
            <tr>
              <th>@lang('messages.labs_files.type')</th>
              <th>@lang('messages.labs_files.date')</th>
              <th>@lang('messages.labs_files.action')</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($visit->labs()->get() as $i=>$lab)
              <tr>
                <td>{{ __("messages.{$lab->resultFile->type}") }}</td>
                <td>{{ optional($lab['created_at'])->format(__('messages.labs_files.date_format')) }}</td>
                <td><a class="btn" href="{{ url("storage/" . $lab->resultFile->path) }}" target="_blank">@lang('messages.labs_files.show')</a></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </aside>
  </div>
</div>

<style>
  /* ✅ لإرجاع التناسق البصري زي باقي التابات */
  .tab-content-wrapper {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 16px;
  }

  .tab-content-wrapper .grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 16px;
  }

  .tab-content-wrapper .card {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 8px #0000000d;
  }

  .tab-content-wrapper .card .head {
    border-bottom: 1px solid #e2e8f0;
    padding: 12px 18px;
  }

  .tab-content-wrapper .card .body {
    padding: 18px;
  }

  @media (max-width: 900px) {
    .tab-content-wrapper .grid {
      grid-template-columns: 1fr;
    }
  }
</style>
