@extends('layouts.dashboard')
@section('title', __('messages.chronic.title'))
@section('content')
<div class="container py-4">
  <div class="text-center mb-2">
    <span class="d-inline-block mb-2" style="font-size:2.5rem;">❤️</span>
    <h1 class="fw-bold text-primary">{{ __('messages.chronic.title') }}</h1>
  </div>
  <div class="row mb-4 justify-content-center">
    <div class="col-md-4">
      <a href="{{ route('chronic-diseases.create') }}" class="btn btn-success w-100 fw-bold py-2"><i class="bi bi-plus-circle me-1"></i> {{ __('messages.chronic.add_new') }}</a>
    </div>
  </div>
  <div class="bg-white shadow rounded-4 p-4 border border-2">
    <table class="table table-hover align-middle text-center" style="font-size:1.13rem;">
      <thead class="table-primary align-middle">
        <tr style="font-size:1.15rem;">
          <th style="width:70px">#</th>
          <th>{{ __('messages.chronic.name') }}</th>
          <th>{{ __('messages.chronic.active') }}</th>
          <th style="width:180px">{{ __('messages.chronic.actions') }}</th>
        </tr>
      </thead>
      <tbody>
        @forelse($diseases as $disease)
        <tr>
          <td class="fw-bold">{{ $disease->id }}</td>
          <td>{{ is_array($disease->name) ? ($disease->name['ar'] ?? '') : (json_decode($disease->name, true)['ar'] ?? $disease->name) }}</td>
          <td>
            <span class="badge {{ $disease->is_active ? 'bg-success' : 'bg-secondary' }} px-3 py-2" style="font-size:1rem;">{{ $disease->is_active ? __('messages.chronic.yes') : __('messages.chronic.no') }}</span>
          </td>
          <td>
            <a href="{{ route('chronic-diseases.edit', $disease) }}" class="btn btn-sm btn-warning px-3 fw-bold"><i class="bi bi-pencil-square me-1"></i> {{ __('messages.chronic.edit') }}</a>
            <form method="POST" action="{{ route('chronic-diseases.destroy', $disease) }}" style="display:inline-block" onsubmit="return confirm('{{ __('messages.chronic.confirm_delete') }}');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger px-3 fw-bold"><i class="bi bi-trash me-1"></i> {{ __('messages.chronic.delete') }}</button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="4" class="text-center">{{ __('messages.chronic.empty') }}</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
