<?php
namespace App\Http\Controllers;

use App\Models\Lab;
use App\Http\Requests\LabRequest;
use Illuminate\Http\Request;

class LabController extends Controller
{
    public function index()
    {
        $labs = Lab::latest()->paginate(20);
        return view('labs.index', compact('labs'));
    }
    public function create()
    {
        return view('labs.create');
    }
    public function store(LabRequest $request)
    {
        Lab::create($request->validated());
        return redirect()->route('labs.index')->with('success', 'تمت إضافة المعمل بنجاح');
    }
    public function edit(Lab $lab)
    {
        return view('labs.edit', compact('lab'));
    }
    public function update(LabRequest $request, Lab $lab)
    {
        $lab->update($request->validated());
        return redirect()->route('labs.index')->with('success', 'تم تحديث المعمل بنجاح');
    }
    public function destroy(Lab $lab)
    {
        $lab->delete();
        return redirect()->route('labs.index')->with('success', 'تم حذف المعمل بنجاح');
    }
}
