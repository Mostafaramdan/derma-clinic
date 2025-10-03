@extends('layouts.admin')
@section('title','تعديل أشعة/تحليل')
@section('content')
<div class="container py-4">
    <h1 class="mb-4 fw-bold text-primary">تعديل الأشعة/التحليل</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="bg-white shadow-sm rounded-3 p-4">
                <form method="POST" action="{{ route('radiologies.update', $radiology) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">اسم الأشعة/التحليل</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $radiology->name) }}" required autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">ملاحظات</label>
                        <textarea name="notes" id="notes" class="form-control @error('notes') is-invalid @enderror">{{ old('notes', $radiology->notes) }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">تحديث</button>
                    <a href="{{ route('radiologies.index') }}" class="btn btn-secondary">إلغاء</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
