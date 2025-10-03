@extends('layouts.admin')
@section('title','Patients')
@section('content')
<div class="container py-4">
  <div class="text-center mb-2">
    <span class="d-inline-block mb-2" style="font-size:2.5rem;">
      <!-- SVG أيقونة user -->
      <svg width="48" height="48" viewBox="0 0 24 24" fill="none">
        <circle cx="12" cy="8" r="5" fill="#ffd600" stroke="#2563eb" stroke-width="2.2"/>
        <ellipse cx="12" cy="18" rx="8" ry="5" fill="#fffbe6" stroke="#2563eb" stroke-width="2.2"/>
      </svg>
    </span>
    <h1 class="fw-bold text-primary">بحث عن مريض</h1>
  </div>
  <form method="GET" action="{{ route('patients.index') }}" class="mb-4">
    <div class="row g-2">
      <div class="col-md-3">
        <input type="text" name="q" class="form-control" placeholder="بحث بالاسم أو الهاتف أو الكود" value="{{ request('q') }}">
      </div>
      <div class="col-md-2">
        <button type="submit" class="btn btn-primary w-100">بحث</button>
      </div>
      <div class="col-md-2">
  <a href="{{ route('patients.create') }}" class="btn btn-success w-100"><i class="bi bi-plus-circle me-1"></i> إضافة مريض جديد</a>
      </div>
    </div>
  </form>
  <div class="bg-white shadow-sm rounded-3 p-4">
    <table class="table table-bordered align-middle">
      <thead>
        <tr>
          <th>الكود</th>
          <th>الاسم</th>
          <th>الهاتف</th>
          <th>العنوان</th>
          <th>إجراءات</th>
        </tr>
      </thead>
      <tbody>
        @forelse($patients as $patient)
        <tr>
          <td>{{ $patient->ref_code }}</td>
          <td>{{ $patient->name }}</td>
          <td>{{ $patient->phone }}</td>
          <td>{{ $patient->address }}</td>
          <td>
            <a href="{{ route('patients.edit', $patient) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square me-1"></i> تعديل</a>
            <a href="{{ route('visits.create', ['patient' => $patient->id]) }}" class="btn btn-sm btn-primary">زيارة جديدة</a>
          </td>
        </tr>
        @empty
        <tr><td colspan="5" class="text-center">لا يوجد مرضى</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
