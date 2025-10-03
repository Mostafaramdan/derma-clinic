@extends('layouts.admin')
@section('title','المعامل')
@section('content')
<div class="container py-4">
    <h1 class="mb-4 fw-bold text-primary">قائمة المعامل</h1>
    <a href="{{ route('labs.create') }}" class="btn btn-success mb-3">إضافة معمل جديد</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="table-responsive bg-white rounded-3 shadow-sm">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>اسم المعمل</th>
                    <th>التحكم</th>
                </tr>
            </thead>
            <tbody>
                @forelse($labs as $lab)
                <tr>
                    <td>{{ $lab->id }}</td>
                    <td>{{ $lab->name }}</td>
                    <td>
                        <a href="{{ route('labs.edit', $lab) }}" class="btn btn-sm btn-warning">تعديل</a>
                        <form action="{{ route('labs.destroy', $lab) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="text-center">لا توجد معامل مسجلة.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">{{ $labs->links() }}</div>
</div>
@endsection
