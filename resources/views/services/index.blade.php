
@extends('layouts.admin')
@section('title','الخدمات')
@section('content')
<div class="container py-4">
    <h1 class="mb-4 fw-bold text-primary">إدارة الخدمات</h1>
    <form method="GET" action="{{ route('services.index') }}" class="mb-4">
        <div class="row g-2">
            <div class="col-md-3">
                <input type="text" name="q" class="form-control" placeholder="بحث بالاسم أو السعر" value="{{ request('q') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">بحث</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('services.create') }}" class="btn btn-success w-100">إضافة خدمة جديدة</a>
            </div>
        </div>
    </form>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="bg-white shadow-sm rounded-3 p-4">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>الاسم (عربي)</th>
                    <th>الاسم (إنجليزي)</th>
                    <th>السعر الافتراضي</th>
                      <th>مفعّل؟</th>
                      <th>إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                                @php
                                    $name = is_string($service->name) ? json_decode($service->name, true) : $service->name;
                                @endphp
                <tr>
                    <td>{{ $service->id }}</td>
                    <td>{{ $name['ar'] ?? '' }}</td>
                    <td>{{ $name['en'] ?? '' }}</td>
                    <td>{{ $service->default_price }}</td>
                                <td>
                                                <form action="{{ route('services.toggle', $service) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm {{ $service->is_active ? 'btn-success' : 'btn-secondary' }}">
                                                        {{ $service->is_active ? 'مفعّل' : 'غير مفعّل' }}
                                                    </button>
                                                </form>
                                </td>
                                <td>
                                    <a href="{{ route('services.edit', $service) }}" class="btn btn-sm btn-warning">تعديل</a>
                                    <form action="{{ route('services.destroy', $service) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('تأكيد الحذف؟')">حذف</button>
                                    </form>
                                </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">لا توجد خدمات مسجلة</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
