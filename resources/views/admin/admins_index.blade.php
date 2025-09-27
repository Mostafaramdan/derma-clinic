@extends('layouts.admin')
@section('title','Admins')
@section('content')
<div class="container py-4">
  <h1 class="mb-4 fw-bold text-primary">Admins List</h1>
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
