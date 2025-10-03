<?php

namespace App\Http\Controllers;

use App\Models\Advice;
use App\Http\Requests\AdviceRequest;
use Illuminate\Http\Request;

class AdviceController extends Controller
{
    public function index()
    {
        $advices = Advice::latest()->paginate(20);
        return view('advices.index', compact('advices'));
    }

    public function create()
    {
        return view('advices.create');
    }

    public function store(AdviceRequest $request)
    {
        Advice::create($request->validated());
        return redirect()->route('advices.index')->with('success', 'تمت إضافة الإرشاد بنجاح');
    }

    public function edit(Advice $advice)
    {
        return view('advices.edit', compact('advice'));
    }

    public function update(AdviceRequest $request, Advice $advice)
    {
        $advice->update($request->validated());
        return redirect()->route('advices.index')->with('success', 'تم تحديث الإرشاد بنجاح');
    }

    public function destroy(Advice $advice)
    {
        $advice->delete();
        return redirect()->route('advices.index')->with('success', 'تم حذف الإرشاد بنجاح');
    }
}
