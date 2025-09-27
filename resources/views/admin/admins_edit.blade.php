@extends('layouts.admin')
@section('title','Edit Admin')
@section('content')
<div class="container py-4">
  <h1 class="mb-4 fw-bold text-primary">Edit Admin</h1>
  <div class="bg-white shadow-sm rounded-3 p-4">
    <form method="POST" action="{{ route('admin.admins.update', $user) }}">
      @csrf
      @method('PUT')
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password (leave blank to keep current)</label>
        <input type="password" name="password" id="password" class="form-control">
      </div>
      <div class="mb-3">
        <label for="roles" class="form-label">Roles</label>
        <select name="roles[]" id="roles" class="form-select" multiple required>
          @foreach($roles as $role)
            <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
          @endforeach
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Update Admin</button>
    </form>
  </div>
</div>
@endsection
