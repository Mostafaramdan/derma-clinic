// ====== Helpers i18n (لو عايز نصوص داخل JS) ======
// ممكن تمراً من Blade: <script>window.I18N=@json(__('...'))</script>
// هنا هنكتفي بمنطق الأرقام والحسابات فقط.

// ====== Labs Repeater ======
(function(){
  const wrap = document.getElementById('labRepeater');
  const addBtn = document.getElementById('addLabRow');
  if(!wrap || !addBtn) return;

  let idx = wrap.querySelectorAll('.lab-item').length;

  function bindItem(item){
    item.querySelector('.lab-remove')?.addEventListener('click', ()=>{
      const items = wrap.querySelectorAll('.lab-item');
      if(items.length > 1) item.remove();
    });
  }

  wrap.querySelectorAll('.lab-item').forEach(bindItem);

  addBtn.addEventListener('click', ()=>{
    const first = wrap.querySelector('.lab-item');
    const clone = first.cloneNode(true);
    // فضّي القيم وحدث الأسماء
    clone.querySelectorAll('input').forEach((inp)=>{
      if(inp.type === 'file'){ try{ inp.value = null; }catch(e){} }
      else if (inp.name?.endsWith('[lab_info]')) {
        // خلي بيان المعمل default
        // القيمة الحالية كويسة، سيبها كما هي
      } else {
        inp.value = '';
      }
    });
    clone.querySelectorAll('[name]').forEach((el)=>{
      el.name = el.name.replace(/\[\d+]/, `[${idx}]`);
    });
    wrap.appendChild(clone);
    bindItem(clone);
    idx++;
  });
})();

// ====== Photos (placeholder grid) ======
(function(){
  const grid = document.getElementById('photosGrid');
  if(!grid) return;
  grid.addEventListener('change', (e)=>{
    const input = e.target.closest('.photo-input');
    if(!input || !input.files?.length) return;
    // ممكن تعرض thumbnail مبدئيًا (اختياري)
    // هنا سايبها بسيطة
    // Add another empty slot:
    const col = document.createElement('div');
    col.className = 'col-md-4';
    col.innerHTML = `
      <label class="w-100">
        <input type="file" class="form-control d-none photo-input" name="photos[]">
        <div class="border rounded-3 d-flex align-items-center justify-content-center p-5 bg-white text-secondary" style="cursor:pointer">
          + ${document.documentElement.dir==='rtl' ? 'إضافة صورة' : 'Add Photo'}
        </div>
      </label>`;
    grid.appendChild(col);
  });
})();

// ====== Services Repeater + Totals ======
(function(){
  const wrap = document.getElementById('svcRepeater');
  const addBtn = document.getElementById('addSvcRow');
  const subtotalEl = document.getElementById('subtotalVal');
  const discountEl = document.getElementById('discountVal');
  const totalEl = document.getElementById('totalVal');
  const discInput = document.getElementById('discInput');

  if(!wrap || !addBtn) return;

  const fmt = (n)=> `EGP ${ (isFinite(n) ? Number(n).toFixed(2) : '0.00') }`;

  function recalc(){
    let subtotal = 0;
    wrap.querySelectorAll('.svc-item').forEach(it=>{
      const price = parseFloat(it.querySelector('.svc-price')?.value || 0);
      const qty   = parseInt(it.querySelector('.svc-qty')?.value || 1, 10);
      const line  = (isFinite(price) && isFinite(qty)) ? price*qty : 0;
      subtotal += line;
      const lineEl = it.querySelector('.line-total');
      if(lineEl) lineEl.textContent = fmt(line);
    });
    const discount = parseFloat(discInput?.value || 0);
    subtotalEl.textContent = fmt(subtotal);
    discountEl.textContent = fmt(discount);
    totalEl.textContent = fmt(Math.max(0, subtotal - discount));
  }

  function bindItem(it){
    const sel = it.querySelector('.svc-select');
    const priceInput = it.querySelector('.svc-price');
    const qtyInput   = it.querySelector('.svc-qty');

    sel?.addEventListener('change', ()=>{
      const p = parseFloat(sel.selectedOptions[0]?.getAttribute('data-price') || 0);
      if(priceInput){ priceInput.value = isFinite(p) ? p : 0; recalc(); }
    });
    priceInput?.addEventListener('input', recalc);
    qtyInput?.addEventListener('input', recalc);
    it.querySelector('.svc-remove')?.addEventListener('click', ()=>{
      const items = wrap.querySelectorAll('.svc-item');
      if(items.length > 1){ it.remove(); recalc(); }
    });
  }

  // أول عنصر
  wrap.querySelectorAll('.svc-item').forEach(bindItem);
  recalc();

  let idx = wrap.querySelectorAll('.svc-item').length;

  addBtn.addEventListener('click', ()=>{
    const first = wrap.querySelector('.svc-item');
    const item  = first.cloneNode(true);

    // reset fields
    const sel = item.querySelector('.svc-select');
    if(sel){ sel.selectedIndex = 0; }

    const defaultPrice = parseFloat(sel?.selectedOptions[0]?.getAttribute('data-price') || 0);
    item.querySelector('.svc-price').value = isFinite(defaultPrice) ? defaultPrice : 0;
    item.querySelector('.svc-qty').value   = 1;

    // rename indexed names
    item.querySelectorAll('[name]').forEach(n=>{
      n.name = n.name.replace(/\[\d+]/, `[${idx}]`);
    });

    wrap.appendChild(item);
    bindItem(item);
    recalc();
    idx++;
  });

  discInput?.addEventListener('input', recalc);
})();
