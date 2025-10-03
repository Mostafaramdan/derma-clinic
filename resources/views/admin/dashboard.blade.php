@extends('layouts.admin')
@section('title','Admin Dashboard')

@section('content')
<style>
  .stat-card {
    border-radius: 1.2rem;
    box-shadow: 0 6px 32px 0 rgba(37,99,235,0.10), 0 1.5px 6px 0 rgba(0,0,0,0.04);
    border: 2px solid #e0e7ff;
    transition: transform 0.12s;
    min-height: 140px;
  }
  .stat-card:hover {
    transform: translateY(-4px) scale(1.025);
    box-shadow: 0 10px 40px 0 rgba(37,99,235,0.16), 0 2px 8px 0 rgba(0,0,0,0.06);
  }
  .stat-icon {
    font-size: 2.2rem;
    margin-bottom: 0.5rem;
    display: inline-block;
  }
  .stat-label {
    font-weight: bold;
    color: #2563eb;
    font-size: 1.1rem;
    letter-spacing: 0.5px;
  }
  .stat-value {
    font-size: 2.2rem;
    font-weight: bold;
    color: #0a0a23;
  }
</style>
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="h4 m-0">👋 {{ __('Welcome') }}, {{ auth()->user()->name }}</h1>
  <div class="text-muted small">{{ now()->format('Y-m-d H:i') }}</div>
</div>
<div class="row g-3">
  <div class="col-md-3 col-6">
    <div class="stat-card bg-white p-3 text-center">
      <div class="stat-icon" style="color:#2563eb;">👤</div>
      <div class="stat-label">{{ __('Patients') }}</div>
      <div class="stat-value">{{ $patientsCount ?? 0 }}</div>
    </div>
  </div>
  <div class="col-md-3 col-6">
    <div class="stat-card bg-white p-3 text-center">
      <div class="stat-icon" style="color:#0ea5e9;">📝</div>
      <div class="stat-label">{{ __('Visits') }}</div>
      <div class="stat-value">{{ $visitsCount ?? 0 }}</div>
    </div>
  </div>
  <div class="col-md-3 col-6">
    <div class="stat-card bg-white p-3 text-center">
      <div class="stat-icon" style="color:#f59e42;">💊</div>
      <div class="stat-label">{{ __('Medications') }}</div>
      <div class="stat-value">{{ $medicationsCount ?? 0 }}</div>
    </div>
  </div>
  <div class="col-md-3 col-6">
    <div class="stat-card bg-white p-3 text-center">
      <div class="stat-icon" style="color:#eab308;">🧬</div>
      <div class="stat-label">{{ __('Radiologies') }}</div>
      <div class="stat-value">{{ $radiologiesCount ?? 0 }}</div>
    </div>
  </div>
  <div class="col-md-3 col-6">
    <div class="stat-card bg-white p-3 text-center">
      <div class="stat-icon" style="color:#a21caf;">🧪</div>
      <div class="stat-label">{{ __('Labs') }}</div>
      <div class="stat-value">{{ $labsCount ?? 0 }}</div>
    </div>
  </div>
  <div class="col-md-3 col-6">
    <div class="stat-card bg-white p-3 text-center">
      <div class="stat-icon" style="color:#16a34a;">💡</div>
      <div class="stat-label">{{ __('Advices') }}</div>
      <div class="stat-value">{{ $advicesCount ?? 0 }}</div>
    </div>
  </div>
  <div class="col-md-3 col-6">
    <div class="stat-card bg-white p-3 text-center">
      <div class="stat-icon" style="color:#f43f5e;">🛎️</div>
      <div class="stat-label">{{ __('Services') }}</div>
      <div class="stat-value">{{ $servicesCount ?? 0 }}</div>
    </div>
  </div>
  <div class="col-md-3 col-6">
    <div class="stat-card bg-white p-3 text-center">
      <div class="stat-icon" style="color:#f87171;">❤️</div>
      <div class="stat-label">{{ __('Chronic Diseases') }}</div>
      <div class="stat-value">{{ $chronicDiseasesCount ?? 0 }}</div>
    </div>
  </div>
  <div class="col-md-3 col-6">
    <div class="stat-card bg-white p-3 text-center">
      <div class="stat-icon" style="color:#6366f1;">�</div>
      <div class="stat-label">{{ __('Admins') }}</div>
      <div class="stat-value">{{ $adminsCount ?? 0 }}</div>
    </div>
  </div>
  <div class="col-md-3 col-6">
    <div class="stat-card bg-white p-3 text-center">
      <div class="stat-icon" style="color:#f472b6;">📄</div>
      <div class="stat-label">{{ __('Prescriptions') }}</div>
      <div class="stat-value">{{ $prescriptionsCount ?? 0 }}</div>
    </div>
  </div>
</div>
@endsection
