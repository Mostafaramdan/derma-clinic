@extends('layouts.admin')
@section('title','تعديل دواء')
@section('content')
<div class="container pt-4 d-flex flex-column align-items-center" style="min-height:70vh;">
    <div class="w-100" style="max-width: 900px;">
        <div class="text-center mb-4">
            <div class="mb-2 d-flex justify-content-center" style="font-size:2.5rem;">
                <span>
                  <!-- أيقونة حبة دواء SVG -->
                  <svg width="56" height="56" viewBox="0 0 24 24" fill="none">
                    <rect x="2" y="12" width="20" height="8" rx="4" fill="#4f8cff"/>
                    <rect x="2" y="4" width="20" height="8" rx="4" fill="#ff6f61"/>
                    <rect x="2" y="12" width="20" height="8" rx="4" fill="#fff" fill-opacity=".15"/>
                    <rect x="2" y="4" width="20" height="8" rx="4" fill="#fff" fill-opacity=".10"/>
                    <rect x="2" y="4" width="20" height="16" rx="8" stroke="#2563eb" stroke-width="2.2"/>
                  </svg>
                </span>
            </div>
            <h2 class="fw-bold text-primary">تعديل بيانات الدواء</h2>
        </div>
        <div class="bg-white shadow-sm rounded-4 p-4 border border-2">
            <form method="POST" action="{{ route('medications.update', $medication) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label mb-2" for="medication-name">اسم الدواء</label>
                    <input id="medication-name" name="name" value="{{ old('name', $medication->name ?? '') }}" class="form-control @error('name') is-invalid @enderror" required autofocus>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4">
                    <button type="submit" class="btn btn-primary px-4 fw-bold"><i class="bi bi-check-circle me-1"></i> تحديث</button>
                    <a href="{{ route('medications.index') }}" class="btn btn-secondary px-4 fw-bold"><i class="bi bi-x-circle me-1"></i> إلغاء</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
