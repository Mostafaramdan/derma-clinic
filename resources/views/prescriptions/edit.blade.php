@extends('layouts.admin')
@section('title','تعديل روشتة')
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
    <h1 class="mb-4 fw-bold text-primary">تعديل الروشتة</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="bg-white shadow-sm rounded-3 p-4">
                <form method="POST" action="{{ route('prescriptions.update', $prescription) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">اسم الروشتة</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $prescription->name) }}" required autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="medications" class="form-label">الأدوية</label>
                        <select name="medications[]" id="medications" class="form-select" multiple>
                            @foreach($medications as $med)
                                <option value="{{ $med->id }}" {{ in_array($med->id, old('medications', $selectedMedications)) ? 'selected' : '' }}>{{ $med->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="advices" class="form-label">الإرشادات</label>
                        <select name="advices[]" id="advices" class="form-select" multiple>
                            @foreach($advices as $advice)
                                <option value="{{ $advice->id }}" {{ in_array($advice->id, old('advices', $selectedAdvices)) ? 'selected' : '' }}>{{ $advice->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">تحديث</button>
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
            placeholder: 'ابحث أو اختر من القائمة...',
            closeOnSelect: false,
            templateResult: formatOption,
            templateSelection: function(option) { return option.text; },
            width: '100%',
            dir: 'rtl',
            language: {
                noResults: function() { return 'لا توجد نتائج'; },
                searching: function() { return 'جاري البحث...'; },
                inputTooShort: function() { return 'اكتب للبحث...'; }
            },
            minimumResultsForSearch: 0 // always show search box
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
