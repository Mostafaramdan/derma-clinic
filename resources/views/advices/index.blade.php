@extends('layouts.admin')
@section('title','الإرشادات')
@section('content')
<div class="container py-4">
    <div class="text-center mb-2">
        <span class="d-inline-block mb-2" style="font-size:2.5rem;">
            <!-- SVG أيقونة لمبة -->
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none">
                <path d="M12 2a7 7 0 0 1 7 7c0 2.5-1.5 4.5-3.5 5.5V17a1.5 1.5 0 0 1-3 0v-2.5C6.5 13.5 5 11.5 5 9a7 7 0 0 1 7-7Z" fill="#ffd600" stroke="#2563eb" stroke-width="2.2"/>
                <rect x="9" y="17" width="6" height="3" rx="1.5" fill="#2563eb"/>
            </svg>
        </span>
        <h1 class="fw-bold text-primary">إدارة الإرشادات</h1>
    </div>
    <div class="row mb-4 justify-content-center">
        <div class="col-md-4">
            <a href="{{ route('advices.create') }}" class="btn btn-success w-100 fw-bold py-2"><i class="bi bi-plus-circle me-1"></i> إضافة إرشاد جديد</a>
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
                    <th>اسم الإرشاد</th>
                    <th style="width:180px">إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($advices as $advice)
                <tr>
                    <td class="fw-bold">{{ $advice->id }}</td>
                    <td>{{ $advice->name }}</td>
                    <td>
                        <a href="{{ route('advices.edit', $advice) }}" class="btn btn-sm btn-warning px-3 fw-bold"><i class="bi bi-pencil-square me-1"></i> تعديل</a>
                        <form action="{{ route('advices.destroy', $advice) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger px-3 fw-bold" onclick="return confirm('تأكيد الحذف؟')"><i class="bi bi-trash me-1"></i> حذف</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">لا توجد إرشادات مسجلة</td>
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
