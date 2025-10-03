@extends('layouts.admin')
@section('title','الروشتات')
@section('content')
<div class="container py-4">
    <!-- العنوان يظهر فقط مع الأيقونة أعلاه -->
        <div class="text-center mb-2">
            <span class="d-inline-block mb-2" style="font-size:2.5rem; color:#2563eb;">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none">
                  <rect x="4" y="3" width="16" height="18" rx="3" fill="#ffd600" stroke="#2563eb" stroke-width="2.2"/>
                  <rect x="7" y="6" width="10" height="2" rx="1" fill="#2563eb"/>
                  <rect x="7" y="10" width="7" height="2" rx="1" fill="#2563eb"/>
                  <rect x="7" y="14" width="5" height="2" rx="1" fill="#2563eb"/>
                </svg>
            </span>
            <h1 class="fw-bold text-primary">إدارة الروشتات</h1>
        </div>
    <div class="row mb-4">
        <div class="col-md-3">
            <a href="{{ route('prescriptions.create') }}" class="btn btn-success w-100"><i class="bi bi-plus-circle me-1"></i> إضافة روشتة جديدة</a>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="bg-white shadow-sm rounded-3 p-4">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th style="width:60px">#</th>
                    <th>اسم الروشتة</th>
                    <th>عدد الأدوية</th>
                    <th>عدد الإرشادات</th>
                    <th style="width:160px">إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($prescriptions as $prescription)
                <tr>
                    <td>{{ $prescription->id }}</td>
                    <td>{{ $prescription->name }}</td>
                    <td>{{ $prescription->medications->count() }}</td>
                    <td>{{ $prescription->advices->count() }}</td>
                    <td>
                        <a href="{{ route('prescriptions.edit', $prescription) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square me-1"></i> تعديل</a>
                        <form action="{{ route('prescriptions.destroy', $prescription) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('تأكيد الحذف؟')"><i class="bi bi-trash me-1"></i> حذف</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">لا توجد روشتات مسجلة</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-4">
            <div class="pagination-custom">
                {{ $prescriptions->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
