@extends('layouts.dashboard')
@section('title','الأمراض المزمنة')
@section('content')
<div class="container py-4">
  <h1 class="mb-4 fw-bold text-primary">الأمراض المزمنة</h1>
  <div class="mb-3">
    <a href="{{ route('chronic-diseases.create') }}" class="btn btn-success">+ إضافة مرض مزمن</a>
  </div>
  <div class="bg-white shadow-sm rounded-3 p-4">
    <table class="table table-bordered align-middle">
      <thead>
        <tr>
          <th>#</th>
          <th>اسم المرض</th>
          <th>نشط؟</th>
          <th>إجراءات</th>
        </tr>
      </thead>
      <tbody>
        @forelse($diseases as $disease)
        <tr>
          <td>{{ $disease->id }}</td>
          <td>{{ is_array($disease->name) ? ($disease->name['ar'] ?? '') : (json_decode($disease->name, true)['ar'] ?? $disease->name) }}</td>
          <td>{{ $disease->is_active ? 'نعم' : 'لا' }}</td>
          <td>
            <a href="{{ route('chronic-diseases.edit', $disease) }}" class="btn btn-sm btn-primary">تعديل</a>
            <form method="POST" action="{{ route('chronic-diseases.destroy', $disease) }}" style="display:inline-block" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger">حذف</button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="4" class="text-center">لا يوجد أمراض مزمنة</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
