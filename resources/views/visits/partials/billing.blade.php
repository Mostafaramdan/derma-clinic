@if ($errors->has('services'))
  <div class="field-error">{{ $errors->first('services') }}</div>
@endif
@if ($errors->has('invoice'))
  <div class="field-error">{{ $errors->first('invoice') }}</div>
@endif

<div class="tab-content-wrapper">
  <div class="grid">
    <div class="card">
      <div class="head">
        <h3>@lang('messages.billing.services_title')</h3>
      </div>

      <div class="body">
        <div class="hint">@lang('messages.billing.price_hint')</div>


        <div id="svcRepeater">
          @php
            $oldServices = old('services', isset($visit) ? $visit->services : []);
          @endphp
          @foreach ($oldServices as $i => $svc)
            <div class="svc-item" style="border:1px solid var(--line);border-radius:14px;padding:12px;margin-top:8px;background:#fff">
              <div class="row">
                <div class="field third">
                  <label>@lang('messages.billing.service')</label>
                  <input type="hidden" name="services[{{ $i }}][service_id]" value="{{ $svc->service_id ?? '' }}">
                  <input type="text" name="services[{{ $i }}][service_name]" value="{{ $svc->service_name ?? '' }}" class="svc-name" placeholder="@lang('messages.billing.service')">
                </div>
                <div class="field quarter">
                  <label>@lang('messages.billing.price_egp')</label>
                  <input class="svc-price" name="services[{{ $i }}][price]" type="number" value="{{ $svc->price ?? 0 }}" min="0" step="1">
                </div>
                <div class="field quarter">
                  <label>@lang('messages.billing.qty')</label>
                  <input class="svc-qty" name="services[{{ $i }}][qty]" type="number" value="{{ $svc->qty ?? 1 }}" min="1" step="1">
                </div>
                <div class="field quarter">
                  <label>@lang('messages.billing.line_total')</label>
                  <input class="svc-line-total" name="services[{{ $i }}][line_total]" type="number" value="{{ $svc->line_total ?? 0 }}" readonly>
                </div>
                <div class="field quarter">
                  <label>&nbsp;</label>
                  <button class="btn svc-remove" type="button" style="width:100%">@lang('messages.billing.remove')</button>
                </div>
              </div>
            </div>
          @endforeach
        </div>

        <button id="addSvc" class="btn mt-8" type="button">+ @lang('messages.billing.add_service')</button>

        <script>
        // ديناميكية إضافة/حذف الخدمات وضبط name تلقائياً
        document.addEventListener('DOMContentLoaded', function() {
          const repeater = document.getElementById('svcRepeater');
          const addBtn = document.getElementById('addSvc');
          function updateNames() {
            const items = repeater.querySelectorAll('.svc-item');
            items.forEach((item, idx) => {
              item.querySelectorAll('input,select').forEach(input => {
                if (input.classList.contains('svc-name')) input.name = `services[${idx}][service_name]`;
                if (input.classList.contains('svc-price')) input.name = `services[${idx}][price]`;
                if (input.classList.contains('svc-qty')) input.name = `services[${idx}][qty]`;
                if (input.classList.contains('svc-line-total')) input.name = `services[${idx}][line_total]`;
              });
            });
          }
          addBtn.addEventListener('click', function() {
            const idx = repeater.querySelectorAll('.svc-item').length;
            const html = `<div class="svc-item" style="border:1px solid var(--line);border-radius:14px;padding:12px;margin-top:8px;background:#fff">
              <div class=\"row\">
                <div class=\"field third\">
                  <label>الخدمة</label>
                  <input type=\"hidden\" name=\"services[${idx}][service_id]\">
                  <input type=\"text\" class=\"svc-name\" name=\"services[${idx}][service_name]\" placeholder=\"الخدمة\">
                </div>
                <div class=\"field quarter\">
                  <label>السعر</label>
                  <input class=\"svc-price\" name=\"services[${idx}][price]\" type=\"number\" value=\"0\" min=\"0\" step=\"1\">
                </div>
                <div class=\"field quarter\">
                  <label>الكمية</label>
                  <input class=\"svc-qty\" name=\"services[${idx}][qty]\" type=\"number\" value=\"1\" min=\"1\" step=\"1\">
                </div>
                <div class=\"field quarter\">
                  <label>الإجمالي</label>
                  <input class=\"svc-line-total\" name=\"services[${idx}][line_total]\" type=\"number\" value=\"0\" readonly>
                </div>
                <div class=\"field quarter\">
                  <label>&nbsp;</label>
                  <button class=\"btn svc-remove\" type=\"button\" style=\"width:100%\">حذف</button>
                </div>
              </div>
            </div>`;
            repeater.insertAdjacentHTML('beforeend', html);
            updateNames();
          });
          repeater.addEventListener('click', function(e) {
            if (e.target.classList.contains('svc-remove')) {
              e.target.closest('.svc-item').remove();
              updateNames();
            }
          });
        });
        </script>
      </div>
    </div>

    <aside class="card">
      <div class="head">
        <h3>@lang('messages.billing.summary_title')</h3>
      </div>

      <div class="body">
        <div class="row">
          <div class="field third">
            <label>@lang('messages.billing.payment_method')</label>
            <select>
              <option>@lang('messages.billing.cash')</option>
              <option>@lang('messages.billing.transfer')</option>
            </select>
          </div>

          <div class="field third">
            <label>@lang('messages.billing.discount_reason')</label>
            <input id="discReason" placeholder="@lang('messages.billing.discount_placeholder')">
          </div>

          <div class="field third">
            <label>@lang('messages.billing.discount_value')</label>
            <input id="discInput" type="number" value="0" min="0" step="1">
          </div>
        </div>

        <div class="totals">
          <div class="line">
            <span>@lang('messages.billing.subtotal')</span>
            <strong id="subtotalVal">EGP 0.00</strong>
          </div>
          <div class="line">
            <span>@lang('messages.billing.discount')</span>
            <strong id="discountVal">EGP 0.00</strong>
          </div>
          <div class="line grand">
            <span>@lang('messages.billing.total')</span>
            <span id="totalVal">EGP 0.00</span>
          </div>
        </div>

        <div class="row" style="margin-top:12px">
          <div class="field third">
            <button class="btn d-none">@lang('messages.billing.issue_invoice')</button>
          </div>
          <div class="field third">
            <button class="btn primary d-none">@lang('messages.billing.collect_now')</button>
          </div>
        </div>
      </div>
    </aside>
  </div>
</div>

<style>
  /* نفس التصميم العام لباقي التابات */
  .tab-content-wrapper {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 16px;
  }

  .tab-content-wrapper .grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
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

  .totals {
    margin-top: 18px;
    border-top: 1px solid #e2e8f0;
    padding-top: 12px;
  }

  .totals .line {
    display: flex;
    justify-content: space-between;
    margin-bottom: 6px;
    color: #475569;
  }

  .totals .grand {
    font-weight: bold;
    color: #111827;
    font-size: 1.1em;
  }

  @media (max-width: 900px) {
    .tab-content-wrapper .grid {
      grid-template-columns: 1fr;
    }
  }
</style>
