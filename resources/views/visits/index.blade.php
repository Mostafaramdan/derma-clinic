@extends('layouts.admin')
@section('title','الزيارات')
@section('content')
<div class="container py-4">
  <div class="text-center mb-2">
    <span class="d-inline-block mb-2" style="font-size:2.5rem;">
      <!-- SVG أيقونة calendar -->
      <svg width="48" height="48" viewBox="0 0 24 24" fill="none">
        <rect x="3" y="5" width="18" height="16" rx="4" fill="#ffd600" stroke="#2563eb" stroke-width="2.2"/>
        <rect x="7" y="2" width="2" height="4" rx="1" fill="#2563eb"/>
        <rect x="15" y="2" width="2" height="4" rx="1" fill="#2563eb"/>
        <rect x="3" y="9" width="18" height="2" fill="#2563eb"/>
      </svg>
    </span>
    <h1 class="fw-bold text-primary">إدارة الزيارات</h1>
  </div>
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
