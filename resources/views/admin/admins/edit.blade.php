@extends('layouts.dashboard')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 fw-bold text-primary">{{ __('Edit Admin') }}</h1>
    <form method="POST" action="{{ route('admins.update', $user) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">{{ __('Name') }}</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name', $user->name) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('Email') }}</label>
            <input type="email" name="email" class="form-control" required value="{{ old('email', $user->email) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('Password') }} <small>(leave blank to keep current)</small></label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('Confirm Password') }}</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('Role') }}</label>
            <select name="role" class="form-select" required>
                <option value="admin" @if($user->hasRole('admin')) selected @endif>Admin</option>
                <option value="super_admin" @if($user->hasRole('super_admin')) selected @endif>Super Admin</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> {{ __('Save') }}</button>
        <a href="{{ route('admins.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
    </form>
</div>
@endsection
