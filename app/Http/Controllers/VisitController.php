<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;
use App\Models\Patient;
use App\Models\VisitType;

class VisitController extends Controller
{
    /**
     * Update the specified visit in storage.
     */
    public function update(Request $request, Visit $visit)
    {
        // تحقق من صحة البيانات الأساسية
        $data = $request->validate([
            // بيانات المريض الأساسية
            'patient.name' => 'required|string|max:255',
            'patient.age_years' => 'nullable|integer|min:0|max:150',
            'patient.age_months' => 'nullable|integer|min:0|max:11',
            'patient.gender' => 'nullable|string',
            'patient.marital_status' => 'nullable|string',
            'patient.job' => 'nullable|string',
            'patient.address' => 'nullable|string',
            'patient.phone' => 'nullable|string',
            'patient.notes' => 'nullable|string',
            // التاريخ المرضي
            'history.dm' => 'nullable|boolean',
            'history.htn' => 'nullable|boolean',
            'history.drug_allergy' => 'nullable|boolean',
            'history.pregnant' => 'nullable|boolean',
            'history.lactation' => 'nullable|boolean',
            'history.other_diseases' => 'nullable|string',
            'history.notes' => 'nullable|string',
            // الكشف
            'exam.skin_type' => 'nullable|string',
            'exam.chief_complaint' => 'nullable|string',
            'exam.severity' => 'nullable|integer',
            'exam.duration' => 'nullable|string',
            'exam.clinical_picture' => 'nullable|string',
            'exam.locations' => 'nullable|array',
            'exam.dx' => 'nullable|array',
            'exam.follow_up_at' => 'nullable|date',
            // الروشتة والإرشادات
            'rx.meds' => 'nullable|array',
            'rx.advices_enabled' => 'nullable|boolean',
            'rx.advices' => 'nullable|array',
            // التحاليل
            'labs' => 'nullable|array',
            // الملفات
            'files' => 'nullable|array',
            // الصور
            'photos.note' => 'nullable|string',
            'photos.files' => 'nullable|array',
            // الفاتورة والخدمات
            'services' => 'nullable|array',
        ]);

        // تحديث بيانات المريض
        $patient = $visit->patient;
        $patient->fill($data['patient'] ?? []);
        $patient->history = $data['history'] ?? [];
        $patient->save();

        // تحديث بيانات الكشف
        $visit->exam = $data['exam'] ?? [];

        // تحديث الروشتة
        $visit->medications = $data['rx']['meds'] ?? [];
        $visit->advices = $data['rx']['advices'] ?? [];

        // تحديث التحاليل
        $visit->labs = $data['labs'] ?? [];

        // تحديث الملفات
        $visit->files = $data['files'] ?? [];

        // تحديث الصور
        // حذف الصور القديمة إذا تم رفع صور جديدة
        if (!empty($data['photos']['files'])) {
            $visit->photos()->delete();
            foreach ($data['photos']['files'] as $file) {
                if ($file) {
                    $path = $file->store('photos', 'public');
                    $visit->photos()->create([
                        'file_path' => $path,
                        'description' => $data['photos']['note'] ?? '',
                    ]);
                }
            }
        }

        // تحديث الخدمات والفاتورة
        $visit->services = $data['services'] ?? [];

        $visit->save();

        return redirect()->route('visits.edit', $visit)->with('success', 'تم تحديث بيانات الزيارة بنجاح');
    }
    public function index()
    {
        $visits = \App\Models\Visit::with(['patient', 'visitType'])->orderByDesc('id')->get();
        return view('visits.index', compact('visits'));
    }
    public function create(Request $request)
    {
    $patient = Patient::findOrFail($request->patient);
    $visitTypes = VisitType::all();
    $services = \App\Models\Service::where('is_active', true)->orderByDesc('id')->get();
    return view('visits.create', compact('patient', 'visitTypes', 'services'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'visit_type_id' => 'required|exists:visit_types,id',
        ]);
        $visit = Visit::create([
            'patient_id' => $data['patient_id'],
            'visit_type_id' => $data['visit_type_id'],
            'visit_code' => $this->generateVisitCode(),
            // يمكن إضافة حقول أخرى لاحقاً
        ]);
        return redirect()->route('visits.edit', $visit)->with('success', 'تم إنشاء الزيارة بنجاح');
    }

    /**
     * Generate a unique 10-digit visit code
     */
    protected function generateVisitCode()
    {
        do {
            $code = str_pad(strval(random_int(0, 9999999999)), 10, '0', STR_PAD_LEFT);
        } while (\App\Models\Visit::where('visit_code', $code)->exists());
        return $code;
    }

    /**
     * Show the form for editing the specified visit.
     */
    public function edit(Visit $visit)
    {
        $visit->load(['patient', 'medications', 'advices', 'labs', 'files', 'photos', 'invoice']);
        $chronicDiseases = \App\Models\ChronicDisease::all();
        $services = \App\Models\Service::where('is_active', true)->orderByDesc('id')->get();
        return view('visits.edit', compact('visit', 'chronicDiseases', 'services'));
    }
}
