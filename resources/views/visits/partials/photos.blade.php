@if ($errors->has('photos'))
  <div class="field-error">{{ $errors->first('photos') }}</div>
@endif

<div class="tab-content-wrapper">
  <div class="grid">
    <div class="card">
      <div class="head">
        <h3>@lang('messages.photos.title')</h3>
      </div>

      <div class="body">
        <div class="hint mb-8">@lang('messages.photos.hint')</div>

        <div class="row">
          <div class="field full">
            <label>@lang('messages.photos.note')</label>
            <input
              name="photos[note]"
              placeholder="@lang('messages.photos.note_placeholder')"
              value="{{ old('photos.note', $photos['note'] ?? '') }}">
          </div>

          <div class="field third">
            <input type="file" name="photos[files][]" accept="image/*">
          </div>
          <div class="field third">
            <input type="file" name="photos[files][]" accept="image/*">
          </div>
          <div class="field third">
            <input type="file" name="photos[files][]" accept="image/*">
          </div>
        </div>

        @if(!empty($photos['existing']))
          <div class="gallery mt-10">
            @foreach ($photos['existing'] as $img)
              <a href="{{ $img['url'] }}" target="_blank">
                <img src="{{ $img['url'] }}" alt="photo">
              </a>
            @endforeach
          </div>
        @endif
      </div>
    </div>
  </div>
</div>

<style>
  /* ✅ تناسق عام مثل باقي التابات */
  .tab-content-wrapper {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 16px;
  }

  .tab-content-wrapper .grid {
    display: grid;
    grid-template-columns: 1fr;
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

  /* ✅ تنسيق الصور */
  .gallery {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
  }

  .gallery img {
    width: 160px;
    height: 160px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
    transition: transform 0.2s ease;
  }

  .gallery img:hover {
    transform: scale(1.05);
  }

  @media (max-width: 900px) {
    .tab-content-wrapper .grid {
      grid-template-columns: 1fr;
    }
  }
</style>
