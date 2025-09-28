
@extends('layouts.admin')
@section('title','تعديل خدمة')
@section('content')
<div class="container py-4">
    <h1 class="mb-4 fw-bold text-primary">تعديل خدمة</h1>
    <div class="bg-white shadow-sm rounded-3 p-4">
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
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success px-4">تحديث</button>
                <a href="{{ route('services.index') }}" class="btn btn-secondary px-4">إلغاء</a>
            </div>
        </form>
    </div>
</div>
@endsection
