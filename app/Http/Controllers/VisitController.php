<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;
use App\Models\Patient;
use App\Models\VisitType;
use App\Models\ChronicDisease;
use App\Models\Service;


class VisitController extends Controller
{
    /**
     * Update the specified visit in storage.
     */
    public function update(Request $request, Visit $visit)
    {
        // تحويل body_spots إلى array إذا كانت JSON string
        if ($request->has('exam.body_spots') && is_string($request->input('exam.body_spots'))) {
            $decoded = json_decode($request->input('exam.body_spots'), true);
            if (is_array($decoded)) {
                $request->merge(['exam' => array_merge($request->input('exam', []), ['body_spots' => $decoded])]);
            }
        }

        $ChronicDiseaseRules = [];
        foreach (ChronicDisease::all() as $cd) {
            $ChronicDiseaseRules['history.chronic_' . $cd->id] = 'required|boolean';
        }

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
            ...$ChronicDiseaseRules,
            'history.other_diseases' => 'nullable|string',
            'history.notes' => 'nullable|string',
            // الكشف
            'exam.skin_type' => 'nullable|string',
            'exam.chief_complaint' => 'nullable|string',
            'exam.severity' => 'nullable|integer',
            'exam.duration' => 'nullable|string',
            'exam.clinical_picture' => 'nullable|string',
            'exam.body_spots' => 'nullable|array',
            'exam.dx' => 'nullable|array',
            'exam.follow_up_at' => 'nullable|date',
            'exam.diagnosis' => 'nullable|array',
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
       $visit->patient->update($data['patient'] ?? []);

        // تحديث التاريخ المرضي
        $visit->patient->updateChronicDiseases($data['history'] ?? [], $visit->id);
        // تحديث بيانات الكشف (exam)
        $visit->update($data['exam'] ?? []);

        // تحديث التحاليل (VisitLab)
        $visit->labs()->delete();
        if (!empty($data['labs'])) {
            foreach ($data['labs'] as $i => $lab) {
                $fileId = null;
                // معالجة رفع الملف إذا كان موجودًا
                if ($request->hasFile("labs.$i.file")) {
                    $file = $request->file("labs.$i.file");
                    $path = $file->store('labs', 'public');
                    // أنشئ VisitFile جديد للنتيجة
                    $visitFile = $visit->files()->create([
                        'type' => 'lab',
                        'path' => $path,
                        'mime' => $file->getClientMimeType(),
                        'size' => $file->getSize(),
                    ]);
                    $fileId = $visitFile->id;
                }
                $visit->labs()->create([
                    'test_name' => $lab['name'] ?? '',
                    'notes' => $lab['note'] ?? '',
                    'lab_info' => $lab['provider'] ?? '',
                    'result_file_id' => $fileId,
                ]);
            }
        }

        return redirect()->route('visits.edit', $visit)->with('success', 'تم تحديث بيانات الزيارة بنجاح');
    }
    public function index()
    {
        $visits = Visit::with(['patient', 'visitType'])->orderByDesc('id')->get();
        return view('visits.index', compact('visits'));
    }
    public function create(Request $request)
    {
    $patient = Patient::findOrFail($request->patient);
    $visitTypes = VisitType::all();
    $services = Service::where('is_active', true)->orderByDesc('id')->get();
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
        return redirect()->route('visits.index')->with('success', 'تم إنشاء الزيارة بنجاح');
    }

    /**
     * Generate a unique 10-digit visit code
     */
    protected function generateVisitCode()
    {
        do {
            $code = str_pad(strval(random_int(0, 9999999999)), 10, '0', STR_PAD_LEFT);
        } while (Visit::where('visit_code', $code)->exists());
        return $code;
    }

    /**
     * Show the form for editing the specified visit.
     */
    public function edit(Visit $visit)
    {
    $visit->load(['patient', 'medications', 'advices', 'labs', 'files', 'photos', 'invoice','patientChronicDiseases']);

    $chronicDiseases = ChronicDisease::all();
    $services = Service::where('is_active', true)->orderByDesc('id')->get();
    $allMedications = \App\Models\Medication::orderBy('name')->get();

    // Load all prescription templates with their medications and advices
    $prescriptionTemplates = \App\Models\Prescription::with(['medications', 'advices'])->orderBy('name')->get();

    return view('visits.edit', compact('visit', 'chronicDiseases', 'services', 'allMedications', 'prescriptionTemplates'));
    }
    public function destroy(Visit $visit)
    {
        $visit->delete();
        return redirect()->route('visits.index')->with('success', 'تم حذف الزيارة بنجاح');
    }
}
