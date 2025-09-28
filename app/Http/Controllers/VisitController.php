<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;
use App\Models\Patient;
use App\Models\VisitType;

class VisitController extends Controller
{
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
