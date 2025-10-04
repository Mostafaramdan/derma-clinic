@extends('layouts.admin')
@section('title', __('messages.labs.title'))
@section('content')
<div class="container py-4">
    <h1 class="mb-4 fw-bold text-primary text-center">{{ __('messages.labs.manage') }}</h1>
    <div class="row mb-4 justify-content-center">
        <div class="col-md-4">
            <a href="{{ route('labs.create') }}" class="btn btn-success w-100 fw-bold py-2"><i class="bi bi-plus-circle me-1"></i> {{ __('messages.labs.add_new') }}</a>
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
                    <th>{{ __('messages.labs.name') }}</th>
                    <th style="width:180px">{{ __('messages.labs.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($labs as $lab)
                <tr>
                    <td class="fw-bold">{{ $lab->id }}</td>
                    <td>{{ $lab->name }}</td>
                    <td>
                        <a href="{{ route('labs.edit', $lab) }}" class="btn btn-sm btn-warning px-3 fw-bold"><i class="bi bi-pencil-square me-1"></i> {{ __('messages.labs.edit') }}</a>
                        <form action="{{ route('labs.destroy', $lab) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger px-3 fw-bold" onclick="return confirm('{{ __('messages.labs.confirm_delete') }}')"><i class="bi bi-trash me-1"></i> {{ __('messages.labs.delete') }}</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">{{ __('messages.labs.empty') }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-4">
            <div class="pagination-custom">
                {{ $labs->links() }}
            </div>
        </div>
        <style>
            body .pagination-custom .pagination span[aria-current="page"] > span,
            html body .pagination-custom .pagination span[aria-current="page"] > span {
                background: #2563eb !important;
                color: #fff !important;
                border: 1px solid #2563eb !important;
                border-radius: 8px !important;
                font-weight: bold !important;
                font-size: 1.1rem !important;
                padding: 8px 16px !important;
                box-shadow: 0 2px 8px rgba(37,99,235,0.10) !important;
                cursor: default !important;
                z-index: 2;
            }
            body .pagination-custom .pagination span[aria-current="page"] > span::after {
                content: '';
                display: none;
            }
            body .pagination-custom .pagination span[aria-current="page"] > span,
            body .pagination-custom .pagination span[aria-current="page"] > span * {
                background: #2563eb !important;
                color: #fff !important;
                border-color: #2563eb !important;
            }
            body .pagination-custom .pagination span[aria-current="page"] {
                background: none !important;
                border: none !important;
                box-shadow: none !important;
            }
            body .pagination-custom .page-item.active .page-link,
            body .pagination-custom .page-item.active span,
            body .pagination-custom .active > .page-link,
            body .pagination-custom .active > span,
            body .pagination-custom .pagination .active span,
            body .pagination-custom .pagination .active .page-link {
                background: #2563eb !important;
                color: #fff !important;
                border-color: #2563eb !important;
                font-weight: bold !important;
                box-shadow: 0 2px 8px rgba(37,99,235,0.10) !important;
            }
            .pagination-custom nav {
                display: flex;
                justify-content: center;
            }
            .pagination-custom .pagination {
                display: flex;
                gap: 4px;
            }
            .pagination-custom .page-link, .pagination-custom .page-item span, .pagination-custom .page-item a {
                font-size: 1.1rem;
                padding: 8px 16px;
                border-radius: 8px !important;
                color: #2563eb;
                border: 1px solid #e2e8f0;
                background: #f8fafc;
                transition: all 0.2s;
            }
            .pagination-custom .page-item.active .page-link,
            .pagination-custom .page-item.active span,
            .pagination-custom .active > .page-link,
            .pagination-custom .active > span,
            .pagination-custom .pagination .active span,
            .pagination-custom .pagination .active .page-link,
            .pagination-custom .pagination span[aria-current="page"] > span,
            .pagination-custom .pagination span[aria-current="page"] {
                background: #2563eb !important;
                color: #fff !important;
                border-color: #2563eb !important;
                font-weight: bold !important;
                box-shadow: 0 2px 8px rgba(37,99,235,0.10);
            }
            .pagination-custom .pagination span[aria-current="page"] > span {
                color: #fff !important;
                background: #2563eb !important;
                border-color: #2563eb !important;
                font-weight: bold !important;
            }
            .pagination-custom .page-link:hover, .pagination-custom .page-item a:hover {
                background: #e0e7ff;
                color: #1e293b;
            }
            .pagination-custom .page-item.disabled .page-link {
                color: #b0b6c1;
                background: #f1f5f9;
                border-color: #e2e8f0;
            }
        </style>
    </div>
</div>
@endsection
