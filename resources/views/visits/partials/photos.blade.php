<div class="card">

  <div class="head"><h3>📸 صور الحالة</h3></div><div class="card">

  <div class="body">  <div class="head"><h3>📸 صور الحالة</h3></div>

    <div class="hint" style="margin-bottom:8px">الرجاء الحصول على موافقة تصوير واضحة من المريض.</div>  <div class="body">

    <div class="row">    <div class="hint" style="margin-bottom:8px">الرجاء الحصول على موافقة تصوير واضحة من المريض.</div>

      <div class="field full"><label>ملاحظات على الصور</label><input placeholder="مسافة 50سم، إضاءة موحّدة، زاوية أمامية/جانبية"></div>    <div class="row">

      <div class="field third"><div class="btn" style="width:100%">إضافة صورة</div></div>      <div class="field full"><label>ملاحظات على الصور</label><input name="photos_notes" placeholder="مسافة 50سم، إضاءة موحّدة، زاوية أمامية/جانبية" value="{{ old('photos_notes', $photos_notes ?? '') }}"></div>

      <div class="field third"><div class="btn" style="width:100%">إضافة صورة</div></div>      @for($i=0; $i<3; $i++)

      <div class="field third"><div class="btn" style="width:100%">إضافة صورة</div></div>      <div class="field third">

    </div>        <label style="display:block;width:100%">

  </div>          <input type="file" class="photo-input" name="photos[]" style="display:none">

</div>          <div class="btn" style="width:100%;cursor:pointer;">إضافة صورة</div>

        </label>
      </div>
      @endfor
    </div>
  </div>
</div>

<div class="card">
  <div class="head">
    <h3>{{ __('photos') }}</h3>
  </div>
  <div class="body">
    <div class="row">
      <div class="field full">
        <label>{{ __('photo_notes') }}</label>
        <input name="photos_notes" placeholder="{{ __('photo_notes') }}">
      </div>
      <div class="field full">
        <label>{{ __('add_photo') }}</label>
        <div id="photosGrid" style="display:flex;gap:16px;flex-wrap:wrap;">
          <label style="display:block;width:220px;">
            <input type="file" class="photo-input" name="photos[]" style="display:none">
            <div style="border:2px dashed #cbd5e1;border-radius:14px;display:flex;align-items:center;justify-content:center;padding:32px 0;background:#f9fafc;color:#64748b;cursor:pointer;">
              + {{ __('add_photo') }}
            </div>
          </label>
        </div>
      </div>
    </div>
  </div>
</div>
