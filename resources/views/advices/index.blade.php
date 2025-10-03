@extends('layouts.admin')
@section('title','الإرشادات')
@section('content')
<div class="container py-4">
    <h1 class="mb-4 fw-bold text-primary">إدارة الإرشادات</h1>
    <div class="row mb-4">
        <div class="col-md-3">
            <a href="{{ route('advices.create') }}" class="btn btn-success w-100">إضافة إرشاد جديد</a>
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
                    <th>اسم الإرشاد</th>
                    <th style="width:160px">إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($advices as $advice)
                <tr>
                    <td>{{ $advice->id }}</td>
                    <td>{{ $advice->name }}</td>
                    <td>
                        <a href="{{ route('advices.edit', $advice) }}" class="btn btn-sm btn-warning">تعديل</a>
                        <form action="{{ route('advices.destroy', $advice) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('تأكيد الحذف؟')">حذف</button>
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
