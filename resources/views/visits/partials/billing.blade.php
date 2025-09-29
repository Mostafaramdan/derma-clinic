@if ($errors->has('services'))
  <div class="field-error">{{ $errors->first('services') }}</div>
@endif
@if ($errors->has('invoice'))
  <div class="field-error">{{ $errors->first('invoice') }}</div>
@endif
 <div class="grid">
          <div class="card">
            <div class="head"><h3>💳 الخدمات والإجراءات</h3></div>
            <div class="body">
              <div class="hint">يمكن تعديل السعر يدويًا لكل خدمة.</div>
              <div id="svcRepeater">
                <div class="svc-item" style="border:1px solid var(--line);border-radius:14px;padding:12px;margin-top:8px;background:#fff">
                  <div class="row">
                    <div class="field third"><label>الخدمة</label>
                      <select class="svc-select">
                        <option value="consult" data-price="300">كشف جلدية</option>
                        <option value="laser_small" data-price="500">جلسة ليزر (منطقة صغيرة)</option>
                        <option value="peel_light" data-price="400">تقشير كيميائي خفيف</option>
                        <option value="dermapen" data-price="600">Dermapen</option>
                        <option value="other" data-price="0">خدمة أخرى…</option>
                      </select>
                    </div>
                    <div class="field quarter"><label>السعر (جنيه)</label><input class="svc-price" type="number" value="300" min="0" step="1"></div>
                    <div class="field quarter"><label>الكمية</label><input class="svc-qty" type="number" value="1" min="1" step="1"></div>
                    <div class="field quarter"><label>إجمالي البند</label><div class="hint"><strong class="line-total">EGP 300.00</strong></div></div>
                    <div class="field quarter"><label>&nbsp;</label><button class="btn svc-remove" style="width:100%">حذف</button></div>
                  </div>
                </div>
              </div>
              <button id="addSvc" class="btn" type="button" style="margin-top:8px">+ إضافة خدمة</button>
            </div>
          </div>

          <aside class="card">
            <div class="head"><h3>🧾 الملخص المالي</h3></div>
            <div class="body">
              <div class="row">
                <div class="field third"><label>طريقة الدفع</label><select><option>نقدي</option><option>تحويل</option></select></div>
                <div class="field third"><label>سبب الخصم</label><input id="discReason" placeholder="عرض/كوبون/ولاء"></div>
                <div class="field third"><label>قيمة الخصم</label><input id="discInput" type="number" value="0" min="0" step="1"></div>
              </div>
              <div class="totals">
                <div class="line"><span>المجموع</span><strong id="subtotalVal">EGP 0.00</strong></div>
                <div class="line"><span>خصم</span><strong id="discountVal">EGP 0.00</strong></div>
                <div class="line grand"><span>الإجمالي</span><span id="totalVal">EGP 0.00</span></div>
              </div>
              <div class="row" style="margin-top:12px">
                <div class="field third"><button class="btn d-none">إصدار فاتورة</button></div>
                <div class="field third"><button class="btn primary d-none">تحصيل الآن</button></div>
              </div>
            </div>
          </aside>
        </div>
