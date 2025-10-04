@extends('layouts.admin')
@section('title', __('messages.roles.title'))
@section('content')
<div class="container py-4">
  <h1 class="mb-4 fw-bold text-primary">{{ __('messages.roles.manage') }}</h1>
  <div class="mb-3 text-end">
  <a href="{{ route('admin.roles.create') }}" class="btn btn-success"><i class="bi bi-plus-circle me-1"></i> {{ __('messages.roles.add_new') }}</a>
  </div>
  <div class="bg-white shadow-sm rounded-3 p-4">
    <table class="table table-bordered align-middle">
      <thead>
        <tr>
          <th>{{ __('messages.roles.name') }}</th>
          <th>{{ __('messages.roles.permissions') }}</th>
          <th>{{ __('messages.roles.actions') }}</th>
        </tr>
      </thead>
      <tbody>
        @foreach($roles as $role)
        <tr>
          <td>{{ $role->name }}</td>
          <td>
            @foreach($role->permissions as $perm)
              <span class="badge bg-info text-dark">{{ $perm->name }}</span>
            @endforeach
          </td>
          <td>
            <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square me-1"></i> {{ __('messages.roles.edit') }}</a>
            <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ __('messages.roles.confirm_delete') }}')"><i class="bi bi-trash me-1"></i> {{ __('messages.roles.delete') }}</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
