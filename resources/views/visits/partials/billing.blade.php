@if ($errors->has('services'))
  <div class="field-error">{{ $errors->first('services') }}</div>
@endif
@if ($errors->has('invoice'))
  <div class="field-error">{{ $errors->first('invoice') }}</div>
@endif
 <div class="grid">
          <div class="card">
            <div class="head"><h3>@lang('messages.billing.services_title')</h3></div>
            <div class="body">
              <div class="hint">@lang('messages.billing.price_hint')</div>
              <div id="svcRepeater">
                <div class="svc-item" style="border:1px solid var(--line);border-radius:14px;padding:12px;margin-top:8px;background:#fff">
                  <div class="row">
                    <div class="field third"><label>@lang('messages.billing.service')</label>
                      <select class="svc-select">
                        <option value="consult" data-price="300">@lang('messages.billing.consult')</option>
                        <option value="laser_small" data-price="500">@lang('messages.billing.laser_small')</option>
                        <option value="peel_light" data-price="400">@lang('messages.billing.peel_light')</option>
                        <option value="dermapen" data-price="600">@lang('messages.billing.dermapen')</option>
                        <option value="other" data-price="0">@lang('messages.billing.other')</option>
                      </select>
                    </div>
                    <div class="field quarter"><label>@lang('messages.billing.price_egp')</label><input class="svc-price" type="number" value="300" min="0" step="1"></div>
                    <div class="field quarter"><label>@lang('messages.billing.qty')</label><input class="svc-qty" type="number" value="1" min="1" step="1"></div>
                    <div class="field quarter"><label>@lang('messages.billing.line_total')</label><div class="hint"><strong class="line-total">EGP 300.00</strong></div></div>
                    <div class="field quarter"><label>&nbsp;</label><button class="btn svc-remove" style="width:100%">@lang('messages.billing.remove')</button></div>
                  </div>
                </div>
              </div>
              <button id="addSvc" class="btn" type="button" style="margin-top:8px">+ @lang('messages.billing.add_service')</button>
            </div>
          </div>

          <aside class="card">
            <div class="head"><h3>@lang('messages.billing.summary_title')</h3></div>
            <div class="body">
              <div class="row">
                <div class="field third"><label>@lang('messages.billing.payment_method')</label><select><option>@lang('messages.billing.cash')</option><option>@lang('messages.billing.transfer')</option></select></div>
                <div class="field third"><label>@lang('messages.billing.discount_reason')</label><input id="discReason" placeholder="@lang('messages.billing.discount_placeholder')"></div>
                <div class="field third"><label>@lang('messages.billing.discount_value')</label><input id="discInput" type="number" value="0" min="0" step="1"></div>
              </div>
              <div class="totals">
                <div class="line"><span>@lang('messages.billing.subtotal')</span><strong id="subtotalVal">EGP 0.00</strong></div>
                <div class="line"><span>@lang('messages.billing.discount')</span><strong id="discountVal">EGP 0.00</strong></div>
                <div class="line grand"><span>@lang('messages.billing.total')</span><span id="totalVal">EGP 0.00</span></div>
              </div>
              <div class="row" style="margin-top:12px">
                <div class="field third"><button class="btn d-none">@lang('messages.billing.issue_invoice')</button></div>
                <div class="field third"><button class="btn primary d-none">@lang('messages.billing.collect_now')</button></div>
              </div>
            </div>
          </aside>
        </div>
