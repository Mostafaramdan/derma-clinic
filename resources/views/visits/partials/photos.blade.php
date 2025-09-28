<div class="card">
  <div class="head"><h3>📸 صور الحالة</h3></div>
  <div class="body">
    <div class="hint mb-8">الرجاء الحصول على موافقة تصوير واضحة من المريض.</div>
    <div class="row">
      <div class="field full"><label>ملاحظات على الصور</label><input name="photos[note]" placeholder="مسافة 50سم، إضاءة موحّدة، زاوية أمامية/جانبية" value="{{ old('photos.note', $photos['note'] ?? '') }}"></div>
      <div class="field third"><input type="file" name="photos[files][]" accept="image/*"></div>
      <div class="field third"><input type="file" name="photos[files][]" accept="image/*"></div>
      <div class="field third"><input type="file" name="photos[files][]" accept="image/*"></div>
    </div>

    @if(!empty($photos['existing']))
      <div class="gallery mt-10">
        @foreach ($photos['existing'] as $img)
          <a href="{{ $img['url'] }}" target="_blank"><img src="{{ $img['url'] }}" alt="photo"></a>
        @endforeach
      </div>
    @endif
  </div>
</div>
