
@extends('layouts.admin')
@section('title', __('messages.services.title'))
@section('content')
<div class="container py-4">
    <div class="text-center mb-2">
        <span class="d-inline-block mb-2" style="font-size:2.5rem;">
            🛎️
        </span>
    <h1 class="fw-bold text-primary">{{ __('messages.services.manage') }}</h1>
    </div>
    <form method="GET" action="{{ route('services.index') }}" class="mb-4">
        <div class="row g-2 justify-content-center">
            <div class="col-md-3">
                <input type="text" name="q" class="form-control" placeholder="{{ __('messages.services.search_placeholder') }}" value="{{ request('q') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">{{ __('messages.services.search') }}</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('services.create') }}" class="btn btn-success w-100 fw-bold py-2"><i class="bi bi-plus-circle me-1"></i> {{ __('messages.services.add_new') }}</a>
            </div>
        </div>
    </form>
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif
    <div class="bg-white shadow rounded-4 p-4 border border-2">
        <table class="table table-hover align-middle text-center" style="font-size:1.13rem;">
            <thead class="table-primary align-middle">
                <tr style="font-size:1.15rem;">
                    <th style="width:70px">#</th>
                    <th>{{ __('messages.services.name_ar') }}</th>
                    <th>{{ __('messages.services.name_en') }}</th>
                    <th>{{ __('messages.services.default_price') }}</th>
                    <th>{{ __('messages.services.active') }}</th>
                    <th style="width:180px">{{ __('messages.services.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                @php $name = is_string($service->name) ? json_decode($service->name, true) : $service->name; @endphp
                <tr>
                    <td class="fw-bold">{{ $service->id }}</td>
                    <td>{{ $name['ar'] ?? '' }}</td>
                    <td>{{ $name['en'] ?? '' }}</td>
                    <td>{{ $service->default_price }}</td>
                    <td>
                        <form action="{{ route('services.toggle', $service) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-sm {{ $service->is_active ? 'btn-success' : 'btn-secondary' }}">
                                {{ $service->is_active ? __('messages.services.active_yes') : __('messages.services.active_no') }}
                            </button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('services.edit', $service) }}" class="btn btn-sm btn-warning px-3 fw-bold"><i class="bi bi-pencil-square me-1"></i> {{ __('messages.services.edit') }}</a>
                        <form action="{{ route('services.destroy', $service) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger px-3 fw-bold" onclick="return confirm('{{ __('messages.services.confirm_delete') }}')"><i class="bi bi-trash me-1"></i> {{ __('messages.services.delete') }}</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">{{ __('messages.services.empty') }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
