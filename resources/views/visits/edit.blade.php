
@extends('layouts.dashboard')
@section('title', __('edit_visit'))

@push('styles')
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ url('css/visit.css') }}">
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

    <div class="tabs" id="visitTabs" role="tablist" aria-label="Visit Tabs">
  <button type="button" class="tab-btn" role="tab" id="tab-basic-btn" aria-controls="tab-basic" aria-selected="true">{{ __('patient_basic') }}</button>
  <button type="button" class="tab-btn" role="tab" id="tab-exam-btn" aria-controls="tab-exam" aria-selected="false">{{ __('exam') }}</button>
  <button type="button" class="tab-btn" role="tab" id="tab-rx-btn" aria-controls="tab-rx" aria-selected="false">{{ __('rx_advices') }}</button>
  <button type="button" class="tab-btn" role="tab" id="tab-labs-btn" aria-controls="tab-labs" aria-selected="false">{{ __('labs_files') }}</button>
  <button type="button" class="tab-btn" role="tab" id="tab-photos-btn" aria-controls="tab-photos" aria-selected="false">{{ __('photos') }}</button>
  <button type="button" class="tab-btn" role="tab" id="tab-billing-btn" aria-controls="tab-billing" aria-selected="false">{{ __('billing') }}</button>
    </div>

    <div class="tabpanels">
  <div class="tabpanel" id="tab-basic" role="tabpanel" aria-labelledby="tab-basic-btn" aria-hidden="false">@include('visits.partials.patient-basic', ['patient' => $visit->patient, 'chronicDiseases' => $chronicDiseases, 'visit' => $visit])</div>
      <div class="tabpanel" id="tab-exam" role="tabpanel" aria-labelledby="tab-exam-btn" aria-hidden="true">@include('visits.partials.exam', ['visit' => $visit])</div>
      <div class="tabpanel" id="tab-rx" role="tabpanel" aria-labelledby="tab-rx-btn" aria-hidden="true">@include('visits.partials.rx-advices', ['medications' => $visit->medications, 'advices' => $visit->advices])</div>
      <div class="tabpanel" id="tab-labs" role="tabpanel" aria-labelledby="tab-labs-btn" aria-hidden="true">@include('visits.partials.labs-files', ['labs' => $visit->labs, 'files' => $visit->files])</div>
      <div class="tabpanel" id="tab-photos" role="tabpanel" aria-labelledby="tab-photos-btn" aria-hidden="true">@include('visits.partials.photos', ['photos' => $visit->photos])</div>
      <div class="tabpanel" id="tab-billing" role="tabpanel" aria-labelledby="tab-billing-btn" aria-hidden="true">@include('visits.partials.billing', ['services' => $services, 'invoice' => $visit->invoice])</div>
    </div>
  </form>
</div>
@endsection
