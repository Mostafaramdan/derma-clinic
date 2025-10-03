@extends('layouts.admin')
@section('title','Admins')
@section('content')
<div class="container py-4">
  <div class="text-center mb-3">
    <span class="d-inline-block mb-2" style="font-size:2.5rem;">🔑</span>
    <h1 class="fw-bold text-primary">Admins List</h1>
  </div>
  <a href="{{ route('admin.admins.create') }}" class="btn btn-success mb-3"><i class="bi bi-plus-circle me-1"></i> Add Admin</a>
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  <div class="bg-white shadow-sm rounded-3 p-4">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Email</th>
          <th>Roles</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($admins as $admin)
          <tr>
            <td>{{ $admin->id }}</td>
            <td>{{ $admin->name }}</td>
            <td>{{ $admin->email }}</td>
            <td>{{ implode(', ', $admin->getRoleNames()->toArray()) }}</td>
            <td>
              <a href="{{ route('admin.admins.edit', $admin) }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square me-1"></i> Edit</a>
              <form action="{{ route('admin.admins.destroy', $admin) }}" method="POST" style="display:inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="bi bi-trash me-1"></i> Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
