@extends('layouts.admin')
@section('title','تعديل معمل')
@section('content')
<div class="container py-4">
    <h1 class="mb-4 fw-bold text-primary">تعديل المعمل</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="bg-white shadow-sm rounded-3 p-4">
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
                    <button type="submit" class="btn btn-primary">تحديث</button>
                    <a href="{{ route('labs.index') }}" class="btn btn-secondary">إلغاء</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
