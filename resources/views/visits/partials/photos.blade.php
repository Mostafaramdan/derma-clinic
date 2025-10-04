@if ($errors->has('photos'))
  <div class="field-error">{{ $errors->first('photos') }}</div>
@endif
<div class="card">
  <div class="head"><h3>@lang('messages.photos.title')</h3></div>
  <div class="body">
  <div class="hint mb-8">@lang('messages.photos.hint')</div>
    <div class="row">
  <div class="field full"><label>@lang('messages.photos.note')</label><input name="photos[note]" placeholder="@lang('messages.photos.note_placeholder')" value="{{ old('photos.note', $photos['note'] ?? '') }}"></div>
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
