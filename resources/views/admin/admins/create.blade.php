@extends('layouts.dashboard')

@section('content')
<div class="container py-4 d-flex flex-column align-items-center" style="min-height:70vh;">
    <div class="w-100" style="max-width: 600px;">
        <div class="text-center mb-4">
            <span class="d-inline-block mb-2" style="font-size:2.5rem;">
                <!-- SVG أيقونة shield -->
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none">
                    <path d="M12 3l7 4v5c0 5.25-3.5 9.25-7 11-3.5-1.75-7-5.75-7-11V7l7-4z" fill="#ffd600" stroke="#2563eb" stroke-width="2.2"/>
                    <path d="M12 3v18" stroke="#2563eb" stroke-width="2.2"/>
                </svg>
            </span>
            <h2 class="fw-bold text-primary">{{ __('Add Admin') }}</h2>
        </div>
        <div class="bg-white shadow rounded-4 p-4 border border-2">
            <form method="POST" action="{{ route('admins.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">{{ __('Name') }}</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('Email') }}</label>
                    <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('Password') }}</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('Confirm Password') }}</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('Role') }}</label>
                    <select name="role" class="form-select" required>
                        <option value="admin">Admin</option>
                        <option value="super_admin">Super Admin</option>
                    </select>
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4">
                    <button type="submit" class="btn btn-primary px-4 fw-bold"><i class="bi bi-plus-circle me-1"></i> {{ __('Add') }}</button>
                    <a href="{{ route('admins.index') }}" class="btn btn-secondary px-4 fw-bold"><i class="bi bi-x-circle me-1"></i> {{ __('Cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
