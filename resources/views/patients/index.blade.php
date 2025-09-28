@extends('layouts.admin')
@section('title','Patients')
@section('content')
<div class="container py-4">
  <h1 class="mb-4 fw-bold text-primary">بحث عن مريض</h1>
  <form method="GET" action="{{ route('patients.index') }}" class="mb-4">
    <div class="row g-2">
      <div class="col-md-3">
        <input type="text" name="q" class="form-control" placeholder="بحث بالاسم أو الهاتف أو الكود" value="{{ request('q') }}">
      </div>
      <div class="col-md-2">
        <button type="submit" class="btn btn-primary w-100">بحث</button>
      </div>
      <div class="col-md-2">
        <a href="{{ route('patients.create') }}" class="btn btn-success w-100">إضافة مريض جديد</a>
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
            <a href="{{ route('patients.edit', $patient) }}" class="btn btn-sm btn-warning">تعديل</a>
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
