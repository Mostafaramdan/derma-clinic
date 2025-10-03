
@extends('layouts.admin')
@section('title','الخدمات')
@section('content')
<div class="container py-4">
    <div class="text-center mb-2">
        <span class="d-inline-block mb-2" style="font-size:2.5rem;">
            🛎️
        </span>
        <h1 class="fw-bold text-primary">إدارة الخدمات</h1>
    </div>
    <form method="GET" action="{{ route('services.index') }}" class="mb-4">
        <div class="row g-2 justify-content-center">
            <div class="col-md-3">
                <input type="text" name="q" class="form-control" placeholder="بحث بالاسم أو السعر" value="{{ request('q') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">بحث</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('services.create') }}" class="btn btn-success w-100 fw-bold py-2"><i class="bi bi-plus-circle me-1"></i> إضافة خدمة جديدة</a>
            </div>
        </div>
    </form>
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif
    <div class="bg-white shadow rounded-4 p-4 border border-2">
        <table class="table table-hover align-middle text-center" style="font-size:1.13rem;">
            <thead class="table-primary align-middle">
                <tr style="font-size:1.15rem;">
                    <th style="width:70px">#</th>
                    <th>الاسم (عربي)</th>
                    <th>الاسم (إنجليزي)</th>
                    <th>السعر الافتراضي</th>
                    <th>مفعّل؟</th>
                    <th style="width:180px">إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                @php $name = is_string($service->name) ? json_decode($service->name, true) : $service->name; @endphp
                <tr>
                    <td class="fw-bold">{{ $service->id }}</td>
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
                        <a href="{{ route('services.edit', $service) }}" class="btn btn-sm btn-warning px-3 fw-bold"><i class="bi bi-pencil-square me-1"></i> تعديل</a>
                        <form action="{{ route('services.destroy', $service) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger px-3 fw-bold" onclick="return confirm('تأكيد الحذف؟')"><i class="bi bi-trash me-1"></i> حذف</button>
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
