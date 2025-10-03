@extends('layouts.admin')
@section('title','إضافة معمل')
@section('content')
<div class="container py-5 d-flex flex-column align-items-center justify-content-center" style="min-height:80vh;">
    <div class="w-100" style="max-width: 600px;">
        <div class="text-center mb-4">
            <div class="mb-2" style="font-size:2.5rem;">
                <span class="text-primary"><i class="bi bi-flask"></i></span>
            </div>
            <h2 class="fw-bold text-primary">إضافة معمل جديد</h2>
        </div>
        <div class="bg-white shadow-sm rounded-4 p-4 border border-2">
            <form method="POST" action="{{ route('labs.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">اسم المعمل</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4">
                    <button type="submit" class="btn btn-primary px-4 fw-bold"><i class="bi bi-check-circle me-1"></i> حفظ</button>
                    <a href="{{ route('labs.index') }}" class="btn btn-secondary px-4 fw-bold"><i class="bi bi-x-circle me-1"></i> إلغاء</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
