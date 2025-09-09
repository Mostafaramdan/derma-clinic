@extends('layouts.app')
@section('title', __('new_visit'))

@push('scripts')
  @vite('resources/js/visit.js')
@endpush

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4 m-0">{{ __('new_visit') }}</h1>
    <div class="d-flex gap-2">
      <button class="btn btn-outline-secondary">{{ __('save') }} {{ __('draft') ?? 'Draft' }}</button>
      <button class="btn btn-primary">{{ __('save') }}</button>
    </div>
  </div>

  {{-- تبويبات Bootstrap --}}
  <ul class="nav nav-pills mb-3" id="visitTabs" role="tablist">
    <li class="nav-item"><button class="nav-link active" data-bs-toggle="pill" data-bs-target="#tab-basic" type="button">{{ __('patient_basic') }}</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-history" type="button">{{ __('medical_history') }}</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-exam" type="button">{{ __('exam') }}</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-rx" type="button">{{ __('rx_advices') }}</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-labs" type="button">{{ __('labs_files') }}</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-photos" type="button">{{ __('photos') }}</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-billing" type="button">{{ __('billing') }}</button></li>
  </ul>

  <div class="tab-content">
    <div class="tab-pane fade show active" id="tab-basic">@include('visits.partials.patient-basic')</div>
    <div class="tab-pane fade" id="tab-history">@include('visits.partials.history')</div>
    <div class="tab-pane fade" id="tab-exam">@include('visits.partials.exam')</div>
    <div class="tab-pane fade" id="tab-rx">@include('visits.partials.rx-advices')</div>
    <div class="tab-pane fade" id="tab-labs">@include('visits.partials.labs-files')</div>
    <div class="tab-pane fade" id="tab-photos">@include('visits.partials.photos')</div>
    <div class="tab-pane fade" id="tab-billing">@include('visits.partials.billing')</div>
  </div>
@endsection
