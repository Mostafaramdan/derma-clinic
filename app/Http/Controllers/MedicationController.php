<?php

namespace App\Http\Controllers;

use App\Models\Medication;
use Illuminate\Http\Request;
use App\Http\Requests\MedicationRequest;

class MedicationController extends Controller
{
    public function index()
    {
        $medications = Medication::orderByDesc('id')->paginate(20);
        return view('medications.index', compact('medications'));
    }

    public function create()
    {
        return view('medications.create');
    }

    public function store(MedicationRequest $request)
    {
        Medication::create($request->validated());
        return redirect()->route('medications.index')->with('success', 'تم إضافة الدواء بنجاح');
    }

    public function edit(Medication $medication)
    {
        return view('medications.edit', compact('medication'));
    }

    public function update(MedicationRequest $request, Medication $medication)
    {
        $medication->update($request->validated());
        return redirect()->route('medications.index')->with('success', 'تم تحديث بيانات الدواء بنجاح');
    }

    public function destroy(Medication $medication)
    {
        $medication->delete();
        return redirect()->route('medications.index')->with('success', 'تم حذف الدواء بنجاح');
    }
}
