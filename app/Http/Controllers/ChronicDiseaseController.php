<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChronicDisease;

class ChronicDiseaseController extends Controller
{
    public function index()
    {
        $diseases = ChronicDisease::orderByDesc('id')->get();
        return view('chronic-diseases.index', compact('diseases'));
    }

    public function create()
    {
        return view('chronic-diseases.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);
        $diseaseData = [
            'name' => json_encode(['ar' => $data['name_ar'], 'en' => $data['name_en']]),
            'is_active' => $data['is_active'] ?? 1,
        ];
        ChronicDisease::create($diseaseData);
        return redirect()->route('chronic-diseases.index')->with('success', 'تم إضافة المرض المزمن بنجاح');
    }

    public function edit(ChronicDisease $chronicDisease)
    {
        return view('chronic-diseases.edit', compact('chronicDisease'));
    }

    public function update(Request $request, ChronicDisease $chronicDisease)
    {
        $data = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);
        $diseaseData = [
            'name' => json_encode(['ar' => $data['name_ar'], 'en' => $data['name_en']]),
            'is_active' => $data['is_active'] ?? 1,
        ];
        $chronicDisease->update($diseaseData);
        return redirect()->route('chronic-diseases.index')->with('success', 'تم تعديل المرض المزمن بنجاح');
    }

    public function destroy(ChronicDisease $chronicDisease)
    {
        $chronicDisease->delete();
        return redirect()->route('chronic-diseases.index')->with('success', 'تم حذف المرض المزمن بنجاح');
    }
}
