@extends('layouts.admin')
@section('title','إضافة إرشاد')
@section('content')
<div class="container py-4">
    <h1 class="mb-4 fw-bold text-primary">إضافة إرشاد جديد</h1>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="bg-white shadow-sm rounded-3 p-4">
                <form method="POST" action="{{ route('advices.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">اسم الإرشاد</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">حفظ</button>
                    <a href="{{ route('advices.index') }}" class="btn btn-secondary">إلغاء</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
