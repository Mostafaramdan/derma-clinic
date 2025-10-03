@extends('layouts.admin')
@section('title','الأشعة والتحاليل')
@section('content')
<div class="container py-4">
    <div class="text-center mb-2">
        <span class="d-inline-block mb-2" style="font-size:2.5rem;">
            <!-- SVG أيقونة activity -->
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none">
                <path d="M3 12h3.5l2.5 7 4-14 2.5 7H21" stroke="#2563eb" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                <circle cx="12" cy="12" r="11" stroke="#ffd600" stroke-width="2.2" fill="#fffbe6"/>
            </svg>
        </span>
        <h1 class="fw-bold text-primary">إدارة الأشعة والتحاليل</h1>
    </div>
    <div class="row mb-4 justify-content-center">
        <div class="col-md-4">
            <a href="{{ route('radiologies.create') }}" class="btn btn-success w-100 fw-bold py-2"><i class="bi bi-plus-circle me-1"></i> إضافة أشعة/تحليل جديد</a>
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
                    <th>اسم الأشعة/التحليل</th>
                    <th>ملاحظات</th>
                    <th style="width:180px">إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($radiologies as $rad)
                <tr>
                    <td class="fw-bold">{{ $rad->id }}</td>
                    <td>{{ $rad->name }}</td>
                    <td>{{ $rad->notes }}</td>
                    <td>
                        <a href="{{ route('radiologies.edit', $rad) }}" class="btn btn-sm btn-warning px-3 fw-bold"><i class="bi bi-pencil-square me-1"></i> تعديل</a>
                        <form action="{{ route('radiologies.destroy', $rad) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger px-3 fw-bold" onclick="return confirm('تأكيد الحذف؟')"><i class="bi bi-trash me-1"></i> حذف</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">لا توجد أشعة أو تحاليل مسجلة</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-4">
            <div class="pagination-custom">
                {{ $radiologies->links() }}
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
