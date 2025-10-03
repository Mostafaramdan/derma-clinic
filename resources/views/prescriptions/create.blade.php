@extends('layouts.admin')
@section('title','إضافة روشتة')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container--default .select2-selection--multiple {
        min-height: 48px;
        border-radius: 0.5rem;
        border: 1px solid #ced4da;
        padding: 0.25rem 0.5rem;
    }
    .select2-results__option input[type=checkbox] {
        margin-left: 8px;
        margin-right: 4px;
    }
</style>
<div class="container py-4">
    <h1 class="mb-4 fw-bold text-primary">إضافة روشتة جديدة</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="bg-white shadow-sm rounded-3 p-4">
                <form method="POST" action="{{ route('prescriptions.store') }}">
                    @csrf
                    <div class="mb-3">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                    <a href="{{ route('prescriptions.index') }}" class="btn btn-secondary">إلغاء</a>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="medications" class="form-label">الأدوية</label>
                        <select name="medications[]" id="medications" class="form-select" multiple>
                            @foreach($medications as $med)
                                <option value="{{ $med->id }}" {{ (collect(old('medications'))->contains($med->id)) ? 'selected' : '' }}>{{ $med->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="advices" class="form-label">الإرشادات</label>
                        <select name="advices[]" id="advices" class="form-select" multiple>
                            @foreach($advices as $advice)
                                <option value="{{ $advice->id }}" {{ (collect(old('advices'))->contains($advice->id)) ? 'selected' : '' }}>{{ $advice->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">حفظ</button>
                    <a href="{{ route('prescriptions.index') }}" class="btn btn-secondary">إلغاء</a>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    function formatOption (option) {
        if (!option.id) return option.text;
        var checked = option.selected ? 'checked' : '';
        var checkmark = option.selected ? '<span style="color: #198754; font-size: 1.2em; margin-left:6px;">✔️</span>' : '';
        var html = '<span>' +
            '<input type="checkbox" style="pointer-events:none;" ' + checked + '/> ' +
            option.text +
            checkmark +
            '</span>';
        return $(html);
    }
    $(function() {
        $('#medications, #advices').select2({
            placeholder: 'اختر من القائمة...',
            closeOnSelect: false,
            templateResult: formatOption,
            templateSelection: function(option) { return option.text; },
            width: '100%',
            dir: 'rtl',
            language: {
                noResults: function() { return 'لا توجد نتائج'; }
            }
        }).on('select2:select select2:unselect', function (e) {
            var select = $(this);
            var selectedVal = $(e.params.data.element).val();
            select.select2('close');
            setTimeout(function() {
                select.select2('open');
                // بعد الفتح: مرر للقيمة المحددة الأخيرة
                setTimeout(function() {
                    var results = document.querySelectorAll('.select2-results__option[aria-selected=true]');
                    if(results && results.length) {
                        results[results.length-1].scrollIntoView({block:'center'});
                    }
                }, 50);
            }, 0);
        });
    });
</script>
@endsection
