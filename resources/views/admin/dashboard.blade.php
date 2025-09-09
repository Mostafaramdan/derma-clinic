@extends('layouts.admin')
@section('title','Admin Dashboard')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h4 m-0">👋 {{ __('Welcome') }}, {{ auth()->user()->name }}</h1>
    <div class="text-muted small">{{ now()->format('Y-m-d H:i') }}</div>
  </div>

  <div class="row g-3">
    <div class="col-md-3">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="fw-bold">📊 {{ __('Patients') }}</div>
          <div class="display-6">125</div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="fw-bold">📝 {{ __('Visits') }}</div>
          <div class="display-6">82</div>
        </div>
      </div>
    </div>
  </div>
@endsection
