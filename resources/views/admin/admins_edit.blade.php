@extends('layouts.admin')
@section('title','Edit Admin')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container--default .select2-selection--multiple {
        min-height: 48px;
        border-radius: 0.5rem;
        border: 1px solid #ced4da;
        padding: 0.25rem 0.5rem;
    }
</style>
<div class="container py-4 d-flex flex-column align-items-center" style="min-height:70vh;">
  <div class="w-100" style="max-width: 600px;">
    <div class="text-center mb-4">
      <span class="d-inline-block mb-2" style="font-size:2.5rem;">
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none">
          <path d="M12 3l7 4v5c0 5.25-3.5 9.25-7 11-3.5-1.75-7-5.75-7-11V7l7-4z" fill="#ffd600" stroke="#2563eb" stroke-width="2.2"/>
          <path d="M12 3v18" stroke="#2563eb" stroke-width="2.2"/>
        </svg>
      </span>
      <h2 class="fw-bold text-primary">Edit Admin</h2>
    </div>
    <div class="bg-white shadow rounded-4 p-4 border border-2">
      <form method="POST" action="{{ route('admin.admins.update', $admin) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label for="name" class="form-label fw-bold">Name</label>
          <input type="text" name="name" id="name" class="form-control" value="{{ $admin->name }}" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label fw-bold">Email</label>
          <input type="email" name="email" id="email" class="form-control" value="{{ $admin->email }}" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label fw-bold">Password (leave blank to keep current)</label>
          <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="mb-3">
          <label for="roles" class="form-label fw-bold">Roles</label>
          <select name="roles[]" id="roles" class="form-select" multiple required>
            @foreach($roles as $role)
              <option value="{{ $role->name }}" {{ $admin->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="d-flex gap-2 justify-content-center mt-4">
          <button type="submit" class="btn btn-primary px-4 fw-bold"><i class="bi bi-check-circle me-1"></i> Update Admin</button>
          <a href="{{ route('admin.admins.index') }}" class="btn btn-secondary px-4 fw-bold"><i class="bi bi-x-circle me-1"></i> Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(function() {
        $('#roles').select2({
            placeholder: 'Select roles...',
            closeOnSelect: false,
            width: '100%',
            dir: 'ltr',
            language: {
                noResults: function() { return 'No roles found'; }
            }
        });
    });
</script>
@endsection
