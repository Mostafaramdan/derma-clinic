@extends('layouts.admin')
@section('title', __('messages.medications.create_title'))
@section('content')
<div class="container pt-4 d-flex flex-column align-items-center" style="min-height:70vh;">
    <div class="w-100" style="max-width: 900px;">
        <div class="text-center mb-4">
                        <div class="mb-2 d-flex justify-content-center" style="font-size:2.5rem;">
                                <span>💊</span>
            </div>
            <h2 class="fw-bold text-primary">{{ __('messages.medications.create_title') }}</h2>
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
            <form method="POST" action="{{ route('medications.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label mb-2" for="medication-name">{{ __('messages.medications.name') }}</label>
                    <input id="medication-name" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required autofocus>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4">
                    <button type="submit" class="btn btn-primary px-4 fw-bold"><i class="bi bi-check-circle me-1"></i> {{ __('messages.medications.save') }}</button>
                    <a href="{{ route('medications.index') }}" class="btn btn-secondary px-4 fw-bold"><i class="bi bi-x-circle me-1"></i> {{ __('messages.medications.cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
