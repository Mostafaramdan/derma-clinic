@extends('layouts.app')
@section('content')
  <header class="topbar">
    <div class="topbar-inner container">
      <div class="brand"><div class="avatar">د</div><div><div style="font-weight:900">شاشة الزيارة — دكتور جلدية</div><small style="color:var(--muted)">المريض: فاطمة حسن • اليوم 14:30 • د. أحمد</small></div></div>
      <div class="actions no-print">
        <button class="btn">حفظ مسودة</button>
        <button class="btn primary">حفظ الزيارة</button>
      </div>
    </div>
  </header>
  <main class="container">
    <div class="tabs" role="tablist" aria-label="Visit Tabs">
      <button class="tab-btn" role="tab" id="tab-basic"   aria-controls="panel-basic"   aria-selected="true">البيانات الأساسية</button>
      <button class="tab-btn" role="tab" id="tab-dx"      aria-controls="panel-dx"      aria-selected="false">الكشف</button>
      <button class="tab-btn" role="tab" id="tab-rxadv"   aria-controls="panel-rxadv"   aria-selected="false">الروشتة والإرشادات</button>
      <button class="tab-btn" role="tab" id="tab-labs"    aria-controls="panel-labs"    aria-selected="false">التحاليل والملفات</button>
      <button class="tab-btn" role="tab" id="tab-photos"  aria-controls="panel-photos"  aria-selected="false">صور الحالة</button>
      <button class="tab-btn" role="tab" id="tab-billing" aria-controls="panel-billing" aria-selected="false">الخدمات والفوترة</button>
    </div>
    <div class="tabpanels">
      <section id="panel-basic" class="tabpanel" role="tabpanel" aria-labelledby="tab-basic" aria-hidden="false">
        <div class="grid">
          @include('visits.partials.patient-basic')
          @include('visits.partials.history')
        </div>
      </section>
      <section id="panel-dx" class="tabpanel" role="tabpanel" aria-labelledby="tab-dx" aria-hidden="true">
        @include('visits.partials.exam')
      </section>
      <section id="panel-rxadv" class="tabpanel" role="tabpanel" aria-labelledby="tab-rxadv" aria-hidden="true">
        @include('visits.partials.rx-advices')
      </section>
      <section id="panel-labs" class="tabpanel" role="tabpanel" aria-labelledby="tab-labs" aria-hidden="true">
        @include('visits.partials.labs-files')
      </section>
      <section id="panel-photos" class="tabpanel" role="tabpanel" aria-labelledby="tab-photos" aria-hidden="true">
        @include('visits.partials.photos')
      </section>
      <section id="panel-billing" class="tabpanel" role="tabpanel" aria-labelledby="tab-billing" aria-hidden="true">
        @include('visits.partials.billing')
      </section>
    </div>
    <div class="actions" style="display:flex;justify-content:flex-end;margin-top:16px">
      <button class="btn">حفظ مسودة</button>
      <button class="btn primary">حفظ الزيارة</button>
    </div>
  </main>
@endsection
