@extends('layouts.admin')
@section('title','إضافة إرشاد')
@section('content')
<div class="container pt-4 d-flex flex-column align-items-center" style="min-height:70vh;">
    <div class="w-100" style="max-width: 700px;">
        <div class="text-center mb-4">
            <div class="mb-2 d-flex justify-content-center" style="font-size:2.5rem;">
                <span>
                  <!-- أيقونة لمبة SVG -->
                  <svg width="56" height="56" viewBox="0 0 24 24" fill="none">
                    <ellipse cx="12" cy="10" rx="7" ry="7" fill="#ffe066"/>
                    <ellipse cx="12" cy="10" rx="7" ry="7" fill="#fff" fill-opacity=".10"/>
                    <rect x="9" y="17" width="6" height="3" rx="1.5" fill="#ffd700"/>
                    <rect x="9" y="20" width="6" height="2" rx="1" fill="#bdbdbd"/>
                    <ellipse cx="12" cy="10" rx="7" ry="7" stroke="#ffb300" stroke-width="2.2"/>
                  </svg>
                </span>
            </div>
            <h2 class="fw-bold text-primary">إضافة إرشاد جديد</h2>
        </div>
        <div class="bg-white shadow-sm rounded-4 p-4 border border-2">
            <form method="POST" action="{{ route('advices.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">اسم الإرشاد</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4">
                    <button type="submit" class="btn btn-primary px-4 fw-bold"><i class="bi bi-check-circle me-1"></i> حفظ</button>
                    <a href="{{ route('advices.index') }}" class="btn btn-secondary px-4 fw-bold"><i class="bi bi-x-circle me-1"></i> إلغاء</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
