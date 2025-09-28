@extends('layouts.admin')
@section('title','Edit Role')
@section('content')
<div class="container py-4">
  <h1 class="mb-4 fw-bold text-primary">Edit Role</h1>
  <div class="bg-white shadow-sm rounded-3 p-4">
    <form method="POST" action="{{ route('admin.roles.update', $role) }}">
      @csrf
      @method('PUT')
      <div class="mb-3">
        <label for="name" class="form-label">Role Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $role->name }}" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Permissions</label>
        <div class="row">
          @foreach($permissions as $perm)
            <div class="col-md-4 mb-2">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $perm->name }}" id="perm_{{ $perm->id }}" {{ in_array($perm->name, $rolePermissions) ? 'checked' : '' }}>
                <label class="form-check-label" for="perm_{{ $perm->id }}">{{ $perm->name }}</label>
              </div>
            </div>
          @endforeach
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Update Role</button>
    </form>
  </div>
</div>
@endsection
