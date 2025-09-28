  // ===== Tabs =====
    // ===== Diagnosis table =====
  (function(){
    const dxBody=document.getElementById('dxBody');
    const addBtn=document.getElementById('addDxRow');

    function bindRow(tr){
      tr.querySelector('.dx-remove').addEventListener('click',()=>{
        if(dxBody.children.length>1) tr.remove();
      });
    }
    dxBody.querySelectorAll('tr').forEach(bindRow);

    addBtn.addEventListener('click',()=>{
      const tr=dxBody.querySelector('tr').cloneNode(true);
      tr.querySelector('input').value='';
      bindRow(tr);
      dxBody.appendChild(tr);
    });
  })();

  const tabs = document.querySelectorAll('[role="tab"]');
  const panels = document.querySelectorAll('[role="tabpanel"]');
  function activateTab(tab){
    tabs.forEach(t=> t.setAttribute('aria-selected','false'));
    panels.forEach(p=> p.setAttribute('aria-hidden','true'));
    tab.setAttribute('aria-selected','true');
    document.getElementById(tab.getAttribute('aria-controls')).setAttribute('aria-hidden','false');
  }
  tabs.forEach(t=> t.addEventListener('click', ()=> activateTab(t)));

  // ===== Skin types selector =====
  (function(){
    const wrap = document.getElementById('skinTypes');
    const input = document.getElementById('skinTypeInput');
    if(!wrap) return;
    wrap.querySelectorAll('.skin-card').forEach(card=>{
      card.addEventListener('click', ()=>{
        wrap.querySelectorAll('.skin-card').forEach(c=>c.classList.remove('active'));
        card.classList.add('active');
        input.value = card.dataset.value;
      });
    });
  })();

  // ===== BodyPicker — add-by-click default, tools above, X/Y disabled + touch =====
  (function(){
    const PATIENT_ID='P-10234', VISIT_ID='V-2025-09-06-1430';
    const STORAGE_KEY=`derma_spots:${PATIENT_ID}:${VISIT_ID}`;

    const canvas  = document.getElementById('bpCanvas');
    const img     = document.getElementById('bpImage');
    const hidden  = document.getElementById('locationsInput');

    const addByClickBtn = document.getElementById('addByClickBtn');
    const addNewBtn     = document.getElementById('addNewBtn');
    const deleteBtn     = document.getElementById('deleteBtn');
    const coordX   = document.getElementById('coordX');
    const coordY   = document.getElementById('coordY');
    const coordKey = document.getElementById('coordKey');
    const coordName= document.getElementById('coordName');
    const updateBtn= document.getElementById('updateSpot');

    let spots=[];
    try{ spots = JSON.parse(localStorage.getItem(STORAGE_KEY)||'[]'); }catch{ spots=[]; }
    if(!Array.isArray(spots)) spots=[];
    let selected=null;
    let addByClick=true;
    let dragging=false;

    function persist(){
      hidden.value = JSON.stringify(spots);
      localStorage.setItem(STORAGE_KEY, JSON.stringify(spots));
    }
    function clamp(n,min,max){return Math.max(min,Math.min(max,n))}
    function uid(){return 's_'+Math.random().toString(36).slice(2,9)}
    function pctFromClient(clientX, clientY){
      const r = img.getBoundingClientRect();
      if(clientX<r.left||clientX>r.right||clientY<r.top||clientY>r.bottom) return null;
      const x = ((clientX - r.left)/r.width)*100;
      const y = ((clientY - r.top)/r.height)*100;
      return {x: clamp(+x.toFixed(1),0,100), y: clamp(+y.toFixed(1),0,100)};
    }
    function updateXYInputs(sp){
      coordX.value = sp.x; coordY.value = sp.y;
      coordKey.value = sp.key || ''; coordName.value = sp.name || '';
    }
    function select(el){
      canvas.querySelectorAll('.bp-spot').forEach(s=>s.classList.remove('selected'));
      el.classList.add('selected'); selected=el;
      const sp = spots.find(x=>x.id===el.dataset.id); if(sp) updateXYInputs(sp);
    }
    function onDragStart(el, startEvent){
      dragging=false;
      const move = (ev) => {
        dragging=true;
        const p = ('touches' in ev)? pctFromClient(ev.touches[0].clientX, ev.touches[0].clientY)
                                   : pctFromClient(ev.clientX, ev.clientY);
        if(!p) return;
        el.style.left=p.x+'%'; el.style.top=p.y+'%';
        const sp=spots.find(x=>x.id===el.dataset.id);
        if(sp){ sp.x=p.x; sp.y=p.y; updateXYInputs(sp); persist(); }
      };
      const up = () => {
        window.removeEventListener('mousemove', move);
        window.removeEventListener('mouseup', up);
        window.removeEventListener('touchmove', move);
        window.removeEventListener('touchend', up);
        setTimeout(()=> dragging=false, 0);
      };
      window.addEventListener('mousemove', move, {passive:true});
      window.addEventListener('mouseup', up, {passive:true});
      window.addEventListener('touchmove', move, {passive:true});
      window.addEventListener('touchend', up, {passive:true});
    }

    function render(){
      canvas.querySelectorAll('.bp-spot').forEach(n=>n.remove());
      const frag=document.createDocumentFragment();
      spots.forEach((s,idx)=>{
        const b=document.createElement('button');
        b.type='button'; b.className='bp-spot'; b.dataset.id=s.id; b.dataset.key=s.key||''; b.dataset.name=s.name||'';
        b.title = s.name || s.key || '';
        b.style.left=s.x+'%'; b.style.top=s.y+'%';

        b.addEventListener('click',(e)=>{ if(dragging) return; e.stopPropagation(); select(b); });
        b.addEventListener('mousedown',(e)=>{e.preventDefault(); onDragStart(b, e);});
        b.addEventListener('touchstart',(e)=>{onDragStart(b, e);});

        frag.appendChild(b);
      });
      canvas.appendChild(frag);
      persist();
    }
    function addSpot(x=50,y=50,key=''){
      const id=uid(); const s={id, key, name:'', x, y}; spots.push(s); render();
      const el=canvas.querySelector(`.bp-spot[data-id="${id}"]`); if(el) select(el);
    }
    function setAddByClick(on){
      addByClick = !!on;
      if (addByClickBtn) {
        addByClickBtn.classList.toggle('primary', addByClick);
        addByClickBtn.textContent = addByClick ? 'وضع الإضافة بالنقر: مفعل' : 'تفعيل الإضافة بالنقر';
      }
    }
    setAddByClick(true);

    if (addNewBtn) {
      addNewBtn.addEventListener('click', ()=> addSpot());
    }
    if (addByClickBtn) {
      addByClickBtn.addEventListener('click', ()=> setAddByClick(!addByClick));
    }

    function handleAdd(e){
      if(!addByClick) return;
      const p= ('clientX' in e)? pctFromClient(e.clientX, e.clientY)
                                : pctFromClient(e.touches?.[0]?.clientX, e.touches?.[0]?.clientY);
      if(!p) return; addSpot(p.x, p.y);
    }
    img.addEventListener('click', handleAdd);
    canvas.addEventListener('click', e=>{ if(e.target===canvas) handleAdd(e); });

    if (updateBtn) {
      updateBtn.addEventListener('click', ()=>{
        if(!selected) return;
        const sp=spots.find(x=>x.id===selected.dataset.id); if(!sp) return;
        sp.key=(coordKey.value||'').trim(); sp.name=(coordName.value||'').trim();
        selected.dataset.name=sp.name||''; selected.title=sp.name||sp.key||''; persist();
      });
    }
    function deleteSelected(){
      if(!selected) return;
      spots = spots.filter(s=>s.id!==selected.dataset.id); selected=null; render();
    }
    function deleteAll(){
      spots = [];
      selected=null;
      render();
    }
  document.getElementById('deleteAllBtn').addEventListener('click', deleteAll);
    deleteBtn.addEventListener('click', deleteSelected);
    document.addEventListener('keydown', e=>{ if(e.key==='Delete') deleteSelected(); });

    img.addEventListener('load', render); render();
  })();

  // ===== Meds (no templates) — per-day + every-hours (1..72) =====
  (function(){
    const medsBody=document.getElementById('medsBody');
    const addBtn=document.getElementById('addMedRow');

    function buildOptions(sel,start,end){
      sel.innerHTML=''; for(let i=start;i<=end;i++){ sel.add(new Option(i,i)); }
    }
    function updateFreqHint(tr){
      const perDay=tr.querySelector('.per-day');
      const every =tr.querySelector('.every-hours');
      const hint  =tr.querySelector('.freq-hint');
      const d = parseInt(perDay.value||0,10);
      const h = parseInt(every.value||0,10);
      let text='';
      if(h>=24){ text = `كل ${h} ساعة`; }
      else if(d>0 && h>0){ text = `${d} مرة/اليوم — كل ${h} ساعة تقريبًا`; }
      else if(d>0){ text = `${d} مرة/اليوم`; }
      else if(h>0){ text = `كل ${h} ساعة`; }
      hint.textContent = text;
    }
    function bindRow(tr){
      const perDay=tr.querySelector('.per-day');
      const every =tr.querySelector('.every-hours');
      buildOptions(perDay,1,20);
      buildOptions(every,1,72); // لدعم 48 ساعة وغيرها
      perDay.value = perDay.value || '1';
      every.value  = every.value  || '12';
      perDay.addEventListener('change', ()=> updateFreqHint(tr));
      every.addEventListener('change', ()=> updateFreqHint(tr));
      tr.querySelector('.med-remove').addEventListener('click',()=>{if(medsBody.children.length>1) tr.remove();});
      updateFreqHint(tr);
    }
    medsBody.querySelectorAll('tr').forEach(bindRow);

    addBtn.addEventListener('click',()=>{
      const tr=medsBody.querySelector('tr').cloneNode(true);
      tr.querySelectorAll('input').forEach(inp=>{
        if(inp.type==='number') { inp.value = inp.getAttribute('min') || '1'; }
        else { inp.value=''; }
      });
      bindRow(tr);
      medsBody.appendChild(tr);
    });
  })();

  // ===== Advice =====
  (function(){
    const toggle=document.getElementById('adviceActivate');
    const block=document.getElementById('adviceBlock');
    const body=document.getElementById('adviceBody');
    const addBtn=document.getElementById('addAdviceRow');

    function bindRow(tr){
      const input=tr.querySelector('.advice-input');
      const presets=tr.querySelector('.advice-presets');
      presets.addEventListener('change',()=>{ if(presets.value) input.value=presets.value; });
      tr.querySelector('.advice-remove').addEventListener('click',()=>{ if(body.children.length>1) tr.remove(); });
    }
    body.querySelectorAll('tr').forEach(bindRow);

    addBtn.addEventListener('click',()=>{
      const tr=document.createElement('tr');
      tr.innerHTML=`<td><div style="display:flex;gap:6px;align-items:center"><input class="advice-input" placeholder="تعليمات"><select class="advice-presets"><option value="">— من القوالب —</option><option>ابتعد عن الشمس</option><option>SPF 50+ يوميًا</option><option>مرطّب صباحًا ومساءً</option><option>غسول لطيف</option><option>اختبار حساسية موضعي أولًا</option><option>تجنّب محيط العين</option></select></div></td><td><button class="btn danger advice-remove">✕</button></td>`;
      bindRow(tr); body.appendChild(tr);
    });
    toggle.addEventListener('change',()=>{ block.style.display = toggle.checked ? 'block':'none'; });
  })();

  // ===== Labs repeater =====
  (function(){
    const wrap = document.getElementById('labRepeater');
    const addBtn = document.getElementById('addLab');
    if(!wrap || !addBtn) return;
    addBtn.addEventListener('click', ()=>{
      const first = wrap.querySelector('.lab-item');
      const item = first.cloneNode(true);
      item.querySelectorAll('input').forEach(inp=>{
        if(inp.type==='file'){ try{inp.value=null;}catch(e){} }
        else{
          if(inp.previousElementSibling?.tagName==='LABEL'
             && inp.previousElementSibling.textContent.includes('بيان المعمل')){
            inp.value='المعمل : القصر العيني';
          }else{
            inp.value='';
          }
        }
      });
      wrap.appendChild(item);
    });
    wrap.addEventListener('click', (e)=>{
      const btn = e.target.closest('.lab-remove'); if(!btn) return;
      const items = wrap.querySelectorAll('.lab-item');
      if(items.length>1){ btn.closest('.lab-item').remove(); }
    });
  })();

  // ===== Services repeater + totals (billing) =====
  (function(){
    const wrap = document.getElementById('svcRepeater');
    const addBtn = document.getElementById('addSvc');
    const subtotalEl = document.getElementById('subtotalVal');
    const discountEl = document.getElementById('discountVal');
    const totalEl = document.getElementById('totalVal');
    const discInput = document.getElementById('discInput');
    const fmt = n => 'EGP ' + (isFinite(n)? Number(n).toFixed(2) : '0.00');

    function recalc(){
      let subtotal = 0;
      wrap.querySelectorAll('.svc-item').forEach(it=>{
        const price = parseFloat(it.querySelector('.svc-price')?.value||0);
        const qty   = parseInt(it.querySelector('.svc-qty')?.value||1);
        const line  = (isFinite(price)&&isFinite(qty)) ? price*qty : 0;
        subtotal += line;
        const lineEl = it.querySelector('.line-total');
        if(lineEl) lineEl.textContent = fmt(line);
      });
      const discount = parseFloat(discInput?.value||0);
      subtotalEl.textContent = fmt(subtotal);
      discountEl.textContent = fmt(discount);
      totalEl.textContent    = fmt(subtotal - discount);
    }
    function bindItem(it){
      const sel  = it.querySelector('.svc-select');
      const priceInput = it.querySelector('.svc-price');
      const qtyInput   = it.querySelector('.svc-qty');
      sel.addEventListener('change', ()=>{
        const p = parseFloat(sel.selectedOptions[0].dataset.price||0);
        if(priceInput) priceInput.value = isFinite(p)? p : 0;
        recalc();
      });
      priceInput?.addEventListener('input', recalc);
      qtyInput?.addEventListener('input', recalc);
      it.querySelector('.svc-remove')?.addEventListener('click', ()=>{
        const items = wrap.querySelectorAll('.svc-item');
        if(items.length>1){ it.remove(); recalc(); }
      });
    }
    wrap.querySelectorAll('.svc-item').forEach(bindItem);

    addBtn.addEventListener('click', ()=>{
      const first = wrap.querySelector('.svc-item');
      const item  = first.cloneNode(true);
      const sel   = item.querySelector('.svc-select');
      sel.selectedIndex = 0;
      item.querySelector('.svc-price').value = sel.selectedOptions[0].dataset.price || 300;
      item.querySelector('.svc-qty').value   = 1;
      wrap.appendChild(item);
      bindItem(item);
      recalc();
    });

    discInput?.addEventListener('input', recalc);
    recalc();
  })();
