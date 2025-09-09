<div class="card shadow-sm">
  <div class="card-header fw-bold text-primary">{{ __('services') }}</div>
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center mb-2">
      <div class="fw-bold m-0">{{ __('services') }}</div>
      <button class="btn btn-primary btn-sm" id="addSvcRow">+ {{ __('add_service') }}</button>
    </div>

    <div id="svcRepeater">
      <div class="svc-item row g-2 align-items-end border rounded-3 p-2 mb-2">
        <div class="col-md-4">
          <label class="form-label">{{ __('service') }}</label>
          <select class="form-select svc-select" name="services[0][service_id]">
            @foreach(($services ?? []) as $s)
              <option value="{{ $s->id }}" data-price="{{ $s->default_price }}">{{ $s->label() }}</option>
            @endforeach
            <option value="" data-price="0">— {{ __('other') ?? 'Other' }} —</option>
          </select>
        </div>
        <div class="col-md-2">
          <label class="form-label">{{ __('price') }}</label>
          <input type="number" class="form-control svc-price" name="services[0][price]" value="{{ ($services[0]->default_price ?? 0) }}">
        </div>
        <div class="col-md-2">
          <label class="form-label">{{ __('qty') }}</label>
          <input type="number" class="form-control svc-qty" name="services[0][qty]" value="1" min="1">
        </div>
        <div class="col-md-3">
          <label class="form-label">{{ __('line_total') }}</label>
          <div class="form-control-plaintext fw-bold text-primary line-total">EGP 0.00</div>
        </div>
        <div class="col-md-1 d-grid">
          <button type="button" class="btn btn-outline-danger svc-remove">✕</button>
        </div>
      </div>
    </div>

    <hr>

    <div class="row g-3">
      <div class="col-md-3">
        <label class="form-label">{{ __('payment_method') }}</label>
        <select class="form-select" name="invoice[payment_method]">
          <option value="cash">{{ __('cash') }}</option>
          <option value="transfer">{{ __('transfer') }}</option>
        </select>
      </div>
      <div class="col-md-3">
        <label class="form-label">{{ __('discount') }}</label>
        <input type="number" class="form-control" name="invoice[discount_amount]" id="discInput" value="0" min="0">
      </div>
      <div class="col-md-6">
        <label class="form-label">{{ __('discount_reason') }}</label>
        <input class="form-control" name="invoice[discount_reason]" id="discReason" placeholder="{{ __('discount_reason') }}">
      </div>
    </div>

    <div class="row g-3 mt-3">
      <div class="col-md-3"><div class="d-flex justify-content-between"><span>{{ __('subtotal') }}</span><strong id="subtotalVal">EGP 0.00</strong></div></div>
      <div class="col-md-3"><div class="d-flex justify-content-between"><span>{{ __('discount') }}</span><strong id="discountVal">EGP 0.00</strong></div></div>
      <div class="col-md-3"></div>
      <div class="col-md-3"><div class="d-flex justify-content-between fw-bold text-primary"><span>{{ __('total') }}</span><span id="totalVal">EGP 0.00</span></div></div>
    </div>
  </div>
</div>
