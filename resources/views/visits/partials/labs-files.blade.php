<div class="card shadow-sm">
  <div class="card-header fw-bold text-primary">{{ __('labs_files') }}</div>
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center mb-2">
      <div class="fw-bold m-0">{{ __('labs_files') }}</div>
      <button class="btn btn-primary btn-sm" id="addLabRow">+ {{ __('add_lab') }}</button>
    </div>

    <div id="labRepeater" class="border rounded-3 p-3 bg-white">
      <div class="lab-item row g-2 align-items-end border rounded-3 p-2 mb-2">
        <div class="col-md-3">
          <label class="form-label">{{ __('lab_name') }}</label>
          <input class="form-control" name="labs[0][test_name]" placeholder="{{ __('lab_name') }}">
        </div>
        <div class="col-md-3">
          <label class="form-label">{{ __('lab_notes') }}</label>
          <input class="form-control" name="labs[0][notes]" placeholder="{{ __('lab_notes') }}">
        </div>
        <div class="col-md-3">
          <label class="form-label">{{ __('lab_upload') }}</label>
          <input type="file" class="form-control" name="labs[0][file]">
        </div>
        <div class="col-md-2">
          <label class="form-label">{{ __('lab_info') }}</label>
          <input class="form-control" name="labs[0][lab_info]" value="{{ __('lab_default_info') }}">
        </div>
        <div class="col-md-1 d-grid">
          <button type="button" class="btn btn-outline-danger lab-remove">✕</button>
        </div>
      </div>
    </div>

    <hr>

    <div class="mt-2">
      <div class="fw-bold mb-2">📎 {{ __('saved_files') }}</div>
      <div class="table-responsive">
        <table class="table align-middle">
          <thead class="table-light">
            <tr>
              <th>{{ __('file') }}</th>
              <th>{{ __('type') }}</th>
              <th>{{ __('date') }}</th>
              <th>{{ __('action') }}</th>
            </tr>
          </thead>
          <tbody id="filesTable">
            {{-- أمثلة (استبدلها من الـDB) --}}
            <tr>
              <td>CBC-Result-2025-09-02.pdf</td>
              <td>PDF</td>
              <td>02-09-2025</td>
              <td><button class="btn btn-sm btn-outline-secondary">{{ __('view') }}</button></td>
            </tr>
            <tr>
              <td>lesion-closeup-1.jpg</td>
              <td>Image</td>
              <td>02-09-2025</td>
              <td><button class="btn btn-sm btn-outline-secondary">{{ __('view') }}</button></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>
