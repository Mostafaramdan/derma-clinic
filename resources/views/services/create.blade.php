
@extends('layouts.admin')
@section('title', __('messages.services.create_title'))
@section('content')
<div class="container pt-4 d-flex flex-column align-items-center" style="min-height:70vh;">
    <div class="w-100" style="max-width: 900px;">
        <div class="text-center mb-4">
                        <div class="mb-2 d-flex justify-content-center" style="font-size:2.5rem;">
                                <span>🛎️</span>
            </div>
            <h2 class="fw-bold text-primary">{{ __('messages.services.create_title') }}</h2>
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
            <form action="{{ route('services.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name_ar" class="form-label">{{ __('messages.services.name_ar') }}</label>
                        <input type="text" name="name_ar" id="name_ar" class="form-control" required value="{{ old('name_ar') }}">
                    </div>
                    <div class="col-md-6">
                        <label for="name_en" class="form-label">{{ __('messages.services.name_en') }}</label>
                        <input type="text" name="name_en" id="name_en" class="form-control" required value="{{ old('name_en') }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="default_price" class="form-label">{{ __('messages.services.default_price') }}</label>
                        <input type="number" name="default_price" id="default_price" class="form-control" required min="0" value="{{ old('default_price') }}">
                    </div>
                    <div class="col-md-6 d-flex align-items-center">
                        <div class="form-check ms-3">
                            <input type="checkbox" name="is_active" id="is_active" class="form-check-input" {{ old('is_active') ? 'checked' : '' }}>
                            <label for="is_active" class="form-check-label">{{ __('messages.services.active') }}</label>
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4">
                    <button type="submit" class="btn btn-primary px-4 fw-bold"><i class="bi bi-check-circle me-1"></i> {{ __('messages.services.save') }}</button>
                    <a href="{{ route('services.index') }}" class="btn btn-secondary px-4 fw-bold"><i class="bi bi-x-circle me-1"></i> {{ __('messages.services.cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
