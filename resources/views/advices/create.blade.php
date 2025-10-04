@extends('layouts.admin')
@section('title', __('messages.advices.create_title'))
@section('content')
<div class="container pt-4 d-flex flex-column align-items-center" style="min-height:70vh;">
    <div class="w-100" style="max-width: 700px;">
        <div class="text-center mb-4">
                        <div class="mb-2 d-flex justify-content-center" style="font-size:2.5rem;">
                                <span>💡</span>
            </div>
            <h2 class="fw-bold text-primary">{{ __('messages.advices.create_title') }}</h2>
        </div>
        <div class="bg-white shadow-sm rounded-4 p-4 border border-2">
            <form method="POST" action="{{ route('advices.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('messages.advices.name') }}</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4">
                    <button type="submit" class="btn btn-primary px-4 fw-bold"><i class="bi bi-check-circle me-1"></i> {{ __('messages.advices.save') }}</button>
                    <a href="{{ route('advices.index') }}" class="btn btn-secondary px-4 fw-bold"><i class="bi bi-x-circle me-1"></i> {{ __('messages.advices.cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
