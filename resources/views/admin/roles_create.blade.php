@extends('layouts.admin')
@section('title', __('messages.roles.create_title'))
@section('content')
<div class="container py-4">
  <h1 class="mb-4 fw-bold text-primary">{{ __('messages.roles.create_title') }}</h1>
  <div class="bg-white shadow-sm rounded-3 p-4">
    <form method="POST" action="{{ route('admin.roles.store') }}">
      @csrf
      <div class="mb-3">
  <label for="name" class="form-label">{{ __('messages.roles.name') }}</label>
        <input type="text" name="name" id="name" class="form-control" required>
      </div>
      <div class="mb-3">
  <label class="form-label">{{ __('messages.roles.permissions') }}</label>
        <div class="row">
          @foreach($permissions as $perm)
            <div class="col-md-4 mb-2">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $perm->name }}" id="perm_{{ $perm->id }}">
                <label class="form-check-label" for="perm_{{ $perm->id }}">{{ __('messages.permissions.' . $perm->name) }}</label>
              </div>
            </div>
          @endforeach
        </div>
      </div>
  <button type="submit" class="btn btn-success">{{ __('messages.roles.save') }}</button>
    </form>
  </div>
</div>
@endsection
