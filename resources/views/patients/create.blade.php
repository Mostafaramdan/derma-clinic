@extends('layouts.admin')
@section('title', __('messages.patients.create_title'))
@section('content')
<div class="container py-4">
  <div class="text-center mb-2">
    <span class="d-inline-block mb-2" style="font-size:2.5rem;">
      <!-- SVG أيقونة user -->
      <svg width="48" height="48" viewBox="0 0 24 24" fill="none">
        <circle cx="12" cy="8" r="5" fill="#ffd600" stroke="#2563eb" stroke-width="2.2"/>
        <ellipse cx="12" cy="18" rx="8" ry="5" fill="#fffbe6" stroke="#2563eb" stroke-width="2.2"/>
      </svg>
    </span>
  <h1 class="fw-bold text-primary">@lang('messages.patients.create_title')</h1>
  </div>
  <div class="bg-white shadow-sm rounded-3 p-4">
    <form method="POST" action="{{ route('patients.store') }}">
      @csrf
      <div class="row g-3">
        <div class="col-md-6">
          <label for="name" class="form-label">@lang('messages.patients.name')</label>
          <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="col-md-3">
          <label for="age_years" class="form-label">@lang('messages.patients.age_years')</label>
          <input type="number" name="age_years" id="age_years" class="form-control" min="0">
        </div>
        <div class="col-md-3">
          <label for="age_months" class="form-label">@lang('messages.patients.age_months')</label>
          <input type="number" name="age_months" id="age_months" class="form-control" min="0" max="11">
        </div>
        <div class="col-md-3">
          <label for="gender" class="form-label">@lang('messages.patients.gender')</label>
          <select name="gender" id="gender" class="form-select" required>
            <option value="male">@lang('messages.patients.male')</option>
            <option value="female">@lang('messages.patients.female')</option>
          </select>
        </div>
        <div class="col-md-3">
          <label for="marital_status" class="form-label">@lang('messages.patients.marital_status')</label>
          <select name="marital_status" id="marital_status" class="form-select">
            <option value="single">@lang('messages.patients.single')</option>
            <option value="married">@lang('messages.patients.married')</option>
            <option value="divorced">@lang('messages.patients.divorced')</option>
            <option value="widowed">@lang('messages.patients.widowed')</option>
          </select>
        </div>
        <div class="col-md-6">
          <label for="job" class="form-label">@lang('messages.patients.job')</label>
          <input type="text" name="job" id="job" class="form-control">
        </div>
        <div class="col-md-6">
          <label for="address" class="form-label">@lang('messages.patients.address')</label>
          <input type="text" name="address" id="address" class="form-control">
        </div>
        <div class="col-md-3">
          <label for="phone" class="form-label">@lang('messages.patients.phone')</label>
          <input type="text" name="phone" id="phone" class="form-control">
        </div>
        <div class="col-md-12">
          <label for="notes" class="form-label">@lang('messages.patients.notes')</label>
          <textarea name="notes" id="notes" class="form-control" rows="2"></textarea>
        </div>
      </div>
  <button type="submit" class="btn btn-success mt-4">@lang('messages.patients.save')</button>
    </form>
  </div>
</div>
@endsection
