
@extends('layouts.dashboard')
@section('title', __('edit_visit'))

@push('styles')
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
  <style>
    :root{--bg:#f6f9fc;--surface:#fff;--text:#0f172a;--muted:#64748b;--line:#e2e8f0;--primary:#2563eb;--radius-xl:18px;--radius:12px;--shadow:0 8px 24px rgba(37,99,235,.08);}
    *{box-sizing:border-box}
    body{margin:0;background:linear-gradient(180deg,#f8fafc,#f4f6fa);color:var(--text);font:15.5px/1.7 'Cairo',system-ui}
    .container{max-width:1200px;margin:0 auto;padding:20px}
    .topbar{position:sticky;top:0;z-index:50;backdrop-filter:blur(10px) saturate(140%);background:rgba(255,255,255,.9);border-bottom:1px solid var(--line)}
    .topbar-inner{display:flex;justify-content:space-between;align-items:center;padding:12px 20px}
    .brand{display:flex;align-items:center;gap:12px}
    .avatar{width:42px;height:42px;border-radius:50%;display:grid;place-items:center;background:linear-gradient(135deg,#3b82f6,#2563eb);color:#fff;font-weight:800;box-shadow:0 4px 10px rgba(37,99,235,.25)}
    .actions{display:flex;gap:10px}
    .btn{appearance:none;border:1px solid var(--line);cursor:pointer;border-radius:var(--radius);padding:10px 14px;font-weight:800;background:#fff;color:#0f172a;box-shadow:0 6px 14px rgba(15,23,42,.06);transition:.2s}
    .btn:hover{transform:translateY(-1px);box-shadow:0 10px 20px rgba(15,23,42,.1)}
    .btn.primary{background:linear-gradient(135deg,#3b82f6,#2563eb);border:0;color:#fff;box-shadow:0 8px 18px rgba(37,99,235,.25)}
    .btn.danger{background:#fee2e2;border-color:#fca5a5}
    .tabs{display:flex;gap:10px;flex-wrap:wrap;padding-bottom:8px}
    .tab-btn{background:#fff;border:1px solid var(--line);color:#334155;padding:10px 16px;border-radius:14px;cursor:pointer;box-shadow:0 6px 14px rgba(15,23,42,.06)}
    .tab-btn[aria-selected="true"]{color:#0f172a;background:#eef4ff;border:1px solid #c7d2fe}
    .tabpanels{padding-top:16px}
    .tabpanel{display:none}
    .tabpanel[aria-hidden="false"]{display:block;animation:fadeIn .35s ease}
    @keyframes fadeIn{from{opacity:0;transform:translateY(6px)}to{opacity:1;transform:translateY(0)}}
    .card{background:#fff;border:1px solid var(--line);border-radius:var(--radius-xl);box-shadow:var(--shadow);overflow:hidden;margin:12px 0}
    .card .head{display:flex;justify-content:space-between;align-items:center;padding:14px 18px;background:linear-gradient(90deg,#f8fafc,#f1f5f9);border-bottom:1px solid var(--line)}
    .card .head h3{margin:0;font-size:1rem;color:var(--primary);position:relative;padding-inline-start:12px}
    .card .head h3::before{content:"";position:absolute;inset-inline-start:0;top:6px;width:6px;height:18px;border-radius:6px;background:linear-gradient(180deg,#60a5fa,#2563eb)}
    .card .body{padding:18px}
    .hint{color:#64748b;font-size:13px}
    .grid{display:grid;grid-template-columns:1.1fr .9fr;gap:16px}
    @media (max-width:1080px){.grid{grid-template-columns:1fr}}
    .row{display:grid;grid-template-columns:repeat(12,1fr);gap:12px;margin-bottom:12px}
    .field{display:flex;flex-direction:column;gap:6px;grid-column:span 6}
    .field.third{grid-column:span 4}
    .field.quarter{grid-column:span 3}
    .field.full{grid-column:1/-1}
    label{color:#0f172a;font-weight:800;font-size:13.5px}
    input,select,textarea{width:100%;padding:12px;border-radius:14px;background:#fff;border:1px solid #d1d9e6;color:#0f172a;outline:none}
    textarea{min-height:96px;resize:vertical}
    .skin-types{display:grid;grid-template-columns:repeat(6,1fr);gap:10px}
    .skin-card{display:flex;flex-direction:column;align-items:center;gap:8px;padding:10px;border:2px solid #e2e8f0;border-radius:14px;background:#fff;cursor:pointer}
    .skin-card.active{border-color:#2563eb;background:#eff6ff}
    .skin-swatch{width:32px;height:32px;border-radius:999px;border:1px solid #e2e8f0}
    .st1{background:#fdebd4}.st2{background:#f6d6b5}.st3{background:#e6be9a}.st4{background:#c48d62}.st5{background:#9b6946}.st6{background:#5b3c2d}
    .bp-toolbar{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:8px}
    .bp-toolbar .btn{border:1px solid var(--line);background:#fff;border-radius:10px;padding:6px 10px;font-size:13px}
    .bp-toolbar .btn.primary{background:#2563eb;color:#fff;border-color:#2563eb}
    .bp-toolbar .btn.danger{background:#fee2e2;border-color:#fca5a5}
    .coord-controls{display:flex;flex-wrap:wrap;gap:10px;margin:6px 0 12px}
    .coord-group{display:flex;align-items:center;gap:6px}
    .coord-label{font-size:12px;font-weight:800;color:#334155}
    .coord-input{width:78px;padding:4px 6px;border:1px solid #d1d9e6;border-radius:8px;font-size:12px}
    .coord-input[disabled]{background:#f3f4f6;color:#64748b}
    .coord-key{min-width:240px}
    .bodypicker{position:relative;width:100%;border:1px solid var(--line);border-radius:14px;background:#fff;overflow:hidden}
    .bp-canvas{position:relative;width:100%}
    .bp-img{display:block;width:100%;height:auto;user-select:none}
    .bp-spot{position:absolute;transform:translate(-50%,-50%);width:34px;height:34px;border-radius:50%;border:2px solid rgba(37,99,235,.35);background:rgba(37,99,235,.12);display:grid;place-items:center;cursor:grab;transition:transform .15s,box-shadow .15s,background .15s,border-color .15s;touch-action:none}
    .bp-spot::after{content:"";width:14px;height:14px;border-radius:50%;background:#2563eb}
    .bp-spot:hover{transform:translate(-50%,-50%) scale(1.06);box-shadow:0 8px 18px rgba(37,99,235,.18)}
    .bp-spot.selected{background:rgba(37,99,235,.28);border-color:#2563eb}
    .bp-spot[data-name]:hover::before{content:attr(data-name);position:absolute;bottom:100%;left:50%;transform:translate(-50%,-6px);background:#0f172a;color:#fff;font-size:12px;padding:4px 8px;border-radius:8px;white-space:nowrap;box-shadow:0 6px 14px rgba(15,23,42,.2)}
    table{width:100%;border-collapse:collapse;font-size:14px}
    th,td{border-bottom:1px solid #e2e8f0;padding:10px;text-align:right;vertical-align:middle}
    th{color:#334155;background:#f9fafc;font-weight:800}
    .totals{display:grid;gap:8px;border-top:1px dashed var(--line);padding-top:12px;margin-top:8px}
    .totals .line{display:flex;justify-content:space-between}
    .grand{font-size:18px;font-weight:800;color:var(--primary)}
    @media print{.no-print{display:none!important}body{background:#fff}.card{box-shadow:none}}
    .note{font-size:12px;color:#64748b}
    /* Inline styles moved from HTML */
    .brand-title{font-weight:900}
    .brand-sub{color:var(--muted)}
    .bodypicker-title{position:absolute;left:50%;top:10px;transform:translateX(-50%);z-index:10;pointer-events:none;}
    .bodypicker-title span{background:rgba(255,255,255,0.8);padding:6px 14px;border-radius:12px;font-weight:800;color:#2563eb;font-size:18px;}
    .table-wrap{margin-top:8px}
    .advice-block{margin-top:6px}
    .advice-block .table-wrap{margin-top:8px}
    .lab-item{border:1px solid var(--line);border-radius:14px;padding:12px;margin-top:8px;background:#fff}
    .svc-item{border:1px solid var(--line);border-radius:14px;padding:12px;margin-top:8px;background:#fff}
    .svc-select{width:100%}
    .svc-price{width:100%}
    .svc-qty{width:100%}
    .svc-remove{width:100%}
    .advice-input{width:100%}
    .advice-presets{width:auto}
    .freq-hint{margin-top:4px}
    .actions-footer{display:flex;justify-content:flex-end;margin-top:16px}
    .row.mb-12{margin-bottom:12px}
    .row.mt-12{margin-top:12px}
    .row.mt-14{margin-top:14px}
    .row.mt-8{margin-top:8px}
    .row.mt-6{margin-top:6px}
    .row.mt-10{margin-top:10px}
    .row.mt-16{margin-top:16px}
    .row.mb-8{margin-bottom:8px}
    .row.mb-6{margin-bottom:6px}
    .row.mb-10{margin-bottom:10px}
    .row.mb-16{margin-bottom:16px}
    .row.mt-0{margin-top:0}
    .row.mb-0{margin-bottom:0}
    .row.mt-24{margin-top:24px}
    .row.mb-24{margin-bottom:24px}
    .row.mt-32{margin-top:32px}
    .row.mb-32{margin-bottom:32px}
    .row.mt-4{margin-top:4px}
    .row.mb-4{margin-bottom:4px}
    .row.mt-2{margin-top:2px}
    .row.mb-2{margin-bottom:2px}
    .row.mt-20{margin-top:20px}
    .row.mb-20{margin-bottom:20px}
    .row.mt-18{margin-top:18px}
    .row.mb-18{margin-bottom:18px}
    .row.mt-28{margin-top:28px}
    .row.mb-28{margin-bottom:28px}
    .row.mt-36{margin-top:36px}
    .row.mb-36{margin-bottom:36px}
    .row.mt-40{margin-top:40px}
    .row.mb-40{margin-bottom:40px}
    .row.mt-48{margin-top:48px}
    .row.mb-48{margin-bottom:48px}
    .row.mt-56{margin-top:56px}
    .row.mb-56{margin-bottom:56px}
    .row.mt-64{margin-top:64px}
    .row.mb-64{margin-bottom:64px}
    .row.mt-72{margin-top:72px}
    .row.mb-72{margin-bottom:72px}
    .row.mt-80{margin-top:80px}
    .row.mb-80{margin-bottom:80px}
    .row.mt-96{margin-top:96px}
    .row.mb-96{margin-bottom:96px}
    .row.mt-100{margin-top:100px}
    .row.mb-100{margin-bottom:100px}
    .row.mt-120{margin-top:120px}
    .row.mb-120{margin-bottom:120px}
    .row.mt-160{margin-top:160px}
    .row.mb-160{margin-bottom:160px}
    .row.mt-200{margin-top:200px}
    .row.mb-200{margin-bottom:200px}
    .row.mt-240{margin-top:240px}
    .row.mb-240{margin-bottom:240px}
    .row.mt-320{margin-top:320px}
    .row.mb-320{margin-bottom:320px}
    .row.mt-400{margin-top:400px}
    .row.mb-400{margin-bottom:400px}
    .row.mt-480{margin-top:480px}
    .row.mb-480{margin-bottom:480px}
    .row.mt-560{margin-top:560px}
    .row.mb-560{margin-bottom:560px}
    .row.mt-640{margin-top:640px}
    .row.mb-640{margin-bottom:640px}
    .row.mt-720{margin-top:720px}
    .row.mb-720{margin-bottom:720px}
    .row.mt-800{margin-top:800px}
    .row.mb-800{margin-bottom:800px}
    .row.mt-960{margin-top:960px}
    .row.mb-960{margin-bottom:960px}
    .row.mt-1000{margin-top:1000px}
    .row.mb-1000{margin-bottom:1000px}
  </style>
@endpush

@push('scripts')
  <script src="{{ asset('js/visit.js') }}"></script>
@endpush

@section('content')
<div class="container">
  <form method="POST" action="{{ route('visits.update', $visit->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <!-- شريط معلومات أفقي جميل أسفل النافبار -->
    <div class="visit-info-bar" style="margin-bottom:18px;background:linear-gradient(90deg,#f8fafc,#f1f5f9);border-radius:16px;padding:18px 28px;display:flex;align-items:center;justify-content:space-between;box-shadow:0 6px 18px rgba(37,99,235,.08);border:1px solid #e2e8f0;">
      <div style="display:flex;align-items:center;gap:18px;">
        <div class="avatar" style="width:44px;height:44px;border-radius:50%;background:linear-gradient(135deg,#3b82f6,#2563eb);color:#fff;display:grid;place-items:center;font-weight:800;font-size:1.5rem;box-shadow:0 4px 10px rgba(37,99,235,.18);">
          {{ mb_substr($visit->patient->name ?? 'م',0,1) }}
        </div>
        <div>
          <div style="font-weight:900;font-size:1.1rem;">{{ $visit->patient->name ?? '' }}</div>
          <small style="color:var(--muted);font-size:14px;">{{ __('visit_code') }}: {{ $visit->visit_code ?? $visit->id }} • {{ $visit->created_at->format('Y-m-d H:i') ?? '' }} • د. {{ $visit->doctor->name ?? '---' }}</small>
        </div>
      </div>
      <div style="display:flex;gap:10px;">
        <button type="submit" name="save_draft" class="btn" style="font-weight:800;padding:10px 18px;border-radius:12px;background:#fff;color:#2563eb;border:1px solid #e2e8f0;box-shadow:0 6px 14px rgba(15,23,42,.06);">{{ __('save') }} {{ __('draft') ?? 'Draft' }}</button>
        <button type="submit" class="btn primary" style="font-weight:800;padding:10px 18px;border-radius:12px;background:linear-gradient(135deg,#3b82f6,#2563eb);color:#fff;border:0;box-shadow:0 8px 18px rgba(37,99,235,.18);">{{ __('save') }}</button>
      </div>
    </div>

    <div class="tabs" id="visitTabs">
      <button type="button" class="tab-btn" aria-selected="true" data-tab="tab-basic">{{ __('patient_basic') }}</button>
      <button type="button" class="tab-btn" aria-selected="false" data-tab="tab-history">{{ __('medical_history') }}</button>
      <button type="button" class="tab-btn" aria-selected="false" data-tab="tab-exam">{{ __('exam') }}</button>
      <button type="button" class="tab-btn" aria-selected="false" data-tab="tab-rx">{{ __('rx_advices') }}</button>
      <button type="button" class="tab-btn" aria-selected="false" data-tab="tab-labs">{{ __('labs_files') }}</button>
      <button type="button" class="tab-btn" aria-selected="false" data-tab="tab-photos">{{ __('photos') }}</button>
      <button type="button" class="tab-btn" aria-selected="false" data-tab="tab-billing">{{ __('billing') }}</button>
    </div>

    <div class="tabpanels">
      <div class="tabpanel" id="tab-basic" aria-hidden="false">@include('visits.partials.patient-basic', ['patient' => $visit->patient])</div>
      <div class="tabpanel" id="tab-history" aria-hidden="true">@include('visits.partials.history', ['chronicDiseases' => $chronicDiseases])</div>
      <div class="tabpanel" id="tab-exam" aria-hidden="true">@include('visits.partials.exam', ['visit' => $visit])</div>
      <div class="tabpanel" id="tab-rx" aria-hidden="true">@include('visits.partials.rx-advices', ['medications' => $visit->medications, 'advices' => $visit->advices])</div>
      <div class="tabpanel" id="tab-labs" aria-hidden="true">@include('visits.partials.labs-files', ['labs' => $visit->labs, 'files' => $visit->files])</div>
      <div class="tabpanel" id="tab-photos" aria-hidden="true">@include('visits.partials.photos', ['photos' => $visit->photos])</div>
      <div class="tabpanel" id="tab-billing" aria-hidden="true">@include('visits.partials.billing', ['services' => $services, 'invoice' => $visit->invoice])</div>
    </div>
  </form>
</div>
@endsection
