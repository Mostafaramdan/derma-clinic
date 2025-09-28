@extends('layouts.dashboard')
@section('title', __('edit_visit'))

@push('styles')
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ url('css/visit.css') }}">
@endpush

@push('scripts')
  <script>
    window.__VISIT_CTX__ = {
      bpImage: @json($visit->bp_image_url ?? 'https://api.cefour.com/storage/image/anatomy_68bc89752e694.png'),
      services: @json($services ?? []),
    };
  </script>
  <script src="{{ asset('js/visit.js') }}"></script>
@endpush

@section('content')
<div class="container">
  <form method="POST" action="{{ route('visits.update', $visit->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- شريط معلومات أعلى --}}
    <div class="visit-info-bar">
      <div class="vib-left">
        <div class="avatar">
          {{ mb_substr($visit->patient->name ?? 'م',0,1) }}
        </div>
        <div>
          <div class="vib-name">{{ $visit->patient->name ?? '' }}</div>
          <small class="vib-meta">
            {{ __('visit_code') }}: {{ $visit->visit_code ?? $visit->id }}
            • {{ optional($visit->created_at)->format('Y-m-d H:i') }}
            • د. {{ $visit->doctor->name ?? '---' }}
          </small>
        </div>
      </div>
      <div class="vib-actions">
        <button type="submit" name="save_draft" class="btn">{{ __('save') }} {{ __('draft') ?? 'Draft' }}</button>
        <button type="submit" class="btn primary">{{ __('save') }}</button>
      </div>
    </div>

    {{-- Tabs --}}
    <div class="tabs" id="visitTabs" role="tablist" aria-label="Visit Tabs">
      <button type="button" class="tab-btn" role="tab" data-target="#tab-basic"  aria-selected="true">{{ __('patient_basic') }}</button>
      <button type="button" class="tab-btn" role="tab" data-target="#tab-exam"   aria-selected="false">{{ __('exam') }}</button>
      <button type="button" class="tab-btn" role="tab" data-target="#tab-rx"     aria-selected="false">{{ __('rx_advices') }}</button>
      <button type="button" class="tab-btn" role="tab" data-target="#tab-labs"   aria-selected="false">{{ __('labs_files') }}</button>
      <button type="button" class="tab-btn" role="tab" data-target="#tab-photos" aria-selected="false">{{ __('photos') }}</button>
      <button type="button" class="tab-btn" role="tab" data-target="#tab-billing" aria-selected="false">{{ __('billing') }}</button>
    </div>

    <div class="tabpanels">
      <section class="tabpanel" id="tab-basic" role="tabpanel" aria-hidden="false">
        @include('visits.partials.patient-basic', ['patient' => $visit->patient, 'chronicDiseases' => $chronicDiseases ?? []])
      </section>

      <section class="tabpanel" id="tab-exam" role="tabpanel" aria-hidden="true">
        @include('visits.partials.exam', ['visit' => $visit])
      </section>

      <section class="tabpanel" id="tab-rx" role="tabpanel" aria-hidden="true">
        @include('visits.partials.rx-advices', [
          'medications' => $visit->medications ?? [],
          'advices'     => $visit->advices ?? []
        ])
      </section>

      <section class="tabpanel" id="tab-labs" role="tabpanel" aria-hidden="true">
        @include('visits.partials.labs-files', [
          'labs'  => $visit->labs ?? [],
          'files' => $visit->files ?? []
        ])
      </section>

      <section class="tabpanel" id="tab-photos" role="tabpanel" aria-hidden="true">
        @include('visits.partials.photos', ['photos' => $visit->photos ?? []])
      </section>

      <section class="tabpanel" id="tab-billing" role="tabpanel" aria-hidden="true">
        @include('visits.partials.billing', [
          'services' => $services ?? [],
          'invoice'  => $visit->invoice ?? null
        ])
      </section>
    </div>

    <div class="actions end">
      <button class="btn"            type="submit" name="save_draft">{{ __('save') }} {{ __('draft') ?? 'Draft' }}</button>
      <button class="btn primary"    type="submit">{{ __('save') }}</button>
    </div>
  </form>
</div>
@endsection
