@extends('layouts.admin')
@section('title','تعديل معمل')
@section('content')
<div class="container pt-4 d-flex flex-column align-items-center" style="min-height:70vh;">
    <div class="w-100" style="max-width: 900px;">
        <div class="text-center mb-4">
            <div class="mb-2" style="font-size:2.5rem;">
                <span class="text-primary"><i class="bi bi-flask"></i></span>
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
