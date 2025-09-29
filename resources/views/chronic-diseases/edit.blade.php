@extends('layouts.dashboard')
@section('title','تعديل مرض مزمن')
@section('content')
<div class="container py-4">
  <h1 class="mb-4 fw-bold text-primary">تعديل مرض مزمن</h1>
  <div class="bg-white shadow-sm rounded-3 p-4">
    <form method="POST" action="{{ route('chronic-diseases.update', $chronicDisease) }}">
      @csrf
      @method('PUT')
      <div class="mb-3">
        <label class="form-label">اسم المرض (عربي)</label>
        <input type="text" name="name_ar" class="form-control" value="{{ $chronicDisease->name['ar'] ?? '' }}" required>
      </div>
      <div class="mb-3">
        <label class="form-label">اسم المرض (إنجليزي)</label>
        <input type="text" name="name_en" class="form-control" value="{{ $chronicDisease->name['en'] ?? '' }}" required>
      </div>
      <div class="mb-3">
        <label class="form-label">نشط؟</label>
        <select name="is_active" class="form-select">
          <option value="1" @if($chronicDisease->is_active) selected @endif>نعم</option>
          <option value="0" @if(!$chronicDisease->is_active) selected @endif>لا</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">تحديث</button>
      <a href="{{ route('chronic-diseases.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
  </div>
</div>
@endsection
