@extends('layouts.dashboard')

@push('styles')
<style>
    .tab-btn { position:relative; }
    .tab-btn .tab-dot {
      display:none;
      position:absolute;
      top:6px;
      right:10px;
      width:7px;
      height:7px;
      background:#d32f2f;
      border-radius:50%;
      box-shadow:0 0 0 2px #fff;
      z-index:2;
    }
    .tab-btn.tab-error .tab-dot { display:inline-block !important; }
  </style>
  <style>
    .tabs {
      display: flex;
      gap: 18px;
      margin-bottom: 22px;
      border-bottom: 1px solid #e2e8f0;
      background: #f8fafc;
      padding: 0 16px;
      border-radius: 16px 16px 0 0;
      box-shadow: 0 2px 8px rgba(37,99,235,.04);
    }
    .tab-btn {
      position: relative;
      background: none;
      padding: 13px 28px 11px 28px;
      border-radius: 14px 14px 0 0;
      cursor: pointer;
      transition: background 0.2s, color 0.2s;
      letter-spacing: 0.5px;
      outline: none;
    }
    .tab-btn[aria-selected="true"] {
      background: #fff;
      color: #1e293b;
      box-shadow: 0 2px 8px rgba(37,99,235,.08);
      border-bottom: 2px solid #3b82f6;
      z-index: 2;
    }
    .tab-btn .tab-dot {
      display: none;
      position: absolute;
      top: 6px;
      right: 14px;
      width: 6px;
      height: 6px;
      background: #d32f2f;
      border-radius: 50%;
      box-shadow: 0 0 0 2px #fff;
      z-index: 3;
    }
    .tab-btn.tab-error .tab-dot { display: inline-block !important; }
    .tab-btn:focus { box-shadow: 0 0 0 2px #3b82f6; }
    /* تلوين الحقل عند وجود خطأ */
    .is-invalid { border-color: #d32f2f !important; background: #fff5f5 !important; }
    .field-error { color:#d32f2f;font-size:13px;margin-top:4px;font-weight:600; }
  </style>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ url('css/visit.css') }}">
  <style>
    .tab-btn { position:relative; }
    .tab-btn .tab-dot {
      display:none;
      position:absolute;
      top:6px;
      right:10px;
      width:7px;
      height:7px;
      background:#d32f2f;
      border-radius:50%;
      box-shadow:0 0 0 2px #fff;
      z-index:2;
    }
    .tab-btn.tab-error .tab-dot { display:inline-block !important; }
    /* تلوين الحقل عند وجود خطأ */
    .is-invalid { border-color: #d32f2f !important; background: #fff5f5 !important; }
    .field-error { color:#d32f2f;font-size:13px;margin-top:4px;font-weight:600; }
  </style>
@endpush

@push('scripts')
  <script src="{{ asset('js/visit.js') }}"></script>
@endpush

@php
  $prescriptionTemplatesJs = $prescriptionTemplates->map(function($tmpl) {
    return [
      'id' => $tmpl->id,
      'name' => $tmpl->name,
      'medications' => $tmpl->medications->map(function($m) {
        return [ 'name' => $m->name ];
      })->values(),
      'advices' => $tmpl->advices->map(function($a) {
        return [ 'text' => $a->name ];
      })->values(),
    ];
  })->values();
@endphp

@push('scripts')
<script>
  window.prescriptionTemplates = {!! json_encode($prescriptionTemplatesJs, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) !!};
  window.allMedicationsList = {!! json_encode($allMedications->pluck('name')->values(), JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) !!};
</script>
@endpush

@section('content')
@php
  $prescriptionTemplatesJs = $prescriptionTemplates->map(function($tmpl) {
    return [
      'id' => $tmpl->id,
      'name' => $tmpl->name,
      'medications' => $tmpl->medications->map(function($m) {
        return [ 'name' => $m->name ];
      })->values(),
      'advices' => $tmpl->advices->map(function($a) {
        return [ 'text' => $a->name ];
      })->values(),
    ];
  })->values();
@endphp
<script></script>

<div class="container">
  <form id="visitForm" method="POST" action="{{ route('visits.update', $visit->id) }}" enctype="multipart/form-data">
  <div id="clientErrors" style="display:none;margin-bottom:18px;border-radius:12px;padding:16px 24px;background:#fee2e2;color:#991b1b;font-weight:700;border:1px solid #fecaca;"></div>

<script>
document.addEventListener('DOMContentLoaded', function(){
  const form = document.getElementById('visitForm');
  const clientErrors = document.getElementById('clientErrors');
  // إزالة جميع النقاط الحمراء عند أول تحميل الصفحة
  document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('tab-error'));
  form.addEventListener('submit', function(e){
    let errors = [];
    // مثال: تحقق من الاسم
    const name = form.querySelector('[name="patient[name]"]');
    if(!name || !name.value.trim()) errors.push('يجب إدخال اسم المريض');
    // تحقق من العمر
    const age = form.querySelector('[name="patient[age_years]"]');
    if(age && (isNaN(age.value) || age.value<0 || age.value>150)) errors.push('العمر يجب أن يكون بين 0 و 150 سنة');
    // exam.locations يجب أن تكون array
    const locationsInput = form.querySelector('[name="exam[locations]"]');
    if(locationsInput) {
      try {
        const val = locationsInput.value;
        if(val && typeof val === 'string') {
          const arr = JSON.parse(val);
          if(!Array.isArray(arr)) errors.push('أماكن الإصابة يجب أن تكون قائمة (array)');
          else locationsInput.value = JSON.stringify(arr); // تأكيد التحويل
        }
      } catch { errors.push('أماكن الإصابة يجب أن تكون قائمة (array)'); }
    }
    // إزالة النقاط الحمراء عند بداية submit
    document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('tab-error'));

    if(errors.length){
      e.preventDefault();
      clientErrors.innerHTML = '<div style="margin-bottom:8px;">حدثت أخطاء في البيانات المدخلة:</div><ul style="margin:0;padding:0 0 0 18px;">'+errors.map(e=>'<li>'+e+'</li>').join('')+'</ul>';
      clientErrors.style.display = 'block';
      window.scrollTo({top:form.offsetTop-60,behavior:'smooth'});
    }else{
      clientErrors.style.display = 'none';
    }
  });
});
</script>

@if ($errors->any())
  <div class="alert alert-danger" style="margin-bottom:18px;border-radius:12px;padding:16px 24px;background:#fee2e2;color:#991b1b;font-weight:700;border:1px solid #fecaca;">
    <div style="margin-bottom:8px;">حدثت أخطاء في البيانات المدخلة:</div>
    <ul style="margin:0;padding:0 0 0 18px;">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

@csrf
@method('PUT')

<!-- شريط معلومات أفقي -->
<div class="visit-info-bar" style="margin-bottom:18px;background:linear-gradient(90deg,#f8fafc,#f1f5f9);border-radius:16px;padding:18px 28px;display:flex;align-items:center;justify-content:space-between;box-shadow:0 6px 18px rgba(37,99,235,.08);border:1px solid #e2e8f0;">
  <div style="display:flex;align-items:center;gap:18px;">
    <div class="avatar" style="width:44px;height:44px;border-radius:50%;background:linear-gradient(135deg,#3b82f6,#2563eb);color:#fff;display:grid;place-items:center;font-weight:800;font-size:1.5rem;box-shadow:0 4px 10px rgba(37,99,235,.18);">
      {{ mb_substr($visit->patient->name ?? 'م',0,1) }}
    </div>
    <div>
      <div style="font-weight:900;font-size:1.1rem;">{{ $visit->patient->name ?? '' }}</div>
      <small style="color:var(--muted);font-size:14px;">@lang('messages.visits.code'): {{ $visit->visit_code ?? $visit->id }} • {{ $visit->created_at->format('Y-m-d H:i') ?? '' }} • @lang('messages.visits.doctor'): {{ $visit->doctor->name ?? '---' }}</small>
    </div>
  </div>
  <div style="display:flex;gap:10px;">
    <button type="submit" name="save_draft" class="btn" style="font-weight:800;padding:10px 18px;border-radius:12px;background:#fff;color:#2563eb;border:1px solid #e2e8f0;box-shadow:0 6px 14px rgba(15,23,42,.06);">@lang('messages.visits.save_draft')</button>
    <button type="submit" class="btn primary" form="visitForm" style="font-weight:800;padding:10px 18px;border-radius:12px;background:linear-gradient(135deg,#3b82f6,#2563eb);color:#fff;border:0;box-shadow:0 8px 18px rgba(37,99,235,.18);">@lang('messages.visits.save')</button>
  </div>
</div>

<div class="tabs" id="visitTabs" role="tablist" aria-label="Visit Tabs">
  <button type="button" class="tab-btn" id="tab-basic-btn" data-panel="tab-basic" aria-controls="tab-basic" aria-selected="true"><span class="tab-dot"></span>@lang('messages.visits.patient_basic')</button>
  <button type="button" class="tab-btn @if($errors->has('exam.locations')) tab-error @endif" id="tab-exam-btn" data-panel="tab-exam" aria-controls="tab-exam" aria-selected="false"><span class="tab-dot"></span>@lang('messages.visits.exam')</button>
  <button type="button" class="tab-btn" id="tab-rx-btn" data-panel="tab-rx" aria-controls="tab-rx" aria-selected="false">@lang('messages.visits.rx_advices')</button>
  <button type="button" class="tab-btn" id="tab-labs-btn" data-panel="tab-labs" aria-controls="tab-labs" aria-selected="false">@lang('messages.visits.labs_files')</button>
  <button type="button" class="tab-btn" id="tab-photos-btn" data-panel="tab-photos" aria-controls="tab-photos" aria-selected="false">@lang('messages.visits.photos')</button>
  <button type="button" class="tab-btn" id="tab-billing-btn" data-panel="tab-billing" aria-controls="tab-billing" aria-selected="false">@lang('messages.visits.billing')</button>
</div>

<div class="tabpanels">
  <div class="tabpanel" id="tab-basic" aria-labelledby="tab-basic-btn" aria-hidden="false">@include('visits.partials.patient-basic', ['patient'=>$visit->patient,'chronicDiseases'=>$chronicDiseases,'visit'=>$visit])</div>
  <div class="tabpanel" id="tab-exam" aria-labelledby="tab-exam-btn" aria-hidden="true">@include('visits.partials.exam', ['visit'=>$visit])</div>
  <div class="tabpanel" id="tab-rx" aria-labelledby="tab-rx-btn" aria-hidden="true">@include('visits.partials.rx-advices', ['medications'=>$visit->medications,'advices'=>$visit->advices,'allMedications'=>$allMedications])</div>
  <div class="tabpanel" id="tab-labs" aria-labelledby="tab-labs-btn" aria-hidden="true">@include('visits.partials.labs-files', ['labs'=>$visit->labs,'files'=>$visit->files])</div>
  <div class="tabpanel" id="tab-photos" aria-labelledby="tab-photos-btn" aria-hidden="true">@include('visits.partials.photos', ['photos'=>$visit->photos])</div>
  <div class="tabpanel" id="tab-billing" aria-labelledby="tab-billing-btn" aria-hidden="true">@include('visits.partials.billing', ['services'=>$services,'invoice'=>$visit->invoice])</div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const tabBtns = document.querySelectorAll('.tab-btn');
  const tabPanels = document.querySelectorAll('.tabpanel');

  function activateTabById(panelId) {
        console.log('Switching to:', panelId);
        tabPanels.forEach((panel) => {
            const show = panel.id === panelId;
            panel.setAttribute('aria-hidden', show ? 'false' : 'true');
            console.log(panel.id, '→', show ? 'VISIBLE' : 'HIDDEN');
        });
    }

  tabBtns.forEach((btn) => {
    btn.addEventListener('click', function() {
      console.log('Switching to:', btn.dataset.panel);
      activateTabById(btn.dataset.panel);
    });
  });

  // Default
  activateTabById('tab-basic');
});
</script>

@endpush

  </form>
</div>
@endsection

@push('scripts')
<script>
document.querySelectorAll('.service-row').forEach(function(row, idx) {
  row.querySelectorAll('input, select').forEach(function(input) {
    input.name = input.name.replace(/services\[\d+\]/, 'services['+idx+']');
  });
});
</script>
@endpush
