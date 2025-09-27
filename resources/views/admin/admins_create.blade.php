@extends('layouts.admin')
@section('title','Add Admin')
@section('content')
<div class="container py-4">
  <h1 class="mb-4 fw-bold text-primary">Add New Admin</h1>
  <div class="bg-white shadow-sm rounded-3 p-4">
    <form method="POST" action="{{ route('admin.admins.store') }}">
      @csrf
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" id="name" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="roles" class="form-label">Roles</label>
        <select name="roles[]" id="roles" class="form-select" multiple required>
          @foreach(\Spatie\Permission\Models\Role::all() as $role)
            <option value="{{ $role->name }}">{{ $role->name }}</option>
          @endforeach
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Add Admin</button>
    </form>
  </div>
</div>
@endsection
