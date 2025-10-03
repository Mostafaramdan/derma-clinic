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
<div class="container py-4 d-flex flex-column align-items-center" style="min-height:70vh;">
    <div class="w-100" style="max-width: 600px;">
        <div class="text-center mb-4">
            <span class="d-inline-block mb-2" style="font-size:2.5rem; color:#2563eb;">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none">
                  <rect x="4" y="3" width="16" height="18" rx="3" fill="#ffd600" stroke="#2563eb" stroke-width="2.2"/>
                  <rect x="7" y="6" width="10" height="2" rx="1" fill="#2563eb"/>
                  <rect x="7" y="10" width="7" height="2" rx="1" fill="#2563eb"/>
                  <rect x="7" y="14" width="5" height="2" rx="1" fill="#2563eb"/>
                </svg>
            </span>
            <h2 class="fw-bold text-primary">تعديل الروشتة</h2>
        </div>
        <div class="bg-white shadow rounded-4 p-4 border border-2">
            <form method="POST" action="{{ route('prescriptions.update', $prescription) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">اسم الروشتة</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $prescription->name) }}" required autofocus>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="medications" class="form-label fw-bold">الأدوية</label>
                    <select name="medications[]" id="medications" class="form-select" multiple>
                        @foreach($medications as $med)
                            <option value="{{ $med->id }}" {{ in_array($med->id, old('medications', $selectedMedications)) ? 'selected' : '' }}>{{ $med->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="advices" class="form-label fw-bold">الإرشادات</label>
                    <select name="advices[]" id="advices" class="form-select" multiple>
                        @foreach($advices as $advice)
                            <option value="{{ $advice->id }}" {{ in_array($advice->id, old('advices', $selectedAdvices)) ? 'selected' : '' }}>{{ $advice->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4">
                    <button type="submit" class="btn btn-primary px-4 fw-bold"><i class="bi bi-check-circle me-1"></i> تحديث</button>
                    <a href="{{ route('prescriptions.index') }}" class="btn btn-secondary px-4 fw-bold"><i class="bi bi-x-circle me-1"></i> إلغاء</a>
                </div>
            </form>
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
