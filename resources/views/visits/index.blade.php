@extends('layouts.admin')
@section('title','الزيارات')
@section('content')
<div class="container py-4">
  <h1 class="mb-4 fw-bold text-primary">إدارة الزيارات</h1>
  <div class="bg-white shadow-sm rounded-3 p-4">
    <table class="table table-bordered align-middle">
      <thead>
        <tr>
          <th>الكود</th>
          <th>المريض</th>
          <th>نوع الزيارة</th>
          <th>الحالة</th>
          <th>تاريخ الإنشاء</th>
          <th>إجراءات</th>
        </tr>
      </thead>
      <tbody>
        @forelse($visits as $visit)
        <tr>
          <td>{{ $visit->visit_code }}</td>
          <td>{{ $visit->patient->name ?? '-' }}</td>
          <td>{{ $visit->visitType ? $visit->visitType->getNameLocalized() : '-' }}</td>
          <td>{{ $visit->status == 'final' ? 'نهائي' : 'مسودة' }}</td>
          <td>{{ $visit->created_at->format('Y-m-d H:i') }}</td>
          <td>
            <a href="{{ route('visits.edit', $visit) }}" class="btn btn-sm btn-primary">عرض/تعديل</a>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="text-center">لا توجد زيارات مسجلة</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
