@extends('layouts.admin')
@section('title', __('messages.patients.title'))
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
  <h1 class="fw-bold text-primary">@lang('messages.patients.search_patient')</h1>
  </div>
  <form method="GET" action="{{ route('patients.index') }}" class="mb-4">
    <div class="row g-2">
      <div class="col-md-3">
  <input type="text" name="q" class="form-control" placeholder="@lang('messages.patients.search_placeholder')" value="{{ request('q') }}">
      </div>
      <div class="col-md-2">
  <button type="submit" class="btn btn-primary w-100">@lang('messages.patients.search')</button>
      </div>
      <div class="col-md-2">
  <a href="{{ route('patients.create') }}" class="btn btn-success w-100"><i class="bi bi-plus-circle me-1"></i> @lang('messages.patients.add_new')</a>
      </div>
    </div>
  </form>
  <div class="bg-white shadow-sm rounded-3 p-4">
    <table class="table table-bordered align-middle">
      <thead>
        <tr>
          <th>@lang('messages.patients.ref_code')</th>
          <th>@lang('messages.patients.name')</th>
          <th>@lang('messages.patients.phone')</th>
          <th>@lang('messages.patients.address')</th>
          <th>@lang('messages.patients.actions')</th>
        </tr>
      </thead>
      <tbody>
        @forelse($patients as $patient)
        <tr>
          <td>{{ $patient->ref_code }}</td>
          <td>{{ $patient->name }}</td>
          <td>{{ $patient->phone }}</td>
          <td>{{ $patient->address }}</td>
          <td>
            <a href="{{ route('patients.edit', $patient) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square me-1"></i> @lang('messages.patients.edit')</a>
            <a href="{{ route('visits.create', ['patient' => $patient->id]) }}" class="btn btn-sm btn-primary">@lang('messages.patients.new_visit')</a>
          </td>
        </tr>
        @empty
  <tr><td colspan="5" class="text-center">@lang('messages.patients.empty')</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
