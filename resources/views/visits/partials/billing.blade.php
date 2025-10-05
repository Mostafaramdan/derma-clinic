@if ($errors->has('services'))
  <div class="field-error">{{ $errors->first('services') }}</div>
@endif
@if ($errors->has('invoice'))
  <div class="field-error">{{ $errors->first('invoice') }}</div>
@endif

<div class="tab-content-wrapper">
  <div class="grid-two">
    {{-- جدول الخدمات --}}
    <div class="card">
      <div class="head"><h3>@lang('messages.billing.services_title')</h3></div>
      <div class="body">

        <div class="hint mb-8">@lang('messages.billing.price_hint')</div>

        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th>@lang('messages.billing.service')</th>
                <th>@lang('messages.billing.price_egp')</th>
                <th>@lang('messages.billing.qty')</th>
                <th>@lang('messages.billing.line_total')</th>
                <th>@lang('messages.billing.remove')</th>
              </tr>
            </thead>
            <tbody id="svcBody">
              @php
                $servicesList = old('services', (array)($services ?? [['service_id'=>'','custom_name'=>'','price'=>0,'qty'=>1]]));
              @endphp
              @foreach ($servicesList as $i => $svc)
                <tr>
                  <td>
                    <select name="services[{{ $i }}][service_id]" class="svc-select">
                      <option value="">— اختر —</option>
                      @foreach ($services as $srv)
                        <option value="{{ $srv->id }}" data-price="{{ $srv->default_price }}" @selected(($svc['service_id'] ?? '') == $srv->id)>
                          {{ $srv->label() }}
                        </option>
                      @endforeach
                      <option value="__new__" @selected(($svc['service_id'] ?? '') == '__new__')>+ خدمة جديدة</option>
                    </select>
                    <input type="text" name="services[{{ $i }}][custom_name]" value="{{ $svc['custom_name'] ?? '' }}" class="svc-custom mt-2" placeholder="اسم الخدمة الجديدة" style="@if(($svc['service_id'] ?? '') == '__new__') display:block; @else display:none; @endif">
                  </td>
                  <td><input name="services[{{ $i }}][price]" class="svc-price" type="number" min="0" step="1" value="{{ $svc['price'] ?? 0 }}"></td>
                  <td><input name="services[{{ $i }}][qty]" class="svc-qty" type="number" min="1" step="1" value="{{ $svc['qty'] ?? 1 }}"></td>
                  <td><strong class="line-total">EGP {{ number_format(($svc['price'] ?? 0) * ($svc['qty'] ?? 1), 2) }}</strong></td>
                  <td><button class="btn danger svc-remove" type="button">@lang('messages.billing.remove')</button></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <button id="addSvc" class="btn mt-8" type="button">+ @lang('messages.billing.add_service')</button>

      </div>
    </div>

    {{-- ملخص الفاتورة --}}
    <aside class="card">
      <div class="head"><h3>@lang('messages.billing.summary_title')</h3></div>
      <div class="body">
        <div class="row">
          <div class="field third">
            <label>@lang('messages.billing.payment_method')</label>
            <select name="invoice[payment_method]">
              <option value="cash" @selected(old('invoice.payment_method', $invoice['payment_method'] ?? '') == 'cash')>@lang('messages.billing.cash')</option>
              <option value="transfer" @selected(old('invoice.payment_method', $invoice['payment_method'] ?? '') == 'transfer')>@lang('messages.billing.transfer')</option>
            </select>
          </div>
          <div class="field third">
            <label>@lang('messages.billing.discount_reason')</label>
            <input name="invoice[discount_reason]" value="{{ old('invoice.discount_reason', $invoice['discount_reason'] ?? '') }}" placeholder="@lang('messages.billing.discount_placeholder')">
          </div>
          <div class="field third">
            <label>@lang('messages.billing.discount_value')</label>
            <input name="invoice[discount_value]" id="discInput" type="number" min="0" step="1" value="{{ old('invoice.discount_value', $invoice['discount_value'] ?? 0) }}">
          </div>
        </div>

        <div class="totals mt-4">
          <div class="line"><span>@lang('messages.billing.subtotal')</span><strong id="subtotalVal">EGP 0.00</strong></div>
          <div class="line"><span>@lang('messages.billing.discount')</span><strong id="discountVal">EGP 0.00</strong></div>
          <div class="line grand"><span>@lang('messages.billing.total')</span><strong id="totalVal">EGP 0.00</strong></div>
        </div>
      </div>
    </aside>
  </div>
</div>

<style>
  .tab-content-wrapper { max-width: 1200px; margin: 0 auto; padding: 0 16px; }
  .grid-two { display: grid; grid-template-columns: 2fr 1fr; gap: 20px; }
  .card { background: #fff; border-radius: 10px; box-shadow: 0 2px 8px #0000000d; }
  .card .head { border-bottom: 1px solid #e2e8f0; padding: 12px 18px; }
  .card .body { padding: 18px; }
  .table-wrap table { width: 100%; border-collapse: collapse; }
  .table-wrap th, .table-wrap td { border-bottom: 1px solid #eee; padding: 8px; vertical-align: middle; }
  .totals { margin-top: 18px; border-top: 1px solid #e2e8f0; padding-top: 12px; }
  .totals .line { display: flex; justify-content: space-between; margin-bottom: 6px; color: #475569; }
  .totals .grand { font-weight: bold; color: #111827; font-size: 1.1em; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const svcBody = document.getElementById('svcBody');
  const addBtn = document.getElementById('addSvc');

  function updateTotals() {
    let subtotal = 0;
    svcBody.querySelectorAll('tr').forEach(tr => {
      const price = parseFloat(tr.querySelector('.svc-price')?.value || 0);
      const qty = parseFloat(tr.querySelector('.svc-qty')?.value || 1);
      const lineTotal = price * qty;
      tr.querySelector('.line-total').innerText = 'EGP ' + lineTotal.toFixed(2);
      subtotal += lineTotal;
    });
    document.getElementById('subtotalVal').innerText = 'EGP ' + subtotal.toFixed(2);
    const discount = parseFloat(document.querySelector('[name="invoice[discount_value]"]').value || 0);
    document.getElementById('discountVal').innerText = 'EGP ' + discount.toFixed(2);
    document.getElementById('totalVal').innerText = 'EGP ' + (subtotal - discount).toFixed(2);
  }

  addBtn.addEventListener('click', function() {
    const rows = svcBody.querySelectorAll('tr');
    const newIndex = rows.length;
    const newRow = rows[0].cloneNode(true);
    newRow.querySelectorAll('input, select').forEach(el => {
      const name = el.name.replace(/\[\d+\]/, `[${newIndex}]`);
      el.name = name;
      if (el.tagName === 'SELECT') el.selectedIndex = 0;
      if (el.classList.contains('svc-custom')) el.style.display = 'none';
      else el.value = (el.classList.contains('svc-qty') ? 1 : '');
    });
    newRow.querySelector('.line-total').innerText = 'EGP 0.00';
    svcBody.appendChild(newRow);
  });

  svcBody.addEventListener('click', function(e) {
    if (e.target.classList.contains('svc-remove')) {
      if (svcBody.querySelectorAll('tr').length > 1) {
        e.target.closest('tr').remove();
        updateTotals();
      }
    }
  });

  svcBody.addEventListener('change', function(e) {
    if (e.target.classList.contains('svc-select')) {
      const tr = e.target.closest('tr');
      const priceInput = tr.querySelector('.svc-price');
      const customInput = tr.querySelector('.svc-custom');
      const selected = e.target.selectedOptions[0];
      if (e.target.value === '__new__') {
        customInput.style.display = 'block';
        priceInput.value = 0;
      } else {
        customInput.style.display = 'none';
        priceInput.value = selected.dataset.price || 0;
      }
      updateTotals();
    }
  });

  svcBody.addEventListener('input', e => {
    if (e.target.classList.contains('svc-price') || e.target.classList.contains('svc-qty')) {
      updateTotals();
    }
  });

  const discInput = document.querySelector('[name="invoice[discount_value]"]');
  discInput.addEventListener('input', updateTotals);

  updateTotals();
});
</script>
