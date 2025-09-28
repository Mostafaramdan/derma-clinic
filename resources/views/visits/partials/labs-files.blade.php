<div class="grid">
  <div class="card">
    <div class="head"><h3>🧪 التحاليل</h3></div>
    <div class="body">
      <div class="hint">اسحب ملف نتيجة (PDF/صورة) أو اضغط للاختيار</div>

      <div id="labRepeater" class="mt-10">
        @php
          $labsList = old('labs', (array)($labs ?? []));
          if (!$labsList) $labsList = [['name'=>'','note'=>'','provider'=>'','file'=>null]];
        @endphp
        @foreach ($labsList as $i=>$lab)
          <div class="lab-item">
            <div class="row">
              <div class="field third"><label>اسم التحليل</label><input name="labs[{{ $i }}][name]" value="{{ $lab['name'] ?? '' }}" placeholder="CBC / LFTs / …"></div>
              <div class="field third"><label>ملاحظات</label><input name="labs[{{ $i }}][note]" value="{{ $lab['note'] ?? '' }}" placeholder="صيام، وقت، إلخ"></div>
              <div class="field third"><label>رفع النتيجة</label><input type="file" name="labs[{{ $i }}][file]"></div>
              <div class="field third"><label>بيان المعمل</label><input name="labs[{{ $i }}][provider]" value="{{ $lab['provider'] ?? '' }}" placeholder="المعمل : …"></div>
              <div class="field quarter"><label>&nbsp;</label><button class="btn lab-remove" type="button" style="width:100%">حذف</button></div>
            </div>
          </div>
        @endforeach
      </div>

      <button id="addLab" class="btn mt-8" type="button">+ إضافة تحليل</button>
    </div>
  </div>

  <aside class="card">
    <div class="head"><h3>📎 ملفات محفوظة</h3></div>
    <div class="body">
      <table>
        <thead><tr><th>الملف</th><th>النوع</th><th>التاريخ</th><th>إجراء</th></tr></thead>
        <tbody>
          @forelse(($files ?? []) as $f)
            <tr>
              <td>{{ $f->name }}</td>
              <td>{{ strtoupper($f->type) }}</td>
              <td>{{ optional($f->created_at)->format('d-m-Y') }}</td>
              <td><a class="btn" href="{{ $f->url }}" target="_blank">عرض</a></td>
            </tr>
          @empty
            <tr><td colspan="4" class="hint">لا توجد ملفات محفوظة.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </aside>
</div>
