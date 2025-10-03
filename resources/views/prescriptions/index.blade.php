@extends('layouts.admin')
@section('title','الروشتات')
@section('content')
<div class="container py-4">
    <h1 class="mb-4 fw-bold text-primary">إدارة الروشتات</h1>
    <div class="row mb-4">
        <div class="col-md-3">
            <a href="{{ route('prescriptions.create') }}" class="btn btn-success w-100">إضافة روشتة جديدة</a>
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
                        <a href="{{ route('prescriptions.edit', $prescription) }}" class="btn btn-sm btn-warning">تعديل</a>
                        <form action="{{ route('prescriptions.destroy', $prescription) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('تأكيد الحذف؟')">حذف</button>
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
