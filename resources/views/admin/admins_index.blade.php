@extends('layouts.admin')
@section('title','Admins')
@section('content')
<div class="container py-4">
  <div class="text-center mb-3">
    <span class="d-inline-block mb-2" style="font-size:2.5rem;">
      <svg width="48" height="48" viewBox="0 0 24 24" fill="none">
        <path d="M12 3l7 4v5c0 5.25-3.5 9.25-7 11-3.5-1.75-7-5.75-7-11V7l7-4z" fill="#ffd600" stroke="#2563eb" stroke-width="2.2"/>
        <path d="M12 3v18" stroke="#2563eb" stroke-width="2.2"/>
      </svg>
    </span>
    <h1 class="fw-bold text-primary">Admins List</h1>
  </div>
  <a href="{{ route('admin.admins.create') }}" class="btn btn-success mb-3">Add Admin</a>
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
              <a href="{{ route('admin.admins.edit', $admin) }}" class="btn btn-sm btn-primary">Edit</a>
              <form action="{{ route('admin.admins.destroy', $admin) }}" method="POST" style="display:inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
