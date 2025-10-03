<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\Medication;
use App\Models\Advice;
use App\Http\Requests\PrescriptionRequest;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function index()
    {
        $prescriptions = Prescription::latest()->paginate(20);
        return view('prescriptions.index', compact('prescriptions'));
    }

    public function create()
    {
        $medications = Medication::all();
        $advices = Advice::all();
        return view('prescriptions.create', compact('medications', 'advices'));
    }

    public function store(PrescriptionRequest $request)
    {
        $prescription = Prescription::create($request->validated());
        $prescription->medications()->sync($request->input('medications', []));
        $prescription->advices()->sync($request->input('advices', []));
        return redirect()->route('prescriptions.index')->with('success', 'تمت إضافة الروشتة بنجاح');
    }

    public function edit(Prescription $prescription)
    {
        $medications = Medication::all();
        $advices = Advice::all();
        $selectedMedications = $prescription->medications->pluck('id')->toArray();
        $selectedAdvices = $prescription->advices->pluck('id')->toArray();
        return view('prescriptions.edit', compact('prescription', 'medications', 'advices', 'selectedMedications', 'selectedAdvices'));
    }

    public function update(PrescriptionRequest $request, Prescription $prescription)
    {
        $prescription->update($request->validated());
        $prescription->medications()->sync($request->input('medications', []));
        $prescription->advices()->sync($request->input('advices', []));
        return redirect()->route('prescriptions.index')->with('success', 'تم تحديث الروشتة بنجاح');
    }

    public function destroy(Prescription $prescription)
    {
        $prescription->delete();
        return redirect()->route('prescriptions.index')->with('success', 'تم حذف الروشتة بنجاح');
    }
}
