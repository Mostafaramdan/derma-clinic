@extends('layouts.app')
@section('content')
<div class="container">
    <h4>تعديل أشعة/تحليل</h4>
    <form action="{{ route('radiologies.update', $radiology) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">الاسم</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $radiology->name) }}" required>
            @error('name')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="notes" class="form-label">ملاحظات</label>
            <textarea name="notes" id="notes" class="form-control">{{ old('notes', $radiology->notes) }}</textarea>
            @error('notes')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <button type="submit" class="btn btn-success">تحديث</button>
        <a href="{{ route('radiologies.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
</div>
@endsection
