@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h4>الأشعة والتحاليل</h4>
        <a href="{{ route('radiologies.create') }}" class="btn btn-primary">إضافة جديد</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>الاسم</th>
                <th>ملاحظات</th>
                <th>العمليات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($radiologies as $radiology)
            <tr>
                <td>{{ $radiology->id }}</td>
                <td>{{ $radiology->name }}</td>
                <td>{{ $radiology->notes }}</td>
                <td>
                    <a href="{{ route('radiologies.edit', $radiology) }}" class="btn btn-sm btn-info">تعديل</a>
                    <form action="{{ route('radiologies.destroy', $radiology) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('تأكيد الحذف؟')">حذف</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $radiologies->links() }}
</div>
@endsection
