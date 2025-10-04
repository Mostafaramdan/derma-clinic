@extends('layouts.admin')
@section('title', __('messages.advices.title'))
@section('content')
<div class="container py-4">
    <div class="text-center mb-2">
        <span class="d-inline-block mb-2" style="font-size:2.5rem;">
            💡
        </span>
    <h1 class="fw-bold text-primary">{{ __('messages.advices.manage') }}</h1>
    </div>
    <div class="row mb-4 justify-content-center">
        <div class="col-md-4">
            <a href="{{ route('advices.create') }}" class="btn btn-success w-100 fw-bold py-2"><i class="bi bi-plus-circle me-1"></i> {{ __('messages.advices.add_new') }}</a>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif
    <div class="bg-white shadow rounded-4 p-4 border border-2">
        <table class="table table-hover align-middle text-center" style="font-size:1.13rem;">
            <thead class="table-primary align-middle">
                <tr style="font-size:1.15rem;">
                    <th style="width:70px">#</th>
                    <th>{{ __('messages.advices.name') }}</th>
                    <th style="width:180px">{{ __('messages.advices.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($advices as $advice)
                <tr>
                    <td class="fw-bold">{{ $advice->id }}</td>
                    <td>{{ $advice->name }}</td>
                    <td>
                        <a href="{{ route('advices.edit', $advice) }}" class="btn btn-sm btn-warning px-3 fw-bold"><i class="bi bi-pencil-square me-1"></i> {{ __('messages.advices.edit') }}</a>
                        <form action="{{ route('advices.destroy', $advice) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger px-3 fw-bold" onclick="return confirm('{{ __('messages.advices.confirm_delete') }}')"><i class="bi bi-trash me-1"></i> {{ __('messages.advices.delete') }}</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">{{ __('messages.advices.empty') }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-4">
            <div class="pagination-custom">
                {{ $advices->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
