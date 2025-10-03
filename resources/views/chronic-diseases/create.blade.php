@extends('layouts.dashboard')
@section('title','إضافة مرض مزمن')
@section('content')
<div class="container py-4">
  <div class="text-center mb-3">
    <span class="d-inline-block mb-2" style="font-size:2.5rem;">❤️</span>
    <h1 class="fw-bold text-primary">إضافة مرض مزمن</h1>
  </div>
  <div class="bg-white shadow-sm rounded-3 p-4">
    <form method="POST" action="{{ route('chronic-diseases.store') }}">
      @csrf
      <div class="mb-3">
        <label class="form-label">اسم المرض (عربي)</label>
        <input type="text" name="name_ar" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">اسم المرض (إنجليزي)</label>
        <input type="text" name="name_en" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">نشط؟</label>
        <select name="is_active" class="form-select">
          <option value="1">نعم</option>
          <option value="0">لا</option>
        </select>
      </div>
  <button type="submit" class="btn btn-success"><i class="bi bi-plus-circle me-1"></i> إضافة</button>
      <a href="{{ route('chronic-diseases.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
  </div>
</div>
@endsection
