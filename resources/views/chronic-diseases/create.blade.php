@extends('layouts.dashboard')
@section('title', __('messages.chronic.create_title'))
@section('content')
<div class="container py-4">
  <div class="text-center mb-3">
    <span class="d-inline-block mb-2" style="font-size:2.5rem;">❤️</span>
    <h1 class="fw-bold text-primary">{{ __('messages.chronic.create_title') }}</h1>
  </div>
  <div class="bg-white shadow-sm rounded-3 p-4">
    <form method="POST" action="{{ route('chronic-diseases.store') }}">
      @csrf
      <div class="mb-3">
        <label class="form-label">{{ __('messages.chronic.name_ar') }}</label>
        <input type="text" name="name_ar" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">{{ __('messages.chronic.name_en') }}</label>
        <input type="text" name="name_en" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">{{ __('messages.chronic.active') }}</label>
        <select name="is_active" class="form-select">
          <option value="1">{{ __('messages.chronic.yes') }}</option>
          <option value="0">{{ __('messages.chronic.no') }}</option>
        </select>
      </div>
  <button type="submit" class="btn btn-success"><i class="bi bi-plus-circle me-1"></i> {{ __('messages.chronic.save') }}</button>
      <a href="{{ route('chronic-diseases.index') }}" class="btn btn-secondary">{{ __('messages.chronic.cancel') }}</a>
    </form>
  </div>
</div>
@endsection
