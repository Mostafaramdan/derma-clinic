@extends('layouts.admin')
@section('title','تعديل بيانات المريض')
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
    <h1 class="fw-bold text-primary">تعديل بيانات المريض</h1>
  </div>
  <div class="bg-white shadow-sm rounded-3 p-4">
    <form method="POST" action="{{ route('patients.update', $patient) }}">
      @csrf
      @method('PUT')
      <div class="row g-3">
        <div class="col-md-6">
          <label for="name" class="form-label">الاسم</label>
          <input type="text" name="name" id="name" class="form-control" value="{{ $patient->name }}" required>
        </div>
        <div class="col-md-3">
          <label for="age_years" class="form-label">العمر (سنوات)</label>
          <input type="number" name="age_years" id="age_years" class="form-control" min="0" value="{{ $patient->age_years }}">
        </div>
        <div class="col-md-3">
          <label for="age_months" class="form-label">العمر (شهور)</label>
          <input type="number" name="age_months" id="age_months" class="form-control" min="0" max="11" value="{{ $patient->age_months }}">
        </div>
        <div class="col-md-3">
          <label for="gender" class="form-label">النوع</label>
          <select name="gender" id="gender" class="form-select" required>
            <option value="male" @if($patient->gender=='male') selected @endif>ذكر</option>
            <option value="female" @if($patient->gender=='female') selected @endif>أنثى</option>
          </select>
        </div>
        <div class="col-md-3">
          <label for="marital_status" class="form-label">الحالة الاجتماعية</label>
          <select name="marital_status" id="marital_status" class="form-select">
            <option value="single" @if($patient->marital_status=='single') selected @endif>أعزب</option>
            <option value="married" @if($patient->marital_status=='married') selected @endif>متزوج</option>
            <option value="divorced" @if($patient->marital_status=='divorced') selected @endif>مطلق</option>
            <option value="widowed" @if($patient->marital_status=='widowed') selected @endif>أرمل</option>
          </select>
        </div>
        <div class="col-md-6">
          <label for="occupation" class="form-label">الوظيفة</label>
          <input type="text" name="occupation" id="occupation" class="form-control" value="{{ $patient->occupation }}">
        </div>
        <div class="col-md-6">
          <label for="address" class="form-label">العنوان</label>
          <input type="text" name="address" id="address" class="form-control" value="{{ $patient->address }}">
        </div>
        <div class="col-md-3">
          <label for="phone" class="form-label">الهاتف</label>
          <input type="text" name="phone" id="phone" class="form-control" value="{{ $patient->phone }}">
        </div>
        <div class="col-md-12">
          <label for="notes" class="form-label">ملاحظات</label>
          <textarea name="notes" id="notes" class="form-control" rows="2">{{ $patient->notes }}</textarea>
        </div>
      </div>
      <button type="submit" class="btn btn-primary mt-4">تحديث البيانات</button>
    </form>
  </div>
</div>
@endsection
