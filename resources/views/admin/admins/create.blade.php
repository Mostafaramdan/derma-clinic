@extends('layouts.dashboard')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 fw-bold text-primary">{{ __('Add Admin') }}</h1>
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
        <button type="submit" class="btn btn-success"><i class="bi bi-plus"></i> {{ __('Add') }}</button>
        <a href="{{ route('admins.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
    </form>
</div>
@endsection
