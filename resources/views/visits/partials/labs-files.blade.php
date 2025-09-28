<div class="grid">

  <div class="card"><div class="grid">

    <div class="head"><h3>🧪 التحاليل</h3></div>  <div class="card">

    <div class="body">    <div class="head"><h3>🧪 التحاليل</h3></div>

      <div class="hint">اسحب ملف نتيجة (PDF/صورة) أو اضغط للاختيار</div>    <div class="body">

      <div id="labRepeater" style="margin-top:10px">      <div class="hint">اسحب ملف نتيجة (PDF/صورة) أو اضغط للاختيار</div>

        <div class="lab-item" style="border:1px solid var(--line);border-radius:14px;padding:12px;margin-top:8px;background:#fff">      <div id="labRepeater" style="margin-top:10px">

          <div class="row">        @foreach(($labs ?? [ ['test_name'=>'','notes'=>'','file'=>'','lab_info'=>''] ]) as $lab)

            <div class="field third"><label>اسم التحليل</label><input placeholder="CBC / LFTs / …"></div>        <div class="lab-item" style="border:1px solid var(--line);border-radius:14px;padding:12px;margin-top:8px;background:#fff">

            <div class="field third"><label>ملاحظات</label><input placeholder="صيام، وقت، إلخ"></div>          <div class="row">

            <div class="field third"><label>رفع النتيجة</label><input type="file"></div>            <div class="field third"><label>اسم التحليل</label><input name="labs[][test_name]" placeholder="CBC / LFTs / …" value="{{ $lab['test_name'] ?? '' }}"></div>

            <div class="field third"><label>بيان المعمل</label><input value="المعمل : القصر العيني"></div>            <div class="field third"><label>ملاحظات</label><input name="labs[][notes]" placeholder="صيام، وقت، إلخ" value="{{ $lab['notes'] ?? '' }}"></div>

            <div class="field quarter"><label>&nbsp;</label><button class="btn lab-remove" style="width:100%">حذف</button></div>            <div class="field third"><label>رفع النتيجة</label><input type="file" name="labs[][file]"></div>

          </div>            <div class="field third"><label>بيان المعمل</label><input name="labs[][lab_info]" value="{{ $lab['lab_info'] ?? 'المعمل : القصر العيني' }}"></div>

        </div>            <div class="field quarter"><label>&nbsp;</label><button class="btn lab-remove" style="width:100%">حذف</button></div>

      </div>          </div>

      <button id="addLab" class="btn" style="margin-top:8px">+ إضافة تحليل</button>        </div>

    </div>        @endforeach

  </div>      </div>

  <aside class="card">      <button id="addLab" class="btn" style="margin-top:8px">+ إضافة تحليل</button>

    <div class="head"><h3>📎 ملفات محفوظة</h3></div>    </div>

    <div class="body">  </div>

      <table>  <aside class="card">

        <thead><tr><th>الملف</th><th>النوع</th><th>التاريخ</th><th>إجراء</th></tr></thead>    <div class="head"><h3>📎 ملفات محفوظة</h3></div>

        <tbody>    <div class="body">

          <tr><td>CBC-Result-2025-09-02.pdf</td><td>PDF</td><td>02-09-2025</td><td><button class="btn">عرض</button></td></tr>      <table>

          <tr><td>lesion-closeup-1.jpg</td><td>صورة</td><td>02-09-2025</td><td><button class="btn">عرض</button></td></tr>        <thead><tr><th>الملف</th><th>النوع</th><th>التاريخ</th><th>إجراء</th></tr></thead>

        </tbody>        <tbody>

      </table>          @foreach(($files ?? [ ['name'=>'','type'=>'','date'=>'','action'=>''] ]) as $file)

    </div>          <tr>

  </aside>            <td>{{ $file['name'] ?? '' }}</td>

</div>            <td>{{ $file['type'] ?? '' }}</td>

            <td>{{ $file['date'] ?? '' }}</td>
            <td><button class="btn">{{ $file['action'] ?? 'عرض' }}</button></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </aside>
</div>

<div class="card">
  <div class="head">
    <h3>{{ __('labs_files') }}</h3>
  </div>
  <div class="body">
    <div class="row">
      <div class="field full">
        <label>{{ __('labs') }}</label>
        <div id="labRepeater">
          <div class="lab-item" style="display:grid;grid-template-columns:repeat(5,1fr);gap:12px;align-items:end;margin-bottom:12px;border:1px solid #e2e8f0;border-radius:14px;padding:12px;">
            <div>
              <label>{{ __('lab_name') }}</label>
              <input name="labs[0][test_name]" placeholder="{{ __('lab_name') }}">
            </div>
            <div>
              <label>{{ __('lab_notes') }}</label>
              <input name="labs[0][notes]" placeholder="{{ __('lab_notes') }}">
            </div>
            <div>
              <label>{{ __('lab_upload') }}</label>
              <input type="file" name="labs[0][file]">
            </div>
            <div>
              <label>{{ __('lab_info') }}</label>
              <input name="labs[0][lab_info]" value="{{ __('lab_default_info') }}">
            </div>
            <div>
              <button type="button" class="chip lab-remove">✕</button>
            </div>
          </div>
        </div>
      </div>
      <div class="field full">
        <label>{{ __('saved_files') }}</label>
        <div style="overflow-x:auto">
          <table style="width:100%;border-collapse:collapse;font-size:14px">
            <thead>
              <tr>
                <th>{{ __('file') }}</th>
                <th>{{ __('type') }}</th>
                <th>{{ __('date') }}</th>
                <th>{{ __('action') }}</th>
              </tr>
            </thead>
            <tbody id="filesTable">
              <tr>
                <td>CBC-Result-2025-09-02.pdf</td>
                <td>PDF</td>
                <td>02-09-2025</td>
                <td><button type="button" class="chip">{{ __('view') }}</button></td>
              </tr>
              <tr>
                <td>lesion-closeup-1.jpg</td>
                <td>Image</td>
                <td>02-09-2025</td>
                <td><button type="button" class="chip">{{ __('view') }}</button></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
