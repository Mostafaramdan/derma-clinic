<div class="card shadow-sm">
  <div class="card-header fw-bold text-primary">{{ __('photos') }}</div>
  <div class="card-body">
    <div class="mb-2 text-muted small">* {{ __('photo_notes') }}</div>
    <div class="row g-2 mb-3">
      <div class="col-12">
        <input class="form-control" name="photos_notes" placeholder="{{ __('photo_notes') }}">
      </div>
    </div>

    <div id="photosGrid" class="row g-2">
      <div class="col-md-4">
        <label class="w-100">
          <input type="file" class="form-control d-none photo-input" name="photos[]">
          <div class="border rounded-3 d-flex align-items-center justify-content-center p-5 bg-white text-secondary" style="cursor:pointer">
            + {{ __('add_photo') }}
          </div>
        </label>
      </div>
    </div>
  </div>
</div>
