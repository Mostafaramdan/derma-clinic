@extends('layouts.admin')
@section('title','تعديل معمل')
@section('content')
<div class="container pt-4 d-flex flex-column align-items-center" style="min-height:70vh;">
    <div class="w-100" style="max-width: 900px;">
        <div class="text-center mb-4">
            <div class="mb-2 d-flex justify-content-center" style="font-size:2.5rem;">
                <span class="text-primary">
                    <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <!-- السائل الأصفر -->
                        <path d="M7.5 15.5 Q12 19 16.5 15.5 Q17.5 14.5 12 14 Q6.5 14.5 7.5 15.5 Z" fill="#FFD600"/>
                        <!-- جسم القارورة -->
                        <path d="M7 3v6.379a2 2 0 0 1-.553 1.379l-4.16 4.16A4 4 0 0 0 6.343 21h11.314a4 4 0 0 0 4.056-6.082l-4.16-4.16A2 2 0 0 1 17 9.379V3"/>
                        <line x1="3" y1="3" x2="21" y2="3"/>
                    </svg>
                </span>
            </div>
            <h2 class="fw-bold text-primary">تعديل المعمل</h2>
        </div>
        <div class="bg-white shadow-sm rounded-4 p-4 border border-2">
            <form method="POST" action="{{ route('labs.update', $lab) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">اسم المعمل</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $lab->name) }}" required autofocus>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4">
                    <button type="submit" class="btn btn-primary px-4 fw-bold"><i class="bi bi-check-circle me-1"></i> تحديث</button>
                    <a href="{{ route('labs.index') }}" class="btn btn-secondary px-4 fw-bold"><i class="bi bi-x-circle me-1"></i> إلغاء</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
