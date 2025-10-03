@extends('layouts.admin')
@section('title','إضافة دواء جديد')
@section('content')
<div class="container py-4">
    <h1 class="mb-4 fw-bold text-primary">إضافة دواء جديد</h1>
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
        <form method="POST" action="{{ route('medications.store') }}">
            @csrf
            <div class="row mb-3">
                <div class="col-md-12">
                    <label class="form-label mb-2" for="medication-name">اسم الدواء</label>
                    <input id="medication-name" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success px-4">حفظ</button>
                <a href="{{ route('medications.index') }}" class="btn btn-secondary px-4">إلغاء</a>
            </div>
        </form>
    </div>
</div>
@endsection
