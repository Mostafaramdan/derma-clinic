<div class="grid">

  <div class="card"><div class="grid">

    <div class="head"><h3>💳 الخدمات والإجراءات</h3></div>  <div class="card">

    <div class="body">    <div class="head"><h3>💳 الخدمات والإجراءات</h3></div>

      <div class="hint">يمكن تعديل السعر يدويًا لكل خدمة.</div>    <div class="body">

      <div id="svcRepeater">      <div class="hint">يمكن تعديل السعر يدويًا لكل خدمة.</div>

        <div class="svc-item" style="border:1px solid var(--line);border-radius:14px;padding:12px;margin-top:8px;background:#fff">      <div id="svcRepeater">

          <div class="row">        @foreach(($services ?? [ ['service'=>'','price'=>0,'qty'=>1] ]) as $svc)

            <div class="field third"><label>الخدمة</label>        <div class="svc-item" style="border:1px solid var(--line);border-radius:14px;padding:12px;margin-top:8px;background:#fff">

              <select class="svc-select">          <div class="row">

                <option value="consult" data-price="300">كشف جلدية</option>            <div class="field third"><label>الخدمة</label>

                <option value="laser_small" data-price="500">جلسة ليزر (منطقة صغيرة)</option>              <select class="svc-select" name="services[][service]">

                <option value="peel_light" data-price="400">تقشير كيميائي خفيف</option>                <option value="consult" data-price="300" @if(($svc['service'] ?? '')=='consult') selected @endif>كشف جلدية</option>

                <option value="dermapen" data-price="600">Dermapen</option>                <option value="laser_small" data-price="500" @if(($svc['service'] ?? '')=='laser_small') selected @endif>جلسة ليزر (منطقة صغيرة)</option>

                <option value="other" data-price="0">خدمة أخرى…</option>                <option value="peel_light" data-price="400" @if(($svc['service'] ?? '')=='peel_light') selected @endif>تقشير كيميائي خفيف</option>

              </select>                <option value="dermapen" data-price="600" @if(($svc['service'] ?? '')=='dermapen') selected @endif>Dermapen</option>

            </div>                <option value="other" data-price="0" @if(($svc['service'] ?? '')=='other') selected @endif>خدمة أخرى…</option>

            <div class="field quarter"><label>السعر (جنيه)</label><input class="svc-price" type="number" value="300" min="0" step="1"></div>              </select>

            <div class="field quarter"><label>الكمية</label><input class="svc-qty" type="number" value="1" min="1" step="1"></div>            </div>

            <div class="field quarter"><label>إجمالي البند</label><div class="hint"><strong class="line-total">EGP 300.00</strong></div></div>            <div class="field quarter"><label>السعر (جنيه)</label><input class="svc-price" type="number" name="services[][price]" value="{{ $svc['price'] ?? 300 }}" min="0" step="1"></div>

            <div class="field quarter"><label>&nbsp;</label><button class="btn svc-remove" style="width:100%">حذف</button></div>            <div class="field quarter"><label>الكمية</label><input class="svc-qty" type="number" name="services[][qty]" value="{{ $svc['qty'] ?? 1 }}" min="1" step="1"></div>

          </div>            <div class="field quarter"><label>إجمالي البند</label><div class="hint"><strong class="line-total">EGP {{ number_format(($svc['price'] ?? 0)*($svc['qty'] ?? 1),2) }}</strong></div></div>

        </div>            <div class="field quarter"><label>&nbsp;</label><button class="btn svc-remove" style="width:100%">حذف</button></div>

      </div>          </div>

      <button id="addSvc" class="btn" style="margin-top:8px">+ إضافة خدمة</button>        </div>

    </div>        @endforeach

  </div>      </div>

  <aside class="card">      <button id="addSvc" class="btn" style="margin-top:8px">+ إضافة خدمة</button>

    <div class="head"><h3>🧾 الملخص المالي</h3></div>    </div>

    <div class="body">  </div>

      <div class="row">  <aside class="card">

        <div class="field third"><label>طريقة الدفع</label><select><option>نقدي</option><option>تحويل</option></select></div>    <div class="head"><h3>🧾 الملخص المالي</h3></div>

        <div class="field third"><label>سبب الخصم</label><input id="discReason" placeholder="عرض/كوبون/ولاء"></div>    <div class="body">

        <div class="field third"><label>قيمة الخصم</label><input id="discInput" type="number" value="0" min="0" step="1"></div>      <div class="row">

      </div>        <div class="field third"><label>طريقة الدفع</label><select name="invoice[payment_method]"><option value="cash">نقدي</option><option value="transfer">تحويل</option></select></div>

      <div class="totals">        <div class="field third"><label>سبب الخصم</label><input id="discReason" name="invoice[discount_reason]" placeholder="عرض/كوبون/ولاء" value="{{ old('invoice.discount_reason', $invoice['discount_reason'] ?? '') }}"></div>

        <div class="line"><span>المجموع</span><strong id="subtotalVal">EGP 0.00</strong></div>        <div class="field third"><label>قيمة الخصم</label><input id="discInput" type="number" name="invoice[discount_amount]" value="{{ old('invoice.discount_amount', $invoice['discount_amount'] ?? 0) }}" min="0" step="1"></div>

        <div class="line"><span>خصم</span><strong id="discountVal">EGP 0.00</strong></div>      </div>

        <div class="line grand"><span>الإجمالي</span><span id="totalVal">EGP 0.00</span></div>      <div class="totals">

      </div>        <div class="line"><span>المجموع</span><strong id="subtotalVal">EGP {{ number_format($invoice['subtotal'] ?? 0,2) }}</strong></div>

      <div class="row" style="margin-top:12px">        <div class="line"><span>خصم</span><strong id="discountVal">EGP {{ number_format($invoice['discount_amount'] ?? 0,2) }}</strong></div>

        <div class="field third"><button class="btn">إصدار فاتورة</button></div>        <div class="line grand"><span>الإجمالي</span><span id="totalVal">EGP {{ number_format(($invoice['subtotal'] ?? 0)-($invoice['discount_amount'] ?? 0),2) }}</span></div>

        <div class="field third"><button class="btn primary">تحصيل الآن</button></div>      </div>

      </div>      <div class="row" style="margin-top:12px">

    </div>        <div class="field third"><button class="btn">إصدار فاتورة</button></div>

  </aside>        <div class="field third"><button class="btn primary">تحصيل الآن</button></div>

</div>      </div>

    </div>
  </aside>
</div>
<div class="card">
  <div class="head">
    <h3>{{ __('services') }}</h3>
  </div>
  <div class="body">
    <div class="row">
      <div class="field full">
        <label>{{ __('services') }}</label>
        <div id="svcRepeater">
          <div class="svc-item" style="display:grid;grid-template-columns:2fr 1fr 1fr 2fr 0.5fr;gap:12px;align-items:end;margin-bottom:12px;border:1px solid #e2e8f0;border-radius:14px;padding:12px;">
            <div>
              <label>{{ __('service') }}</label>
              <select class="svc-select" name="services[0][service_id]">
                @foreach(($services ?? []) as $s)
                  @if(is_object($s))
                    <option value="{{ $s->id }}" data-price="{{ $s->default_price }}">{{ $s->label() }}</option>
                  @endif
                @endforeach
                <option value="" data-price="0">— {{ __('other') ?? 'Other' }} —</option>
              </select>
            </div>
            <div>
              <label>{{ __('price') }}</label>
              <input type="number" class="svc-price" name="services[0][price]" value="0">
            </div>
            <div>
              <label>{{ __('qty') }}</label>
              <input type="number" class="svc-qty" name="services[0][qty]" value="1" min="1">
            </div>
            <div>
              <label>{{ __('line_total') }}</label>
              <div class="line-total" style="font-weight:bold;color:var(--primary);">EGP 0.00</div>
            </div>
            <div>
              <button type="button" class="chip svc-remove">✕</button>
            </div>
          </div>
        </div>
      </div>
      <div class="field third">
        <label>{{ __('payment_method') }}</label>
        <select name="invoice[payment_method]">
          <option value="cash">{{ __('cash') }}</option>
          <option value="transfer">{{ __('transfer') }}</option>
        </select>
      </div>
      <div class="field third">
        <label>{{ __('discount') }}</label>
        <input type="number" name="invoice[discount_amount]" id="discInput" value="0" min="0">
      </div>
      <div class="field third">
        <label>{{ __('discount_reason') }}</label>
        <input name="invoice[discount_reason]" id="discReason" placeholder="{{ __('discount_reason') }}">
      </div>
      <div class="field full">
        <div class="totals">
          <div class="line"><span>{{ __('subtotal') }}</span><strong id="subtotalVal">EGP 0.00</strong></div>
          <div class="line"><span>{{ __('discount') }}</span><strong id="discountVal">EGP 0.00</strong></div>
        </div>
      </div>
    </div>
  </div>
</div>
      <div class="col-md-3"><div class="d-flex justify-content-between fw-bold text-primary"><span>{{ __('total') }}</span><span id="totalVal">EGP 0.00</span></div></div>
    </div>
  </div>
</div>
