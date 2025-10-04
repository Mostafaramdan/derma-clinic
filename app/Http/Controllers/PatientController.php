<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q');
        $patients = Patient::query()
            ->when($q, function($query) use ($q) {
                $query->where('name', 'like', "%$q%")
                      ->orWhere('phone', 'like', "%$q%")
                      ->orWhere('ref_code', 'like', "%$q%") ;
            })
            ->orderByDesc('id')
            ->paginate(20);
        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'age_years' => 'nullable|integer',
            'age_months' => 'nullable|integer',
            'gender' => 'required',
            'marital_status' => 'nullable|string',
            'job' => 'nullable|string',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);
        $data['ref_code'] = 'P' . time();
        $patient = Patient::create($data);
        return redirect()->route('patients.index')->with('success','تم إضافة المريض بنجاح');
    }

    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'age_years' => 'nullable|integer',
            'age_months' => 'nullable|integer',
            'gender' => 'required',
            'marital_status' => 'nullable|string',
            'job' => 'nullable|string',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);
        $patient->update($data);
        return redirect()->route('patients.index')->with('success','تم تحديث بيانات المريض بنجاح');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index')->with('success','تم حذف المريض بنجاح');
    }
}
