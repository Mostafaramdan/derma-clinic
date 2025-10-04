@php
  $prescriptionTemplatesJs = isset($prescriptionTemplates) ? $prescriptionTemplates->map(function($tmpl) {
    return [
      'id' => $tmpl->id,
      'name' => $tmpl->name,
      'medications' => $tmpl->medications->map(fn($m) => ['name' => $m->name])->values(),
      'advices' => $tmpl->advices->map(fn($a) => ['text' => $a->name])->values(),
    ];
  })->values() : collect();
  $allMedicationsList = isset($allMedications) ? $allMedications->pluck('name')->values() : collect();
@endphp
@if(isset($prescriptionTemplates) && isset($allMedications))
<script>
  window.prescriptionTemplates = {!! json_encode($prescriptionTemplatesJs, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) !!};
  window.allMedicationsList = {!! json_encode($allMedicationsList, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) !!};
</script>
@endif
@if ($errors->has('medications'))
  <div class="field-error">{{ $errors->first('medications') }}</div>
@endif
@if ($errors->has('advices'))
  <div class="field-error">{{ $errors->first('advices') }}</div>
@endif
<div class="card">
  <div class="head"><h3>@lang('messages.rx_advices.title')</h3></div>
  <div class="body">

    {{-- جدول الأدوية --}}
    <div class="row">
      <div class="field full">
        <div class="table-head-flex">
          <label>@lang('messages.rx_advices.meds_table')</label>
          <button type="button" id="addMedRow" class="btn primary">+ @lang('messages.rx_advices.add_med')</button>
          <button type="button" id="chooseTemplateBtn" class="btn" style="margin-right:8px;background:#f1f5f9;border:1px solid #cbd5e1;">اختر قالب روشتة</button>
<!-- Prescription Templates Modal -->
<div id="templateModal" style="display:none;position:fixed;z-index:1000;left:0;top:0;width:100vw;height:100vh;background:rgba(0,0,0,0.25);align-items:center;justify-content:center;">
  <div style="background:#fff;padding:32px 24px 18px 24px;border-radius:18px;min-width:320px;max-width:90vw;box-shadow:0 8px 32px #0002;position:relative;">
    <button type="button" id="closeTemplateModal" style="position:absolute;top:10px;right:14px;font-size:1.5em;background:none;border:none;">&times;</button>
    <h4 style="margin-bottom:18px;font-weight:800;">اختر قالب روشتة</h4>
    <div id="templateList" style="max-height:300px;overflow-y:auto;"></div>
    <div style="margin-top:18px;text-align:end;">
      <button type="button" id="selectTemplateConfirm" class="btn primary" disabled>إدراج القالب</button>
    </div>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Prescription Templates Modal logic
  const modal = document.getElementById('templateModal');
  const openBtn = document.getElementById('chooseTemplateBtn');
  const closeBtn = document.getElementById('closeTemplateModal');
  const confirmBtn = document.getElementById('selectTemplateConfirm');
  const listDiv = document.getElementById('templateList');
  let selectedTemplateId = null;

  if (openBtn && modal) {
    openBtn.addEventListener('click', function() {
      modal.style.display = 'flex';
      // TODO: Load templates via AJAX or from window.prescriptionTemplates
      listDiv.innerHTML = '';
      if (window.prescriptionTemplates) {
        window.prescriptionTemplates.forEach(function(tmpl) {
          const row = document.createElement('div');
          row.textContent = tmpl.name;
          row.style.cssText = 'padding:10px 0;cursor:pointer;border-bottom:1px solid #eee;';
          row.dataset.id = tmpl.id;
          row.addEventListener('click', function() {
            listDiv.querySelectorAll('div').forEach(d=>d.style.background='');
            row.style.background = '#e0e7ff';
            selectedTemplateId = tmpl.id;
            confirmBtn.disabled = false;
          });
          listDiv.appendChild(row);
        });
      } else {
        listDiv.innerHTML = '<div style="color:#888">لا توجد قوالب متاحة</div>';
      }
      confirmBtn.disabled = true;
      selectedTemplateId = null;
    });
  }
  if (closeBtn && modal) {
    closeBtn.addEventListener('click', function() { modal.style.display = 'none'; });
  }
  if (confirmBtn) {
    confirmBtn.addEventListener('click', function() {
      if (!selectedTemplateId) return;
      // Insert template meds/advices into form
      const tmpl = (window.prescriptionTemplates || []).find(t => t.id == selectedTemplateId);
      if (tmpl) {
        // Fill medications table
        const medsBody = document.getElementById('medsBody');
        if (medsBody && Array.isArray(tmpl.medications)) {
          medsBody.innerHTML = '';
          tmpl.medications.forEach(function(med, i) {
            const tr = document.createElement('tr');
            tr.innerHTML = `
              <td>
                <div class="medication-select-wrap">
                  <select name="rx[meds][${i}][name]" class="form-select med-name-select" data-row="${i}">
                    <option value="">اسم الدواء</option>
                    ${(window.allMedicationsList||[]).map(m=>`<option value="${m}"${med.name===m?' selected':''}>${m}</option>`).join('')}
                    <option value="__new__"${(window.allMedicationsList||[]).indexOf(med.name)===-1?' selected':''}>أدخل دواء جديد...</option>
                  </select>
                  <input type="text" name="rx[meds][${i}][name_new]" class="form-control med-name-new" placeholder="اكتب اسم الدواء الجديد" style="display:${(window.allMedicationsList||[]).indexOf(med.name)===-1?'block':'none'}" value="${(window.allMedicationsList||[]).indexOf(med.name)===-1?med.name:''}">
                </div>
              </td>
              <td><input name="rx[meds][${i}][dose]" value="" placeholder="الجرعة"></td>
              <td>
                <div class="flex-gap">
                  <select name="rx[meds][${i}][per_day]" class="per-day"></select><span>مرات/يوم</span>
                  <select name="rx[meds][${i}][every_hours]" class="every-hours"></select><span>ساعات</span>
                </div>
                <div class="note freq-hint"></div>
              </td>
              <td><input type="number" min="1" name="rx[meds][${i}][days]" value="7"></td>
              <td><input name="rx[meds][${i}][note]" value="" placeholder="تعليمات"></td>
              <td><button class="btn danger med-remove" type="button">حذف</button></td>
            `;
            medsBody.appendChild(tr);
          });
        }
        // Fill advices table
        const adviceBody = document.getElementById('adviceBody');
        if (adviceBody && Array.isArray(tmpl.advices)) {
          adviceBody.innerHTML = '';
          tmpl.advices.forEach(function(advice, i) {
            const presetList = [
              'تجنب التعرض للشمس',
              'استخدام واقي شمس',
              'استخدام مرطب',
              'غسول لطيف للبشرة',
              'اختبار التحسس قبل الاستخدام',
              'تجنب ملامسة العين'
            ];
            const isPreset = presetList.includes(advice.text);
            adviceBody.innerHTML += `
              <tr>
                <td>
                  <div class="flex-gap advice-select-wrap">
                    <select name="rx[advices][${i}][preset]" class="form-select advice-preset-select" data-row="${i}">
                      <option value="">اختر نص جاهز</option>
                      ${presetList.map(p=>`<option value="${p}"${advice.text===p?' selected':''}>${p}</option>`).join('')}
                      <option value="__new__"${!isPreset?' selected':''}>أدخل نص جديد...</option>
                    </select>
                    <input type="text" name="rx[advices][${i}][text]" class="form-control advice-text-new" placeholder="تعليمات" style="display:${!isPreset?'block':'none'}" value="${!isPreset?advice.text:''}">
                  </div>
                </td>
                <td><button class="btn danger advice-remove" type="button">✕</button></td>
              </tr>
            `;
          });
        }
        // Show advices block if any advices
        if (tmpl.advices && tmpl.advices.length) {
          var adviceActivate = document.getElementById('adviceActivate');
          if (adviceActivate) adviceActivate.checked = true;
          var adviceBlock = document.getElementById('adviceBlock');
          if (adviceBlock) adviceBlock.style.display = '';
        }
        // Re-bind events for new rows (meds/advice)
        setTimeout(function() {
          document.querySelectorAll('select.med-name-select').forEach(function(sel) {
            sel.addEventListener('change', function() {
              var row = this.getAttribute('data-row');
              var input = document.querySelector('input.med-name-new[name="rx[meds]["+row+"][name_new]"]');
              if (this.value === '__new__') {
                input.style.display = 'block'; input.required = true;
              } else {
                input.style.display = 'none'; input.required = false; input.value = '';
              }
            });
          });
          document.querySelectorAll('select.advice-preset-select').forEach(function(sel) {
            sel.addEventListener('change', function() {
              var row = this.getAttribute('data-row');
              var input = document.querySelector('input.advice-text-new[name="rx[advices]["+row+"][text]"]');
              if (this.value === '__new__') {
                input.style.display = 'block'; input.required = true;
              } else {
                input.style.display = 'none'; input.required = false; input.value = this.value;
              }
            });
          });
        }, 100);
      }
      modal.style.display = 'none';
    });
  }
});
</script>
        </div>
  <div class="note">@lang('messages.rx_advices.freq_hint')</div>

        <div class="table-wrap">
          <table class="ltr">
            <thead>
            <tr>
              <th>@lang('messages.rx_advices.med_name')</th>
              <th>@lang('messages.rx_advices.dose')</th>
              <th>@lang('messages.rx_advices.frequency')</th>
              <th>@lang('messages.rx_advices.days')</th>
              <th>@lang('messages.rx_advices.instructions')</th>
              <th>@lang('messages.rx_advices.remove')</th>
            </tr>
            </thead>
            <tbody id="medsBody">
              @php
                $meds = old('rx.meds', collect($medications)->map(fn($m)=>[
                  'name'=>$m['name']??'','dose'=>$m['dose']??'','per_day'=>$m['per_day']??'',
                  'every_hours'=>$m['every_hours']??'','days'=>$m['days']??7,'note'=>$m['note']??'',
                ])->toArray() ?: [['name'=>'','dose'=>'','per_day'=>'','every_hours'=>'','days'=>7,'note'=>'']]);
              @endphp
              @foreach ($meds as $i=>$m)
                <tr>
                  <td>
                    <div class="medication-select-wrap">
                      <select name="rx[meds][{{ $i }}][name]" class="form-select med-name-select" data-row="{{ $i }}">
                        <option value="">@lang('messages.rx_advices.med_name')</option>
                        @foreach ($allMedications ?? [] as $med)
                          <option value="{{ $med->name }}" @if($m['name'] == $med->name) selected @endif>{{ $med->name }}</option>
                        @endforeach
                        <option value="__new__" @if($m['name'] && !collect($allMedications ?? [])->pluck('name')->contains($m['name'])) selected @endif>أدخل دواء جديد...</option>
                      </select>
                      <input type="text" name="rx[meds][{{ $i }}][name_new]" class="form-control med-name-new" placeholder="اكتب اسم الدواء الجديد" style="display:@if($m['name'] && !collect($allMedications ?? [])->pluck('name')->contains($m['name'])) block @else none @endif" value="@if($m['name'] && !collect($allMedications ?? [])->pluck('name')->contains($m['name'])){{ $m['name'] }}@endif">
                    </div>
                  </td>
                  <td><input name="rx[meds][{{ $i }}][dose]" value="{{ $m['dose'] }}" placeholder="@lang('messages.rx_advices.dose')"></td>
                  <td>
                    <div class="flex-gap">
                      <select name="rx[meds][{{ $i }}][per_day]" class="per-day"></select><span>@lang('messages.rx_advices.per_day')</span>
                      <select name="rx[meds][{{ $i }}][every_hours]" class="every-hours"></select><span>@lang('messages.rx_advices.hours')</span>
                    </div>
                    <div class="note freq-hint"></div>
                  </td>
                  <td><input type="number" min="1" name="rx[meds][{{ $i }}][days]" value="{{ $m['days'] }}"></td>
                  <td><input name="rx[meds][{{ $i }}][note]" value="{{ $m['note'] }}" placeholder="@lang('messages.rx_advices.instructions')"></td>
                  <td><button class="btn danger med-remove" type="button">@lang('messages.rx_advices.remove')</button></td>
                </tr>
              @endforeach
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Medication select: show/hide new input
  function updateMedNameInput(row) {
    var select = document.querySelector('select.med-name-select[data-row="'+row+'"]');
    var input = document.querySelector('input.med-name-new[name="rx[meds]['+row+'][name_new]"]');
    if (select && input) {
      if (select.value === '__new__') {
        input.style.display = 'block';
        input.required = true;
      } else {
        input.style.display = 'none';
        input.required = false;
        input.value = '';
      }
    }
  }
  document.querySelectorAll('select.med-name-select').forEach(function(sel) {
    sel.addEventListener('change', function() {
      updateMedNameInput(this.getAttribute('data-row'));
    });
    // Initial state
    updateMedNameInput(sel.getAttribute('data-row'));
  });
});
</script>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    {{-- الإرشادات --}}
    <div class="row mt-14">
      <div class="field full">
        <label class="inline">
          <input id="adviceActivate" type="checkbox" name="rx[advices_enabled]" value="1" @checked(old('rx.advices_enabled', filled($advices ?? [])))>
          @lang('messages.rx_advices.enable_advices')
        </label>
      </div>
    </div>

    <div id="adviceBlock" style="{{ filled($advices ?? []) ? '' : 'display:none' }}">
      <div class="row">
        <div class="field full mt-6">
          <div class="table-head-flex">
            <label>@lang('messages.rx_advices.advices')</label>
            <button type="button" id="addAdviceRow" class="btn">+ @lang('messages.rx_advices.add_advice')</button>
          </div>
          <table>
            <thead><tr><th>@lang('messages.rx_advices.instructions')</th><th>@lang('messages.rx_advices.remove')</th></tr></thead>
            <tbody id="adviceBody">
              @php
                $advs = old('rx.advices', (array)($advices ?? []));
                if (!$advs) $advs = [['text'=>'']];
              @endphp
              @foreach ($advs as $i=>$a)
                @php $adviceText = is_array($a) ? ($a['text'] ?? '') : $a; @endphp
                <tr>
                  <td>
                    <div class="flex-gap advice-select-wrap">
                      <select name="rx[advices][{{ $i }}][preset]" class="form-select advice-preset-select" data-row="{{ $i }}">
                        <option value="">@lang('messages.rx_advices.presets_placeholder')</option>
                        @foreach ([
                          __('messages.rx_advices.preset_avoid_sun'),
                          __('messages.rx_advices.preset_spf'),
                          __('messages.rx_advices.preset_moisturizer'),
                          __('messages.rx_advices.preset_gentle_cleanser'),
                          __('messages.rx_advices.preset_patch_test'),
                          __('messages.rx_advices.preset_avoid_eye')
                        ] as $preset)
                          <option value="{{ $preset }}" @if($adviceText == $preset) selected @endif>{{ $preset }}</option>
                        @endforeach
                        <option value="__new__" @if($adviceText && !in_array($adviceText, [
                          __('messages.rx_advices.preset_avoid_sun'),
                          __('messages.rx_advices.preset_spf'),
                          __('messages.rx_advices.preset_moisturizer'),
                          __('messages.rx_advices.preset_gentle_cleanser'),
                          __('messages.rx_advices.preset_patch_test'),
                          __('messages.rx_advices.preset_avoid_eye')
                        ])) selected @endif>أدخل نص جديد...</option>
                      </select>
                      <input type="text" name="rx[advices][{{ $i }}][text]" class="form-control advice-text-new" placeholder="@lang('messages.rx_advices.instructions')" style="display:@if($adviceText && !in_array($adviceText, [
                          __('messages.rx_advices.preset_avoid_sun'),
                          __('messages.rx_advices.preset_spf'),
                          __('messages.rx_advices.preset_moisturizer'),
                          __('messages.rx_advices.preset_gentle_cleanser'),
                          __('messages.rx_advices.preset_patch_test'),
                          __('messages.rx_advices.preset_avoid_eye')
                        ])) block @else none @endif" value="@if($adviceText && !in_array($adviceText, [
                          __('messages.rx_advices.preset_avoid_sun'),
                          __('messages.rx_advices.preset_spf'),
                          __('messages.rx_advices.preset_moisturizer'),
                          __('messages.rx_advices.preset_gentle_cleanser'),
                          __('messages.rx_advices.preset_patch_test'),
                          __('messages.rx_advices.preset_avoid_eye')
                        ])){{ $adviceText }}@endif">
                    </div>
                  </td>
                  <td><button class="btn danger advice-remove" type="button">✕</button></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Medication select: show/hide new input
  function updateMedNameInput(row) {
    var select = document.querySelector('select.med-name-select[data-row="'+row+'"]');
    var input = document.querySelector('input.med-name-new[name="rx[meds]['+row+'][name_new]"]');
    if (select && input) {
      if (select.value === '__new__') {
        input.style.display = 'block';
        input.required = true;
      } else {
        input.style.display = 'none';
        input.required = false;
        input.value = '';
      }
    }
  }
  document.querySelectorAll('select.med-name-select').forEach(function(sel) {
    sel.addEventListener('change', function() {
      updateMedNameInput(this.getAttribute('data-row'));
    });
    // Initial state
    updateMedNameInput(sel.getAttribute('data-row'));
  });

  // Advice preset select: show/hide new input
  function updateAdviceTextInput(row) {
    var select = document.querySelector('select.advice-preset-select[data-row="'+row+'"]');
    var input = document.querySelector('input.advice-text-new[name="rx[advices]['+row+'][text]"]');
    if (select && input) {
      if (select.value === '__new__') {
        input.style.display = 'block';
        input.required = true;
      } else {
        input.style.display = 'none';
        input.required = false;
        input.value = select.value;
      }
    }
  }
  document.querySelectorAll('select.advice-preset-select').forEach(function(sel) {
    sel.addEventListener('change', function() {
      updateAdviceTextInput(this.getAttribute('data-row'));
    });
    // Initial state
    updateAdviceTextInput(sel.getAttribute('data-row'));
  });
});
</script>
<script>
  window.allMedicationsList = {!! json_encode($allMedications->pluck('name')->values(), JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) !!};
</script>
