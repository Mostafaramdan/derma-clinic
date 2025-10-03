@extends('layouts.dashboard')
@section('content')
<div class="container">
  <div class="card">
    <div class="head"><h3>تعديل بيانات الدواء</h3></div>
    <div class="body">
      <form method="POST" action="{{ route('medications.update', $medication) }}">
        @csrf @method('PUT')
        <div class="field"><label>اسم الدواء</label>
          <input name="name" value="{{ old('name', $medication->name ?? '') }}">
          @error('name')<div class="field-error">{{ $message }}</div>@enderror
        </div>
        <button type="submit" class="btn primary">تحديث</button>
        <a href="{{ route('medications.index') }}" class="btn">إلغاء</a>
      </form>
    </div>
  </div>
</div>
@endsection
