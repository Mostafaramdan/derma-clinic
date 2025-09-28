@extends('layouts.admin')
@section('title','إنشاء زيارة جديدة')
@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-7">
      <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white py-3 rounded-top-4">
          <h2 class="mb-0 fw-bold">بدء زيارة جديدة</h2>
        </div>
        <div class="card-body p-4">
          <div class="mb-4">
            <span class="fw-bold text-secondary">المريض:</span>
            <span class="fw-bold text-dark">{{ $patient->name }}</span>
          </div>
          @if($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          <form method="POST" action="{{ route('visits.store') }}">
            @csrf
            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
            <div class="mb-4">
              <label for="visit_type_id" class="form-label fw-bold">نوع الزيارة</label>
              <select name="visit_type_id" id="visit_type_id" class="form-select form-select-lg" required>
                <option value="">اختر نوع الزيارة</option>
                @foreach($visitTypes as $type)
                  <option value="{{ $type->id }}">{{ $type->getNameLocalized() }}</option>
                @endforeach
              </select>
            </div>
            <div class="d-flex justify-content-end gap-2">
              <button type="submit" class="btn btn-success btn-lg px-5">بدء الزيارة</button>
              <a href="{{ route('patients.index') }}" class="btn btn-secondary btn-lg px-5">إلغاء</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
