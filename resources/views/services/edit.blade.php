
@extends('layouts.admin')
@section('title','تعديل خدمة')
@section('content')
<div class="container pt-4 d-flex flex-column align-items-center" style="min-height:70vh;">
    <div class="w-100" style="max-width: 900px;">
        <div class="text-center mb-4">
            <div class="mb-2 d-flex justify-content-center" style="font-size:2.5rem;">
                <span>
                  <!-- أيقونة ترس SVG -->
                  <svg width="56" height="56" viewBox="0 0 24 24" fill="none">
                    <circle cx="12" cy="12" r="5" fill="#ffd600"/>
                    <circle cx="12" cy="12" r="5" fill="#fff" fill-opacity=".10"/>
                    <g stroke="#2563eb" stroke-width="2.2">
                      <path d="M12 2v2.5"/>
                      <path d="M12 19.5V22"/>
                      <path d="M2 12h2.5"/>
                      <path d="M19.5 12H22"/>
                      <path d="M4.22 4.22l1.77 1.77"/>
                      <path d="M18.01 18.01l1.77 1.77"/>
                      <path d="M4.22 19.78l1.77-1.77"/>
                      <path d="M18.01 5.99l1.77-1.77"/>
                    </g>
                    <circle cx="12" cy="12" r="8" stroke="#2563eb" stroke-width="2.2" fill="none"/>
                  </svg>
                </span>
            </div>
            <h2 class="fw-bold text-primary">تعديل الخدمة</h2>
        </div>
        <div class="bg-white shadow-sm rounded-4 p-4 border border-2">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('services.update', $service) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name_ar" class="form-label">الاسم بالعربي</label>
                        <input type="text" name="name_ar" id="name_ar" class="form-control" required value="{{ old('name_ar', $name['ar'] ?? '') }}">
                    </div>
                    <div class="col-md-6">
                        <label for="name_en" class="form-label">الاسم بالإنجليزي</label>
                        <input type="text" name="name_en" id="name_en" class="form-control" required value="{{ old('name_en', $name['en'] ?? '') }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="default_price" class="form-label">السعر الافتراضي</label>
                        <input type="number" name="default_price" id="default_price" class="form-control" required min="0" value="{{ old('default_price', $service->default_price) }}">
                    </div>
                    <div class="col-md-6 d-flex align-items-center">
                        <div class="form-check ms-3">
                            <input type="checkbox" name="is_active" id="is_active" class="form-check-input" {{ old('is_active', $service->is_active) ? 'checked' : '' }}>
                            <label for="is_active" class="form-check-label">مفعّل</label>
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4">
                    <button type="submit" class="btn btn-primary px-4 fw-bold"><i class="bi bi-check-circle me-1"></i> تحديث</button>
                    <a href="{{ route('services.index') }}" class="btn btn-secondary px-4 fw-bold"><i class="bi bi-x-circle me-1"></i> إلغاء</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
